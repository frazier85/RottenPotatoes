<?PHP
require_once "common.php";
markPageDangerous();
?>
<!DOCTYPE html>
  <html>
    <head>
      <?PHP generateHeader("New Artist - Rotten Potatoes"); ?>
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
          <form class="form-inline my-2 my-lg-0">
            <div class="form-group">
              <label for="searchType">Genre:</label>
              <select class="form-control" id="genre_ID">
                <?php
                 define("IN_API", 1);
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
            <input class="form-control mr-sm-2 long-box" type="text" id="name" placeholder="Artist Name" aria-label="ArtistName" style="width:400px">
            <button class="btn btn-outline-success my-2 my-sm-0" id="newArtist" type="button" onClick="addArtist();">Submit Artist</button>
          </form>
        </div>
        <span id="submitResult"></span>
      </div>
      <?PHP renderFooter(); ?>
    </body>
  </html>
