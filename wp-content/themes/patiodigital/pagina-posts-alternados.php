<?php
/*
 * Template Name: Página Posts Alternados
 * Description: Página Posts Alternados. Exibe a lista de posts de uma categoria escolhida no admin de forma alternada. Um post do lado direito outro na esquerda.
 */

use Classes\PaginaFilha\PaginaFilha;
use Classes\ModelosDePaginas\PaginaPostsAlternados\PaginaPostsAlternados;

global $post;

// $page_ID_filha veio do loop-front-page ou do modelo-com-pagina-filha.php
$descobrirSePaginaFilha = new PaginaFilha($post, $page_ID_filha);
$retornoSePaginaFilha = $descobrirSePaginaFilha->getRetornoSePaginaFilha();

$modelo_de_pagina = new PaginaPostsAlternados($page_ID_filha);


if (!$retornoSePaginaFilha) {
	get_footer();
}


