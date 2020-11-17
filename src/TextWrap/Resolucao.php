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
class Resolucao implements TextWrapInterface
{


    /**
     * {@inheritdoc}
     *
     * Apague o conteúdo do método abaixo e escreva sua própria implementação,
     * nós colocamos esse mock para poder rodar a análise de cobertura dos
     * testes unitários.
     */
    public function textWrap(string $text, int $length): array
    {
        if (strlen($text) == 0) {
            return [''];
        }

        if (strlen($text) <= $length) {
            return [$text];
        }

        return $this->splitString($text, $length);

    }//end textWrap()


    private function splitString(string $text, int $length): array
    {
        $stringItem = '';
        $stringLength = 0;
        $ret = [];

        $textLength = strlen($text);

        for ($i = 0; $i < $textLength; $i++) {
            if ($stringLength < $length) {
                $stringItem .= $text[$i];
                $stringLength++;
            } else {
                array_push($ret, $stringItem);
                $stringLength = 0;
                $stringItem = '';
            }
        }



        return $ret;

    }//end splitString()


}//end class
