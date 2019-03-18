<?php
/*
 * Template Name: Página Destaques
 * Description: Página que exibe os destaques na quantidade escolhida.
 */

use Classes\PaginaFilha\PaginaFilha;
use Classes\ModelosDePaginas\PaginaDestaques\PaginaDestaques;

global $post;

// $page_ID_filha veio do loop-front-page ou do modelo-com-pagina-filha.php
$descobrirSePaginaFilha = new PaginaFilha($post, $page_ID_filha);
$retornoSePaginaFilha = $descobrirSePaginaFilha->getRetornoSePaginaFilha();

$modelo_de_pagina = new PaginaDestaques($page_ID_filha);

if (!$retornoSePaginaFilha) {
	get_footer();
}

