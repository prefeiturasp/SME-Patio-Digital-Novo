<?php
/*
 * Template Name: Página Contato
 * Description: Página padrao. Título, texto imagem destacada .
 */

use Classes\PaginaFilha\PaginaFilha;
use Classes\PaginaContato\PaginaContato;

global $post;

// $page_ID_filha veio do loop-front-page ou do modelo-com-pagina-filha.php
$descobrirSePaginaFilha = new PaginaFilha($post, $page_ID_filha);
$retornoSePaginaFilha = $descobrirSePaginaFilha->getRetornoSePaginaFilha();

$modelo_de_pagina = new PaginaContato();

if (!$retornoSePaginaFilha) {
	get_footer();
}


