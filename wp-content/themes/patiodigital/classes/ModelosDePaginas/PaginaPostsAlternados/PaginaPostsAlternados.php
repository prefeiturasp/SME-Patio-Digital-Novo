<?php

namespace Classes\ModelosDePaginas\PaginaPostsAlternados;


class PaginaPostsAlternados
{
	protected $page_ID_filha;
	protected $categoria_escolhida;
	protected $icone_separador;
	protected $contador = 0;
	protected $args_posts_alternados = array();
	protected $query_posts_alternados;

	public function __construct($page_ID_filha)
	{
		$this->page_ID_filha = $page_ID_filha;
		$this->categoria_escolhida = get_field('escolha_a_categoria_que_deseja_exibir_nesta_pagina', $this->page_ID_filha);
		$this->icone_separador = get_field('escolha_o_icone_separador', $this->page_ID_filha);

		$this->montaQueryPostsAlternados();
		$this->montaHtmlPostsAltarnados();
	}

	public function montaQueryPostsAlternados()
	{
		$this->args_posts_alternados = array(
			'cat' => $this->categoria_escolhida,
		);

		$this->query_posts_alternados = new \WP_Query($this->args_posts_alternados);
	}

	public function montaHtmlPostsAltarnados()
	{

		if ($this->query_posts_alternados->have_posts()):
			?>
            <div class="container padding-bottom-30">
				<?php
				while ($this->query_posts_alternados->have_posts()): $this->query_posts_alternados->the_post();
					?>
                    <div class='col-xs-12 padding-bottom-60 d-none d-md-block'>
                        <br>

						<?php
						($this->contador % 2 === 0) ? $this->montaHtmlPar() : $this->montaHtmlImpar();
						?>

                    </div>
					<?php

					$this->contador++;
					$this->montaHtmlMobile();
				endwhile;
				?>
            </div>
		<?php
		endif;
		wp_reset_postdata();
	}

	public function montaHtmlPar()
	{
		?>
        <div class="row">

            <div class='col-12 col-md-5'>
                <h3 class="titulo-pagina-posts-alternados"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>
                <div class="separador-pagina-posts-alternados">
                    <i class="fa <?= $this->icone_separador->class ?>" aria-hidden="true"></i>
                </div>
                <div class="texto-pagina-posts-alternados">
                    <a href="<?php the_permalink(); ?>"><?php the_excerpt(); ?></a>
                </div>
                <div class="leia-mais-pagina-posts-alternados">
                    <a href="<?php the_permalink(); ?>">+ Leia Mais</a>
                </div>
            </div>
            <div class='col-12 col-md-7'>
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large', array('class' => 'img-fluid aligncenter')); ?></a>
            </div>

        </div>
		<?php

	}


	public function montaHtmlImpar()
	{
		?>
        <div class="row">
            <div class='col-12 col-md-7'>
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large', array('class' => 'img-fluid aligncenter')); ?></a>
            </div>
            <div class='col-12 col-md-5'>
                <h3 class="titulo-pagina-posts-alternados"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>
                <div class="separador-pagina-posts-alternados">
                    <i class="fa <?= $this->icone_separador->class ?>" aria-hidden="true"></i>
                </div>
                <div class="texto-pagina-posts-alternados">
                    <a href="<?php the_permalink(); ?>"><?php the_excerpt(); ?></a>
                </div>
                <div class="leia-mais-pagina-posts-alternados">
                    <a href="<?php the_permalink(); ?>">+ Leia Mais</a>
                </div>
            </div>
        </div>
		<?php

	}

	public function montaHtmlMobile()
	{
		?>
        <div class="row">
            <div class='col-12 padding-bottom-60 d-block d-md-none'>
                <div class='col-xs-12'>
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large', array('class' => 'img-fluid aligncenter')); ?></a>
                </div>
                <div class='col-xs-12'>
                    <h3 class="titulo-pagina-posts-alternados"><a
                                href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <div class="separador-pagina-posts-alternados">
                        <i class="fa fa-cutlery" aria-hidden="true"></i>
                    </div>
                    <div class="texto-pagina-posts-alternados">
                        <a href="<?php the_permalink(); ?>"><?php the_excerpt(); ?></a>
                    </div>
                    <div class="leia-mais-pagina-posts-alternados">
                        <a href="<?php the_permalink(); ?>">+ Leia Mais</a>
                    </div>
                </div>
            </div>
        </div>
		<?php

	}


}