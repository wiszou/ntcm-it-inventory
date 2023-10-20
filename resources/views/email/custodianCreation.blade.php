<!DOCTYPE html>
<html>
<head>
<style type="text/css">
	body{
		font-family: Arial;
		margin: 0px;
		padding: 0px;
	}
	.note{
		color: #FFF;
	    background-color: rgba(98, 163, 207, 0.9);
	    padding-top: 10px;
	    margin-top: 10px;
	    border-radius: 5px;
	}
	.footer{
		color: #f0f0f0;
		background: #004E64;
		width: 100%;
		padding: 15px;
		text-align: center;
	}
	hr{
		color: #c0c0c0;
	}
</style>
</head>
<body>

<table>
	<tr>
		<td>
			<div class="ntcLogo" style="display: inline-block;">
				<img src="https://i.imgur.com/UkxXm0p.png" width="250">
			</div>
		</td>
  </tr>
  <tr>
		<td>
			<h4 style="display:inline-block;text-transform: uppercase; padding-left: 2px; margin-top: 12px;">IT Inventory System Notification</h4>
		</td>
	</tr>
</table>

<p>Good day!</p>
<p>We are pleased to inform you that your Custodian Form has been successfully created. <br/>Below are the details for your reference:</p>

<table style="margin-bottom:1px;">
	<tr>
    <td> <span style="font-weight: bold;">Form ID: </span>{{ $data->custodian_id }}</td>
	</tr>
  <tr>
    <td> <span style="font-weight: bold;">Date Created: </span>{{ $data->start_date }}</td>
	</tr>
  <tr>
    <td> <span style="font-weight: bold;">Purpose: </span>{{ $data->description }}</td>
	</tr>
  <tr>
    <td> <span style="font-weight: bold;">Item/s:</td>
	</tr>
  
  </table>
  <br/>
  <table>
	@foreach ($data2 as $data1)
    <tr>
    <td>{{ $data1->item_id }} - {{ $data1->name }}</td>
	</tr>
	@endforeach
</table>
 <br/>

<br/>
<p><i>To view complete details, please login to <a href="">ntcmanila.com.ph/ntcappsbeta</a>.</i></p>
<hr />
<small><i><b>This is an automated email. Kindly refrain from responding to this message.</b></i></small>
</body>
</html>