<?php

namespace Galoa\ExerciciosPhp\TextWrap;
//namespace Users\vitoral\Desktop\ExerciciosPhp\src\TextWrap;

include('TextWrapInterface.php');

/**
 * Implemente sua resolução aqui.
 */
class Resolucao implements TextWrapInterface {

    /**
     * {@inheritdoc}
     */
    public function textWrap(string $text, int $length): array {
        if ($text == "") {
            return [""];
        }

        $words = preg_split('/ /', $text);
        $line = '';
        $result = [];

        foreach ($words as $word) {
            $wordLength = strlen($word);
            $lineLength = strlen($line);

            if (($lineLength + strlen(' ') + $wordLength <= $length) ||
                ($lineLength == 0 && $wordLength <= $length)) {
                // Neste caso a palavra cabe na linha.

                if ($lineLength != 0) {
                    $line = $line . ' ' . $word;

                } else {
                    $line = $word;
                }
            } else {
                // Neste caso a palavra nao cabe na linha, teremos que testar algumas condicoes

                if ($wordLength <= $length) {
                    // Palavra cabe inteira na proxima linha
                    array_push($result, $line);
                    $line = $word;
                } else {
                    // Palavra maior que o tamanho maximo da linha

                    if ($lineLength != 0) {
                        $subStrLength = $length - ($lineLength + strlen(' '));
                    } else {
                        $subStrLength = $length;
                    }

                    if ($subStrLength > 0) {
                        if ($lineLength != 0) {
                            $line = $line . ' ' . substr($word, 0, $subStrLength);

                        } else {
                            $line = $line . substr($word, 0, $subStrLength);
                        }
                    }

                    array_push($result, $line);
                    $line = '';


                    $remainPart = substr($word, $subStrLength);
                    $splitRemainPart = str_split($remainPart, $length);

                    foreach ($splitRemainPart as $piece) {
                        if (strlen($piece) == $length) {
                            array_push($result, $piece);
                        } else {
                            $line = $line . $piece;
                        }
                    }
                }
            }
        }

        // Caso ainda haja uma linha a ser adicionada
        if (strlen($line) != 0) {
            array_push($result, $line);
        }

        return $result;
    }
}


