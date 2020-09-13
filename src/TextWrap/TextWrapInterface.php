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
    * Define uma interface para o exercício de quebra de linha.
    */

   interface TextWrapInterface {

     /**
      * Quebra uma string em diversas strings com tamanho passado por parâmetro.
      *
      * Suponha que você tenha uma string com um texto bastante longo. Você quer
      * imprimir na tela todo o texto, mas garantir um limite máximo de N
      * caracteres por linha.
      *
      * Alguns pontos que você deve ter em mente:
      * - Retorne o todo o texto, com o máximo de palavras por linha, mas sem
      *   nunca extrapolar o limite de caracteres.
      * - Se uma palavra não couber na linha e o comprimento dela for menor que o
      *   limite de caracteres, ela não deve ser cortada, e sim jogada para a
      *   próxima linha.
      * - Se a palavra for maior que o limite de caracteres por linha, corte a
      *   palavra e continue a imprimi-la na linha seguinte.
      * - Não utilize funções prontas, como p.ex. o wordwrap do PHP. O objetivo
      *   deste exercício é que você desenvolva o algoritmo indicado.
      *
      * @param string $text
      *   O texto que será utilizado como entrada.
      * @param int $length
      *   Em quantos caracteres a linha deverá ser quebrada.
      *
      * @return array
      *   Um array de strings equivalente ao texto recebido por parâmetro porém
      *   respeitando o comprimento de linha e as regras especificadas acima.
      */

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

   class TextWrap implements TextWrapInterface {
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
   $textWrap = new TextWrap();

   echo "<br/>Texto insirido com a formatação desejada:<br/><br/>";
   printf(implode($textWrap->textWrap($values->getText(), $values->getLength())));
?>