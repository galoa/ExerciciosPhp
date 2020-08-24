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
    $retorno= array();
    $palavras = explode(" ",$text);
    $retorno = array();

    if (empty($text)) {
      return $retorno;
    }

    foreach($palavras as $palavra){          
      $textoNovo="";

      if (mb_strlen($palavra, "UTF-8") <= $length) {
        if(empty($retorno)) {
          array_push($retorno, $palavra);
        } else {
          $contador = count($retorno) - 1;
          $textoNovo = $retorno[$contador] . " " . $palavra;

          if(mb_strlen($textoNovo, "UTF-8") <= $length) {
            $retorno[$contador] = $textoNovo;
          } else {
            array_push($retorno, $palavra);
          }
        }
      }
      else {
        while(mb_strlen ($palavra, "UTF-8") > $length) {
          $palavraQuebrada = substr($palavra, 0, $length);
          array_push($retorno, $palavraQuebrada);
          $palavra = substr($palavra,$length);
        }

        array_push($retorno, $palavra);
      }
    }

    return $retorno;
  }

}
