<?php
      /**
        * @author Mazurco066
        */
      class QuebraLinha implements TextWrapExerciseInterface {
        /**
          * @param string $text
          *   O texto que será utilizado como entrada.
          * @param int $length
          *   Em quantos caracteres a linha deverá ser quebrada.
          *
          * @return array
          *   Um array de strings equivalente ao texto recebido por parâmetro porém
          *   respeitando o comprimento de linha e as regras especificadas acima.
          */
        public static function textWrap(string $text, int $length): array{
          //Definindo Variáveis de uso geral
          $limiteLinha = 0; //Contador que armazena a posicao atual da linha que está
          $palavraGrande = 0; //Armazena o tamanho de uma palavra grande quando há uma
          $lin = 0; //Contador para o vetor de string de retorno
          $tamanhoArray = 0;  //Vai definir o tamanho do array de retorno
          $retorno = array(); //Array de retorno da função
          $retorno[$lin] = ""; //Inicializando oarray para não dar erros futuramente
          if ($length > 0){
            $text = explode(" ", $text);  //Método que divide uma string bruta palavra por palavra
            foreach($text as $key => $value) $text[$key] = $value." "; //Adicionando novamente os espaços removidos pelo médoto explode
            foreach ($text as $palavra) { //Verifica palavra por palavra do Texto Recebido
              $lenghtPalavra = $limiteLinha + strlen($palavra) - 1; //Recebe a posicao quea palavra ocuparia
              if ($lenghtPalavra < $length){
                //Se a palavra caber tranquilamente na linha
                $retorno[$lin] .= $palavra; //Adiciona ao vetor a palavra
                $limiteLinha += strlen($palavra); //Incrementa o tamanho da palavra ao contador
              }
              else if($lenghtPalavra == $length){
                //Se a palavra caber apertadamente na linha
                $retorno[$lin] .= $palavra;
                $lin++;
                $retorno[$lin] = "";
                $limiteLinha = 0; //Zera o contador pois ja deu o limite dessa linha
              }
              else if($lenghtPalavra > $length){
                //Se a palavra não caber na linha
                if (strlen($palavra) - 1 > $length){  //Se for grande o suficiente a ponto de necessitar mais de 1 linha
                  $palavraGrande = (strlen($palavra) - 1) / $length; //Calcula o tamanho que a palavra ira ocupar
                  for ($i = 0; $i <= $palavraGrande; $i++){ //Percorre a palavra grande caracter por caracter
                    $lengthPalavraGrande = strlen(substr($palavra, ($length * $i) - $limiteLinha, $length - 1));
                    $caracteresDisponiveis = $length - $limiteLinha;  //Armazena os caracteres disponiveis
                    $linha = substr($palavra, ($length * $i), $length); //Conteúdo que encaixara na linha
                    if ($i == $palavraGrande ){ //Se chegar na ultima posição
                      if ($lengthPalavraGrande > $caracteresDisponiveis){
                        //Se necessitar de mais uma linha
                        $limiteLinha = strlen(substr($palavra, ($length * $i), $length)); //Quebra a linha na posição que parou
                        $retorno[$lin] .= $linha;
                        $lin++;
                        $retorno[$lin] = "";
                      }
                    }
                    else{
                      if ($limiteLinha - 1 != 0 || $limiteLinha - 1 != -1){
                        //Se tiver alguma palavra na linha
                        $lin++;
                        $retorno[$lin] = "";
                        $retorno[$lin] .= $linha;
                        $limiteLinha = strlen(substr($palavra, ($length * $i) , $length));  //Retoma o contaddor
                      }
                      else{
                        //Se estiver vazia
                        $retorno[$lin] .= $linha;
                        $lin++;
                        $retorno[$lin] = "";
                        $limiteLinha = 0; //Zera o contador
                      }
                    }
                  }
                }
                else{ //Se for grande e caber somente em uma linha
                  $lin++;
                  $retorno[$lin] = "";
                  $retorno[$lin] .= $palavra;
                  $limiteLinha = strlen($palavra);  //Incrementa o tamanho da palavra no contador
                }
              }
            }
        }
        else{
          $retorno[$lin] .= "Por favor entre com algum limite válido";
        }
          return $retorno;
        }
      }
  
