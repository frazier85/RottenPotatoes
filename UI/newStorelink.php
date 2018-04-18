<?PHP
require_once "common.php";
markPageDangerous();
?>
<!DOCTYPE html>
  <html>
    <head>
      <?PHP generateHeader("New Store - Rotten Potatoes"); ?>
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
          <form>
            <div class = row>
              <div class = "col">
              <div class="form-group">
                <label for="name">Link</label>
                <input type="text" class="form-control" id="link" placeholder="Link">
              </div>
              </div>
              <div class = "col">
              <div class="form-group">
                <label for="name">Store</label>
                <input type="text" class="form-control" id="store" placeholder="Store">
              </div>
              </div>
              <div class = "col">
              <div class="form-group">
                <label for="name">Album</label>
                <input type="text" class="form-control" id="album" placeholder="Album">
              </div>
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="col-2">
                <button type="button" class="btn btn-primary" onClick="addStorelink();">Submit</button>
              </div>
            </div>
            </div>
          </form>
          <span id="submitResult"></span>
        </div>
        </div>
      </div>
      <?PHP renderFooter(); ?>
    </body>
  </html>
