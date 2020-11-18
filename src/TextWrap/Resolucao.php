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
 * Boa sorte :D.
 */
class Resolucao implements TextWrapInterface {

  /**
   * Sério isso ?
   *
   * @var ret
   */
  private array $ret;

  /**
   * Mds...
   *
   * @var currentSubStringLength
   */
  private int $currentSubStringLength;

  /**
   * Deus me dibre disso.
   *
   * @var currentSubString
   */
  private string $currentSubString;

  /**
   * Deus me dibre disso.
   *
   * @var maxLengthSubstring
   */
  private int $maxLengthSubstring;

  /**
   * Deus me dibre disso.
   *
   * @var lastSpaceIndex
   */
  private int $lastSpaceIndex;

  /**
   * Deus me dibre disso.
   *
   * @var encoding
   */
  private string $encoding = 'UTF-8';

  /**
   * Deus me dibre disso.
   *
   * @var textLength
   */
  private int $textLength;

  /**
   * Deus me dibre disso.
   *
   * @var beginIndex
   */
  private int $beginIndex;

  /**
   * Ele espera um comentário por função...
   */
  public function textWrap(string $text, int $length): array {
    if (strlen($text) == 0) {
      $this->ret = [''];
    }
    else {
      if (strlen($text) <= $length) {
        $this->ret = [$text];
      }
      else {
        $this->startToSplitString($text, $length);
      }
    }

    return $this->ret;

  }

  /**
   * Ele espera um comentário por função...
   */
  private function initialState(string &$text, int $length) {
    $this->beginIndex = 0;
    $this->lastSpaceIndex = 0;
    $this->maxLengthSubstring = $length;
    $this->ret = [];
    $this->textLength = mb_strlen($text, $this->encoding);

  }

  /**
   * Ele espera um comentário por função...
   */
  private function startToSplitString(string $text, int $length) {
    $this->initialState($text, $length);

    $this->spliting($text);

  }

  /**
   * Ele espera um comentário por função...
   */
  private function spliting(string &$text) {
    for ($i = 0; $i < $this->textLength; $i++) {
      $currentChar = $this->getChar($text, $i);
      $this->updateCurrentSubstring($text, $i);
      $this->updateLastSpaceIndex($i, $currentChar);
      $i = $this->updateIndex($i, $text);
    }

    if ($this->currentSubStringLength < $this->maxLengthSubstring) {
      array_push($this->ret, $this->currentSubString);
    }

  }

  /**
   * Ele espera um comentário por função...
   */
  private function getChar(string &$text, int $index) {
    if ($index < $this->textLength) {
      return mb_substr($text, $index, 1, $this->encoding);
    }

    return NULL;

  }

  /**
   * Ele espera um comentário por função...
   */
  private function updateCurrentSubstring(string &$text, int $index) {
    $this->currentSubStringLength = ($index - $this->beginIndex + 1);
    $this->currentSubString = mb_substr($text, $this->beginIndex, $this->currentSubStringLength);

  }

  /**
   * Ele espera um comentário por função...
   */
  private function updateLastSpaceIndex(int $index, string $char) {
    if ($char == ' ') {
      $this->lastSpaceIndex = $index;
    }

  }

  /**
   * Ele espera um comentário por função...
   */
  private function updateIndex(int $currentIndex, string &$text): int {
    if ($this->currentSubStringLength < $this->maxLengthSubstring) {
      return $currentIndex;
    }

    $nexIndex = ($currentIndex + 1);

    $nextChar = $this->getChar($text, $nexIndex);

    if ($nextChar) {
      $this->updateLastSpaceIndex($nexIndex, $nextChar);
    }

    if ($this->beginIndex <= $this->lastSpaceIndex) {
      $this->updateCurrentSubstring($text, ($this->lastSpaceIndex - 1));

      $indexAfterSpace = ($this->lastSpaceIndex + 1);
      if ($indexAfterSpace < $this->textLength) {
        $currentIndex = $indexAfterSpace;
      }
    }

    array_push($this->ret, $this->currentSubString);

    $this->beginIndex = $currentIndex;

    return $currentIndex;

  }

}
