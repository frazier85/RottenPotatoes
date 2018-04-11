<?PHP

if(!defined("IN_API"))
{
	die("Direct access of this file is now allowed");
}

define("DB_HOST", "localhost");
define("DB_NAME", "RottenPotatoes");
define("DB_USER", "root");
define("DB_PASS", "manageMe!");

function getRequestInfo()
{
	$d = file_get_contents('php://input');
	return json_decode($d, true);
}

function doesUserExist($user)
{
	$dbc = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if ($stmt = $dbc->prepare("SELECT username FROM USERS WHERE username=?" ))
	{
		$stmt->bind_param('s', $user);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($user);
		if($stmt->fetch())
		{
			$stmt->close();
			mysqli_close($dbc);
			return true;
		}
	}
	mysqli_close($dbc);
	return false;
}

function doesUserHaveAdmin($user)
{
	$dbc = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if ($stmt = $dbc->prepare("SELECT admin FROM USERS WHERE username=?" ))
	{
		$stmt->bind_param('s', $user);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($admin);
		if($stmt->fetch())
		{
			$stmt->close();
			mysqli_close($dbc);
			return $admin > 0;
		}
	}
	mysqli_close($dbc);
	return false;
}

function getArtistString($id, $name, $genreId)
{
	return '{"id" : ' . $id . ', "name" : "' . $name . '", "genreId":"' . $genreId . '"}';
}

function getAlbumString($id, $name, $artist_ID, $icon, $year)
{
	return '{"id" : ' . $id . ', "name" : "' . $name . '", "artistId" : "' . $artist_ID . '", "icon" : "' . $icon . '", "year":"' . $year . '"}';
}

function getGenreString($id, $name)
{
	return '{"id" : ' . $id . ', "name" : "' . $name . '"}';
}

function sendResultInfoAsJson( $obj )
{
	header('Content-type: application/json');
	echo $obj;
}

function sendError($error)
{
	sendResultInfoAsJson('{"error":"' . $error . '"}');
}
?>
