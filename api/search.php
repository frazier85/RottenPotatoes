<?PHP
define("IN_API", 1);
require_once "global.php";

$by = $_GET["by"];
$data = getRequestInfo();
$qry = $data["query"];
if(!isset($qry))
{
	sendError("Invalid request.");
	die();
}
$dbc = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno())
{
	sendError('There was an issue with our database. (' . mysqli_connect_errno() . ')');
	die();
}

if(strlen($qry) < 3)
{
	sendError("Searches must have at least 3 characters.");
	die();
}
if($by === "artist")
{
	if ($stmt = $dbc->prepare("SELECT * FROM ARTISTS WHERE name LIKE CONCAT('%',?,'%')" ))
	{
		$stmt->bind_param('s', $qry);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($id, $name, $genreId);
		$json = '{ "artists": [ ';
		while($stmt->fetch())
		{
			$json = $json . getArtistString($id, $name, $genreId) . ',';
		}
		//remove last comma
		$json = substr($json, 0, -1);
		$json = $json . "]}";
		$stmt->close();
		sendResultInfoAsJson($json);
	}
	else
	{
		sendError("There was an issue with our database.");
	}
	mysqli_close($dbc);
}
elseif($by === "artist_getalbums")
{
	$ids = array();
	if ($stmt = $dbc->prepare("SELECT ID FROM ARTISTS WHERE name LIKE CONCAT('%',?,'%')" ))
	{
		$stmt->bind_param('s', $qry);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($id);
		while($stmt->fetch())
		{
			$ids[] = $id;
		}
		$stmt->close();
	}
	else
	{
		sendError("There was an issue with our database.");
		die();
	}
	$json = '{ "albums": [ ';
	$atLeastOne = false;
	foreach($ids as $artid)
	{
		if ($stmt = $dbc->prepare("SELECT * FROM ALBUMS WHERE artist_ID=?" ))
		{
			$stmt->bind_param('i', $artid);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($id, $name, $icon, $year, $artistId, $genreId);
			while($stmt->fetch())
			{
				$atLeastOne = true;
				$json = $json . getAlbumString($id, $name, $icon, $year, $artistId, $genreId) . ',';
			}
			$stmt->close();

		}
		else
		{
			sendError("There was an issue with our database.");
			die();
		}
	}
	if($atLeastOne)
	{
		$json = substr($json, 0, -1);
	}
	$json = $json . "]}";
	mysqli_close($dbc);
	sendResultInfoAsJson($json);
}
elseif($by === "album")
{
	if ($stmt = $dbc->prepare("SELECT * FROM ALBUMS WHERE name LIKE CONCAT('%',?,'%')" ))
	{
		$stmt->bind_param('s', $qry);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($id, $name, $icon, $year, $artistId, $genreId);
		$json = '{ "albums": [ ';
		while($stmt->fetch())
		{
			$json = $json . getAlbumString($id, $name, $icon, $year, $artistId, $genreId) . ',';
		}
		//remove last comma
		$json = substr($json, 0, -1);
		$json = $json . "]}";
		$stmt->close();
		sendResultInfoAsJson($json);
	}
	else
	{
		sendError("There was an issue with our database.");
	}
	mysqli_close($dbc);
}
elseif($by === "album_card")
{
	if ($stmt = $dbc->prepare("SELECT * FROM ALBUMS WHERE name LIKE CONCAT('%',?,'%')" ))
	{
		$stmt->bind_param('s', $qry);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($id, $name, $icon, $year, $artistId, $genreId);
		$json = '{ "albums": [ ';
		while($stmt->fetch())
		{
			$json = $json . getAlbumStringFull($id, $name, $icon, $year, $artistId, $genreId) . ',';
		}
		//remove last comma
		$json = substr($json, 0, -1);
		$json = $json . "]}";
		$stmt->close();
		sendResultInfoAsJson($json);
	}
	else
	{
		sendError("There was an issue with our database.");
	}
	mysqli_close($dbc);
}
else
{
  mysqli_close($dbc);
  die("Invalid request.");
}
?>
