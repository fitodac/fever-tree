<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class DownloadTicketsReport extends Controller
{


	/**
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\StreamedResponse
	 */
	public function getCSVReport(Request $request){
		$fileName = 'fever-tree_reporte-de-jugadas.csv';
		$tickets = Ticket::all();


		$headers = array(
			"Content-type"        => "text/csv",
			"Content-Disposition" => "attachment; filename=$fileName",
			"Pragma"              => "no-cache",
			"Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
			"Expires"             => "0"
		);

		$columns = array('ID', 'Nombre', 'Email', 'Teléfono', 'DNI', 'Cumpleaños', 'Idioma');

		$callback = function() use($tickets, $columns) {
			$file = fopen('php://output', 'w');
			fputcsv($file, $columns);

			foreach( $tickets as $ticket ){
				$row['ID'] = $ticket->id;
				$row['Nombre'] = "$ticket->name $ticket->lastname";
				$row['Email'] = $ticket->email;
				$row['Teléfono'] = $ticket->phone;
				$row['DNI'] = $ticket->dni;
				$row['Cumpleaños'] = $ticket->birthday;
				$row['Idioma'] = $ticket->lang;

				fputcsv($file, array(
					$row['ID'],
					$row['Nombre'],
					$row['Email'],
					$row['Teléfono'],
					$row['DNI'],
					$row['Cumpleaños'],
					$row['Idioma']
				));
			}

			fclose($file);
		};

		return response()->stream($callback, 200, $headers);
	}


}
