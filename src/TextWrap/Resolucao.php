<?php

namespace Galoa\ExerciciosPhp\TextWrap;

/**
 * Implemente sua resolução aqui.
 */
class Resolucao implements TextWrapInterface {

  /**
   * {@inheritdoc}
   */
  public function textWrap(string $text, int $length): array {
    return [""];
    $retorno = array();

      $linha = 0;

      $vetorlinha = 0;


      //Verifica se existe conteudo
      if($text == "")
      {
          throw new Exception('$text favor inserir conteudo');
      }

      //Tira espacos no comeco e no fim do texto
      $text = trim($text);

      //implementa a funcao
      if ($length > 0)
      {
          $text = explode(" ", $text);
          //Divisao de String
          foreach($text as $key => $value) $text[$key] = $value." ";

          foreach ($text as $palavra)
          {
              //Verificador de Palavras
              $lenghtPalavra = $linha + strlen($palavra) - 1;

              if ($lenghtPalavra < $length)
              {
                  //Verifica se a palavra cabe na linha
                  $retorno[$vetorlinha] .= $palavra;
                  $linha += strlen($palavra);
              }
              else if($lenghtPalavra > $length)
              {
                  //Caso nao couber
                  if (strlen($palavra) - 1 > $length)
                  {
                      //Verifica se precisa mais de uma linha
                      $palavra1 = (strlen($palavra) - 1) / $length;

                      for ($i = 0; $i <= $palavra1; $i++)
                      { //Verifica se o conteudo cabe na linha

                          $lengthPalavraGrande = strlen(substr($palavra, ($length * $i) - $linha, $length - 1));
                          $caracteresDisponiveis = $length - $linha;
                          $linha = substr($palavra, ($length * $i), $length);

                          if ($i == $palavra1 || $linha - 1 == 0 || $linha - 1 == -1 )
                          {
                              //Se estiver vazia e se chegou no final
                              $retorno[$vetorlinha] .= $linha;
                              $vetorlinha++;
                              $retorno[$vetorlinha] = "";
                              $linha = 0; //Zera o contador
                          }
                      }
                  }
              } else {
                  //Grande e em uma linha
                  $vetorlinha++;
                  $retorno[$vetorlinha] = "";
                  $retorno[$vetorlinha] .= $palavra;
                  $linha = strlen($palavra);

                  if ($retorno == 0) {
                      $retorno[$vetorlinha] = "Por favor entre com algum limite válido";
                  }
              }
          }
      }
    }
    return $retorno;
  }
}
