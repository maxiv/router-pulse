<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Router Pulse</title>

	<link rel="stylesheet" href="/css/style.css">
</head>
	<body class="<?php echo ($is_internet ? 'ok' : 'no') ?>">
	<div class="container">
		<div class="internet">
			Internet status: <span class="internet <?php echo ($is_internet ? 'ok' : 'no') ?>"><?php echo ($is_internet ? 'ok' : 'no') ?></span>
		</div>

		<div class="last-check">At last check (<?php echo $session_ended ?> / <span id="timer"><?php echo $td; ?></span> seconds ago):</div>
		<div class="isp">
			Provider 1: <span class="internet <?php echo ($is_isp1 ? 'ok' : 'no') ?>"><?php echo ($is_isp1 ? 'ok' : 'no') ?></span>
		</div>
		<div class="isp">
			Provider 2: <span class="internet <?php echo ($is_isp2 ? 'ok' : 'no') ?>"><?php echo ($is_isp2 ? 'ok' : 'no') ?></span>
		</div>
	</div>

	<script>
		var last = <?php echo $td ?>;
		var timer = setInterval(function () {
			last++;
			document.getElementById('timer').innerText = last;
			if (last == 61) {
				location.href = location.href;
			}
		}, 1000);
		setTimeout(function() {
			location.href = location.href;
		}, 60000);
	</script>
</body>
</html>