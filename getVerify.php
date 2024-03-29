<?php 
    require_once 'string.php';    

    function verifyImage($type=1, $length=4, $pixel=1, $line=5, $sess_name="verify"){
        session_start();
        
        //创建画布
        $width  = 80;
        $height = 25;
        $image  = imagecreatetruecolor($width, $height);
        $white  = imagecolorallocate($image, 255, 255, 255);
        $black  = imagecolorallocate($image, 0, 0, 0);
        //用填充矩形填充画布
        imagefilledrectangle($image, 1, 1, $width-2, $height-2, $white);
        $chars = buildRandomString($type,$length);
        $_SESSION[$sess_name] = $chars;
        $fontfiles = array("arial.ttf","arialbd.ttf","arialbi.ttf");
        for ($i = 0; $i < $length; $i++){
            $size = mt_rand(14,18);
            $angle = mt_rand(-15, 15);
            $x = 5+$i*$size;
            $y = mt_rand(20, 26);
            $color = imagecolorallocate($image, mt_rand(50, 90), mt_rand(80, 200), mt_rand(90, 180));
            $fontfile = "fonts/".$fontfiles[mt_rand(0, count($fontfiles)-1)];
            $text = substr($chars, $i, 1);
            imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);
        }
        
        //以下为干扰元素
        if ($pixel){
            for ($i=0; $i < 10; $i++){
                imagesetpixel($image, mt_rand(0, $width-1), mt_rand(0, $height-1), $black);
            }
        }
        
        if ($line){
            for ($i=0; $i < $line; $i++){
                $color = imagecolorallocate($image, mt_rand(50, 90), mt_rand(80, 200), mt_rand(90, 180));
                imageline($image, mt_rand(0, $width-1), mt_rand(0, $height-10), mt_rand(0, $width-10), mt_rand(0, $height-10), $color);
            }
        }
        
        header("content-type:image/gif");
        imagegif($image);
        imagedestroy($image);
    }
    
    verifyImage();
?>