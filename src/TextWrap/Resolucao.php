<?php
 namespace Galoa\ExerciciosPhp\TextWrap;

 /**
  * Implemente sua resolução aqui.
  */
 class Resolucao implements TextWrapInterface {

   /**
    * {@inheritdoc}
    */
   public function textWrap(string $text,int $length):array {
 		//variaveis locais
 		$palavras=explode(" ",$text);//separa o texto em um array de palavras
 		$vetor=array();//array que será retornado 
 		$string="";
 		$limite=$length; // limite de caracter 
 		$linha=0;//linha do array
 		for($i = 0; $i < count($palavras); $i++){
 			$string = $palavras[$i]." ";
   // $this->tiraesp($vetor,$linha);
 			if((strlen($palavras[$i])>$length)){
 				//corta a palavra e o resto vai para proximo indice do array
 				$this->cutWord($vetor,$palavras[$i],$limite,$length,$linha);
     strlen($palavras[$i])-1;
     
 			}else
 				if($limite>=strlen($string)){	
 					//adiciona a palavra na linha do array
 					$vetor[$linha]=(array_key_exists($linha,$vetor))?$vetor[$linha].$string:$string;
 				    //subtrai o limite com a quantidade de caracteres da string
 					$limite-=strlen($string);
 				}else 
 					if($limite<strlen($string)){
       strlen($string)-1;
 						//incrementa o valor de linha para a string ser adicionado no outro indice do array
 						$linha++;
 						//limite recebe o valor de inicio
 						$limite=$length;
 						//adiciona a palavra na linha do array
 						$vetor[$linha]=$string;
 						 //subtrai o limite com a quantidade de caracteres da string
 						$limite-=strlen($string);
 					}
 		}
   end($vetor);
$key = key($string);

$string[$key] = substr($string[$key], 0, -1);
    
    echo($vetor);
     //print_r($vetor);
    return $vetor;
   }
   
   private function cutWord(&$array,$palavra,&$limite,$length,$indice){
 	
 	  for($i = 0; $i < strlen($palavra); $i++){ 
 	  
 		//verifica se o indice está zerado de palavras
 		if(($limite!=$length)&&($i==0)){
 			$indice++; // pula de linha no array
 			$limite=$length;	//limite recebe o valor de inicio	
 		}
 		//verifica se o limite é maior que 0
 		if($limite<=0) {
 			//incrementa o valor de linha 
 			$indice++;
 			$limite=$length;	//limite recebe o valor de inicio	
 		}
 		//adiciona a letra no indice do array concatenando com os valores anteriores	
 		$array[$indice]=(array_key_exists($indice,$array))?$array[$indice].$palavra[$i]:$palavra[$i];
 		$limite--;
 	  }
 	  $array[$indice]=$array[$indice]." ";
   }
 

/* private function tiraesp($vetor, $linha){
  for($i=0; $i<$linha; $i++){
   $esp=array(" ");
   $return=str_replace($esp, "",$vetor);
   return $return;}*/
 }
