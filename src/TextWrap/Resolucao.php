<?php

namespace Galoa\ExerciciosPhp\TextWrap;

    /**
     * @author Gilmar A S Trindade
     */
class Resolucao implements TextWrapInterface 
{
    /**
     * @param string $text
     *   O texto que será utilizado como entrada.
     * @param int $length
     *   Em quantos caracteres a linha deverá ser quebrada.
     *
     * @return array
     *   Um array de strings equivalente ao texto recebido por parâmetro porém
     *   respeitando o comprimento de linha e as regras especificadas acima.
     */
    public function textWrap(string $text, int $length): array
    {
         //Variaveis gerais
        $return = array(); // Array que retorna uma linha por posição
        $line = 0; //Essa variavel representa a linha do Array
        $return[$line] = ""; //Inicializando o array para não dar erro


        if ($length > 0) {

            $espacoLivre = $length;

            //Utilizando explode para separar as palavras no array $text
            $text = explode(" ", $text);


            //Verificando palavra por palavra
            foreach ($text as $palavra) {

                $tamanhoDaPalavra = mb_strlen($palavra); // contando tamanho da palavra


                $palavra .= " "; // adicionando novamente os espacos



                // Se o comprimento da palavra for menor ou igual ao comprimento limite da linha
                if ($tamanhoDaPalavra < $length) {

                    if ($tamanhoDaPalavra < $espacoLivre + 1) {
                        $return[$line] .= $palavra;
                        $espacoLivre -= ($tamanhoDaPalavra + 1);

                        // Se a palavra for maior que o tamanho disponivel, adiciona-lá na proxima linha
                    } else if ($tamanhoDaPalavra > $espacoLivre) {
                        $line++;// pulando linha
                        $return[$line] = "";
                        $return[$line] = $palavra;
                        $espacoLivre = $length;
                        $espacoLivre = $espacoLivre - ($tamanhoDaPalavra + 1);

                    }

                }


                // Se o comprimento palavra for exatamente igual ao comprimento disponivel na linha, adiciona-la
            else if ($tamanhoDaPalavra == $espacoLivre) {
                $return[$line] .= $palavra;
                $espacoLivre -= $tamanhoDaPalavra;


                //Se a palavra for maior que o limite de caracteres por linha, corta a
                //palavra e continua a imprimi-la na linha seguinte.
            } else{
                    $line++;
                    $return[$line] = "";
                    $espacoLivre = $length;// Atualizando o espaço disponivel na linha

                    $characters = str_split($palavra);// criando um array com 1 caracter por posição


                    // recebe o número de linhas necessarias
                    $requiredLines = (strlen($palavra) - 1) / $length;

                    $updatesTheCharacterArray = $espacoLivre;

                    // zerando as duas variaveis, pois pode haver varias palavras maiores que o
                    // tamanho maximo
                    $lastArrayPosition = 0;
                    $characterCounter = 0;

                    for ($j = 0; $j < $requiredLines; $j++) {
                        $newArrayPosition = $lastArrayPosition;

                        // listando os caracteres
                        for (; $newArrayPosition < count($characters); $newArrayPosition++) {

                            // se a posição atual for menor que tamanho limite da linha, gravar caracteres
                            // na linha atual, caso contrario gravar na proxima linha
                            if ($newArrayPosition < $updatesTheCharacterArray) {
                                $return[$line] .= $characters[$newArrayPosition];
                                $characterCounter++;
                            } else {
                                $updatesTheCharacterArray += $length;
                                $lastArrayPosition = $newArrayPosition;
                                // se preencher totalmente a linha, quebrar linha atraves do contador $line
                                if ($characterCounter == $length) {
                                    $line++;
                                    $return[$line] = "";
                                    $characterCounter = 0;
                                }
                                break; // se já preencher a linha, parar execução e continuar na proxima iteração
                            }

                        }// fim do for de caracteres
                        $newArrayPosition += $length; // recebe a nova posição

                    } // fim do for de linhas

                    // se não preencheu totalmente o ultima iteração, adicionar quantidade de
                    // caracteres preenchido mais 1 espaço
                    if ($characterCounter != $length) {
                        $espacoLivre = $espacoLivre - ($characterCounter + 1);
                    }

                    if ($espacoLivre == 0){
                        $line++;
                        $return[$line] = "";
                        $espacoLivre=$length;
                    }
                }
            }// fim do for de palavras


            // O ArrayList de retorno recebe cada linha sem os espacos no inicio e no fim
            for ($i = 0; $i < count($return); $i++) {
                $return[$i] = trim($return[$i]);
            }
        } else {
            $return[$line] .= "Por favor, forneça um comprimento válido!";
        }


        return $return;// retorna o Array

    }
}