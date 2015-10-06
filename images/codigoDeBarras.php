<?php

$altura = 80;
$cod = 123456;

function tamano($numero, $altura) {
    $cifras = strlen($numero) + 1;
    $dim['x'] = 7 + $cifras * 6 + 9;
    $dim['y'] = $altura + 1;
    return $dim;
}

$dimensiones = tamano($cod, $altura);
$imagen = imagecreate($dimensiones['x'], $dimensiones['y']);

$blanco = imagecolorallocate($imagen, 255, 255, 255);
$negro = imagecolorallocate($imagen, 0, 0, 0);

imagefill($imagen, 0, 0, $blanco);
imagerectangle($imagen, 0, 0, imageSX($imagen) - 1, imageSY($imagen) - 1, $negro);

function cifra($num) {
    return str_pad(decbin($num + 5), 4, '0', STR_PAD_LEFT);
}

function barra($y2, $x_ini, $codigo) {
    global $imagen, $negro, $blanco;
    for ($i = 0; $i <= 3; $i++) {
        if ($codigo[$i] == 0) {
            $color = $blanco;
        } else {
            $color = $negro;
        }
        $x = $x_ini + $i;
        imageline($imagen, $x, 5, $x, $y2, $color);
    }
}

function codigo($numero) {
    global $imagen, $negro, $blanco, $altura;

    $x = 5;
    barra($altura - 5, $x, "1010");
    $x = $x + 7;

    for ($e = 0; $e <= strlen($numero) - 1; $e++) {
        barra($altura - 15, $x, cifra($numero[$e]));
        imagestring($imagen, 2, $x, $altura - 15, $numero[$e], $negro);
        $x = $x + 6;
    }
    $x = $x + 1;
    barra($altura - 5, $x, "1011");
}

codigo($cod, $altura);
header("Content-type: image/png");
imagepng($imagen);
