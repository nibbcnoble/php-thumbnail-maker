<?
// Image Scale and Crop Tool

// ensure that the code.inc.php is pulling the jquery .js and .css files from the correct directories

//----------------------------SETTINGS
// set max image size to start fitting.  Applies to height and width
$maxInitVal = 800;
// set image crop size
$thumbwidth= 120;
$thumbheight= 80;

//----------------------------END SETTINGS
$cropx = $_POST['cropx'];
$cropy = $_POST['cropy'];
$fitx = $_POST['fitx'];
$fity = $_POST['fity'];
$scalex = $_POST['scalex'];
$scaley = $_POST['scaley'];
$saveimage = $_POST['saveimage'];
$imagefile1 = $_POST['imagefile1'];
$fitx = $_POST['fitx'];
$fity = $_POST['fity'];
$buildimage = $_POST['buildimage'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Image Scaling and Cropping Example</title>
<? include('code.inc.php'); // include this in the ?>
</head>
<body>
<div style="width:850px; margin:0 auto;min-height:940px;background-color:#ddd;padding:5px;">
<h3>Image Crop Tool</h3>
<p style="color:#0000ff;font-weight:800;">crop frame set to <?=$thumbwidth?> x <?=$thumbheight?> </p>
<? if ($buildimage) {  ?>
<table width="100%">
<tr>
<td style="width:32%;margin:1px;background-color:#fff;font-weight:bold;">
Scale image to desired size by dragging the bottom right corner.  Drag blue box over the desired crop area. Click 'Crop Image'.
</td>
<td style="width:32%;margin:1px;background-color:#fff;font-weight:bold;"> 
<a href="<?=$_SERVER['PHP_SELF']?>">Upload New</a>
</td>
<td style="width:32%;margin:1px;background-color:#fff;font-weight:bold;">

<form action="<?=$_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="cropx" id="cropx" value=""  />
<input type="hidden" name="cropy" id="cropy" value=""  />
<input type="hidden" name="fitx" id="fitx" value="<?=$fitx?>" />
<input type="hidden" name="fity" id="fity" value="<?=$fity?>" /><br />
<input type="hidden" name="scalex" id="scalex" value="<?=$imagesize['x']?>"  />
<input type="hidden" name="scaley" id="scaley" value="<?=$imagesize['y']?>"  />
<input type="hidden" name="saveimage" value="1" />
<input type="submit" value="Crop Image" style="background-color:#33ccff" /></form>
</td>
</tr>
</table>
<div style="height:<?=$imagesize['y']?>px;width:<?=$imagesize['x']?>px;background-image:url('imagesized.jpg');border:3px solid black;" id="imageholder" ><div  id="draggable" style="border:1px solid black;">&nbsp;</div>
</div>
<? } else if ($saveimage) { ?>
<div style="padding:10px;">
<img src="finalimage.jpg" /><br />
<a href="<?=$_SERVER['PHP_SELF']?>">Upload New</a></div>
 <? } else { ?>
<div style="background-color:#aaa;height:350px;width:788px;padding-top:250px;border:3px solid black;" align="center">
<form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data" name="imageform1" id="imageform1">
<input type="file" name="imagefile1" id="imagefile1"  />
<input type="hidden" value="<?=$thumbwidth?>" name="fitx" />
<input type="hidden" value="<?=$thumbheight?>" name="fity" />
<input type="hidden" value="1" name="buildimage" />
<input type="submit" value="Upload" />
</form>

</div>
<? } ?>
<div style="clear:both;height:100px;"&nbsp;></div>
</div>
</body>
</html>
