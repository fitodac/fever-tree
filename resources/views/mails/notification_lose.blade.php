<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
				content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>

<div style="background:#fcfcfc; color:#000; font-family:sans-serif; font-size:15px; line-height:1.4;">
	<table cellpadding="0" cellspacing="0" style="background:#333; width:100%; height:100%; padding:50px 0; text-align:center;">
		<tbody>
			<tr>
				<td>

					<table cellpadding="0" cellspacing="0" style="width:580px; height:500px; margin:0 auto;">
						<tbody>
							<tr>

								<td style="background:#000; color:#fff; width:310px; padding:40px 30px;">
									<table>
										<tr>
											<td style="text-align:center;">
												<img src="{{asset('/assets/img/email-brand.jpg')}}" alt="Fever-Tree" width="110" height="45" style="margin-bottom:20px;" />
											</td>
										</tr>

										<tr>
											<td style="text-align:center;">
												<h1 style="color:#B59D60; font-family:'Trebuchet MS', sans-serif; font-weight:300; font-size:26px; line-height:1.2; text-transform:uppercase; margin-bottom:20px;">
													@lang('email_lose_title')
												</h1>
											</td>
										</tr>

										<tr>
											<td style="text-align:center;">
												<p style="font-family:'Trebuchet MS', sans-serif; font-size:15px; font-weight:300; line-height:1.5; letter-spacing:.5px; margin-bottom:40px;">
													@lang('email_lose_message')
												</p>
											</td>
										</tr>


										<tr>
											<td style="text-align: center; padding-bottom:40px;">
												<a href="https://packfevertree.es/" style="background:#000; border:solid 1px #fff; display:inline-block; text-transform:uppercase; font-size:12px; padding:8px 30px; color:#fff; text-decoration:none;">@lang('play_again')</a>
											</td>
										</tr>


										<tr>
											<td style="text-align:center;">
												<span style="font-family:sans-serif; font-size:11px; line-height:1; letter-spacing:.5px; display:block;">@lang('email_copy')</span>
											</td>
										</tr>
									</table>
								</td>

								<td style="width:270px;">
									<img src="{{asset('/assets/img/email-lose-image.jpg')}}?v1" alt="picture" width="270" height="700" style="vertical-align:middle;" />
								</td>

							</tr>
						</tbody>
					</table>

				</td>
			</tr>
		</tbody>
	</table>
</div>

</body>
</html>