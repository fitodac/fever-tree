<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prize;
use App\Models\Ticket;
use App;


class DownloadPrizeReport extends Controller
{


	/**
	 * @param Request $request
	 * @return mixed
	 */
	public function getPDFReport(Request $request){

		$pdf = App::make('dompdf.wrapper');
		$prizes = Prize::all();
		$winners = Ticket::where('prize', '!=', null)->get();


		ob_start();
		require(resource_path().'/pdf/prizes-report.php');
		$html = ob_get_contents();
		ob_get_clean();


		$pdf->setPaper('A4');
		$pdf->loadHtml($html);
		return $pdf->stream('fever-tree_reporte-de-premios.pdf');

	}






	/**
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\StreamedResponse
	 */
	public function getCSVReport(Request $request){
		$fileName = 'fever-tree_reporte-de-premios.csv';
		$prizes = Prize::all();
		$winners = Ticket::where('prize', '!=', null)->get();


		$headers = array(
			"Content-type"        => "text/csv",
			"Content-Disposition" => "attachment; filename=$fileName",
			"Pragma"              => "no-cache",
			"Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
			"Expires"             => "0"
		);

		$columns = array('ID', 'Fecha', 'Premio asignado', 'Nombre', 'Email', 'Teléfono', 'DNI', 'Cumpleaños');

		$callback = function() use($prizes, $columns, $winners) {
			$file = fopen('php://output', 'w');
			fputcsv($file, $columns);

			foreach( $prizes as $prize ){
				$row['ID'] = $prize->id;
				$row['Fecha'] = $prize->date;
				$row['Premio asignado'] = $prize->assigned_prize ? 'si' : 'no';

				foreach( $winners as $winner ){
					if( $winner->prize == $prize->id ){
						$row['Nombre'] = "$winner->name $winner->lastname";
						$row['Email'] = $winner->email;
						$row['Teléfono'] = $winner->phone;
						$row['DNI'] = $winner->dni;
						$row['Cumpleaños'] = $winner->birthday;
					}else{
						$row['Nombre'] = '';
						$row['Email'] = '';
						$row['Teléfono'] = '';
						$row['DNI'] = '';
						$row['Cumpleaños'] = '';
					}
				}

				fputcsv($file, array(
					$row['ID'],
					$row['Fecha'],
					$row['Premio asignado'],
					$row['Nombre'],
					$row['Email'],
					$row['Teléfono'],
					$row['DNI'],
					$row['Cumpleaños']
				));
			}

			fclose($file);
		};

		return response()->stream($callback, 200, $headers);
	}


}
