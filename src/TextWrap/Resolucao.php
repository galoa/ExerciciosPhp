<?php

namespace Galoa\ExerciciosPhp\TextWrap;

/**
 * Implemente sua resolução aqui.
 */
class Resolucao implements TextWrapInterface {

  /**
   * O texto que será utilizado como entrada.
   */
  private $text = "";

  /**
   * Em quantos caracteres a linha deverá ser quebrada.
   */
  private $length = 0;

  /**
   * Linhas geradas pela quebra de linhas.
   */
  private $lines = [];

  /**
   * Quebra de palavras maiores que o length.
   *
   * @param string $word
   *   A palavra que será utilizado como entrada.
   *
   * @return string
   *   Retorno da ultima sub palavra.
   */
  private function wordBreak(string $word): string {
    $splitWord = str_split($word);
    $subWord = "";
   
    foreach($splitWord as $chart) {
      $subWord = $subWord . $chart;

      if(mb_strlen($subWord, 'utf-8') == $this->length) {
        array_push($this->lines, $subWord);
        $subWord = "";
      }
    }

    return $subWord;
  }

  /**
   * {@inheritdoc}
   */
  public function textWrap(string $text, int $length): array {
    $this->text = $text;
    $this->length = $length;

    $words = explode(' ', $this->text);
    $line = "";

    foreach ($words as $index => $word) {
      if ($line != "")
        $attemptFit = $line . " ";
      $attemptFit = $attemptFit . $word;

      if (mb_strlen($attemptFit, 'utf-8') <= $this->length)
        $line = $attemptFit;
      else {  
        array_push($this->lines, $line);

        $line = $word;

        if (mb_strlen($word, 'utf-8') > $this->length)
          $line = $this->wordBreak($word);
      }
    };

    array_push($this->lines, $line);

    return $this->lines;
  }
}