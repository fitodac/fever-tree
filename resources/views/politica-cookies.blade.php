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
	<h2 class="text-center my-5 mb-5">@lang('cookies_title')</h2>

	<div class="row justify-content-center">
		<div class="col-md-8">

			<div class="mb-5">
				<h4>@lang('cookies_sec_1')</h4>
				@lang('cookies_sec_1_content')
			</div>


			<div class="mb-5">
				<h4>@lang('cookies_sec_2')</h4>
				@lang('cookies_sec_2_content')
			</div>


			<div class="mb-5">
				<h4>@lang('cookies_sec_3')</h4>
				@lang('cookies_sec_3_content')

				<div class="mb-3">
					<h5>@lang('cookies_sub_sec_3_1')</h5>
					@lang('cookies_sub_sec_3_1_content')
				</div>

				<div class="mb-3">
					<h5>@lang('cookies_sub_sec_3_2')</h5>
					@lang('cookies_sub_sec_3_2_content')
				</div>

				<div class="mb-3">
					<h5>@lang('cookies_sub_sec_3_3')</h5>
					@lang('cookies_sub_sec_3_3_content')
				</div>

				<div class="mb-3">
					<h5>@lang('cookies_sub_sec_3_4')</h5>
					@lang('cookies_sub_sec_3_4_content')
				</div>

				<div class="mb-3">
					<h5>@lang('cookies_sub_sec_3_5')</h5>
					@lang('cookies_sub_sec_3_5_content')
				</div>

				<div class="mb-3">
					<h5>@lang('cookies_sub_sec_3_6')</h5>
					@lang('cookies_sub_sec_3_6_content')
				</div>
			</div>


			<div class="mb-5">
				<h4>@lang('cookies_sec_4')</h4>
				@lang('cookies_sec_4_content')

				<table class="table">
					<thead>
						<tr>
							@foreach( __('cookies_sec_4_table')['head'] as $th )
								<th>{{ $th }}</th>
							@endforeach
						</tr>
					</thead>
					<tbody>
						@foreach( __('cookies_sec_4_table')['body'] as $tr )
							<tr>
								@foreach( $tr as $td )
									<td>{{ $td }}</td>
								@endforeach
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>


			<div class="mb-5">
				<h4>@lang('cookies_sec_5')</h4>
				@lang('cookies_sec_5_content')
			</div>


			<p>
				<strong><small>@lang('cookies_updated')</small></strong>
			</p>


			<div class="my-5 text-center">
				<a href="{{ route('home') }}" class="btn btn-ghost">@lang('back_home')</a>
			</div>


		</div>{{-- col --}}
	</div>{{-- row --}}
</div>{{-- container --}}



@include('sections.footer')


</body>
</html>