<?php

namespace Galoa\ExerciciosPhp\TextWrap;

/**
 * Class Resolucao.
 *
 * @package Galoa\ExerciciosPhp\TextWrap
 */
class Resolucao implements TextWrapInterface {

  /**
   * Quebra um texto em varias linhas com tamanho delimitado.
   *
   * @param string $text
   *   Texto a ser quebrado.
   * @param int $length
   *   Tamanho maximo da linha.
   *
   * @return array|null[]
   *   Array o texto quebrado por linhas
   *   ou null quando passado uma string vazia.
   */
  public function textWrap(string $text, int $length): array {
    if (mb_strlen($text, 'UTF-8') == 0) {
      return [NULL];
    }
    $arrText = explode(" ", $text);
    $lines = [];
    $line = "";
    foreach ($arrText as $word) {
      if (mb_strlen($word, 'UTF-8') <= $length) {
        if (
              $length - mb_strlen($line, 'UTF-8') > mb_strlen($word, 'UTF-8') ||
              $length - mb_strlen($line, 'UTF-8') == mb_strlen($word, 'UTF-8') + 1
          ) {
          // Usando > ao invés >= de para caber o espaço.
          $line = mb_strlen($line, 'UTF-8') == 0 ? $line . $word : $line . " " . $word;
        }
        else {
          $lines[] = $line;
          // Limpa ao mesmo tempo que adiciona a palavra.
          // A palavra nunca será maior que a.
          $line = $word;
          // linha, por isso não é necessario uma nova verificação.
        }
      }
      else {
        $counter = 0;
        for ($i = 0; $i < mb_strlen($word, 'UTF-8'); $i++) {
          // Usando < ao invés de <= para dar espaço
          // ao ultimo caractere no else, se não perderia a letra.
          if ($counter < $length) {
            $line += $word[$i];
            $counter++;
          }
          else {
            $counter = 0;
            $line += $word[$i];
            $lines[] = $line;
            $line = "";
          }
        }
      }
    }
    if (mb_strlen($line, 'UTF-8') != 0) {
      $lines[] = $line;
    }
    return $lines;
  }

}
