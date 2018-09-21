<?php

namespace Galoa\ExerciciosPhp\TextWrap;

/**
 * Implemente sua resolução aqui.
 */
include('TextWrapInterface.php');
class Resolucao implements TextWrapInterface {

  /**
   * {@inheritdoc}
   */

  	public function textWrap(string $text, int $length): array {

	  	$maximo = strlen($text);
	  	// Contador de caracteres na linha, varia de 1 até tamanho 
		$contador = 1;


	  	// Linha e coluna do array de retono
		$linha = 0;
		$coluna = 0;
		// retorno caso seja passado uma String vazia
	 	$ret[0] = '';

	  	// Se a string não for uma string vazia...
	  	if ($text != "") {

	    // Verificação de todos os caracteres da string
		    for ($key = 0; $key < $maximo; $key++) {
		      	// Se o caractere em questão for igual a ' '
		     	if ($text[$key] == ' ') {
		       	 	// Guardar o espaço na variavel
		       		$ultimo_espaco = $key;
		     	}
		      
		     	// Se o número de caracteres contados for igual ao tamanho
		     	if ($contador == $length){
		    		// Se o caractere seguinte ao caractere em questão for igual a " "
		        	if ($text[$contador] == ' ') {
			         	// Avançar o cursor
			         	$key++;
			         	// Atribuo o caractere | no local
			         	$text[$contador] = '|';
		        	}else {       // Senao
			         	// Atribuo | ao ultimo espaco
			          	$text[$ultimo_espaco] = '|';
			          	// O cursor é movido para o prox caractere apos o local do |
			          	if($key - $ultimo_espaco < $length) $key = $ultimo_espaco + 1;
		        	}	
		        	// Zerar o contador de caractere
		        	$contador = 0;
		      	}
		      	// Implementação do contador
		      	$contador++;
		    }
		    
		    // Percorrer a string para passar ao array de retorno
		    for ($key = 0; $key < $maximo ; $key++) { 
		      	// quando o caractere for |, deverá quebrar a linha
		      	if ($text[$key] == '|') {
			        $linha++;
			        $coluna = 0;
			        $key++;
			    } elseif ($key>0 && $coluna == $length ){	// quando nao for |, mas chegar ao final da linha
			        $linha++;								//		deverá quebrar a linha no meio da palavra
			        $coluna = 0;
			    }
		      	$resposta[$linha][$coluna] = $text[$key];
		      	$coluna++;      
		    }

		    $linha = 0;

		    // Transformando o array de duas dimensões em um array de uma dimensão
		    for ($key = 0; $key < count($resposta) ; $key++) {
		        $ret[$linha] = implode("", $resposta[$linha++]);
		    }

		    return $ret;
	  	}else return $ret;
	}
}
