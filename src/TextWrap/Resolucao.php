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
    /*
    Verifica se o input está vazio e retorna uma array
    com um elemento null caso esteja.
     */
    if (mb_strlen($text) < 1) {
      return [NULL];
    }
    /*
    Transforma o input em uma array de strings.
    A variável linha é para ser usada como variável temporária/auxiliar.
     */
    $inputArray = explode(" ", $text);
    $temp = "";
    $linha = "";
    $resultado = [];
    /*
    Percorre o array pegando tanto o index quanto a string em si.
    Nessa abordagem eu uso o index apenas para verificar se é a última palavra.
     */
    for ($i = 0; $i < $length; $i++) {
      $temp = $inputArray[$i];
      while (mb_strlen($temp) > $length) {
        array_push($resultado, substr($temp, 0, $length));
        $temp = substr($temp, $length);
      }

      if (mb_strlen($temp) > 0 && $temp != $inputArray[$i]) {
        $linha = $temp;
      }

      switch (TRUE) {
        case (mb_strlen($linha) == $length):
          array_push($resultado, $linha);
          break;

        case ((mb_strlen($linha . $inputArray[$i]) + 1) < $length):
          $linha = $linha . " " . $inputArray[$i];
          break;

        case ((mb_strlen($linha . $inputArray[$i]) + 1) == $length):
          if (mb_strlen($linha) < 1) {
            array_push($resultado, $inputArray[$i]);
          }
          else {
            array_push($resultado, $linha . " " . $inputArray[$i]);
          }
          break;

        case ((mb_strlen($linha . $inputArray[$i]) + 1) > $length):
          array_push($resultado, $linha);
          $linha = $inputArray;
          break;
      }
    }

    return $resultado;
  }

}
