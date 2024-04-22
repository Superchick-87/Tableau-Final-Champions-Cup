<?php
include(dirname(__FILE__) . '/includes/ddc.php');
include(dirname(__FILE__) . '/includes/date.php');
function read($csv)
{
    $file = fopen($csv, 'r');
    while (!feof($file)) {
        $line[] = fgetcsv($file, 1024, ",");
    }
    fclose($file);
    return $line;
}
$csv = dirname(__FILE__) . '/datas.csv';
$csv = read($csv);


//  * Creates an example PDF TEST document using TCPDF
//  * @package com.tecnick.tcpdf
//  * @abstract TCPDF - Example: WriteHTML and RTL support
//  * @author Nicola Asuni
//  * @since 2008-03-04
//  */


require_once('TCPDF/tcpdf.php');

// create new PDF document
$pageLayout = array(101.8, 75); //  or array($height, $width) 
$pdf = new TCPDF('F', 'mm', $pageLayout, true, 'UTF-8', false);
// $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicolas Peyrebrune');
$pdf->SetTitle('Infographie Flux carburants');
$pdf->SetSubject('Infographie');
$pdf->SetKeywords('Infographie, SUDOUEST, flux, carburants, match');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
// $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetMargins(0, 0, 0, 0);
// $pdf->SetPaddings(0,0,0,0);

