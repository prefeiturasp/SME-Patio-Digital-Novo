<?php
namespace Classes;

use Classes\MenuPaginasInternas\MenuPaginasInternasMetabox;

class LoadDependences
{
	private static $instance;

	protected function __construct(){
		$this->loadDependencesPublic();
		$this->loadDependencesAdmin();
	}

	public static function getInstance(){
		if (self::$instance == NULL){
			self::$instance= new self();
		}
		return self::$instance;
	}

	/**
	 * Método clone do tipo privado previne a clonagem dessa instância
	 * da classe
	 *
	 * @return void
	 */
	private function __clone()
	{
	}

	/**
	 * Método unserialize do tipo privado para prevenir a desserialização
	 * da instância dessa classe.
	 *
	 * @return void
	 */
	private function __wakeup()
	{
	}

	public function loadDependencesPublic(){
		if (!is_admin()){
			add_action('init', array($this, 'custom_formats_public'));
		}
	}

	public function loadDependencesAdmin(){

		if (is_admin()){
			add_action('init', array($this, 'custom_formats_admin'));
		}
	}

	public function custom_formats_public(){
		wp_register_style('breadcrumb', STM_THEME_URL . 'classes/assets/css/breadcrumb.css', null, null, 'all');
		wp_enqueue_style('breadcrumb');

		wp_register_style('bt_call_to_action_public', STM_THEME_URL . 'classes/assets/css/bt-call-to-action-public.css', null, null, 'all');
		wp_enqueue_style('bt_call_to_action_public');

		wp_register_style('responsive-slider', STM_THEME_URL . 'classes/assets/css/responsive-slider.css', null, null, 'all');
		wp_enqueue_style('responsive-slider');

		wp_register_style('portfolio-public', STM_THEME_URL . 'classes/assets/css/portfolio-public.css', null, null, 'all');
		wp_enqueue_style('portfolio-public');

		wp_register_style('pagina-contato-public', STM_THEME_URL . 'classes/assets/css/pagina-contato-public.css', null, null, 'all');
		wp_enqueue_style('pagina-contato-public');

		wp_register_style('pagina-depoimentos-public', STM_THEME_URL . 'classes/assets/css/pagina-depoimentos-public.css', null, null, 'all');
		wp_enqueue_style('pagina-depoimentos-public');

		wp_register_style('pagina-destaques-public', STM_THEME_URL . 'classes/assets/css/pagina-destaques-public.css', null, null, 'all');
		wp_enqueue_style('pagina-destaques-public');

		wp_register_style('pagina-imagem-destacada-topo-public', STM_THEME_URL . 'classes/assets/css/pagina-imagem-destacada-topo-public.css', null, null, 'all');
		wp_enqueue_style('pagina-imagem-destacada-topo-public');

		wp_register_style('pagina-mapa-public', STM_THEME_URL . 'classes/assets/css/pagina-mapa-public.css', null, null, 'all');
		wp_enqueue_style('pagina-mapa-public');

		wp_register_style('numeros-randomicos', STM_THEME_URL . 'classes/assets/css/numeros-randomicos.css', null, null, 'all');
		wp_enqueue_style('numeros-randomicos');

		wp_register_style('pagina-servicos-public', STM_THEME_URL . 'classes/assets/css/pagina-servicos-public.css', null, null, 'all');
		wp_enqueue_style('pagina-servicos-public');

		wp_register_style('pagina-texto-esquerda-imagem-direita-public', STM_THEME_URL . 'classes/assets/css/pagina-texto-esquerda-imagem-direita-public.css', null, null, 'all');
		wp_enqueue_style('pagina-texto-esquerda-imagem-direita-public');

		wp_register_style('pagina-thumb-esquerdo-texto-direita-public', STM_THEME_URL . 'classes/assets/css/pagina-thumb-esquerdo-texto-direita-public.css', null, null, 'all');
		wp_enqueue_style('pagina-thumb-esquerdo-texto-direita-public');

		wp_register_style('smart_menu_core', STM_THEME_URL . 'classes/assets/css/sm-core-css.css', null, null, 'all');
		wp_register_style('smart_menu_simple', STM_THEME_URL . 'classes/assets/css/sm-simple.css', null, null, 'all');

		wp_register_style('loop-category', STM_THEME_URL . 'classes/assets/css/loop-category.css', null, null, 'all');
		wp_enqueue_style('loop-category');

		wp_register_style('loop-single', STM_THEME_URL . 'classes/assets/css/loop-single.css', null, null, 'all');
		wp_enqueue_style('loop-single');

		wp_register_style('search-form', STM_THEME_URL . 'classes/assets/css/search-form.css', null, null, 'all');
		wp_enqueue_style('search-form');

		wp_register_script('portfolio-public', STM_THEME_URL . 'classes/assets/js/portfolio-public.js', array('jquery'), 1.0, true);
		wp_enqueue_script('portfolio-public');

		wp_register_script('responsive-slider', STM_THEME_URL . 'classes/assets/js/responsive-slider.js', array('jquery'), 1.0, true);
		wp_enqueue_script('responsive-slider');

		wp_register_script('numeros-randomicos', STM_THEME_URL . 'classes/assets/js/numeros-randomicos.js', array('jquery'), 1.0, true);
		wp_enqueue_script('numeros-randomicos');

		wp_register_script('smart_menu_js', STM_THEME_URL . 'classes/assets/js/jquery.smartmenus.js', array('jquery'), 1.0, false);
		wp_register_script('smart_menu_inicializacao_js', STM_THEME_URL . 'classes/assets/js/jquery-smartmenus-inicializacao.js', array('jquery'), 1.0, false);

		wp_enqueue_script('smart_menu_js');
		wp_enqueue_script('smart_menu_inicializacao_js');
	}

	public function custom_formats_admin(){
		wp_register_style('portfolio-admin', STM_THEME_URL . 'classes/assets/css/portfolio-admin.css', null, null, 'all');
		wp_enqueue_style('portfolio-admin');

		wp_register_script('ajax-exibe-campo-posicao-menu-js', STM_THEME_URL . 'classes/assets/js/ajax-exibe-campo-posicao-menu.js', array('jquery'), 1.0, false);

		wp_localize_script('ajax-exibe-campo-posicao-menu-js', 'bloginfo', array('ajaxurl' => admin_url('admin-ajax.php')));

		wp_enqueue_script('ajax-exibe-campo-posicao-menu-js');

		add_action('wp_ajax_exibirCampoMenuPosicao', array(new MenuPaginasInternasMetabox(),'exibirCampoMenuPosicao'));
		add_action('wp_ajax_nopriv_exibirCampoMenuPosicao', array(new MenuPaginasInternasMetabox(),'exibirCampoMenuPosicao'));

	}

}

LoadDependences::getInstance();