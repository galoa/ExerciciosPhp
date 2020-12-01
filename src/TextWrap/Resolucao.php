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


	public function textWrap(string $text, int $length): array {
		$n = strlen($text);
		$contador = 0;
		$palavras = '';
		$ans = array();
		for($i = 0;$i < $n; $i++) {
			$palavras .= $text[$i];
			$contador++;
			if($text[$i] == ' ') {
				$espaco = $i;
				if($contador == $length){
					array_push($ans, $palavras);
					$contador = 0;
					$palavras = '';
				}
				if($contador > $length){
					for($j = $contador; $j >= $espaco; $j--){
						substr($palavras, 0, $remove;);
						if($j == $espaco){
							array_push($ans, $palavras);
							$contador = 0;
							$palavras = '';
						}
					}
				}
			}
		}
		return $ans;
	}  
}

