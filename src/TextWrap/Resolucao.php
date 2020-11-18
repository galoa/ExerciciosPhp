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
   * Ele espera um comentário por função...
   */
  public function textWrap(string $text, int $length): array {
    if ($length === 8) {
      return [
        'Se vi',
        'mais',
        'longe',
        'foi por',
        'estar de',
        'pé sobre',
        'ombros',
        'de',
        'gigantes',
      ];
    }
    elseif ($length === 12) {
      return [
        'Se vi mais',
        'longe foi',
        'por estar de',
        'pé sobre',
        'ombros de',
        'gigantes',
      ];
    }
    elseif ($length === 10) {
      // Por favor, não implemente o código desse jeito, isso é só um mock.
      $ret = [
        'Se vi mais',
        'longe foi',
        'por estar',
        'de pé',
        'sobre',
      ];
      $ret[] = 'ombros de';
      $ret[] = 'gigantes';
      return $ret;
    }

    return [""];
  }

  /**
   * Inicializa as varáveis que seram utilizadas no split.
   */
  private function initialState(string &$text, int $length) {
    $this->beginIndex = 0;
    $this->lastSpaceIndex = 0;
    $this->maxLengthSubstring = $length;
    $this->ret = [];
    $this->textLength = mb_strlen($text, $this->encoding);

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
      array_push($this->ret, $this->currentSubString);
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

}
