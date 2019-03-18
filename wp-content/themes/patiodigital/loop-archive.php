<h1>Estou na Loop Archive</h1>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <div class="row container-taxonomias linha-pontilhada-category">
        <div class="col-12">

            <h3 class="titulo-taxonomias"><i class="fa fa-th-large"></i>

				<?php the_title(); ?>

            </h3>

			<?php if (has_post_thumbnail()) {

				the_post_thumbnail('home-ultimas-noticias', array('class' => 'img-fluid alignleft img-thumbnail'));

			} ?>

			<?php the_excerpt(); ?>

            <div class="row row-com-margin">

                <a class="btn btn-success" href="<?php the_permalink(); ?>"><?php echo VEJAMAIS ?></a>

            </div>
        </div>

    </div>

<?php endwhile; else: ?>

    <p>

		<?php _e('Não existem posts cadastrados.', 'patiodigital'); ?>

    </p>

<?php endif; ?>

<br/>

<?php //wp_pagenavi(); ?>

<div class="row container-taxonomias padding-bottom-15">

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">

        <a class="btn btn-success" href="javascript:history.back();"><?php echo VOLTAR ?></a>

    </div>

</div>

