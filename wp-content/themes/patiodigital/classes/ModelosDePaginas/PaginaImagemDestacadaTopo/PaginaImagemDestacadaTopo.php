<?php


namespace Classes\ModelosDePaginas\PaginaImagemDestacadaTopo;


class PaginaImagemDestacadaTopo
{
	protected $page_ID_filha;
	protected $categoria_escolhida;
	protected $icone_separador;
	protected $args_imagem_destacada_topo = array();
	protected $query_imagem_destacada_topo;

	public function __construct($page_ID_filha)
	{
		$this->page_ID_filha = $page_ID_filha;
		$this->categoria_escolhida = get_field('escolha_a_categoria_que_deseja_exibir_nesta_pagina', $this->page_ID_filha);
		$this->icone_separador = get_field('escolha_o_icone_separador', $this->page_ID_filha);

		$this->montaQueryImagemDestacadaTopo();
		$this->montaHtmlImagemDestacadaTopo();
	}

	public function montaQueryImagemDestacadaTopo()
	{
		$this->args_imagem_destacada_topo = array(
			'cat' => $this->categoria_escolhida,
		);
		$this->query_imagem_destacada_topo = new \WP_Query($this->args_imagem_destacada_topo);
	}

	public function montaHtmlImagemDestacadaTopo()
	{
		?>
        <div class="container-fluid">
            <div class="row">
				<?php
				if ($this->query_imagem_destacada_topo->have_posts()) :
					while ($this->query_imagem_destacada_topo->have_posts()) : $this->query_imagem_destacada_topo->the_post(); ?>
						<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full'); ?>
                        <div class="container-fluid topo-img-pagina-imagem-destacada-topo"
                             style="background: url(<?php echo $image[0]; ?>)">
                            <div class="container wow zoomIn" data-wow-delay="0.5s">
                                <h3 class="titulo-imagem-destacada-topo"><?php the_title(); ?></h3>
                            </div>
                        </div>
                        <div class="container">
                            <div class="col-12">
								<?php the_content(); ?>
                            </div>

                            <div class="separador-pagina-imagem-destacada-topo">
                                <i class="fa <?= $this->icone_separador->class ?>" aria-hidden="true"></i>
                            </div>
                        </div>
					<?php
					endwhile;
					?>
				<?php else:
					?>
                    <p>
						<?php _e('Não existem posts cadastrados.'); ?>
                    </p>
				<?php endif;
				wp_reset_postdata();
				?>
            </div>
        </div>
		<?php
	}
}