<?php
// Desabilitando o Gutemberg
add_filter('use_block_editor_for_post', '__return_false');

remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');

// Remover a tag p da category_description
remove_filter('term_description', 'wpautop');
// Remover a tag p do the_excerpt()
remove_filter('the_excerpt', 'wpautop');

add_action('after_setup_theme', 'custom_setup');

function custom_setup() {
    add_filter('show_admin_bar', '__return_false');
    add_action('wp_enqueue_scripts', 'custom_formats');
    add_filter('get_image_tag_class', 'image_tag_class');
    add_action('login_head', 'custom_login_logo');
    add_filter('login_headerurl', 'my_login_logo_url');
    add_filter('login_headertitle', 'my_login_logo_url_title');
	add_action( 'widgets_init', 'theme_slug_widgets_init' );

    register_nav_menus(array(
        'primary' => __('Menu Superior', 'THEMENAME'),
    ));

	register_nav_menu('navbar', __('Navbar', 'your-theme'));


    if (function_exists('add_image_size')) {
        add_theme_support('post-thumbnails');
    }

    if (function_exists('add_image_size')) {
        add_image_size('home-thumb', 250, 166);
    }

	//Permite adicionar no post ou página uma imagem com tamanho personalizado, nesse caso a home-thumb já definida anteriormente com 250X147
    function custom_choose_sizes($sizes) {
        $custom_sizes = array(
            'home-thumb' => 'Tamanho Personalizado'
        );
        return array_merge($sizes, $custom_sizes);
    }

    add_filter('image_size_names_choose', 'custom_choose_sizes');

// Limita o Numero de palavras da função the_excerpt(), nesse caso em 20
    function wpdev_custom_excerpt_length() {
        return 20;
    }
    add_filter('excerpt_length', 'wpdev_custom_excerpt_length');

	function theme_slug_widgets_init()
	{

		register_sidebar(array(
			'name' => 'Rodape Esquerda',
			'id' => 'sidebar-4',
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<p class="titulo-rodape">',
			'after_title' => '</p>',
		));

		register_sidebar(array(
			'name' => 'Rodape Centro',
			'id' => 'sidebar-5',
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<p class="titulo-rodape">',
			'after_title' => '</p>',
		));


		register_sidebar(array(
			'name' => 'Rodape Direita',
			'id' => 'sidebar-6',
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<p class="titulo-rodape">',
			'after_title' => '</p>',
		));
	}


//////////////////////////////////////////////////////////////////////////
///        FUNCAO PARA TROCAR BACKGROUND                            /////
////////////////////////////////////////////////////////////////////////


    $defaults = array(
        'default-color' => '',
        'default-image' => '',
        'wp-head-callback' => '_custom_background_cb',
        'admin-head-callback' => '',
        'admin-preview-callback' => ''
    );
    add_theme_support('custom-background', $defaults);


//////////////////////////////////////////////////////////////////////////
///        FUNCAO HEADER, PARA TROCAR O CABEÃ‡ALHO                   /////
////////////////////////////////////////////////////////////////////////
    $defaults = array(
        'default-image' => '',
        'width' => 0,
        'height' => 0,
        'flex-height' => false,
        'flex-width' => false,
        'uploads' => true,
        'random-default' => false,
        'header-text' => true,
        'default-text-color' => '',
        'wp-head-callback' => '',
        'admin-head-callback' => '',
        'admin-preview-callback' => '',
    );
    add_theme_support('custom-header', $defaults);


//////////////////////////////////////////////////////////////////////////
///        FUNCAO HEADER, PARA TROCAR O lOGOTIPO                    /////
////////////////////////////////////////////////////////////////////////
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ) );


}

