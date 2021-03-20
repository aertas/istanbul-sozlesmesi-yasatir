@extends('layouts.main')

@section('content')
	<div class="container my-5 text-center">
		<div class="row row-cols-1">
			<div class="col">
				<h1>İstanbul Sözleşmesi Yaşatır</h1>
				<h4>Profil Resmini Güncelle</h4>
			</div>
			<div class="col pb-2 mt-2">
				<div class="crop-cont"><div id="croppic"></div></div>
			</div>
			<div class="col pt-5 mt-2" >
				<button role="button" type="button" class="btn btn-primary" id="upload-image">Profil Resminizi Oluşturmak İçin Tıklayın
				</button>
			</div>
			<div class="col pt-3 mt-5">
				<p>
					<a href="http://kadincinayetlerinidurduracagiz.net/" target="_blank">Kadın Cinayetlerini Durduracağız Platformu</a>
				</p>
				<p>
					<a href="https://www.tck103kadinplatformu.net/" target="_blank">TCK103 Çocuk Cinsel İstismarı Affına Karşı Kadın Platformu</a>
				</p>
				<p>
					<a href="https://istanbulsozlesmesiyasatir.com" target="_blank">İstanbul Sözleşmesi Yaşatır</a>
				</p>
			</div>
			<div class="col pt-1 mt-1">
				<a href="https://twitter.com/search?q=%23istanbulsozlesmesiyasatir&src=typeahead_click" class="twitlink" target="_blank">#İstanbulSözleşmesiYaşatır</a>
				<a href="https://twitter.com/search?q=%23istanbulsozlesmesi&src=typeahead_click" class="twitlink" target="_blank">#İstanbulSözleşmesi</a>
			</div>
			<div class="mt-2 text-center" >
				<a href="https://twitter.com/concofahmet" target="_blank" class="twitlink" title="Follow me on twitter">aertas</a>
			</div>
			<div class="mb-2 text-center" >
				<a href="https://github.com/aertas/istanbul-sozlesmesi-yasatir" target="_blank" class="git" title="Fork me on github">GitHub</a>
			</div>
		</div>
	</div>

@endsection
