@php
	$edit = !is_null($dataTypeContent->getKey());
	$add  = is_null($dataTypeContent->getKey());
@endphp

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

@section('page_title', __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')
	<h1 class="page-title">
		<i class="{{ $dataType->icon }}"></i>
		{{ __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular') }}
	</h1>
	@include('voyager::multilingual.language-selector')
@stop

@section('content')
	<div class="page-content edit-add container-fluid">
		<div class="row">
			<div class="col-sm-2 col-md-3"></div>

			<div class="col-sm-8 col-md-6">

				<div class="panel panel-bordered">
					<!-- form start -->
					<form
						role="form"
						class="form-edit-add"
						action="{{ $edit ? route('voyager.'.$dataType->slug.'.update', $dataTypeContent->getKey()) : route('voyager.'.$dataType->slug.'.store') }}"
						method="POST" enctype="multipart/form-data">
						<!-- PUT Method if we are editing -->
					@if($edit)
						{{ method_field("PUT") }}
					@endif

						<!-- CSRF TOKEN -->
						{{ csrf_field() }}

						<div class="panel-body">

							@if (count($errors) > 0)
								<div class="alert alert-danger">
									<ul>
										@foreach ($errors->all() as $error)
											<li>{{ $error }}</li>
										@endforeach
									</ul>
								</div>
							@endif

						<!-- Adding / Editing -->
							@php
								$dataTypeRows = $dataType->{($edit ? 'editRows' : 'addRows' )};
							@endphp


							<div id="participant-data">
							@foreach($dataTypeRows as $row)

								<!-- GET THE DISPLAY OPTIONS -->

								@if( 'ticket' == $row->field )
									<div class="section">
										<span class="label">{{ $row->display_name }}</span>
										<a href="{{ asset($dataTypeContent[$row->field]) }}" target="_blank" class="img-wrapper">
											<span class="img-zoom"><img src="{{ asset('assets/img/image-zoom.svg') }}" alt=""></span>
											<img src="{{ asset($dataTypeContent[$row->field]) }}" alt="" class="img-responsive">
										</a>
									</div>

								@elseif( 'status' == $row->field )
									<div class="section">

										@if( !$dataTypeContent[$row->field] )
										<span class="label">{{ $row->display_name }}</span>
										<input type="radio" name="{{ $row->field }}" value="0" id="check-0" style="visibility:hidden;" checked>

										<dl>
											<dt class="label">Confirmar</dt>
											<dd class="btn-check">
												<label for="check-1">
													<input type="radio" name="{{ $row->field }}" value="1" id="check-1">
													<span/>
												</label>
											</dd>
										</dl>

										<dl>
											<dt class="label">No válido</dt>
											<dd class="btn-check">
												<label for="check-2">
													<input type="radio" name="{{ $row->field }}" value="2" id="check-2">
													<span/>
												</label>
											</dd>
										</dl>

										<dl>
											<dt> </dt>
											<dd>
												<button data-uncheck="#check-1, #check-2" data-check="#check-0" class="uncheck btn btn-primary btn-outline btn-sm">Desmarcar</button>
											</dd>
										</dl>

										<p><small>(Esta acción solo podrá realizarse una sola vez)</small></p>
										@else
											<dl>
												<dt class="label">{{ $row->display_name }}</dt>
												<dd>
													@if( 1 == $dataTypeContent[$row->field] )
														<img src="{{ asset('assets/img/check.svg') }}" class="icon-check">
													@elseif( 2 == $dataTypeContent[$row->field] )
														<img src="{{ asset('assets/img/check-danger.svg') }}" class="icon-check">
													@endif
												</dd>
											</dl>
										@endif
									</div>


								@elseif( 'created_at' == $row->field )
									<div class="section">
										<dl>
											<dt class="label">{{ $row->display_name }}</dt>
											<dd class="value">{{ date('d/m/Y', strtotime($dataTypeContent[$row->field])) }}</dd>
										</dl>
										<input type="hidden" name="{{ $row->field }}" value="{{ $dataTypeContent[$row->field] }}" readonly>
									</div>

								@else
									<div class="section">
										<dl>
											<dt class="label">{{ $row->display_name }}</dt>
											<dd class="value">{{ $dataTypeContent[$row->field] }}</dd>
										</dl>
										<input type="hidden" name="{{ $row->field }}" value="{{ $dataTypeContent[$row->field] }}" readonly>
									</div>
								@endif


								{{--
								@php
									$display_options = $row->details->display ?? NULL;
									if ($dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')}) {
											$dataTypeContent->{$row->field} = $dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')};
									}
								@endphp
								@if (isset($row->details->legend) && isset($row->details->legend->text))
									<legend class="text-{{ $row->details->legend->align ?? 'center' }}" style="background-color: {{ $row->details->legend->bgcolor ?? '#f0f0f0' }};padding: 5px;">{{ $row->details->legend->text }}</legend>
								@endif

								<div class="form-group @if($row->type == 'hidden') hidden @endif col-md-{{ $display_options->width ?? 12 }} {{ $errors->has($row->field) ? 'has-error' : '' }}" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
									{{ $row->slugify }}
									<label class="control-label" for="name">{{ $row->getTranslatedAttribute('display_name') }}</label>
									@include('voyager::multilingual.input-hidden-bread-edit-add')
									@if (isset($row->details->view))
										@include($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'action' => ($edit ? 'edit' : 'add'), 'view' => ($edit ? 'edit' : 'add'), 'options' => $row->details])
									@elseif ($row->type == 'relationship')
										@include('voyager::formfields.relationship', ['options' => $row->details])
									@else
										{!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
									@endif

									@foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
										{!! $after->handle($row, $dataType, $dataTypeContent) !!}
									@endforeach
									@if ($errors->has($row->field))
										@foreach ($errors->get($row->field) as $error)
											<span class="help-block">{{ $error }}</span>
										@endforeach
									@endif
								</div>
								--}}
							@endforeach
							</div>

						</div><!-- panel-body -->

						<div class="panel-footer">
							@if( !$dataTypeContent['status'] )
								@section('submit-buttons')
									<button type="submit" class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
								@stop
								@yield('submit-buttons')
							@else
								<a href="/go4more/tickets" class="btn btn-dark">Volver a la lista</a>
							@endif
						</div>
					</form>

					<iframe id="form_target" name="form_target" style="display:none"></iframe>
					<form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
								enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
						<input name="image" id="upload_file" type="file"
									 onchange="$('#my_form').submit();this.value='';">
						<input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
						{{ csrf_field() }}
					</form>

				</div>
			</div>
		</div>
	</div>

	<div class="modal fade modal-danger" id="confirm_delete_modal">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
									aria-hidden="true">&times;</button>
					<h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}</h4>
				</div>

				<div class="modal-body">
					<h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
					<button type="button" class="btn btn-danger" id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
				</div>
			</div>
		</div>
	</div>
	<!-- End Delete File Modal -->
@stop



@section('javascript')
	<script>
		var params = {};
		var $file;

		function deleteHandler(tag, isMulti) {
			return function() {
				$file = $(this).siblings(tag);

				params = {
					slug:   '{{ $dataType->slug }}',
					filename:  $file.data('file-name'),
					id:     $file.data('id'),
					field:  $file.parent().data('field-name'),
					multi: isMulti,
					_token: '{{ csrf_token() }}'
				}

				$('.confirm_delete_name').text(params.filename);
				$('#confirm_delete_modal').modal('show');
			};
		}

		$('document').ready(function () {
			$('.toggleswitch').bootstrapToggle();

			//Init datepicker for date fields if data-datepicker attribute defined
			//or if browser does not handle date inputs
			$('.form-group input[type=date]').each(function (idx, elt) {
				if (elt.hasAttribute('data-datepicker')) {
					elt.type = 'text';
					$(elt).datetimepicker($(elt).data('datepicker'));
				} else if (elt.type != 'date') {
					elt.type = 'text';
					$(elt).datetimepicker({
						format: 'L',
						extraFormats: [ 'YYYY-MM-DD' ]
					}).datetimepicker($(elt).data('datepicker'));
				}
			});

			@if ($isModelTranslatable)
			$('.side-body').multilingual({"editing": true});
			@endif

			$('.side-body input[data-slug-origin]').each(function(i, el) {
				$(el).slugify();
			});

			$('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
			$('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
			$('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
			$('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));

			$('#confirm_delete').on('click', function(){
				$.post('{{ route('voyager.'.$dataType->slug.'.media.remove') }}', params, function (response) {
					if ( response
							&& response.data
							&& response.data.status
							&& response.data.status == 200 ) {

						toastr.success(response.data.message);
						$file.parent().fadeOut(300, function() { $(this).remove(); })
					} else {
						toastr.error("Error removing file.");
					}
				});

				$('#confirm_delete_modal').modal('hide');
			});
			$('[data-toggle="tooltip"]').tooltip();


			/**
			 * Desmarca los checks al clieckear el botón DESMARCAR
			 */
			$('.uncheck').on('click', function(e){
				e.preventDefault();
				let _uncheck = $(this).data('uncheck'),
						_check = $(this).data('check');

				if( _uncheck ) _uncheck = _uncheck.replace(/ /g,'').split(',');
				if( _check ) _check = _check.replace(/ /g,'').split(',');

				$.map(_uncheck, function(val){ $(val)[0].checked = false; });
				$.map(_check, function(val){ $(val)[0].checked = true; });
			});
		});
	</script>
@stop
