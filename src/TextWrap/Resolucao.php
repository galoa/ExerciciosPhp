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
 
    
  	if($text == null)
  		print("");
  	if(length($length) <= strlen($text)){
  		return $text;
  	} else if (length($length) < strlen($text)) {
  		$literalArray = array (
  			str_split($text, $length);
  		);	

  		return $literalArray;	
  	}
  
 
  	


  	
    
  }
}
