<?php


namespace Classes\ModelosDePaginas\PaginaNumeroRandomicos;


use Classes\PaginaFilha\PaginaFilha;

class PaginaNumeroRandomicos
{

	protected $numeros_randomicos_ID;
	protected $escolha_a_categoria_de_numeros_randomicos;
	protected $numero_animacao;
	protected $texto_apos_animacao;
	protected $deseja_exibir_titulo_conjunto_numero_randomicos;
	protected $titulo_conjunto_numeros_randomicos;
	protected $escolha_a_cor_de_background_numeros_randomicos;
	protected $escolha_a_cor_para_os_textos_numeros_randomicos;
	protected $args_numeros_randomicos;
	protected $query_numeros_randomicos;



	public function __construct()
	{
		$this->page_ID_filha=PaginaFilha::getIdPaginaCorreta();
		$this->escolha_a_categoria_de_numeros_randomicos = get_field('escolha_a_categoria_de_numeros_randomicos', $this->page_ID_filha);
		$this->deseja_exibir_titulo_conjunto_numero_randomicos = get_field('deseja_exibir_titulo_conjunto_numero_randomicos', $this->page_ID_filha);
		$this->titulo_conjunto_numeros_randomicos = get_field('titulo_conjunto_numeros_randomicos', $this->page_ID_filha);
		$this->escolha_a_cor_de_background_numeros_randomicos = get_field('escolha_a_cor_de_background_numeros_randomicos', $this->page_ID_filha);
		$this->escolha_a_cor_para_os_textos_numeros_randomicos = get_field('escolha_a_cor_para_os_textos_numeros_randomicos', $this->page_ID_filha);

		$this->montaQueryPaginaNumerosRandomicos();
		$this->montaHtmlNumerosRandomicos();
	}

	public function montaQueryPaginaNumerosRandomicos(){

		$this->args_numeros_randomicos = array(
			'post_type' => 'numero_randomico',
			'orderby' => 'date',
			'order' => 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => 'categorias-numero-randomico',
					'field' => 'term_id',
					'terms' => $this->escolha_a_categoria_de_numeros_randomicos,
				)
			)
		);

		$this->query_numeros_randomicos = new \WP_Query($this->args_numeros_randomicos);

    }

    public function getTituloConjuntoNumerosRandomicos(){

		if ($this->deseja_exibir_titulo_conjunto_numero_randomicos == 'sim' && trim($this->titulo_conjunto_numeros_randomicos) != "") {
			return '<h3 class="titulo-numeros-randomicos">'.$this->titulo_conjunto_numeros_randomicos.'</h3>';
		}
    }

	public function montaHtmlNumerosRandomicos(){

		if ($this->query_numeros_randomicos->have_posts()) {

			?>
            <div class="row background-numeros-randomicos" style="background-color: <?= $this->escolha_a_cor_de_background_numeros_randomicos ?>">
                <div class="container">

					<?= $this->getTituloConjuntoNumerosRandomicos() ?>

                    <div class="row">
                        <section class="container-numeros-randomicos ">
                            <div class="row">

								<?php
								if ($this->query_numeros_randomicos->have_posts()) {
									while ($this->query_numeros_randomicos->have_posts()) : $this->query_numeros_randomicos->the_post();
										$this->numero_animacao = get_field('numero_animacao');
										$this->texto_apos_animacao = get_field('texto_apos_animacao');
										?>

                                        <div class="col-6 col-md-6 col-lg-6 col-xl-auto aligncenter">

                                            <div class="container-numeros-randomicos-inner"
                                                 id="id_container_<?php echo get_the_ID(); ?>">

                                                <!--Chama a Funçao que Cria os Números Randômicos-->
                                                <script type="text/javascript">
                                                    jQuery(document).ready(function () {
                                                        var idContainer = "#id_container_" +<?php echo get_the_ID(); ?>;
                                                        criaNumerosRancomicos(idContainer);
                                                    });
                                                </script>

                                                <span id="texto-antes-animacao" style="color: <?= $this->escolha_a_cor_para_os_textos_numeros_randomicos ?>" class="count wow zoomInUp" data-wow-delay="0.5s" title="<?php echo $this->texto_apos_animacao ?>"><?php echo $this->numero_animacao ?></span>
                                                <span class="texto-count" style="display: none;"><i style="color: <?= $this->escolha_a_cor_para_os_textos_numeros_randomicos ?>"><?php echo $this->texto_apos_animacao ?></i></span>
                                            </div>
                                            <p style="color: <?= $this->escolha_a_cor_para_os_textos_numeros_randomicos ?>" class="titulo-cpt-numeros-randomicos"><?php the_title() ?></p>

                                        </div>
									<?php
									endwhile;
									wp_reset_postdata();
									?>
								<?php } ?>
                            </div>
                        </section>

                    </div>
                </div>
            </div>

			<?php

		}

	}

}