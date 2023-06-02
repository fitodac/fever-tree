@extends('voyager::master')

@section('css')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<style>
		.page-title{
			color: #404040;
			text-align: center;
			width: 100%;
			height: auto;
			padding: 0;
			margin: 40px 0 20px;
		}

		.panel{
			padding: 40px;
		}

		#participant-data .section{
			border-bottom: solid 1px #eee;
			padding: 0 0 20px;
			margin: 0 0 25px;
			display: block;
		}

		#participant-data .label{
			color: #404040;
			font-size: .8rem;
			line-height: 1;
			font-weight: 700;
			text-align: left;
			letter-spacing: .5px;
			text-transform: uppercase;
			padding: 0;
			display: inline-block;
		}

		#participant-data .label small{
			font-size: .8rem;
			font-weight: 400;
			line-height: 1.4;
			text-transform: none;
			padding-top: 5px;
			display: block;
		}

		#participant-data .value{
			color: #666;
			font-size: 1.1rem;
			line-height: 1;
			font-weight: 500;
			display: inline-block;
		}

		#participant-data dl{
			margin: 0;
			display: flex;
			flex-flow: row;
			flex-wrap: wrap;
			justify-content: space-between;
			align-items: center;
		}

		#participant-data dl p{
			margin: 0;
		}

		#participant-data span.label{
			margin: 0 0 10px;
			display: block;
		}

		#participant-data span.value{
			display: block;
		}

		#participant-data .img-wrapper{
			display: block;
			position: relative;
		}

		#participant-data .img-wrapper::after{
			content: '';
			background: rgba(0,0,0,.3);
			left: 0;
			right: 0;
			top: 0;
			bottom: 0;
			transition: .3s ease-in-out;
			position: absolute;
			opacity: 0;
			z-index: 2;
		}

		#participant-data .img-wrapper .img-zoom{
			width: 32px;
			height: 32px;
			right: 15px;
			top: 15px;
			position: absolute;
			opacity: 0;
			transition: .3s ease-in-out;
			z-index: 10;
		}

		#participant-data .img-wrapper:hover .img-zoom{
			opacity: .8;
		}

		#participant-data .img-wrapper:hover::after{
			opacity: 1;
		}

		#participant-data .img-wrapper .img-zoom img{
			width: 100%;
			height: 100%;
			position: relative;
			z-index: 1;
		}

		#participant-data .btn-check label{
			position: relative;
		}

		#participant-data .btn-check input{
			visibility: hidden;
			position: absolute;
		}

		#participant-data .btn-check span{
			background: url("{{ asset('assets/img/toggle-off.svg') }}") no-repeat center / 45px;
			width: 45px;
			height: 22px;
			display: block;
			cursor: pointer;
		}

		#participant-data .btn-check #check-1:checked + span{
			background-image: url("{{ asset('assets/img/toggle-on.svg') }}");
		}

		#participant-data .btn-check #check-2:checked + span{
			background-image: url("{{ asset('assets/img/toggle-danger.svg') }}");
		}

		#participant-data .icon-check{
			width: 30px;
			height: 30px;
		}

		.btn-sm{
			padding: 4px 20px;
			font-size: 13px;
		}

		.btn-primary.btn-outline{
			background: #fff;
			border: solid 1px #888 !important;
			color: #888 !important;
			border-radius: 1000px;
		}

		.btn-primary.btn-outline:hover,
		.btn-primary.btn-outline:active,
		.btn-primary.btn-outline:focus,
		.btn-primary.btn-outline:active:focus{
			background: #888 !important;
			color: #fff !important;
			border-color: #888 !important;
		}
	</style>
@stop


