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
 
    $wrap = array();
  		$aux = "";
  		$sizeAux = strlen($aux);
  		$literalArray = explode( ' ',$text);

  		if($text == "")
  			return [""];

  		foreach ($literalArray as $words) {
  			$sizeWords = strlen($words);
  			if($sizeWords + $sizeAux + 1 < $length){
  				if($sizeAux == 0)
  					$aux = $words;
  				else
  					$aux .= ' '.$words;
  			}else{
  				if($sizeWords <= $length){
  					array_push($wrap,$aux);
            $aux = $words;
  				}else{
  					$wrapText = str_split($text,$length);
  					foreach ($wrapText as $wrapChar) {
  						$sizeWrapChar = strlen($wrapChar);
  						if($sizeWrapChar == $length)
  							array_push($wrap, $wrapChar);
  						else
  							$aux .= $wrapChar;
  					}
  				}
  			}
  		}
    if(strlen($aux)!=0)
  		array_push($wrap, $aux);
  	

  		return $wrap;  	

  }
}
