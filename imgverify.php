<?php
session_start();//session start
$_SESSION["imgverify_code"]="utsw"; //initiate a session

$img_width=80;
$img_height=25;
$authnum='';

$ychar="1,2,3,4,5,6,7,8,9,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z";
$list=explode(",",$ychar); //To store ychar in a list

//randomly pick 4 chars from list and store into authnum
for ($i=0;$i<4;$i++){
    $randnum=rand(0,35);
    $authnum.=$list[$randnum];
}

$_SESSION["imgverify_code"]=$authnum;//put 4 random chars in the session

$aimg=imagecreate($img_width,$img_height);//create the image
imagecolorallocate($aimg,255,255,255); //allocate a color for an image to white
$textcolor=imagecolorallocate($aimg,0,0,0); //allocate a color for text to black


for ($i=1; $i<=100; $i++) {
    //draws "@i" at the given coordinates (range from 1 to its image width and height) in the image and set random color for each "@!"
    imagestring($aimg,1,mt_rand(1,$img_width),mt_rand(1,$img_height),"@!",imagecolorallocate($aimg,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255)));
}

for($i=0;$i<strlen($authnum);$i++){
    //draws the 4 chars at the given coordinates
    imagestring($aimg,5,$i*$img_width/4+mt_rand(2,7),mt_rand(1,$img_height/2-2), $authnum[$i],imagecolorallocate($aimg,mt_rand(0,100),mt_rand(0,150),mt_rand(0,200)));
}

imagerectangle($aimg,0,0,$img_width-1,$img_height-1,$textcolor);//put the image in a rectangle frame
Header("Content-type: image/PNG");//send the content type header so the image is displayed properly
ImagePNG($aimg);//output the image to the browser
ImageDestroy($aimg);//destroy the image to free up the memory
?>