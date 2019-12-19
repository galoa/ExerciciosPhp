<?php

namespace Galoa\ExerciciosPhp\TextWrap;


/**
 * Implemente sua resolução aqui.
 */
class Resolucao implements TextWrapInterface {

  /**
   * {@inheritdoc}
   */
  public function textWrap(string $text, int $length): array 
  {
    $cLength = "0";

    $words = explode(" ",$text);

    if(strlen($text) <= $length):
        $newText = $text;
    else:
        //Começa a criar o novo texto resumido.
        $newText = "";
        //Acrescenta palavra por palavra na string enquanto ela
        //não exceder o tamanho máximo do resumo
        for($i = 0; $i <count($words); $i++):
          $cLength += strlen(" ".$words[$i]);
          if($cLength <= $length):
              $newText .= ' ' . $words[$i];
          else:
              foreach($words as $key => $value){
                if(strlen($newText) >= $length):
                  $n = '';
                  $newText .= ' ' . $words[$i] . $n;
                  break;
                else:
                  $n = '\n ';
                  $newText .= $n . $words[$i] . '';
                  break;
                  
                endif;
              }
          endif;
        endfor;
    endif;
    //retornar em array????
    $newText = trim($newText);
    $array = str_split($newText, $cLength);

    return $array;
    
  }

  


}
