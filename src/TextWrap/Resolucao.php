<?php
namespace Galoa\ExerciciosPhp\TextWrap;
 /**
 * Implemente sua resolução aqui.
 */
class Resolucao implements TextWrapInterface {
	public function textWrap(string $text, int $length):array{

  $words=explode(" ", $text); 
    $limite=$length; 
    $arrayreturn=array(); 
	$string=$words;


foreach($words as $word){
	$limite-=strlen($word);
	
	if($limite>=0){
		echo $word." ";
		$limite--;
	}else {
		if(strlen($word)>$length){
			echo substr($word,0,$length-1)."-";
			echo "<br>";
			$limite=$length;
			echo substr($word, $length-1, -1);
			$limite-=strlen(substr($word, $length-1, -1));
	}else{
			echo"<br>$word";
			$limite=$length;}
		
	}
}
	}
}
