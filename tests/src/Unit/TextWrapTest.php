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
    $ret = $this->resolucao->textWrap("", 2018);
    $this->assertCount(1, $ret);
    $this->assertEmpty($ret[0]);
  }

  /**
   * Testa a quebra de linha para palavras bem curtas.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForcharWords() {
    $ret = $this->resolucao->textWrap($this->baseString, 1);
    $this->assertCount(1, $ret);
    $this->assertEmpty($ret[0]);
  }

  /**
   * Testa a quebra de linha para palavras curtas.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForSmallWords() {
    $ret = $this->resolucao->textWrap($this->baseString, 8);
    $this->assertCount(10, $ret);
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
  }

  /**
   * Testa a quebra de linha para palavras curtas.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForSmallWords2() {
    $ret = $this->resolucao->textWrap($this->baseString, 12);
    $this->assertCount(6, $ret);
    $this->assertEquals("Se vi mais", $ret[0]);
    $this->assertEquals("longe foi", $ret[1]);
    $this->assertEquals("por estar de", $ret[2]);
    $this->assertEquals("pé sobre", $ret[3]);
    $this->assertEquals("ombros de", $ret[4]);
    $this->assertEquals("gigantes", $ret[5]);
  }

    /**
   * Testa a quebra de linha para palavras curtas.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForSmallestWords() {
      $ret = $this->resolucao->textWrap($this->baseString, 3);
      $this->assertCount(20, $ret);
      $this->assertEquals("Se", $ret[0]);
      $this->assertEquals("vi", $ret[1]);
      $this->assertEquals("mai", $ret[2]);
      $this->assertEquals("s", $ret[3]);
      $this->assertEquals("lon", $ret[4]);
      $this->assertEquals("ge", $ret[5]);
      $this->assertEquals("foi", $ret[6]);
      $this->assertEquals("por", $ret[7]);
      $this->assertEquals("est", $ret[8]);
      $this->assertEquals("ar", $ret[9]);
      $this->assertEquals("de", $ret[10]);
      $this->assertEquals("pé", $ret[11]);
      $this->assertEquals("sob", $ret[12]);
      $this->assertEquals("re", $ret[13]);
      $this->assertEquals("omb", $ret[14]);
      $this->assertEquals("ros", $ret[15]);
      $this->assertEquals("de", $ret[16]);
      $this->assertEquals("gig", $ret[17]);
      $this->assertEquals("ant", $ret[18]);
      $this->assertEquals("es", $ret[19]);
}  

        /**
   * Testa o comportamento para palavras longas.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
    public function testForBigWords() {
    $ret = $this->resolucao->textWrap($this->baseString, 100);
    $this->assertCount(1, $ret);
    $this->assertEquals("Se vi mais longe foi por estar de pé sobre ombros de gigantes", $ret[0]);
  }

}

