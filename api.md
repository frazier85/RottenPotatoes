#PHP API#

**/api/user.php?action=<ACTION>**
* <ACTION> is "login": expects "username" and "password" and logs the user in Leinecker style. "admin" >= 1 if user has admin permissions, 0 otherwise. creates a PHP session
* <ACTION> is "register": expects "username", "password", "email", "fname", "lname" and registers user
* <ACTION> is "logout": ends the PHP session, expects no data and returns no data

**/api/search.php?by=<TYPE>**
* <TYPE> is "album": expects "query" and returns a JSON of albums including URLs to their art
* <TYPE> is "album_card": expects "query" and returns a JSON of albums including URLs to their art and songs and artist name and genre name
* <TYPE> is "artist": expects "query" and returns a JSON of artists
* <TYPE> is "artist_getalbums": expects "query" and returns a JSON of albums that are by artists with similar names to the query

**/api/general.php?action=<ACTION>**
* <ACTION> is "get_genres": no POST data needed, returns all genres (useful for making a menu or area for users to browse)
* <ACTION> is "get_albums_bygenre": expects genre ID as "id", returns all albums in a genre
* <ACTION> is "get_albums_byartist": expects artist ID as "id", returns all albums by an artist
* <ACTION> is "get_album": expects album ID as "id", returns album info including songs

**/api/review.php?action=<ACTION>**
* <ACTION> is "get_reviews": expects album id as "id", returns reviews for that albums
* <ACTION> is "get_users_reviews": expects user id as "id", returns reviews made by that user
* <ACTION> is "get_review": expects review id as "id", returns a single review
* <ACTION> is "add": adds a review, expects "id" (album ID), "body", "uid" (user id), rating
* <ACTION> is "del": deletes a review, expects only "id" (review ID)
* <ACTION> is "edit": edits a review, expects "id" (review ID), "body", "rating"
* <ACTION> is "get_rating": expects album id as "id", returns average rating of album. A rating of -1 means there are no reviews for the album

**/api/admin.php?action=<ACTION>**
* <ACTION> is "promote": expects "uid" (user ID of person to promote to admin) and gives user admin
* <ACTION> is "demote": opposite of promote
* <ACTION> is "del_user": Expects id (user's ID)
* <ACTION> is "add_artist": Expects "name", "genre" (INT)
* <ACTION> is "add_album": Expects "name", "genre" (INT), "icon" and "songs" which will be a JSON array of songs that has "length" (INT), "name"  within each song
* <ACTION> is "add_genre": Expects "name"
* <ACTION> is "add_store": Expects "name", "icon"
* <ACTION> is "add_storelink": Expects "link", "store" (INT), "album" (INT). Recommended to be used as a button on the album display page that is only shown to admins
* For all of the "add_*" actions, replace 'add' with 'del' and you only need to pass "id" to delete each type of item. All (INT) variables are IDs
