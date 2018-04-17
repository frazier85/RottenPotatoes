<?PHP
require_once "common.php";
if(isset($_SESSION["user"]))
{
  header("Location: http://project.codethree.net");
}
?>
<!DOCTYPE html>
  <html>
    <head>
      <?PHP generateHeader("Login - Rotten Potatoes"); ?>
      <script type="text/javascript" src="md5.js"></script>
    </head>
    <body>
      <script>
      <?PHP
        //strpos() just verifies that if the user finds us on Google and logs in we're not going to
        //redirect them back to Google
        if(isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], "http://project.codethree.net") === 0)
        {
          echo 'var referrer = "' . $_SERVER['HTTP_REFERER'] . '";';
        }
        else
        {
          echo 'var referrer = "http://project.codethree.net";';
        }
      ?>
      </script>
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
              <label for="usernameInput">Username</label>
              <input type="text" class="form-control" id="usernameInput" placeholder="Username">
            </div>
            <div class="form-group">
              <label for="passwordInput">Password</label>
              <input type="password" class="form-control" id="passwordInput" placeholder="Password">
            </div>
          <div class="row justify-content-center">
            <div class="col-2">
              <button type="button" id="loginButton" class="btn btn-primary" onClick="login();">Login</button>
            </div>
            <div class="col-2">
              <button type="button" id="registerButton" class="btn btn-primary" onClick="register();">Register</button>
            </div>
          </div>
        </form>
        <span id="loginResult"></span>
        </div>
      </div>
      <?PHP renderFooter(); ?>
    </body>
  </html>
