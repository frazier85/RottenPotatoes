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
	sendError('There was an issue with our database. (' . mysqli_connect_errno . ')');
	die();
}

if($action == "promote")
{
  $uid = $data["uid"];
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

?>
