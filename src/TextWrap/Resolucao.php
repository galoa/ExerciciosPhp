<?php

namespace Galoa\ExerciciosPhp\TextWrap;

/**
 * Exercicio para vaga de estagio Galoa.
 *
 * @author Gilmar A S Trindade
 */
class Resolucao implements TextWrapInterface {

  /**
   * Está função recebe um texto e o comprimento que deve conter cada linha e
   * devolve um array se acordo com os paramentro especificados.
   *
   * @param string $text
   *   O texto que será utilizado como entrada.
   *
   * @param int $length
   *   Em quantos caracteres a linha deverá ser quebrada.
   *
   * @return array
   *   Um array de strings equivalente ao texto recebido por parâmetro porém
   *   respeitando o comprimento de linha e as regras especificadas acima.
   */
  public function textWrap(string $text, int $length): array {
      // Array que retorna uma linha por posição.
      $return = array();
      //Essa variavel representa a linha do Array.
      $line = 0;
      //Inicializando o array para não dar erro.
      $return[$line] = "";
      if ($length > 0) {
          $freeSpaceOnLine = $length;
          //Utilizando explode para separar as palavras no array $text.
          $text = explode(" ", $text);
          //Verificando palavra por palavra
          foreach ($text as $word) {
              $wordLength = mb_strlen($word);
              if ($wordLength <= $length) {
                  if ($wordLength < $freeSpaceOnLine) {
                      $return[$line] .= " " . $word;
                      $freeSpaceOnLine = $freeSpaceOnLine - ($wordLength + 1);
                  }
                  else if ($wordLength == $freeSpaceOnLine) {
                      $return[$line] .= " " . $word;
                      $freeSpaceOnLine -= $wordLength;
                  }
                  else if ($wordLength > $freeSpaceOnLine) {
                      $line++;
                      $return[$line] = "";
                      $return[$line] .= $word;
                      $freeSpaceOnLine = $length;
                      $freeSpaceOnLine = $freeSpaceOnLine - ($wordLength + 1);
                  }
              }
              //	Se a palavra for maior que o limite de caracteres por linha.
              else if ($wordLength > $length) {
                  $line++;
                  $return[$line] = "";
                  // Atualizando o espaço disponivel na linha.
                  $freeSpaceOnLine = $length;
                  // criando um array com 1 caracter por posição.
                  $characters = str_split($word);
                  // recebe o número de linhas necessarias.
                  $requiredLines = (strlen($word) - 1) / $length;
                  $updatesTheCharacterArray = $freeSpaceOnLine;
                  // zerando as duas variaveis, pois pode haver varias palavras maiores que o tamanho maximo.
                  $lastArrayPosition = 0;
                  $characterCounter = 0;
                  for ($j = 0; $j < $requiredLines; $j++) {
                      $newArrayPosition = $lastArrayPosition;
                        // listando os caracteres.
                        for (; $newArrayPosition < count($characters); $newArrayPosition++) {
                            if ($newArrayPosition < $updatesTheCharacterArray) {
                                $return[$line] .= $characters[$newArrayPosition];
                                $characterCounter++;
                            }
                            else {
                                $updatesTheCharacterArray += $length;
                                $lastArrayPosition = $newArrayPosition;
                                if ($characterCounter == $length) {
                                    $line++;
                                    $return[$line] = "";
                                    $characterCounter = 0;
                                }
                                break; // se já preencher a linha, parar execução e continua na proxima iteração.
                            }
                        }
                        $newArrayPosition += $length;
                  }
                  // Se não preencheu totalmente o ultima iteração, adicionar quant de caracteres.
                  if ($characterCounter != $length) {
                      $freeSpaceOnLine = $freeSpaceOnLine - ($characterCounter + 1);
                  }
              }
          }
          // O ArrayList de retorno recebe cada linha sem os espacos no inicio e no fim.
          for ($i = 0; $i < count($return); $i++) {
              $return[$i] = trim($return[$i]);
          }
      }
      else {
          $return[$line] .= "Por favor, forneça um comprimento válido!";
      }
      return $return;
  }
}