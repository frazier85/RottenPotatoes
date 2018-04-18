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
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Name">
              </div>
              </div>
              <div class = "col">
              <div class="form-group">
                <label for="name">Icon</label>
                <input type="text" class="form-control" id="icon" placeholder="Icon URL">
              </div>
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="col-2">
                <button type="button" class="btn btn-primary" onClick="addStore();">Submit</button>
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
