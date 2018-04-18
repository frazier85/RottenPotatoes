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
        ?>
        <?PHP renderWelcome(); ?>
      </nav>
      <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <div class=row>
            <div class = "col">
              <button class="btn btn-outline-success" type="button" onClick="window.location.href='promoteUser.php'">Promote User</button>
            </div>
            <div class = "col">
              <button class="btn btn-outline-success" type="button" onClick="window.location.href='demoteUser.php'">Demote User</button>
            </div>
          </div>
        </div>
      </div>
      <?PHP renderFooter(); ?>
    </body>
  </html>
