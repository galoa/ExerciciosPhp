<?php

namespace Galoa\ExerciciosPhp\TextWrap;

include("TextWrapInterface.php");

class Resolucao implements TextWrapInterface
{

    public function textWrap(string $text, int $length): array
    {
        $linhas = [];
        $index = 0;
        $length_text =  strlen($text);
        $last_space = 0;
        $i = 0;
        $quebra_linha=0;

        if (isset($text) && $length > 0) {
            do {

                $char_now = mb_substr($text, $i, 1);

                if ($char_now == " ") 
                {
                    $last_space = $i;
                }

                if ($i == $length) {
                    $quebra_linha = $last_space;
                    $text = trim($text);
                    $linhas[$index] = mb_substr($text, 0, $quebra_linha);
                    $inicio_linha = strlen($linhas[$index]);
                    $text = substr($text, $inicio_linha, $length_text);
                    $text = trim($text);
                    $index++;

                    // var_dump(strlen($text));
                    // var_dump($linhas);

                    $last_space = 0;
                    $i = 0;
                }
                else 
                {
                    $linhas[$index] = mb_substr($text, 0, strlen($text));
                }
            

                $i++;
            } while ($i < strlen($text));
            return $linhas;
        } else {
            return array();
        }
    }
}
