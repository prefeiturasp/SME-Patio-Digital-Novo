<?php


namespace Classes\ModelosDePaginas\PaginaThumbEsquerdoTextoDireita;

use Classes\PaginaFilha\PaginaFilha;

class PaginaThumbEsquerdoTextoDireita
{

	private $escolha_a_categoria_de_posts;
	private $args;
	private $query;

	public function __construct()
	{
		$this->escolha_a_categoria_de_posts = get_field('escolha_a_categoria_de_posts', PaginaFilha::getIdPaginaCorreta())->term_id;
		$this->montaQueryPaginaThumbEsquerdoTextoDireita();
		$this->montaHtmlPaginaThumbEsquerdoTextoDireita();
	}

	public function montaQueryPaginaThumbEsquerdoTextoDireita(){
		$this->args=array(
    		'cat' => $this->escolha_a_categoria_de_posts,
		);

		$this->query = new \WP_Query($this->args);

	}

	public function montaHtmlPaginaThumbEsquerdoTextoDireita(){
		echo '<div class="container">';
		?>

		<?php if ($this->query->have_posts()) : while ($this->query->have_posts()) : $this->query->the_post();
			?>

        <div class="row">
            <div class="container-pagina-thumb-esquerda-texto-direita mb-4 ml-3">
                <div class="container-img-pagina-thumb-esquerda-texto-direita text-center">

                    <h2 class="titulo-pagina-thumb-esquerda-texto-direita-tablet-mobile d-block d-sm-none d-none d-sm-block d-md-none">
						<?php the_title(); ?>
                    </h2>
                    <?php if (has_post_thumbnail()) {
                        the_post_thumbnail('medium', array('class' => 'img-fluid sem-borda pagina-thumb-esquerda-texto-direita-img'));
                    } ?>
                </div>
                <h2 class="titulo-pagina-thumb-esquerda-texto-direita d-none d-md-block">
                    <?php the_title(); ?>
                </h2>
                <?php the_content(); ?>
            </div>
        </div>


		<?php
		endwhile;
		else: ?>
			<p>
				<?php _e('Não existem posts cadastrados.', 'patiodigital'); ?>
			</p>
		<?php

		endif;
		wp_reset_postdata();
		echo '</div>';
	}

}