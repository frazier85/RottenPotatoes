<?PHP

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
if($by === "genre")
{
  if ($stmt = $dbc->prepare("SELECT * FROM GENRES WHERE name LIKE CONCAT('%',?,'%')" ))
  {
    $stmt->bind_param('s', $qry);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id,$name);
		$json = '{ "genres": [ ';
		while($stmt->fetch())
		{
			$json = $json . '{"id" : ' . $id . ', "name" : "' . $name . '"},';
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
elseif($by === "artist")
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
			$json = $json . '{"id" : ' . $id . ', "name" : "' . $name . '", "genre_ID" : "' . $genreId . '"},';
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
			$json = $json . '{"id" : ' . $id . ', "name" : "' . $name . '","icon":"' . $icon .
			'", "year" : "' . $year . '", "artist_ID" : "' . $artistId . '", "genre_ID" : "' . $genreId . '"},';
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
			$json = $json . '{"id" : ' . $id . ', "name" : "' . $name . '","icon":"' . $icon .
			'", "year" : "' . $year . '", "artist_ID" : "' . $artistId . '", "genre_ID" : "' . $genreId . '"},';
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
