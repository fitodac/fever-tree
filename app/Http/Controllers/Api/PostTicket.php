<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Ticket;
use App\Models\Winner;



class PostTicket extends Controller
{



	/**
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * Guarda el ticket y lo almacena en la DB
	 */
	public function ticketPost(Request $request){

		// Revisa si el usuario ya ha ganado un premio
		$dni = strtolower($request->dni);
		$dni = preg_replace('/\./', '', $dni);
		$check4Winner = Winner::where('dni', $dni)->exists();


		if( $check4Winner ):

			return response()->json([
				'resp' => false
			]);

		else:

			$img = $request->file('file')->store('public/tickets');
			$img_url = Storage::url($img);

			$data = new Ticket;
			$data->name = strtolower($request->name);
			$data->lastname = strtolower($request->lastname);
			$data->email = strtolower($request->email);
			$data->phone = preg_replace('/\-/', '', $request->phone);
			$data->dni = strtolower($request->dni);
			$data->dni = preg_replace('/\./', '', $request->dni);
			$data->birthday = $request->birthday;
			$data->ticket = $img_url;
			$data->lang = strtolower($request->lang);
			$data->save();

			return response()->json([
				'resp' => true
			]);

		endif;

	}






	public function store(Request $request){

		return response()->json([
			'resp' => $request->file('f_ticket')
		]);


		if( !$data->save() ){
			return response()->json([
				'response' => __('form_submit_error_on_store_data'),
				'type' => "error"
			], 500);
		}


		return response()->json([
			'response' => __('form_submit_success_ok'),
			'type' => "success"
		], 200);

	}

}
