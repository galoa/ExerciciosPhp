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
   *
   * Apague o conteúdo do método abaixo e escreva sua própria implementação,
   * nós colocamos esse mock para poder rodar a análise de cobertura dos
   * testes unitários.
   */
  public function textWrap(string $text, int $length): array {
    $array = array();
    $tex = $text;
    $x = $length;
    $y = 0;
    while(strlen($tex) > 1)
    {
        if(substr($tex, $x, 1) == " ")
        {
            if($x >= 1)
            {
                if(strlen($tex) < $length)
                {
                    $array[] = substr(trim($tex), $y);
                    $tex = "";
                    break;
                }else{
                    $array[] = substr(trim($tex), $y, $x);
                    $tex = substr($tex, $x);
                    if(strlen($tex) > $length)$x = $length;
                    else $x = strlen($tex)-1;                    
                }
            }
            else{
                if(strlen($tex) < $length)
                {
                    $array[] = substr(trim($tex), $y,strlen($tex));
                    $tex = "";
                    break;
                }
                else{
                    $array[] = substr(trim($tex), $y, $length)."-";
                    $tex = substr($tex, $length);
                    if(strlen($tex) > $length)$x = $length;
                    else $x = strlen($tex);
                }
            }
        }
        else{
            $x--;
        }
    }
      return $array;
  }
}