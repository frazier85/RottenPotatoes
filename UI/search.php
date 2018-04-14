<?PHP
require_once "common.php";
?>
<!DOCTYPE html>
  <html>
    <head>
      <?PHP generateHeader("Search - Rotten Potatoes"); ?>
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/react-instantsearch-theme-algolia@4.4.2">
      <link rel="stylesheet" href="code.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    </head>

    <body>

      <nav class="navbar navbar-light bg-light">
        <?PHP
        renderTitle();
        renderAdminButtons();
        ?>

        <form class="form-inline my-2 my-lg-0">
          <div class="form-group">
            <label for="searchType">Search By:</label>
            <select class="form-control" id="searchType">
              <option value="album_card">Album</option>
              <option value="artist_getalbums">Artist</option>


            </select>
          </div>
          <input class="form-control mr-sm-2 long-box" type="text" id="searchText" placeholder="Search" aria-label="Search" style="width:400px">

          <button class="btn btn-outline-success my-2 my-sm-0" id="searchButton" type="button" onClick="searchBy();">Search</button>

        </form>


          <?PHP renderWelcome(); ?>


      </nav>
      <div class="jumbotron jumbotron-fluid">

        <div class="container">

          <span id="searchResult"></span>

          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable">
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
        </div>
      </div>
      </div>

      <?PHP renderFooter(); ?>
    </body>

  </html>
