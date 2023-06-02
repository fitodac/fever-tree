<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
				content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<meta name="description" content="{{ setting('site.description')  }}" />
	<meta name="author" content="Commonpeoplei" />
	<link rel="shortcut icon" href={{ asset("favicon.png") }} />

	<title>{{ setting('site.title')  }}</title>

	<link href={{ asset('assets/css/bootstrap.min.css') }} rel="stylesheet" />
	<link href={{ asset('assets/css/main.css') }} rel="stylesheet" />
</head>
<body>


@include('sections.header')


<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-10 col-xl-8">


			<div class="form-response">
				<div class="brand"></div>

				<h1>@lang('form_submit_success_title')</h1>
				<div class="message">@lang('form_submit_success_message')</div>

				<div class="text-center mt-5">
					<a id="" class="btn" href="{{ url('/'.Config::get('app.locale')) }}">@lang('form_submit_success_btn_text')</a>
				</div>

			</div>


		</div>
	</div>
</div>


@include('sections.footer')


</body>
</html>