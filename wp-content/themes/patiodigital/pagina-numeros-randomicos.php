<?php
/*
 * Template Name: Página Números Randômicos
 * Description: Página Números Randômicos. Exibe os Números Randômicos cadastrados com o plugin tf-numbers-number-counter-animaton.
 */

use Classes\PaginaFilha\PaginaFilha;
use Classes\ModelosDePaginas\PaginaNumeroRandomicos\PaginaNumeroRandomicos;
global $post;

// $page_ID_filha veio do loop-front-page ou do modelo-com-pagina-filha.php
$descobrirSePaginaFilha = new PaginaFilha($post, $page_ID_filha);
$retornoSePaginaFilha = $descobrirSePaginaFilha->getRetornoSePaginaFilha();

$modelo_de_pagina = new PaginaNumeroRandomicos();


if (!$retornoSePaginaFilha) {
	get_footer();
}


