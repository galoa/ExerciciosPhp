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

    private int $lastSpaceIndex;

    private string $encoding = 'UTF-8';

    private int $textLength;

    private int $beginIndex;


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


    private function initialState(string &$text, int $length)
    {
        $this->beginIndex         = 0;
        $this->lastSpaceIndex     = 0;
        $this->maxLengthSubstring = $length;
        $this->ret                = [];
        $this->textLength         = mb_strlen($text, $this->encoding);

    }//end initialState()


    private function startToSplitString(string $text, int $length)
    {
        $this->initialState($text, $length);

        $this->spliting($text);

    }//end startToSplitString()


    private function spliting(string &$text)
    {
        for ($i = 0; $i < $this->textLength; $i++) {
            $currentChar = $this->getChar($text, $i);
            $this->updateCurrentSubstring($text, $i);
            $this->updateLastSpaceIndex($i, $currentChar);
            $i = $this->updateIndex($i, $text);
        }

        if ($this->currentSubStringLength < $this->maxLengthSubstring) {
            array_push($this->ret, $this->currentSubString);
        }

    }//end spliting()


    private function getChar(string &$text, int $index)
    {
        if ($index < $this->textLength) {
            return mb_substr($text, $index, 1, $this->encoding);
        }

        return null;

    }//end getChar()


    private function updateCurrentSubstring(string &$text, int $index)
    {
        $this->currentSubStringLength = ($index - $this->beginIndex + 1);
        $this->currentSubString       = mb_substr($text, $this->beginIndex, $this->currentSubStringLength);

    }//end updateCurrentSubstring()


    private function updateLastSpaceIndex(int $index, string $char)
    {
        if ($char == ' ') {
            $this->lastSpaceIndex = $index;
        }

    }//end updateLastSpaceIndex()


    private function updateIndex(int $currentIndex, string &$text): int
    {
        if ($this->currentSubStringLength < $this->maxLengthSubstring) {
            return $currentIndex;
        }

        $nexIndex = ($currentIndex + 1);

        $nextChar = $this->getChar($text, $nexIndex);

        if ($nextChar) {
            $this->updateLastSpaceIndex($nexIndex, $nextChar);
        }

        if ($this->beginIndex <= $this->lastSpaceIndex) {
            $this->updateCurrentSubstring($text, ($this->lastSpaceIndex - 1));

            $indexAfterSpace = ($this->lastSpaceIndex + 1);
            if ($indexAfterSpace < $this->textLength) {
                $currentIndex = $indexAfterSpace;
            }
        }

        array_push($this->ret, $this->currentSubString);

        $this->beginIndex = $currentIndex;

        return $currentIndex;

    }//end updateIndex()


    private function getNotBrokenWord()
    {

    }//end getNotBrokenWord()


}//end class
