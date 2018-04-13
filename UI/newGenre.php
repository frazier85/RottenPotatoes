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

        <?PHP renderAdminButtons(); ?>

        <!-- <form class="form-inline my-2 my-lg-0">
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


          <?PHP renderWelcome(); ?>


      </nav>


      <center>Top of website stuff</center>

      <div class="jumbotron jumbotron-fluid">
        <div class="container">

          <form>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="file1">Album Image</label>
                  <input type="file" class="form-control-file" id="file1">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="titleInput">Album Title</label>
                  <input type="text" class="form-control" id="titleInput" placeholder="Album Title">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="artistInput">Artist</label>
                  <input type="text" class="form-control" id="titleInput" placeholder="Artist">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="form-group">
                <label for="ratingInput">Rating</label>
                <div class="col">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                    <label class="form-check-label" for="inlineRadio1">1</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                    <label class="form-check-label" for="inlineRadio2">2</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                    <label class="form-check-label" for="inlineRadio3">3</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="option4">
                    <label class="form-check-label" for="inlineRadio4">4</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio5" value="option5">
                    <label class="form-check-label" for="inlineRadio5">5</label>
                  </div>
                </div>
              </div>
              </div>

              <div class="col">
                <div class="form-group">
                  <label for="genreInput">Genre</label>
                  <input type="text" class="form-control" id="genreInput" placeholder="Genre">
                </div>
              </div>
            </div>
            <p>
            <div class="row justify-content-center">
              <div class="col-2">
                <button type="button" class="btn btn-primary" onClick="">Submit</button>
              </div>
            </div>

          </form>
          </div>
        </div>

        <span id="submitResult"></span>

      </div>

      <?PHP renderFooter(); ?>
    </body>

  </html>
