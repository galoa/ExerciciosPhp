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

        $this->verifyLengthCondition($ret, $length);


    }

    /**
     * Checa o retorno para string conhecida.
     *
     * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
     */
    public function testForRandomStringsWithRandomSizes()
    {
        $randomString = $this->generateRandomString(120);

        echo $randomString;

        $randomLengths = rand(0, 120);

        $ret = $this->resolucao->textWrap($randomString, $randomLengths);

        $this->verifyLengthCondition($ret, $randomLengths);

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

    private function verifyLengthCondition(array $ret, int $length)
    {
        foreach ($ret as $string_item) {

            $this->assertTrue(strlen($string_item) <= $length, " length condition fail ${string_item}");

        }
    }


}
