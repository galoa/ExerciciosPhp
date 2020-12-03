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
    $linha = "";
    $resultado = [];
    /*
    Percorre o array pegando tanto o index quanto a string em si.
    Nessa abordagem eu uso o index apenas para verificar se é a última palavra.
     */
    foreach ($inputArray as $index => $palavra) {
      // Um switch TRUE, porque acho mais organizado que uma cadeia de if/else.
      switch (TRUE) {
        /*
        Primeira alternativa:
        O número de caracteres da palavra é maior que o tamanho máximo.
         */
        case (mb_strlen($palavra) > $length):
          /* Adiciona ao resultado uma substring com o tamanho máximo,
          retirada da string. */
          array_push($resultado, substr($palavra, 0, $length - 1));
          // E adiciona à variável temporária $linha o restante.
          $linha = substr($palavra, $length - 1, mb_strlen($palavra) - 1);
          // Se for a última string do array adiciona a linha ao resultado.
          if ($index == count($inputArray) - 1) {
            array_push($resultado, $linha);
          }
          break;

        /* Segunda alterantiva:
        O número de caracteres da variável auxiliar $linha mais a palavra
        é maior que o tamanho máximo, já que uso a variável auxiliar pra guardar
        o que sobrou da linha anterior.
         */
        case (mb_strlen($linha . $palavra) > $length):
          // Adiciona ao resultado a linha.
          array_push($resultado, $linha);
          // A palavra é armazenada na variável auxiliar.
          $linha = $palavra;
          /* Verifica se é a última linha e, se for,
          adiciona linha ao resultado. */
          if ($index == count($inputArray) - 1) {
            array_push($resultado, $linha);
          }
          break;

        /*
        Terceira alternativa:
        O número de caracteres da variável auxiliar mais a palavra
        somados com 1 (pra representar o espaço) é menor que o tamanho máximo.
         */
        case (mb_strlen($linha . $palavra) + 1 < $length):
          // Se a variável auxiliar estiver vazia a palavra ocupa o lugar dela.
          if (mb_strlen($linha) < 1) {
            $linha = $palavra;
          }
          /* Se não, a variável auxiliar guarda o que havia nela concatenado
          com um espaço e a palavra. */
          else {
            $linha = $linha . " " . $palavra;
            /* Se for a última string, adiciona ao
            resultado a variável auxiliar. */
            if ($index == count($inputArray) - 1) {
              array_push($resultado, $linha);
            }
          }
          break;

        /*
        Quarta alternativa:
        O número de caracteres da variável auxiliar mais a palavra
        somados com 1 é igual ao tamanho máximo.
        fiz dessa forma para poder esvaziar variável auxiliar
        e também adicionar ao resultado diretamente.
         */
        case (mb_strlen($linha . $palavra) + 1 == $length):
          if (mb_strlen($linha) < 1) {
            $linha = $palavra;
            /* Se for a última string, adiciona ao resultado
            a variável auxiliar. */
            if ($index == count($inputArray) - 1) {
              array_push($resultado, $linha);
            }
          }
          /*
          Se não for, concatena na variável auxiliar um espaço e a palavra,
          adiciona ao resultado e esvazia a variável auxiliar
           */
          else {
            $linha = $linha . " " . $palavra;
            array_push($resultado, $linha);
            $linha = "";
          }
          break;

        /*
        Quarta alternativa:
        o número de caracteres da variável auxiliar mais um (espaço)
        é maior que o tamanho máximo.
         */
        case (mb_strlen($linha . $palavra) + 1 > $length):
          /*
          Adiciona ao resultado a variável auxiliar,
          carregando o resto da última linha adicionada.
           */
          array_push($resultado, $linha);
          // A variável auxiliar agora guarda a palavra atual.
          $linha = $palavra;
          // Se for a última string do array ela é adicionada ao resultado.
          if ($index == count($inputArray) - 1) {
            array_push($resultado, $linha);
          }
          break;

      }
    }
    return $resultado;
  }

}
