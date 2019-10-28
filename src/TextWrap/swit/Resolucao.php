<?php

namespace Galoa\ExerciciosPhp\TextWrap;

/**
 * Implemente sua resolução aqui.
 */
class Resolucao implements TextWrapInterface {

  /**
   * {@inheritdoc}
   */
  public function textWrap(string $text, int $length): array {
    try {
      
      //Remove spaces begin and end of text
      $text = trim($text);

      //If text size is less than or equal to line size
      if (strlen($text) <= $length){
        return [$text];
      }
      
      //If text size is larger to line size
      $arrText = explode(" ", $text);
      
      //Verify if exists words larger to line size
      $arrTextWord = [];
      foreach ($arrText as $textWord) {

        if(strlen($textWord) > $length){
          array_push($arrTextWord, split_length($textWord, $length));
        } else {
          array_push($arrTextWord, $textWord);
        }

      }

      //Build text with lines
      $arrText = [];
      $numLine = 0;
      $line = "";
      foreach ($arrTextWord as $textWord) {

        if(!array_key_exists($numLine, $arrText)){
          $arrText[$numLine] = $textWord;
        } elseif (strlen($arrText[$numLine] . " " . $textWord) <= $length){
          $arrText[$numLine] .= " " . $textWord;
        } else {
          $numLine++;
          $arrText[$numLine] = $textWord;
        }
        
      }

      print_r($arrText);

      return $arrText;

    } catch (Exception $e) {
      
      //Register error log
      return [""];

    }
    
  }

}
