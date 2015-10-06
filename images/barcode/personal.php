<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('class/BCGFontFile.php');
require_once('class/BCGColor.php');
require_once('class/BCGDrawing.php');
require_once('class/BCGcode128.barcode.php');

// Argumentos para el color de fondo, el de las barra y el del texto
$colorFront = new BCGColor(0, 0, 0);
$colorBack = new BCGColor(255, 255, 255);
$font = new BCGFontFile('font/Arial.ttf', 10);

$code = new BCGcode128(); // Se crea el codigo que se llamo arriba
$code->setScale(2); // Tamaño
$code->setThickness(30); // Espesor
$code->setForegroundColor($colorFront); // Color de la barra
$code->setBackgroundColor($colorBack); // Color de los espacios
$code->setFont($font); // Tipo de letra
$code->parse($_GET['numero']); // Numero a convertir
//$code->parse($_GET['numero']); // Numero a convertir

$drawing = new BCGDrawing('', $colorBack);
$drawing->setBarcode($code);
$drawing->draw();

header('Content-Type: image/png');

$drawing->finish(BCGDrawing::IMG_FORMAT_PNG);
