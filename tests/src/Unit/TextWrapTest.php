<?php

namespace Galoa\ExerciciosPhp\Tests\TextWrap;

use Galoa\ExerciciosPhp\TextWrap\Resolucao;
use PHPUnit\Framework\TestCase;

/**
 * Tests for Galoa\ExerciciosPhp\TextWrap\Resolucao.
 *
 * @codeCoverageIgnore
 */
class TextWrapTest extends TestCase {

  /**
   * Test Setup.
   */
  public function setUp() {
    $this->resolucao = new Resolucao();
    $this->baseString = "Se vi mais longe foi por estar de pé sobre ombros de gigantes";
  }

  /**
   * Checa o retorno para strings vazias.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForEmptyStrings() {
    $ret = $this->resolucao->textWrap("", 2021);
    $this->assertEmpty($ret[0]);
    $this->assertCount(1, $ret);
  }

  /**
   * Testa a quebra de linha para palavras curtas.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForSmallWords() {
    $ret = $this->resolucao->textWrap($this->baseString, 8);
    $this->assertEquals("Se vi", $ret[0]);
    $this->assertEquals("mais", $ret[1]);
    $this->assertEquals("longe", $ret[2]);
    $this->assertEquals("foi por", $ret[3]);
    $this->assertEquals("estar de", $ret[4]);
    $this->assertEquals("pé sobre", $ret[5]);
    $this->assertEquals("ombros", $ret[6]);
    $this->assertEquals("de", $ret[7]);
    $this->assertEquals("gigantes", $ret[8]);
    $this->assertCount(9, $ret);
  }

  /**
   * Testa a quebra de linha para palavras curtas.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForSmallWords2() {
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
   * Testa a quebra de linha com 2 caracteres por linha.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForBigWords2() {
    $ret = $this->resolucao->textWrap($this->baseString, 2);
    $this->assertEquals("Se", $ret[0]);
    $this->assertEquals("vi", $ret[1]);
    $this->assertEquals("ma", $ret[2]);
    $this->assertEquals("is", $ret[3]);
    $this->assertEquals("lo", $ret[4]);
    $this->assertEquals("ng", $ret[5]);
    $this->assertEquals("e", $ret[6]);
    $this->assertEquals("fo", $ret[7]);
    $this->assertEquals("i", $ret[8]);
    $this->assertEquals("po", $ret[9]);
    $this->assertEquals("r", $ret[10]);
    $this->assertEquals("es", $ret[11]);
    $this->assertEquals("ta", $ret[12]);
    $this->assertEquals("r", $ret[13]);
    $this->assertEquals("de", $ret[14]);
    $this->assertEquals("pé", $ret[15]);
    $this->assertEquals("so", $ret[16]);
    $this->assertEquals("br", $ret[17]);
    $this->assertEquals("e", $ret[18]);
    $this->assertEquals("om", $ret[19]);
    $this->assertEquals("br", $ret[20]);
    $this->assertEquals("os", $ret[21]);
    $this->assertEquals("de", $ret[22]);
    $this->assertEquals("gi", $ret[23]);
    $this->assertEquals("ga", $ret[24]);
    $this->assertEquals("nt", $ret[25]);
    $this->assertEquals("es", $ret[26]);
    $this->assertCount(27, $ret);

  }

}
