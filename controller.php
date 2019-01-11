<?php

$fp = fsockopen("192.168.1.100", 6722, $errno, $errstr, 30);

$opts = array(
	"start_1" => "11",
	"stop_1" => "21",
	"start_2" => "12",
	"stop_2" => "22"
);

if($_POST["action"]) {
	$act = $_POST["action"];
	fwrite($fp, $opts[$act]);
}

fwrite($fp, "00");
$curstate = fread($fp, 2);

switch ($curstate) {
	case '01':
		$td1st = "btn-danger";
		$td2st = "btn-success";
		$button1action = "start_1";
		$button2action = "stop_2";
		break;
	case '10':
		$td1st = "btn-success";
		$td2st = "btn-danger";
		$button1action = "stop_1";
		$button2action = "start_2";
		break;
	case '11':
		$td1st = "btn-success";
		$td2st = "btn-success";
		$button1action = "stop_1";
		$button2action = "stop_2";
		break;
	default:
		$td1st = "btn-danger";
		$td2st = "btn-danger";
		$button1action = "start_1";
		$button2action = "start_2";
		break;
}

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Relay control</title>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	</head>
	<body>
		<table style="margin: 20px;">
			<tr>
				<td style="padding: 10px;">
					<form action="index.php" method="post">
						<input type="hidden" name="action" value="<?php echo $button1action; ?>">
						<button type="button" class="btn btn-lg <?php echo $td1st; ?>" onclick="this.form.submit();">Channel 1</button>
					</form>
				</td>
				<td style="padding: 10px;">
					<form action="index.php" method="post">
						<input type="hidden" name="action" value="<?php echo $button2action; ?>">
						<button type="button" class="btn btn-lg <?php echo $td2st; ?>" onclick="this.form.submit();">Channel 2</button>
					</form>
				</td>
			</tr>
		</table>
	</body>
</html>