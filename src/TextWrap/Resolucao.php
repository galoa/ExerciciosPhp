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

  	//texto auxiliar que vai servir para trasnformar o texto em array.
  	$aux_text = preg_split('/ /', $text, -1, PREG_SPLIT_NO_EMPTY);  	
  	//variável auxiliar para armazenar as palavras que serão adicionadas no laço de repetição.
  	$aux = "";
  	//array responsável por guardar toda o resultado da função, já com as divisões.
  	$array = array();
  	

  if(is_array($aux_text) || is_object($words)){
  	foreach ($aux_text as $words) {
  		$wordLength = strlen($words);
  		$auxLength = strlen($aux);
  		if($wordLength + 1 + $auxLength <= $length){
  			if(auxLength != 0){
  				$aux = $aux . " " . $words;
  			}
  			else
  				$aux = $words;
  		}
  		else{
  			if(wordLength <= $length){
  				array_push($array, $aux);
  				$aux = $words;
  			}

  			if($wordLength > $length){
  				$leftOver = str_split($words,$length);

  				foreach ($leftOver as $lefts) {
  					$leftsLength = strlen($lefts);
  					if($leftsLength == $length)
  						array_push($array, $lefts);
  					else
  						$aux = $aux . $lefts;	
  				}
  			}
  		}
  	}
  }
  	if(strlen($aux)!=0)
  		array_push($array, $aux);
  	




  	
    return $array;
  }
}
