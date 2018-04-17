var urlBase = '/api';

var userId = 0;

function formatMSS(s)
{
  return(s-(s%=60))/60+(9<s?':':':0')+s;
}

function getQueryVariable(variable)
{
    var query = window.location.search.substring(1);
    var vars = query.split('&');
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split('=');
        if (decodeURIComponent(pair[0]) == variable) {
            return decodeURIComponent(pair[1]);
        }
    }
    console.log('Query variable %s not found', variable);
}

function getAlbumCard(albumid, image, artist, genre, title, year, rating)
{
	var r = rating;
	if(r < 1)
	{
		r = "No reviews yet";
	}
	var html = '<a class="card" href="http://project.codethree.net/album.php?id=';
	html += albumid + '">';
	html += '<img src="' + image + '" alt="Album art" height="220" width="220">';
	html += '<div class="albumholder">';
	html += '<i class="fa fa-user" aria-hidden="true"></i> <b>' + artist + '</b><br />';
	html += '<i class="fa fa-dot-circle-o" aria-hidden="true"></i> <span>' + title + '</span><br />';
	html += '<i class="fa fa-star" aria-hidden="true"></i> <span>' + r + '</span><br />';
	html += '<i class="fa fa-music" aria-hidden="true"></i> <span>' + genre + '</span><br />';
	html += '<i class="fa fa-calendar" aria-hidden="true"></i> <span>' + year + '</span></div></a>';
	return html;
}

function register()
{
  var result = document.getElementById("loginResult");
	var username = document.getElementById("usernameInput").value;
	var password = md5(document.getElementById("passwordInput").value);

  var fname = "n/a";
  var lname = "n/a";
  var email = "n/a";

	var jsonPayload = '{"fname" : "' + fname + '", "lname" : "' + lname + '", "email" : "' + email + '", "username" : "' + username + '", "password" : "' + password + '"}';
	var url = urlBase + '/user.php?action=register';
  result.innerHTML = '<img src="spinner.gif"  width="30" height="30">';
	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, false);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");

	try
	{
		xhr.send(jsonPayload);
		if(typeof xhr.responseText != "undefined" && xhr.responseText != "")
		{
			var jsonObject = JSON.parse(xhr.responseText);
			result.innerHTML = jsonObject.error;
		}
		else
		{
			result.innerHTML = "Successfully registered!";
      setTimeout(function()
      {
        login();
      }, 750);

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
  var result = document.getElementById("loginResult");
	var username = document.getElementById("usernameInput").value;
	var password = md5(document.getElementById("passwordInput").value);

	result.innerHTML = '<img src="spinner.gif"  width="30" height="30">';

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
			result.innerHTML = "User/Password combination incorrect";
			return;
		}
		displayName = jsonObject.username;

		result.innerHTML = "Youre logged in now! Cool.";
		setTimeout(function()
		{
			window.location.href = referrer;
		}, 750);
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
		//reload page
		setTimeout(function(){
    	location.reload(true);
		}, 100);

	}
	catch(err)
	{
		//Do nothing errors don't happen xd
	}
}

function searchBy()
{
	var listing = document.getElementById("albumListing");
	var query = document.getElementById("searchText").value;
	var searchType = document.getElementById("searchType");
	searchType = searchType.value;

	document.getElementById("searchResult").innerHTML = "";



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

					document.getElementById("searchResult").innerHTML = "";
					var jsonObject = JSON.parse( xhr.responseText );
					var i;
					for( i in jsonObject.albums)
					{
						 listing.innerHTML += getAlbumCard(jsonObject.albums[i].id,
							 jsonObject.albums[i].iconUrl,
							 jsonObject.albums[i].artist.name,
							 jsonObject.albums[i].genre.name,
							 jsonObject.albums[i].name,
							 jsonObject.albums[i].year,
							 jsonObject.albums[i].rating);
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


					document.getElementById("searchResult").innerHTML = "";

					var jsonObject = JSON.parse( xhr.responseText );

					var i;
					for( i in jsonObject.albums)
					{
						listing.innerHTML += getAlbumCard(jsonObject.albums[i].id,
							 jsonObject.albums[i].iconUrl,
							 jsonObject.albums[i].artist.name,
							 jsonObject.albums[i].genre.name,
							 jsonObject.albums[i].name,
							 jsonObject.albums[i].year,
							 jsonObject.albums[i].rating);
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

function addGenre()
{

	var name = document.getElementById("name").value;
	document.getElementById("submitResult").innerHTML = "";
	var jsonPayload = '{"name" : "' + name + '"}';
	var url = urlBase + '/admin.php?action=add_genre';
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
			document.getElementById("submitResult").innerHTML = "Genre added.";
		}
	}
	catch(err)
	{
		document.getElementById("submitResult").innerHTML = err.message;
	}

}
function addArtist()
{
	var name = document.getElementById("name").value;
	var genre_ID = document.getElementById("genre_ID").value;

	document.getElementById("submitResult").innerHTML = "";

	var jsonPayload = '{"name" : "' + name + '", "genre" : "' + genre_ID + '"}';

	var url = urlBase + '/admin.php?action=add_artist';
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
			document.getElementById("submitResult").innerHTML = "Artist added.";
		}
	}
	catch(err)
	{
		document.getElementById("submitResult").innerHTML = err.message;
	}

}
