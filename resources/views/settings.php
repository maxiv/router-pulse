<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Router Pulse - Settings</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="/css/style.css">
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="container">
		<h1>Settings</h1>

		<?php if (Session::has('success')) { ?>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<strong>
				<i class="fa fa-check-circle fa-lg fa-fw"></i>
			</strong>
			<?php echo Session::get('success'); ?>
		</div>
		<?php } ?>

		<form class="form-horizontal" method="post">
			<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

			<div>
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#notification" aria-controls="notification" role="tab" data-toggle="tab">Notification</a></li>
					<li role="presentation"><a href="#sms" aria-controls="sms" role="tab" data-toggle="tab">SMS</a></li>
					<li role="presentation"><a href="#email" aria-controls="email" role="tab" data-toggle="tab">E-mail</a></li>
					<li role="presentation"><a href="#telegram" aria-controls="telegram" role="tab" data-toggle="tab">Telegram</a></li>
                    <li role="presentation"><a href="#viber" aria-controls="viber" role="tab" data-toggle="tab">Viber</a></li>
				</ul>
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="notification">
						<div class="form-group">
							<div class="col-sm-4">
								<table class="table table-condensed">
									<tr>
										<th width="50%"><span class="text-danger">OFFLINE</span></th>
										<th width="20%">SMS</th>
										<th width="20%">E-mail</th>
                                        <th width="20%">Telegram</th>
                                        <th width="20%">Viber</th>
									</tr>
									<tr>
										<td class="bulk">Yes</td>
										<td>
											<input type="radio" name="sms_off_enabled" value="1"<?php echo ($sms_off_enabled == '1' ? ' checked' : '') ?>>
										</td>
										<td>
											<input type="radio" name="email_off_enabled" value="1"<?php echo ($email_off_enabled == '1' ? ' checked' : '') ?>>
										</td>
										<td>
											<input type="radio" name="telegram_off_enabled" value="1"<?php echo ($telegram_off_enabled == '1' ? ' checked' : '') ?>>
										</td>
                                        <td>
                                            <input type="radio" name="viber_off_enabled" value="1"<?php echo ($viber_off_enabled == '1' ? ' checked' : '') ?>>
                                        </td>
									</tr>
									<tr>
										<td class="bulk">Once</td>
										<td>
											<input type="radio" name="sms_off_enabled" value="2"<?php echo ($sms_off_enabled == '2' ? ' checked' : '') ?>>
										</td>
										<td>
											<input type="radio" name="email_off_enabled" value="2"<?php echo ($email_off_enabled == '2' ? ' checked' : '') ?>>
										</td>
										<td>
											<input type="radio" name="telegram_off_enabled" value="2"<?php echo ($telegram_off_enabled == '2' ? ' checked' : '') ?>>
										</td>
                                        <td>
                                            <input type="radio" name="viber_off_enabled" value="2"<?php echo ($viber_off_enabled == '2' ? ' checked' : '') ?>>
                                        </td>
									</tr>
									<tr>
										<td class="bulk">No</td>
										<td>
											<input type="radio" name="sms_off_enabled" value="0"<?php echo ($sms_off_enabled == '0' ? ' checked' : '') ?>>
										</td>
										<td>
											<input type="radio" name="email_off_enabled" value="0"<?php echo ($email_off_enabled == '0' ? ' checked' : '') ?>>
										</td>
										<td>
											<input type="radio" name="telegram_off_enabled" value="0"<?php echo ($telegram_off_enabled == '0' ? ' checked' : '') ?>>
										</td>
                                        <td>
                                            <input type="radio" name="viber_off_enabled" value="0"<?php echo ($viber_off_enabled == '0' ? ' checked' : '') ?>>
                                        </td>
									</tr>
								</table>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4">
								<table class="table table-condensed">
									<tr>
										<th width="50%"><span class="text-success">ONLINE</span></th>
										<th width="25%">SMS</th>
										<th width="25%">E-mail</th>
										<th width="25%">Telegram</th>
                                        <th width="25%">Viber</th>
									</tr>
									<tr>
										<td class="bulk">Yes</td>
										<td>
											<input type="radio" name="sms_on_enabled" value="1"<?php echo ($sms_on_enabled == '1' ? ' checked' : '') ?>>
										</td>
										<td>
											<input type="radio" name="email_on_enabled" value="1"<?php echo ($email_on_enabled == '1' ? ' checked' : '') ?>>
										</td>
										<td>
											<input type="radio" name="telegram_on_enabled" value="1"<?php echo ($telegram_on_enabled == '1' ? ' checked' : '') ?>>
										</td>
                                        <td>
                                            <input type="radio" name="viber_on_enabled" value="1"<?php echo ($viber_on_enabled == '1' ? ' checked' : '') ?>>
                                        </td>
									</tr>
									<tr>
										<td class="bulk">Once</td>
										<td>
											<input type="radio" name="sms_on_enabled" value="2"<?php echo ($sms_on_enabled == '2' ? ' checked' : '') ?>>
										</td>
										<td>
											<input type="radio" name="email_on_enabled" value="2"<?php echo ($email_on_enabled == '2' ? ' checked' : '') ?>>
										</td>
										<td>
											<input type="radio" name="telegram_on_enabled" value="2"<?php echo ($telegram_on_enabled == '2' ? ' checked' : '') ?>>
										</td>
                                        <td>
                                            <input type="radio" name="viber_on_enabled" value="2"<?php echo ($viber_on_enabled == '2' ? ' checked' : '') ?>>
                                        </td>
									</tr>
									<tr>
										<td class="bulk">No</td>
										<td>
											<input type="radio" name="sms_on_enabled" value="0"<?php echo ($sms_on_enabled == '0' ? ' checked' : '') ?>>
										</td>
										<td>
											<input type="radio" name="email_on_enabled" value="0"<?php echo ($email_on_enabled == '0' ? ' checked' : '') ?>>
										</td>
										<td>
											<input type="radio" name="telegram_on_enabled" value="0"<?php echo ($telegram_on_enabled == '0' ? ' checked' : '') ?>>
										</td>
                                        <td>
                                            <input type="radio" name="viber_on_enabled" value="0"<?php echo ($viber_on_enabled == '0' ? ' checked' : '') ?>>
                                        </td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="sms">
						<div class="form-group">
							<label class="col-sm-2 control-label">SMS gate login:</label>
							<div class="col-sm-10">
								<input type="text" name="sms_login" class="form-control" value="<?php echo $sms_login ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">SMS gate password:</label>
							<div class="col-sm-10">
								<input type="password" name="sms_password" class="form-control" placeholder="Enter, if need to change">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><span class="text-danger">OFFLINE</span> SMS to:</label>
							<div class="col-sm-10">
								<input type="text" name="sms_off_to" class="form-control" placeholder="Enter mobile number" value="<?php echo $sms_off_to; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><span class="text-danger">OFFLINE</span> SMS message:</label>
							<div class="col-sm-10">
								<input type="text" name="sms_off_message" class="form-control" placeholder="Enter message text" value="<?php echo $sms_off_message; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><span class="text-success">ONLINE</span> SMS to:</label>
							<div class="col-sm-10">
								<input type="text" name="sms_on_to" class="form-control" placeholder="Enter mobile number" value="<?php echo $sms_on_to; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><span class="text-success">ONLINE</span> SMS message:</label>
							<div class="col-sm-10">
								<input type="text" name="sms_on_message" class="form-control" placeholder="Enter message text" value="<?php echo $sms_on_message; ?>">
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="email">
						<div class="form-group">
							<label class="col-sm-2 control-label">E-mail from:</label>
							<div class="col-sm-10">
								<input type="text" name="email_from" class="form-control" placeholder="Enter e-mail sender" value="<?php echo $email_from ?>">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label"><span class="text-danger">OFFLINE</span> E-mail to:</label>
							<div class="col-sm-10">
								<input type="text" name="email_off_to" class="form-control" placeholder="Enter e-mail" value="<?php echo $email_off_to; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><span class="text-danger">OFFLINE</span> E-mail subject:</label>
							<div class="col-sm-10">
								<input type="text" name="email_off_subject" class="form-control" placeholder="Enter subject" value="<?php echo $email_off_subject; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><span class="text-danger">OFFLINE</span> E-mail message:</label>
							<div class="col-sm-10">
								<input type="text" name="email_off_message" class="form-control" placeholder="Enter message text" value="<?php echo $email_off_message; ?>">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label"><span class="text-success">ONLINE</span> E-mail to:</label>
							<div class="col-sm-10">
								<input type="text" name="email_on_to" class="form-control" placeholder="Enter e-mail" value="<?php echo $email_on_to; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><span class="text-success">ONLINE</span> E-mail subject:</label>
							<div class="col-sm-10">
								<input type="text" name="email_on_subject" class="form-control" placeholder="Enter subject" value="<?php echo $email_on_subject; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><span class="text-success">ONLINE</span> E-mail message:</label>
							<div class="col-sm-10">
								<input type="text" name="email_on_message" class="form-control" placeholder="Enter message text" value="<?php echo $email_on_message; ?>">
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="telegram">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Telegram bot key:</label>
                            <div class="col-sm-10">
                                <input type="text" name="telegram_bot_key" class="form-control" placeholder="Enter, if need to change">
                            </div>
                        </div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><span class="text-danger">OFFLINE</span> Message to:</label>
							<div class="col-sm-10">
								<input type="text" name="telegram_off_to" class="form-control" placeholder="Enter username" value="<?php echo $telegram_off_to; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><span class="text-danger">OFFLINE</span> Message:</label>
							<div class="col-sm-10">
								<input type="text" name="telegram_off_message" class="form-control" placeholder="Enter message text" value="<?php echo $telegram_off_message; ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label"><span class="text-success">ONLINE</span> Message to:</label>
							<div class="col-sm-10">
								<input type="text" name="telegram_on_to" class="form-control" placeholder="Enter username" value="<?php echo $telegram_on_to; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><span class="text-success">ONLINE</span> Message message:</label>
							<div class="col-sm-10">
								<input type="text" name="telegram_on_message" class="form-control" placeholder="Enter message text" value="<?php echo $telegram_on_message; ?>">
							</div>
						</div>
					</div>
                    <div role="tabpanel" class="tab-pane" id="viber">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Viber bot key:</label>
                            <div class="col-sm-10">
                                <input type="text" name="viber_bot_key" class="form-control" placeholder="Enter, if need to change">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="text-danger">OFFLINE</span> Message to:</label>
                            <div class="col-sm-10">
                                <input type="text" name="viber_off_to" class="form-control" placeholder="Enter username" value="<?php echo $viber_off_to; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="text-danger">OFFLINE</span> Message:</label>
                            <div class="col-sm-10">
                                <input type="text" name="viber_off_message" class="form-control" placeholder="Enter message text" value="<?php echo $viber_off_message; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="text-success">ONLINE</span> Message to:</label>
                            <div class="col-sm-10">
                                <input type="text" name="viber_on_to" class="form-control" placeholder="Enter username" value="<?php echo $viber_on_to; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="text-success">ONLINE</span> Message message:</label>
                            <div class="col-sm-10">
                                <input type="text" name="viber_on_message" class="form-control" placeholder="Enter message text" value="<?php echo $viber_on_message; ?>">
                            </div>
                        </div>
                    </div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-4">
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</div>
		</form>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

	<script>
		$(function () {
			$(document).on('click', '.bulk', function () {
				$(this).closest('tr').find('input').prop('checked', true);
			});
		});
	</script>
</body>
</html>