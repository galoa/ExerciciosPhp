<?php

namespace Galoa\ExerciciosPhp\TextWrap;
/**
 * Implemente sua resolução aqui.
 */
use Exception;

class Resolucao implements TextWrapInterface {

  public function textWrap(string $text, int $length): array {
     try{  
     

      if ($text == ""){
         throw new  Exception('$text parameter is empty');
      }
      if ($length < 3){
         throw new  Exception('$Lenght parameter is too short');
      }
        
        $arrayText = (explode(" ",$text));
        $arrayTextWord = [];
        $splitedWord = "";
        $i = 0;
        $i3 = 0;
        $arrayTextWord[$i3] = ""; 
        while($i < count($arrayText)){
            $textWord = $arrayText[$i];

            // Split big words
            if(strlen($textWord) > $length){
                $splitedWord = "";
                $splitedWord = str_split($textWord, $length);
                $splitedWordlength = count($splitedWord);

                for($i2 = 0; $i2 < $splitedWordlength; $i2++){
                    $arrayTextWord[$i3] = array_shift($splitedWord);
                    $i3++;
                    $arrayTextWord[$i3] = "";
                }
                $i++;
            }

            elseif(strlen($arrayTextWord[$i3] . $arrayText[$i]) <= $length) {

                if(strlen($arrayTextWord[$i3] . " " . $arrayText[$i] ) <= $length){
                    $arrayTextWord[$i3] .= $arrayText[$i] . " ";
                    $i++;

                    if(strlen($arrayTextWord[$i3]) == $length){
                        $arrayTextWord[$i3] = trim($arrayTextWord[$i3]);
                        $i3++;
                        $arrayTextWord[$i3] = "";
                    }
                }

                else{
                        $arrayTextWord[$i3] .= $arrayText[$i];
                        $i++;
                        $i3++;
                        $arrayTextWord[$i3] = "";
                    }
                }  

            else{
                    $arrayTextWord[$i3] = trim($arrayTextWord[$i3]);
                    $i3++;
                    $arrayTextWord[$i3] = "";
                } 
        }
        $arrayTextWord[$i3] = trim($arrayTextWord[$i3]);
        //Remove empty elements
        if($arrayTextWord[$i3] == ""){
          array_pop($arrayTextWord);
        }

        return  $arrayTextWord;
    }
    catch (Exception $e) {
      
      //Register error log
      echo  $e->getMessage();
      return[""];
    }
  }
}
