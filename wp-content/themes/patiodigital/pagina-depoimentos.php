<?php
/*
 * Template Name: Página Depoimentos
 * Description: Página que exibe a categoria de depoimentos escolhida na quantidade desejada.
 */

use Classes\PaginaFilha\PaginaFilha;
use Classes\ModelosDePaginas\PaginaDepoimentos\PaginaDepoimentos;

global $post;

// $page_ID_filha veio do loop-front-page ou do modelo-com-pagina-filha.php
$descobrirSePaginaFilha = new PaginaFilha($post, $page_ID_filha);
$retornoSePaginaFilha = $descobrirSePaginaFilha->getRetornoSePaginaFilha();

$modelo_de_pagina = new PaginaDepoimentos($page_ID_filha);

if (!$retornoSePaginaFilha) {
	get_footer();
}

