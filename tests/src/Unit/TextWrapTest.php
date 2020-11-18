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

  private $resolucao;

  private $baseString;

  private $encode;

  public function __construct($name = NULL, array $data = [], $dataName = '') {
    parent::__construct($name, $data, $dataName);

    $this->resolucao = new Resolucao();
    $this->baseString = "Se vi mais longe foi por estar de pé sobre ombros de gigantes";
    $this->encode = "UTF-8";
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
  public function testForBaseStringWithLength8() {
    $length = 8;

    $ret = $this->resolucao->textWrap($this->baseString, $length);
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

    $this->verifyOutputString($ret, $length);
  }

  /**
   * Testa a quebra de linha para palavras curtas.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForBaseStringWithLength12() {
    $length = 12;

    $ret = $this->resolucao->textWrap($this->baseString, $length);
    $this->assertEquals("Se vi mais", $ret[0]);
    $this->assertEquals("longe foi", $ret[1]);
    $this->assertEquals("por estar de", $ret[2]);
    $this->assertEquals("pé sobre", $ret[3]);
    $this->assertEquals("ombros de", $ret[4]);
    $this->assertEquals("gigantes", $ret[5]);
    $this->assertCount(6, $ret);

    $this->verifyOutputString($ret, $length);
  }

  /**
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForRandomStringsWithRandomSizes() {
    $randomString = $this->generateRandomString(120);

    $randomLengths = rand(0, 120);

    $ret = $this->resolucao->textWrap($randomString, $randomLengths);

    $this->verifyOutputString($ret, $randomLengths);


  }

  /**
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForWhenSubStringLengthIsBiggerThanTextLength() {


    $ret = $this->resolucao->textWrap($this->baseString, 2021);
    $this->assertCount(1, $ret, "must have only element");
    $this->assertNotEmpty($ret[0]);
  }

  /**
   * Testar o funcionamento do mb_strings.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   *
   */
  public function testForMbStrLen() {
    $mbString = "não";
    $length = mb_strlen($mbString, $this->encode);
    $this->assertTrue($length == 3);
  }

  /**
   * Testar o funcionamento do mb_strings.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForMbSubStr() {
    $mbString = "meu pé";
    $startIndex = 4;
    $length = 2;
    $this->assertTrue(mb_substr($mbString, $startIndex, $length) == "pé");
  }


  private function generateRandomString(int $length): string {
    $possibleStrings = 'abcdefghijlmnopkstuvxz 123456789';

    $sizeOfPossibleStrings = strlen($possibleStrings);

    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
      $randomString .= $possibleStrings[rand(0, $sizeOfPossibleStrings - 1)];
    }

    return $randomString;
  }

  private function verifyOutputString(array $ret, int $length) {

    foreach ($ret as $string_item) {

      $this->assertTrue(mb_strlen($string_item, $this->encode) <= $length, " length condition fail ${string_item}");

    }
  }


}