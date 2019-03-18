<?php

namespace Classes\ModelosDePaginas\PaginaDestaques;



class PaginaDestaquesCpt
{

	/**
	 * @var string
	 *
	 * Set post type params
	 */
	protected $type                     = 'destaque';
	protected $slug                     = 'destaque';
	protected $name                     = 'Destaques';
	protected $singular_name            = 'Destaque';
	protected $taxonomy                 = 'categorias-destaque';
	protected $taxonomyLabel            = 'Categorias de Destaques';
	protected $taxonomySingularLabel    = 'Categoria de Destaques';
	protected $taxonomyRewrite          = 'destaques';

	protected $imagemUrl;
	/**
	 * Event constructor.
	 *
	 * When class is instantiated
	 */
	public function __construct() {

		// Register the post type
		add_action('init', array($this, 'register'));

		add_action('restrict_manage_posts',  array($this,'my_restrict_manage_posts_destaques'));

		//Exibindo as colunas no Dashboard
		add_filter( 'manage_posts_columns', array($this, 'exibe_cols' ), 10, 2 );

		//Exibindo as informações correspondentes de cada coluna no Dashboard
		add_action( 'manage_' . $this->slug . '_posts_custom_column', array( $this, 'cols_content' ) );

		add_filter( 'manage_edit-' . $this->slug . '_sortable_columns', array( $this, 'cols_sort' ) );

		add_filter( 'request', array( $this, 'orderby' ) );

		$this->loadDependencesAdmin();

	}

	public function loadDependencesAdmin()
	{
		if (is_admin()){
			add_action('init', array($this, 'custom_formats_admin'));
		}
	}

	public function custom_formats_admin()
	{
		wp_register_style('font_awesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
		wp_enqueue_style('font_awesome');
	}


	/**
	 * Register post type
	 */
	public function register() {
		$labels = array(
			'name' => _x($this->name, 'post type general name'),
			'singular_name' => _x($this->singular_name, 'post type singular name'),
			'add_new' => _x('Adicionar Novo', 'Novo item'),
			'add_new_item' => __('Novo Item'),
			'edit_item' => __('Editar Item'),
			'new_item' => __('Novo Item'),
			'view_item' => __('Ver Item'),
			'search_items' => __('Procurar Itens'),
			'not_found' =>  __('Nenhum registro encontrado'),
			'not_found_in_trash' => __('Nenhum registro encontrado na lixeira'),
			'parent_item_colon' => '',
			'menu_name' => $this->name
		);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'public_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'has_archive' => true,
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array('title','editor','excerpt')
		);

		register_post_type( $this->slug , $args );
		flush_rewrite_rules();

		register_taxonomy(
			$this->taxonomy,
			$this->slug,
			array(
				"label" => $this->taxonomyLabel,
				"singular_label" => $this->taxonomySingularLabel,
				'rewrite' => array( 'slug' => $this->taxonomyRewrite ),
				"hierarchical" => true
			)
		);

		/*		register_taxonomy(
					$this->taxonomy2,
					$this->slug,
					array(
						"label" => $this->taxonomyLabel2,
						"singular_label" => $this->taxonomySingularLabel2,
						'rewrite' => array( 'slug' => $this->taxonomyRewrite2 ),
						"hierarchical" => true
					)
				);*/
	}

	// Funções necessária para exibir o filtro de categorias nos produtos no Dashboard
	function my_restrict_manage_posts_destaques() {
		global $typenow;
		$taxonomy = 'categorias-destaque'; // taxonomia personalizada = categorias
		if ($typenow == 'destaque') { // custom post type = link
			$filters = array($taxonomy);
			foreach ($filters as $tax_slug) {
				//$tax_obj = get_taxonomy($tax_slug);
				//$tax_name = $tax_obj->labels->name;
				$terms = get_terms($tax_slug);
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>Ver todas as categorias</option>";
				foreach ($terms as $term) {
					echo '<option value=' . $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '', '>' . $term->name . ' (' . $term->count . ')</option>';
				}
				echo "</select>";
			}
		}
	}

	//Exibindo as colunas no Dashboard
	public function exibe_cols( $cols, $post_type )
	{

		if ( $post_type == $this->slug ) {
			$cols[ 'categoria']     = 'Categoria';
			$cols[ 'figura' ]        = 'Figura';
		}
		return $cols;
	}

	//Exibindo as informações correspondentes de cada coluna
	public function cols_content( $col )
	{
		global $post;
		switch ( $col ) {
			case 'categoria':
				$tax = '';
				$terms = get_the_terms( $post->ID, $this->taxonomy );
				foreach ( $terms as $t ) {
					if ( $tax ) $tax .= ', ';
					$tax .= $t->name;
				}
				echo $tax;
				break;

			case 'figura':
				if (get_field('escolha_a_imagem_deste_destaque')) {
					echo '<p><strong>Imagem</strong></p>';
					echo '<img src="' . get_field('escolha_a_imagem_deste_destaque') . '" width="75px">';

				}elseif (get_field('escolha_o_icone_deste_destaque')){
					echo '<p><strong>Ícone</strong></p>';
					echo '<p style="font-size: 30px;"><i class="fa ' . get_field('escolha_o_icone_deste_destaque') . '"><strong></i></p>';

				}elseif (get_field('escolha_a_numeracao_deste_destaque')) {
					echo '<p><strong>Numeração</strong></p>';
					echo '<p style="font-size: 30px;"><strong><span class="span-bigger-text-align-left">'.get_field('escolha_a_numeracao_deste_destaque').'</span></strong>';

				}else{
					echo '<img src="'.STM_THEME_URL.'img/sem-imagem-cadastrada.jpg" width="75px">';
				}
				break;
		}
	}

	// Permitindo a ordenação das colunas exibidas no Dashboard
	function cols_sort( $cols )
	{
		$cols[ 'categoria' ] = 'Categoria';
		return $cols;
	}

	function orderby( $vars )
	{
		if (is_admin()){
			if ( isset( $vars['orderby'] ) && $vars['orderby'] == 'categoria' ) {
				$vars['orderby'] = 'menu_order';
			}
		}

		return $vars;
	}


}

new PaginaDestaquesCpt();