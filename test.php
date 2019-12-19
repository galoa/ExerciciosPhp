<?php
/**
* Define uma interface para o exercício de quebra de linha.
*/
interface TextWrapInterface {
 
/**
* Quebra uma string em diversas strings com tamanho passado por parâmetro.
*
* Suponha que você tenha uma string com um texto bastante longo. Você quer
* imprimir na tela todo o texto, mas garantir um limite máximo de N
* caracteres por linha.
*
* Alguns pontos que você deve ter em mente:
* - Retorne todo o texto, com o máximo de palavras por linha, mas sem
* nunca extrapolar o limite de caracteres.
* - Se uma palavra não couber na linha e o comprimento dela for menor que o
* limite de caracteres, ela não deve ser cortada, e sim jogada para a
* próxima linha.
* - Se a palavra for maior que o limite de caracteres por linha, corte a
* palavra e continue a imprimi-la na linha seguinte.
* - Não utilize funções prontas, como p.ex. o wordwrap do PHP. O objetivo
* deste exercício é que você desenvolva o algoritmo indicado.
*
* @param string $text
* O texto que será utilizado como entrada.
* @param int $length
* Em quantos caracteres a linha deverá ser quebrada.
*
* @return array
* Um array de strings equivalente ao texto recebido por parâmetro porém
* respeitando o comprimento de linha e as regras especificadas acima.
*/
    public function textWrap(string $text, int $length): array;
 
}
 
// class Wordwrap implements TextWrapInterface{
//     public function textWrap(string $text, int $length): array
//     {
    $text = "Se vi mais longe foi por estar de pé sobre ombros de gigantes";
    $length = "5";
    $cLength = "0";

    $words = explode(" ",$text);
    if(strlen($text) <= $length):
        $newText = $text;
    else:
        //Começa a criar o novo texto resumido.
        $newText = "";
        //Acrescenta palavra por palavra na string enquanto ela
        //não exceder o tamanho máximo do resumo
        for($i = 0; $i <count($words); $i++):
          $cLength += strlen(" ".$words[$i]);
          if($cLength <= $length):
              $newText .= ' ' . $words[$i];
          else:
              foreach($words as $key => $value){
                if(strlen($newText) >= $length):
                  $n = '';
                  $newText .= ' ' . $words[$i] . $n;
                  break;
                else:
                  $n = '\n';
                  $newText .= ' ' . $words[$i] . $n;
                  break;
                endif;
              }
          endif;
        endfor;
    endif;

    

    
    echo "bla bla ".$length." ";

    $newText = trim($newText);
    $array = str_split($newText);
    
    var_dump($newText);
    echo $newText;

    print_r($array);


//     }
// }