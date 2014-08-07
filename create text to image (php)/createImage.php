<?php
    namespace Application\Helper;
    
    class createImage
    {
        public function randomBackground($imagePath, $imageName, $color)
        {
            $path = 'public/upload/background/'.$imagePath.'/'.$imageName;
            $image = imagecreatefromjpeg($path);
            
            $exColor = explode(",", $color);
            foreach($exColor as $a){
                $b[] = $a;
            }
            
            $fontColor = ImageColorAllocate($image, $b[0],$b[1],$b[2]);
            
            return array('image' => $image, 'fontColor' => $fontColor);
        }
        
        public function imageCreator($text, $author, $postId, $userId, $imageName, $imagePath, $color, $fontName, $fontSize)
        {
            header('Content-type: image/jpeg'); // header
            
            $check = $this->randomBackground($imagePath, $imageName, $color); //selecting background image
            
            $image_2 = $check['image']; //the image
            $fontColor = $check['fontColor']; // the font color
            
            $font = 'public/upload/fonts/'.$fontName; // path for the font style
            $fontSecond = 'public/themes/frontend/fonts/601.ttf'; // path for the author font style

            $fontSize2 = 22; // font size for the author text

            // color for the author text
            $white = imagecolorallocate($image_2, 255,255,255);
            $black = imagecolorallocate($image_2, 60,60,60);

            $imageWidth = imagesx($image_2);
            $imageHeight = imagesy($image_2);

            $text = $this->wrap($fontSize, 0, $font, $text, $imageWidth-15);

            $textBox = imagettfbbox($fontSize,0,$font,$text);
            $textWidth = $textBox[2]-$textBox[0]; // lower right corner - lower left corner

            $ascent = abs($textBox[7]);
            $descent = abs($textBox[1]);
            $height = $ascent + $descent;
            
            $x = ($imageWidth/2) - ($textWidth/2);
            $y = (($imageHeight/2) - ($height/2)) + $ascent;

            //TEXT
            imagettftext($image_2,$fontSize,0,$x+1,$y+1,$black,$font,$text );
            imagettftext($image_2,$fontSize,0,$x,$y,$fontColor,$font,$text );

            // Create the next bounding box for the second text
            $bbox = imagettfbbox($fontSize2, 0, $fontSecond, $author);

            // Set the cordinates so its next to the first text
            $bbox_width = ($bbox[2]-$bbox[0]) + 10;
            $bbox_height = ($bbox[3]-$bbox[1]) + 10;

            $x1 = $imageWidth - $bbox_width;
            $y1 = $imageHeight - $bbox_height;

            // AUTHOR
            imagettftext($image_2, $fontSize2, 0, $x1+1, $y1+1, $black, $fontSecond, $author);
            imagettftext($image_2, $fontSize2, 0, $x1, $y1, $white, $fontSecond, $author);

            $postName = 'post'.$postId.'.jpg';
            $path = 'public/upload/posts/'.$userId.'/'.$postName;

            if(file_exists($path)){
                unlink($path);
            }

            imagejpeg($image_2, $path);
            imagedestroy($image_2);
        }
        
        public function wrap($fontSize, $angle, $fontFace, $string, $width)
        {
            $ret = "";

            $arr = explode(' ', $string);

            foreach ( $arr as $word ){

                $teststring = $ret.' '.$word;
                $testbox = imagettfbbox($fontSize, $angle, $fontFace, $teststring);
                if ( $testbox[2] > $width ){
                    $ret.=($ret==""?"":"\n").$word;
                } else {
                    $ret.=($ret==""?"":' ').$word;
                }
            }

            return $ret;
        }
        
    }