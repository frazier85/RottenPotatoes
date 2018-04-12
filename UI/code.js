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
	searchType = searchType.value;

	document.getElementById("searchResult").innerHTML = "";

 	var resultList = document.getElementById("resultList");
 	resultList.innerHTML = "";



	var jsonPayload = '{"query" : "' + query + '"}';
	var url = urlBase + '/search.php?by=' + searchType;
	alert(url);
	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
	switch(searchType)
	{

		case 'artist_getalbums':
		try
		{
			xhr.onreadystatechange = function()
			{
				if (this.readyState == 4 && this.status == 200)
				{
				//	hideOrShow( "resultList", true );

					document.getElementById("searchResult").innerHTML = "Artist Albums data has been retrieved";
					var jsonObject = JSON.parse( xhr.responseText );

					alert( xhr.responseText );

					$("#dataTable tbody tr").remove();
					var i;
					var i;
					for( i in jsonObject.albums)
					{
						 var row = "";
						 row += '<tr><td>' + jsonObject.albums[i].name + '</td><td>' + jsonObject.albums[i].year + '</td><td>' + jsonObject.albums[i].icon + '</td><td>' + jsonObject.albums[i].artistId + '</td><td>' + jsonObject.albums[i].genreId + '</td></tr>';

						 var oldTBody = document.getElementById("rowData").innerHTML + row;

						 document.getElementById("rowData").innerHTML = oldTBody;

					}
				}
			};
			xhr.send(jsonPayload);
		}
		catch(err)
		{
			document.getElementById("searchResult").innerHTML = err.message;
		}

		break;

		case 'album_card':

		try
		{
			xhr.onreadystatechange = function()
			{
				if (this.readyState == 4 && this.status == 200)
				{
				//	hideOrShow( "resultList", true );

					document.getElementById("searchResult").innerHTML = "Album Data has been retrieved";

					var jsonObject = JSON.parse( xhr.responseText );
					alert( xhr.responseText );

         $("#dataTable tbody tr").remove();

					var i;
					for( i in jsonObject.albums)
					{
             var row = "";
             row += '<tr><td>' + jsonObject.albums[i].name + '</td><td>' + jsonObject.albums[i].year + '</td><td>' + jsonObject.albums[i].icon + '</td><td>' + jsonObject.albums[i].artist.name + '</td><td>' + jsonObject.albums[i].genre.name + '</td></tr>';

             var oldTBody = document.getElementById("rowData").innerHTML + row;

             document.getElementById("rowData").innerHTML = oldTBody;

					}

				}
			};
			xhr.send(jsonPayload);
		}
		catch(err)
		{
			document.getElementById("searchResult").innerHTML = err.message;
		}

		break;
		default:
		document.getElementById("searchResult").innerHTML = "Please search by something";

	}

}

function hideOrShow( elementId, showState )
{
	var vis = "visible";
	var dis = "block";
	if( !showState )
	{
		vis = "hidden";
		dis = "none";
	}

	document.getElementById( elementId ).style.visibility = vis;
	document.getElementById( elementId ).style.display = dis;
}
