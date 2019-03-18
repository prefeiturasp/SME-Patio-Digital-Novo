<?php

namespace Classes\ModelosDePaginas\PaginaListaBullets;

class PaginaListaBullets
{

	public function __construct()
	{
		$this->loadDependencesAdmin();
		$this->loadDependences();
	}

	public function loadDependencesAdmin()
	{
		if (is_admin()){
			add_action('init', array($this, 'custom_formats_admin'));
			add_action( 'admin_enqueue_scripts', array($this, 'wp_enqueue_color_picker' ));
		}
	}

	public function loadDependences(){
		if (!is_admin()){
			add_action('init', array($this, 'custom_formats_admin'));


		}
	}

	public function custom_formats_admin()
	{
		wp_register_script('ajax-pagina-lista-bullets-js', STM_THEME_URL . 'classes/assets/js/ajax-pagina-lista-bullets.js', array('jquery'), 1.0, false);
		wp_enqueue_script('ajax-pagina-lista-bullets-js');
		wp_localize_script('ajax-pagina-lista-bullets-js', 'bloginfo', array('ajaxurl' => admin_url('admin-ajax.php')));

		wp_register_script('googleFontsSelect-js', STM_THEME_URL . 'classes/assets/js/googleFontsSelect.js', array('jquery'), 1.0, false);
		wp_enqueue_script('googleFontsSelect-js');

		add_action('wp_ajax_addStructureBox', array(new PaginaListaBulletsMetaBox(),'addStructureBox'));
		add_action('wp_ajax_deletaPostMeta', array(new PaginaListaBulletsMetaBox(),'deletaPostMeta'));

		add_action('wp_ajax_addStructureBox', array(new PaginaListaBulletsMetaBox(),'addStructureBox'));
		add_action('wp_ajax_nopriv_deletaPostMeta', array(new PaginaListaBulletsMetaBox(),'deletaPostMeta'));

		add_action('wp_ajax_verificaUltimaAtualizacaoFontSelector', array(new PaginaListaBulletsMetaBox(),'verificaUltimaAtualizacaoFontSelector'));
		add_action('wp_ajax_nopriv_verificaUltimaAtualizacaoFontSelector', array(new PaginaListaBulletsMetaBox(),'verificaUltimaAtualizacaoFontSelector'));

		wp_register_style('pagina-lista-bullet-css', STM_THEME_URL . 'classes/assets/css/pagina-lista-bullets.css', null, null, 'all');
		wp_enqueue_style('pagina-lista-bullet-css');
		wp_enqueue_style('pagina-lista-bullets-estilo-dinamico-css');

	}

	public function custom_formats(){
	}

public function wp_enqueue_color_picker(){
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker');
	wp_register_script('colorPicker-js', STM_THEME_URL . 'classes/assets/js/colorPicker.js', array('jquery'), 1.0, false);
	wp_enqueue_script('colorPicker-js');


}


}

new PaginaListaBullets();