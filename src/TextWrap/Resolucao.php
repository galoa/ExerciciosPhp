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
    array_push($inputArray, "");
    $linha = "";
    $resultado = [];
    $aux = "";

    for ($i = 0; $i < count($inputArray) - 1; $i++) {
      /*
      Essa sessão inteira é pra dar split
      nas palavras quando são menores que
      o tamanho máximo, mas sem usar str_split.
       */
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
        $linha = "";
      }
      // Aqui termina o str_split alternativo.
      else {
        /*
        Se a variável auxiliar concatenada com um espaço e a
        palavra atual ter o espaço menor que o tamanho máximo.
         */
        if (mb_strlen($linha . " " . $inputArray[$i]) < $length) {
          /*
          Se a variável auxiliar estiver vazia, então
          é atribuida a palavra atual a ela.
           */
          if (mb_strlen($linha) < 1) {
            $linha = $inputArray[$i];
          }
          /*
          Se não, concatenamos da mesma forma que
          testamos no if e passamos para próxima iteração.
           */
          else {
            $linha = $linha . " " . $inputArray[$i];
          }
        }
        /*
        Caso o resultado da concatenação seja igual ao tamanho máximo
         */
        elseif (mb_strlen($linha . " " . $inputArray[$i]) == $length) {
          /*
          Se a variável auxiliar estiver vazia, dentro
          dessa condição, é porque a palavra deve ficar sozinha
          na linha, em todos os casos, então adicionamos
          a palavra ao resultado.
           */
          if (mb_strlen($linha) < 1) {
            $linha = $inputArray[$i];
            array_push($resultado, $linha);
            $linha = "";
          }
          /*
          Se não, é porque as duas palavras concatenadas
          cabem perfeitamente na linha, então adicionamos
          a concatenação no resultado.
           */
          else {
            $linha = $linha . " " . $inputArray[$i];
            array_push($resultado, $linha);
            $linha = "";
          }
        }
        /*
        Se a concatenação tiver tamanho maior que o tamanho
        máximo permitido.
         */
        elseif (mb_strlen($linha . " " . $inputArray[$i]) > $length) {
          /*
          Verificamos se a variável auxiliar tem algum conteúdo
          e se tiver nós adicionamos ele ao resultado e
          colocamos a palavra atual na variável auxiliar.
           */
          if (mb_strlen($linha) > 0) {
            array_push($resultado, $linha);
            $linha = $inputArray[$i];
          }
          /*
          Se a variável não tiver conteúdo, adicionamos
          a palavra atual ao resultado e passamos para
          a próxima iteração.
           */
          else {
            array_push($resultado, $inputArray[$i]);
          }
        }
        /*
        Se estivermos na última iteração do for
        adicionamos a última palavra ao resultado,
        lembrando que só dá para chegar nessa parte
        do código caso a palavra não seja maior
        que o tamanho máximo, se a última palavra
        for maior que o tamanho máximo ela vai ser tratada
        antes de chegar aqui.
         */
        if ($i == count($inputArray) - 2) {
          array_push($resultado, $inputArray[$i]);
        }
      }
    }
    /*
    E, finalmente, depois de muitas horas quebrando a cabeça
    para implementar um algoritmo que eu não conhecia
    em uma linguagem que eu não sabia usar, o resultado
    é retornado.

    Obrigado por ler até aqui.
     */
    return $resultado;
  }

}
