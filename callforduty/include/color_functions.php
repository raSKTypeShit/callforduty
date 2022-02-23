<?php

function convert_hex_to_rgb_list($hex) {
    return list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
}

function brighten($rgb, $cng) {
    $max = 255;
    for ($x = 0; $x < 3; $x++) {
        $rgb[$x] *= (1 + $cng);
        if ($rgb[$x] > $max) {$rgb[$x] = $max;}
    }
    return $rgb;
}

function darken($rgb, $cng) {
    for ($x = 0; $x < 3; $x++) {
        $rgb[$x] *= (1 - $cng);
    }
    return $rgb;
}



?>