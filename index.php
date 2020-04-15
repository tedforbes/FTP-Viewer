<?php require 'resizer.php'; ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FTP Viewer</title>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script>
		!window.jQuery && document.write('<script src="jquery-1.4.3.min.js"><\/script>');
	</script>
	<script type="text/javascript" src="./fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="./fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
	<link rel="stylesheet" type="text/css" href="./fancybox/jquery.fancybox-1.3.4.css" media="screen" />
	<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
	<link href="style.css" rel="stylesheet" />
	<script type="text/javascript">
		$(window).load(function(){
			$('.grid').masonry({
				itemSelector: '.grid-item',
				columnWideth: '.grid-sizer',
				percentPosition: true
			});
		});
		$(document).ready(function() {
			$("a[rel=image-group]").fancybox({
				'transitionIn'		: 'fade',
				'transitionOut'		: 'fade',
				'titlePosition' 	: 'over',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
			});
			$('body').fadeIn(500);
		});
	</script>
</head>

<body>
	<div id="top"></div>
	<h1>Sample Images</h1>
	<div class="grid" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": 0 }'>
		<div class="grid-sizer"></div>
<?php



	$directory = "images";

	// Scan the directory and make the newest images first
	$scanned_directory = array_diff(scandir($directory), array('..', '.','.DS_Store','.htaccess'));
	rsort($scanned_directory);
	
	// Work some magic
	foreach($scanned_directory as $file) {

		$sourceImage = $directory."/".$file;		
		$path_parts = pathinfo($sourceImage);
		$newImage = $path_parts['dirname']."/".$path_parts['filename']."_max.jpg";
		
		$findme = "_max";
		$pos = strpos ($sourceImage, $findme);
		
		if ($pos === false && file_exists($newImage)) {
			echo "<div class=\"grid-item\"><a rel=\"image-group\" href=\"$sourceImage\" title=\"$file\"><img src=\"$newImage\" alt=\"image\" /></a></div>";
		} 
		if ($pos === false && !file_exists($newImage)) {
			resize_image('max',$sourceImage,$newImage,950,950);
			echo "<div class=\"grid-item\"><a rel=\"image-group\" href=\"$sourceImage\" title=\"$file\"><img src=\"$newImage\" alt=\"image\" /></a></div>";
		}
	}
	

?></div>
</body>
</html>



















