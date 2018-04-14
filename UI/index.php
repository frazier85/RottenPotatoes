<?PHP
require_once "common.php";
?>
<!DOCTYPE html>
  <html>
    <head>
      <?PHP generateHeader(); ?>
      <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
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
          <h3>Welcome to Rotten Potatoes</h5>
          </div>
        </div>
      </div>
      <?PHP renderFooter(); ?>
    </body>

  </html>
