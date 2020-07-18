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
        $this->baseString2 = "A maior palavra da lingua portuguesa é pneumoultramicroscopicossilicovulcanoconiótico com 46 letras";

    }

    /**
     * Checa o retorno para strings vazias.
     *
     * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
     */
    public function testForEmptyStrings()
    {
        $ret = $this->resolucao->textWrap("", 2018);
        $this->assertEmpty($ret[0]);
        $this->assertCount(1, $ret);
    }

    /**
     * Checa o retorno para parametros vazio.
     *
     * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
     */
    public function testForEmptyParameters()
    {
        $ret = $this->resolucao->textWrap($this->baseString, -1);
        $this->assertEquals("Por favor, forneça um comprimento válido!", $ret[0]);
        $this->assertCount(1, $ret);
    }

    /**
     * Testa a quebra de linha para palavras curtas.
     *
     * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
     */
    public function testForSmallWords()
    {
        $ret = $this->resolucao->textWrap($this->baseString, 8);
        $this->assertEquals("Se vi", $ret[0]);
        $this->assertEquals("mais", $ret[1]);
        $this->assertEquals("longe", $ret[2]);
        $this->assertEquals("foi por", $ret[3]);
        $this->assertEquals("estar de", $ret[4]);
        $this->assertEquals("pé", $ret[5]);
        $this->assertEquals("sobre", $ret[6]);
        $this->assertEquals("ombros", $ret[7]);
        $this->assertEquals("de", $ret[8]);
        $this->assertEquals("gigantes", $ret[9]);
        $this->assertCount(10, $ret);
    }

    /**
     * Testa a quebra de linha para palavras curtas.
     *
     * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
     */
    public function testForSmallWords2()
    {
        $ret = $this->resolucao->textWrap($this->baseString, 12);
        $this->assertEquals("Se vi mais", $ret[0]);
        $this->assertEquals("longe foi", $ret[1]);
        $this->assertEquals("por estar de", $ret[2]);
        $this->assertEquals("pé sobre", $ret[3]);
        $this->assertEquals("ombros de", $ret[4]);
        $this->assertEquals("gigantes", $ret[5]);
        $this->assertCount(6, $ret);
    }

    /**
     * Testa a quebra de linha para palavras grandes.
     *
     * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
     */
    public function testForBigWords()
    {
        $ret = $this->resolucao->textWrap($this->baseString2, 8);
        $this->assertEquals("A maior", $ret[0]);
        $this->assertEquals("palavra", $ret[1]);
        $this->assertEquals("da", $ret[2]);
        $this->assertEquals("lingua", $ret[3]);
        $this->assertEquals("portugue", $ret[4]);
        $this->assertEquals("sa é", $ret[5]);
        $this->assertEquals("pneumoul", $ret[6]);
        $this->assertEquals("tramicro", $ret[7]);
        $this->assertEquals("scopicos", $ret[8]);
        $this->assertEquals("silicovu", $ret[9]);
        $this->assertEquals("lcanocon", $ret[10]);
        $this->assertEquals("iótico", $ret[11]);
        $this->assertEquals("com 46", $ret[12]);
        $this->assertEquals("letras", $ret[13]);
        $this->assertCount(14, $ret);
    }

    /**
     * Testa a quebra de linha para palavras grandes.
     *
     * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
     */
    public function testForBigWords2()
    {
        $ret = $this->resolucao->textWrap($this->baseString2, 12);
        $this->assertEquals("A maior", $ret[0]);
        $this->assertEquals("palavra da", $ret[1]);
        $this->assertEquals("lingua", $ret[2]);
        $this->assertEquals("portuguesa", $ret[3]);
        $this->assertEquals("é", $ret[4]);
        $this->assertEquals("pneumoultram", $ret[5]);
        $this->assertEquals("icroscopicos", $ret[6]);
        $this->assertEquals("silicovulcan", $ret[7]);
        $this->assertEquals("oconiótico", $ret[8]);
        $this->assertEquals("com 46", $ret[9]);
        $this->assertEquals("letras", $ret[10]);
        $this->assertCount(11, $ret);
    }

}
