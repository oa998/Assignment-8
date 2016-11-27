<html>
<head>
<title>Add Albums</title>
</head>
<body>

<?php
	if(isset($_POST['submit'])){
		$data_missing = array();

		if(empty($_POST['album_name'])){
			$data_missing[] = 'Album name';
		}else{
			$album = trim($_POST['album_name']);
		}

		if(empty($_POST['artist_name'])){
			$data_missing[] = 'Artist name';
		}else{
			$artist = trim($_POST['artist_name']);
		}

		if(empty($data_missing)){
			$host = 'localhost';
			$dbNpass = 'zshoults1';
			$dbc = mysqli_connect($host, $dbNpass, $dbNpass, $dbNpass);

			$query = "INSERT INTO Album (Name, Artist) values(?,?)";

			$stmt = mysqli_prepare($dbc, $query);

			mysqli_stmt_bind_param($stmt, "ss", $album, $artist);

			mysqli_stmt_execute($stmt);

			$affected_rows = mysqli_stmt_affected_rows($stmt);

			if($affected_rows == 1){
				echo 'Album Added';
			}
			mysqli_stmt_close($stmt);
			mysqli_close($dbc);
		}else{
			echo 'You need to enter: <br>';
			foreach($data_missing as $missing){
				echo "$missing<br>";
			}
		}
	}
?>

<form action="./addAlbums.php" method="post">
<b>Add an album:</b>

<p>Album Name:<br>
<input type="text" name="album_name" size="50" value=""/>
</p>

<p>Artist Name:<br>
<input type="text" name="artist_name" size="50" value=""/>
</p>

<p>
<input type="submit" name="submit" value="Submit" />
</p>

</form>

<form action="./logIn.php" method="post">
<p>Log in to see all albums</p>

<p>Username:  (try "user_one")<br>
<input id="uname" type="text" name="user_name" size="50" value=""/>
</p>

<p>Password:  (try "pass123")<br>
<input id="pword" type="text" name="pass_word" size="50" value=""/>
</p>

<input id="login" type="submit" name="show" value="See all albums"/>
</form>

<script>

	var userText = document.getElementById("uname");
	var passText = document.getElementById("pword");
	var logButton = document.getElementById("login");
	logButton.disabled=true;
	setInterval(function(){
		if(userText.value.trim()=="" || passText.value.trim()==""){
			logButton.disabled = true;
		} else { 
			logButton.disabled = false;
		}
	},20);



</script>



</body>
</html>