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
					<li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
					<li role="presentation"><a href="#smsgate" aria-controls="smsgate" role="tab" data-toggle="tab">SMS gate</a></li>

				</ul>
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="notification">
						<div class="form-group">
							<label class="col-sm-2 control-label"><span class="text-danger">OFFLINE</span> SMS notify</label>
							<div class="col-sm-10">
								<div class="radio">
									<label>
										<input type="radio" name="sms_off_enabled" value="1"<?php echo ($sms_off_enabled == '1' ? ' checked' : '') ?>> Yes
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="sms_off_enabled" value="2"<?php echo ($sms_off_enabled == '2' ? ' checked' : '') ?>> Once
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="sms_off_enabled" value="0"<?php echo ($sms_off_enabled == '0' ? ' checked' : '') ?>> No
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><span class="text-success">ONLINE</span> SMS notify</label>
							<div class="col-sm-10">
								<div class="radio">
									<label>
										<input type="radio" name="sms_on_enabled" value="1"<?php echo ($sms_on_enabled == '1' ? ' checked' : '') ?>> Yes
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="sms_on_enabled" value="2"<?php echo ($sms_on_enabled == '2' ? ' checked' : '') ?>> Once
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="sms_on_enabled" value="0"<?php echo ($sms_on_enabled == '0' ? ' checked' : '') ?>> No
									</label>
								</div>
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="messages">
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
					<div role="tabpanel" class="tab-pane" id="smsgate">
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
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</div>
		</form>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>