<?php

namespace Galoa\ExerciciosPhp\TextWrap;

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
   * A lógica dessa função é sempre armazenar a primeira posição das novas palavras e os espaços
   * à medida que o laço percorre o texto. À partir deles, temos as posições de corte das palavras,
   * e o nova posição da contagem, logo após a variável $espaço.
   * Para saber aonde será o corte, um contador decresce até a posição específica. 
   * A nova palavra armazenada começa do $prim e vai até o $espaço. 
   * Caso não haja espaço, verifica se a palavra precisa de corte ou se é uma palavra inteira.
   *
   * --------------------------------------------------------------------------------------------	
   *   Exemplo: length = 6	  
   *      $espaco
   *      ↓
   *    Se eu vi mais longe... 
   *     ↑     ↑
   *   $prim   Fim do contador(cont = 0)
   *--------------------------------------------------------------------------------------------  	
   *         $espaco
   *            ↓
   *    Se eu vi mais longe... 
   *    ↑     ↑
   *   $prim  Fim do contador
   *--------------------------------------------------------------------------------------------
   *             $espaco
   *                 ↓
   *    Se eu vi mais longe... 
   *             ↑     ↑
   *           $prim  Fim do contador	
   * --------------------------------------------------------------------------------------------
   */
    //Cria o valor "primeira posicao" e os contadores
    $prim = $i = $j = 0;
	//Variavel que pega a posiçao do espaço, setada para nulo.
    $espaco = null;
    $vetor = [];
    $tmp = $novo = '';
    $cont = $length;
    $nText = strlen($text);
    //Cria um laço para percorrer todo o texto
	while ($i < $nText) {
      $prim = $i;
      /*
       * Cria um laço com contador para saber ate onde vai o "$length",
       * para armazenar a posição dos espaços e para colocar os caracteres
       * dentro da nova string temporaria.
       */
      while ($cont > 0 && $i < $nText) {
        if ($text[$i] == ' ')
          $espaco = $i;
        $tmp .= $text[$i];
        $cont--;
		$i++;
      }
      /*
       * Se a posição no final do contador for um espaço, a palavra inteira vai para o tmp
       * e o primeiro laço segue após esse espaço.
       */
      if ($i != $nText && $text[$i] == ' ') {
        $i++;
        $espaco = null;
      }
      /*
       * Caso o contador tenha terminado dentro de alguma palavra, verifica se existe alguma espaço
       * antes da palavra cortada. Caso haja, cria um novo vetor para armazenar a nova sentença até
       * o espaço. 
       */
      else {
		//se $espaco não for nulo, então tem pelo menos 2 palavras.
        if ($espaco != null) {
          //laço da primeira letra até o espaço.
          for ($j = $prim; $j < $espaco; $j++)
            $novo .= $text[$j];
          $tmp = $novo;
          $novo = '';
		  //a nova posição é depois do ultimo espaço.
          $i = $espaco + 1;
          $espaco = null;
        }
      }
      /*
       * Caso não haja um espaço e o contador termine no meio da palavra, significa que a palavra
       * precisa ser cortada, então a lógica permanece a mesma.
       */
      //manda a sentença para o vetor de retorno.
      $vetor[] = $tmp;
      $tmp = '';
      $cont = $length;
    }
    return $vetor;
  }
}