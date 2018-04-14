<?PHP
require_once "common.php";
?>
<!DOCTYPE html>
  <html>
    <head>
      <?PHP generateHeader(); ?>
      <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
    </head>

    <body>

      <nav class="navbar navbar-light bg-light">
        <?PHP
        renderTitle();
        renderAdminButtons();
        ?>
        <button class="btn btn-outline-success my-2 my-sm-0" id="searchButton" type="button" onClick="window.location.href='search.php'">Search</button>
        <?PHP renderWelcome(); ?>
      </nav>
      <script>
        window.onload = function () {
          var listing = document.getElementById("albumListing")
        	var url = urlBase + '/general.php?action=mostrecent';
        	var xhr = new XMLHttpRequest();
        	xhr.open("GET", url, true);
      		try
      		{
      			xhr.onreadystatechange = function()
      			{
      				if (this.readyState == 4 && this.status == 200)
      				{
      					document.getElementById("albumListing").innerHTML = "";
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
      				}
      			};
      			xhr.send();
      		}
      		catch(err)
      		{
      			console.log(err);
      		}
        };
      </script>
      <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h3>Welcome to Rotten Potatoes</h3>
          <center><h4>Recently added</h4></center>
          <div id="albumListing"><img src="spinner.gif"></div>
        </div>
      </div>
      <?PHP renderFooter(); ?>
    </body>

  </html>
