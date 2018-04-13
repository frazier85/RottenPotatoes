<?PHP
define("IN_API", 1);
require_once "global.php";

$action = $_GET["action"];
$data = getRequestInfo();

if(!isset($action))
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

if($action === "promote")
{
  $uid = $data["id"];
  if(!isset($uid))
  {
    sendError("Invalid user.");
  }
  else if($stmt = $dbc->prepare("UPDATE USERS SET admin=1 WHERE ID=?"))
	{
		$stmt->bind_param('i', $uid);
		$stmt->execute();
	}
	else
	{
		sendError("There was an issue with our database. (" . $mysqli->error . ")");
	}
	mysqli_close($dbc);
}
elseif($action === "demote")
{
	$uid = $data["id"];
	if(!isset($uid))
	{
		sendError("Invalid user.");
	}
	else if($stmt = $dbc->prepare("UPDATE USERS SET admin=0 WHERE ID=?"))
	{
		$stmt->bind_param('i', $uid);
		$stmt->execute();
	}
	else
	{
		sendError("There was an issue with our database. (" . $mysqli->error . ")");
	}
	mysqli_close($dbc);
}
elseif($action === "del_user")
{
	$id = $data["id"];
	if($stmt = $dbc->prepare("DELETE FROM USERS WHERE ID=?"))
	{
		$stmt->bind_param('i', $id);
		$stmt->execute();
	}
	else
	{
		sendError("There was an issue with our database. (" . $mysqli->error . ")");
	}
	mysqli_close($dbc);
}
elseif($action === "add_artist")
{
	$name = $data["name"];
	$genre = $data["genre"];
	if($stmt = $dbc->prepare("INSERT INTO ARTISTS (ID, name, genre_ID) VALUES (NULL, ?, ?)"))
	{
		$stmt->bind_param('si', $name, $genre);
		$stmt->execute();
	}
	else
	{
		sendError("There was an issue with our database. (" . $mysqli->error . ")");
	}
	mysqli_close($dbc);
}
elseif($action === "del_artist")
{
	$id = $data["id"];
	if($stmt = $dbc->prepare("DELETE FROM ARTISTS WHERE ID=?"))
	{
		$stmt->bind_param('i', $id);
		$stmt->execute();
	}
	else
	{
		sendError("There was an issue with our database. (" . $mysqli->error . ")");
	}
	mysqli_close($dbc);
}
elseif($action === "add_genre")
{
	$name = $data["name"];
	if($stmt = $dbc->prepare("INSERT INTO GENRES (ID, name) VALUES (NULL, ?)"))
	{
		$stmt->bind_param('s', $name);
		$stmt->execute();
	}
	else
	{
		sendError("There was an issue with our database. (" . $mysqli->error . ")");
	}
	mysqli_close($dbc);
}
elseif($action === "del_genre")
{
	$id = $data["id"];
	if($stmt = $dbc->prepare("DELETE FROM GENRES WHERE ID=?"))
	{
		$stmt->bind_param('i', $id);
		$stmt->execute();
	}
	else
	{
		sendError("There was an issue with our database. (" . $mysqli->error . ")");
	}
	mysqli_close($dbc);
}
elseif($action === "add_album")
{
	$name = $data["name"];
	$album_artwork = $data["album_artwork"];
	$artist_ID = $data["artist"];
	$genre_ID = $data["genre"];
	$year = $data["year"];

	if($stmt = $dbc->prepare("INSERT INTO ALBUMS (ID, name, album_artwork, year, artist_ID, genre_ID) VALUES (NULL, ?, ?, ?, ?, ?)"))
	{
		$stmt->bind_param('ssiii', $name, $album_artwork, $year, $artist_ID , $genre_ID);
		$stmt->execute();
	}
	else
	{
		sendError("There was an issue with our database. (" . $mysqli->error . ")");
	}
	mysqli_close($dbc);
}

elseif($action === "add_store")
{
	$name = $data["name"];
	$icon = $data["icon"];

	if($stmt = $dbc->prepare("INSERT INTO STORES (ID, name, icon) VALUES (NULL, ?, ?)"))
	{
		$stmt->bind_param('ss', $name, $icon);
		$stmt->execute();
	}
	else
	{
		sendError("There was an issue with our database. (" . $mysqli->error . ")");
	}
	mysqli_close($dbc);
}
elseif($action === "del_store")
{
	$id = $data["id"];
	if($stmt = $dbc->prepare("DELETE FROM STORES WHERE ID=?"))
	{
		$stmt->bind_param('i', $id);
		$stmt->execute();
	}
	else
	{
		sendError("There was an issue with our database. (" . $mysqli->error . ")");
	}
	mysqli_close($dbc);
}
elseif($action === "add_storelink")
{
	$link = $data["link"];
	$store = $data["store"];
	$album = $data["album"];

	if($stmt = $dbc->prepare("INSERT INTO LINKS (ID, link, store_ID, album_ID) VALUES (NULL, ?, ?, ?)"))
	{
		$stmt->bind_param('sii', $link, $store, $album);
		$stmt->execute();
	}
	else
	{
		sendError("There was an issue with our database. (" . $mysqli->error . ")");
	}
	mysqli_close($dbc);
}
elseif($action === "del_storelink")
{
	$id = $data["id"];
	if($stmt = $dbc->prepare("DELETE FROM LINKS WHERE ID=?"))
	{
		$stmt->bind_param('i', $id);
		$stmt->execute();
	}
	else
	{
		sendError("There was an issue with our database. (" . $mysqli->error . ")");
	}
	mysqli_close($dbc);
}
else
{
	mysqli_close($dbc);
	sendError("Invalid request.");
}

?>
