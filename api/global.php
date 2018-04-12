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

function getArtistName($id)
{
	$dbc = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ($stmt = $dbc->prepare("SELECT name FROM ARTISTS WHERE ID=?" ))
	{
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($name);
		if($stmt->fetch())
		{
			$stmt->close();
			mysqli_close($dbc);
			return $name;
		}
		$stmt->close();
	}
	else
	{
		sendError("There was an issue with our database.");
	}
	mysqli_close($dbc);
	return "null";
}

function getAlbumString($id, $name, $icon, $year, $artistId, $genreId)
{
	return '{"id" : ' . $id . ', "name" : "' . $name . '", "iconUrl" : "' . $icon . '", "year" : ' . $year . ', "artistId" : ' . $artistId . ', "genreId" : ' . $genreId . '}';
}

//Includes songs in the album and artist name
function getAlbumStringFull($id, $name, $icon, $year, $artistId, $genreId)
{
	$genre = getGenreString($genreId, getGenreName($genreId));
	$artist = getArtistString($artistId, getArtistName($artistId), $genreId);
	$songs = getSongsAsJsonArray($id);
	return '{"id" : ' . $id . ', "name" : "' . $name . '", "iconUrl" : "' . $icon . '", "year" : ' . $year . ', "songs" : ' . $songs . ', "artist" : ' . $artist . ', "genre" : ' . $genre . '}';
}

function getGenreString($id, $name)
{
	return '{"id" : ' . $id . ', "name" : "' . $name . '"}';
}

function getGenreName($id)
{
	$dbc = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ($stmt = $dbc->prepare("SELECT name FROM GENRES WHERE ID=?" ))
	{
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($name);
		if($stmt->fetch())
		{
			$stmt->close();
			mysqli_close($dbc);
			return $name;
		}
		$stmt->close();
	}
	else
	{
		sendError("There was an issue with our database.");
	}
	mysqli_close($dbc);
	return "null";
}

function getReviewString($id, $body, $uid, $albumid, $rating)
{
	$username = getUsername($uid);
	return '{"id" : ' . $id . ', "text" : "' . $body . '", "uid" : ' . $uid . ', "username" : "' . $username . '", "albumid" : ' . $albumid . ', "rating" : ' . $rating . '}';
}

function getSongsAsJsonArray($albumid)
{
	$dbc = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$json = '[ ';
	if ($stmt = $dbc->prepare("SELECT ID,name FROM SONGS WHERE album_ID=?" ))
	{
		$stmt->bind_param('i', $albumid);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($id, $name);
		while($stmt->fetch())
		{
			$json = $json . '{"id" : ' . $id . ', "name" : "' . $name . '"},';
		}
		$json = substr($json, 0, -1);
		$json = $json . "]";
		$stmt->close();
		mysqli_close($dbc);
		return $json;
	}
	else
	{
		sendError("There was an issue with our database.");
	}
	mysqli_close($dbc);
	return "null";
}

function getUsername($id)
{
	$dbc = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ($stmt = $dbc->prepare("SELECT username FROM USERS WHERE ID=?" ))
	{
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($user);
		if($stmt->fetch())
		{
			$stmt->close();
			mysqli_close($dbc);
			return $user;
		}
	}
	mysqli_close($dbc);
	return "null";
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
