<?php

namespace Classes\TemplateHierarchy\Portfolio;


use Classes\DesignPatterns\Factory;

class ArchivePortfolio
{
	public function __construct()
	{
		$this->montaBotoesTaxonomias();
		$this->montaConteudoPortfolio();

	}

	public function montaBotoesTaxonomias()
	{
		$terms = get_terms('portfolios');
		if ($terms && !is_wp_error($terms)) :
			?>
            <div class="container portfolio">
                <div class="row">
                    <div class="col-lg-12 mt-2 mb-4">
                        <button type="button" class="btn btn-success filter-button rounded-pill" data-filter="all">
                            Mostrar Todos
                        </button>
						<?php foreach ($terms as $term) { ?>
                            <button type="button" class="btn btn-outline-success filter-button rounded-pill" data-filter="<?= $term->slug ?>"><?php echo $term->name; ?></button>
						<?php } ?>
                    </div>
                </div>
            </div>
		<?php
		endif;
	}



	public function montaConteudoPortfolio()
	{
		?>

        <div class="container portfolio">
            <div class="row ">

                <div class="col-lg-12">
                    <h1><?= Factory::getTaxonomy()['taxonomyName'] ?> </h1>
                    <h3><?= get_option('descricao_portfolio') ?></h3>
                </div>

				<?php if (have_posts()) : while (have_posts()) : the_post();
					?>

                    <div class="card filter flex-basis-portfolio <?= Factory::getSlugsTaxDentroDoLoop() ?>">

						<?php if (has_post_thumbnail()) {
							the_post_thumbnail('home-ultimas-noticias', array('class' => 'card-img-top img-fluid aligncenter'));
						} ?>
                        <div class="card-body">
                            <h5 class="titulo-pagina-destaques">
								<?php the_title(); ?>
                            </h5>
                            <div class="row sub-heading texto-pagina-destaques">
								<?php the_excerpt(); ?>
                            </div>
                        </div>

                        <div class="d-flex align-items-end ml-4">
                            <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary"><?php echo VEJAMAIS ?></a>
                        </div>
                    </div>

				<?php endwhile; else: ?>
                    <p><?php _e('Não existem portfolios cadastrados.', 'patiodigital'); ?></p>
				<?php endif;
				wp_reset_postdata();
				?>

            </div>
        </div>


		<?php
	}

}