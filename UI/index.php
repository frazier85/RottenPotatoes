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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    </head>

    <body>

      <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="http://project.codethree.net">Rotten Potatoes</a>

        <?PHP renderAdminButtons(); ?>

        <!-- <form class="form-inline my-2 my-lg-0">
          <div class="form-group">
            <label for="searchType">Search By:</label>
            <select class="form-control" id="searchType">
              <option value="album_card">Album</option>
              <option value="artist_getalbums">Artist</option>


            </select>
          </div>
          <input class="form-control mr-sm-2 long-box" type="text" id="searchText" placeholder="Search" aria-label="Search" style="width:400px"> -->

          <button class="btn btn-outline-success my-2 my-sm-0" id="searchButton" type="button" onClick="window.location.href='search.php'">Search</button>

        <!-- </form> -->


          <?PHP renderWelcome(); ?>

      </nav>


      <center>Top of website stuff</center>

      <div class="jumbotron jumbotron-fluid">
        <div class="container">

          <span id="searchResult"></span>
          <select id="resultList" style="display:none; visibility:hidden;">
            <!-- <option value="volvo">Volvo</option> -->
          </select>



            <table class="table1" id="dataTable">
                <thead>
                  <th>Icon</th>
                  <th>Title</th>
                  <th>Year</th>
                  <th>Artist</th>
                  <th>Genre</th>
                </thead>
                <tbody id="rowData">
                </tbody>
              </table>



          <h5>Snazzy front page stuff</h5>
          </div>
        </div>

      </div>

      <?PHP renderFooter(); ?>
    </body>

  </html>
