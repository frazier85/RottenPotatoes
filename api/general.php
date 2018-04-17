<?PHP
define("IN_API", 1);
require_once "global.php";

$data = getRequestInfo();
$action = $_GET["action"];

$dbc = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno())
{
	sendError('There was an issue with our database. (' . mysqli_connect_errno() . ')');
	die();
}

function getStoreString($storeid, $url)
{
	$name = "null";
	$icon = "null";
	$dbc = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  if ($stmt = $dbc->prepare("SELECT name,icon FROM STORES WHERE ID=?" ))
	{
		$stmt->bind_param('i', $storeid);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($n,$i);
		if($stmt->fetch())
		{
			$name = $n;
			$icon = $i;
		}
	}
	else
	{
		return "There was an issue with our database.";
	}
	mysqli_close($dbc);
	return '{"store" : "' . $name . '", "icon" : "' . $icon . '", "url":"' . $url . '"}';
}

if($action === "get_genres")
{
  if ($stmt = $dbc->prepare("SELECT * FROM GENRES" ))
	{
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($id, $name);
		$json = '{ "genres": [ ';
		while($stmt->fetch())
		{
			$json = $json . getGenreString($id, $name) . ',';
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
elseif($action === "get_genre")
{
	$gid = $data["id"];
  if ($stmt = $dbc->prepare("SELECT * FROM GENRES WHERE ID=?" ))
	{
		$stmt->bind_param('i', $gid);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($id, $name);
		$json = '{"id":-1,"name":"Invalid genre"}';
		if($stmt->fetch())
		{
			$json = getGenreString($id, $name);
		}
		$stmt->close();
		sendResultInfoAsJson($json);
	}
	else
	{
		sendError("There was an issue with our database.");
	}
	mysqli_close($dbc);
}
elseif($action === "get_albums_bygenre")
{
  $gid = $data["id"];
  if ($stmt = $dbc->prepare("SELECT * FROM ALBUMS WHERE genre_ID=?" ))
	{
		$stmt->bind_param('i', $gid);
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
elseif($action === "mostrecent")
{
  if ($stmt = $dbc->prepare("SELECT * FROM ALBUMS ORDER BY ID DESC LIMIT 12" ))
	{
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
elseif($action === "get_albums_byartist")
{
  $aid = $data["id"];
  if ($stmt = $dbc->prepare("SELECT * FROM ALBUMS WHERE artist_ID=?" ))
	{
		$stmt->bind_param('i', $aid);
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
elseif($action === "get_album")
{
	$id = $data["id"];
  if ($stmt = $dbc->prepare("SELECT * FROM ALBUMS WHERE ID=?" ))
	{
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($id, $name, $icon, $year, $artistId, $genreId);
		$json = '{}';
		if($stmt->fetch())
		{
			$json = getAlbumStringFull($id, $name, $icon, $year, $artistId, $genreId);
		}
		$stmt->close();
		sendResultInfoAsJson($json);
	}
	else
	{
		sendError("There was an issue with our database.");
	}
	mysqli_close($dbc);
}
elseif($action === "get_links")
{
	$aid = $data["id"];
	if ($stmt = $dbc->prepare("SELECT link,store_ID FROM LINKS WHERE album_ID=?" ))
	{
		$stmt->bind_param('i', $aid);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($url, $storeid);
		$json = '{ "links": [ ';
		while($stmt->fetch())
		{
			$json = $json . getStoreString($storeid, $url) . ',';
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
