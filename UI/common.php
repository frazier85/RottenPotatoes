<?PHP
session_start();

function renderFooter()
{
  echo "<center>©2018 Rotten Potatoes Group. All rights reserved.</center>";
}

function renderAdminButtons()
{
  if(!isset($_SESSION["user"]))
  {
    return;
  }
  if($_SESSION["admin"] < 1)
  {
    return;
  }
  echo '<button class="btn btn-outline-success my-2 my-sm-0" id="addButton" type="submit" onClick="window.location.href=\'new.php\'">Add</button>';
}

function renderWelcome()
{
  echo '<span class="navbar-text">Hello, ';
  if(isset($_SESSION["user"]))
  {
    echo $_SESSION["user"];
  }
  else
  {
    echo "Guest";
  }
  echo "!  ";
  if(isset($_SESSION["user"]))
  {
    echo '<button class="btn btn-outline-success" type="button" onClick="logout();">Log Out</button>';
  }
  else
  {
    echo '<button class="btn btn-outline-success" type="button" onClick="window.location.href=\'loginOrRegister.php\'">Log In/Register</button>';
  }
  echo "</span>";
}

function renderNav()
{

}

 ?>