function custom_formats() {

    wp_register_style('bootstrap_4_css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css', null, '4.2.1', 'all');
    wp_register_style('animate_css', STM_THEME_URL . 'css/animate.css', null, null, 'all');
    wp_register_style('hamburger_menu_icons_css', STM_THEME_URL . 'css/hamburger_menu_icons.css', null, null, 'all');
    wp_register_style('hover-effects_css', STM_THEME_URL . 'css/hover-effects.css', null, null, 'all');
    wp_register_style('default_ie', STM_THEME_URL . 'css/ie6.1.1.css', null, null, 'all');
    wp_register_style('font_awesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_register_style('style', get_stylesheet_uri(), null, null, 'all');

	wp_register_script('bootstrap_4_popper_js',  'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js', false, '1.14.6', true);
    wp_register_script('bootstrap_4_js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js', false, '4.2.1', true);
    wp_register_script('wow_js', STM_THEME_URL . 'js/wow.min.js', array('jquery'), 1.0, true);
    wp_register_script('scripts_js', STM_THEME_URL . 'js/scripts.js', array('jquery'), 1.0, true);
    wp_register_script('jquery.event.move_js', STM_THEME_URL . 'js/jquery.event.move.js', array('jquery'), 1.0, true);

    global $wp_styles;
    $wp_styles->add_data('default_ie', 'conditional', 'IE 6');
	wp_enqueue_style('bootstrap_4_css');
    wp_enqueue_style('animate_css');
    wp_enqueue_style('hamburger_menu_icons_css');
    wp_enqueue_style('hover-effects_css');
    wp_enqueue_style('default_ie');
    wp_enqueue_style('font_awesome');
    wp_enqueue_style('style');

    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap_4_popper_js');
    wp_enqueue_script('bootstrap_4_js');
    wp_enqueue_script('wow_js');
    wp_enqueue_script('scripts_js');
    wp_enqueue_script('jquery.event.move_js');
}

// **************** Scripts para fazer o efeito de rolagem do menu funcionar corretamente ****************

/* FunÃ§Ã£o para adicionar classes ao li a do menu wp-nav-menu para fazer o efeito de scroll */
function adicionar_nav_class($output) {
	$output = preg_replace('/<a/', '<a class="nav-link scroll"', $output, -1);
	return $output;
}
add_filter('wp_nav_menu', 'adicionar_nav_class');

/* FunÃ§Ã£o para adicionar a Ã¢ncora nas urls fazendo funcionar o efeito de scroll */
function colocar_ancora($output_ancora) {
	$nome_do_site = STM_SITE_NAME;
	$endereco_do_site = STM_URL;
	$url = preg_replace('/href="(.*)' . $nome_do_site . '\//', $endereco_do_site . '/#', $output_ancora, -1);
//Pra funcionar usei uma funcao javascript que tira a ultima barra da url - a funcao estÃ¡ no script.js
	return $output_ancora;
}
add_filter('wp_nav_menu', 'colocar_ancora');

/* Procedimentos para criar uma funÃ§Ã£o no header do tema que retorna o get_home_url() podendo passar essa variÃ¡vel para javascript */
add_action('wp', 'show_page_name', 10, 1);
function show_page_name(){

	// Descobrindo qual Ã© o slug da front page
	$frontpage_id = get_option( 'page_on_front' );
	$slug_front_page = get_post($frontpage_id)->post_name;

	wp_register_script('custom-js', get_bloginfo('template_url') . '/' . 'js/custom-js.js');
	wp_enqueue_script('custom-js');
	if ( ! is_admin() ){
		wp_localize_script(
			'custom-js',
			'wp_vars',
			array(
				'url_front_page'  => get_home_url(),
				'slug_front_page' => $slug_front_page,
			)
		);
	}
}

// **************** FIM dos Scripts para fazer o efeito de rolagem do menu funcionar corretamente ****************


/* Função para adicionar classes a imagem que vem da biblioteca de midia */
function image_tag_class($class) {
    $class .= ' img-fluid';
    return $class;
}

function paginacao($query) {

	echo '<nav id="pagination">';
	global $wp_query;

	$pagina_atual = (int) $wp_query->get('paged');

	if (!$pagina_atual)
		$pagina_atual = 1;

	$total_paginas = (int) $query->max_num_pages;

	echo paginate_links(
		array(
			//'base' => str_replace($total_paginas + 1, '%#%', get_pagenum_link($total_paginas + 1)),
			'current' => $pagina_atual,
			'total' => $total_paginas,
			'prev_next'         => True,
			'prev_text'          	=> __('<i class="fa fa-chevron-left fa-2x" aria-hidden="true"></i>'),
			'next_text'          	=> __('<i class="fa fa-chevron-right fa-2x" aria-hidden="true"></i>'),
		)
	);
	echo '</nav>';
}

function custom_login_logo() {
//Altera o logo
    echo '<style type="text/css">
.login h1 a{ background-size: 273px 159px !important; width:323px; height:159px }
h1 a { background-image: url(' . get_bloginfo('template_directory') . '/img/logo_admin.png) !important; }
</style>';

//Altera a Imagem do Background
    echo '<style type="text/css">
body { background-image: url(' . get_bloginfo('template_directory') . '/img/bg-background.png) !important; }
</style>';
}

//Link na tela de login para a pÃ¡gina inicial
function my_login_logo_url() {
    return STM_URL;
}

function my_login_logo_url_title() {
    return STM_SITE_NAME;
}

define('__ROOT__', dirname(dirname(__FILE__)).'/patiodigital');

define('STM_URL', get_home_url());
define('STM_THEME_URL', get_bloginfo('template_url') . '/');
define('STM_SITE_NAME', get_bloginfo('name'));
define('STM_SITE_DESCRIPTION', get_bloginfo('description'));


if ($_GET && $_GET['lang'] == 'en') {
    require_once('includes/en.php');
} else {
    require_once('includes/pt.php');
}

//require_once 'classes/core.php';

// Inicialização das Classes
require_once 'classes/init.php';

require_once('classes/wp_bootstrap_navwalker.php');

