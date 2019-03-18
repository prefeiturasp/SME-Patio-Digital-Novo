<?php

namespace Classes\BlocosDeLayout;


use Classes\PaginaFilha\PaginaFilha;

class BlocosDeLayoutMetabox
{
	private static $instance;
	const URL_IMAGES = STM_THEME_URL.'classes/assets/img/';


	public static function getInstance(){
		if (self::$instance == NULL){
			self::$instance= new self();
		}
		return self::$instance;
	}

	public function __construct()
	{

		add_action('add_meta_boxes',  array($this, 'metaBoxAdd'));
		add_action('save_post', array($this, 'metaBoxSave'));
		$this->loadDependencesAdmin();
	}

	public function metaBoxAdd(){
		add_meta_box('metabox-blocos-de-layout', 'Seleção de blocos de layout para esta página', array($this,'metaBoxBlocosDeLayout'), 'page', 'normal', 'high');

	}

	public function metaBoxBlocosDeLayout(){

		wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');

		$values = get_post_custom(get_the_ID());
		$editor = isset($values['meta_box_editor']) ? esc_attr($values['meta_box_editor'][0]) : '';
	?>

        <div class="container-grid">

            <h1>Ollyver <?= get_the_ID() ?></h1>

            <div class="inside grid-4-colunas">
                <h4>Imagem a esquerda e texto a direita</h4>
                <img src="<?= self::URL_IMAGES ?>img-a-esquerda-texto-a-direita.jpg">
                <p>
                    <input class="button-primary" type="submit" name="bt_layout_img_esq_txt_dir" id="bt_layout_img_esq_txt_dir" value="<?php esc_attr_e( 'Inserir Bloco de Layout' ); ?>" />
                </p>
            </div>
            <!-- .inside -->
            <div class="inside grid-4-colunas">
                <h4>Imagens lado a lado</h4>
                <img src="<?=self::URL_IMAGES ?>imagem-lado-a-lado.jpg">
                <p>
                    <input class="button-primary" type="submit" name="bt_layout_img_lado_a_lado" value="<?php esc_attr_e( 'Inserir Bloco de Layout' ); ?>" />
                </p>
            </div>
            <!-- .inside -->
            <div class="inside grid-4-colunas">
                <p><?php esc_attr_e( 'WordPress started in 2003 with a single bit of code to enhance the typography of everyday writing and with fewer users than you can count on your fingers and toes. Since then it has grown to be the largest self-hosted blogging tool in the world, used on millions of sites and seen by tens of millions of people every day.',
                        'WpAdminStyle' ); ?></p>
            </div>
            <!-- .inside -->

            <!-- .inside -->
            <div class="inside grid-4-colunas">
                <p><?php esc_attr_e( 'WordPress started in 2003 with a single bit of code to enhance the typography of everyday writing and with fewer users than you can count on your fingers and toes. Since then it has grown to be the largest self-hosted blogging tool in the world, used on millions of sites and seen by tens of millions of people every day.',
                        'WpAdminStyle' ); ?></p>
            </div>
            <!-- .inside -->


            <br class="clear">
        </div>

        <?php
		// Exibindo o Editor de Texto no Dashboard
		$content = get_post_meta(get_the_ID(), 'meta_box_editor', true);
		$content = htmlspecialchars_decode($content);
		$editor_id = 'meta_box_editor';
		//wp_editor($content, $editor_id);

		wp_editor( $content,  $editor_id );
		\_WP_Editors::enqueue_scripts();
		print_footer_scripts();
		\_WP_Editors::editor_js();
        ?>

        <div id="exibir_bloco_layout_img_esquerda_texto_direito"></div>

		<?php

	}

	public function addBlocoLayoutImgEsquerdaTextoDireita(){
	    ?>


            <p>
                <input id="img_esquerda_layout_img_esquerda_texto_direita" name="img_esquerda_layout_img_esquerda_texto_direita[]" type="text" value="" />
                <button id="escolher_img_esquerda_layout_img_esquerda_texto_direita">Escolher imagem</button>
            </p>

            <script>
                $('#escolher_img_esquerda_layout_img_esquerda_texto_direita').click(function(){
                    wp.media.editor.send.attachment = function(props, attachment){
                        $('#img_esquerda_layout_img_esquerda_texto_direita').val(attachment.url);
                    };
                    wp.media.editor.open(this);
                    return false;
                });
            </script>

            <?php

            // Exibindo o Editor de Texto no Dashboard
            $content = get_post_meta(get_the_ID(), 'meta_box_editor', true);
            $content = htmlspecialchars_decode($content);
            $editor_id = 'meta_box_editor';
            //wp_editor($content, $editor_id);

			wp_editor( $content,  $editor_id );
			\_WP_Editors::enqueue_scripts();
			print_footer_scripts();
			\_WP_Editors::editor_js();

            ?>


        <?php
    }

    public function metaBoxSave(){
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
		if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'my_meta_box_nonce')) return;
		if (!current_user_can('edit_post')) return;

		$campo_sanitizado_img_esquerda_layout_img_esquerda_texto_direita = $this->sanitizeCampos('img_esquerda_layout_img_esquerda_texto_direita');
		update_post_meta(get_the_ID(), 'img_esquerda_layout_img_esquerda_texto_direita', $campo_sanitizado_img_esquerda_layout_img_esquerda_texto_direita);
		update_post_meta(get_the_ID(), 'meta_box_editor', $_POST['meta_box_editor']);

    }

	public function loadDependencesAdmin()
	{
		if (is_admin()){
			add_action('init', array($this, 'custom_formats_admin'));
		}
	}

	public function custom_formats_admin()
	{
		wp_register_style('bloco-de-layout-admin', STM_THEME_URL . 'classes/assets/css/bloco-de-layout-admin.css', null, null, 'all');
		wp_enqueue_style('bloco-de-layout-admin');

		wp_register_script('add-bloco-layout', STM_THEME_URL . 'classes/assets/js/add-bloco-layout.js', array('jquery'), 1.0, false);
		wp_enqueue_script('add-bloco-layout');
		wp_localize_script('add-bloco-layout', 'bloginfo', array('ajaxurl' => admin_url('admin-ajax.php')));

		add_action('wp_ajax_addBlocoLayoutImgEsquerdaTextoDireita', array($this,'addBlocoLayoutImgEsquerdaTextoDireita'));
		add_action('wp_ajax_nopriv_addBlocoLayoutImgEsquerdaTextoDireita', array($this,'addBlocoLayoutImgEsquerdaTextoDireita'));

	}

	public function sanitizeCampos($campo){

		if ($campo){
			// Good idea to make sure things are set before using them
			$campo = isset( $_POST[$campo] ) ? (array) $_POST[$campo] : array();

			// Any of the WordPress data sanitization functions can be used here
			$campoSanitizado = array_map( 'sanitize_text_field', $campo );

			return $campoSanitizado;

		}else{
			return;
		}
	}


}

BlocosDeLayoutMetabox::getInstance();