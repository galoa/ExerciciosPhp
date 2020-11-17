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

    private array $ret;

    private int $currentSubStringLength;

    private string $currentSubString;

    private int $maxLengthSubstring;


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
            $this->ret = [''];
        } else if (strlen($text) <= $length) {
            $this->ret = [$text];
        } else {
            $this->startToSplitString($text, $length);
        }




        return $this->ret;

    }//end textWrap()


    private function initialState(int $length)
    {
        $this->currentSubString = '';
        $this->currentSubStringLength = 0;
        $this->maxLengthSubstring = $length;
        $this->ret = [];

    }//end initialState()


    private function startToSplitString(string $text, int $length)
    {
        $this->initialState($length);

        $this->spliting($text);

    }//end splitString()


    private function spliting($text)
    {
        $textLength = strlen($text);

        for ($i = 0; $i < $textLength; $i++) {
            $this->decideToSplit($text[$i]);
        }


//

        $this->addSubstring();
    }

    private function decideToSplit($char)
    {
        if ($char == ' ') {
            $this->addSubstring();
        }

        if ($this->currentSubStringLength < $this->maxLengthSubstring) {
            $this->addCharToSubString($char);
        } else {

            $this->addSubstring();
        }

    }//end decideToSplit()


    private function addSubstring()
    {
        array_push($this->ret, $this->currentSubString);
        $this->resetSubstring();

    }//end addSubstring()


    private function resetSubstring()
    {
        $this->currentSubStringLength = 0;
        $this->currentSubString = '';

    }//end resetSubstring()


    private function addCharToSubString($char)
    {
        $this->currentSubString .= $char;
        $this->currentSubStringLength++;

    }//end addCharToSubString()


}//end class
