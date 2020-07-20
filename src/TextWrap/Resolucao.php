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
  		
  		$literalArray = explode( ' ',$text);

  		if($text == "")//Se o texto for vazio retorna vazio
  			return [""];

  		foreach ($literalArray as $words) {
  			$sizeWords = strlen($words);
        $sizeAux = strlen($aux);


  			if($sizeWords + $sizeAux + 1 <= $length){//Se o tamanho da palavra mais o tamanho das palavras no auxiliar e o espaço for menor que o parametro passado
  				if($sizeAux == 0)//Se o tamanho do auxiliar for zero, vai receber a palavra
  					$aux = $words;
  				else
  					$aux = $aux.' '.$words;//E se estiver com conteúdo vai adicionar as palavras atuais mais a nova
  			}

  			else{//Se o tamanho passado acima for maior que o Parametro


  				if($sizeWords <= $length){//Se o tamanho da palavra for menor que o parametro, vai inserir o texto no array 
  					array_push($wrap,$aux);
  					$aux = $words;
  				}


  				else{//Caso o contrário vai cortar a palavra e adicionar na proxima linha
  					
            $wrapText = str_split($text,$length);
  					foreach ($wrapText as $wrapChar) {
              
  						$sizeWrapChar = strlen($wrapChar);


  						if($sizeWrapChar == $length)
  							array_push($wrap, $wrapChar);


  						else
                if($sizeAux == 0)
  					        $aux = $wrapChar;
  				      else 					        
  							    $aux = $aux.' '.$wrapChar;
  					}
  				}
  			}


  		}
   	 if(strlen($aux)!=0)
  		array_push($wrap, $aux);
  	

  		return $wrap;  	
  }
}
