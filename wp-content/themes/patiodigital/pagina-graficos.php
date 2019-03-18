<?php
/*
 * Template Name: Página Graficos
 * Description: Página gráficos. Exibe os gráfico cadastrados em suas categorias.
 */

use Classes\PaginaFilha\PaginaFilha;
use Classes\ModelosDePaginas\PaginaGraficos\PaginaGraficos;

global $post;

// $page_ID_filha veio do loop-front-page ou do modelo-com-pagina-filha.php
$descobrirSePaginaFilha = new PaginaFilha($post, $page_ID_filha);
$retornoSePaginaFilha = $descobrirSePaginaFilha->getRetornoSePaginaFilha();

$modelo_de_pagina = new PaginaGraficos($page_ID_filha);

if (!$retornoSePaginaFilha) {
	get_footer();
}

