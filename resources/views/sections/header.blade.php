<section id="mainHeader">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<a href="{{route('home')}}"><div class="brand"></div></a>
			</div>

			<div class="col-md-6 d-flex align-items-center justify-content-end position-relative">
				<div class="lang-selector">
					<a href="{{url('/ca')}}" @if('ca' == $lang)class="active"@endif>Cat</a>
					<span>-</span>
					<a href="{{url('/es')}}" @if('es' == $lang)class="active"@endif>Cast</a>
				</div>
			</div>
		</div>
	</div>
</section>