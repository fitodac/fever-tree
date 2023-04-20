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
	<h2 class="text-center my-5 mb-5">@lang('legal_warning_title')</h2>
	<h3 class="text-center my-5 mb-5">@lang('legal_warning_subtitle')</h3>

	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="font-light">
				<div class="mb-5">
					<h4>@lang('legal_warning_sec_1')</h4>
					@lang('legal_warning_sec_1_content')
				</div>

				<div class="mb-5">
					<h4>@lang('legal_warning_sec_2')</h4>
					@lang('legal_warning_sec_2_content')
				</div>

				<div class="mb-5">
					<h4>@lang('legal_warning_sec_3')</h4>
					@lang('legal_warning_sec_3_content')
				</div>

				<div class="mb-5">
					<h4>@lang('legal_warning_sec_4')</h4>
					@lang('legal_warning_sec_4_content')
				</div>

				<div class="mb-5">
					<h4>@lang('legal_warning_sec_5')</h4>
					@lang('legal_warning_sec_5_content')
				</div>

				<div class="mb-5">
					<h4>@lang('legal_warning_sec_6')</h4>
					@lang('legal_warning_sec_6_content')
				</div>

				<div class="mb-5">
					<h4>@lang('legal_warning_sec_7')</h4>
					@lang('legal_warning_sec_7_content')
				</div>

				<div class="table-responsive mb-4">
					<table class="table">
						<thead>
							<tr>
								@foreach( __('legal_warning_sec_7_table')['head'] as $th )
									<th>{!! $th !!}</th>
								@endforeach
							</tr>
						</thead>

						<tbody>
							@foreach( __('legal_warning_sec_7_table')['body'] as $td )
								<tr>
									@if( isset($td[0]) )
									<td
										@if($td[0]['colspan']) colspan="{{ $td[0]['colspan'] }}" @endif
										@if($td[0]['rowspan']) rowspan="{{ $td[0]['rowspan'] }}" @endif
										class="{{ $td[0]['class'] }}">{!! $td[0]['content'] !!}</td>
									@endif

									@if( isset($td[1]) )
									<td
										@if($td[1]['colspan']) colspan="{{ $td[1]['colspan'] }}" @endif
										@if($td[1]['rowspan']) rowspan="{{ $td[1]['rowspan'] }}" @endif
										class="{{ $td[1]['class'] }}">{!! $td[1]['content'] !!}</td>
									@endif

									@if( isset($td[2]) )
									<td
										@if($td[2]['colspan']) colspan="{{ $td[2]['colspan'] }}" @endif
										@if($td[2]['rowspan']) rowspan="{{ $td[2]['rowspan'] }}" @endif
										class="{{ $td[2]['class'] }}">{!! $td[2]['content'] !!}</td>
									@endif
								</tr>
							@endforeach
						</tbody>
					</table>


					<style>
						table.table tbody tr td{
							border: solid 1px #ddd;
							vertical-align: middle;
						}

						table.table tbody tr td.border-right{
							border-right: solid 2px #ddd;
						}
					</style>
				</div>

				<div class="mb-5">
					@lang('legal_warning_sec_7_content_2')
				</div>





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