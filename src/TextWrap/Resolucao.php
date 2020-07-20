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
 
 	$wrap = array();//Array onde vai ficar armazenado as palavras ja formatadas
  		$aux = "";//Variável auxiliar para alocar as palavras que ja foram utilizadas
  		$sizeAux = strlen($aux);//Tamnho total de caracteres da variável auxiliar
  		$literalArray = explode( ' ',$text);//Texto transformado em array

  		if($text == "")//Se o texto for vazio retorna vazio
  			return [""];

  		foreach ($literalArray as $words) {//Para cada valor do array vai ser criada uma variavel chamada words
  			$sizeWords = strlen($words);//Tamanho de cada palavra


  			if($sizeWords + $sizeAux + 1 <= $length){//Se o tamanho da palavra mais o tamanho das palavras no auxiliar e o espaço for menor que o parametro passado
  				if($sizeAux == 0)//Se o tamanho do auxiliar for zero, vai receber a palavra
  					$aux = $words;
  				else
  					$aux += ' '.$words;//E se estiver com conteúdo vai adicionar as palavras atuais mais a nova
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
  							$aux += $wrapChar;
  					}
  				}
  			}


  		}
   	 if(strlen($aux)!=0)
  		array_push($wrap, $aux);
  	

  		return $wrap;  	
  }
}
