<?php
/*
 * Template Name: Página Imagem Destacada Topo
 * Description: Página Imagem Destacada Topo. Exibe a lista de posts de uma categoria escolhida no admin. A imagem destacada de cada post aparece no topo de fora a fora
 */

use Classes\PaginaFilha\PaginaFilha;
use Classes\ModelosDePaginas\PaginaImagemDestacadaTopo\PaginaImagemDestacadaTopo;

global $post;

// $page_ID_filha veio do loop-front-page ou do modelo-com-pagina-filha.php
$descobrirSePaginaFilha = new PaginaFilha($post, $page_ID_filha);
$retornoSePaginaFilha = $descobrirSePaginaFilha->getRetornoSePaginaFilha();

$modelo_de_pagina = new PaginaImagemDestacadaTopo($page_ID_filha);


if (!$retornoSePaginaFilha) {
	get_footer();
}


