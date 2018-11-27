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
        $linhas = array();
        //separa as palavras em posições do vetor
        $palavras = $this->wordDivide($text);
        $linha = "";//linha atual a ser concatenada com as palavras
        for($i = (int) 0; $i < sizeof($palavras); $i++) {
        	//caso a palavra sejá maior que a linha
            if (strlen($palavras[$i]) / $length > 1) {
                //verifica se existe uma linha anterior e se existe finaliza
                if (strlen($linha) != 0) {
                    array_push($linhas, $linha);
                }
                //verifica em quantas linhas a palavra será escrita
                $numLinhas = (int)(strlen($palavras[$i]) / $length);
                for ($n = (int)0; $n < $numLinhas; $n++) {
                    $linha = substr($palavras[$i], $n * $length, $length);
                    array_push($linhas, $linha);
                }
                $linha = ""; //limpa a linha
                if (strlen($palavras[$i]) % $length != 0) {
                    $linha = substr($palavras[$i], $numLinhas * $length, $length);
                }
            } else if ((strlen($palavras[$i]) + strlen($linha)) < $length) { //verifica se pode adicionar a palavra na linha atual
                if(strlen($linha) == 0){ //caso a palavra senha a primeira da linha não é nescessario adicionar espaço
                    $linha = $palavras[$i];
                } else {
                    $linha = $linha . " " . $palavras[$i];
                }
            } else { //muda de linha 
                array_push($linhas, $linha);
                $linha = $palavras[$i];
            }
        }
        //finaliza adicionando a ultima linha
        array_push($linhas, $linha);
        return $linhas;
    }

	// separa um texto em varias palavras, equivalente a função explode() do php
   	public function wordDivide(string $text):array{
        $palavras = array();
        $num_palavra = (int) 0;
        $tam_text = (int) strlen($text);
        $palavras[$num_palavra] = (string) "";

        for ($i = (int) 0; $i < $tam_text; $i++) {
            //caso encontre um espaço ou uma quebra de linha
            if($text[$i] == ' ' || ord($text[$i]) == 10){
                if ($palavras[$num_palavra] != "") {
                    $num_palavra++;
                }
                $palavras[$num_palavra] = (string) "";
            } else {
                $palavras[$num_palavra] = $palavras[$num_palavra] . $text[$i];
            }

        }
        return $palavras;
    }

}
