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
      if(strlen($text) == 0) 
      return [""];
     
     
     $linha = "";
     $caraUsados = 0;
     $palavras = explode(" ",$text);
     $ret = [];

     foreach($palavras as $palavra){
       if($caraUsados + strlen($palavra) < $length){
           if($linha != "")
            $linha .= " ";
           $linha .= $palavra;
           $caraUsados = strlen($linha);
       }
       else{
         array_push($ret,$linha);
         $linha = "";
         $caraUsados = 0;
         if($palavra <= $length){
           $linha .= $palavra;
           $caraUsados = strlen($palavra);
         }
         else{
           array_push($ret,substr($linha,0,$length));
           $corte = strlen($palavra) - $length;
           $linha = substr($palavra,-1,$corte);
           $caraUsados = strlen($linha);
         }
       }
     }
     if($linha != "")
     array_push($ret,$linha);
     return $ret;
  }

}
