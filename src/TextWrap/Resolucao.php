<?php

namespace Galoa\ExerciciosPhp\TextWrap;

/**
 * Classe responsável por gerar um array de substrings.
 *
 * @author Maria Luiza Fernandes
 */
class Resolucao implements TextWrapInterface {

  /**
   * {@inheritDoc}
   *
   * Função responsável por retornar um array de substrings.
   *
   * @param string $text
   *   Contém o conteúdo a ser dividido.
   * @param int $length
   *   Contém o tamanho máximo de cada substring.
   */
  public function textWrap(string $text, int $length): array {
    $words = [];
    $currentPosition = 0;

    if ($length > 0 && strlen($text) > 0) {
      for ($upIndex = 0; $upIndex < strlen($text);) {
        $downIndex = $upIndex + $length;

        $limit = $length;
        for ($j = 0; $j < $limit; $j++) {
          if ($upIndex + $j < strlen($text)) {
            if (preg_match('/^[ç´`~^]+/', $text[$upIndex + $j])) {
              $j++;
              $limit++;
            }

          }

          if ($upIndex + $j < strlen($text) - 1) {
            if ($text[$upIndex + $j + 1] == ' ') {
              $downIndex = $upIndex + $j + 1;
            }

          }

          elseif ($j <= $limit) {
            $downIndex = $upIndex + $j + 1;
          }
        }

        $newWord = "";
        for ($j = 0; $upIndex + $j < $downIndex; $j++) {
          if ($upIndex + $j < strlen($text)) {
            $newWord[$j] = $text[$upIndex + $j];
          }
        }

        $words[$currentPosition] = $newWord;
        $currentPosition++;

        if ($downIndex < strlen($text)) {
          $sum = 0;
          $aux = $downIndex;
          while ($text[$aux] == ' ') {
            $aux++;
            $sum++;
          }

          if ($sum != 0) {
            $upIndex = $downIndex + $sum;
          }
          else {
            $upIndex = $downIndex;
          }
        }

        else {
          $upIndex = strlen($text);
        }
      }
      return $words;
    }

    return [""];
  }

}
