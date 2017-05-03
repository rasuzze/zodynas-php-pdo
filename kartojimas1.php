<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?> 
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body style="text-align: center; padding: 10px;">
<?php
	if (array_key_exists('submit', $_POST)) {
		$name = $_POST['name'];
		if (strlen($name) == 0) {
			echo "<p>Enter your name!</p></br>";
		} else {
			echo "<p>Hi, ".$name."</p></br>";
			echo '<a href="?">Back</a>';
		}
		echo '<a href="?">Back</a>';
	} else {
?>
	<form action="kartojimas1.php" method="post">
	<label><strong>What is your name?</strong></label></br>
	 <input type="text" name="name"><br>
	<input type="submit" name="submit" style="margin-top: 10px;">
	</form>
<?php 
	}
?>
</body>
</html>