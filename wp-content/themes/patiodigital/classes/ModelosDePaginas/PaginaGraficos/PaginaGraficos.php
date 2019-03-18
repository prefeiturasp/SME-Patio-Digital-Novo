<?php

namespace Classes\ModelosDePaginas\PaginaGraficos;

class PaginaGraficos
{
	protected $page_ID_filha;
	protected $taxonomia_de_graficos_ID;
	protected $porcentagem_do_grafico;
	protected $quantidade_de_graficos;
	protected $cor_do_grafico;
	protected $cor_da_trilha;
	protected $args_graficos = array();
	protected $query_graficos;

	public function __construct($page_ID_filha)
	{
		//Variáveis ACF
		$this->page_ID_filha = $page_ID_filha;
		$this->taxonomia_de_graficos_ID = get_field("escolha_a_categoria_de_graficos_que_deseja_exibir_nesta_pagina", $this->page_ID_filha);
		$this->cor_do_grafico = get_field('cor_do_grafico', $this->page_ID_filha);
		$this->cor_da_trilha = get_field('cor_da_trilha', $this->page_ID_filha);

		$this->montaQueryGraficos();
		$this->montaHtmlGraficos();

	}

	public function montaQueryGraficos()
	{
		$this->args_graficos = array(
			'post_type' => 'grafico',
			//'posts_per_page' => $this->quantidade_de_graficos,
			'orderby' => 'title',
			'order' => 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => 'categorias-grafico',
					'field' => 'term_id',
					'terms' => $this->taxonomia_de_graficos_ID,
				)
			)
		);

		$this->query_graficos = new \WP_Query($this->args_graficos);
	}

	public function montaHtmlGraficos()
	{
		?>
        <div class="container">
            <div class="row padding-bottom-15 texto-centralizado">
				<?php

				if ($this->query_graficos->have_posts()) : while ($this->query_graficos->have_posts()) :$this->query_graficos->the_post();

					$this->porcentagem_do_grafico = get_field('escolha_a_porcentagem_a_ser_exibida_no_grafico');
					$titulo_do_grafico = get_the_title();
					?>

                    <div class="col wow zoomInUp">
						<?php
						echo do_shortcode(
							'[skillwrapper type="circle" track_color="' . $this->cor_da_trilha . '" chart_color="' . $this->cor_do_grafico . '" chart_size="150" align="center"]
[skill percent="' . $this->porcentagem_do_grafico . '" title="' . $titulo_do_grafico . '"] [/skillwrapper]'
						);
						the_excerpt();
						?>
                    </div>
				<?php
				endwhile;
				endif;
				wp_reset_postdata();
				?>
            </div>
        </div>
		<?php
	}

}