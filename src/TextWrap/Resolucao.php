<?php

namespace Galoa\ExerciciosPhp\TextWrap;

/**
 * Interface para implementar a função textWrap().
 */
interface ResolucaoInterface {

  /**
   * Função textWrap() que necessita um string e um int como parâmetros.
   *
   * Retornando um array.
   */
  public function textWrap(string $text, int $length): array;

}

/**
 * Classe Resolucao que implementa a interface Resolucao.
 *
 * Sendo assim, possível implementar a função abstrata textWrap().
 */
class Resolucao implements ResolucaoInterface {

  /**
   * A partir de um número definido de caracteres por linha.
   *
   * Separa o texto em palavras divididas por espaços com as seguintes regras:
   * - Retorne o todo o texto, com o máximo de palavras por linha.
   *
   * Mas sem nunca extrapolar o limite de caracteres.
   * - Se uma palavra não couber na linha.
   * E o comprimento dela for menor que o limite de caracteres.
   * Ela não deve ser cortada, e sim jogada para a próxima linha.
   * - Se a palavra for maior que o limite de caracteres por linha.
   *
   * Corte a palavra e continue a imprimi-la na linha seguinte.
   */
  public function textWrap(string $text, int $length): array {
    $originalLength = $length;

    $text = explode(" ", $text);
    $array = "";

    for ($i = 0; $i < count($text); $i++) {
      if (strlen($text[$i]) <= $length) {
        $array = $array . $text[$i];
        $length - strlen($array[$i]);
      }

      elseif (strlen($text[$i]) > $length && strlen($text[$i]) <= $originalLength) {
        $array = $array . "<br/>" . $text[$i];
        $originalLength - strlen($text[$i]);
      }

      elseif (strlen($text[$i]) > $originalLength && strlen($text[$i]) > $length) {
        $splitText = str_split($text[$i]);

        for ($j = 0; $j < count($splitText); $j++) {
          if (count($splitText) <= $length) {
            $array = $array . $splitText[$j];
            $length - strlen($splitText[$j]);
          }

          else {
            $k = 1;

            if ($k <= $length && $k <= count($splitText)) {
              $array = $array . $splitText[$j];
              $length - strlen($splitText[$j]);

              $k++;
            }

            else {
              $array = $array . "<br/>" . $splitText[$j];
              $originalLength - strlen($splitText[$j]);
            }
          }
        }
      }

      $array = $array . " ";
      $length - 1;

    }

    return str_split($array);

  }

}
