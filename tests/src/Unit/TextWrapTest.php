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
   * Testa a quebra de linha para palavras curtas.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForSmallWords() {
    $ret = $this->resolucao->textWrap($this->baseString, 8);
    $this->assertCount(7, $ret);
    $this->assertEquals("Sevimais", $ret[0]);
    $this->assertEquals("longefoi", $ret[1]);
    $this->assertEquals("porestar", $ret[2]);
    $this->assertEquals("depé", $ret[3]);
    $this->assertEquals("sobre", $ret[4]);
    $this->assertEquals("ombrosde", $ret[5]);
    $this->assertEquals("gigantes", $ret[6]);
    /*$this->assertEquals("ombros ", $ret[7]);
    $this->assertEquals("de ", $ret[8]);
    $this->assertEquals("gigantes ", $ret[9]);*/
  }
  /**
   * Testa a quebra de linha para palavras curtas.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForSmallWords2() {
    $ret = $this->resolucao->textWrap($this->baseString, 12);
    $this->assertCount(5, $ret);
    $this->assertEquals("Sevimais", $ret[0]);
    $this->assertEquals("longefoipor", $ret[1]);
    $this->assertEquals("estardepé", $ret[2]);
    $this->assertEquals("sobreombros", $ret[3]);
    $this->assertEquals("degigantes", $ret[4]);
   /* $this->assertEquals("ombros de ", $ret[5]);
    $this->assertEquals("gigantes ", $ret[6]);*/
  }
}
