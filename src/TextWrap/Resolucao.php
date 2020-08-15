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
       //Dividindo a string em string menores
        $texto = explode(' ', $text);
    
    //Armazenando a quantidade maxima de caracteres que foi passada
    $max = $length;

    $novoTexto = "";
    
    $totalLength = 0;
    
    //Adicionando os Espacos que foram removidos no explode

    foreach($texto as $string) {
      $string .= " ";
    
      if ($totalLength + strlen($string) <= $max) {
        $totalLength += strlen($string);
    
        $novoTexto .= $string;
      } else {
        $novoTexto .= "<br/>" . $string;
    
        $totalLength = strlen($string);
      }
    }
    /*basicamente ele verifica o tamanho da linha a cada iteração
     se exceder ele adiciona uma quebra de linha ao texto e reseta essa variável q guarda o tamanho da linha
     */
    echo $novoTexto;
    
    
    return [""];
  }

}
