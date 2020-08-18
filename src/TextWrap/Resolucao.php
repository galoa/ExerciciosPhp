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
    $array = explode(' ', $text);
    $newText = "";
    $rowLength = 0;
    foreach ($array as $string) {
      if (mb_strlen($string,'UTF-8') + $rowLength <= $length) {
        $string .= " ";
        $rowLength += mb_strlen($string,'UTF-8');
        $newText .= $string;
        continue;
      }
      else {
        $string .= " ";
        $newText .= "<br/>".$string;
        $rowLength = mb_strlen($string,'UTF-8');
        continue;
      }
    
    }
    $trimmed = trim($newText, " ");
    $x = explode("\n", $trimmed);

    $clean = array_map('trim', $x);

    return $clean;
  }

}
