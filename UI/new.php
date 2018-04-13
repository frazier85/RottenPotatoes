<?PHP
require_once "common.php";
?>
<!DOCTYPE html>
  <html>
    <head>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/react-instantsearch-theme-algolia@4.4.2">
      <script type="text/javascript" src="code.js"></script>
      <link rel="stylesheet" href="code.css">
    </head>

    <body>

      <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="http://project.codethree.net">Rotten Potatoes</a>

        <button class="btn btn-outline-success my-2 my-sm-0" id="addAlbumButton" type="submit" onClick="window.location.href='new.php'">Add</button>
<!--
        <form class="form-inline my-2 my-lg-0">
          <div class="form-group">
            <label for="exampleSelect1">Search By:</label>
            <select class="form-control" id="searchType">
              <option>Album</option>
              <option>Artist</option>
              <option>Genre</option>
            </select>
          </div>
          <input class="form-control mr-sm-2 long-box" type="search" id="searchText" placeholder="Search" aria-label="Search" style="width:400px"> -->

          <button class="btn btn-outline-success my-2 my-sm-0" id="searchButton" type="button" onClick="window.location.href='search.html'">Search</button>

        <!-- </form> -->


          <span class="navbar-text">Hello Guest</a>
            <button class="btn btn-outline-success" type="button" onClick="window.location.href='loginOrRegister.php'">Log In/Register</button>
            <button class="btn btn-outline-success" type="button" onClick="">Log Out</button>


      </nav>


      <center>Top of website stuff</center>

      <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <div class=row>
            <div class="col">
              <button class="btn btn-outline-success" type="button" onClick="window.location.href='newAlbum.php'">New Album</button>
            </div>
            <div class="col">
              <button class="btn btn-outline-success" type="button" onClick="window.location.href='newArtist.php'">New Artist</button>
            </div>
            <div class="col">
              <button class="btn btn-outline-success" type="button" onClick="window.location.href='newGenre.php'">New Genre</button>
            </div>
          </div>

        </div>

      </div>

      <?PHP renderFooter(); ?>
    </body>

  </html>
