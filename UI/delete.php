<?PHP
require_once "common.php";
markPageDangerous();
?>
<!DOCTYPE html>
  <html>
    <head>
      <style>
        .row {
          padding: 10px;
        }
      </style>
      <?PHP generateHeader("Delete - Rotten Potatoes"); ?>
    </head>
    <body>
      <nav class="navbar navbar-light bg-light">
        <?PHP
        renderTitle();
        renderAdminButtons();
        ?>
        <?PHP renderWelcome(); ?>
      </nav>
      <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <div class=row>
            <div class = "col">
              <button class="btn btn-outline-success" type="button" onClick="window.location.href='delAlbum.php'">Delete Album</button>
            </div>
            <div class = "col">
              <button class="btn btn-outline-success" type="button" onClick="window.location.href='delArtist.php'">Delete Artist</button>
            </div>
            <div class = "col">
              <button class="btn btn-outline-success" type="button" onClick="window.location.href='delGenre.php'">Delete Genre</button>
            </div>
          </div>
          <div class=row>
            <div class="col">
              <button class="btn btn-outline-success" type="button" onClick="window.location.href='delStore.php'">Delete Store</button>
            </div>
            <div class="col">
              <button class="btn btn-outline-success" type="button" onClick="window.location.href='delStorelink.php'">Delete Storelink</button>
            </div>
          </div>
        </div>
      </div>
      <?PHP renderFooter(); ?>
    </body>
  </html>
