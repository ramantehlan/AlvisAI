<?php
// Raman tehlan PHP Image Function Library 1.0

//creator:-          Raman Tehlan
//Date of creation:- 02/07/2015


class img_process{

        // -------------- RESIZE FUNCTION -------------
       // Function for resizing any jpg, gif, or png image files

function img_resize($target, $newcopy, $w, $h, $ext) {
   $kaboom  = explode("/", $ext); // Split file name into an array using the dot
   $ext     = end($kaboom);

    list($w_orig, $h_orig) = getimagesize($target);
    $scale_ratio = $w_orig / $h_orig;
    if (($w / $h) > $scale_ratio) {
           $w = $h * $scale_ratio;
    } else {
           $h = $w / $scale_ratio;
    }
    
    $img = "";
    $ext = strtolower($ext);
    if ($ext == "gif"){ 
    $img = imagecreatefromgif($target);
    } else if($ext =="png"){ 
    $img = imagecreatefrompng($target);
    } else { 
    $img = imagecreatefromjpeg($target);
    }
    $tci = imagecreatetruecolor($w, $h);
    // imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
    imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
    if ($ext == "gif"){ 
        imagegif($tci, $newcopy);
    } else if($ext =="png"){ 
        imagepng($tci, $newcopy);
    } else { 
        imagejpeg($tci, $newcopy, 84);
    }
}






// ------------- THUMBNAIL (CROP) FUNCTION -------------
// Function for creating a true thumbnail cropping from any jpg, gif, or png image files


function img_thumb($target, $newcopy, $w, $h, $ext) {
   $kaboom  = explode("/", $ext); // Split file name into an array using the dot
   $ext     = end($kaboom);

    list($w_orig, $h_orig) = getimagesize($target);
    $src_x = 0;//($w_orig / 2) - ($w / 2);
    $src_y = 0;//($h_orig / 2) - ($h / 2);
    $ext = strtolower($ext);
    $img = "";
    if ($ext == "gif"){ 
    $img = imagecreatefromgif($target);
    } else if($ext =="png"){ 
    $img = imagecreatefrompng($target);
    } else { 
    $img = imagecreatefromjpeg($target);
    }
    $tci = imagecreatetruecolor($w, $h);
    imagecopyresampled($tci, $img, 0, 0, $src_x, $src_y, $w, $h, $w, $h);
    if ($ext == "gif"){ 
        imagegif($tci, $newcopy);
    } else if($ext =="png"){ 
        imagepng($tci, $newcopy);
    } else { 
        imagejpeg($tci, $newcopy, 84);
    }
}








}



?>