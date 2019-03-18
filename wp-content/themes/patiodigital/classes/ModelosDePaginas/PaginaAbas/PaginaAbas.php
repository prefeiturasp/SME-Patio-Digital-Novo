<?php

namespace Classes\ModelosDePaginas\PaginaAbas;


class PaginaAbas
{
	private $pageIDfilha;
	private $idCategoria;

	private $queryPaginaAbas;
	private $panelIdTitulo;
	private $panelIdConteudo;

	private $qtdTotaldePosts;


	public function __construct($page_ID_filha)
	{
		$this->pageIDfilha = $page_ID_filha;
		$this->idCategoria = get_field('escolha_a_categoria_que_deseja_exibir_pagina_abas', $this->pageIDfilha);
		$this->montaArgumentosQuery();
	}

	public function __set($name, $value)
	{
		// TODO: Implement __set() method.
		$this->$name = $value;

	}

	public function __get($name)
	{
		// TODO: Implement __get() method.
		return $this->$name;
	}

	/**
	 * @return mixed
	 */
	public function getQtdTotaldePosts()
	{
		return $this->qtdTotaldePosts;
	}

	/**
	 * @param mixed $qtdTotaldePosts
	 */
	public function setQtdTotaldePosts($qtdTotaldePosts)
	{
		$this->qtdTotaldePosts = $qtdTotaldePosts;
	}


	public function montaArgumentosQuery(){

	    if ($this->idCategoria) {

			$args = array(
				'posts_per_page' => 8,
				'orderby' => 'date',
				'order' => 'ASC',
				'cat' => $this->idCategoria,
			);

			$this->queryPaginaAbas = new \WP_Query($args);
			$this->verificaQtdTotalPosts();

		}else{
	        return;
        }

    }


	public function verificaQtdTotalPosts(){
		global $wpdb;
		$this->setQtdTotaldePosts((int)$wpdb->get_var("SELECT count FROM wp_term_taxonomy WHERE term_id = $this->idCategoria "));

		if ($this->getQtdTotaldePosts() > 0){
			$this->montaQueryPaginaAbasTitulo();
			$this->montaQueryPaginaAbasConteudo();
		}else{
		    return;
        }

	}

	public function montaQueryPaginaAbasTitulo(){

	    // Monta os titulos das abas

		$this->panelIdTitulo = 1;

		echo '<div class="padding-bottom-30 padding-top-30">';
			echo '<div class="container">';
				echo '<ul class="nav nav-tabs" role="tablist">';
					while ($this->queryPaginaAbas->have_posts()) : $this->queryPaginaAbas->the_post();
						?>
						<li class="nav-item">

<a <?= ($this->queryPaginaAbas->current_post == 0) ? 'class="nav-link active" ' : 'class="nav-link"'  ?> id="<?= $this->panelIdTitulo.'-tab'?>" data-toggle="tab" href="#tab-<?php echo $this->panelIdTitulo; ?>" role="tab" aria-controls="tab-<?= $this->panelIdTitulo ?>"><?php the_title(); ?></a>
						</li>

						<?php $this->panelIdTitulo++;
					endwhile;
					wp_reset_postdata();
				echo '</ul>';
	}

	public function montaQueryPaginaAbasConteudo(){

		// Monta os conteudos das abas

		$this->panelIdConteudo = 1;

		echo '<div class="tab-content">';

		while ($this->queryPaginaAbas->have_posts()) : $this->queryPaginaAbas->the_post();
			?>


                <div <?= ($this->queryPaginaAbas->current_post == 0) ? 'class="tab-pane fade show active" ' : 'class="tab-pane fade"'  ?> id="tab-<?= $this->panelIdConteudo ?>" role="tabpanel" aria-labelledby="<?= $this->panelIdConteudo.'-tab'?>">
					<?php if (has_post_thumbnail()) { ?>
						<?php the_post_thumbnail('home-thumb', array('class' => 'img-fluid alignleft padding-top-15')); ?>
					<?php } ?>
                    <h3><?php the_title() ?></h3>
					<?php the_content(); ?>
                </div>


        	<?php
            $this->panelIdConteudo++;
		endwhile;
		wp_reset_postdata();
		echo '</div>'; // Fecha <div class="row padding-bottom-30 padding-top-30">
		echo '</div>'; // Fecha <div class="container">
		echo '</div>'; // Fecha <div class="tab-content">

	}
}