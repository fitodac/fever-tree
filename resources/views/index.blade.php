<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
				content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<meta name="description" content="{{ setting('site.description')  }}" />
	<meta name="author" content="Commonpeoplei" />
	<link rel="shortcut icon" href={{ asset("assets/img/favicon.png") }} />

	<title>{{ setting('site.title')  }}</title>

	<link rel="stylesheet" type="text/css" href="{{asset("vendor/cookie-consent/css/cookie-consent.css")}}">
	<link href={{ asset('assets/css/bootstrap.min.css') }} rel="stylesheet" />
	<link href={{ asset('assets/css/main.css') }} rel="stylesheet" />
</head>
<body>


@include('sections.header')



<section id="mainHero">
	<div class="container">
		<h1>
			<small class="font-gradient">@lang('hero_title_1')</small>
			<span>@lang('hero_title_2')</span>
		</h1>
	</div>

	<div class="hero-footer">
		<div class="container">
			<div class="row">
				<div class="col-sm-4 border-right">
					<h2>
						<span class="font-gradient">@lang('hero_block_1_1')</span>
						<span>@lang('hero_block_1_2')</span>
					</h2>
				</div>

				<div class="col-sm-4 border-right">
					<h2>
						<span class="font-gradient">@lang('hero_block_2_1')</span>
						<span>@lang('hero_block_2_2')</span>
					</h2>
				</div>

				<div class="col-sm-4">
					<h2>
						<span class="font-gradient">@lang('hero_block_3_1')</span>
						<span>@lang('hero_block_3_2')</span>
					</h2>
				</div>
			</div>
		</div>
	</div>
</section>



<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-10 col-xl-8">


			<form
				action=""
				method="post"
				id="mainForm"
				enctype="multipart/form-data"
				onsubmit="return false;">

				<div class="row">

					<div class="col-md-6 mb-3 mb-md-4">
						<label for="">@lang('form_label_name')</label>
						<input type="text" class="form-control transition" id="f-name" name="f-name" maxlength="50">
						<div class="form-error error-f-name"></div>
					</div>

					<div class="col-md-6 mb-3 mb-md-4">
						<label for="">@lang('form_label_lastname')</label>
						<input type="text" class="form-control transition" id="f-lastname" name="f-lastname" maxlength="50">
						<div class="form-error error-f-lastname"></div>
					</div>

					<div class="col-md-6 mb-3 mb-md-4">
						<label for="">@lang('form_label_email')</label>
						<input type="text" class="form-control transition" id="f-email" name="f-email" maxlength="50">
						<div class="form-error error-f-email"></div>
					</div>

					<div class="col-md-6 mb-3 mb-md-4">
						<label for="">@lang('form_label_phone')</label>
						<input type="text" class="form-control transition" id="f-phone" name="f-phone">
						<div class="form-error error-f-phone"></div>
					</div>

					<div class="col-md-6 mb-3 mb-md-4">
						<label for="">@lang('form_label_dni')</label>
						<input type="text" class="form-control transition" id="f-dni" name="f-dni">
						<div class="form-error error-f-dni"></div>
					</div>

					<div class="col-md-6 mb-3 mb-md-4">
						<label for="">@lang('form_label_birthday')</label>
						<input type="text" class="form-control" id="f-birthday" name="f-birthday">
						<div class="form-error error-f-birthday"></div>
					</div>

					<div class="col-md-12 mb-3 mb-md-4">
						<label for="">@lang('form_label_ticket')</label>
						<div id="dropZone" action="{{route('ticket.post')}}">
							<div class="dz-default dz-message">@lang('form_ticket_message')</div>
							<div class="dz-message-error d-none">@lang('form_ticket_error')</div>
						</div>

						<div class="form-error error-f-dropzone"></div>

						@error('file')
							<span class="text-danger">{{$message}}</span>
						@enderror
					</div>

					<div class="col-md-12 mb-3 mb-md-4">
						<label for="f-acceptance" class="checkbox">
							<input type="checkbox" name="f-acceptance" id="f-acceptance">
							<span>@lang('form_label_acceptance')</span>
						</label>
						<div class="form-error error-f-acceptance"></div>
					</div>

					<div class="col-md-12 mb-3 mb-md-4">
						<label for="f-legal" class="checkbox">
							<input type="checkbox" name="f-legal" id="f-legal">
							<span>@lang('form_label_legals_1') <a href="{{url($lang.'/bases-legales')}}" target="_blank" >@lang('form_label_legals_2')</a></span>
						</label>
						<div class="form-error error-f-legal"></div>
					</div>

					<div class="text-center col-md-12 mb-3 mt-4">
						<input type="hidden" name="f-lang" id="f-lang" value="{{$lang}}">
						<button id="submit" class="btn btn-primary w-100 transition">@lang('form_text_submit')</button>
					</div>

				</div>
			</form>

		</div>
	</div>
</div>






@include('sections.footer')



<script src={{ asset('assets/vendor/input-mask/jquery.mask.min.js') }}></script>
<script src={{ asset('assets/vendor/dropzone/min/dropzone.min.js') }}></script>
<script src={{ asset('assets/vendor/jquery.date-dropdowns.js') }}></script>
<script src={{ asset('assets/js/main.js') }}></script>

</body>
</html>
