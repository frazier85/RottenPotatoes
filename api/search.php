<?PHP
define("IN_API", 1);
require_once "global.php";

$by = $_GET["by"];
$data = getRequestInfo();
$query = $data["query"];
if(!isset($query))
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

if($by == "genre")
{
  if ($stmt = $dbc->prepare("SELECT ID,admin,username FROM USERS WHERE username=? AND PW=?" ))
  {
    $stmt->bind_param('ss', $user, $pass);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($uid,$admin,$user);
    $json = '{"id":-1,"username":"","error":"Invalid username or password."}';
    if($stmt->fetch())
    {
      $json = '{"id":' . $uid . ',"username":"' . $user .'","admin":' . $admin .',"error":""}';
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
if($by == "artist")
{

}
if($by == "album")
{
  if ($stmt = $dbc->prepare("SELECT * FROM USERS WHERE username=? AND PW=?" ))
  {
    $stmt->bind_param('ss', $user, $pass);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($uid,$admin,$user);
    $json = '{"id":-1,"username":"","error":"Invalid username or password."}';
    if($stmt->fetch())
    {
      $json = '{"id":' . $uid . ',"username":"' . $user .'","admin":' . $admin .',"error":""}';
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
else
{
  mysqli_close($dbc);
  die("Invalid request.");
}
?>
