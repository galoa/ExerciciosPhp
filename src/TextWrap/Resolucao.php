<?php

namespace Galoa\ExerciciosPhp\TextWrap;

/**
 * Define uma classe que implementa a interface TextWrapInterface
 * e assina o método textWrap para a quebra de linhas passada por parametro
 * @author Gilmar A. S. Trindade
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
        $wordLength = 0; // Recebe o comprimento de uma palavra no laço
        $freeSpaceOnLine = 0;// Recebe o tamanho disponivel na linha atual

        // Abaixo são variaveis utilizadas no vetor de palavras grandes
        $characters[] = array();// vetor que recebe os caracteres da palavra grande
        $newArrayPosition = 0;
        $lastArrayPosition = 0;
        $characterCounter = 0;
        $updatesTheCharacterArray = 0;
        $requiredLines = 0;

        /**
         * Essa função pula uma linha, adicionando 1 ao contador e inicializando a nova posição do array
         * @param int $line
         */
        function jumpLine(int &$line)
        {
            $line++;
            $return[$line] = "";
        }


        if ($length > 0) {

            $freeSpaceOnLine = $length;

            //Utilizando explode para separar as palavras no array $text
            $text = explode(" ", $text);


            //Verificando palavra por palavra
            foreach ($text as $word) {
                $wordLength = strlen($word);

                // Se o comprimento da palavra for menor ou igual ao comprimento limite da linha
                if ($wordLength <= $length) {

                    if ($wordLength < $freeSpaceOnLine) {
                        $return[$line] .= " " . $word;
                        $freeSpaceOnLine = $freeSpaceOnLine - ($wordLength + 1);

                        // Se o comprimento palavra for exatamente igual ao comprimento disponivel na linha, adiciona-la
                    } else if ($wordLength == $freeSpaceOnLine) {
                        $return[$line] .= " " . $word;
                        $freeSpaceOnLine -= $wordLength;

                        // Se a palavra for maior que o tamanho disponivel, adiciona-lá na proxima linha
                    } else if ($wordLength > $freeSpaceOnLine) {
                        jumpLine($line);
                        $return[$line] .= $word;
                        $freeSpaceOnLine = $length;
                        $freeSpaceOnLine = $freeSpaceOnLine - ($wordLength + 1);

                    }
                    //Se a palavra for maior que o limite de caracteres por linha, corta a
                    //palavra e continua a imprimi-la na linha seguinte.
                } else if ($wordLength > $length) {
                    jumpLine($line);
                    $freeSpaceOnLine = $length;// Atualizando o espaço disponivel na linha

                    $characters = str_split($word);// criando um array com 1 caracter por posição


                    // recebe o número de linhas necessarias
                    $requiredLines = (strlen($word) - 1) / $length;

                    $updatesTheCharacterArray = $freeSpaceOnLine;

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
                                    jumpLine($line);
                                    $characterCounter = 0;

                                }
                                break; // se já preencher a linha, parar execução e continua na proxima iteração
                            }

                        }// fim do for de caracteres
                        $newArrayPosition += $length; // recebe a nova posição

                    } // fim do for de linhas

                    // se não preencheu totalmente o ultima iteração, adicionar quantidade de
                    // caracteres preenchido mais 1 espaço
                    if ($characterCounter != $length) {
                        $freeSpaceOnLine = $freeSpaceOnLine - ($characterCounter + 1);
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
