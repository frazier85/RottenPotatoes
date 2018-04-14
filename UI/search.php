<?PHP
require_once "common.php";
?>
<!DOCTYPE html>
  <html>
    <head>
      <?PHP generateHeader("Search - Rotten Potatoes"); ?>
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
