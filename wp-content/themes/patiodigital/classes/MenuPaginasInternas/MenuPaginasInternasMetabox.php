<?php

namespace Classes\MenuPaginasInternas;


class MenuPaginasInternasMetabox
{

	public function __construct()
	{
		add_action('add_meta_boxes',  array($this, 'metaBoxMenuAdd'));
		add_action('save_post', array($this, 'metaBoxMenuSave'));

	}

	public function metaBoxMenuAdd(){
	    //$templatePage = get_template_pag
		add_meta_box('meta-box-menu-paginas-internas', 'Seleção de menu para esta página', array($this,'metaBoxMenus'), 'page', 'normal', 'high');
	}

	public function metaBoxMenus(){


		global $post;
		$term_id = get_post_custom($post->ID);

		wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');

		$menuEscolhido = isset($term_id['meta_box_select_menus']) ? esc_attr($term_id['meta_box_select_menus'][0]) : '';

		$menuEscolhidoPosicao = isset($term_id['meta_box_select_menus_posicao']) ? esc_attr($term_id['meta_box_select_menus_posicao'][0]) : '';

		// Traz a lista de Menus Cadastrados
		$menus = wp_get_nav_menus();

		// Html
		echo '<tr class="form-field">';
		echo '<th>';
		echo '<h4>Escolha o Menu Desejado</h4>';
		echo '</th>';
		echo '<td>';
		echo '<select name="meta_box_select_menus" id="meta_box_select_menus">';
		echo '<option value="nenhum"> Nenhum</option>';
		foreach ($menus as $menu) { ?>
			<option value="<?php echo $menu->term_id ?>" <?php selected($menuEscolhido, $menu->term_id); ?>> <?php echo $menu->name ?></option>
			<?php
		}
		echo '</select>';
		echo '</td>';
        echo '</tr>';


		echo '<div id="esconder_campo_menu_posicao">'; // Para o Ajax
        if ($menuEscolhido != 'nenhum'){

            echo '<tr class="form-field">';
            echo '<th>';
            echo '<h4>Escolha a Posição do Menu</h4>';
            echo '</th>';
            echo '<td>';
            echo '<select name="meta_box_select_menus_posicao" id="meta_box_select_menus_posicao">'; ?>
            <option value="horizontal" <?php selected($menuEscolhidoPosicao, 'horizontal'); ?>> Horizontal</option>
            <option value="vertical" <?php selected($menuEscolhidoPosicao, 'vertical'); ?>> Vertical</option>
            <?php
            echo '</select>';
            echo '</td>';
            echo '</tr>';
		}
		echo '</div>';

		// Para o Ajax
		echo '<div id="exibir_campo_menu_posicao"></div>';



	}

	public function metaBoxMenuSave($term_id){

		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

		if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'my_meta_box_nonce')) return;

		if (!current_user_can('edit_post')) return;

		$menu_selecionado = ( isset( $_POST[ 'meta_box_select_menus' ] ) ) ? sanitize_text_field( $_POST[ 'meta_box_select_menus' ] ) : false;

		$menu_selecionado_posicao = ( isset( $_POST[ 'meta_box_select_menus_posicao' ] ) ) ? sanitize_text_field( $_POST[ 'meta_box_select_menus_posicao' ] ) : false;

		if ( $menu_selecionado ) {
			update_post_meta($term_id, 'meta_box_select_menus', esc_attr($_POST['meta_box_select_menus']));
		}

		if ( $menu_selecionado_posicao ) {
			update_post_meta($term_id, 'meta_box_select_menus_posicao', esc_attr($_POST['meta_box_select_menus_posicao']));
		}

	}

	public function exibirCampoMenuPosicao(){

		$ajaxMenuEscolhido = $_POST['ajaxMetaBoxSelectMenus'];

		$ajaxMenuEscolhidoPosicao = $_POST['ajaxMetaBoxSelectMenusPosicao'];

		if ($ajaxMenuEscolhido != 'nenhum'){

		    echo '<div>';
			echo '<tr class="form-field">';
			echo '<th>';
			echo '<h4>Escolha a Posição do Menu</h4>';
			echo '</th>';
			echo '<td>';
			echo '<select name="meta_box_select_menus_posicao" id="meta_box_select_menus_posicao">'; ?>
            <option value="horizontal" <?php selected($ajaxMenuEscolhidoPosicao, 'horizontal'); ?>> Horizontal</option>
            <option value="vertical" <?php selected($ajaxMenuEscolhidoPosicao, 'vertical'); ?>> Vertical</option>
			<?php
			echo '</select>';
			echo '</td>';
			echo '</tr>';
			echo '<div>';
		}

    }

}

new MenuPaginasInternasMetabox();