// set auto page breaks
// $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(FALSE, 0);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/fra.php')) {
    require_once(dirname(__FILE__) . '/lang/fra.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// add a page
$pdf->AddPage();
// get esternal file content
$utf8text = file_get_contents('TCPDF-master/examples/data/utf8test.txt', false);


// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// $fontname = TCPDF_FONTS::addTTFfont('/TCPDF-master/fonts/UtopiaStd-BlackHeadline.ttf', 'TrueTypeUnicode', '', 96);
// $pdf->SetFont($font_family = 'utopiastdblackheadline', '', 14, '', false);
$pdf->setFont($font_family = 'roboto', '', 7, '', false);
// $pdf->setFont($font_family='robotolight', 10, '', false);
// $pdf->setFont($font_family = 'robotomedium', 10, '', false);
// $pdf->setFont($font_family='robotoi', 10, '', false);
// $pdf->setFont($font_family='robotocondensed', '', false);
// $pdf->setFont($font_family='robotobcondensed', '', false);
// $pdf->setFont($font_family='robotoblack', '', false);
// $pdf->setFont($font_family = 'utopiastd', $font_variant = '', $font_size = 10);
// $pdf->ImageSVG('images/fond.svg', 0, 0, 101.8, 75, '', '', '', '', false);
// $pdf->SetFont('robotomedium', '', 9, '', false);
// $pdf->SetFillColor(90, 10, 65, 15);



function drawMatchCells($pdf, $x, $y, $width_team, $width_score, $height_cell, $space_x, $space_y, $match_data, $border)
{
    $pdf->setCellPaddings(0, 0, 0, 0);
    $pdf->SetFont('robotoi', '', 7, '', false);
    $pdf->SetTextColor(0, 0, 0, 100);
    $pdf->SetFillColor(0, 0, 0, 0);
    $pdf->SetXY($x, $y - 3.5);
    $pdf->Cell($width_team + $width_score, $height_cell, $match_data[1], $border, 0, 'L', 1, 1, 1, false, '', 'L');


    $pdf->SetTextColor(0, 0, 0, 0);
    $pdf->setCellPaddings(1, 0, 1, 0);
    $pdf->SetFont('robotomedium', '', 9, '', false);
    $pdf->SetFillColor(90, 10, 65, 15);

    $pdf->SetXY($x, $y);
    $pdf->Cell($width_team, $height_cell, $match_data[2], $border, 0, 'L', 1, 1, 1, false, '', 'L');
    $pdf->SetXY($x + $width_team + $space_x, $y);
    $pdf->Cell($width_score, $height_cell, $match_data[3], $border, 0, 'L', 1, 1, 1, false, '', 'M');
    $pdf->Image('images/Rugby/' . ddc($match_data[2]) . '.png', $x - 4, $y - 0.3, 6.5, 4, 'PNG', '', '', false, 300, 'M', false, false, 0, 'B', false, false);


    $pdf->SetXY($x, $y + $height_cell + $space_y);
    $pdf->Cell($width_team, $height_cell, $match_data[4], $border, 0, 'L', 1, 1, 1, false, '', 'L');
    $pdf->SetXY($x + $width_team + $space_x, $y + $height_cell + $space_y);
    $pdf->Cell($width_score, $height_cell, $match_data[5], $border, 0, 'L', 1, 1, 1, false, '', 'M');
    $pdf->Image('images/Rugby/' . ddc($match_data[4]) . '.png', $x - 4, $y + $height_cell + $space_y - 0.5, 6.5, 4, 'PNG', '', '', false, 300, 'M', false, false, 0, 'B', false, false);
}
$border = 0;

//@ Titre
$pdf->setCellPaddings(0, 0, 0, 0);
$pdf->SetFont('robotomedium', '', 18, '', false);
$pdf->SetTextColor(0, 0, 0, 0);
$pdf->SetFillColor(90, 10, 65, 15);
$pdf->SetXY(0, 0);
$pdf->Cell(101.8, 7.8, 'Champions Cup', $border, 0, 'C', 1);

//@ Epreuves
$pdf->SetFont('robotoi', '', 10, '', false);
$pdf->SetTextColor(0, 0, 0, 100);
$pdf->Text(4, 9.5, 'Quarts de finale'); // Placer le texte centré verticalement (ajuster la hauteur selon la taille de la police)




$width_team = 23;
$width_score = 5;
$height_cell = 3.5;

$space_x = 0.5;
$space_y = 2;

$x_qf = 4;
$y_qf4 = 18;
$y_qf1 = 33;
$y_qf2 = 48;
$y_qf3 = 63;

$x_sf = 38;
$y_sf1 = 25;
$y_sf2 = 57;

$x_f = 70;
$y_f = 42;



// Utilisation de la fonction pour dessiner Quart de finale 4
drawMatchCells($pdf, $x_qf, $y_qf4, $width_team, $width_score, $height_cell, $space_x, $space_y, $csv[3], $border);
// Utilisation de la fonction pour dessiner Quart de finale 1
drawMatchCells($pdf, $x_qf, $y_qf1, $width_team, $width_score, $height_cell, $space_x, $space_y, $csv[0], $border);
// Utilisation de la fonction pour dessiner Quart de finale 2
drawMatchCells($pdf, $x_qf, $y_qf2, $width_team, $width_score, $height_cell, $space_x, $space_y, $csv[1], $border);
// Utilisation de la fonction pour dessiner Quart de finale 3
drawMatchCells($pdf, $x_qf, $y_qf3, $width_team, $width_score, $height_cell, $space_x, $space_y, $csv[2], $border);


// Utilisation de la fonction pour dessiner Demie finale 1
drawMatchCells($pdf, $x_sf, $y_sf1, $width_team, $width_score, $height_cell, $space_x, $space_y, $csv[4], $border);
// Utilisation de la fonction pour dessiner Demie finale 2
drawMatchCells($pdf, $x_sf, $y_sf2, $width_team, $width_score, $height_cell, $space_x, $space_y, $csv[5], $border);

// Utilisation de la fonction pour dessiner la finale
drawMatchCells($pdf, $x_f, $y_f, $width_team, $width_score, $height_cell, $space_x, $space_y, $csv[5], $border);

// close and output PDF document
$pdf->Output('TableauFinalChampions Cup_' . $date . '.pdf', 'I');
// $pdf->Output('ProductionPdf/TableauFinalChampions Cup_'.$date.'.pdf','F');
// $pdf->Output('ProductionPdf/Infog_Carburants_1col4modules_' . $ville . '_' . $date . '.pdf', 'F');

//============================================================+
// END OF FILE
//============================================================+