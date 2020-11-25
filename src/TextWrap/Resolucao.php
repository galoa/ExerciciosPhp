<?php

namespace Galoa\ExerciciosPhp\TextWrap;

/**
 * Classe responsável por gerar um array de substrings.
 *
 * @author Maria Luiza Fernandes
 * @access public
 * @package TextWrap
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
   *
   * @return array
   *   Array contendo as substrings.
   * @access public
   */
  public function textWrap(string $text, int $length): array {
    $words = [];
    $currentPosition = 0;

    /*
     * Verifica se a string a ser dividida não é vazia.
     * Verifica se o tamanho máximo de cada substring é maior que zero.
     */
    if ($length > 0 && strlen($text) > 0) {
      /*
       * Percorre a string a ser dividida.
       */
      for ($upIndex = 0; $upIndex < strlen($text);) {
        $downIndex = $upIndex + $length;

        /*
         * Percorre a string da posição atual até o limite definido.
         */
        $limit = $length;
        for ($j = 0; $j < $limit; $j++) {
          if ($upIndex + $j < strlen($text)) {
            /*
             * Verifica se o caracter atual é especial.
             * Caso seja é adicionado uma posição no limite,
             * pois um caracter especial ocupa duas posições na string.
             */
            if (preg_match('/^[ç´`~^]+/', $text[$upIndex + $j])) {
              $j++;
              $limit++;
            }

          }

          /*
           * Atualiza $downIndex que marca a posição final da substring atual.
           */
          if ($upIndex + $j < strlen($text) - 1) {
            if ($text[$upIndex + $j + 1] == ' ') {
              $downIndex = $upIndex + $j + 1;
            }

          }

          elseif ($j <= $limit) {
            $downIndex = $upIndex + $j + 1;
          }
        }

        /*
         * Cria uma string com os caracteres contidos entre
         * o limite inferior $upIndex e o limite superior $downIndex.
         */
        $newWord = "";
        for ($j = 0; $upIndex + $j < $downIndex; $j++) {
          if ($upIndex + $j < strlen($text)) {
            $newWord[$j] = $text[$upIndex + $j];
          }
        }

        /*
         * Adiciona a substring no array de retorno.
         */
        $words[$currentPosition] = $newWord;
        $currentPosition++;

        /*
         * Atualiza o indíce de limite inferior para o próximo caracter.
         */
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
