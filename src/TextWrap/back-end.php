<?php

use Galoa\ExerciciosPhp\TextWrap\Resolucao;

include("Resolucao.php");

    $resume = new Resolucao();
    
    $text1 = "Se vi mais longe foi por estar de pé sobre ombros de gigantes";
    
    echo "<pre>";
    print_r($resume->textWrap($text1, 12));
    echo "</pre>";
    
?>