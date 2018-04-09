var urlBase = '/api';

var userId = 0;

function register()
{
	var username = document.getElementById("usernameInput").value;
	var password = md5(document.getElementById("passwordInput").value);

	document.getElementById("loginResult").innerHTML = "";

	var jsonPayload = '{"username" : "' + username + '", "password" : "' + password + '"}';
	var url = urlBase + '/login.php?register=1';

	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, false);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
	try
	{
		xhr.send(jsonPayload);
		if(typeof xhr.responseText != "undefined" && xhr.responseText != "")
		{
			var jsonObject = JSON.parse(xhr.responseText);
			document.getElementById("loginResult").innerHTML = jsonObject.error;
		}
		else
		{
			document.getElementById("loginResult").innerHTML = "Successfully registered. Please log in.";
		}
	}
	catch(err)
	{
		document.getElementById("loginResult").innerHTML = err.message;
	}

}

function login()
{
	userId = 0;

	var username = document.getElementById("usernameInput").value;
	var password = md5(document.getElementById("passwordInput").value);

	document.getElementById("loginResult").innerHTML = "";

	var jsonPayload = '{"username" : "' + username + '", "password" : "' + password + '"}';
	var url = urlBase + '/login.php?login=1';

	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, false);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
	try
	{
		xhr.send(jsonPayload);

		var jsonObject = JSON.parse( xhr.responseText );

		userId = jsonObject.id;

		if( userId < 1 )
		{
			document.getElementById("loginResult").innerHTML = "User/Password combination incorrect";
			return;
		}

		displayName = jsonObject.username;
		document.getElementById("userDisplay").innerHTML = displayName;
		document.getElementById("loginUsername").value = "";
		document.getElementById("loginPassword").value = "";

	}
	catch(err)
	{
		document.getElementById("loginResult").innerHTML = err.message;
	}

}

function addAlbum()
{
	userId = 0;

	var username = document.getElementById("usernameInput").value;
	var password = md5(document.getElementById("passwordInput").value);

	document.getElementById("loginResult").innerHTML = "";

	var jsonPayload = '{"username" : "' + username + '", "password" : "' + password + '"}';
	var url = urlBase + '/login.php?login=1';

	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, false);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
	try
	{
		xhr.send(jsonPayload);

		var jsonObject = JSON.parse( xhr.responseText );

		userId = jsonObject.id;

		if( userId < 1 )
		{
			document.getElementById("loginResult").innerHTML = "User/Password combination incorrect";
			return;
		}

		displayName = jsonObject.username;
		document.getElementById("userDisplay").innerHTML = displayName;
		document.getElementById("loginUsername").value = "";
		document.getElementById("loginPassword").value = "";

	}
	catch(err)
	{
		document.getElementById("loginResult").innerHTML = err.message;
	}

}
