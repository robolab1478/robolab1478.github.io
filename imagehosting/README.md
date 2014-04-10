ImageHosting
============
ImageHosting is a script that uploads an image to a server with an assigned URL.


Requirements:
============
	Apache Server with htaccess enabled
	PHP 5+
	lightbox.js (for UI, included)
	jquery (different versions required, included)

	
Run-through
===========

1. User uploads a file with the choose file button. Files are restricted to images.
2. User decides if they want to choose the url or have it made;
	If they choose to have a custom URL, they enter it.
	Oherwise, they decide how many characters the random URL should be. 
3. The image is uploaded and URL is created
4. The user is redirected to the image page. 
