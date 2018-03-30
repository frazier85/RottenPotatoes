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
