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
    $this->baseString2 = "Paralelepipedo";
    $this->baseString3 = "Na aula de geometria meu professor desenhou um paralelepipedo de dar inveja.";
		  
  }

  /**
   * Checa o retorno para strings vazias.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForEmptyStrings() {
    $ret = $this->resolucao->textWrap("", 2018);
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
  
  
  //Testa a quebra de linha para palavra grande.
  public function testForBigWord(){
	  $ret =$this->resolucao->textWrap($this->baseString2,9);
	  $this->assertEquals("Paralelep", $ret[0]);
	  $this->assertEquals("ipedo", $ret[1]);
	  $this->assertCount(2, $ret);	

}
	
	  //Testa a quebra de linha para frase com palavras grandes.
  public function testForBigWord(){
	  $ret =$this->resolucao->textWrap($this->baseString3,6);
	  $this->assertEquals("Na", $ret[0]);
	  $this->assertEquals("aula", $ret[1]);
	  $this->assertEquals("de", $ret[2]);
	  $this->assertEquals("geomet", $ret[3]);
	  $this->assertEquals("ria", $ret[4]);
	  $this->assertEquals("meu", $ret[5]);
	  $this->assertEquals("profes", $ret[6]);
	  $this->assertEquals("sor", $ret[7]);
	  $this->assertEquals("desenh", $ret[8]);
	  $this->assertEquals("ou um", $ret[9]);
	  $this->assertEquals("parale", $ret[10]);
	  $this->assertEquals("lepipe", $ret[11]);
	  $this->assertEquals("do de", $ret[12]);
	  $this->assertEquals("dar", $ret[13]);
	  $this->assertEquals("inveja", $ret[14]);
	  $this->assertCount(15, $ret);	

}

}
