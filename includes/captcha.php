<?php
session_start();
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
  function _generateRandom($len)
{
	$pool="abcdefghjkmnpqrstuvwxyz123456789";
	$lchr=strlen($pool)-1;
	$ranid="";
	for($i=0;$i<$len;$i++)	$ranid.=$pool[mt_rand(0,$lchr)];
	return $ranid;
}
    $im = imagecreate(60, 20);
    $im1 = imagecreate(120, 40);
    imagecolorallocate($im, 255, 255, 255);

    imagecolorallocate($im1, 255, 255, 255);

    for ($i = 2; $i < 20; $i = $i + 6)
        imagefilledrectangle($im, 0, $i, 120, $i + 1, ImageColorAllocate($im, 23, 255, 106));

    for ($i = 6; $i < 50; $i = $i + 6)
        imagefilledrectangle($im, $i, 0, $i + 1, 20, ImageColorAllocate($im, 23, 255, 106));

    $rand =''._generateRandom(6).'';

    ImageString($im, 2, 2, 2, $rand[0] . " " . $rand[1] . " " . $rand[2] . " ", ImageColorAllocate($im, 255, 0, 0));
//$rand = _generateRandom(3);
    ImageString($im, 2, 2, 2, " " . $rand[3] . " " . $rand[4] . " " . $rand[5], ImageColorAllocate($im, 255, 0, 0));

    $_SESSION['captcha'] = $rand[0] . $rand[3] . $rand[1] . $rand[4] . $rand[2] . $rand[5];

    imagecopyresampled($im1, $im, 0, 0, 0, 0, 300, 100, 150, 50);

    Header('Content-type: image/jpeg');
    //imagejpeg($im,NULL,100);
    imagejpeg($im1, NULL, 100);
    ImageDestroy($im);
    ImageDestroy($im1);

    ?>
