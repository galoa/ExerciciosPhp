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

  interface TextWrapInterface {
    public function textWrap(string $text, int $length): array;
  }

  class Values {
    private $text = "";
    private $originalLength = 0;
    private $length = 0;

    public function getText() {
      return $this->text;
    }

    public function setText(string $text) {
      $this->text = $text;
    }

    public function getOriginalLength() {
      return $this->originalLength;
    }

    public function setOriginalLength(int $originalLength) {
      $this->originalLength = $originalLength;
    }

    public function getLength() {
      return $this->length;
    }

    public function setLength(int $length) {
      $this->length = $length;
    }
  }

  class Resolucao implements TextWrapInterface {
    public function textWrap(string $text, int $length): array {
      $values = new Values();

      $values->setText($_GET["text"]);
      $values->setOriginalLength($_GET["length"]);
      $values->setLength($values->getOriginalLength());

      $array = explode(" ", $values->getText());
      $sortedArray = "";

      for ($i = 0; $i < sizeof($array); $i++) { 
        if (strlen($array[$i]) <= $values->getLength()) {
          $sortedArray = $sortedArray.$array[$i];
          $values->setLength($values->getLength() - strlen($array[$i]));

        } elseif (strlen($array[$i]) > $values->getLength() && 
           strlen($array[$i]) <= $values->getOriginalLength()) {
              $sortedArray = $sortedArray."<br/>".$array[$i];
              $values->setLength($values->getOriginalLength() - strlen($array[$i]));

        } elseif (strlen($array[$i]) > $values->getOriginalLength() &&
           strlen($array[$i]) > $values->getLength()) {
              $bigArray = str_split($array[$i]);

              for ($j = 0; $j < sizeof($bigArray); $j++) { 
                 if (sizeof($bigArray) <= $values->getLength()) {
                    $sortedArray = $sortedArray.$bigArray[$j];
                    $values->setLength($values->getLength() - strlen($bigArray[$j]));

                 } else {
                    $k = 1;

                    if ($k <= $values->getLength() && $k <= sizeof($bigArray)) {
                      $sortedArray = $sortedArray.$bigArray[$j];
                      $values->setLength($values->getLength() - strlen($bigArray[$j]));

                      $k++;

                    } else {
                      $sortedArray = $sortedArray."<br/>".$bigArray[$j];
                      $values->setLength($values->getOriginalLength() - strlen($bigArray[$j]));
                    }
                 }
              }
           }

        $sortedArray = $sortedArray." ";
        $values->setLength($values->getLength() - 1);
      }

      return str_split($sortedArray);
    }
  }
  
  $values = new Values();
  $textWrap = new Resolucao();

  echo "<br/>Texto insirido com a formatação desejada:<br/><br/>";
  printf(implode($textWrap->textWrap($values->getText(), $values->getLength())));
?>