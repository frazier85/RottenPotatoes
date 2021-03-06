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

if($action === "register")
{
  $email = $data["email"];
  $fn = $data["fname"];
  $ln = $data["lname"];
	$user = $data["username"];
	$pass = $data["password"];
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
	if($stmt = $dbc->prepare("INSERT INTO USERS (ID, admin, firstname, lastname, email, username, password) VALUES (NULL, 0, ?, ?, ?, ?, ?)"))
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



elseif($action === "login")
{
	$user = $data["username"];
	$pass = $data["password"];
  if ($stmt = $dbc->prepare("SELECT ID,admin,username FROM USERS WHERE username=? AND password=?" ))
  {
    $stmt->bind_param('ss', $user, $pass);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($uid,$admin,$user);
    $json = '{"id":-1,"username":"","error":"Invalid username or password."}';
    if($stmt->fetch())
    {
			session_start();
			$_SESSION["user"] = $user;
			$_SESSION["userid"] = $uid;
			$_SESSION["admin"] = $admin;
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
elseif($action === "logout")
{
	mysqli_close($dbc);
	session_start();
	$_SESSION["user"] = null;
	$_SESSION["userid"] = null;
	$_SESSION["admin"] = null;
	session_unset();
}
else
{
	mysqli_close($dbc);
	die("Invalid request.");
}
?>
