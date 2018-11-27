<?php

namespace Galoa\ExerciciosPhp\TextWrap;

/**
 * Implemente sua resolução aqui.
 */
class Resolucao implements TextWrapInterface {

  /**
   * {@inheritdoc}
   */
  public function textWrap(string $text, int $length): array {
    return [""];
  }

	// separa um texto em varias palavras, equivalente a função explode() do php
   public function wordDivide(string $text):array{
        $palavras = array();
        $num_palavra = (int) 0;
        $tam_text = (int) strlen($text);
        $palavras[$num_palavra] = (string) "";

        for ($i = (int) 0; $i < $tam_text; $i++) {
            //caso encontre um espaço ou uma quebra de linha
            if($text[$i] == ' ' || ord($text[$i]) == 10){
                if ($palavras[$num_palavra] != "") {
                    $num_palavra++;
                }
                $palavras[$num_palavra] = (string) "";
            } else {
                $palavras[$num_palavra] = $palavras[$num_palavra] . $text[$i];
            }

        }
        return $palavras;
    }

}
