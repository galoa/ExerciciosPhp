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
  public  function textWrap(string $text, int $length): array {
    $array = explode(' ', $text);
    $characterLimit = $length;
    $newText = "";
    $rowLength = 0;
    $x = array();


    foreach ($array as $string) {
        if (strlen($string) + $rowLength <= $characterLimit) {
            $string .= " ";

            $newText .= $string;
            $rowLength += strlen($string);

            continue;
        }

        if (strlen($string) <= $characterLimit) {
            $string .= " ";

            $newText .= "\n" . $string;
            $rowLength = strlen($string);

            continue;
        }

    $rowLength = $rowLength > $characterLimit ? $characterLimit : $rowLength;

        $firstCroppedString = substr($string, 0, $characterLimit - $rowLength);
        $secondCroppedString = substr($string, $characterLimit - $rowLength);

        $newText .= $firstCroppedString;

        if (strlen($secondCroppedString) <= $characterLimit) {
            $secondCroppedString .= " ";

            $newText .= "\n" . $secondCroppedString;
            $rowLength = strlen($secondCroppedString);

            continue;
        }

    $stringCropped = substr($secondCroppedString, 0, $characterLimit);

        while (true) {
            $stringCropped = substr($secondCroppedString, 0, $characterLimit);

      if (!strlen($stringCropped)) {
        break;
      }

            $newText .= "\n" . $stringCropped;

            $secondCroppedString = substr($secondCroppedString, $characterLimit, strlen($secondCroppedString));
          
            
        }
    }
   
$x = explode("\n",$newText);
    $n = implode("  ", $x);
    $trinmed = rtrim($n,"  ");
   
    return [$trinmed];
}
}
