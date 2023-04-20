@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' Premios')

@section('page_header')
	<div class="container-fluid">
		<h1 class="page-title">
			<i class="voyager-gift"></i> Premios
		</h1>

		<a class="btn btn-primary" href="{{route('prizes_report_pdf')}}" download>Descargar resumen PDF</a>
		<a class="btn btn-primary" href="{{route('prizes_report_csv')}}" download>Descargar resumen CSV</a>

		@include('voyager::multilingual.language-selector')
	</div>
@stop

@section('content')
	<div class="page-content browse container-fluid">
		@include('voyager::alerts')

		@if( isset($prizes) )
			<div class="panel panel-bordered">
				<div class="panel-body">

					<div class="table-responsive">
						<table id="dataTable" class="table table-hover dataTable no-footer">
							<thead>
								<tr>
									<th>#</th>
									<th>Premio</th>
									<th>Fecha / Hora</th>
									<th>Asignado</th>
								</tr>
							</thead>
							<tbody>

							@foreach($prizes as $prize)
								<tr>
									<td>
										<div>
											<strong>{{ $prize->id }}</strong>
										</div>
									</td>
									<td>
										<div>
											<strong>{{ $prize->name }}</strong>
										</div>
									</td>
									<td>
										<div>
											<strong>{{ date('Y-m-d, H:i', strtotime($prize->date)) }}</strong>
										</div>
									</td>
									<td>
										<div>
											@if( $prize->assigned_prize)
												<img src="{{ asset('assets/img/check.svg') }}" class="icon-check">
											@endif
										</div>
									</td>
								</tr>
							@endforeach

							</tbody>
						</table>
					</div>

				</div>
			</div>
		@else
			<div class="alert alert-info">No existen premios en la base de datos</div>
		@endif

	</div>
@stop

@section('css')
	<style>
		.icon-check{
			width: 18px;
			height: 18px;
			margin: 0 0 0 23px;
		}
	</style>
@stop


@section('javascript')
@stop