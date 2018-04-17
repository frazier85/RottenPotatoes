<?PHP
require_once "common.php";
?>
<!DOCTYPE html>
  <html>
    <head>
      <?PHP generateHeader(); ?>
    </head>
    <body>
      <nav class="navbar navbar-light bg-light">
        <?PHP
        renderTitle();
        renderAdminButtons();
        renderWelcome(); ?>
      </nav>
      <script>
        window.onload = function () {
          var genredId = getQueryVariable("id");
          var listing = document.getElementById("albumListing")
        	var url = urlBase + '/general.php?action=get_albums_bygenre';
          var payload = '{"id" :' + genredId + '}';
        	var xhr = new XMLHttpRequest();
        	xhr.open("POST", url, true);
      		try
      		{
      			xhr.onreadystatechange = function()
      			{
      				if (this.readyState == 4 && this.status == 200)
      				{
      					listing.innerHTML = "";
      					var jsonObject = JSON.parse(xhr.responseText);
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
                if(jsonObject.albums.length == 0)
                {
                  listing.innerHTML = "<center>No albums are in this genre!</center>";
                }
      				}
      			};
      			xhr.send(payload);
      		}
      		catch(err)
      		{
      			console.log(err);
      		}
          var nameUrl = urlBase + '/general.php?action=get_genre';
          var req = new XMLHttpRequest();
          req.open("POST", nameUrl, true);
          req.setRequestHeader("Content-type", "application/json; charset=UTF-8");
          try
          {
            req.onreadystatechange = function()
            {
              if (this.readyState == 4 && this.status == 200)
              {
                var response = JSON.parse(req.responseText);
                document.getElementById("pageTitle").innerHTML = response.name + " Albums";
              }
            };
            req.send(payload);
          }
          catch(err)
          {
            document.getElementById("errorLabel").innerHTML = err.message;
          }
        };
      </script>
      <div class="jumbotron jumbotron-xl-12">
        <p id="errorLabel"></p>
        <div class="container">
          <center><h4 id="pageTitle"><img src="spinner.gif" width="70" height="70"></h4></center>
          <div id="albumListing"><img src="spinner.gif"></div>
        </div>
      </div>
      <?PHP renderFooter(); ?>
    </body>

  </html>
