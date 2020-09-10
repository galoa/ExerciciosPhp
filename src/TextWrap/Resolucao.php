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
   * A função textWrap quebra uma string em outras com tamanho desejado.
   *
   * A função garantirá:
   * - Retorno de todo o texto, com o máximo de palavras por linha, mas sem
   * nunca extrapolar o limite de caracteres.
   * - Se uma palavra não couber na linha e o comprimento dela for menor que o
   * limite de caracteres, ela não será cortada, e sim jogada para a
   * próxima linha.
   * - Se a palavra for maior que o limite de caracteres por linha, cortará a
   * palavra e continuará a imprimi-la na linha seguinte.
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
  public function textWrap(string $text, int $length): array {
    $somaCaracteres = -1;
    $linha = [];
    $vetorLinhas = [];
    $vetorPalavras = explode(" ", $text);

    foreach ($vetorPalavras as $palavra) {

      $somaCaracteres += mb_strlen($palavra) + 1;

      if ($somaCaracteres <= $length) {
        array_push($linha, $palavra);
      }
      else {
        if (mb_strlen($palavra) <= $length) {
          $posicaoQuebraPalavra = 0;
        }
        else {
          $posicaoQuebraPalavra = $length - ($somaCaracteres - mb_strlen($palavra));
          if ($posicaoQuebraPalavra > 0) {
            $pedacoPalavra = substr($palavra, 0, $posicaoQuebraPalavra);
            array_push($linha, $pedacoPalavra);
          }
          else {
            $posicaoQuebraPalavra = 0;
          }
        }
        while (mb_strlen($palavra) > $posicaoQuebraPalavra) {
          $stringLinhaConvertida = implode(" ", $linha);

          array_push($vetorLinhas, $stringLinhaConvertida);
          $linha = [];
          $pedacoPalavra = substr($palavra, $posicaoQuebraPalavra, $length);

          array_push($linha, $pedacoPalavra);
          $somaCaracteres = mb_strlen($pedacoPalavra);
          $posicaoQuebraPalavra += $length;
        }
      }
    }

    $stringLinhaConvertida = implode(" ", $linha);
    array_push($vetorLinhas, $stringLinhaConvertida);

    return $vetorLinhas;
  }

}
