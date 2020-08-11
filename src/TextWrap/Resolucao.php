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
    $palavras = explode (" ", $text);
     $array = array();
     $limite = $length;
     $string = " ";
     $linha = 0;
     $contador = count($palavras);
     
      for($i = 0; $i < $contador ; ++$i){

        $string = $palavras[$i]. " ";
        /*cortando a palavra a partir de uma nova função e continuando na proxima linha:*/
        if(strlen($palavras[$i])> $length){
          $this-> corte($array, $palavras[$i], $limite, $length, $linha);
        } else
            
          if($limite>=strlen($string)){
            /*colocando a palavra na linha de array */
            $array[$linha]= (array_key_exists($linha, $array))?$array[$linha].$string.$string;
            /* subtraindo o limite á partir da quantidade de caracteres */
            $limite -= strlen($string);
        } else

          if($limite<strlen($string)){
            $linha++;
            $limite=$length;

            $array[$linha]= $string;
            $limite -= strlen($string);
          }
      }
      return $array;
      print_r($array);
    }

    /*adicionando uma função para realizar o corte da palavra, quando necessário*/

    public function corte(&$arrays, $palavra, &$limite,$index){
      /*utilizando o & para mostrar que o objeto está instanciado como uma referência de classe*/
      for($i=0; $i<strlen($palavra); $i++){
        if(($limite != $length) && ($i== 0)){
          $index++; 
          //pulando linha do array 
          $limite = $length;
          //dando novo valor inicial para limite
        }

        if($limite < 0=){

          $index++;
          $limite = $length;  
        }

        $arrays[$index]=(array_key_exists($index, $arrays)) ? $arrays[$index]. $palavra.[$i]:$palavra$i];
        $limite--;
      }
       $arrays[$index]=$arrays[$index]." ";
    }
    






}
