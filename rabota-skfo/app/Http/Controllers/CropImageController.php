<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CropImageController extends Controller
{
    
    public static function squareCrop($imagePath){
        $imgSrc = $imagePath;

        list($width, $height) = getimagesize($imgSrc);

        $myImage = CropImageController::imagecreatefromfile($imgSrc);
        
        $destination_extension = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
        
        $orientation = 2;
        # Get orientation
        if(in_array($destination_extension, ["jpg","jpeg"])){
            $exif = exif_read_data($imagePath);
            if(in_array($exif, ['Orientation'])){
                $orientation = $exif['Orientation'];
            }
        }

        
        if ($width > $height) {
        $y = 0;
        $x = ($width - $height) / 2;
        $smallestSide = $height;
        } else {
        $x = 0;
        $y = ($height - $width) / 2;
        $smallestSide = $width;
        }

        $thumbSize = 400;
        $thumb = imagecreatetruecolor($thumbSize, $thumbSize);
        imagecopyresampled($thumb, $myImage, 0, 0, $x, $y, $thumbSize, $thumbSize, $smallestSide, $smallestSide);
        # Manipulate image
        // switch ($orientation) {
        //     case 2:
        //         imageflip($thumb, IMG_FLIP_HORIZONTAL);
        //         break;
        //     case 3:
        //         $thumb = imagerotate($thumb, 180, 0);
        //         break;
        //     case 4:
        //         imageflip($thumb, IMG_FLIP_VERTICAL);
        //         break;
        //     case 5:
        //         $thumb = imagerotate($thumb, -90, 0);
        //         imageflip($thumb, IMG_FLIP_HORIZONTAL);
        //         break;
        //     case 6:
        //         $thumb = imagerotate($thumb, -90, 0);
        //         break;
        //     case 7:
        //         $thumb = imagerotate($thumb, 90, 0);
        //         imageflip($thumb, IMG_FLIP_HORIZONTAL);
        //         break;
        //     case 8:
        //         $thumb = imagerotate($thumb, 90, 0); 
        //         break;
        // }
        imagejpeg($thumb, $imagePath);
    }

    public static function imagecreatefromfile( $filename ) {
        if (!file_exists($filename)) {
            throw 'File "'.$filename.'" not found.';
        }
        switch ( strtolower( pathinfo( $filename, PATHINFO_EXTENSION ))) {
            case 'jpeg':
            case 'jpg':
                return imagecreatefromjpeg($filename);
            break;
    
            case 'png':
                return imagecreatefrompng($filename);
            break;
    
            case 'gif':
                return imagecreatefromgif($filename);
            break;
    
            default:
                throw 'File "'.$filename.'" is not valid jpg, png or gif image.';
            break;
        }
    }
}
