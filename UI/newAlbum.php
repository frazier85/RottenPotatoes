<?PHP
require_once "common.php";
markPageDangerous();
?>
<!DOCTYPE html>
  <html>
    <head>
      <?PHP generateHeader("New Album - Rotten Potatoes"); ?>
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
            <p>
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