@section('page_title', __('voyager::generic.view').' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')
	<h1 class="page-title">
		<i class="{{ $dataType->icon }}"></i> {{ __('voyager::generic.viewing') }} {{ ucfirst($dataType->getTranslatedAttribute('display_name_singular')) }} &nbsp;
	</h1>

	<div class="text-center" style="margin-bottom: 20px;">
		@can('edit', $dataTypeContent)
			<a href="{{ route('voyager.'.$dataType->slug.'.edit', $dataTypeContent->getKey()) }}" class="btn btn-info">
				<span class="glyphicon glyphicon-pencil"></span>&nbsp;
				{{ __('voyager::generic.edit') }}
			</a>
		@endcan
		@can('delete', $dataTypeContent)
			@if($isSoftDeleted)
				<a href="{{ route('voyager.'.$dataType->slug.'.restore', $dataTypeContent->getKey()) }}" title="{{ __('voyager::generic.restore') }}" class="btn btn-default restore" data-id="{{ $dataTypeContent->getKey() }}" id="restore-{{ $dataTypeContent->getKey() }}">
					<i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">{{ __('voyager::generic.restore') }}</span>
				</a>
			@else
				<a href="javascript:;" title="{{ __('voyager::generic.delete') }}" class="btn btn-danger delete" data-id="{{ $dataTypeContent->getKey() }}" id="delete-{{ $dataTypeContent->getKey() }}">
					<i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">{{ __('voyager::generic.delete') }}</span>
				</a>
			@endif
		@endcan
		@can('browse', $dataTypeContent)
			<a href="{{ route('voyager.'.$dataType->slug.'.index') }}" class="btn btn-warning">
				<span class="glyphicon glyphicon-list"></span>&nbsp;
				{{ __('voyager::generic.return_to_list') }}
			</a>
		@endcan
	</div>

	@include('voyager::multilingual.language-selector')
@stop

