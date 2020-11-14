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

/*
* @param string $texto
*   texto que será convertido em um array de palavras
* @param string $char
*    caracter que será usado para serparar as palavras
* @return array
*    Um array com as palavras contidas em $texto separadas por $char
 */
function divisaoSimples(string $texto,string $char): array {
    $fracaoTexto = "";
    $arrayTexto = array();
    for ($indice = 0; $indice < mb_strlen($texto); $indice++) {
        if ($texto[$indice] != $char) {
            $fracaoTexto .= $texto[$indice];
        } else {
            array_push($arrayTexto, $fracaoTexto);
            $fracaoTexto = "";
        }
    }
    array_push($arrayTexto, $fracaoTexto);
    return $arrayTexto;
}

class Resolucao implements TextWrapInterface {

    public function textWrap(string $text, int $length): array {
        $ESPACO = ' ';
        $listaSaida = array("");
        $linha = 0;
        $textoDividido = divisaoSimples($text, $ESPACO);
        for ($i = 0; $i < sizeof($textoDividido); $i++) {
            $palavra = $textoDividido[$i];
            //caso base palavra menor que $length
            if (mb_strlen($palavra) <= $length) {
                if (mb_strlen($listaSaida[$linha]) == 0) {
                    $listaSaida[$linha] .= $palavra;
                } else {
                    //há texto acumulado
                    if (mb_strlen($listaSaida[$linha]) + mb_strlen($palavra) < $length)
                        $listaSaida[$linha] .= $ESPACO . $palavra;
                    else {
                        array_push($listaSaida, $palavra);
                        $linha++;
                    }
                }
            }
            else {
                //inserir parte da palavra "grande" na posicao atual
                if (mb_strlen($listaSaida[$linha]) < $length) {
                    if (mb_strlen($listaSaida[$linha]) == 0) {
                        $listaSaida[$linha] .= substr($palavra, 0, $length);
                        $palavra = substr($palavra, $length, mb_strlen($palavra));
                    } else {
                        $tamCorte = $length - mb_strlen($listaSaida[$linha]) - 1;
                        $listaSaida[$linha] .= $ESPACO . substr($palavra, 0, $tamCorte);
                        $palavra = substr($palavra, $tamCorte, mb_strlen($palavra));
                    }
                }
                //quebrar a palavra até ela ser menor que $length
                while (mb_strlen($palavra) >= $length) {
                    array_push($listaSaida, substr($palavra, 0, $length));
                    $palavra = substr($palavra, $length, mb_strlen($palavra));
                    $linha++;
                }
                if (mb_strlen($palavra) > 0) {
                    array_push($listaSaida, $palavra);
                    $linha++;
                }
            }
        }
        return $listaSaida;
    }
}

