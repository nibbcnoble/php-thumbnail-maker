<?
function makepic($inputfile,$outputfile,$widthsize,$heightsize) {  // super simplified makepics (needs error handling)
list($width_orig, $height_orig, $imtype) = getimagesize($inputfile);

if($imtype=='1' or $imtype=='2' or $imtype=='3') { 
  $image_p = imagecreatetruecolor($widthsize, $heightsize);
  switch($imtype)//determines the type of image to create
  { 
  	case '1'://image type GIF
        $image = imagecreatefromgif($inputfile);
         break;
    case '2'://image type JPEG
         $image = imagecreatefromjpeg($inputfile);
          break;
    case '3'://image type PNG
         $image = imagecreatefrompng($inputfile);
          break; 
	 }
  imagecopyresampled($image_p, $image, 0, 0, 0, 0, $widthsize, $heightsize, $width_orig, $height_orig);
  imagejpeg($image_p, $outputfile, 100); 
}
} // end makepic

function imagecrop($inputfile, $rect) {  // $inputfile = the input file, $rect = array holding the x,y, and height, and width values for the crop box
	list($width_orig, $height_orig, $imtype) = getimagesize($inputfile);
	 $image_p = imagecreatetruecolor($rect['width'], $rect['height']);
  switch($imtype)//determines the type of image to create
  { 
  	case '1'://image type GIF
        $image = imagecreatefromgif($inputfile);
         break;
    case '2'://image type JPEG
         $image = imagecreatefromjpeg($inputfile);
          break;
    case '3'://image type PNG
         $image = imagecreatefrompng($inputfile);
          break; 
	 }
	 imagecopyresampled($image_p, $image, 0, 0,$rect['x'],$rect['y'], $rect['width'],$rect['height'],  $rect['width'],$rect['height']);
	// Output
  	imagejpeg($image_p, "finalimage.jpg", 100); 
}
if ($msg) {
?> <script>alert("Image must be larger than <?=$thumbwidth?> by <?=$thumbheight?>"); </script> <?	
}
if ($buildimage) {  // saves the image and the checks the size to ensure that it isn't too big.  Scales the image to $maxInitVal for height and width if it is
	if($imagefile1_name !="" AND strtolower(substr($imagefile1_name, -4))!= ".php"){
		copy ("$imagefile1", "imagesized.jpg") or die("Could not copy file");
		
	}	
	list($width_orig, $height_orig, $imtype) = getimagesize("imagesized.jpg");
	
	if (($width_orig < $thumbwidth) || ($height_orig < $thumbheight)) {
		
		header("location:".$PHP_SELF."?msg=1");
	} else {
		$imagesize['x'] = $width_orig;
		$imagesize['y'] = $height_orig;
	
		$ratio = $width_orig/$height_orig;
		if ($height_orig > $maxInitVal || $width_orig > $maxInitVal ) {
			if ($ratio > 1) {
				$widthLong=true;
			} else {
				$widthLong=false;
			}	
			if ($widthLong) {
				$width=$maxInitVal;
				$height= floor($width/$ratio);	
			} else {
				$height=$maxInitVal;
				$width= floor($height*$ratio);
			}
			makepic("imagesized.jpg","imagesized.jpg",$width,$height);
		
			list($width_orig, $height_orig, $imtype) = getimagesize("imagesized.jpg");
			$imagesize['x'] = $width_orig;
			$imagesize['y'] = $height_orig;
		}
	}
	
}

if ($saveimage) { // use makepic to scale based on the users scaling, use imagecrop to crop based on the input values from #draggable

	makepic("imagesized.jpg","imagesized.jpg",$scalex,$scaley);
	$rect['x'] = $cropx;
	$rect['y'] = $cropy;
	$rect['width'] = $fitx;
	$rect['height'] = $fity;
	imagecrop("imagesized.jpg",$rect);
	
}
?>
<link rel="stylesheet" href="jquery/jquery-ui.min.css">
<script src="jquery/jquery.js"></script>
  <script src="jquery/jquery-ui.min.js"></script>
  <style>
  #draggable { 
	width: <?=$fitx?>px; 
	height: <?=$fity?>px; 
	padding: 0;
	margin:0;
	background-color:#33ccff;
	-webkit-opacity: 0.4;
	-moz-opacity: 0.4;
	opacity: 0.4;
	filter: alpha(opacity=40); }
	html, body {
		margin:0;
		padding:0;
		font-family:Arial, Helvetica, sans-serif;
		color:#222;	
		
	}
	
  </style>
 <script>
 
	$( document ).ready(function() {
    	$( "#draggable" ).draggable({ // reset the hidden form crop values
  			stop: function( event, ui ) {
	  			var position = $( "#draggable" ).position();
	 			var cropx = position.left;
	  			var cropy = position.top;
	  
	  			$("#cropx").val(""+cropx);
				$("#cropy").val(""+cropy);
	 		}
		});

		$('#draggable').draggable({  // contain the draggable inside the image holder
			containment: "#imageholder", scroll: false 
		});
	
		var w = $( "#imageholder" ).width();
		var h = $( "#imageholder" ).height();
		
		// settings for the image holder window
		$( "#imageholder" ).resizable({ // constrain the resizing aspect ratio of the image holder
			aspectRatio: w / h	  
   		});

		$( "#imageholder" ).resizable({ 
		// constrain the max height and width to the max height and width of the original image (up to the $maxInitVal setting). 
		// Minimum is the size of the thumbnail box in the settings
		
	 		maxHeight: <?=$height_orig?>,
			maxWidth: <?=$width_orig?>,
			minHeight: <?=$thumbwidth?>,
			minWidth: <?=$thumbheight?>	  
    	});
		$( "#imageholder" ).resizable({ // scale the background size and reset the hidden form values for scale
			stop: function( event, ui ) {
			
				$( "#imageholder" ).css({
        			'background-size'  : '100%'
   				});
			
				var h = $( "#imageholder" ).height();
				var w = $( "#imageholder" ).width();
			
				$("#scalex").val(""+w);
				$("#scaley").val(""+h);
	   		}  
    	});
	});
  </script>
