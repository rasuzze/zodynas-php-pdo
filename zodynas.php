<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?> 
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body cz-shortcut-listen="true"><div style="margin: 0 auto; text-align: center;">
	<h1>English-Lithuanian translator</h1>
	<form action="zodynas.php" method="get">
		<table style="margin: 0 auto">
			<tbody><tr>
				<td>Word</td>
				<td><input type="text" name="word" style='padding: 5px;'></td>
			</tr>
			<tr>
				<td>Type</td>
				<td>
					<select name="type" style='padding: 5px;'>
						<option value="en-lt">English-Lithuanian</option>
						<option value="lt-en">Lithuanian-English</option>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" value="Translate" name="submit" style='padding: 5px;'>
				</td>
			</tr>
		</tbody></table>
	</form>
</div><hr>
<table style="margin: 0 auto">
	<caption><strong>Words, that translator understands</strong></caption>
	<thead>
		<tr>
			<td>Lithuanian</td>
			<td>English</td>
		</tr>
	</thead>
<?php 
	$host = 'localhost';
	$db   = 'scotchbox';
	$user = 'root';
	$pass = 'root';
	$charset = 'utf8';
	$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
	$pdo = new PDO($dsn, $user, $pass);
	$query = $pdo->query("SELECT * FROM `translator`");
	$result = $query->fetchAll();
	
	$type = $_GET["type"];
		
	if (array_key_exists('word', $_GET)) {
		$word = $_GET["word"];
		if ($type == 'lt-en') {
			$translate = $pdo->prepare("SELECT * FROM `translator` WHERE `lithuanian`=:word");
			$resultselect = $translate -> execute ([
			'word'=> $word
			]);
			$resultselect = $translate->fetchAll();
			
			if (sizeof($resultselect) != 1) {				//tikrinam at masyvas tuscias ar ne
				echo '<strong>No word in translator</strong>';
				
			}else {
				echo '<strong>'.$resultselect[0]['english'].'</strong>';
			}
		} else if ($type == 'en-lt') {
				$translate = $pdo->prepare("SELECT * FROM `translator` WHERE `english`=:word");
				$resultselect = $translate -> execute ([
					'word'=> $word
						]);
				$resultselect = $translate->fetchAll();

				if (sizeof($resultselect) != 1) {
				
				echo '<strong>No word in translator</strong>';
				
				}else {
				echo '<strong style="text-align:center;">'.$resultselect[0]['lithuanian'].'</strong>';
					}
			}
	} 
?>

<?php
foreach ($result as $value) :

		echo "<tbody><tr>";
		echo "<td>".$value['lithuanian']."</td>";
		echo "<td>".$value['english']."</td>";
		echo "</tr></tbody>";

endforeach;
	?>
</table>

</body>
</html>