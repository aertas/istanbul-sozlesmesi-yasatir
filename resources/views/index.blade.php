@extends('layouts.main')

@section('content')

	<div class="container my-5 text-center">
		<div class="row row-cols-1">
			<div class="col">
				<h1>İstanbul Sözleşmesi Yaşatır</h1>
				<h4>Profil Resim Güncelle</h4>
			</div>
			<div class="col pb-5 mt-5">
				<div id="croppic"></div>
			</div>
			<div class="col pt-3">
				<button role="button" type="button" class="btn btn-primary" id="upload-image">Profil Resminizi Yüklemek İçin Tıklayın
				</button>
			</div>
			{{--
			<div class="col pt-3 mt-5">
				<p></p>
				<a href="https://istanbulsozlesmesiyasatir.com/" target="_blank">İstanbul Sözleşmesi Yaşatır</a>
			</div>
			--}}
			<div class="col pt-3 mt-5">
				<a href="https://twitter.com/search?q=%23istanbulsozlesmesiyasatir&src=typeahead_click" class="twitlink" target="_blank">#İstanbulSözleşmesiYaşatır</a>
				<a href="https://twitter.com/search?q=%23istanbulsozlesmesi&src=typeahead_click" class="twitlink" target="_blank">#İstanbulSözleşmesi</a>
			</div>

		</div>
	</div>

	<a href="https://github.com/aertas/istanbul-sozlesmesi-yasatir" target="_blank" class="git" title="Fork me on github">GitHub</a>

@endsection
