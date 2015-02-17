<?php
require_once('lib/class.generateimage.php');

use PHPImageWorkshop\ImageWorkshop;
require_once('lib/PHPImageWorkshop/ImageWorkshop.php');

$_gi = new generateImage();
$_gi->setDetails('iamachampiontw');
$image = $_gi->paintFarewell();
$image = $image->getResult();

header('Content-type: image/png');
header('Content-Disposition: filename="image.png"');
imagepng($image, null, 8);
exit;