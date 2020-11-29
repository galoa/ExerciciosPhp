<?php

namespace Galoa\ExerciciosPhp\TextWrap;


class Resolucao implements TextWrapInterface {

  public function textWrap(string $text, int $length): array
  {
      $arrText = explode(" ", $text);
      $lines = [];
      $line = "";
      foreach ($arrText as $word) {
          if (strlen($word) <= $length){
              if(strlen($line) > strlen($word)) { // Usando > ao inves de >= para caber o espaço
                  $line = $line ." ". $word;
              }else{
                  $lines.append($line);
                  $line = "";
                  $line = $line ." ". $word; // A palavra nunca será maior que a linha, por isso não é necessario verificação   
              }
          }else{
              $counter = 0;
              for ($i=0; $i < strlen($word); $i++) { 
                  if($counter < $length){ // < para dar espaço ao ultimo caractere no else, se não perderia a letra
                      $line += $word[$i];
                      $counter++;
                  }else{
                      $counter = 0;
                      $line += $word[$i];
                      $lines.append($line);
                      $line = "";
                  }
              }
          }

      }
      return $lines;
  }
}
