<?php

namespace Galoa\ExerciciosPhp\TextWrap;

/**
 * Classe utilizada para quebra de um texto e várias linhas.
 *
 * @method textWrap(string $text, int $length): array
 * @author Vitor Hugo da Costa Luz
 * @version 2.0
 * @access public
 * @package TextWrap
 */
class Resolucao implements TextWrapInterface {

  /**
   * {@inheritdoc}
   *
   * Divide uma string em várias sub-partes agrupadas em um array.
   *
   * @param string $text
   *   O texto que será utilizado como entrada.
   * @param int $length
   *   Em quantos caracteres a linha deverá ser quebrada.
   *
   * @return array
   *   Um array de strings equivalente ao texto recebido
   *
   * @access public
   * @version 2.0
   */
  public function textWrap(string $text, int $length): array {
    $espaco = ' ';
    $palavrasTexto = preg_split("[ ]", $text);
    $listaSaida = [""];
    $linha = 0;
    for ($i = 0; $i < count($palavrasTexto) && $length > 0; $i++) {

      $palavra = $palavrasTexto[$i];
      if (mb_strlen($palavra) <= $length) {
        if (mb_strlen($listaSaida[$linha]) == 0) {
          $listaSaida[$linha] .= $palavra;
        }
        else {

          if (mb_strlen($listaSaida[$linha]) + mb_strlen($palavra) < $length) {
            $listaSaida[$linha] .= $espaco . $palavra;
          }
          else {
            $listaSaida[] = $palavra;
            $linha++;
          }
        }
      }
      else {
        if (mb_strlen($listaSaida[$linha]) == 0) {
          $listaSaida[$linha] .= substr($palavra, 0, $length);
          $palavra = substr($palavra, $length, mb_strlen($palavra));
        }
        elseif (mb_strlen($listaSaida[$linha]) < $length) {
          $tamCorte = $length - mb_strlen($listaSaida[$linha]) - 1;
          $listaSaida[$linha] .= $espaco . substr($palavra, 0, $tamCorte);
          $palavra = substr($palavra, $tamCorte, mb_strlen($palavra));
        }

        while (mb_strlen($palavra) >= $length) {
          $listaSaida[] = substr($palavra, 0, $length);
          $palavra = substr($palavra, $length, mb_strlen($palavra));
          $linha++;
        }

        if (mb_strlen($palavra) > 0) {
          $listaSaida[] = $palavra;
          $linha++;
        }
      }
    }
    return $listaSaida;
  }

}
