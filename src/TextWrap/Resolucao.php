<?php

namespace Galoa\ExerciciosPhp\TextWrap;

class Resolucao implements TextWrapInterface{

  public function textWrap(string $text, int $length): array {
    $words = [];
    $currentPosition = 0;

    if($length > 0 && strlen($text) > 0) {
      for ($upIndex = 0; $upIndex < strlen($text); ) {
        $downIndex = $upIndex + $length;
        
        $limit = $length;
        for($j = 0; $j < $limit; $j++) {
          if($upIndex + $j < strlen($text)) {
            if(preg_match('/^[ç´`~^]+/', $text[$upIndex + $j])) {
              $j++;
              $limit++;
            }
          }

          if($upIndex + $j < strlen($text) -1) {
            if($text[$upIndex + $j + 1] == ' ') {
              $downIndex = $upIndex + $j + 1;
            }
          }
          else if($upIndex + $j <= $limit) {
            $downIndex = $upIndex + $j + 1;
          }  
        }
        
        $newWord = "";  
        for($j = 0; $upIndex + $j < $downIndex; $j++) {
          if($upIndex + $j < strlen($text)) {
            $newWord[$j] = $text[$upIndex + $j]; 
          }
        }

        $words[$currentPosition] = $newWord;
        $currentPosition++;

        if($downIndex < strlen($text)) {
          if($text[$downIndex] == ' ') 
            $upIndex = $downIndex + 1;
          else
            $upIndex = $downIndex;
        }
        else {
          $upIndex = strlen($text);
        }
      }
      return $words;
    }  

    return [""];
  }
}
