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
      if(strlen($text) == 0) // verificação se a String passada está vaiza, se sim retorna um Array vazio
        return [""];
       
       /*inicialização das variaveis a serem usadas para a separação da String*/ 
       $linha = ""; //essa variavel armazena as palavras ou partes dela antes de guardar no array de retorno
       $caraUsados = 0; //essa varivavel conta quantos caracteres já foram usados
       $palavras = explode(" ",$text);// criação de um array contendo as palavras da String original
       $ret = [];// array de retorno contendo todas as linhas que foram criadas
       
       foreach($palavras as $palavra){//foreach utilizado para iterar o array das palavras da String original
         if($caraUsados + strlen($palavra)  < $length){//verificação se o numero de caracteres usados mais os carcteres da proxima palavra não superem o length passado da linha
             if($linha != "")//verifica se a linha não está em branco se não estiver coloca um espaço em branco na linha para separar as palavras
              $linha .= " ";
             $linha .= $palavra;//adciona a palavra a linha
             $caraUsados = strlen($linha);// substitui os caracteres usados pelo numero de caracteres da linha 
         }
         else{ //este else cobre se a proxima palavra não cabe na linha
          if($linha != ""){
           array_push($ret,$linha);//adciona a linha feita no array de retorno
           $linha = "";// cria uma nova linha
           $caraUsados = 0;// autualiza o caracteres usados
          }
            if(strlen($palavra) <= $length){// verifica se a palavra é menor que a linha especificada, se sim adciona ela na linha e
             $linha .= $palavra; // atualiza os caracteres usados
             $caraUsados = strlen($palavra);
           }
           else{ // este else cobre o segundo caso, se a palavra for maior do que a linha especificada
            array_push($ret,substr($palavra,0,$length)); // coloca o corte de uma palavra até o length da linha
            $corte = strlen($palavra) - $length;// cria o corte para o restante da palavra
            $linha = substr($palavra,($corte * -1)); // pega o pedaço da palavra que não cabe na linha
            if($linha < $length){// verifica se o pedaço da palavra cortado cabe na proxima linha, se sim conta os caracteres
              $caraUsados = strlen($linha);
            }
            else{// este else cobre caso o pedaço da palavra não caiba dentro linha
              array_push($ret,substr($linha,0,$length));// faz o corte da palavra para que possa caber dentro da linha
              $corte = strlen($palavra) - $length;// cria o corte do restante da palavra
              $linha = substr($linha,($corte * -1));// pega o pedaço restante
              $caraUsados = strlen($palavra);// conta os caracteres usados
            }
           }
         }
       }
       if($linha != "") // após o for verifica se ainda existe algo na linha, se sim coloca ela no array de retorno
       array_push($ret,$linha);// este ultimo if foi feito pois geralmente sobrava uma ultima linha que não entrava no array
       return $ret;// retorna o array contendo as linhas 
    }
    

}
