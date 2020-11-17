<?php

namespace Galoa\ExerciciosPhp\Tests\TextWrap;

use Galoa\ExerciciosPhp\TextWrap\Resolucao;
use PHPUnit\Framework\TestCase;

/**
 * Tests for Galoa\ExerciciosPhp\TextWrap\Resolucao.
 *
 * @codeCoverageIgnore
 */
class TextWrapTest extends TestCase
{

    /**
     * Test Setup.
     */
    public function setUp()
    {
        $this->resolucao = new Resolucao();
        $this->baseString = "Se vi mais longe foi por estar de pé sobre ombros de gigantes";
    }

    /**
     * Checa o retorno para strings vazias.
     *
     * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
     */
    public function testForEmptyStrings()
    {
        $ret = $this->resolucao->textWrap('', 2021);
        $this->assertEmpty($ret[0]);
        $this->assertCount(1, $ret);
    }

    /**
     * Checa o retorno para string conhecida.
     *
     * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
     */
    public function testForKnowString()
    {

        $length = 8;

        $ret = $this->resolucao->textWrap($this->baseString, $length);

        $this->verifyOutputString($ret, $length);


    }

    /**
     * Checa o retorno para string conhecida.
     *
     * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
     */
    public function testForRandomStringsWithRandomSizes()
    {
        $randomString = $this->generateRandomString(120);

        $randomLengths = rand(0, 120);

        $ret = $this->resolucao->textWrap($randomString, $randomLengths);

        $this->verifyOutputString($ret, $randomLengths);

    }

    public function testForWhenSubStringLengthIsBiggerThanTextLength()
    {


        $ret = $this->resolucao->textWrap($this->baseString, 2021);
        $this->assertCount(1, $ret, "must have only element");
        $this->assertNotEmpty($ret[0]);
    }


    private function generateRandomString(int $length): string
    {
        $possibleStrings = 'abcdefghijlmnopkstuvxz 123456789';

        $sizeOfPossibleStrings = strlen($possibleStrings);

        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $possibleStrings[rand(0, $sizeOfPossibleStrings - 1)];
        }

        return $randomString;
    }

    private function verifyOutputString(array $ret, int $length)
    {
        foreach ($ret as $string_item) {

            $this->assertTheNumberOfSpaces($string_item);

            $this->assertTrue(strlen($string_item) <= $length, " length condition fail ${string_item}");

        }
    }


    private function assertTheNumberOfSpaces(string $subString)
    {
        $numberOfSpaces = 0;
        $lengthOfString = strlen($subString);
        for ($i = 0; $i < $lengthOfString; $i++) {
            if ($subString[$i] == ' ') {
                $numberOfSpaces++;
            }
        }

        $this->assertTrue($numberOfSpaces < 2, "number of space in substring must be one");
    }


}
