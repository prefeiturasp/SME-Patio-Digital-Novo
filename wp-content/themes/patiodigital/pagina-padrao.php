<?php
/*
 * Template Name: Página Padrao
 * Description: Página padrao. Título, texto imagem destacada .
 */

use Classes\PaginaFilha\PaginaFilha;

global $post;

// $page_ID_filha veio do loop-front-page ou do modelo-com-pagina-filha.php
$descobrirSePaginaFilha = new PaginaFilha($post, $page_ID_filha);
$retornoSePaginaFilha = $descobrirSePaginaFilha->getRetornoSePaginaFilha();

if (!$retornoSePaginaFilha) {
	get_footer();
}



