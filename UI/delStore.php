<?PHP
require_once "common.php";
markPageDangerous();
?>
<!DOCTYPE html>
  <html>
    <head>
      <?PHP generateHeader("Delete Store - Rotten Potatoes"); ?>
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
              <div class="form-group">
                <label for="name">Store</label>
                <select name="Store" id="store_ID" class="form-control">
                  <?php
                    define("IN_API", 1);
                    require_once "api/global.php";

                    $dbc = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    if (mysqli_connect_errno())
                    {
                      echo "Error: " . mysqli_connect_errno();
                    }

                    $result = $dbc->query("SELECT * FROM STORES");

                    while ($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row['ID'] . "\">" . $row['name'] . "</option>";
                    }
                    ?>
                </select>
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="col-2">
                <button type="button" class="btn btn-primary" onClick="delStore();">Delete</button>
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
