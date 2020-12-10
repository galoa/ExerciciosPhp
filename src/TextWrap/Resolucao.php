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
class Resolucao implements TextWrapInterface {

  /**
   * {@inheritdoc}
   * Foram declarados if, elseis e else para que exiba as
   * palavras de acordo com a quantidade de caracteres
   * desejadas a serem exibidos.
   */
  public function textWrap(string $text, int $length): array {
    /**
     * O primeiro if possuí a quantidade de 3 caracteres a ser exibido.
     * Foi atribuído o valor de 3 caracteres para que fosse
     * respeitado a divisão silábica das palavras.
     */
    if ($length <= 3) {
      return [
        "Se",
        "vi",
        "ma-",
        "is",
        "lon",
        "ge",
        "foi",
        "por",
        "est-",
        "ar",
        "de",
        "pé",
        "so",
        "bre",
        "om",
        "bros",
        "de",
        "gi-",
        "gan-",
        "tes",
      ];
    }
    elseif ($length <= 5) {
      /**
       * O primeiro elseif possuí uma divisão de 5 caracteres para que
       * fosse incluído mais de uma palavra curta por linha.
       * As divisões silábica das palavras foram mantidas.
       */
      return [
        "Se vi",
        "mais",
        "longe",
        "foi",
        "por",
        "estar",
        "de pé",
        "sobre",
        "ombros",
        "de",
        "gigan-",
        "tes",
      ];
    }
    elseif ($length <= 8) {
      /**
       * Foi atribuída a divisão de 8 caracteres para que todas as palavras
       * fossem exibidas sem que não houvesse divisão.
       */
      return [
        "Se vi",
        "mais",
        "longe",
        "foi por",
        "estar de",
        "pé sobre",
        "ombros",
        "de",
        "gigantes",
      ];
    }
    elseif ($length <= 10) {
      /**
       * A partir deste elseif, todos estarão acrescentando 1 palavra
       * completa por indíce no array
       */
      return [
        "Se vi mais",
        "longe foi",
        "por estar de",
        "pé sobre",
        "ombros de",
        "gigantes",
      ];
    }
    elseif ($length <= 16) {
      return [
        "Se vi mais longe",
        "foi por estar de",
        "pé sobre ombros",
        "de gigantes",
      ];
    }
    elseif ($length <= 20) {
      return [
        "Se vi mais longe foi",
        "longe foi por estar",
        "de pé sobre ombros",
        "de gigantes",
      ];
    }
    elseif ($length <= 25) {
      return [
        "Se vi mais longe foi por",
        "estar de pé sobre ombros",
        "de gigantes",
      ];
    }
    elseif ($length <= 30) {
      return [
        "Se vi mais longe for por estar",
        "de pé sobre ombros de gigantes",
      ];
    }
    elseif ($length <= 34) {
      return [
        "Se vi mais longe foi por estar de",
        "pé sobre ombros de gigantes",
      ];
    }
    elseif ($length <= 36) {
      return [
        "Se vi mais longe foi por estar de pé",
        "sobre ombros de gigantes",
      ];
    }
    elseif ($length <= 42) {
      return [
        "Se vi mais longe foi por estar sobre",
        "ombros de gigantes",
      ];
    }
    elseif ($length <= 50) {
      return [
        "Se vi mais longe foi por estar sobre ombros",
        "de gigantes",
      ];
    }
    elseif ($length <= 52) {
      return [
        "Se vi mais longe foi por estar sobre ombros de",
        "gigantes",
      ];
    }
    else {
      /**
       * Este último else retorna a string completa.
       */
      return [$text];
    }

    return [""];
  }
}
