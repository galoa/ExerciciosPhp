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
   * Array de strings que irá ser retornado pelo textWrap.
   *
   * @var ret
   */
  private $splitedText;

  /**
   * Tamanho atual de uma string que está contida no texto de entrada.
   *
   * @var currentSubStringLength
   */
  private $currentSubStringLength;

  /**
   * Parte da string do texto inserido.
   *
   * @var currentSubString
   */
  private $currentSubString;

  /**
   * Tamanho máxima que uma string pertencente ao arrya de strings pode conter.
   *
   * @var maxLengthSubstring
   */
  private $maxLengthSubstring;

  /**
   * O tipo de encoder utilizado para o split.
   *
   * @var encoding
   */
  private $encoding = 'UTF-8';

  /**
   * O tamanho do texto considerando que um char pode ter multiplos bytes.
   *
   * @var textLength
   */
  private $textLength;

  /**
   * Aponta para o começo da substring.
   *
   * @var beginIndex
   */
  private $beginIndex;

  /**
   * Aponta para o endereço do ultimo espaço do texto.
   *
   * @var lastSpaceIndex
   */
  private $lastSpaceIndex;

  /**
   * Retorna um array de strings limitados pelo tamanho $length.
   */
  public function textWrap(string $text, int $length): array {

    $this->textLength = mb_strlen($text, $this->encoding);

    if ($this->needToSplit($text, $length)) {
      $this->startToSplitString($text, $length);
    }
    return $this->splitedText;
  }

  /**
   * Verifica a necesidade de separar a string.
   */
  private function needToSplit(string &$text, int &$length) {
    if ($this->textLength == 0) {
      $this->splitedText = [''];
      return FALSE;
    }

    if ($this->textLength <= $length) {
      $this->splitedText = [$text];
      return FALSE;
    }
    return TRUE;
  }

  /**
   * Inicializa as varáveis que seram utilizadas no split.
   */
  private function initialState(string &$text, int $length) {
    $this->beginIndex = 0;
    $this->lastSpaceIndex = 0;
    $this->maxLengthSubstring = $length;
    $this->splitedText = [];
  }

  /**
   * Comoça o split do texto...
   */
  private function startToSplitString(string &$text, int $length) {
    $this->initialState($text, $length);

    $this->spliting($text);

  }

  /**
   * Processo da separação do texto em um array de strings.
   */
  private function spliting(string &$text) {
    for ($i = 0; $i < $this->textLength; $i++) {
      $this->updateLastSpaceIndex($i, $text);
      $i = $this->split($i, $text);
    }

    if ($this->currentSubStringLength < $this->maxLengthSubstring) {
      array_push($this->splitedText, $this->currentSubString);
    }
  }

  /**
   * Recupera um char de multiplos bytes.
   */
  private function getChar(string &$text, int $index) {
    if ($index < $this->textLength) {
      return mb_substr($text, $index, 1, $this->encoding);
    }

    return NULL;

  }

  /**
   * Atualia a string que será inserida no vetor de strings $splitedText.
   */
  private function updateCurrentSubstring(string &$text, int $index) {
    $this->currentSubStringLength = ($index - $this->beginIndex + 1);
    $this->currentSubString = mb_substr($text, $this->beginIndex, $this->currentSubStringLength);

  }

  /**
   * Atualiza o ponteiro que aponto para o ultimo espaço do texto.
   */
  private function updateLastSpaceIndex(int $index, string &$text) {
    $currentChar = $this->getChar($text, $index);
    if ($currentChar != NULL and $currentChar == ' ') {
      $this->lastSpaceIndex = $index;
    }

  }

  /**
   * Separa a texto nas strings e retorna o próximo endereço.
   */
  private function split(int $currentIndex, string &$text): int {
    $this->updateCurrentSubstring($text, $currentIndex);

    if ($this->currentSubStringLength < $this->maxLengthSubstring) {
      return $currentIndex;
    }

    $this->updateLastSpaceIndexWithNextChar($currentIndex, $text);

    if ($this->beginIndex <= $this->lastSpaceIndex) {
      $this->updateCurrentSubstring($text, ($this->lastSpaceIndex - 1));

      $indexAfterSpace = ($this->lastSpaceIndex + 1);
      if ($indexAfterSpace < $this->textLength) {
        $currentIndex = $indexAfterSpace;
      }
    }

    array_push($this->splitedText, $this->currentSubString);

    $this->beginIndex = $currentIndex;

    return $currentIndex;

  }

  /**
   * Dado um index atual do texto, retorna o próximo endereço.
   */
  private function updateLastSpaceIndexWithNextChar(int $currentIndex, string &$text) {
    $nexIndex = ($currentIndex + 1);
    $this->updateLastSpaceIndex($nexIndex, $text);

  }

}
