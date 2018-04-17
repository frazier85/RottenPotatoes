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
        function getGenreRow(id, name)
        {
          return ' <button class="btn btn-outline-success" type="button" style="margin:15px;" onClick="window.location.href=\'genre.php?id='+id+'\'">'+name+'</button> ';
        }
        window.onload = function () {
          var listing = document.getElementById("albumListing")
        	var url = urlBase + '/general.php?action=get_genres';
        	var xhr = new XMLHttpRequest();
        	xhr.open("GET", url, true);
      		try
      		{
      			xhr.onreadystatechange = function()
      			{
      				if (this.readyState == 4 && this.status == 200)
      				{
      					listing.innerHTML = "";
      					var jsonObject = JSON.parse(xhr.responseText);
      					var i;
      					for( i in jsonObject.genres)
      					{
      						 listing.innerHTML += getGenreRow(jsonObject.genres[i].id,
      							 jsonObject.genres[i].name);

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
      <div class="jumbotron jumbotron-xl-12">
        <p id="errorLabel"></p>
        <div class="container">
          <center><h4 id="pageTitle">Genres</h4></center>
          <div id="albumListing" style="text-align:center"><img src="spinner.gif"></div>
        </div>
      </div>
      <?PHP renderFooter(); ?>
    </body>

  </html>
