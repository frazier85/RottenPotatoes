<?PHP
if(!defined("IN_API"))
{
	die("Direct access of this file is now allowed");
}

define("DB_HOST", "localhost");
define("DB_NAME", "potatoes");
define("DB_USER", "root");
define("DB_PASS", "manageMe!");

function doesUserExist($user)
{
	$dbc = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if ($stmt = $dbc->prepare("SELECT ID,username FROM USERS WHERE username=?" ))
	{
		$stmt->bind_param('s', $user);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($uid,$user);
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

function getRequestInfo()
{
	return json_decode(file_get_contents('php://input'), true);
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
