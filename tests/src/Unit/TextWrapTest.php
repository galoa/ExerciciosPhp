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
        $ret = $this->resolucao->textWrap("", 2021);
        $this->assertEmpty($ret[0]);
        $this->assertCount(1, $ret);
    }


    public function testForKnowString()
    {

        $length = 8;


        $ret = $this->resolucao->textWrap($this->baseString, $length);


        foreach ($ret as $string_item) {
            $this->assertTrue(strlen($string_item) <= $length);

        }

    }

    private function generateRandomString(int $length): string
    {
        $possibleStrings = 'abcdefghijlmnopkstuvxz 123456789';

        $sizeOfPossibleStrings = strlen($possibleStrings);

        $randomString = '';

        for ($i = 0; i < $length; $i++) {
            $randomString .= $possibleStrings[rand(0, $sizeOfPossibleStrings)];
        }

        return $randomString;
    }


}
