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

if($action === "add")
{
  $albumid = $data["id"];
  $uid = $data["uid"];
  $body = $data["body"];
  $rating = $data["rating"];
	if($stmt = $dbc->prepare("INSERT INTO REVIEWS (ID, review_text, user_ID, album_ID, rating) VALUES (NULL, ?, ?, ?, ?)"))
	{
		$stmt->bind_param('siii', $body, $uid, $albumid, $rating);
		$stmt->execute();
	}
	else
	{
		sendError("There was an issue with our database. (" . $mysqli->error . ")");
	}
	mysqli_close($dbc);
}
elseif($action === "del")
{
  $id = $data["id"];
	if($stmt = $dbc->prepare("DELETE FROM REVIEWS WHERE ID=?"))
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
elseif($action === "edit")
{
  $id = $data["id"];
  $body = $data["body"];
  $rating = $data["rating"];
	if($stmt = $dbc->prepare("UPDATE REVIEWS SET review_text=?, rating=? WHERE ID=?"))
	{
		$stmt->bind_param('sii', $body, $rating, $id);
		$stmt->execute();
	}
	else
	{
		sendError("There was an issue with our database. (" . $mysqli->error . ")");
	}
	mysqli_close($dbc);
}
elseif($action === "get_rating")
{
	//TODO: Cache rating to reduce server load
	$id = $data["id"];
	$total = 0;
	$count = 0;
	if ($stmt = $dbc->prepare("SELECT rating FROM REVIEWS WHERE album_ID=?" ))
  {
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($rating);
		while($stmt->fetch())
		{
			$total += $rating;
			$count++;
		}
		$avg = $total / $count;
		$json = '{"rating":' . $avg .'}';
		$stmt->close();
		sendResultInfoAsJson($json);
  }
  else
  {
    sendError("There was an issue with our database.");
  }
  mysqli_close($dbc);
}
elseif($action === "get_reviews")
{

}
elseif($action === "get_review")
{
	$id = $data["id"];
	if ($stmt = $dbc->prepare("SELECT * FROM REVIEWS WHERE ID=?" ))
  {
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->store_result();
		$stmt->bind_result(/*TODO: Put stuff here*/);
		if($stmt->fetch())
		{
			$total += $rating;
			$count++;
		}
		$avg = $total / $count;
		$json = '{"rating":' . $avg .'}';
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
