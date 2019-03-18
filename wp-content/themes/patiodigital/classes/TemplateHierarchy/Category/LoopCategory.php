<?php

namespace Classes\TemplateHierarchy\Category;


class LoopCategory
{
    protected $queried_object;
    protected $taxonomy;
	protected $term_id;
    protected $argsFixos;
    protected $queryFixos;
	protected $argsNaoFixos;
	protected $queryNaoFixos;

	public function __construct()
	{
        $this->queried_object = get_queried_object();
        $this->taxonomy = $this->queried_object->taxonomy;
        $this->term_id = $this->queried_object->term_id;
	    $this->montaQueryFixos();
	    $this->montaHtmlFixos();
	    $this->montaQueryNaoFixos();
	    $this->montaHtmlNaoFixos();
	}

	public function montaQueryFixos(){

	    $this->argsFixos = array(
			'post_type'             => 'post',
			'orderby'             => 'date',
			'order'             => 'DESC',
			'cat'                   => $this->term_id,
			'post__in'              => get_option( 'sticky_posts' ),
			'posts_per_page'        => 3,
			'ignore_sticky_posts'   => 1
        );

	    $this->queryFixos = new \WP_Query($this->argsFixos);

    }

    public function montaQueryNaoFixos(){
	    $this->argsNaoFixos = array(
			'post_type'             => 'post',
			'orderby'             => 'date',
			'order'             => 'DESC',
			'cat'                   => $this->term_id,
			'post__not_in'=>get_option("sticky_posts"),
        );

	    $this->queryNaoFixos = new \WP_Query($this->argsNaoFixos);
    }

    public function montaTituloDescricaoCategory(){
        ?>
            <div class="mb-3">
                <h1><?= single_cat_title() ?></h1>
                <h3><?= category_description() ?></h3>
            </div>
        <?php

    }

    public function montaHtmlFixos(){
	    echo '<div class="container">';

            $this->montaTituloDescricaoCategory();
            echo '<div class="row">';

            if ($this->queryFixos->have_posts()):

                while ($this->queryFixos->have_posts()): $this->queryFixos->the_post();

                if ($this->queryFixos->current_post === 0) {
					?>
                    <div class="col-12 col-md-12 col-lg-6 col-xl-6 pr-0">
                        <div class="card  sem-borda">
							<?php if (has_post_thumbnail()) {
								the_post_thumbnail('large', array('class' => 'card-img img-fluid'));
							} ?>
                            <div class="card-img-overlay card-img-overlay-loop-category rounded-bottom">
                                <h2><a class="text-white" href="<?= get_the_permalink() ?>"><?= get_the_title() ?></a></h2>
                                <p class="card-text text-white"><?= get_the_excerpt() ?></p>
                            </div>
                        </div>
                    </div>

					<?php
				}elseif($this->queryFixos->current_post === 1){
                    ?>
                    <div class="col-12 col-md-12 col-lg-6 col-xl-6">

                    <div class="card mb-3 sem-borda">
                        <div class="row no-gutters">
                            <div class="col-md-5">
								<?php if (has_post_thumbnail()) {
									the_post_thumbnail('medium', array('class' => 'card-img img-fluid'));
								} ?>
                            </div>
                            <div class="col-md-7">
                                <div class="card-body card-body-loop-category mt-0 pt-0 pb-0 pr-0">
                                    <h2 class="card-title"><a class="texto-black" href="<?= get_the_permalink()?>"><?= get_the_title() ?></a></h2>
                                    <p class="card-text"><?= get_the_excerpt() ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                }else{
                    ?>
                    <div class="card mb-3 sem-borda">
                        <div class="row no-gutters">
                            <div class="col-md-5">
								<?php if (has_post_thumbnail()) {
									the_post_thumbnail('medium', array('class' => 'card-img img-fluid'));
								} ?>
                            </div>
                            <div class="col-md-7">
                                <div class="card-body card-body-loop-category mt-0 pt-0 pb-0 pr-0">
                                    <h2 class="card-title"><a class="texto-black" href="<?= get_the_permalink()?>"><?= get_the_title() ?></a></h2>
                                    <p class="card-text"><?= get_the_excerpt() ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    </div> <!--Fecha col-12 col-md-6 col-lg-6 col-xl-6-->
                    <?php
                }

                endwhile;
            endif;

            wp_reset_postdata();

            echo '</div>';

        echo '</div>';

    }

    public function montaHtmlNaoFixos(){
	    echo '<div class="container mt-3 mb-4">';
	    echo '<div class="row">';

            if ( $this->queryNaoFixos->have_posts()) : while ($this->queryNaoFixos->have_posts()) : $this->queryNaoFixos->the_post(); ?>
                <div class="col-lg-4">
                        <?php if (has_post_thumbnail()) {
                            the_post_thumbnail('medium', array('class' => 'img-fluid rounded mb-4'));
                        } ?>

                    <h2><a class="texto-black" href="<?= get_the_permalink()?>"><?php the_title(); ?></a></h2>

                    <p><?php the_excerpt(); ?></p>

                </div>

            <?php
            endwhile;
            else: ?>
                <p>
                    <?php _e('Não existem posts cadastrados.', 'patiodigital'); ?>
                </p>
            <?php endif;

		echo '</div>';
		echo '</div>';

		wp_reset_postdata();
    }

}