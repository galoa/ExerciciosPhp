<?php

namespace Galoa\ExerciciosPhp\TextWrap;

/**
 * Implemente sua resolução nessa classe.
 *
 * Depois disso:
 * - Crie um PR no github com seu código
 * - Veja o resultado da correção automática do seu código
 * - Commit até os testes passarem
 * - Passou tudo, melhore a cobertura dos testes
 * - Ficou satisfeito, envie seu exercício para a gente! <3
 *
 * Boa sorte :D
 */
class Resolucao implements TextWrapInterface
{

  /**
   * {@inheritdoc}
   *
   * Apague o conteúdo do método abaixo e escreva sua própria implementação,
   * nós colocamos esse mock para poder rodar a análise de cobertura dos
   * testes unitários.
   */
  public function textWrap(string $text, int $length): array
  {
    if(mb_strlen($text)<1){
      return [];
    }
    $inputArray = explode(" ", $text);
    $linha = "";
    $resultado = [];
    foreach ($inputArray as $palavra) {
      switch (true) {
        case (mb_strlen($palavra) > $length):
          array_push($resultado, substr($palavra, 0, $length - 1));
          array_push($resultado, substr($palavra, $length - 1, mb_strlen($palavra) - 1));
          break;
        case (mb_strlen($linha . $palavra) > $length):
          array_push($resultado, $linha);
          $linha = $palavra;
          break;
        case (mb_strlen($linha . $palavra) + 1 < $length):
          if (mb_strlen($linha) < 1) {
            $linha = $palavra;
          } else {
            $linha = $linha . " " . $palavra;
          }
          break;
          case (mb_strlen($linha . $palavra) + 1 == $length):
          if (mb_strlen($linha) < 1) {
            $linha = $palavra;
          } else {
            $linha = $linha . " " . $palavra;
            array_push($resultado, $linha);
            $linha = "";
          }
          break;
        case (mb_strlen($linha . $palavra) + 1 > $length):
          array_push($resultado, $linha);
          $linha = $palavra;
          break;

        default:
        $linha = $palavra;
        break;
      }
    }
    return $resultado;
  }
}
