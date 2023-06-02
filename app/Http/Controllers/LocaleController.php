<?php

namespace App\Http\Controllers;

use App\Mail\NotificationEmail;
use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\Redirect;

//
use App\Models\Ticket;
use Illuminate\Support\Facades\Mail;
//


class LocaleController extends Controller
{

	public function index(Request $request, $lang = 'es', $view = 'index'){
		if( 'es' != $lang and 'ca' != $lang ) return Redirect::route('home.page');
		App::setlocale($lang);
		return view($view, ['lang' => $lang]);
	}



	public function testmail(){
		$t = Ticket::find(1);
		$mailData = [
			'prize' => [ 'name' => 'Nombre del premio' ],
			'ticket' => $t
		];

		Mail::to("fitodac@gmail.com")->send(new NotificationEmail($mailData));
		return $mailData;
	}

}
