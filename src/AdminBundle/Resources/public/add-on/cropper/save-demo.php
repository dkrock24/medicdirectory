<?php 

$data = $_POST['img'];//'data:image/png;base64,AAAFBfj42Pj4';

/*
list($type, $data) = explode(';', $data);
list(, $data)      = explode(',', $data);
$data = base64_decode($data);

$time = mktime();
$name = $time.".png";
$path = "images/";

$save = $path.$name;
file_put_contents($save, $data);
*/


/*
list($type, $data) = explode(';', $data);
list(, $data)      = explode(',', $data);

$time = mktime();
$name = $time.".png";
$path = "images/";
$save = $path.$name;


$imageData = base64_decode($data);
$source = imagecreatefromstring($imageData);
$angle = 0;
$rotate = imagerotate($source, $angle, 0); // if want to rotate the image
$imageName = $save;
$imageSave = imagejpeg($rotate,$imageName,100);
imagedestroy($source);
*/

$filename = "test.png";
$img = $_POST['img'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
file_put_contents("images/".$filename, $data)

//In one line
//$data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));
?>