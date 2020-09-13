<?php

namespace Galoa\ExerciciosPhp\TextWrap;

?>

<!DOCTYPE html>
<meta charset="utf-8">
<html>
<head>
   <title></title>
</head>
<body>
   <form name="form" method="get" action="TextWrapInterface.php">
      <input type="text" placeholder="Insira qualquer texto aqui" style="width: 350px; text-align: center;" name="text"><br>
      <input type="text" placeholder="Insira um valor para o nº de caracteres por linha" style="width: 350px; text-align: center;" name="length"><br>
      <input type="submit">
   </form>
</body>
</html>

<?php

/**
 * Interface para implementar a função textWrap
 */
interface TextWrapInterface { 

  /**
   * Função textWrap() que necessita um string e um int como parâmetros e retorna um array
   */
  public function textWrap(string $text, int $length): array; 

}

/**
 * Classe que inicia as variáveis utilizadas no código como: $text, $length e $originalLength
 */
class Values {
  private $text = "";
  private $originalLength = 0;
  private $length = 0;

  /**
   * Função getText(), para chamar o valor da variável $text
   */
  public function getText() {
    return $this->text;
  }

  /**
   * Função setText(), para alterar o valor da variável $text
   */
  public function setText(string $text) {
    $this->text = $text;
  }

  /**
   * Função getOriginalLength(), para chamar o valor da variável $originalLength
   */
  public function getOriginalLength() {
    return $this->originalLength;
  }

  /**
   * Função setOriginalLength(), para alterar o valor da variável $originalLength
   */
  public function setOriginalLength(int $originalLength) {
    $this->originalLength = $originalLength;
  }

  /**
   * Função getLength(), para chamar o valor da variável $length
   */
  public function getLength() {
    return $this->length;
  }

  /**
   * Função setLength(), para alterar o valor da variável $length
   */
  public function setLength(int $length) {
    $this->length = $length;
  }

}

/**
 * Classe Resolução que implementa a interface TextWrapInterface sendo assim possível implementar 
 * a função abstrata textWrap()
 */
class Resolucao implements TextWrapInterface {

  /**
   * Função abstrata textWrap() responsável por, a partir de um número definido de caracteres por 
   * linha, separa o texto em palavras divididas por espaços com as seguintes regras:
   * - Retorne o todo o texto, com o máximo de palavras por linha, mas sem
   *   nunca extrapolar o limite de caracteres.
   * - Se uma palavra não couber na linha e o comprimento dela for menor que o
   *   limite de caracteres, ela não deve ser cortada, e sim jogada para a
   *   próxima linha.
   * - Se a palavra for maior que o limite de caracteres por linha, corte a
   *   palavra e continue a imprimi-la na linha seguinte.
   */
  public function textWrap(string $text, int $length): array {
    $values = new Values();

    $values->setText($_GET["text"]);
    $values->setOriginalLength($_GET["length"]);
    $values->setLength($values->getOriginalLength());

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
          if (sizeof($bigArray) <= $values->getLength()) {
            $sortedArray = $sortedArray . $bigArray[$j];
            $values->setLength($values->getLength() - strlen($bigArray[$j]));
          }

          else {
            $k = 1;

            if ($k <= $values->getLength() && $k <= sizeof($bigArray)) {
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

      $sortedArray = $sortedArray . " ";
      $values->setLength($values->getLength() - 1);
    }

    return str_split($sortedArray);

  }

}

$values = new Values();
$textWrap = new Resolucao();

echo "<br/>Texto insirido com a formatação desejada:<br/><br/>";
printf(implode($textWrap->textWrap($values->getText(), $values->getLength())));
