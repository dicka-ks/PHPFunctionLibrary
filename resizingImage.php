<?php

function resizingImage($image){
// if(isset($_POST['submit'])){

//get the image name and image temporary name
//FOLDER -> SUBSTITUTE INTO FUNCTION
$imagename = $_FILES[$image]['name']; //subs function image
$imagetempname = $_FILES['sketch']['tmp_name'];

//get the extension
//FOLDER -> SUBSTITUTE INTO FUNCTION
$targetfile = "images/";//subs function folder
$target = $targetfile.basename($imagename);   
$extension=strtolower(pathinfo($target,PATHINFO_EXTENSION));


//for extracting last image to be used in our new image
if($extension == "jpg" || $extension == "jpeg"){
    $createImageSource = imagecreatefromjpeg($imagetempname);
}
else if($extension == "png"){
    $createImageSource = imagecreatefrompng($imagetempname);
}
else if($extension == "gif"){
    $createImageSource = imagecreatefromgif($imagetempname);
}
else if($extension == "bmp"){
    $createImageSource = imagecreatefromgbmp($imagetempname);
}
else{
    echo "no proper image selected";
}

//create new image by using last image, the new image has new size from uploaded image 
$imagesize=getimagesize($imagetempname);
list($width,$height)=$imagesize;
$newHeight='333';//subs function height
$newWidth=$newHeight*$width/$height;
$newCanvas=imagecreatetruecolor($newWidth,$newHeight);
$newImage=imagecopyresampled($newCanvas,$createImageSource,0,0,0,0,$newWidth,$newHeight,$width,$height);


//upload the image by using new canvas/size
imagepng($newCanvas,$target);

imagedestroy($createImageSource);
imagedestroy($newCanvas);


/*
//for extracting last image to be used in our new image
if($extension == "jpg" || $extension == "jpeg"){
    imagejpeg($newImage,$target);
}
else if($extension == "png"){
    imagepng($newImage,$target);
}
else if($extension == "gif"){
    imagegif($newImage,$target);
}
else if($extension == "bmp"){
    imagebmp($newImage,$target);
}
else{
    echo "no proper image selected";
}

*/


echo $imagename;
echo "<br>";
echo $imagetempname;
echo "<br>";
echo $targetfile;
echo "<br>";
echo $target;

echo "<br>";
print_r($imagesize);
echo "<br>";
echo $width;
echo "<br>";
echo $height;

echo "<br>";
echo $newHeight;
echo "<br>";
echo $newWidth;
echo "<br>";
echo $newCanvas;
echo "<br>";
echo $createImageSource;

echo "<br>";
echo $extension;

}