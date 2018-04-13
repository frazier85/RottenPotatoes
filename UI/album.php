<?PHP
require_once "common.php";
?>
<!DOCTYPE html>
  <html>
    <head>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/react-instantsearch-theme-algolia@4.4.2">
      <script type="text/javascript" src="code.js"></script>
      <link rel="stylesheet" href="code.css">
    </head>

    <body>

      <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="http://project.codethree.net">Rotten Potatoes</a>

        <?PHP renderAdminButtons(); ?>

        <!-- <form class="form-inline my-2 my-lg-0">
          <div class="form-group">
            <label for="exampleSelect1">Search By:</label>
            <select class="form-control" id="searchType">
              <option>Album</option>
              <option>Artist</option>
              <option>Genre</option>
            </select>
          </div>
          <input class="form-control mr-sm-2 long-box" type="search" id="searchText" placeholder="Search" aria-label="Search" style="width:400px"> -->

          <button class="btn btn-outline-success my-2 my-sm-0" id="searchButton" type="button" onClick="window.location.href='search.html'">Search</button>

        <!-- </form> -->


          <?PHP renderWelcome(); ?>


      </nav>


      <center>Top of website stuff</center>

      <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1>Album Title Page</h1>
          <div class="row">
            <div class="col-3">
              <img src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22200%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20200%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_161d5427632%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_161d5427632%22%3E%3Crect%20width%3D%22200%22%20height%3D%22200%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2274.4375%22%20y%3D%22104.55625%22%3E200x200%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" class="rounded float-left" alt="...">
            </div>
            <div class="col-7">
              <div class="row">
                <div class="col-2">
                  Rating:
                </div>
                <div class="col">
                  #/5
                </div>
              </div>
              <div class="row">
                <div class="col-2">
                  Artist:
                </div>
                <div class="col">
                  Name or Names of artists
                </div>
              </div>
              <div class="row">
                <div class="col-2">
                  Released:
                </div>
                <div class="col">
                  When it was released
                </div>
              </div>
              <div class="row">
                <div class="col-2">
                  Your rating:
                </div>
                <div class="col">
                  Users rating/log in to leave a rating!
                </div>
              </div>
            </div>
          </div>
        </div>

        <p>

        <div class="container">
          <h1>Album Song List</h1>
        <h5>
          <div class="row">
            <div class="col">
            Preview
            </div>
            <div class="col">
            Song Name
            </div>
            <div class="col">
            Purchase Links
            </div>
          </div>
        </h5>

          <div style="max-height:500px;overflow:auto;">


              <div class="row">
                  <div class="col">
                    <img src="https://image.flaticon.com/icons/svg/26/26025.svg" alt="..." style="width:50px;height:50px">
                  </div>
                <div class="col">
                  Name
                </div>
                <div class="col">
                  <img src="http://icons.iconarchive.com/icons/dakirby309/simply-styled/256/Spotify-icon.png" alt="..." style="width:25px;height:25px">
                  <img src="https://png.icons8.com/ios/1600/itunes.png" alt="..." style="width:25px;height:25px">
                </div>
              </div>

              <p>

                <div class="row">
                    <div class="col">
                      <img src="https://image.flaticon.com/icons/svg/26/26025.svg" alt="..." style="width:50px;height:50px">
                    </div>
                  <div class="col">
                    Name
                  </div>
                  <div class="col">
                    <img src="http://icons.iconarchive.com/icons/dakirby309/simply-styled/256/Spotify-icon.png" alt="..." style="width:25px;height:25px">
                    <img src="https://png.icons8.com/ios/1600/itunes.png" alt="..." style="width:25px;height:25px">
                  </div>
                </div>

              <p>

                <div class="row">
                    <div class="col">
                      <img src="https://image.flaticon.com/icons/svg/26/26025.svg" alt="..." style="width:50px;height:50px">
                    </div>
                  <div class="col">
                    Name
                  </div>
                  <div class="col">
                    <img src="http://icons.iconarchive.com/icons/dakirby309/simply-styled/256/Spotify-icon.png" alt="..." style="width:25px;height:25px">
                    <img src="https://png.icons8.com/ios/1600/itunes.png" alt="..." style="width:25px;height:25px">
                  </div>
                </div>

              <p>

                <div class="row">
                    <div class="col">
                      <img src="https://image.flaticon.com/icons/svg/26/26025.svg" alt="..." style="width:50px;height:50px">
                    </div>
                  <div class="col">
                    Name
                  </div>
                  <div class="col">
                    <img src="http://icons.iconarchive.com/icons/dakirby309/simply-styled/256/Spotify-icon.png" alt="..." style="width:25px;height:25px">
                    <img src="https://png.icons8.com/ios/1600/itunes.png" alt="..." style="width:25px;height:25px">
                  </div>
                </div>

              <p>

                <div class="row">
                    <div class="col">
                      <img src="https://image.flaticon.com/icons/svg/26/26025.svg" alt="..." style="width:50px;height:50px">
                    </div>
                  <div class="col">
                    Name
                  </div>
                  <div class="col">
                    <img src="http://icons.iconarchive.com/icons/dakirby309/simply-styled/256/Spotify-icon.png" alt="..." style="width:25px;height:25px">
                    <img src="https://png.icons8.com/ios/1600/itunes.png" alt="..." style="width:25px;height:25px">
                  </div>
                </div>

                <p>

                <div class="row">
                    <div class="col">
                      <img src="https://image.flaticon.com/icons/svg/26/26025.svg" alt="..." style="width:50px;height:50px">
                    </div>
                  <div class="col">
                    Name
                  </div>
                  <div class="col">
                    <img src="http://icons.iconarchive.com/icons/dakirby309/simply-styled/256/Spotify-icon.png" alt="..." style="width:25px;height:25px">
                    <img src="https://png.icons8.com/ios/1600/itunes.png" alt="..." style="width:25px;height:25px">
                  </div>
                </div>

                <p>

                  <div class="row">
                      <div class="col">
                        <img src="https://image.flaticon.com/icons/svg/26/26025.svg" alt="..." style="width:50px;height:50px">
                      </div>
                    <div class="col">
                      Name
                    </div>
                    <div class="col">
                      <img src="http://icons.iconarchive.com/icons/dakirby309/simply-styled/256/Spotify-icon.png" alt="..." style="width:25px;height:25px">
                      <img src="https://png.icons8.com/ios/1600/itunes.png" alt="..." style="width:25px;height:25px">
                    </div>
                  </div>

                  <p>

                  <div class="row">
                      <div class="col">
                        <img src="https://image.flaticon.com/icons/svg/26/26025.svg" alt="..." style="width:50px;height:50px">
                      </div>
                    <div class="col">
                      Name
                    </div>
                    <div class="col">
                      <img src="http://icons.iconarchive.com/icons/dakirby309/simply-styled/256/Spotify-icon.png" alt="..." style="width:25px;height:25px">
                      <img src="https://png.icons8.com/ios/1600/itunes.png" alt="..." style="width:25px;height:25px">
                    </div>
                  </div>

          </div>
        </div>

      </div>

      <?PHP renderFooter(); ?>
    </body>

  </html>
