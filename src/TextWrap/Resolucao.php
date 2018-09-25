<?php
 namespace Galoa\ExerciciosPhp\TextWrap;

 /**
  * Implemente sua resolução aqui.
  */
class Resolucao implements TextWrapInterface {

public function textWrap(string $text,int $length):array {
    //local variables
$words=explode(" ",$text); //separate the text into words
$arr=array();              //array used for return
$string=" ";
$limit=$length; //limit of characters per line
$line=0;//array line

for($i = 0; $i < count($words); $i++){
    $string = $words[$i]." ";
    if((strlen($words[$i])>$length)){
        //cut the world and print the remaining letters on the next line
        $this->cutWord($arr,$words[$i],$limit,$length,$line);  
    }else
        if($limit>=strlen($string)){    
            //add the word in array line
            $arr[$line]=(array_key_exists($line,$arr))?$arr[$line].$string:$string;
            //subtract the limit with the quantity of characters
            $limit-=strlen($string);
        }else 
            if($limit<strlen($string)){
                  $arr[$line] = rtrim($arr[$line]);
                //line++ for inserting the string on a next index
                $line++;
                $limit=$length;
                //add the word on array line
                $arr[$line]=$string;
                //subtract the limit with the quantity of characters
                $limit-=strlen($string);
            }
}
     $arr[$line] = rtrim($arr[$line]);
 //print_r($arr);
   return $arr;
 

 }

 //and then I've got a cutWord function
 private function cutWord(&$array,$word,&$limit,$length,$index){

  for($i = 0; $i < strlen($word); $i++){ 

//verify if the index doesn't have any words in
if(($limit!=$length)&&($i==0)){
    $index++; // jump an array line
    $limit=$length; //limit receives starting value
}
//verify if the limit is > 0
if($limit<=0) {
    $index++;
    $limit=$length; //limit receives starting value
}
//add the letter in the array index concatenating with the previous
$array[$index]=(array_key_exists($index,$array))?$array[$index].$word[$i]:$word[$i];
$limit--;
 }
   $array[$index]=$array[$index]." ";
}
}
