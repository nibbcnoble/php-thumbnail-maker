# php-thumbnail-maker
build thumbnails to a particular size and center them to a certain part of the image.

First off, there is a super fantastic flaw which I am WELL aware of.  PHP globals were turned on with the server this program was built on.  I WILL remove the globals in a future iteration.  I know its a bad, bad thing.
Other requirements: PHP 5, jQuery, jQuery UI

How the program works:  

1. An image is uploaded to a temporary location
2. There is a default thumbnail size that can be set in the code.inc.php file, but could be set into the initial upload form
3. The image can then be resized and the blue thumbnail crop box can be moved over the part of the image that should be cropped.
4. once submitted, a new cropped thumbnail is created at a set location.

This program requires a good knowledge of Javascript and PHP.

Possible Issues:  File uploads can sometimes be blocked due to file permissions issues.  Make sure that the location you set the write location to exists with proper permissions.  
