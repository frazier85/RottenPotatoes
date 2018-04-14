<?PHP
session_start();

function generateHeader($title = "Rotten Potatoes")
{
  echo "<title>$title</title>";
  echo '<script type="text/javascript" src="code.js"></script>';
  echo '<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>';
  echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>';
  echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>';
  echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/react-instantsearch-theme-algolia@4.4.2">';
  echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">';
  echo '<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">';
  echo '<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">';
  echo '<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">';
  echo '<link rel="manifest" href="/site.webmanifest">';
  echo '<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">';
  echo '<meta name="msapplication-TileColor" content="#da532c">';
  echo '<meta name="theme-color" content="#ffffff">';
}

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
