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
    $resultado = [];
    $caracter = [];
    $posicaoCaracter = 1;
    $posicao = 0;
    $resultado[$posicao] = '';
    // Loop para criar o array da string.
    for ($i = 0; $i < strlen($text); $i++) {
      $caracter[$posicaoCaracter] = $text[$i];
      $posicaoCaracter++;
      // Verifica se a linha já atingiu o tamanho estipulado.
      if (($posicaoCaracter - 1) == $length) {
        // Verifica se a linha tem espaços entre as palavras.
        if (in_array(' ', $caracter)) {
          // Verifica se o próximo caracter é ' '.
          if (isset($text[$i + 1]) && $text[$i + 1] != ' ') {
            // Elimina ' ' da linha evitando corte de palavras.
            for ($e = count($caracter); $e > 0; $e--) {
              if ($caracter[$e] == ' ') {
                $i -= $length - $e;
                array_pop($caracter);
                break;
                }
                array_pop($caracter);
            }
          }
        }
        if ($text[$i + 1] == ' ') {
          $i += 1;
        }
        // Gera linha.
        $resultado[$posicao] = implode($caracter);
        // Prepara variáveis para iniciar uma nova linha.
        $posicaoCaracter = 1;
        $caracter = [];
        $posicao++;
        // Construção da última linha.
      } elseif ($i == (strlen($text)) - 1) {
          $resultado[$posicao] = implode($caracter);
        }
    }
    return $resultado;
  }

}
