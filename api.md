#PHP API#

**/api/user.php?action=<ACTION>**
* <ACTION> is "login": expects "username" and "password" and logs the user in Leinecker style. "admin" >= 1 if user has admin permissions, 0 otherwise
* <ACTION> is "register": expects "username", "password", "email", "fname", "lname" and registers user

**/api/search.php?by=<TYPE>**
* <TYPE> is "genre": expects "query" and returns a JSON of genres  
* <TYPE> is "album": expects "query" and returns a JSON of albums including URLs to their art
* <TYPE> is "album_card": expects "query" and returns a JSON of albums including URLs to their art and songs and artist name and genre name
* <TYPE> is "artist": expects "query" and returns a JSON of artists

**/api/review.php?action=<ACTION>**
* <ACTION> is "get_reviews": expects album id as "id", returns reviews for that albums
* <ACTION> is "add": adds a review, expects "id" (album ID), "body", "uid" (user id), rating
* <ACTION> is "del": deletes a review, expects only "id" (review ID)
* <ACTION> is "edit": edits a review, expects "id" (review ID), "body", "rating"
* <ACTION> is "get_rating": expects album id as "id", returns average rating of album. Rating will cache for 5 minutes

**/api/admin.php?action=<ACTION>**
* <ACTION> is "promote": expects "uid" (user ID of person to promote to admin) and gives user admin
* <ACTION> is "demote": opposite of promote
* <ACTION> is "del_user": Expects id (user's ID)
* <ACTION> is "add_artist": Expects "name", "genre" (INT)
* <ACTION> is "add_album": Expects "name", "genre" (INT), "icon" and "songs" which will be a JSON array of songs that has "id", "length", "artist" (INT) within each song
* <ACTION> is "add_genre": Expects "name"
* <ACTION> is "add_store": Expects "name", "icon"
* <ACTION> is "add_storelink": Expects "link", "store" (INT), "album" (INT). Recommended to be used as a button on the album display page that is only shown to admins
* For all of the "add_*" actions, replace 'add' with 'del' and you only need to pass "id" to delete each type of item. All (INT) variables are IDs
