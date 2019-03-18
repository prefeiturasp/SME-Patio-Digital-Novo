<?php


namespace Classes\ModelosDePaginas\PaginaServicos;


class PaginaServicos
{
	protected $page_ID_filha;
	protected $taxonomia_de_servicos_ID;
	protected $cor_dos_icones_e_textos;
	protected $deseja_exibir_imagem_ou_cor_de_fundo;
	protected $cor_de_fundo_icones_servicos;
	protected $bg_icones_servicos;
	protected $quantidade_icones_servicos;
	protected $icone_cpt_servicos;
	protected $caracteristicas_cpt_servicos;
	protected $args_servicos = array();
	protected $query_servicos;

	public function __construct($page_ID_filha)
	{
		$this->page_ID_filha = $page_ID_filha;
		$this->taxonomia_de_servicos_ID = get_field('escolha_a_categoria_de_icones_que_deseja_exibir_nesta_pagina', $this->page_ID_filha);
		$this->cor_dos_icones_e_textos = get_field('cor_dos_icones_e_textos', $this->page_ID_filha);
		$this->deseja_exibir_imagem_ou_cor_de_fundo = get_field('deseja_exibir_imagem_ou_cor_de_fundo', $this->page_ID_filha);
		$this->cor_de_fundo_icones_servicos = get_field('selecione_a_cor_de_fundo_icones_servicos', $this->page_ID_filha);
		$this->bg_icones_servicos = get_field('selecione_a_imagem_bg_icones_servicos', $this->page_ID_filha);
		$this->quantidade_icones_servicos = get_field('quantidade_de_icones_servicos', $this->page_ID_filha);

        $this->montaQueryServicos();
		$this->montaHtmlServicos();
	}


	public function defineBackground()
	{
		if ($this->deseja_exibir_imagem_ou_cor_de_fundo === 'Imagem') {
			$bg_style = '<div class="jumbotron chamada-icones-servico-home-img" style="background: url( ' . $this->bg_icones_servicos . ') center center no-repeat">';
		} elseif ($this->deseja_exibir_imagem_ou_cor_de_fundo === 'Cor') {
			$bg_style = '<div class="jumbotron chamada-icones-servico-home-cor" style="background-color:' . $this->cor_de_fundo_icones_servicos . '">';
		} else {
			$bg_style = '<div class="jumbotron chamada-icones-servico-home-transparent">';
		}

		return $bg_style;
	}


	public function montaQueryServicos()
	{
		$this->args_servicos = array(
			'post_type' => 'servico',
			'posts_per_page' => $this->quantidade_icones_servicos,
			'orderby' => 'date',
			'order' => 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => 'categorias-servico',
					'field' => 'term_id',
					'terms' => $this->taxonomia_de_servicos_ID,
				)
			)
		);

		$this->query_servicos = new \WP_Query($this->args_servicos);
	}

	public function montaHtmlServicos()
	{

		// ABRE a Div correta de acordo com o tipo de background escolhido (Imagem, Cor ou nenhum)
		echo $this->defineBackground();
		?>
        <div class="container">
            <div class="row">

				<?php
				if ($this->query_servicos->have_posts()) : while ($this->query_servicos->have_posts()) :$this->query_servicos->the_post();
					$this->icone_cpt_servicos = get_field("escolha_um_icone_servicos");
					$this->caracteristicas_cpt_servicos = get_field("caracteristicas_dos_servicos");
					?>
                    <div style="text-align: center;" class="padding-top-15 col wow zoomInUp" data-wow-delay="0.3s">
						<?php
                            $this->montaHtmlIcones();
                        ?>
                        <h4 class="titulo-cpt-servico" style="color: <?= $this->cor_dos_icones_e_textos ?> !important;"><?php the_title() ?></h4>
                    </div>
				<?php


				endwhile;
				endif;
				wp_reset_postdata();
				?>

            </div>
        </div>
		<?php

		// FECHA a Div correta de acordo com o tipo de background escolhido (Imagem, Cor ou nenhum)
		echo '</div>';

	}

	public function montaHtmlIcones(){
		if (trim($this->caracteristicas_cpt_servicos) != "") {
            $this->montaHtmlIconesComCaracteristicas();
		}else{
            $this->montaHtmlIconesSemCaracteristicas();
        }

    }

	public function montaHtmlIconesComCaracteristicas(){
		$this->caracteristicas_cpt_servicos = explode(",", $this->caracteristicas_cpt_servicos);
		?>
        <span
                data-toggle="tooltip"
                data-placement="top"
                data-original-title='<?php foreach ($this->caracteristicas_cpt_servicos as $caracteristica) {
					echo '<ul class="tool-tip-cpt-servicos"><li><span class ="list-dot"></span>' . $caracteristica . '</li></ul>';
				}// faço um foreach para buscar o que está cadastrado no ACF como caracteristicas dos serviços  ?>'
                class="icone-cpt-servico"
                style="color: <?= $this->cor_dos_icones_e_textos ?>; border: 2px solid <?= $this->cor_dos_icones_e_textos ?>;">
                <i class="fa <?= $this->icone_cpt_servicos ?>"></i>
                </span>
        <?php

    }

    public function montaHtmlIconesSemCaracteristicas(){
	    ?>

        <span
                data-toggle="tooltip"
                data-placement="top"
                class="icone-cpt-servico"
                style="color: <?= $this->cor_dos_icones_e_textos ?>; border: 2px solid <?= $this->cor_dos_icones_e_textos ?>;">
                <i class="fa <?= $this->icone_cpt_servicos ?>"></i>
                </span>

        <?php

    }

}