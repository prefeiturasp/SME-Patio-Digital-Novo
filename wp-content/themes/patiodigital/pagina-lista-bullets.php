<?php
/*
 * Template Name: Página Lista Bullets
 * Description: Página Lista Bullets. Exibe uma lista de informações em formato de <ul><li> com um Bullet(ícone) escolhido
 */

use Classes\PaginaFilha\PaginaFilha;
use Classes\ModelosDePaginas\PaginaListaBullets\PaginaListaBullets;
use Classes\ModelosDePaginas\PaginaListaBullets\PaginaListaBulletsMetaBox;
use Classes\ModelosDePaginas\PaginaListaBullets\PaginaListaBulletMontaHtml;

global $post;

// $page_ID_filha veio do loop-front-page ou do modelo-com-pagina-filha.php
$descobrirSePaginaFilha = new PaginaFilha($post, $page_ID_filha);
$retornoSePaginaFilha = $descobrirSePaginaFilha->getRetornoSePaginaFilha();
$retornoIdPaginaCorreta = $descobrirSePaginaFilha::getIdPaginaCorreta();



$modelo_de_pagina = new PaginaListaBullets();
$montaHtml = new PaginaListaBulletMontaHtml($retornoIdPaginaCorreta);


if (!$retornoSePaginaFilha) {
	get_footer();
}



