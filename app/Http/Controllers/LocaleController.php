<?php

namespace App\Http\Controllers;

use App\Mail\NotificationEmail;
use Illuminate\Http\Request;
use App;

//
use App\Models\Ticket;
use Illuminate\Support\Facades\Mail;
//


class LocaleController extends Controller
{

	// public function index(Request $request){
	public function index(Request $request, $lang = 'es', $view = 'index'){
		if( 'es' != $lang and 'ca' != $lang ) $lang = 'es';
		App::setlocale($lang);
		return view($view, ['lang' => $lang]);
	}



	public function testmail(){
		$t = Ticket::find(1);
		$mailData = [
			'prize' => [ 'name' => 'Nombre del premio' ],
			'ticket' => $t
		];

		Mail::to("fito@commonpeoplei.com")->send(new NotificationEmail($mailData));
		return $mailData;
	}

}
