<?php

header( 'Cache-Control: max-age=6' );
$coin=$_GET["coin"];
$currency="usd";
$amount=1;
if(isset($_GET["currency"])) $currency=$_GET["currency"];
if(isset($_GET["amount"])) $amount=$_GET["amount"];
$amount =(float)$amount;


$famount=(float)$amount;
$link="https://api.coingecko.com/api/v3/coins/".$coin;
$json=file_get_contents($link);
$jsonArray=json_decode($json);


$str = $jsonArray->market_data->current_price->$currency;
$str=$amount*$str;
$string = number_format($str , 3);
$currency=strtoupper($currency);
$string = $string." ".$currency;


header('Content-type: image/png'); // filetype

$font  = 4;
$width  =(imagefontwidth($font) * strlen($string))+3;
$height = (imagefontheight($font));

$image = imagecreatetruecolor ($width,$height);
$white = imagecolorallocate ($image,229,229,232);
$black = imagecolorallocate ($image,0,0,0);
imagefill($image,0,0,$white);

imagestring ($image,$font,0,0,$string,$black);

//imagettftext ( $image, 6, 0, 0, 0, $black, 'arial.ttf' , $string);

imagepng ($image,"image.png");
readfile("image.png");

imagedestroy($image); // free up memory
exit;

?>
