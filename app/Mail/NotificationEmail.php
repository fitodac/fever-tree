<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App;

class NotificationEmail extends Mailable
{
    use Queueable, SerializesModels;

	public $data;


	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct($data)
	{
		$this->data = $data;
	}


	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{

		App::setlocale($this->data->ticket->lang);

		if( 1 == $this->data->ticket->status ){

			if( $this->data->ticket->prize ){
				$subject = __('email_win_subject');

				return $this->from(env('MAIL_SENDER'))
					->subject($subject)
					->view('mails.notification_winners');
			}


			if( !$this->data->ticket->prize ){
				$subject = __('email_lose_title');

				return $this->from(env('MAIL_SENDER'))
					->subject($subject)
					->view('mails.notification_lose');
			}

		}else{

			$subject = __('email_notvalid_title');

			return $this->from(env('MAIL_SENDER'))
				->subject($subject)
				->view('mails.notification_notvalid');

		}


	}
}
