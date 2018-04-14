<?PHP
require_once "common.php";
?>
<!DOCTYPE html>
  <html>
    <head>
      <?PHP generateHeader("Search - Rotten Potatoes"); ?>
      <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />-->
    </head>
    <body>
      <nav class="navbar navbar-light bg-light">
        <?PHP
        renderTitle();
        renderAdminButtons();
        renderWelcome(); ?>
      </nav>
      <center style="width:750px;margin:auto;">
        <br />
        <form class="form-inline my-2 my-lg-0" action="#">
          <div class="form-group">
            <label for="searchType">Search By: </label>
            <select class="form-control" id="searchType">
              <option value="album_card">Albums</option>
              <option value="artist_getalbums">Artists</option>
            </select>
          </div>
           <input class="form-control mr-sm-2 long-box" type="text" id="searchText" placeholder="Search" aria-label="Search" style="width:400px">
           <button class="btn btn-outline-success my-2 my-sm-0" id="searchButton" type="button" onClick="searchBy();">Search</button>
        </form>
      </center>
      <br />
      <center><span id="searchResult"></span></center>
      <br />
      <div class="jumbotron jumbotron-fluid">
        <div class="container" id="albumListing">
          <!--
          <a class="card" href="http://project.codethree.net/album.php?id=31">
            <img src="https://i.imgur.com/IYH9rsJ.jpg" alt="Album art" height="220" width="220">
            <div class="albumholder">
              <i class="fa fa-user" aria-hidden="true"></i> <b>Rise Against</b><br />
              <i class="fa fa-music" aria-hidden="true"></i> <span>Rock</span><br />
              <i class="fa fa-dot-circle" aria-hidden="true"></i> <span>Endgame</span><br />
              <i class="fa fa-calendar" aria-hidden="true"></i> <span>2011</span>
            </div>
          </a>-->

        </div>
      </div>
      </div>
      <?PHP renderFooter(); ?>
    </body>
  </html>
