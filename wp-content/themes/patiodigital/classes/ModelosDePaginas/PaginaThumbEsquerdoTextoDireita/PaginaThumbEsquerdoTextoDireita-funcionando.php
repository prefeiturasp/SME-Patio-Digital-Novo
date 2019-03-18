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

		<div class="card mb-3 ml-0 container-pagina-thumb-esquerda-texto-direita sem-borda">
			<div class="row no-gutters">
				<div class="col-md-3">
					<?php if (has_post_thumbnail()) {
						the_post_thumbnail('medium', array('class' => 'img-fluid sem-borda aligncenter'));
					} ?>
				</div>

				<div class="col-md-9">
					<div class="card-body pt-0">
						<h2 class="titulo-pagina-thumb-esquerda-texto-direita">
							<?php the_title(); ?>
						</h2>
						<?php the_content(); ?>
					</div>
				</div>

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
		echo '</div>';
	}

}