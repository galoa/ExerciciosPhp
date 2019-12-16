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

 function bigtext(){
      //Textos muito longos
      $b = new BigTest();
      $textopuro = " Eu quero muito estar atuando na Galoa, pois desde o principio e uma empresa que se mostrou muito atenciosa aos detalhes e me tratou muito bem, e inclusive me perguntou se eu tinha duvidas, isso me deixou muito feliz, pois mostra que realmente os valores que li no site existem na cultura da empresa, desde ja meu muito obrigado";
      $returntext =  $b->textWrap($textopuro, 15);
      foreach ($returntext as $key => $value) {
        $this->assertInternalType('string',$value);
      }

function valueerror(){
      //Verifica se Retorna valor inválido com tamanho inválido
      $c = new ValueError();
      $textopuro = "Ola eu sou o Carlos Henrique, tudo bem com voce?";
      $returntext =  $c->textWrap($textopuro, 0);
      $this->assertEquals("Por favor entre com algum limite válido", $retornoTeste[0]);
    }
 function smalltext(){
      //Textos muito curtos
      $d = new SmallTest();
      $this->assertEquals("a chuva", $ret[4]);
      $this->assertEquals("e refrescante", $ret[7]);
}
