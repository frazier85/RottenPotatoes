var urlBase = '/api';

var userId = 0;

function register()
{
	var username = document.getElementById("usernameInput").value;
	var password = md5(document.getElementById("passwordInput").value);

  var fname = "n/a";
  var lname = "n/a";
  var email = "n/a";

	document.getElementById("loginResult").innerHTML = "";

	var jsonPayload = '{"fname" : "' + fname + '", "lname" : "' + lname + '", "email" : "' + email + '", "username" : "' + username + '", "password" : "' + password + '"}';
	var url = urlBase + '/user.php?action=register';
	alert(jsonPayload);

	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, false);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");

	try
	{
		xhr.send(jsonPayload);
		if(typeof xhr.responseText != "undefined" && xhr.responseText != "")
		{
			var jsonObject = JSON.parse(xhr.responseText);
			alert(xhr.responseText);

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

function logout()
{
	var url = urlBase + '/user.php?action=logout';
	var xhr = new XMLHttpRequest();
	xhr.open("GET", url, false);
	try
	{
		xhr.send();
		//redirect user to our main page
		setTimeout(function(){
    	window.location.href = "http://project.codethree.net";
		}, 100);

	}
	catch(err)
	{
		//Do nothing errors don't happen xd
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
					alert(xhr.responseText);
					$("#dataTable tbody tr").remove();
					var i;
					for( i in jsonObject.albums)
					{
						 var row = "";
						 row += '<tr><td>' +   '<img src='+jsonObject.albums[i].iconUrl+' style="width:100px;height:100px">' + '</td><td>' + jsonObject.albums[i].name + '</td><td>' + jsonObject.albums[i].year + '</td><td>' + jsonObject.albums[i].artist.name + '</td><td>' + jsonObject.albums[i].genre.name + '</td></tr>';

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
					alert(xhr.responseText);

         $("#dataTable tbody tr").remove();

					var i;
					for( i in jsonObject.albums)
					{
             var row = "";
             row += '<tr><td>' +   '<img src='+jsonObject.albums[i].iconUrl+' style="width:100px;height:100px">' + '</td><td>' + jsonObject.albums[i].name + '</td><td>' + jsonObject.albums[i].year + '</td><td>' + jsonObject.albums[i].artist.name + '</td><td>' + jsonObject.albums[i].genre.name + '</td></tr>';

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

function addAlbum()
{
	var album_artwork = document.getElementById("album_artwork").value;
	var name = document.getElementById("name").value;
	var artist_ID = document.getElementById("artist_ID").value;
	var year = document.getElementById("year").value;
	var genre_ID = document.getElementById("genre_ID").value;

	document.getElementById("submitResult").innerHTML = "";

	var jsonPayload = '{"name" : "' + name + '", "album_artwork" : "' + album_artwork + '", "year" : "' + year + '", "artist_ID" : "' + artist_ID + '", "genre_ID" : "' + genre_ID + '"}';
	alert(jsonPayload);

	var url = urlBase + '/admin.php?action=add_album';
	alert(url);
	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, false);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");

	try
	{
		xhr.send(jsonPayload);
		if(typeof xhr.responseText != "undefined" && xhr.responseText != "")
		{
			var jsonObject = JSON.parse(xhr.responseText);

			document.getElementById("submitResult").innerHTML = jsonObject.error;
		}
		else
		{
			document.getElementById("submitResult").innerHTML = "Album added.";
		}
	}
	catch(err)
	{
		document.getElementById("submitResult").innerHTML = err.message;
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
