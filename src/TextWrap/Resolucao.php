<?php

namespace Galoa\ExerciciosPhp\TextWrap;


class Resolucao implements TextWrapInterface {

  
  public  function textWrap(string $text, int $length): array {
    
     // Armazenando a quantidade maxima de caracteres que foi passada

     $max = $length;

    $novoTexto = "";
    
    $totalLength = 0;

    // Dividindo a string em string menores

    $texto = explode(" ", $text);
    

    foreach($texto as $string) {

      // Adicionando os Espacos que foram removidos no explode
       $string .= " ";
    
        if ($totalLength + strlen($string) <= $max) {
            
            $totalLength += strlen($string);
    
            $novoTexto .= $string;

        } else {
            
          $novoTexto .= "<br/>" . $string;
    
          $totalLength = strlen($string);
        } 
      }
        /* basicamente ele verifica o tamanho da linha a cada iteração
           se exceder ele adiciona uma quebra de linha ao texto e reseta essa variável q guarda o tamanho da linha
        */
          echo $novoTexto;
    
    return [""]; 
}
}
