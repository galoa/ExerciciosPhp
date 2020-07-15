<?php

namespace Galoa\ExerciciosPhp\TextWrap;

/**
 * Implemente sua resolução aqui.
 */
class Resolucao implements TextWrapInterface
{

    /**
     * {@inheritdoc}
     */
    public function textWrap(string $text, int $length): array
    {
        if ($text == "") {
            return [""];
        }


        //Separa o texto em palavras

        $palavrasDoTexto = preg_split('/ /', $text);

        $linha = '';
        $textoFormatado = [];


        foreach ($palavrasDoTexto as $palavra) {
            $tamanhoDaPalavra = strlen($palavra);
            $tamanhoDaLinha = strlen($linha);

            //Testa se a palavra cabe na linha
            if ($tamanhoDaPalavra + $tamanhoDaLinha < $length) {
                if ($tamanhoDaLinha == 0) {
                    $linha = $palavra;
                } else {
                    $linha .= " $palavra";
                }

                //Testar o por que a palavra não coube na linha
            } else {
                //Testa se a palavra está dentro do limite de caracteres
                if ($tamanhoDaPalavra <= $length) {
                    array_push($textoFormatado, $linha);
                    $linha = $palavra;

                    //Palavra excedeu o numero de caracteres
                } else {

                    if ($tamanhoDaLinha != 0) {
                        $sobraDaLinha = $length - ($tamanhoDaLinha + strlen(' '));
                    } else {
                        $sobraDaLinha = $length;
                    }

                    if ($sobraDaLinha > 0) {
                        if ($tamanhoDaLinha != 0) {
                            $linha = $linha . ' ' . substr($palavra, 0, $sobraDaLinha);
                        } else {
                            $linha = $linha . substr($palavra, 0, $sobraDaLinha);
                        }
                    }

                    array_push($textoFormatado, $linha);
                    $linha = '';


                    $sobraDaPalavra = substr($palavra, $sobraDaLinha);
                    $separarSobraDaPalavra = str_split($sobraDaPalavra, $length);

                    foreach ($separarSobraDaPalavra as $pedaco) {
                        if (strlen($pedaco) == $length) {
                            array_push($textoFormatado, $pedaco);
                        } else {
                            $linha = $linha . $pedaco;
                        }
                    }
                }
                
                
                }


               
            }
            //Coloca no texto formatado a ultima linha
            if (strlen($linha) != 0) {
                array_push($textoFormatado, $linha);
            }

            return $textoFormatado;
    } 
}
