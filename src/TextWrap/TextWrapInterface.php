<?php

namespace Galoa\ExerciciosPhp\TextWrap;

/**
 * Define uma interface para o exercício de quebra de linha.
 */
interface TextWrapInterface {

  /**
   * Quebra uma string em diversas strings com tamanho passado por parâmetro.
   *
   * Suponha que você tenha uma string com um texto bastante longo. Você quer
   * imprimir na tela todo o texto, mas garantir um limite máximo de N
   * caracteres por linha.
   *
   * Alguns pontos que você deve ter em mente:
   * - Retorne o todo o texto, com o máximo de palavras por linha, mas sem
   *   nunca extrapolar o limite de caracteres.
   * - Se uma palavra não couber na linha e o comprimento dela for menor que o
   *   limite de caracteres, ela não deve ser cortada, e sim jogada para a
   *   próxima linha.
   * - Se a palavra for maior que o limite de caracteres por linha, corte a
   *   palavra e continue a imprimi-la na linha seguinte.
   * - Não utilize funções prontas, como p.ex. o wordwrap do PHP. O objetivo
   *   deste exercício é que você desenvolva o algoritmo indicado.
   *
   * @param string $text
   *   O texto que será utilizado como entrada.
   * @param int $length
   *   Em quantos caracteres a linha deverá ser quebrada.
   *
   * @return array
   *   Um array de strings equivalente ao texto recebido por parâmetro porém
   *   respeitando o comprimento de linha e as regras especificadas acima.
   */
   
   
   
   
   
  public function textWrap(string $text, int $length): array;

}
