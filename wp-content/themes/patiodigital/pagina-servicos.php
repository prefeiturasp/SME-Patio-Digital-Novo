<?php
/*
 * Template Name: Página Serviços
 * Description: Página que exibe os ícones de serviços
 */

use Classes\PaginaFilha\PaginaFilha;
use Classes\ModelosDePaginas\PaginaServicos\PaginaServicos;

global $post;

// $page_ID_filha veio do loop-front-page ou do modelo-com-pagina-filha.php
$descobrirSePaginaFilha = new PaginaFilha($post, $page_ID_filha);
$retornoSePaginaFilha = $descobrirSePaginaFilha->getRetornoSePaginaFilha();

$modelo_de_pagina = new PaginaServicos($page_ID_filha);

if (!$retornoSePaginaFilha) {
	get_footer();
}



