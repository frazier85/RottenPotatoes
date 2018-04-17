<?PHP
require_once "common.php";
markPageDangerous();
?>
<!DOCTYPE html>
  <html>
    <head>
      <?PHP generateHeader("New Album - Rotten Potatoes"); ?>
    </head>
    <script>
      function songString(name, url, length)
      {
        return '{"name":"'+name+'","preview_url":"'+url+'", "length":'+length+'}';
      }
      function parseSongListing()
      {
        var listing = document.getElementById("songListing");
        console.debug(listing);
        if(listing.childElementCount < 1)
        {
          return "";
        }
        var json = "";
        for(var i = 0; i < listing.children.length; i++)
        {
          json += songString(listing.children[i].children[0].innerHTML, listing.children[i].children[1].innerHTML, listing.children[i].children[2].innerHTML) + ',';
        }
        //remove trailing comma
        json = json.substring(0, json.length - 1);
        return json;
      }
      function addAlbum()
      {
      	var album_artwork = document.getElementById("album_artwork").value;
      	var name = document.getElementById("name").value;
      	var artist_ID = document.getElementById("artist_ID").value;
      	var year = document.getElementById("year").value;
      	var genre_ID = document.getElementById("genre_ID").value;

      	document.getElementById("submitResult").innerHTML = "";

      	var jsonPayload = '{"name" : "' + name + '", "album_artwork" : "' + album_artwork + '", "year" : ' + year + ', "songs" : [' + parseSongListing() + '], "artist" : "' + artist_ID + '", "genre" : "' + genre_ID + '"}';
      	var url = urlBase + '/admin.php?action=add_album';
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
    </script>
    <body>
      <nav class="navbar navbar-light bg-light">
          <?PHP
          renderTitle();
          renderAdminButtons();
          renderWelcome(); ?>
      </nav>
      <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <form>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="icon">Album Image URL</label>
                  <input type="text" class="form-control" id="album_artwork" placeholder="Album Image URL">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="title">Album Title</label>
                  <input type="text" class="form-control" id="name" placeholder="Album Title">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="artistInput">Artist</label>

                    <div class="form-group">
                      <select name="Artist" id="artist_ID" class="form-control">
                        <?php
                          define("IN_API", 1);
                          require_once "api/global.php";

                          $dbc = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                          if (mysqli_connect_errno())
                          {
                          	sendError('There was an issue with our database. (' . mysqli_connect_errno() . ')');
                          	die();
                          }

                          $result = $dbc->query("SELECT * FROM ARTISTS");

                          while ($row = $result->fetch_assoc()) {
                              echo "<option value=\"" . $row['ID'] . "\">" . $row['name'] . "</option>";
                          }
                          ?>
                      </select>
                    </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                <div class="col">
                  <label for="yearInput">Year</label>

                  <input type="text" class="form-control" id="year" placeholder="Year">
                </div>
              </div>
              </div>
              <div class="col">

                <div class="form-group">
                  <label for="searchType">Genre:</label>
                  <select class="form-control" id="genre_ID">
                    <?php
                      require_once "api/global.php";

                      $dbc = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                      if (mysqli_connect_errno())
                      {
                        sendError('There was an issue with our database. (' . mysqli_connect_errno() . ')');
                        die();
                      }

                      $result = $dbc->query("SELECT * FROM GENRES");

                      while ($row = $result->fetch_assoc()) {
                          echo "<option value=\"" . $row['ID'] . "\">" . $row['name'] . "</option>";
                      }
                      ?>
                  </select>
                </div>

              </div>
            </div>
            <script>
            function getListingElement(album, id)
            {
              return '<p onclick="autofill(\'' + id + '\')" class="album">' + album + '</p>';
            }
            function showResult(txt)
            {
              var listing = document.getElementById("resultsList");
              var url = "https://api.spotify.com/v1/search?type=album&limit=10&q=";
              if(txt.length < 3)
              {
                listing.innerHTML = "";
                return;
              }
              //Encoding spaces into hex format
              url += txt.replace(" ", "%20");
              var req = new XMLHttpRequest();
              req.open("GET", url, true);
              req.setRequestHeader("Authorization", "Bearer <?PHP getSpotifyToken(); ?>");
              req.onreadystatechange = function()
        			{
        				if (this.readyState == 4 && this.status == 200)
        				{
        					listing.innerHTML = "";
        					var jsonObject = JSON.parse(req.responseText);
        					var i;
        					for(i in jsonObject.albums.items)
        					{
        						listing.innerHTML += getListingElement(jsonObject.albums.items[i].name, jsonObject.albums.items[i].id);
        					}
        				}
        			};
              req.send();
            }
            function getSongElement(name, preview, length)
            {
              var html = '<div class="row"><div class="col">' + name;
              //Length is in MS, convert to seconds
              html += '</div><div class="col cutoff">' + preview + '</div><div class="col cutoff">' + Math.ceil((length / 1000)) + '</div></div>';
              return html;
            }
            function autofill(id)
            {
              var txtYear = document.getElementById("year");
              var txtAutofill = document.getElementById("spotifySearch");
              var txtName = document.getElementById("name");
              var txtImage = document.getElementById("album_artwork");
              var url = "https://api.spotify.com/v1/albums/" + id + "?market=US";
              var req = new XMLHttpRequest();
              req.open("GET", url, true);
              req.setRequestHeader("Authorization", "Bearer <?PHP getSpotifyToken(); ?>");
              req.onreadystatechange = function()
              {
                if (this.readyState == 4 && this.status == 200)
                {
                  var jsonObject = JSON.parse(req.responseText);
                  txtYear.value = jsonObject.release_date.split("-")[0];
                  txtName.value = jsonObject.name;
                  //Not really necessary but it looks better in a demo
                  txtAutofill.value = jsonObject.name;
                  txtImage.value = jsonObject.images[0].url;
                  //TODO: Loop through tracks
                  var i;
                  var listing = document.getElementById("songListing");
                  listing.innerHTML = "";
                  for(i in jsonObject.tracks.items)
                  {
                    listing.innerHTML += getSongElement(jsonObject.tracks.items[i].name, jsonObject.tracks.items[i].preview_url || "", jsonObject.tracks.items[i].duration_ms);
                  }
                }
              };
              req.send();
            }
            </script>
            <div class="col">
              <div class="form-group">
                <label for="title">Spotify® Auto-fill™</label>
                <div class="holder">
                  <input type="text" class="form-control" id="spotifySearch" placeholder="Type an album name..." onkeyup="showResult(this.value)">
                  <div class="results" id="resultsList">
                  </div>
                </div>
              </div>
            </div>
            <div class="container">
              <br />
              <section style="max-height:300px;width:95%;overflow-y:scroll;overflow-x:hidden;text-align:left" id="songListing">

              </section>
              <br />
            </div>
            <div class="row justify-content-center">
              <div class="col-2">
                <button type="button" class="btn btn-primary" onClick="addAlbum();">Submit</button>
              </div>
            </div>
          </form>
          </div>
          <span id="submitResult"></span>
        </div>
      </div>
      <?PHP renderFooter(); ?>
    </body>

  </html>
