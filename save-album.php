<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saving Album...</title>
</head>
<body>

<?php
// store the form inputs into variables
$title = $_POST['title'];
$year = $_POST['year'];
$artist = $_POST['artist'];


//variable to indicate if there are 1 or more input error  server side scripting
$ok=true;
if(empty($title))
{
	echo 'Title is required<br />';
	$ok=false;
}
if (!empty($year)) {
		if (year<1900)
		{
		echo "Year musht be greater than 1900";
		}
		else {
			$year = intval($year);
		}
}

if(empty($artist))
{
	echo "Artist is required<br />";
	$ok=false;
}

if ($ok==true) {
	# code...

// connect to db - dbtype, server address, dbname, username, password
$conn = new PDO('mysql:host=sql.computerstudi.es;dbname=gc200352590','gc200352590','B*aFCh9T');

// set up an SQL instruction to save the new album - INSERT
$sql = "INSERT INTO albums (title, year, artist) VALUES (:title, :year, :artist);";

// pass the input variables to the SQL command
$cmd = $conn->prepare($sql);
$cmd->bindParam(':title', $title, PDO::PARAM_STR, 50);
$cmd->bindParam(':year', $year, PDO::PARAM_INT);
$cmd->bindParam(':artist', $artist, PDO::PARAM_STR, 50);

// execute the INSERT
$cmd->execute();

// disconnect
$conn = null;

// show a message to the user
echo 'Album Saved';
?>
}
</body>
</html>
