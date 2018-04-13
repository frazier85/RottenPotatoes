<?PHP
session_start();

function renderTitle()
{
  echo '<a class="navbar-brand" href="http://project.codethree.net"><img src="potato.png" width="55" height="55">  Rotten Potatoes</a>';
}

function renderFooter()
{
  echo "<center>©2018 Rotten Potatoes Group. All rights reserved.</center>";
}

//Used on pages normal users should not see
function markPageDangerous()
{
  if(!isset($_SESSION["user"]) or $_SESSION["admin"] < 1)
  {
    header("Location: http://project.codethree.net");
    //Die in case sneaky users disable redirects
    die();
  }
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
