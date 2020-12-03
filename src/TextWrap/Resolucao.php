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
    if (mb_strlen($text) < 1) {
      return [NULL];
    }
    /*
    Transforma o input em uma array de strings.
     */
    $inputArray = explode(" ", $text);
    $linha = "";
    $resultado = [];
    $aux = "";

    for ($i = 0; $i < count($inputArray); $i++) {
      /* Essa sessão inteira é pra dar split
      nas palavras quando são menores que
      o tamanho máximo, mas sem usar str_split. */
      if (mb_strlen($inputArray[$i]) > $length) {
        $contador = 0;
        for ($x = 0; $x <= mb_strlen($inputArray[$i]); $x++) {
          if ($contador < $length) {
            $aux = $aux . substr($inputArray[$i], $x, 1);
            $contador++;
            if ($x >= mb_strlen($inputArray[$i])) {
              array_push($resultado, $aux);
              $aux = "";
            }
          }
          else {
            array_push($resultado, $aux);
            $aux = "";
            $aux = $aux . substr($inputArray[$i], $x, 1);
            $contador = 1;
          }
        }
      }
      // Aqui termina o str_split alternativo.
      elseif (mb_strlen($inputArray[$i] . $inputArray[$i + 1]) + 1 <= $length) {
        array_push($resultado, $inputArray[$i] . " " . $inputArray[$i + 1]);
        $i++;
      }
      elseif (mb_strlen($inputArray[$i] . $inputArray[$i + 1]) + 1 > $length) {
        array_push($resultado, $inputArray[$i]);
      }
    }
    return $resultado;
  }

}
