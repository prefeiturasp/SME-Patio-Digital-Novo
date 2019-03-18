<?php //       ?>
<!doctype html>
<html lang="pt-BR">
<head>
	<?php
	$tituloPagina = get_field("insira_o_title_desejado");
	$descriptionPagina = get_field("insira_a_description_desejada");
	if (is_front_page()) {
		if (trim($tituloPagina != "")) { ?>
            <title><?php echo $tituloPagina ?></title>
		<?php } else { ?>
            <title><?php echo STM_SITE_NAME ?> - Home</title>
		<?php }

		if (trim($descriptionPagina != "")) { ?>
            <meta name="description" content="<?php echo $descriptionPagina ?>."/>
		<?php } else { ?>
            <meta name="description" content="<?php echo STM_SITE_NAME ?>. <?php echo STM_SITE_DESCRIPTION ?>"/>
		<?php }
	} elseif (is_category() || is_tax()) {
		$queried_object = get_queried_object();
		$taxonomy = $queried_object->taxonomy;
		$term_id = $queried_object->term_id;

		$tituloCategoria = get_field('insira_o_title_desejado', $taxonomy . '_' . $term_id);
		$descriptionCategoria = get_field("insira_a_description_desejada", $taxonomy . '_' . $term_id);

		if (trim($tituloCategoria != "")) { ?>
            <title><?php echo $tituloCategoria ?></title>
		<?php } else { ?>
            <title><?php wp_title('', true, '-'); ?> - <?php echo STM_SITE_NAME ?></title>
		<?php }

		if (trim($descriptionCategoria != "")) { ?>
            <meta name="description"
                  content="<?php echo $descriptionCategoria ?>."/>
		<?php } else { ?>
            <meta name="description" content="<?php echo STM_SITE_NAME ?>. <?php echo STM_SITE_DESCRIPTION ?>"/>
		<?php }

	} else {
		if (trim($tituloPagina != "")) { ?>
            <title><?php echo $tituloPagina ?></title>
		<?php } else { ?>
            <title><?php wp_title('', true, '-'); ?> - <?php echo STM_SITE_NAME ?></title>
		<?php }

		if (trim($descriptionPagina != "")) { ?>
            <meta name="description" content="<?php echo $descriptionPagina ?>."/>
		<?php } else { ?>
            <meta name="description"
                  content="<?php wp_title('', true, '-'); ?> - <?php echo STM_SITE_DESCRIPTION ?>"/>
		<?php }
	}
	?>
    <meta charset="utf-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="PWI Webstudio">
	<?php wp_head() ?>
</head>

<body>
<div id="main">

    <header>

        <?php
        if (is_front_page()){ ?>

            <nav class="navbar navbar-expand-lg navbar-dark bg-dark menu-topo">
                <div class="container pl-0">
                    <?php
                    // Traz o Logotipo cadastrado no Admin
                    $custom_logo_id = get_theme_mod('custom_logo');
                    $image = wp_get_attachment_image_src($custom_logo_id, 'full');
                    ?>

                    <?php
					if (is_front_page() || is_home() || is_page_template('modelo-com-pagina-filha.php')) { ?>
                        <h1 class="logo-topo">
                            <a class="brand" href="<?php echo STM_URL ?>"
                               title="<?php echo STM_SITE_NAME ?> - <?php echo STM_SITE_DESCRIPTION ?>">
                                <img class="img-fluid wow fadeInDown" src="<?php echo $image[0] ?>"
                                     alt="<?php echo STM_SITE_NAME ?>  <?php echo STM_SITE_DESCRIPTION ?>"
                                     title="<?php echo STM_SITE_NAME ?>  <?php echo STM_SITE_DESCRIPTION ?>"/>
                            </a>
                        </h1>
						<?php
					}else{ ?>
                        <p class="logo-topo">
                            <a class="brand" href="<?php echo STM_URL ?>"
                               title="<?php echo STM_SITE_NAME ?> - <?php echo STM_SITE_DESCRIPTION ?>">
                                <img class="img-fluid wow fadeInDown" src="<?php echo $image[0] ?>"
                                     alt="<?php echo STM_SITE_NAME ?>  <?php echo STM_SITE_DESCRIPTION ?>"
                                     title="<?php echo STM_SITE_NAME ?>  <?php echo STM_SITE_DESCRIPTION ?>"/>
                            </a>
                        </p>
                    <?php } ?>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        <?php
                            wp_nav_menu(array(
                                'menu' => 'primary',
                                'theme_location' => 'primary',
                                'depth' => 2,
                                'container_class' => 'w-100',
                                'container_id' => 'bs-example-navbar-collapse-1',
                                'menu_class' => 'navbar-nav justify-content-end',
                                'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                                'walker'            => new WP_Bootstrap_Navwalker(),
                            ));
                            ?>

                            <?php \Classes\TemplateHierarchy\Search\SearchForm::searchFormHeader() ?>
                    </div>
                </div>
            </nav>

        <?php } ?>


        <?php
        if(!is_front_page()){ ?>

            <nav class="navbar navbar-expand-lg navbar-dark bg-dark menu-topo-internas" style="background-color: #0b2228 !important;">
                <div class="container pl-0">
                    <?php
                    // Traz o Logotipo cadastrado no Admin
                    $custom_logo_id = get_theme_mod('custom_logo');
                    $image = wp_get_attachment_image_src($custom_logo_id, 'full');
                    ?>
					<?php
					if (is_front_page() || is_home() || is_page_template('modelo-com-pagina-filha.php')) { ?>
                    <h1 class="logo-topo">
                        <a class="brand" href="<?php echo STM_URL ?>"
                           title="<?php echo STM_SITE_NAME ?> - <?php echo STM_SITE_DESCRIPTION ?>">
                            <img class="img-fluid wow fadeInDown" src="<?php echo $image[0] ?>"
                                 alt="<?php echo STM_SITE_NAME ?>  <?php echo STM_SITE_DESCRIPTION ?>"
                                 title="<?php echo STM_SITE_NAME ?>  <?php echo STM_SITE_DESCRIPTION ?>"/>
                        </a>
                    </h1>
                    <?php }else{ ?>
                        <p class="logo-topo">
                            <a class="brand" href="<?php echo STM_URL ?>"
                               title="<?php echo STM_SITE_NAME ?> - <?php echo STM_SITE_DESCRIPTION ?>">
                                <img class="img-fluid wow fadeInDown" src="<?php echo $image[0] ?>"
                                     alt="<?php echo STM_SITE_NAME ?>  <?php echo STM_SITE_DESCRIPTION ?>"
                                     title="<?php echo STM_SITE_NAME ?>  <?php echo STM_SITE_DESCRIPTION ?>"/>
                            </a>
                        </p>
                    <?php } ?>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        <?php
                        wp_nav_menu(array(
                            'menu' => 'primary',
                            'theme_location' => 'primary',
                            'depth' => 2,
                            'container_class' => 'w-100',
                            'container_id' => 'bs-example-navbar-collapse-2',
                            'menu_class' => 'navbar-nav justify-content-end',
                            'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                            'walker'            => new WP_Bootstrap_Navwalker(),
                        ));
                        ?>

						<?php \Classes\TemplateHierarchy\Search\SearchForm::searchFormHeader() ?>

                    </div>
                </div>
            </nav>
        <?php } ?>

    </header>
<?php
if (is_category() || is_tax() || is_single() || is_archive()):
    new \Classes\Breadcrumbs\Breadcrumbs();
endif;
?>








