var urlBase = '/api';

// search.php portion
//===============================================================================
function searchByGenre()
{

	// change id names
	var query = document.getElementById("searchText").value;
	var searchList = document.getElementById("searchList");
	searchList.innerHTML = "";

	var jsonPayload = '{"query" : "' + query + '"}';
	var url = urlBase + '/search.php?by=genre';

	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
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

function searchByArtist()
{
	// change id names
	var query = document.getElementById("searchText").value;
	var searchList = document.getElementById("searchList");
	searchList.innerHTML = "";

	var jsonPayload = '{"query" : "' + query + '"}';
	var url = urlBase + '/search.php?by=artist';

	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
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

function searchByAlbum()
{
	// change id names
	var query = document.getElementById("searchText").value;
	var searchList = document.getElementById("searchList");
	searchList.innerHTML = "";

	var jsonPayload = '{"query" : "' + query + '"}';
	var url = urlBase + '/search.php?by=album';

	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
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

//===============================================================================
// end search







// admin.php portion
// ==========================================================================
function promote()
{
	// change id names
	var uid = document.getElementById("inputUid").value;

	var jsonPayload = '{"uid" : "' + uid + '"}';
	var url = urlBase + '/user.php?action=promote';

	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, false);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
	try
	{
		xhr.send(jsonPayload);

		var jsonObject = JSON.parse( xhr.responseText );

	}

	catch(err)
	{
		document.getElementById("contentResult").innerHTML = err.message;
	}


}

function demote()
{
	// change id names
	var uid = document.getElementById("inputUid").value;

	var jsonPayload = '{"uid" : "' + uid + '"}';
	var url = urlBase + '/user.php?action=demote';

	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, false);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
	try
	{
		xhr.send(jsonPayload);

		var jsonObject = JSON.parse( xhr.responseText );

	}

	catch(err)
	{
		document.getElementById("contentResult").innerHTML = err.message;
	}

}

function add_artist()
{
	// change id names ??
	var name = document.getElementById("inputArtistName").value;
	var genre = document.getElementById("inputGenreName").value;

	var jsonPayload = '{"name" : "' + name + '", "genre" : "' + genre + '"}';
	var url = urlBase + '/admin.php?action=add_artist';

	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
	try
	{
		xhr.onreadystatechange = function()
		{
			if (this.readyState == 4 && this.status == 200)
			{
				hideOrShow( "contentList", false );

				document.getElementById("contentResult").innerHTML = "Artist has been added";
			}
		};
		xhr.send(jsonPayload);
	}
	catch(err)
	{
		document.getElementById("contentResult").innerHTML = err.message;
	}

}

function add_genre()
{
	// change id names ??
	var name = document.getElementById("inputGenreName").value;

	var jsonPayload = '{"name" : "' + name + '"}';
	var url = urlBase + '/admin.php?action=add_genre';

	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
	try
	{
		xhr.onreadystatechange = function()
		{
			if (this.readyState == 4 && this.status == 200)
			{
				hideOrShow( "contentList", false );

				document.getElementById("contentResult").innerHTML = "Genre has been added";
			}
		};
		xhr.send(jsonPayload);
	}
	catch(err)
	{
		document.getElementById("contentResult").innerHTML = err.message;
	}

}

function add_ablum()
{
	// ??
}

function add_store()
{
	// change id names ??
	var name = document.getElementById("inputStoreName").value;
	var icon = document.getElementById("inputIcon").value;

	var jsonPayload = '{"name" : "' + name + '", "icon" : "' + icon + '"}';
	var url = urlBase + '/admin.php?action=add_store';

	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
	try
	{
		xhr.onreadystatechange = function()
		{
			if (this.readyState == 4 && this.status == 200)
			{
				hideOrShow( "contentList", false );

				document.getElementById("contentResult").innerHTML = "store has been added";
			}
		};
		xhr.send(jsonPayload);
	}
	catch(err)
	{
		document.getElementById("contentResult").innerHTML = err.message;
	}

}

function add_storelink()
{
	// change id names ??
	var link = document.getElementById("inputStoreLink").value;
	var store = document.getElementById("inputStoreName").value;
	var album = document.getElementById("inputAlbum").value;

	var jsonPayload = '{"name" : "' + name + '", "icon" : "' + icon + '"}';
	var url = urlBase + '/admin.php?action=add_storelink';

	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
	try
	{
		xhr.onreadystatechange = function()
		{
			if (this.readyState == 4 && this.status == 200)
			{
				hideOrShow( "contentList", false );

				document.getElementById("contentResult").innerHTML = "storelink has been added";
			}
		};
		xhr.send(jsonPayload);
	}
	catch(err)
	{
		document.getElementById("contentResult").innerHTML = err.message;
	}
}

function del_storelink()
{
	// change id names ??
	var id = document.getElementById("inputID").value;

	var jsonPayload = '{"id" : "' + id + '"}';
	var url = urlBase + '/admin.php?action=del_storelink';

	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
	try
	{
		xhr.onreadystatechange = function()
		{
			if (this.readyState == 4 && this.status == 200)
			{
				hideOrShow( "contentList", false );

				document.getElementById("contentResult").innerHTML = "storelink has been deleted";
			}
		};
		xhr.send(jsonPayload);
	}
	catch(err)
	{
		document.getElementById("contentResult").innerHTML = err.message;
	}
}

function del_store()
{
	// change id names ??
	var id = document.getElementById("inputID").value;

	var jsonPayload = '{"id" : "' + id + '"}';
	var url = urlBase + '/admin.php?action=del_store';

	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
	try
	{
		xhr.onreadystatechange = function()
		{
			if (this.readyState == 4 && this.status == 200)
			{
				hideOrShow( "contentList", false );

				document.getElementById("contentResult").innerHTML = "store has been deleted";
			}
		};
		xhr.send(jsonPayload);
	}
	catch(err)
	{
		document.getElementById("contentResult").innerHTML = err.message;
	}
}

function del_album()
{

}

function del_genre()
{
	// change id names ??
	var id = document.getElementById("inputID").value;

	var jsonPayload = '{"id" : "' + id + '"}';
	var url = urlBase + '/admin.php?action=del_genre';

	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
	try
	{
		xhr.onreadystatechange = function()
		{
			if (this.readyState == 4 && this.status == 200)
			{
				hideOrShow( "contentList", false );

				document.getElementById("contentResult").innerHTML = "genre has been deleted";
			}
		};
		xhr.send(jsonPayload);
	}
	catch(err)
	{
		document.getElementById("contentResult").innerHTML = err.message;
	}
}

function del_artist()
{
	// change id names ??
	var id = document.getElementById("inputID").value;

	var jsonPayload = '{"id" : "' + id + '"}';
	var url = urlBase + '/admin.php?action=del_artist';

	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
	try
	{
		xhr.onreadystatechange = function()
		{
			if (this.readyState == 4 && this.status == 200)
			{
				hideOrShow( "contentList", false );

				document.getElementById("contentResult").innerHTML = "artist has been deleted";
			}
		};
		xhr.send(jsonPayload);
	}
	catch(err)
	{
		document.getElementById("contentResult").innerHTML = err.message;
	}
}

function del_user()
{
	// change id names ??
	var id = document.getElementById("inputID").value;

	var jsonPayload = '{"id" : "' + id + '"}';
	var url = urlBase + '/admin.php?action=del_user';

	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
	try
	{
		xhr.onreadystatechange = function()
		{
			if (this.readyState == 4 && this.status == 200)
			{
				hideOrShow( "contentList", false );

				document.getElementById("contentResult").innerHTML = "user has been deleted";
			}
		};
		xhr.send(jsonPayload);
	}
	catch(err)
	{
		document.getElementById("contentResult").innerHTML = err.message;
	}
}

// ==============================================================================
// end admin





// user.php portion
//===============================================================================
function register()
{
	// change id names ??
	var fname = document.getElementById("inputFirstName").value;
	var lname = document.getElementById("inputLastName").value;
	var email = document.getElementById("inputEmail").value;

	// can user/pass be passed once overall and not in each function?
	var username = document.getElementById("loginUsername").value;
	var password = md5(document.getElementById("loginPassword").value);

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


function doLogin()
{
	uid = 0;

	// change id names
	var username = document.getElementById("loginUsername").value;
	var password = md5(document.getElementById("loginPassword").value);

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
		document.getElementById("userDisplay").innerHTML = displayName;
		document.getElementById("loginUsername").value = "";
		document.getElementById("loginPassword").value = "";

		hideOrShow( "loggedInDiv", true);
		hideOrShow( "accessUIDiv", true);
		hideOrShow( "loginDiv", false);
	}
	catch(err)
	{
		document.getElementById("loginResult").innerHTML = err.message;
	}

}

function doLogout()
{
	uid = 0;

	hideOrShow( "loggedInDiv", false);
	hideOrShow( "accessUIDiv", false);
	hideOrShow( "loginDiv", true);
}
//===============================================================================
//end user


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
