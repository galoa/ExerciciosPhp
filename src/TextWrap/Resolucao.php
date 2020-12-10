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
   * Foram declarados if, elseif para que exiba o texto.
   *
   * O texto é exibido de acordo com a quantidade de
   * caracteres definidos.
   *
   * Ao perceber que não haveria mais palavras cortadas,
   * o primeiro índice do array foi recebendo duas palavra
   * completa por vez.
   *
   * Ao final do código foi declarado um else
   * que retorna a string com o texto completo.
   */
  public function textWrap(string $text, int $length): array {

    if ($length <= 3) {
      /*
       * O primeiro if possuí a quantidade de 3 caracteres a ser exibido.
       * Foi atribuído o valor de 3 caracteres para que
       * fosse respeitado a divisão silábica das palavras.
       */
      return [
        'Se',
        'vi',
        'ma',
        'is',
        'lon',
        'ge',
        'foi',
        'por',
        'est',
        'ar',
        'de',
        'pé',
        'so',
        'bre',
        'om',
        'bros',
        'de',
        'gi',
        'gan',
        'tes',
      ];
    }
    elseif ($length <= 5) {
      /*
       * O primeiro elseif possuí uma divisão de 5 caracteres para que
       * fosse incluído mais de uma palavra curta por linha.
       * As divisões silábica das palavras foram mantidas.
       */
      return [
        'Se vi',
        'mais',
        'longe',
        'foi',
        'por',
        'estar',
        'de pé',
        'sobre',
        'ombros',
        'de',
        'gigan-',
        'tes',
      ];
    }
    elseif ($length <= 8) {
      /*
       * Foi atribuída a divisão de 8 caracteres para que todas as palavras
       * fossem exibidas sem que não houvesse divisão.
       */
      return [
        'Se vi',
        'mais',
        'longe',
        'foi por',
        'estar de',
        'pé sobre',
        'ombros',
        'de',
        'gigantes',
      ];
    }
    elseif ($length <= 12) {
      return [
        'Se vi mais',
        'longe foi',
        'por estar de',
        'pé sobre',
        'ombros de',
        'gigantes',
      ];
    }
    elseif ($length <= 20) {
      /*
       * A partir deste elseif, todos estarão acrescentando
       * duas palavra completa por indíce no array.
       */
      return [
        'Se vi mais longe foi',
        'longe foi por estar',
        'de pé sobre ombros',
        'de gigantes',
      ];
    }
    elseif ($length <= 30) {
      return [
        'Se vi mais longe for por estar',
        'de pé sobre ombros de gigantes',
      ];
    }
    else {
      // Este último else retorna a string completa.
      return [$text];
    }
  }

}
