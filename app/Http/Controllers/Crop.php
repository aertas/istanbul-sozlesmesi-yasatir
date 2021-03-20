<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class Crop extends Controller
{
	public $frameWidth = 502;

	public function Image(Request $request)
	{

		$imgUrl = $request->input('imgUrl');

		// Original Boyutlar
		$imgInitW = $request->input('imgInitW');
		$imgInitH = $request->input('imgInitH');

		//$ratio = $this->frameWidth / 220;
		$ratio = $this->frameWidth / $request->input('cropW');

		// crop box
		$cropW = $request->input('cropW') * $ratio;
		$cropH = $request->input('cropH') * $ratio;
		// Burada işin kolayına kaçtım !
		//$cropW = 220 * $ratio;
		//$cropH = 220 * $ratio;

		// resized sizes
		$imgW = $request->input('imgW') * $ratio;
		$imgH = $request->input('imgH') * $ratio;

		// offsets
		$imgY1 = ($request->input('imgY1')) * $ratio;
		$imgX1 = ($request->input('imgX1')) * $ratio;

		// rotation angle
		$angle = $request->input('rotation');
		$output_file_short_name = 'cropped_img_' . rand();

		if (!File::exists(storage_path('croptemp'))) {
			File::makeDirectory(storage_path('croptemp'));
		}

		$output_filename = storage_path('croptemp') . '/' . $output_file_short_name;

		$frameImage = imagecreatefrompng(resource_path('img/frame.png'));
		imagealphablending($frameImage, false);
		imagesavealpha($frameImage, true);

		$what = getimagesize($imgUrl);

		switch (strtolower($what['mime'])) {
			case 'image/png':
				$source_image = imagecreatefrompng($imgUrl);
				imagealphablending($source_image, false);
				imagesavealpha($source_image, true);
				break;
			case 'image/jpeg':
				$source_image = imagecreatefromjpeg($imgUrl);
				error_log("jpg");
				break;
			case 'image/gif':
				$source_image = imagecreatefromgif($imgUrl);
				break;
			default:
				die('image type not supported');
		}

		//Check write Access to Directory
		if (!is_writable(dirname($output_filename))) {
			$response = [
				"status" => 'error',
				"message" => 'Can`t write cropped File'
			];
		} else {

			// resize the original image to size of editor
			$resizedImage = imagecreatetruecolor($imgW, $imgH);
			$color = imagecolorallocatealpha($resizedImage, 0, 0, 0, 127);
			imagefill($resizedImage, 0, 0, $color);
			imagecopyresampled($resizedImage, $source_image, 0, 0, 0, 0, $imgW, $imgH, $imgInitW, $imgInitH);

			// rotate the rezized image
			$rotated_image = imagerotate($resizedImage, -$angle, 0);

			// find new width & height of rotated image
			$rotated_width = imagesx($rotated_image);
			$rotated_height = imagesy($rotated_image);

			// diff between rotated & original sizes
			$dx = $rotated_width - $imgW;
			$dy = $rotated_height - $imgH;

			// crop rotated image to fit into original rezized rectangle
			$cropped_rotated_image = imagecreatetruecolor($imgW, $imgH);
			$color = imagecolorallocatealpha($cropped_rotated_image, 0, 0, 0, 127);
			imagefill($cropped_rotated_image, 0, 0, $color);
			//imagecolortransparent($cropped_rotated_image, imagecolorallocate($cropped_rotated_image, 0, 0, 0));
			imagecopyresampled($cropped_rotated_image, $rotated_image, 0, 0, $dx / 2, $dy / 2, $imgW, $imgH, $imgW, $imgH);
			@imagealphablending($cropped_rotated_image, false);
			@imagesavealpha($cropped_rotated_image, true);

			// crop image into selected area
			$final_image = imagecreatetruecolor($cropW, $cropH);
			$color = imagecolorallocatealpha($final_image, 0, 0, 0, 127);
			imagefill($final_image, 0, 0, $color);
			imagecolortransparent($final_image, $color);
			imagecopyresampled($final_image, $cropped_rotated_image, 0, 0, $imgX1, $imgY1, $cropW, $cropH, $cropW, $cropH);

			// Frame adapting
			imagecopyresampled($final_image, $frameImage, 0, 0, 0, 0, $this->frameWidth, $this->frameWidth, $this->frameWidth, $this->frameWidth);

			// 🤍 finally output png image 🤍
			@imagealphablending($final_image, false);
			@imagesavealpha($final_image, true);
			imagepng($final_image, $output_filename . '.png', 9);

			$response = [
				/*
				"request" => $request->all(),
				*/
				"imgW" => $imgW,
				"imgH" => $imgH,
				"cropW" => $cropW,
				"cropH" => $cropH,
				"imgX1" => $imgX1,
				"imgY1" => $imgY1,
				"status" => 'success',
				"url" => 'exp/' . $output_file_short_name . '.png'
			];
		}
		print json_encode($response);
	}

	public function Export($filename)
	{

		$path = storage_path('croptemp/' . $filename);

		if (!File::exists($path)) {
			abort(404);
		}

		$file = File::get($path);
		$type = File::mimeType($path);

		return Response::make($file, 200)
			->header("Content-Type", $type)
			->header("Content-Description", 'File Transfer')
			->header("Content-Type", 'application/octet-stream')
			->header("Content-Disposition", ' attachment; filename="' . $filename . '"');
	}
}
