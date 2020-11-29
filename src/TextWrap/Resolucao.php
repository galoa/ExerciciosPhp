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
    $wordArr = explode(' ', $text);
    $counter = 0;
    $index = 0;
    $iterationCounter = 1;

    if (empty($text)) {
      $arr[0] = "";
      return $arr;
    }
    else {
      for ($x = 0; $x + $counter < count($wordArr); $x += 1) {
        $x += $counter;
        $counter = 0;
        $iterationCounter = 1;
        if (mb_strlen($wordArr[$x]) <= $length) {
          $arr[$index] = $wordArr[$x];
          $leftOver = $length - mb_strlen($wordArr[$x]);
            while (
                array_key_exists($x + $iterationCounter, $wordArr)
                  && mb_strlen($wordArr[$x + $iterationCounter]) < $leftOver && $leftOver > 1
                ) {
            $arr[$index] = $arr[$index] . ' ' . $wordArr[$x + $iterationCounter];
            $leftOver -= (mb_strlen($wordArr[$x + $iterationCounter]) + 1);
            $iterationCounter += 1;
        }
          $counter += ($iterationCounter - 1);
          $index += 1;
        }
        else {
          $newArr = mb_str_split($wordArr[$x], $length);
          for ($z = 0; $z < count($newArr); $z += 1) {
            $arr[$index + $z] = $newArr[$z];
            $leftOver = $length - mb_strlen($newArr[$z]);
            while (array_key_exists($x + $iterationCounter, $wordArr)
                    && mb_strlen($wordArr[$x + $iterationCounter]) < $leftOver && $leftOver > 1) {
              $arr[$index + $z] = $arr[$index + $z] . ' ' . $wordArr[$x + $iterationCounter];
              $leftOver -= (mb_strlen($wordArr[$x + $iterationCounter]) + 1);
              $iterationCounter += 1;
            }
          }
          $counter += ($iterationCounter - 1);
          $index += $z;
        }
      }
    }
    if (empty(end($arr))) {
      array_pop($arr);
    }
    return $arr;
  }

}
