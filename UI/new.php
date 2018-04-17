<?PHP
require_once "common.php";
markPageDangerous();
?>
<!DOCTYPE html>
  <html>
    <head>
      <?PHP generateHeader("New - Rotten Potatoes"); ?>
    </head>
    <body>
      <nav class="navbar navbar-light bg-light">
        <?PHP
        renderTitle();
        renderAdminButtons();
        renderWelcome(); ?>
      </nav>
      <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <div class=row>
            <div class="col">
              <button class="btn btn-outline-success" type="button" onClick="window.location.href='newAlbum.php'">New Album</button>
            </div>
            <div class="col">
              <button class="btn btn-outline-success" type="button" onClick="window.location.href='newArtist.php'">New Artist</button>
            </div>
            <div class="col">
              <button class="btn btn-outline-success" type="button" onClick="window.location.href='newGenre.php'">New Genre</button>
            </div>
          </div>
        </div>
      </div>
      <?PHP renderFooter(); ?>
    </body>
  </html>
