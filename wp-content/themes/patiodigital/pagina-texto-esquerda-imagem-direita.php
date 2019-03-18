<?php
/*
 * Template Name: Página Texto a Esquerda Imagem a Direita
 * Description: Página Texto a Esquerda Imagem a Direita. Página que Exibe o Texto a Esquerda e a Imagem a Direita
 */

use Classes\PaginaFilha\PaginaFilha;
use Classes\ModelosDePaginas\PaginaTextoEsquerdaImagemDireita\PaginaTextoEsquerdaImagemDireita;

global $post;

// $page_ID_filha veio do loop-front-page ou do modelo-com-pagina-filha.php
$descobrirSePaginaFilha = new PaginaFilha($post, $page_ID_filha);
$retornoSePaginaFilha = $descobrirSePaginaFilha->getRetornoSePaginaFilha();

$modelo_de_pagina = new PaginaTextoEsquerdaImagemDireita();

if (!$retornoSePaginaFilha) {
	get_footer();
}


