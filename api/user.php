<?PHP
define("IN_API", 1);
require_once "global.php";

$action = $_GET["action"];
$data = getRequestInfo();
$user = $data["username"];
$pass = $data["password"];
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

if($action == "register")
{
  $email = $data["email"];
  $fn = $data["fname"];
  $ln = $data["lname"];
  if(doesUserExist($user))
	{
		sendError("Username is taken");
		die();
	}
	if(strlen($user) < 3)
	{
		sendError("Usernames must be at least 3 characters long");
		die();
	}
  //TODO:
  //Update for different account types
	if($stmt = $dbc->prepare("INSERT INTO USERS (id, firstname, lastname, email username, PW) VALUES (NULL, ?, ?, ?, ?, ?)"))
	{
		$stmt->bind_param('sssss', $fn, $ln, $email, $user, $pass);
		$stmt->execute();
	}
	else
	{
		sendError("There was an issue with our database. (" . $mysqli->error . ")");
	}
	mysqli_close($dbc);
}
elseif($action == "login")
{
  if ($stmt = $dbc->prepare("SELECT ID,username FROM USERS WHERE username=? AND PW=?" ))
  {
    $stmt->bind_param('ss', $user, $pass);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($uid,$user);
    $json = '{"id":-1,"username":"","error":"Invalid username or password."}';
    if($stmt->fetch())
    {
      $json = '{"id":' . $uid . ',"username":"' . $user .'","error":""}';
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
