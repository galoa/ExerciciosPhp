<html>

  <head>
    <title> DESAFIO </title>
    <meta charset="UTF-8">
    <meta name="author" content="TiagoSilva">
  </head>

  <body>

      <?php

        //Incluindo as classes
        include("TextWrapInterface.php"); 
        include("Resolucao.php"); 

        //Variaveis que serao passada para a funcao 
        $texto = "Se vi mais longe foi por estar de pé sobre ombros de gigantes";
        $qtdCaracteres = 5;

        //Instanciando o Objeto de QuebraLinha
        $x = new Resolucao();

        //Impimindo texto
        $novoTexto = $x->textWrap($texto, $qtdCaracteres);

        
      ?>

  </body>

</html>
