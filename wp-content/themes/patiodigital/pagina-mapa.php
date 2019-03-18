<?php
/*
 * Template Name: Página Mapa
 * Description: Página Mapa. Exibe o Iframe do Mapa gerado pelo Google Maps.
 */


use Classes\PaginaFilha\PaginaFilha;
use Classes\ModelosDePaginas\PaginaMapa\PaginaMapa;

global $post;

// $page_ID_filha veio do loop-front-page ou do modelo-com-pagina-filha.php
$descobrirSePaginaFilha = new PaginaFilha($post, $page_ID_filha);
$retornoSePaginaFilha = $descobrirSePaginaFilha->getRetornoSePaginaFilha();

$modelo_de_pagina = new PaginaMapa($page_ID_filha);

if (!$retornoSePaginaFilha) {
	get_footer();
}


