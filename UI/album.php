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

      function addRating()
      {
        var result = document.getElementById("rateResult");
      	var rating = document.getElementById("rating").value;
      	var body = document.getElementById("body").value;
        var albumId = getQueryVariable("id");
        var userId = <?PHP
          if(isset($_SESSION["userid"]))
            echo $_SESSION["userid"] . ";\r\n";
          else
            echo "-1;\r\n";
        ?>


        if(userId > 0)
        {
          var jsonPayload = '{"body" : "' + body + '", "uid" : "' + userId + '", "id" : "' + albumId + '", "rating" : "' + rating + '"}';
          var url = urlBase + '/review.php?action=add';
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
              pageRefresh();
            }
          }
          catch(err)
          {
            document.getElementById("rateResult").innerHTML = "There was a problem.";
          }
        }
      }

      function playPreview(url, el)
      {
        if(currentPlaying != null)
        {
          stopPreview(source.src, currentPlaying);
        }
        currentPlaying = el;
        source.src = url;
        player.load();
        player.play();
        el.classList.remove("fa-play");
        el.classList.add("fa-stop");
        el.setAttribute("onclick", "stopPreview('"+url+"', this)");
      }
      function stopPreview(url, el)
      {
        player.pause();
        player.currentTime = 0;
        el.classList.add("fa-play");
        el.classList.remove("fa-stop");
        el.setAttribute("onclick", "playPreview('"+url+"', this)");
      }
      function getPlay(url)
      {
        return '<i class="fa fa-play clickable" onclick="playPreview(\''+url+'\', this)"><span style="display:none">'+url+'</span></i>';
      }
      function getStop(url)
      {
        return '<i class="fa fa-stop clickable" onclick="stopPreview(\''+url+'\', this)"><span style="display:none">'+url+'</span></i>';
      }
      function getError()
      {
        return '<i class="fa fa-window-close" aria-hidden="true"></i>';
      }



      function getStoreRow(name, icon, link)
      {
        var html = '<div class="row">';
        html += '<a href="' + link + '" target="_blank">';
        html += '<img src="' + icon + '" alt="' + name + '" width="30" height="30">';
        html += ' Buy on ' + name;
        html += '</a></div>';
        return html;
      }
      function getSongRow(name, preview, length)
      {
        var html = '<div class="row songrow notext" ><div class="col fifty">';
        var icon = getPlay(preview);
        if(preview === "" || typeof preview == 'undefined' || preview == null)
        {
          icon = getError();
        }
        html += icon + '</div>';
        html += '<div class="col">' + name + '</div>';
        html += '<div class="col seccol">' + formatMSS(length) + '</div></div>';
        return html;
      }
      function getReviewCard(id, body, uid, username, rating)
      {
        var html = '<div class="review">';
        html += '<div class="reviewholder">';
        html += '<i class="fa fa-user" aria-hidden="true"></i>&nbsp; <b>' + username + '</b><br />';
        html += '<i class="fa fa-star" aria-hidden="true"></i>&nbsp; <span>' + rating + '</span><br />';
        html += '<i class="fa fa-comment" aria-hidden="true"></i> <span>' + body + '</span></div></div>';
        return html;
      }
      window.onload = function () {
        player = document.getElementById("audioPlayer");
        source = player.firstChild;
        currentPlaying = null;
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
        var genre = document.getElementById("albumGenre");
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
                totalRating.innerHTML = jsonObject.rating.toFixed(1) + "/5";
              }
              else
              {
                totalRating.innerHTML = "No reviews yet"
              }
              artist.innerHTML = jsonObject.artist.name;
              year.innerHTML   = jsonObject.year;
              artwork.src = jsonObject.iconUrl;
              genre.innerHTML = '<a href="http://project.codethree.net/genre.php?id=' + jsonObject.genre.id + '">' + jsonObject.genre.name + '</a>'
              var i;
              var songList = document.getElementById("songListing");
    					for( i in jsonObject.songs)
    					{
    						 songList.innerHTML += getSongRow(jsonObject.songs[i].name,
    							 jsonObject.songs[i].preview_url, jsonObject.songs[i].length);
                 if((jsonObject.songs[i].preview_url || "") === ""
                 || jsonObject.songs[i].preview_url == null
                 || typeof jsonObject.songs[i].preview_url == 'undefined')
                 {
                   document.getElementById("warningSpotify").innerHTML = getError() + "<b>  Not all songs have Spotify previews due to licensing restrictions.<b/>";
                 }
    					}
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
          //Get user rating
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
        //Get store links
        var storeUrl = urlBase + '/general.php?action=get_links';
        var pload = '{"id" :' + albumId + '}';
        var req = new XMLHttpRequest();
        req.open("POST", storeUrl, true);
        req.setRequestHeader("Content-type", "application/json; charset=UTF-8");
        try
        {
          req.onreadystatechange = function()
          {
            if (this.readyState == 4 && this.status == 200)
            {
              var resp = JSON.parse(req.responseText);
              var i;
              var albumInfo = document.getElementById("albumInfo");
    					for( i in resp.links)
    					{
    						 albumInfo.innerHTML += getStoreRow(resp.links[i].store, resp.links[i].icon, resp.links[i].url);
    					}
            }
          };
          req.send(pload);
        }
        catch(err)
        {
          document.getElementById("errorLabel").innerHTML = err.message;
        }
        //Finally, get reviews
        var reviewUrl = urlBase + '/review.php?action=get_reviews';
        var rpload = '{"id" :' + albumId + '}';
        var rreq = new XMLHttpRequest();
        rreq.open("POST", reviewUrl, true);
        rreq.setRequestHeader("Content-type", "application/json; charset=UTF-8");
        try
        {
          rreq.onreadystatechange = function()
          {
            if (this.readyState == 4 && this.status == 200)
            {
              var rresp = JSON.parse(rreq.responseText);
              var i;
              var reviews = document.getElementById("reviewListing");
    					for( i in rresp.reviews)
    					{
    						 reviews.innerHTML += getReviewCard(rresp.reviews[i].id, rresp.reviews[i].text, rresp.reviews[i].uid, rresp.reviews[i].username, rresp.reviews[i].rating);
    					}
              if(rresp.reviews.length == 0)
              {
                reviews.innerHTML = "No reviews";
              }
            }
          };
          rreq.send(rpload);
        }
        catch(err)
        {
          document.getElementById("errorLabel").innerHTML = err.message;
        }
      };
      </script>
      <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <div id="errorLabel" style="color:red"></div>
          <h1 id="albumName"><img src="spinner.gif" width="100" height="100"></h1>
          <div class="row">
            <div class="col hunnit">
              <img
              id="albumArtwork"
              src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22200%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20200%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_161d5427632%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_161d5427632%22%3E%3Crect%20width%3D%22200%22%20height%3D%22200%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2274.4375%22%20y%3D%22104.55625%22%3E200x200%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
              class="rounded float-left"
              alt="Album art"
              width="200"
              height="200">
            </div>
            <div class="col-7 notext" id="albumInfo">
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
                  Genre:
                </div>
                <div id="albumGenre" class="col">
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
                <form>
                  <div class="form-group">
                    <label for="Rate">Rate:</label>
                    <select id="rating">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>
                  </div>
                  <input class="form-control mr-sm-2 long-box" type="text" id="body" placeholder="Review Text" aria-label="reviewText" style="width:400px" maxlength="3900">
                  <button class="btn btn-outline-success my-2 my-sm-0" id="addRatingButton" type="button" onClick="addRating();">Submit Rating</button>
                </form>
                <span id="rateResult"></span>

              </div>
              <br />
            </div>
          </div>
        </div>
        <div class="container">
          <br />
          <p id="warningSpotify"></p>
          <audio id="audioPlayer"><source type="audio/mpeg"><track kind="captions"></audio>
          <section class="songList" id="songListing">

          </section>
          <br />
          <h4>Reviews</h4>
          <section class="reviewList" id="reviewListing">

          </section>
        </div>
      </div>
      <?PHP renderFooter(); ?>
    </body>
  </html>
