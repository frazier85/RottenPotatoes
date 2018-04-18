<?PHP
session_start();

function getSpotifyToken()
{
  $cached = "token.txt";
  //Cache for 30 minutes
  if(file_exists($cached) && (filemtime($cached) > (time() - 60 * 30 )))
  {
    $file = file_get_contents($cached);
    echo $file;
  }
  else
  {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://accounts.spotify.com/api/token");
    curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded',"Authorization: Basic MGU2YWRkZjlkNjRiNGI0ZDljMWYzYjFmNjI0MTQ0MjI6MjlkNDBhMTk5NjdmNDQzY2I0YWQ0NjU2YzhiYThjMTU="));
    $response = curl_exec($ch);
    $data = json_decode($response, true);
    curl_close($ch);
    $token = $data["access_token"];
    file_put_contents($cached, $token, LOCK_EX);
    echo $token;
  }
}

function generateHeader($title = "Rotten Potatoes")
{
  echo "<title>$title</title>\r\n";
  echo '<script type="text/javascript" src="code.js"></script>' . "\r\n";
  echo '<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>'. "\r\n";
  echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>'. "\r\n";
  echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>'. "\r\n";
  echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/react-instantsearch-theme-algolia@4.4.2">'. "\r\n";
  echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">'. "\r\n";
  echo '<link rel="stylesheet" href="/css/font-awesome.min.css">'. "\r\n";
  echo '<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">'. "\r\n";
  echo '<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">'. "\r\n";
  echo '<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">'. "\r\n";
  echo '<link rel="manifest" href="/site.webmanifest">'. "\r\n";
  echo '<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">'. "\r\n";
  echo '<meta name="msapplication-TileColor" content="#da532c">'. "\r\n";
  echo '<meta name="theme-color" content="#FFFFFF">'. "\r\n";
  echo '<link rel="stylesheet" href="/rotten.css">'. "\r\n";
}

function renderTitle()
{
  echo '<a class="navbar-brand" href="http://project.codethree.net"><img src="potato.png" width="100" height="100">  Rotten Potatoes</a>';
}

function renderFooter()
{
  echo "<center>©2018 Rotten Potatoes Group. All rights reserved.</center><br /><br />";
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
  echo '<button class="btn btn-outline-success my-2 my-sm-0" id="delButton" type="submit" onClick="window.location.href=\'delete.php\'">Delete</button>';
  echo '<button class="btn btn-outline-success my-2 my-sm-0" id="userButton" type="submit" onClick="window.location.href=\'promoteDemote.php\'">Promote/Demote</button>';
}

function renderWelcome()
{
  echo '<button class="btn btn-outline-success my-2 my-sm-0" id="genreListing" type="button" onClick="window.location.href=\'genres.php\'">Genres</button>';
  echo '<button class="btn btn-outline-success my-2 my-sm-0" id="searchButton" type="button" onClick="window.location.href=\'search.php\'">Search</button>';
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
