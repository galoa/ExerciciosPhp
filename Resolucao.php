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


      $break = '\n';
  		$br_width = strlen($break)
  		$text_width = strlen($text)
  		$return = '';
  		$last_space = false

  		for($i=0, $count=0; $i < $length; $i++, $count++){

  			if(substr($text, $i, $br_width) == $break){

  				count = 0;
  				$return .= substr($text, $i, $br_width);
  				$i += $br_width - 1;
  				continue;
  			}

  			if(substr($text, $i, 1) == " "){

  				$last_space = $i;
  			}

  			if($count >= $lenght){

  				if(!last_space){

  					$return .= $break;
  					$count = 0;
  			} else{

  				$drop = $i - $last_space;

  				if($drop > 0){

  					$return = substr($return, 0, -$drop);
  				}

  				$return .= $break;

  				$i = $last_space + ($br_width - 1);
  				$last_space = false;
  				$count = 0;
  			}
  		}

  		$return .= substr($text, $i, 1);

  	}

  	return $return;
  }

}
