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
  public function setUp(): void {
    $this->resolucao = new Resolucao();
    $this->baseString = "Se vi mais longe foi por estar de pé sobre ombros de gigantes";
    $this->baseTwoString = "Problemas se dissolvem no mar do infinito Ao se beber da água desse rio colorido";
    $this->baseThreeString = "Lidando com o passado, viro luz no espaço escuro Projeto os caminhos que se abrem pro futuro";
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
   * Testa a quebra de linha para palavras longas.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap 
   */
  public function testForBigWords() {
      $ret = $this->resolucao->textWrap($this->baseTwoString, 7);
      $this->assertEquals("Problem", $ret[0]);
      $this->assertEquals("as se d", $ret[1]);
      $this->assertEquals("issolve", $ret[2]);
      $this->assertEquals("m no", $ret[3]);
      $this->assertEquals("mar do", $ret[4]);
      $this->assertEquals("infinit", $ret[5]);
      $this->assertEquals("o Ao se", $ret[6]);
      $this->assertEquals("beber", $ret[7]); 
      $this->assertEquals("da água", $ret[8]);
      $this->assertEquals("desse", $ret[9]);
      $this->assertEquals("rio col", $ret[10]);
      $this->assertEquals("orido", $ret[11]);
      $this->assertCount(12, $ret);
  }
  
  /**
   * Testa a quebra de linha para palavras longas.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForBigWords2() {
      $ret = $this->resolucao->textWrap($this->baseThreeString, 12);
      $this->assertEquals("Lidando com", $ret[0]);
      $this->assertEquals("o passado,", $ret[1]);
      $this->assertEquals("viro luz no", $ret[2]);
      $this->assertEquals("espaço", $ret[3]);
      $this->assertEquals("escuro", $ret[4]);
      $this->assertEquals("Projeto os", $ret[5]);
      $this->assertEquals("caminhos que", $ret[6]);
      $this->assertEquals("se abrem pro", $ret[7]);
      $this->assertEquals("futuro", $ret[8]);
      $this->assertCount(9, $ret);
  }
  
       
}   


