<?PHP
require_once "common.php";
markPageDangerous();
?>
<!DOCTYPE html>
  <html>
    <head>
      <?PHP generateHeader("New Genre - Rotten Potatoes"); ?>
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
          <form>
              <div class="form-group">
                <label for="name">Genre</label>
                <input type="text" class="form-control" id="name" placeholder="Genre">
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="col-2">
                <button type="button" class="btn btn-primary" onClick="addGenre();">Submit</button>
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
