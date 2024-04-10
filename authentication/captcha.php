<?php
session_start();

$captchaCode = substr(md5(uniqid(rand(), true)), 0, 6);
$_SESSION['captcha_code'] = $captchaCode;

$image = imagecreate(200, 30);
$bgColor = imagecolorallocate($image, 233, 211, 240);
$textColor = imagecolorallocate($image, 0, 0, 0);
imagestring($image, 5, 10, 5, $captchaCode, $textColor);

header('Content-type: image/png');

imagepng($image);

imagedestroy($image);
?>
