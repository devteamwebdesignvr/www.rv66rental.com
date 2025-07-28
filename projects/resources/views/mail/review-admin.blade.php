<title></title>
<meta http–equiv=“Content-Type” content=“text/html; charset=UTF-8” /><meta http–equiv=“X-UA-Compatible” content=“IE=edge” /><meta name=“viewport” content=“width=device-width, initial-scale=1.0 “ />
<style type="text/css">@media screen {
	@font-face {
		font-family: 'Lato';
		font-style: normal;
		font-weight: 400;
		src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
	}
	body {margin:0px !important; padding:0px !important; display:block !important; min-width:100% !important; width:100% !important; -webkit-text-size-adjust:none;font-family: "Lato", "Lucida Grande", "Lucida Sans Unicode", Tahoma, Sans-Serif;}
	table {border-spacing:0; mso-table-lspace:0pt; mso-table-rspace:0pt;}
	table td {border-collapse: collapse;}
	strong {font-weight: bold !important;}
	td img {-ms-interpolation-mode:bicubic; display:block; width:auto; max-width:auto; height:auto; margin:auto;display:block!important;border:0px!important;}
	td a {text-decoration:none !important;}

	@media only screen and (min-width:481px) and (max-width:699px) {


	}

	@media screen and (max-width: 480px) {



	}
</style>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="width:700px;" width="700">
	<tbody>
		<tr>
			<td align="center" bgcolor="#ffffff" style="padding:15px;" valign="top">
			<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td align="center" valign="top">
						<div><span style="display: block; font-size: 30px; font-weight: 600; margin: 20px 0 10px 0; color: #0b4453;">Review</span></div>
						</td>
					</tr>
				</tbody>
			</table>
			</td>
		</tr>
		<tr>
			<td align="left" bgcolor="#f9f9f9" style="padding:20px;" valign="top">
			<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td align="left" valign="top">
						<h4 style="font-size: 17px; color: #222; font-weight: 600">Hey Jana,</h4>

						<p style=" font-size: 15px; color: #454545; line-height: 24px; font-weight: 400; margin: 0 0 15px 0; text-align: left">Review.</p>

			
						
						<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
							<tbody>
								<tr>
									<th colspan="2" align="center" style="padding: 10px;" valign="top"><strong>Fleet Detail </strong></th>
								</tr>

								<tr>
									<td align="right" style="padding: 10px;" valign="top"><strong>Fleet Name :</strong></td>
									<td align="left" style="padding: 10px;" valign="top">{{$property->name }}</td>
								</tr>
							</tbody>
						</table>
					
						<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
							<tbody>
								<tr>
									<th colspan="2" align="center" style="padding: 10px;" valign="top"><strong>User Detail </strong></th>
								</tr>
								<tr>
									<td align="right" style="padding: 10px;" valign="top"><strong>Name :</strong></td>
									<td align="left" style="padding: 10px;" valign="top">{{$data['name']}}</td>
								</tr>
								<tr>
									<td align="right" style="padding: 10px;" valign="top"><strong>Email :</strong></td>
									<td align="left" style="padding: 10px;" valign="top">{{$data['email']}}</td>
								</tr>
								<tr>
									<td align="right" style="padding: 10px;" valign="top"><strong>Mobile:</strong></td>
									<td align="left" style="padding: 10px;" valign="top">{{$data['mobile']}}</td>
								</tr>
								<tr>
									<td align="right" style="padding: 10px;" valign="top"><strong>Message :</strong></td>
									<td align="left" style="padding: 10px;" valign="top">
										<pre>{{$data['message']}}</pre>
									</td>
								</tr>
								@if($data['rental_aggrement_signature'])
								<tr>
									<td align="right" style="padding: 10px;" valign="top"><strong>Signature :</strong></td>
									<td align="left" style="padding: 10px;" valign="top">
										<img src="{{asset($data['rental_aggrement_signature'])}}" style="width:160px;height:100px;" />
									</td>
								</tr>
								@endif
								@if($data['rental_aggrement_images'])
								<tr>
									<td align="right" style="padding: 10px;" valign="top"><strong>Image :</strong></td>
									<td align="left" style="padding: 10px;" valign="top">
										<img src="{{asset($data['rental_aggrement_images'])}}" style="width:160px;height:100px;" />
									</td>
								</tr>
								@endif
							</tbody>
						</table>
						@include("mail.booking-common-data")
						</td>
					</tr>
				</tbody>
			</table>
			</td>
		</tr>
		<tr>
			<td align="center" bgcolor="#ffffff" style="padding:15px;" valign="top">
			<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td align="center" valign="top">
						<div><span style="display: block; font-size: 16px; font-weight: 600; margin: 0px 0 10px 0; color: #222222;">Thanks for reading!</span></div>

						<p style=" font-size: 14px; color: #454545; line-height: 24px; font-weight: 400; margin: 0 0 5px 0;">{!! ModelHelper::getDataFromSetting('mail_footer') !!}</p>
						</td>
					</tr>
				</tbody>
			</table>
			</td>
		</tr>
	</tbody>
</table>
