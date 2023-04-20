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
	{{--	<link href={{ asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }} rel="stylesheet" />--}}
	<link href={{ asset('assets/css/main.css') }} rel="stylesheet" />
</head>
<body>


@include('sections.header')


<div class="container py-5">
	<h2 class="text-center my-5 mb-5">@lang('legales_title')</h2>
	<h3 class="text-center my-5 mb-5">@lang('legales_subtitle')</h3>

	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="font-light">
				<div class="mb-5">
					<h4>@lang('legales_sec_1')</h4>
					@lang('legales_sec_1_content')
				</div>

				<div class="mb-5">
					<h4>@lang('legales_sec_2')</h4>
					@lang('legales_sec_2_content')
				</div>

				<div class="mb-5">
					<h4>@lang('legales_sec_3')</h4>
					@lang('legales_sec_3_content')
				</div>

				<div class="mb-5">
					<h4>@lang('legales_sec_4')</h4>
					@lang('legales_sec_4_content')
				</div>

				<div class="mb-5">
					<h4>@lang('legales_sec_5')</h4>
					@lang('legales_sec_5_content')
				</div>

				<div class="mb-5">
					<h4>@lang('legales_sec_6')</h4>
					@lang('legales_sec_6_content')
				</div>

				<div class="mb-5">
					<h4>@lang('legales_sec_7')</h4>
					@lang('legales_sec_7_content')
				</div>

				<div class="mb-5">
					<h4>@lang('legales_sec_8')</h4>
					@lang('legales_sec_8_content')
				</div>

				<div class="mb-5">
					<h4>@lang('legales_sec_9')</h4>
					@lang('legales_sec_9_content')
				</div>

				<div class="mb-5">
					<h4>@lang('legales_sec_10')</h4>
					@lang('legales_sec_10_content')
				</div>

				<div class="mb-5">
					<h4>@lang('legales_sec_11')</h4>
					@lang('legales_sec_11_content')
				</div>

				<div class="mb-5">
					<h4>@lang('legales_sec_12')</h4>
					@lang('legales_sec_12_content')
				</div>


				<p>
					<strong><small>@lang('legales_updated')</small></strong>
				</p>


				<div class="my-5 text-center">
					<a href="{{ route('home') }}" class="btn btn-ghost">@lang('back_home')</a>
				</div>

			</div>
		</div>
	</div>

</div>


@include('sections.footer')


</body>
</html>