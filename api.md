#PHP API

(this is tentative but hopefully won't change too much)

**/api/user.php?action=<ACTION>**
* <ACTION> is "login": expects "username" and "password" and logs the user in Leinecker style. "admin" >= 1 if user has admin permissions, 0 otherwise
* <ACTION> is "register": expects "username", "password", "email", "fname", "lname" and registers user

**/api/search.php?by=<TYPE>**
* <TYPE> is "genre": expects "query" and returns a JSON of genres  
* <TYPE> is "album": expects "query" and returns a JSON of albums including URLs to their art
* <TYPE> is "artist": expects "query" and returns a JSON of artists

**/api/admin.php?action=<ACTION>**
* <ACTION> is "promote": expects "uid" (user ID of person to promote to admin) and gives user admin
* <ACTION> is "demote": opposite of promote
* <ACTION> is "add_artist": Expects "name", "genre" (INT)
* <ACTION> is "add_album": Expects "name", "genre" (INT), "icon" and "songs" which will be a JSON array of songs that has "id", "length", "artist" (INT) within each song
* <ACTION> is "add_genre": Expects "name"
* <ACTION> is "add_store": Expects "name", "icon"
* <ACTION> is "add_storelink": Expects "link", "store" (INT), "album" (INT). Recommended to be used as a button on the album display page that is only shown to admins
* For all of the "add_*" actions, replace 'add' with 'del' and you only need to pass "id" to delete each type of item. All (INT) variables are IDs
