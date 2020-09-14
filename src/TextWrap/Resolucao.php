<?php

namespace Galoa\ExerciciosPhp\TextWrap;

/**
 * Interface para implementar a função textWrap().
 */
interface ResolucaoInterface {

  /**
   * Função textWrap() que necessita um string e um int como parâmetros.
   *
   * Retornando um array.
   */
  public function textWrap(string $text, int $length): array;

}

/**
 * Classe que inicia as variáveis utilizadas no código como.
 *
 * $text, $length e $originalLength.
 */
class Values {

  /**
   * Variável.
   *
   * @var text
   *  O texto que será utilizado como entrada.
   */
  private $text = "Espero passar passwordverify";

  /**
   * Variável.
   *
   * @var originalLength
   *  O valor original de quantos caracteres a linha deverá ser quebrada.
   */
  private $originalLength = 8;

  /**
   * Variável.
   *
   * @var length
   *  O valor atualizado de quantos caracteres faltam para a linha ser quebrada.
   */
  private $length = 8;

  /**
   * Chama o valor da variável $text.
   */
  public function getText() {
    return $this->text;
  }

  /**
   * Altera o valor da variável $text.
   */
  public function setText(string $text) {
    $this->text = $text;
  }

  /**
   * Chama o valor da variável $originalLength.
   */
  public function getOriginalLength() {
    return $this->originalLength;
  }

  /**
   * Altera o valor da variável $originalLength.
   */
  public function setOriginalLength(int $originalLength) {
    $this->originalLength = $originalLength;
  }

  /**
   * Chama o valor da variável $length.
   */
  public function getLength() {
    return $this->length;
  }

  /**
   * Altera o valor da variável $length.
   */
  public function setLength(int $length) {
    $this->length = $length;
  }

}

/**
 * Classe Resolucao que implementa a interface Resolucao.
 *
 * Sendo assim, possível implementar a função abstrata textWrap().
 */
class Resolucao implements ResolucaoInterface {

  /**
   * A partir de um número definido de caracteres por linha.
   *
   * Separa o texto em palavras divididas por espaços com as seguintes regras:
   * - Retorne o todo o texto, com o máximo de palavras por linha.
   *
   * Mas sem nunca extrapolar o limite de caracteres.
   * - Se uma palavra não couber na linha.
   * E o comprimento dela for menor que o limite de caracteres.
   * Ela não deve ser cortada, e sim jogada para a próxima linha.
   * - Se a palavra for maior que o limite de caracteres por linha.
   *
   * Corte a palavra e continue a imprimi-la na linha seguinte.
   */
  public function textWrap(string $text, int $length): array {
    $values = new Values();
    $values->setText($text);
    $values->setOriginalLength($length);
    $values->setLength($values->getLength());

    $array = explode(" ", $values->getText());
    $sortedArray = "";

    for ($i = 0; $i < count($array); $i++) {
      if (strlen($array[$i]) <= $values->getLength()) {
        $sortedArray = $sortedArray . $array[$i];
        $values->setLength($values->getLength() - strlen($array[$i]));
      }

      elseif (strlen($array[$i]) > $values->getLength() && strlen($array[$i]) <= $values->getOriginalLength()) {
        $sortedArray = $sortedArray . "<br/>" . $array[$i];
        $values->setLength($values->getOriginalLength() - strlen($array[$i]));
      }

      elseif (strlen($array[$i]) > $values->getOriginalLength() && strlen($array[$i]) > $values->getLength()) {
        $bigArray = str_split($array[$i]);

        for ($j = 0; $j < count($bigArray); $j++) {
          if (count($bigArray) <= $values->getLength()) {
            $sortedArray = $sortedArray . $bigArray[$j];
            $values->setLength($values->getLength() - strlen($bigArray[$j]));
          }

          else {
            $k = 1;

            if ($k <= $values->getLength() && $k <= count($bigArray)) {
              $sortedArray = $sortedArray . $bigArray[$j];
              $values->setLength($values->getLength() - strlen($bigArray[$j]));

              $k++;
            }

            else {
              $sortedArray = $sortedArray . "<br/>" . $bigArray[$j];
              $values->setLength($values->getOriginalLength() - strlen($bigArray[$j]));
            }
          }
        }
      }

    }

    return str_split($sortedArray);

  }

}

$textWrap = new Resolucao();
$values = new Values();

$textWrap->textWrap($values->getText(), $values->getLength());
