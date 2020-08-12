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

  /*
    Teste para o retorno de uma única linha usando a baseString
  */ 
  public function testForOneLine(){
    $ret = $this->resolucao->textWrap($this->baseString,25000);
    $this->assertEquals($ret[0],"Se vi mais longe foi por estar de pé sobre ombros de gigantes");
    $this->assertCount(1,$ret);
  }

  /*
    Teste para linha com 4 caracteres usando a baseString
   */

   public function testForBigWords(){
     $ret = $this->resolucao->textWrap($this->baseString,4);
     $this->assertEquals($ret[0],"Se");
     $this->assertEquals($ret[1],"vi");
     $this->assertEquals($ret[2],"mais");
     $this->assertEquals($ret[3],"long");
     $this->assertEquals($ret[4],"e");
     $this->assertEquals($ret[5],"foi");
     $this->assertEquals($ret[6],"por");
     $this->assertEquals($ret[7],"esta");
     $this->assertEquals($ret[8],"r de");
     $this->assertEquals($ret[9],"pé");
     $this->assertEquals($ret[10],"sobr");
     $this->assertEquals($ret[11],"e");
     $this->assertEquals($ret[12],"ombr");
     $this->assertEquals($ret[13],"os");
     $this->assertEquals($ret[14],"de");
     $this->assertEquals($ret[15],"giga");
     $this->assertEquals($ret[16],"ntes");
     $this->assertCount(17,$ret);
   }


}
