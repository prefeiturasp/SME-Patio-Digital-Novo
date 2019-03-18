<?php

namespace Classes\PaginaFilha;

use Classes\SliderResponsivo\SliderResponsivo;
use Classes\MenuPaginasInternas\MenuPaginasInternasExibir;
use Classes\BlocosDeLayout\BlocosDeLayout;
use Classes\BtCallToAction\BtCallToAction;
use Classes\Breadcrumbs\Breadcrumbs;

class PaginaFilha
{
	public static $idPaginaCorreta;

	private $globalPost;
	private $page_ID_filha;
	private $retornoSePaginaFilha;
	private $pageTemplateName;
	private $exibe_conteudo_padrao;
	private $classe_container_margin_top_paginas;
	private $query_conteudo_padrao;

	public function __construct($globalPost, $page_ID_filha)
	{

		$this->globalPost=$globalPost;
		$this->page_ID_filha=$page_ID_filha;

		$this->exibe_conteudo_padrao = get_field('deseja_exibir_titulo_e_conteudo_padrao', $this->page_ID_filha);
		$this->verificaSeExistePaginaFilha();

		$breadCrumbs = new Breadcrumbs();

		$this->verificaSeExibeConteudo();



		//$breadCrumbs::setExibicao('exibir');

		// Chamada da Função que monta os blocos de layout
		//new BlocosDeLayout();
	}

	public static function getIdPaginaCorreta()
	{
		return self::$idPaginaCorreta;
	}

	public static function setIdPaginaCorreta($idPaginaCorreta)
	{
		self::$idPaginaCorreta = $idPaginaCorreta;
	}

	public function setPageTemplateName($pageTemplateName)
	{
		$this->pageTemplateName = $pageTemplateName;
	}

	public function getPageTemplateName()
	{
		return $this->pageTemplateName;
	}

	public function setRetornoSePaginaFilha($retornoSePaginaFilha)
	{
		$this->retornoSePaginaFilha = $retornoSePaginaFilha;
	}

	public function getRetornoSePaginaFilha()
	{
		return $this->retornoSePaginaFilha;
	}

	public function verificaSeExistePaginaFilha()
	{
		$children = get_pages(array('child_of' => $this->globalPost->ID));

		if (is_page() && ($this->globalPost->post_parent || count($children) > 0)) {
			self::setIdPaginaCorreta($this->page_ID_filha);
			$this->setPageTemplateName(get_page_template_slug(self::getIdPaginaCorreta()));
			$this->montaQueryFiha();
			$this->setRetornoSePaginaFilha(true);
		} else {
			self::setIdPaginaCorreta(get_the_ID());
			$this->setPageTemplateName(get_page_template_slug(self::getIdPaginaCorreta()));
			$this->montaQueryNaoFilha();
			$this->setRetornoSePaginaFilha(false);
		}
	}

	public function verificaSeExisteMenuCadastrado(){
		$menuPaginaInterna = new MenuPaginasInternasExibir($this->globalPost, $this->page_ID_filha);

		if ($menuPaginaInterna->getExisteMenu()) {
			$menuPaginaInterna->ExibeMenu();
			if ($menuPaginaInterna->getMenuEscolhidoPosicao() == 'vertical') {
				echo '<div class="col-12 col-md-9">';
			} else {
				echo '<div class="col-12">';
			}
		} else {
			echo '<div class="container  ' . $this->classe_container_margin_top_paginas . '">';
		}
    }

	public function verificaSeExibeConteudo(){

		$bt_call_to_action =  new BtCallToAction();

		if ($this->exibe_conteudo_padrao === 'sim' || $this->exibe_conteudo_padrao === '' ){
			// Chamada da classe que monta e exibe o Botão Call To Action
			$this->montaHtmlPaginaFilha();
		}
	}

	public function getTagHtmlTitulo(){
		if ($this->getRetornoSePaginaFilha()){
			return '<h2 class="titulo">'.get_the_title().'</h2>';

		}else{
			return '<h1 class="titulo">'.get_the_title().'</h1>';
		}
    }

	public function montaQueryFiha(){
	    $this->classe_container_margin_top_paginas = "margin-top-paginas";
		$this->query_conteudo_padrao = new \WP_Query(array('page_id' => $this->page_ID_filha)); //$page_ID veio do modelo-com-pagina-filha.php
	}

	public function montaQueryNaoFilha(){
		get_header();
		$this->classe_container_margin_top_paginas = "padding-top-30";
		$page_ID = $this->globalPost->ID;
		$this->query_conteudo_padrao = new \WP_Query(array('page_id' => $page_ID));
		new SliderResponsivo($page_ID);
	}

	public function montaHtmlPaginaFilha(){
	    
        echo '<div class="container container-pagina-filha">';
        echo '<div class="row">';

        $this->verificaSeExisteMenuCadastrado();

        if ($this->query_conteudo_padrao->have_posts()) {
            while ($this->query_conteudo_padrao->have_posts()) : $this->query_conteudo_padrao->the_post();

                echo $this->getTagHtmlTitulo();

                echo the_content();
                if (has_post_thumbnail()) { ?>
                    <div class="wow slideInUp" data-wow-delay="0.5s">
                        <?php the_post_thumbnail('large', array('class' => 'img-fluid aligncenter')); ?>
                    </div>
                <?php }

            endwhile;

            wp_reset_postdata();

            echo '</div> <!--Fecha $this->verificaSeExisteMenuCadastrado-->';
        }
        echo '</div>';
        echo '</div>';
	}

}