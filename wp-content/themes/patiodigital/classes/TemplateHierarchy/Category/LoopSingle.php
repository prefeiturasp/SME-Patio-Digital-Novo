<?php

namespace Classes\TemplateHierarchy\Category;


class LoopSingle
{

	public function __construct()
	{
	    $this->montaHtmlLoopSingle();

	}

	public function montaHtmlLoopSingle(){
		echo '<div class="container">';

		if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="row">
                <div class='col-12'>
                    <h1><?php the_title(); ?></h1>
					<?php $tags = get_the_term_list(get_the_ID(), 'post_tag', '', ' , ', ''); ?>
                    <h4 class="data-noticias-single">
                        <i class="fa fa-calendar" aria-hidden="true"></i> <?php echo get_the_date() ?><?= (trim($tags) != '' ? ' | <span class="span-tags"><i class="fa fa-tag" aria-hidden="true"></i> ' . $tags . ' </span>' : "") ?>
                    </h4>
					<?php if (has_post_thumbnail()) {
						the_post_thumbnail('medium', array('class' => 'img-fluid rounded float-right ml-2'));
					} ?>
					<?php the_content(); ?>
                </div>
            </div>
			<?php comments_template() ?>
		<?php
		endwhile;
		else: ?>
            <p>
				<?php _e('Não existem posts cadastrados.', 'patiodigital'); ?>
            </p>
		<?php endif; ?>

        <br/>
        <div class="row container-taxonomias padding-bottom-15">
            <div class="col-12 text-right">
                <a class="btn btn-primary" href="javascript:history.back();"><< Voltar</a>
            </div>
        </div>
		<?php

		echo '</div>';
    }

}