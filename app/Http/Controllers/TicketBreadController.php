<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use App\Models\Ticket;
use App\Models\Prize;
use App\Models\Winner;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationEmail;



class TicketBreadController extends VoyagerBaseController
{


	// POST BR(E)AD
	public function update(Request $request, $id)
	{
		$slug = 'tickets';

		$dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

		// Compatibility with Model binding.
		$id = $id instanceof \Illuminate\Database\Eloquent\Model ? $id->{$id->getKeyName()} : $id;

		$model = app($dataType->model_name);
		if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
			$model = $model->{$dataType->scope}();
		}
		if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
			$data = $model->withTrashed()->findOrFail($id);
		} else {
			$data = $model->findOrFail($id);
		}

		// Check permission
		$this->authorize('edit', $data);

		// Validate fields with ajax
		$val = $this->validateBread($request->all(), $dataType->editRows, $dataType->name, $id)->validate();

		if( !$request->status and auth()->user()->can('browse', app($dataType->model_name)) ){
			$redirect = redirect()->back();
			return $redirect->with([
				'message'    => "No se ha realizado ningún cambio en el ticket",
				'alert-type' => 'info',
			]);
		}


		Ticket::whereId($request->id)->update([ 'status' => $request->status ]);


		/**
		 * Si el ticket ha sido desaprobado
		 */
		if( 2 == $request->status ){
			$response_message = "El ticket ha sido desaprobado";
			$response_type = "error";
		}




		/**
		 * Verifica si el ticket ha sido aprobado para buscar por fechas de premios
		 */
		if( 1 == $request->status ):

			// Busca si ese jugador ya ha recibido un premio
			$winnwer_exists = Winner::where('dni', $request->dni)->exists();

			if( $winnwer_exists ):

				// Si no hay premio se le informa que no ha ganado
				$response_message = "El ticket ha sido aprobado, sin embargo, ya ha sido premiado anteriormente";
				$response_type = "info";

			else:

				// Busca los premios con fecha/hora anterior
				$prizes = Prize::where('date', '<=', date('Y-m-d G:i:s', strtotime($request->created_at)))
					->where('assigned_prize', 0)
					->orderBy('date', 'asc')
					->get();



				// Si hay premios disponible se le asigna
				if( count($prizes) ){

					Prize::find($prizes[0]->id)->update(['assigned_prize' => 1]);
					Ticket::whereId($request->id)->update([ 'prize' => $prizes[0]->id ]);

					// Guarda el ganador en la tabla winners
					Winner::create([
						'dni' => $request->dni,
						'ticket_id' => $request->id,
						'prize_id' => $prizes[0]->id
					]);


					$response_message = "El ticket ha sido aprobado con éxito";
					$response_type = "success";


				}else{

					// Si no hay premio se le informa que no ha ganado
					$response_message = "El ticket ha sido aprobado, sin embargo, no tiene premio";
					$response_type = "info";

				}

			endif;
		endif;


		$mailData = (object) ['ticket' => Ticket::find($request->id)];
		Mail::to($mailData->ticket->email)->send(new NotificationEmail($mailData));



		event(new BreadDataUpdated($dataType, $data));

		if (auth()->user()->can('browse', app($dataType->model_name))) {
			$redirect = redirect()->route("voyager.{$dataType->slug}.index");
		} else {
			$redirect = redirect()->back();
		}

		return $redirect->with([
			'message'    => $response_message,
			'alert-type' => $response_type
		]);
	}


}
