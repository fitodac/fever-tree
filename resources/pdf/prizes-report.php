<!doctype html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Reporte de premios</title>
	<style>
		body{
			font-family: sans-serif;
			font-size: 14px;
			line-height: 1.6;
			padding: 0;
			margin: 0;
		}

		.container{
			width: 700px;
		}

		.header{
			margin: 0 0 50px;
		}

		.header > div{
			width: 50%;
			float: left;
		}

		.header img{
			width: 140px;
		}

		.header::after{
			content: '';
			clear: both;
			display: block;
		}

		h1{
			font-size: 24px;
			line-height: 1;
		}

		.text-right{
			text-align: right;
		}

		.text-center{
			text-align: center;
		}

		table{
			width: 100%;
			padding: 0;
			margin: 0;
		}

		table tbody .theader td{
			background: #000;
			color: #fff;
			font-size: 13px;
			line-height: 1;
			font-weight: bold;
			letter-spacing: .5px;
			padding: 10px;
		}

		table tbody tr td{
			border-bottom: solid 1px #ddd;
			font-size: 14px;
			vertical-align: top;
			padding: 6px 10px;
		}
	</style>
</head>
<body>

	<div class="container">

		<div class="header">
			<div>
				<img src="http://<?php echo $_SERVER['SERVER_NAME'] ?>/assets/img/brand.jpg" alt="Fever-tree">
			</div>

			<div class="text-right"><h1>Reporte de premios</h1></div>
		</div>

		<table cellspacing="0">
			<tbody>
				<tr class="theader">
					<td><span>#</span></td>
					<td><span>Fecha</span></td>
					<td class="text-center"><span>Ganador</span></td>
				</tr>

				<?php foreach($prizes as $p): ?>
				<tr>
					<td><?php echo $p->id; ?></td>
					<td><?php echo date_format(date_create($p->date), 'd/m/Y, H:i'); ?></td>
					<?php
					if( $p->assigned_prize ):

						foreach( $winners as $winner ):
							if( $p->id == $winner->prize ){
								echo "<td>
												<small>
												$winner->name $winner->lastname<br>
												Email: <strong>$winner->email</strong><br>
												Tel: <strong>$winner->phone</strong><br>
												DNI: <strong>$winner->dni</strong><br>
												Cumpleaños: <strong>$winner->birthday</strong>
												</small>
											</td>";
							}
						endforeach;

					else:

						echo '<td>no</td>';

					endif;
					?>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

	</div>

</body>
</html>