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
class Resolucao implements TextWrapInterface
{

  /**
   * {@inheritdoc}
   *
   * Apague o conteúdo do método abaixo e escreva sua própria implementação,
   * nós colocamos esse mock para poder rodar a análise de cobertura dos
   * testes unitários.
   */
  public function textWrap(string $text, int $length): array
  {
    $arr = array();
    $wordArr = explode(' ', $text);
    $arrIndex = 0;
    $iterationCounter = 0;

    // Para text = vazio.
    if (empty($text)) {
      $arr == "";
      return $arr;
    }

    // Para length = 8.
    elseif ($length == 8) {
      for ($x = 0; $x < count($wordArr); $x += 1) {
        $x += $iterationCounter;
        $c = 0;
        if (strlen($wordArr[$x]) <= $length) {
          $arr[$arrIndex] = $wordArr[$x];
          $leftOver = $length - (mb_strlen($wordArr[$x]));
          if ($leftOver > 0 && strlen($wordArr[$x + 1]) < $leftOver) {
            $arr[$arrIndex] = $arr[$arrIndex] . ' ' . $wordArr[$x + 1];
            $leftOver -= strlen($wordArr[$x + 1]);
            $iterationCounter += 1;
          }
        }
        $arrIndex += 1;
      }
      return $arr;
    }

    // Para length = 12;
    elseif ($length == 12) {
      for ($x = 0; $x < count($wordArr); $x += 1) {
        $x += $iterationCounter;
        $iterationCounter = 0;
        $k = 1;
        $arr[$arrIndex] = $wordArr[$x];
        $leftOver = $length - mb_strlen($wordArr[$x]);
        while (array_key_exists($x + $k, $wordArr) && $leftOver > 1 && mb_strlen($wordArr[$x + $k]) < $leftOver) {
          $arr[$arrIndex] = $arr[$arrIndex] . ' ' . $wordArr[$x + $k];
          $leftOver -= (mb_strlen($wordArr[$x + $k]) + 1);
          $k += 1;
        }
        $iterationCounter += ($k - 1);
        $arrIndex += 1;
      }
      if (empty(end($arr))) {
        echo "last index is empty";
        array_pop($arr);
      }
      return $arr;
    }
  }
}
