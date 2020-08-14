<?php

namespace Galoa\ExerciciosPhp\TextWrap;


class Resolucao implements TextWrapInterface {


  public function textWrap(string $text, int $length): array {
    
	/*
	A lógica dessa função é sempre armazenar a primeira posição das novas palavras e os espaços
	à medida que o laço percorre o texto. À partir deles, temos as posições de corte das palavras,
	e o nova posição da contagem, logo após a variável $espaço.
	Para saber aonde será o corte, um contador decresce até a posição específica. 
	A nova palavra armazenada começa do $prim e vai até o $espaço. 
	Caso não haja espaço, verifica se a palavra precisa de corte ou se é uma palavra inteira.
	
    --------------------------------------------------------------------------------------------	
	  Exemplo: length = 6	  
		  $espaco
		   ↓
	  Se eu vi mais longe... 
      ↑	    ↑
	$prim   Fim do contador(cont = 0)
	--------------------------------------------------------------------------------------------  	
			$espaco
		      ↓
	  Se eu vi mais longe... 
      	    ↑     ↑
	       $prim  Fim do contador
	--------------------------------------------------------------------------------------------
			    $espaco
		           ↓
	  Se eu vi mais longe... 
      	       ↑     ↑
	         $prim  Fim do contador	
	--------------------------------------------------------------------------------------------
	*/
	$prim = $i = $j = 0;     //Cria o valor "primeira posicao" e os contadores
	$espaco = null;		     //Variavel que pega a posiçao do espaço, setada para nulo.
	$vetor = [];		     //Cria o vetor vazio.
	$tmp = $novo = '';       //Cria as string temporarias.
	$cont = $length;         //Contador para o tamanho dos cortes.
	$nText = strlen($text);  //Pega o tamanho do texto.
	
	while ($i < $nText)      //Cria um laço para percorrer todo o texto
	{
		$prim = $i;          //Pega a primeira posição da nova palavra dentro da array
		/*
		Cria um laço com contador para saber ate onde vai o "$length", 
		para armazenar a posição dos espaços e para colocar os caracteres
		dentro da nova string temporaria.
		*/
		while ($cont > 0 && $i < $nText) 
		{
			if ($text[$i] == ' ')
				$espaco = $i;      //pega a posição com espaço.
			$tmp .= $text[$i];     //cria a nova string até o fim do contador.
			$cont--; $i++;         //decrementa cont e incrementa a posiçao i.
		}
		/*
		Se a posição no final do contador for um espaço, a palavra inteira vai para o tmp
		e o primeiro laço segue após esse espaço.
		*/
		if ($i != $nText && $text[$i] == ' ')  
		{
			$i++;				  //segue o primeiro laço à partir do espaço.
			$espaco = null;       //define o espaço para nulo como segurança.
		}
		/*
		Caso o contador tenha terminado dentro de alguma palavra, verifica se existe alguma espaço
		antes da palavra cortada. Caso haja, cria um novo vetor para armazenar a nova sentença até
		o espaço. 
		*/
		else					  
		{
			if ($espaco != null) //se $espaco não for nulo, então tem pelo menos 2 palavras.
			{
				for ($j = $prim; $j < $espaco; $j++) //laço da primeira letra até o espaço.
					$novo .= $text[$j];              //cria um novo tmp.
			$tmp = $novo;							 
			$novo = '';                              
			$i = $espaco + 1;                        //a nova posição é depois do ultimo espaço.
			$espaco = null; 						 //anula os espaços.
			}
		}
		/*
		Caso não haja um espaço e o contador termine no meio da palavra, significa que a palavra
		precisa ser cortada, então a lógica permanece a mesma.
		*/
		$vetor[] = $tmp;		//manda a sentença para o vetor de retorno.
		$tmp = '';				
		$cont = $length;		//defini um novo contador.
	}		
    return $vetor;				//done!
   }
}