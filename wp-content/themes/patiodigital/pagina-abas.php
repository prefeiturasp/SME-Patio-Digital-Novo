<?php
/*
 * Template Name: Página Abas
 * Description: Página Abas. Exibe os post cadastrados na categoria escolhida em abas.
 */

use Classes\PaginaFilha\PaginaFilha;
use Classes\ModelosDePaginas\PaginaAbas\PaginaAbas;

global $post;

// $page_ID_filha veio do loop-front-page ou do modelo-com-pagina-filha.php
$descobrirSePaginaFilha = new PaginaFilha($post, $page_ID_filha, false);
$retornoSePaginaFilha = $descobrirSePaginaFilha->getRetornoSePaginaFilha();

$escolha_a_categoria_que_deseja_exibir_pagina_abas = get_field('escolha_a_categoria_que_deseja_exibir_pagina_abas', $page_ID);
$modelo_de_pagina = new PaginaAbas($page_ID_filha);

if (!$retornoSePaginaFilha) {
	get_footer();
}
