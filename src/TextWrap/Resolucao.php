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
  public function textWrap($text, $length): array {

    $cut = "";
    // String para vazio que será preenchido.
    $words = explode(" ", $text);
    // Separar as palavras do string de entrada em um array de palavras.
    // Preenchendo o string de saída:
    $l = $length;
    // Espaço disponível de cada linha.
    for ($i = 0; $i < count($words); $i++) {
      // Observar cada palavra do array.
      if (strlen($words[$i]) <= $length) {
        if (strlen($words[$i]) < $l) {
          // Ao adicionar uma palavra, já adicionamos o espaçamento.
          // (Exceto para a primeira palavra do texto).
          if ($i == 0) {
            $cut .= $words[0];
            $l -= strlen($words[0]);
          }
          else {
            $cut .= " " . $words[$i];
            $l -= (strlen($words[$i]) + 1);
          }
        }
        else {
          $cut .= "\n" . $words[$i];
          $l = $length - strlen($words[$i]);
        }
      }
      // Caso extremo: palavra maior que a linha:
      else {
        if ($l < $length) {
          $cut .= "\n";
        }
        // Garantindo que essa palavra estará iniciando uma linha.
        $parte1 = "";
        for ($j = 0; $j < $length; $j++) {
          $parte1 .= $words[$i][$j];
        }
        $parte2 = "";
        for ($k = $length; $k < strlen($words[$i]); $k++) {
          $parte2 .= $words[$i][$k];
        }
        if ($i == 0) {
          $cut .= $parte1;
        }
        else {
          $cut .= " " . $parte1;
        }
        $l = 0;
        // A palavra em questão pode ser mais extensa que 2 linhas...
        // Solução: retornar o resto da palavra para a análise.
        $words[$i] = $parte2;
        $i--;
      }
    }
    $lista = explode("\n", $cut);
    return $lista;
  }

}
