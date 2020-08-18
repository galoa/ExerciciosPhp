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
    public  function textWrap(string $text, int $length): array {
    // Variaveis que serao usadas no programa.
    $array = explode(' ', $text);
    // Divide o texto base em texto menores. 
    $newText = ""; 
    $rowLength = 0;
    foreach ($array as $string) {
      if (mb_strlen($string, 'UTF-8') + $rowLength <= $length) {
        // Se a palavra for menor que o maximo de caracteres.
        $string .= " ";
        // Devolvendo os espacamentos 
        $rowLength += mb_strlen($string, 'UTF-8');
        // Tamanho atual da linha e incrementado com o tamanho da palvra. 
        $newText .= $string;
      }
      else {
        // Caso a palavra seja maior que o maximo de caracteres.
        $string .= " ";
        $rowLength = mb_strlen($string, 'UTF-8');
        $newText .= "\n";
        $newText .= $string;
      }

    }
    // FORMATANDO A SAIDA DE DADOS !
    $trimmed = trim($newText, " ");
    // Retira os espaços em branco do inicio e do final da String.
    $x = explode("\n", $trimmed);
    // Retirando as quebras de linha 
    $clean = array_map('trim', $x);
    // Remove os espaços em branco de  todos os elementos do array.

    return $clean;
  }

}
