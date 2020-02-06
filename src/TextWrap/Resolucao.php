<?php

namespace Galoa\ExerciciosPhp\TextWrap;
include('TextWrapInterface.php');

/**
 * Implemente sua resolução aqui.
 */

class Resolucao implements TextWrapInterface {

  /**
   * {@inheritdoc}
   */
    public function textWrap(string $text, int $length): array {
        //recebe como parametro o texto desejado e o tamanho da linha
        //usando como base $text = "Se vi mais longe foi por estar de pé sobre ombros de gigantes"

        //imaginamos que temos um array multi e que cada linha é um vetor desse array. O text são as palavras que vão estar em cada linha do array ou não, isso é definido pelo length
        //O length define o n umero de caracteres que poderemos ter na nossa linha imaginária (vetores)
        // $result é o array que tera essas linhas e exibira as palavras de acordo com as regras estabelecidas

        //Converte uma string para um array e com a função preg_split estamos dividindo a string de acordo com um limitador, assim cada palavra ficará em uma posição no vetor
        $phrase = preg_split('/ /', $text, -1, PREG_SPLIT_NO_EMPTY); 
        
        //definindo uma var do tipo string que sera nossa linha
        $line = '';

        //definindo o array que irá armazenar e exibir o texto de acordo com as regras
        $result = array();
        
        //iremos percorrer o array que está com as palavras e cada palavra será atribuida a uma variável chamada $word
        foreach($phrase as $word){
            $wordLength = strlen($word); //$wordLength irá guardar o valor retornado pela func strlen($word) que é o tamanho da palavra ali armazenada
            $lineLength = strlen($line); //aqui é o tamanho da linha.

            //se o tamanho da palavra + 1(espaço) + o tamanho da linha que temos for menor que o tamanho desejado, a palavra pode ser escrita
            if($wordLength + 1 + $lineLength <= $length){ 
                //se a linha nao estiver vazia, então linha sera o que ja esta nela + espaço + a prox palavra
                if($lineLength != 0){
                    $line = $line . ' ' . $word;
                    
                //caso esteja vazia, só recebe a palavra
                }else  
                    $line = $word;

                
            //se a palavra nao couber na linha, temos duas condições
        }else {
                
                //a primeira é que a palavra nao cabe na linha mas seu tamanho não excede o maximo de caracteres permitido, então colocamos ela na linha de baixo
                if($wordLength <= $length){
                    array_push($result, $line);
                    $line = $word;

                }

                //e a segunda é que a palavra excede o tamanho máximo da linha, portanto ela deverá ser dividida em duas ou mais linhas
                if($wordLength > $length){
                
                    //dividimos a string usando como parametro o tamanho máximo da linha e armazenamos os caracteres excedentes no leftOver
                    $leftOver = str_split($word, $length);
                    //print_r($leftOver);

                    //leftOver[0] = vai até o limite de length e o resto fica pros outros indices, neste caso pro leftOver[1]   

                    foreach($leftOver as $lefts){
                        $leftsLength = strlen($lefts);

                        //na primeira vez que executar este bloco, lefts recebe leftOver[0] e precisamos colocar este lefts no local certo
                        if($leftsLength == $length){
                            array_push($result, $lefts);
                            
                        }else
                            $line = $line . $lefts;   
                        
                    }
                    
                }

            }
            
        }
        
        if(strlen($line)!= 0){
            array_push($result, $line);
        }
                
        return $result;

    }

    
}


    
  
?>