<html>
<head>
<title>Logging In</title>
<style>
table {
	border-collapse: collapse;
}
td, th {
	width: 100px;
	border: solid black 2px;
}
</style>
</head>
<body>

<?php
	if(isset($_POST['user_name']) && trim($_POST['user_name']) != "") {
		$host = 'localhost';
		$dbNpass = 'zshoults1';
		$dbc = mysqli_connect($host, $dbNpass, $dbNpass, $dbNpass);

		$givenUsername = $_POST['user_name'];
		$givenPassword = $_POST['pass_word'];

		$query = "SELECT * FROM Users WHERE '". $givenUsername ."'=Username";

		$response = mysqli_query($dbc, $query);
		$rows = mysqli_fetch_array($response);

		if($rows['Password']==$givenPassword){
			echo 'Log-In was successful.  Here is the album and artist database:<br><br>';
			$query = "Select * from Album";
			$response = mysqli_query($dbc, $query);
			echo "<table><tr><th>Album</th><th>Artist</th></tr>";
			while ($row = mysqli_fetch_array($response, MYSQL_NUM)) {
				echo "<tr>";
				echo "<td>".$row[0]."</td>";
				echo "<td>".$row[1]."</td>";
				echo "</tr>";
			}
			echo "</table>";
		}else{
			echo 'Log-In not successful.  Go back and try again';
		}
		mysqli_close($dbc);
	}

?>
<br><br>
<a href="./addAlbums.php">add more albums</a>
</body>
</html>
