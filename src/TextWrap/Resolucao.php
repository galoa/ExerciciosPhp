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
    // String vazio que será preenchido.
    $words = explode(" ", $text);
    // Separar as palavras do string de entrada em um array de palavras.
    // Preenchendo o string de saída:
    $l = $length;
    // Espaço disponível de cada linha.
    for ($i = 0; $i < count($words); $i++) {
      // Observar cada palavra do array.
      if (mb_strlen($words[$i], 'utf8') < $length) {
        if (strlen($words[$i]) < $l) {
          // Ao adicionar uma palavra, já adicionamos o espaçamento.
          // (Exceto para a primeira palavra de cada linha.)
          if ($l == $length) {
            $cut .= $words[0];
            $l -= mb_strlen($words[0], 'utf8');
          }
          else {
            $cut .= " " . $words[$i];
            $l -= (mb_strlen($words[$i], 'utf8') + 1);
          }
        }
        else {
          $cut .= "\n" . $words[$i];
          $l = $length - mb_strlen($words[$i], 'utf8');
        }
      }
      // Casos extremos: palavra do tamanho ou maior que a linha:
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
        for ($k = $length; $k < mb_strlen($words[$i], 'utf8'); $k++) {
          $parte2 .= $words[$i][$k];
        }
        $cut .= $parte1;
        $l = 0;
        // A palavra em questão pode ser mais extensa que 2 linhas...
        // Solução: retornar o resto da palavra para a análise.
        $words[$i] = $parte2;
        if (mb_strlen($parte2) > 0) {
          $i--;
        }
      }
    }
    $lista = explode("\n", $cut);
    return $lista;
  }

}
