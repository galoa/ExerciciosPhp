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
    $words = [];
    $currentPosition = 0;

    /**
     * Verifica se o tamanho de cada palavra é maior que 0
     * E se o texto passado por parâmetro não é vazio
     */
    if ($length > 0 && strlen($text) > 0) {

    	/**
    	 * Percorre a string passada por parâmetro
    	 * $upIndex guarda o índice inicial da substring a ser inserida no retorno
    	 */
      for ($upIndex = 0; $upIndex < strlen($text);) {

      	/**
      	 * $downIndex guarda o índice final da substring a ser inserida no retorno
      	 */
        $downIndex = $upIndex + $length;

        /**
         * Percorre a string a partir do índice inicial até o tamanho desejado
         * da substring a ser inserida no retorno
         */
        $limit = $length;
        for ($j = 0; $j < $limit; $j++) {
          if ($upIndex + $j < strlen($text)) {

          	/**
          	 * Verifica se o caracter em questão é especial
          	 * pois caracteres especiais ocupam 2 posições do array de string
          	 */
            if (preg_match('/^[ç´`~^]+/', $text[$upIndex + $j])) {
              $j++;
              $limit++;
            }
          }

          /**
           * Verifica se o caracter não é o último do array
           * Caso não seja é verificado se o caracter em questão é um espaço
           * Caso seja um espaço o índice final é atualizado para o próximo índice
           * após o espaço
           */
          if ($upIndex + $j < strlen($text) - 1) {
            if ($text[$upIndex + $j + 1] == ' ') {
              $downIndex = $upIndex + $j + 1;
            }
          }

          /**
           * Caso o índice atual seja menor ou igual que o limite
           * O índice final é atualizado para o próximo índice 
           */
          elseif ($upIndex 	+ $j <= $limit) {
            $downIndex = $upIndex + $j + 1;
          }  
        }
        
        /**
         * $newWord guarda a substring a ser inserida no retorno
         * É percorrido a string inicial do índice inicial até o índice final
         */
        $newWord = "";
        for ($j = 0; $upIndex + $j < $downIndex; $j++) {
          if ($upIndex + $j < strlen($text)) {
            $newWord[$j] = $text[$upIndex + $j]; 
          }
        }

        $words[$currentPosition] = $newWord;
        $currentPosition++;

        /**
         * É atualizado o índice inicial para o índice final
         * Caso o caracter atual seja um espaço é percorrido a string até que
         * o próximo caracter seja diferente de um espaço para que a próxima substring
         * não comece com um espaço, o índice inicial recebe o índice final somado com
         * a quantidade de espaços encontrada, caso contrário o índice inicial recebe 
         * o índice final
         */
        if ($downIndex < strlen($text)) {
          $sum = 0;
          $aux = $downIndex;
          while ($text[$aux] == ' ') {
            $aux++;
            $sum++;
          }
          if ($sum != 0) {
            $upIndex = $downIndex + $sum;
          }
          else {
            $upIndex = $downIndex;
          }
        }
        else {
          $upIndex = strlen($text);
        }
      }
      return $words;
    }  

    return [""];
  }

}
