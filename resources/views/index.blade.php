@extends('layouts.main')

@section('content')

	<div class="container mt-5 text-center">
		<div class="row row-cols-1">
			<div class="col">
				<h1>İstanbul Sözleşmesi Yaşatır</h1>
				<h4>Profil Resim Güncelle</h4>
			</div>
			<div class="col pb-5 mt-5">
				<div id="croppic"></div>
			</div>
			<div class="col pt-3">
				<button role="button" type="button" class="btn btn-primary" id="upload-image">Profil Resminizi Yüklemek İçin Tıklayın</button>
			</div>
		</div>
	</div>

@endsection
