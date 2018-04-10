var urlBase = '/api';

var userId = 0;

function register()
{
	var username = document.getElementById("usernameInput").value;
	var password = md5(document.getElementById("passwordInput").value);
  var fname = "fist";
  var lname = "last";
  var email = "dickbutt@email.com";

	document.getElementById("loginResult").innerHTML = "";

	var jsonPayload = '{"fname" : "' + fname + '", "lname" : "' + lname + '", "email" : "' + email + '", "username" : "' + username + '", "password" : "' + password + '"}';
	var url = urlBase + '/user.php?action=register';

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
	uid = 0;

	var username = document.getElementById("usernameInput").value;
	var password = md5(document.getElementById("passwordInput").value);

	document.getElementById("loginResult").innerHTML = "";

	var jsonPayload = '{"username" : "' + username + '", "password" : "' + password + '"}';
	var url = urlBase + '/user.php?action=login';

	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, false);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
	try
	{
		xhr.send(jsonPayload);

		var jsonObject = JSON.parse( xhr.responseText );

		uid = jsonObject.id;

		if( uid < 1 )
		{
			document.getElementById("loginResult").innerHTML = "User/Password combination incorrect";
			return;
		}

		displayName = jsonObject.username;

		document.getElementById("loginResult").innerHTML = "Youre logged in now! Cool.";

	}
	catch(err)
	{
		document.getElementById("loginResult").innerHTML = err.message;
	}

}

function searchBy()
{

	var query = document.getElementById("searchText").value;
	var searchType = document.getElementById("searchType");
	searchList.innerHTML = "";

	var jsonPayload = '{"query" : "' + query + '"}';
	var url = urlBase + '/search.php?by=' + searchType;

	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
	switch(searchType)
	{
		case 'genre':


		break;
		case 'artist':

		break;
		case 'album':

		break;
		default:
		document.getElementById("contentResult").innerHTML = "Please search by something";

	}
	try
	{
		xhr.onreadystatechange = function()
		{
			if (this.readyState == 4 && this.status == 200)
			{
				hideOrShow( "searchList", true );

				document.getElementById("contentResult").innerHTML = "Data has been retrieved";
				var jsonObject = JSON.parse( xhr.responseText );
				var i;
				for( i in jsonObject.contacts)
				{
						var opt = document.createElement("option");
						var entryString = "";
						opt.text = entryString.concat(jsonObject.contacts[i].first, " ", jsonObject.contacts[i].last, " ", jsonObject.contacts[i].phone, " ", jsonObject.contacts[i].email);
						opt.value = jsonObject.contacts[i].id;
						contactList.options.add(opt);
				}
			}
		};
		xhr.send(jsonPayload);
	}
	catch(err)
	{
		document.getElementById("contentResult").innerHTML = err.message;
	}
}
