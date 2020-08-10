<?php

namespace Galoa\ExerciciosPhp\TextWrap;

/**
 * Implemente sua resolução nessa classe.
 *
 * Depois disso:
 * - Crie um PR no github com seu código
 * - Veja o resultado da correção automática do seu código
 * - Commit até os testes passarem
 * - Passou tudo, melhore a cobertura dos testes
 * - Ficou satisfeito, envie seu exercício para a gente! <3
 *
 * Boa sorte :D
 */
class Resolucao implements TextWrapInterface {

  /**
   * {@inheritdoc}
   *
   * Apague o conteúdo do método abaixo e escreva sua própria implementação,
   * nós colocamos esse mock para poder rodar a análise de cobertura dos
   * testes unitários.
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
