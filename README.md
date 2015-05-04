# php-thumbnail-maker
build thumbnails to a particular size and center them to a certain part of the image.

This is a solution for a problem I've had in several applications I've worked on.  This application will allow you to zoom in on an image and select an area to use for thumbnail images.  It works in much the same way that the facebook profile picture upload works.

How the program works:  

1. An image is uploaded to a temporary location
2. There is a default thumbnail size that can be set in the code.inc.php file, but could be set into the initial upload form
3. The image can then be resized and the blue thumbnail crop box can be moved over the part of the image that should be cropped.
4. once submitted, a new cropped thumbnail is created at a set location.

This program requires a good knowledge of Javascript and PHP.

Possible Issues:  File uploads can sometimes be blocked due to file permissions issues.  Make sure that the location you set the write location to exists with proper permissions.  

Setup:

1. Download the latest JQuery and JQuery UI releases and include them in your header.
2. the code.inc.php file just needs to be placed after the variable initialization.  You could actually just put these variables inside the code.inc.php file, but I find it helpful to have them on the page I'm working on.
3. include the form elements in the correct places.  I suggest creating a test version of the page as is and then adapt it to your application as needed.  This version simply creates the thumbnail and displays it.  You would presumably save the file with a specific filename and connect it to a record in a database.


