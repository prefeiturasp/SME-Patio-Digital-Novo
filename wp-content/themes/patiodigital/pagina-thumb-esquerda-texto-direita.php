<?php
/*
 * Template Name: Página Thumb a Esquerda Texto a Direita
 * Description: Página Thumb a Esquerda Texto a Direita. Página uma categoria de posts com o Thumb a esquerda e o texto a direita
 */

use Classes\PaginaFilha\PaginaFilha;
use Classes\ModelosDePaginas\PaginaThumbEsquerdoTextoDireita\PaginaThumbEsquerdoTextoDireita;
global $post;

// $page_ID_filha veio do loop-front-page ou do modelo-com-pagina-filha.php
$descobrirSePaginaFilha = new PaginaFilha($post, $page_ID_filha);
$retornoSePaginaFilha = $descobrirSePaginaFilha->getRetornoSePaginaFilha();

$modelo_de_pagina = new PaginaThumbEsquerdoTextoDireita();

if (!$retornoSePaginaFilha) {
	get_footer();
}


