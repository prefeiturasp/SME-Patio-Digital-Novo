<?php

namespace Classes\ModelosDePaginas\PaginaDepoimentos;


class PaginaDepoimentos
{
	protected $page_ID_filha;
	protected $taxonomia_de_depoimentos_ID;
	protected $query_depoimentos;
	protected $args_depoimentos;
	protected $contador=0;
	protected $classe_css_active='';

	public function __construct($page_ID_filha)
	{
		$this->page_ID_filha=$page_ID_filha;
		$this->taxonomia_de_depoimentos_ID = get_field('escolha_a_categoria_de_depoimentos_que_deseja_exibir_nesta_pagina', $this->page_ID_filha);

		$this->montaQueryDepoimentos();
		$this->montaHtmlDepoimentos();

	}

	public function montaQueryDepoimentos(){

		$this->args_depoimentos = array(
			'post_type' => 'depoimento',
			'orderby' => 'title',
			'order' => 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => 'categorias-depoimento',
					'field' => 'term_id',
					'terms' => $this->taxonomia_de_depoimentos_ID,
				)
			)
		);

		$this->query_depoimentos = new \WP_Query($this->args_depoimentos);
	}


	public function montaHtmlDepoimentos(){
		?>

		<div class="container">
			<!-- Carousel ================================================== -->
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner">
					<?php
						if ($this->query_depoimentos->have_posts()) : while ($this->query_depoimentos->have_posts()) :$this->query_depoimentos->the_post();
							($this->contador===0) ? $this->classe_css_active = 'active' : $this->classe_css_active = '';
							?>
							<div class="carousel-item <?= $this->classe_css_active ?>">
								<div class="col">
									<blockquote>
										<p><?php the_content() ?></p>
										<small>
											<?php if (has_post_thumbnail()) { ?>
												<?php the_post_thumbnail('thumbnail', array('class' => 'author')); ?>
											<?php } ?>
											<?php the_excerpt() ?>
										</small>
									</blockquote>
								</div>
							</div>
							<?php
							$this->contador++;
							endwhile;
						endif;
						wp_reset_postdata();
					?>
				</div>
				<div class="carousel-controls">
					<a class="carousel-control left" href="#myCarousel" data-slide="prev"><span class="fa fa-angle-double-left"></span></a>
					<a class="carousel-control right" href="#myCarousel" data-slide="next"><span class="fa fa-angle-double-right"></span></a>
				</div>
			</div> <!-- Fim Carousel -->
		</div>
		<?php
	}

}