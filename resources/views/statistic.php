<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Router Pulse - Statistics</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="/css/style.css">
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="container-fluid">
		<h1>Statistics</h1>
		<div class="row">
			<table class="table">
				<?php foreach ($sessions as $day => $items) { ?>
				<tr>
					<td class="col-md-1"><?php echo $day; ?></td>
					<td class="col-md-11">
						<div class="graph">
							<div class="day">
								<?php foreach ($items as $item) { ?>
									<?php
									$tooltip = $item->session_started->format('H:i') . ' - ' . $item->session_ended->format('H:i');

									$class = 'online';

									if ($item->isp1) {
										$class .= ' isp1';
										$text = 'P1';
									}
									if ($item->isp2) {
										$class .= ' isp2';
										$text = 'P2';
									}
									if ($item->isp1 && $item->isp2) {
										$text = '';
									}
									?>
									<div class="<?php echo $class; ?>" style="left: <?php echo $item->percent_start ?>%; width: <?php echo $item->percent_width ?>%;" data-toggle="tooltip" data-placement="bottom" title="<?php echo $tooltip; ?>"><?php echo $text; ?></div>
								<?php } ?>
							</div>
							<?php for ($i = 0; $i < 24; $i++) { ?>
								<div class="axis"><?php echo $i ?></div>
							<?php } ?>
						</div>
					</td>
				</tr>
				<?php } ?>
			</table>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script>
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
	</script>
</body>
</html>