<?php

namespace Galoa\ExerciciosPhp\TextWrap;

/**
 * Implemente sua resolução nessa classe.
 *
 * Depois disso:
 * - Crie um PR no github com seu código
 * - Veja o resultado da correção automática do seu código
 * - Commit até os testes passarem
 * - Passou tudo, melhore a cobertura dos testes
 * - Ficou satisfeito, envie seu exercício para a gente! <3
 *
 * Boa sorte :D
 */
class Resolucao implements TextWrapInterface {

  /**
   * {@inheritdoc}
   *
   * Apague o conteúdo do método abaixo e escreva sua própria implementação,
   * nós colocamos esse mock para poder rodar a análise de cobertura dos
   * testes unitários.
   */
  public function textWrap($text, $length){

    $cut = "";
    //string para vazio que será preenchido

    $words = explode(" ", $text);
    //separar as palavras do string de entrada em um array de palavras
    
    //preenchendo o string de saída:
    
    $l = $length; //espaço disponível de cada linha
    
    for ($i=0; $i<count($words); $i++){
        //observar cada palavra do array
        
        if (strlen($words[$i]) <= $l){
            $cut.=$words[$i];
            $l -= strlen($words[$i]);
            }
        elseif (strlen($words[$i]) <= $length){
            $cut.="\n".$words[$i];
            $l = $length - strlen($words[$i]);
        }
        //caso extremo: palavra maior que a linha
        else {
            if($l < $length){
                $cut.="\n";
            }
            //garantindo que essa palavra estará iniciando uma linha
            $parte1="";
            for($j=0; $j<$length; $j++){
                $parte1.=$words[$i][$j];
            }
            $parte2="";
            for($k=$length; $k<strlen($words[$i]); $k++){
                $parte2.=$words[$i][$k];
            }
            $cut.=$parte1;
            $l = 0;
            //a palavra em questão pode ser mais extensa que 2 linhas, tendo que ser dividida em mais partes...
            //então para garantir que seja dividida em quantas partes necessárias, o resto da palavra volta para ser analisada novamente
            $words[$i]=$parte2;
            $i--;
        }
        //adicionar o espaçamento entre as palavras (se não for a última do string)
        if ($i < count($words)-1){
            if ($l > 0){
                $cut.=" ";
                $l--;
            } else {
                $cut.="\n";
                $l = $length;
            }

        }    
    }
    $lista = explode("\n",$cut);

    return $lista;
}

}
