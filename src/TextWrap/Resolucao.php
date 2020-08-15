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
     * A lógica dessa função é sempre armazenar a primeira posição das
     * novas palavras e os espaços à medida que o laço percorre o texTo.
     * À partir deles, temos as posições de corte das palavras,
     * e o nova posição da contagem, logo após a variável $espaço.
     * Para saber aonde será o corte,
     * um contador decresce até a posição específica.
     * A nova palavra armazenada começa do $prim e vai até o $espaço.
     * Caso não haja espaço, verifica se a palavra precisa de corte
     * ou se é uma palavra inteira.
     *
     * ----------------------------------------------------------------
     *   Exemplo: length = 6
     *      $espaco
     *      ↓
     *    Se eu vi mais longe...
     *    ↑     ↑
     *   $prim   Fim do contador(cont = 0)
     *-----------------------------------------------------------------
     *         $espaco
     *            ↓
     *    Se eu vi mais longe...
     *          ↑     ↑
     *        $prim  Fim do contador
     *-----------------------------------------------------------------
     *             $espaco
     *                 ↓
     *    Se eu vi mais longe...
     *             ↑     ↑
     *           $prim  Fim do contador
     *-----------------------------------------------------------------
     */
    // Cria o valor "primeira posicao" e os contadores.
    $prim = $i = $j = 0;
    // Variavel que pega a posiçao do espaço, setada para nulo.
    $espaco = NULL;
    $vetor = [];
    $tmp = $novo = '';
    $cont = $length;
    $nText = strlen($text);
    if (strlen($text) == 0) {
      $vetor[] = "";
    }
    // Cria um laço para percorrer todo o texto.
    while ($i < $nText) {
      $prim = $i;
      /*
       * Cria um laço com contador para saber ate onde vai o "$length",
       * para armazenar a posição dos espaços e para colocar os caracteres
       * dentro da nova string temporaria.
       */
      while ($cont > 0 && $i < $nText) {
        if ($text[$i] == ' ') {
          $espaco = $i;
        }
        $tmp .= $text[$i];
        $cont--;
        $i++;
      }
      /*
       * Se a posição no final do contador for um espaço,
       * a palavra inteira vai para o tmp
       * e o primeiro laço segue após esse espaço.
       */
      if ($i != $nText && $text[$i] == ' ') {
        $i++;
        $espaco = NULL;
      }
      /*
       * Caso o contador tenha terminado dentro de alguma palavra,
       * verifica se existe alguma espaço antes da palavra cortada.
       * Caso haja, cria um novo vetor para armazenar a nova sentença até
       * o espaço.
       */
      else {
        // Se $espaco não for nulo, então tem pelo menos 2 palavras.
        if ($espaco != NULL) {
          // Laço da primeira letra até o espaço.
          for ($j = $prim; $j < $espaco; $j++) {
            $novo .= $text[$j];
          }
          $tmp = $novo;
          $novo = '';
          // A nova posição é depois do ultimo espaço.
          $i = $espaco + 1;
          $espaco = NULL;
        }
      }
      /*
       * Caso não haja um espaço e o contador termine no meio da palavra,
       * significa que a palavra
       * precisa ser cortada, então a lógica permanece a mesma.
       */
      // Manda a sentença para o vetor de retorno.
      $vetor[] = $tmp;
      $tmp = '';
      $cont = $length;
    }

    return $vetor;
  }

}