@section('content')
	<div class="page-content read container-fluid">
		<div class="row">
			<div class="col-sm-2 col-md-3"></div>


			<div class="col-sm-8 col-md-6">

				<div id="participant-data" class="panel panel-bordered">
					<!-- form start -->
					@foreach($dataType->readRows as $row)
						@php
							if ($dataTypeContent->{$row->field.'_read'}) {
									$dataTypeContent->{$row->field} = $dataTypeContent->{$row->field.'_read'};
							}
						@endphp

						{{-- imagen --}}
						@if( 'ticket' == $row->field )
							<div class="section">
								<span class="label">{{ $row->display_name }}</span>
								<a href="{{ asset($dataTypeContent[$row->field]) }}" target="_blank" class="img-wrapper">
									<span class="img-zoom"><img src="{{ asset('assets/img/image-zoom.svg') }}" alt=""></span>
									<img src="{{ asset($dataTypeContent[$row->field]) }}" alt="" class="img-responsive">
								</a>
							</div>


						{{-- estado --}}
						@elseif( 'status' == $row->field )
							<div class="section">
								<dl>
									@if( !$dataTypeContent[$row->field] )
										<dt class="label">{{ $row->display_name }}</dt>
										<dd><p>Sin resolver</p></dd>
									@else
										<dt class="label">{{ $row->display_name }}</dt>
										<dd>
											@if( 1 == $dataTypeContent[$row->field] )
												<img src="{{ asset('assets/img/check.svg') }}" class="icon-check">
											@elseif( 2 == $dataTypeContent[$row->field] )
												<img src="{{ asset('assets/img/check-danger.svg') }}" class="icon-check">
											@endif
										</dd>
									@endif
								</dl>
							</div>


						{{-- ...todo lo demás --}}
						@else
							<div class="section">
							<dl>
								<dt>
									<span class="label">{{ $row->getTranslatedAttribute('display_name') }}</span>
								</dt>

								<dd>
									@if (isset($row->details->view))
										@include($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'action' => 'read', 'view' => 'read', 'options' => $row->details])
									@elseif($row->type == "image")
										<img class="img-responsive"
												 src="{{ filter_var($dataTypeContent->{$row->field}, FILTER_VALIDATE_URL) ? $dataTypeContent->{$row->field} : Voyager::image($dataTypeContent->{$row->field}) }}">
									@elseif($row->type == 'multiple_images')
										@if(json_decode($dataTypeContent->{$row->field}))
											@foreach(json_decode($dataTypeContent->{$row->field}) as $file)
												<img class="img-responsive"
														 src="{{ filter_var($file, FILTER_VALIDATE_URL) ? $file : Voyager::image($file) }}">
											@endforeach
										@else
											<img class="img-responsive"
													 src="{{ filter_var($dataTypeContent->{$row->field}, FILTER_VALIDATE_URL) ? $dataTypeContent->{$row->field} : Voyager::image($dataTypeContent->{$row->field}) }}">
										@endif
									@elseif($row->type == 'relationship')
										@include('voyager::formfields.relationship', ['view' => 'read', 'options' => $row->details])
									@elseif($row->type == 'select_dropdown' && property_exists($row->details, 'options') &&
													!empty($row->details->options->{$dataTypeContent->{$row->field}})
									)
										<?php echo $row->details->options->{$dataTypeContent->{$row->field}};?>
									@elseif($row->type == 'select_multiple')
										@if(property_exists($row->details, 'relationship'))

											@foreach(json_decode($dataTypeContent->{$row->field}) as $item)
												{{ $item->{$row->field}  }}
											@endforeach

										@elseif(property_exists($row->details, 'options'))
											@if (!empty(json_decode($dataTypeContent->{$row->field})))
												@foreach(json_decode($dataTypeContent->{$row->field}) as $item)
													@if (@$row->details->options->{$item})
														{{ $row->details->options->{$item} . (!$loop->last ? ', ' : '') }}
													@endif
												@endforeach
											@else
												{{ __('voyager::generic.none') }}
											@endif
										@endif
									@elseif($row->type == 'date' || $row->type == 'timestamp')
										@if ( property_exists($row->details, 'format') && !is_null($dataTypeContent->{$row->field}) )
											{{ \Carbon\Carbon::parse($dataTypeContent->{$row->field})->formatLocalized($row->details->format) }}
										@else
											{{ $dataTypeContent->{$row->field} }}
										@endif
									@elseif($row->type == 'checkbox')
										@if(property_exists($row->details, 'on') && property_exists($row->details, 'off'))
											@if($dataTypeContent->{$row->field})
												<span class="label label-info">{{ $row->details->on }}</span>
											@else
												<span class="label label-primary">{{ $row->details->off }}</span>
											@endif
										@else
											{{ $dataTypeContent->{$row->field} }}
										@endif
									@elseif($row->type == 'color')
										<span class="badge badge-lg" style="background-color: {{ $dataTypeContent->{$row->field} }}">{{ $dataTypeContent->{$row->field} }}</span>
									@elseif($row->type == 'coordinates')
										@include('voyager::partials.coordinates')
									@elseif($row->type == 'rich_text_box')
										@include('voyager::multilingual.input-hidden-bread-read')
										{!! $dataTypeContent->{$row->field} !!}
									@elseif($row->type == 'file')
										@if(json_decode($dataTypeContent->{$row->field}))
											@foreach(json_decode($dataTypeContent->{$row->field}) as $file)
												<a href="{{ Storage::disk(config('voyager.storage.disk'))->url($file->download_link) ?: '' }}">
													{{ $file->original_name ?: '' }}
												</a>
												<br/>
											@endforeach
										@else
											<a href="{{ Storage::disk(config('voyager.storage.disk'))->url($row->field) ?: '' }}">
												{{ __('voyager::generic.download') }}
											</a>
										@endif
									@else
										@include('voyager::multilingual.input-hidden-bread-read')
										<p>{{ $dataTypeContent->{$row->field} }}</p>
									@endif
								</dd>
							</dl>
							</div>
						@endif

					@endforeach

				</div>
			</div>
		</div>
	</div>

	{{-- Single delete modal --}}
	<div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><i class="voyager-trash"></i> {{ __('voyager::generic.delete_question') }} {{ strtolower($dataType->getTranslatedAttribute('display_name_singular')) }}?</h4>
				</div>
				<div class="modal-footer">
					<form action="{{ route('voyager.'.$dataType->slug.'.index') }}" id="delete_form" method="POST">
						{{ method_field('DELETE') }}
						{{ csrf_field() }}
						<input type="submit" class="btn btn-danger pull-right delete-confirm"
									 value="{{ __('voyager::generic.delete_confirm') }} {{ strtolower($dataType->getTranslatedAttribute('display_name_singular')) }}">
					</form>
					<button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
@stop

@section('javascript')
	@if ($isModelTranslatable)
		<script>
			$(document).ready(function () {
				$('.side-body').multilingual();
			});
		</script>
	@endif
	<script>
		var deleteFormAction;
		$('.delete').on('click', function (e) {
			var form = $('#delete_form')[0];

			if (!deleteFormAction) {
				// Save form action initial value
				deleteFormAction = form.action;
			}

			form.action = deleteFormAction.match(/\/[0-9]+$/)
					? deleteFormAction.replace(/([0-9]+$)/, $(this).data('id'))
					: deleteFormAction + '/' + $(this).data('id');

			$('#delete_modal').modal('show');
		});

	</script>
@stop
