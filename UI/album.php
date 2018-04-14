<?PHP
require_once "common.php";
?>
<!DOCTYPE html>
  <html>
    <head>
      <?PHP generateHeader(); ?>
    </head>
    <body>
<!-- TODO:
- Purchase links (for album)
- Let user edit / add their review
- List other reviews
- List songs (I'll do this after my coffee break)
-->
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
          var userId = <?PHP
            if(isset($_SESSION["userid"]))
              echo $_SESSION["userid"] . ";\r\n";
            else
              echo "-1;\r\n";
          ?>
          var albumId = getQueryVariable("id");
          var name = 	document.getElementById("albumName");
          var artwork = document.getElementById("albumArtwork");
          var artist = 	document.getElementById("albumArtist");
          var year = 	document.getElementById("albumYear");
          var userRating = 	document.getElementById("albumUserRating");
          var totalRating = document.getElementById("albumTotalRating");
          var jsonPayload = '{"id" :' + albumId  + '}';
          var url = urlBase + '/general.php?action=get_album';
          var xhr = new XMLHttpRequest();
        	xhr.open("POST", url, true);
        	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
          try
          {
            xhr.onreadystatechange = function()
            {
              if (this.readyState == 4 && this.status == 200)
              {
                var jsonObject = JSON.parse(xhr.responseText);
                name.innerHTML = jsonObject.name;
                if(jsonObject.rating > 0)
                {
                  totalRating.innerHTML = jsonObject.rating + "/5";
                }
                else
                {
                  totalRating.innerHTML = "No reviews yet"
                }
                artist.innerHTML = jsonObject.artist.name;
                year.innerHTML   = jsonObject.year;
                artwork.src = jsonObject.iconUrl;
              }
            };
            xhr.send(jsonPayload);
          }
          catch(err)
          {
            document.getElementById("errorLabel").innerHTML = err.message;
          }
          if(userId > 0)
          {
            var ratingUrl = urlBase + '/review.php?action=get_users_review';
            ratingPayload = '{"id" :' + userId  + ',"albumid":' +  albumId + '}';
            var reviewReq = new XMLHttpRequest();
          	reviewReq.open("POST", ratingUrl, true);
          	reviewReq.setRequestHeader("Content-type", "application/json; charset=UTF-8");
            try
            {
              reviewReq.onreadystatechange = function()
              {
                if (this.readyState == 4 && this.status == 200)
                {
                  var response = JSON.parse(reviewReq.responseText);
                  userRating.innerHTML = response.rating;
                }
              };
              reviewReq.send(ratingPayload);
            }
            catch(err)
            {
              document.getElementById("errorLabel").innerHTML = err.message;
            }
          }
          else
          {
            userRating.innerHTML = "<a href='/loginOrRegister.php'>Login or register</a> to review!\r\n";
          }
        };
      </script>
      <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <div id="errorLabel" style="color:red"></div>
          <h1 id="albumName"><img src="spinner.gif" width="100" height="100"></h1>
          <div class="row">
            <div class="col-3">
              <img
              id="albumArtwork"
              src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22200%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20200%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_161d5427632%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_161d5427632%22%3E%3Crect%20width%3D%22200%22%20height%3D%22200%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2274.4375%22%20y%3D%22104.55625%22%3E200x200%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
              class="rounded float-left"
              alt="Album art"
              width="200"
              height="200">
            </div>
            <div class="col-7">
              <div class="row">
                <div class="col-2">
                  Rating:
                </div>
                <div id="albumTotalRating" class="col">
                  <img src="spinner.gif" width="30" height="30">
                </div>
              </div>
              <div class="row">
                <div class="col-2">
                  Artist:
                </div>
                <div id="albumArtist" class="col">
                  <img src="spinner.gif"  width="30" height="30">
                </div>
              </div>
              <div class="row">
                <div class="col-2">
                  Released:
                </div>
                <div id="albumYear" class="col">
                  <img src="spinner.gif"  width="30" height="30">
                </div>
              </div>
              <div class="row">
                <div class="col-2">
                  Your rating:
                </div>
                <div id="albumUserRating" class="col">
                  <img src="spinner.gif"  width="30" height="30">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <h1>Songs</h1>
          <br />
          <br />
        <!--<h5>
          <div class="row">
            <div class="col">
            Preview
            </div>
            <div class="col">
            Song Name
            </div>
          </div>
        </h5>-->
          <section style="max-height:500px;width:250px;overflow:vertical;text-align:left">
              <div class="row">
                  <div class="col">
                    <img src="https://image.flaticon.com/icons/svg/26/26025.svg" alt="..." height="25" width="25">
                  </div>
                <div class="col">
                  Name
                </div>
              </div>
          </section>
        </div>
      </div>
      <?PHP renderFooter(); ?>
    </body>
  </html>
