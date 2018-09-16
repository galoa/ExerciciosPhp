<?php
namespace Galoa\ExerciciosPhp\TextWrap;
 /**
 * Implemente sua resolução aqui.
 */
class Resolucao implements TextWrapInterface {

  public function textWrap(string $text, int $length): array {
		//variaveis locais
		$words = explode(' ',$text);//separa o texto em um array de palavras
		$vet = array();//array que será retornado 
		$string = "";//string manipuladora vazia
		$limite = $length; // limite de caracter 
		$line = 0;//linha do array
		for($i = 0; $i < strlen($words); $i++){
			$string = $words[$i].' ';
			if(( strlen($words[$i]) > $length)){
				$this->cutWord($vet,$words[$i],$limite,$length,$line);//chama a função de corte de palavra, para inserir o restante na próx linha
			}else
				if( $limite >= strlen($string)){	
					$vetor[$line] = (array_key_exists($line,$vet) )? $vet[$line].$string : $string;//add a palavra na linha do vetor
					$limite -= strlen($string);// subtração para saber quantos caracteres faltam 
				}else 
					if($limite < strlen($string)){
						$line++;//incrementa o valor de linha para a string ser adicionado no outro indice do array
						$limite = $length;//limite recebe o valor de inicio, para não gerar sobrecarga
						$vet[$line] = $string;// add a palavra na linha do vetor
						$limite -= strlen($string);//subtração para saber quantos caracteres faltam
					}
		}
    return $vet;
  }
  
  private function cutWord(&$array,$words,&$limite,$length,$index){
	
	  for($i = 0; $i < strlen($words); $i++){
		if( ($limite != $length) && ($i == 0) ){//verifica se o indice está sem palavras
			$index++; //soma+1 no vetor
			$limite = $length;//limite recebe o valor de inicio	
		}		
		if($limite <= 0) {//verifica se limite >0		 
			$index++;//soma +1 à linha
			$limite = $length;//limite recebe o valor de inicio	
		}
		$array[$index] = ( array_key_exists($indice,$array) )? $array[$indice].$palavra[$i] : $palavra[$i];
		$limite--;
	  }
	  $array[$index] = $array[$index].' ';
  }
} 
