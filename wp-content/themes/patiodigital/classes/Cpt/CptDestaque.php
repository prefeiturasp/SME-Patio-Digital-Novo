<?php

namespace Classes\Cpt;

class CptDestaque extends Cpt
{

	public function __construct()
	{
		$this->cptSlug = self::getCptSlugExtend();

		//Exibindo as colunas no Dashboard
		add_filter('manage_posts_columns', array($this, 'exibe_cols'), 10, 2);
		add_action('manage_' . $this->cptSlug . '_posts_custom_column', array($this, 'cols_content'));

	}

	//Exibindo as colunas no Dashboard
	public function exibe_cols($cols, $post_type)
	{

		if ($post_type == $this->cptSlug) {

			$cols['imagem'] = 'Imagem';
		}
		return $cols;
	}

	//Exibindo as informações correspondentes de cada coluna
	public function cols_content( $col )
	{

     	switch ( $col ) {
			case 'categoria':
				$tax = '';
				$terms = get_the_terms( get_the_ID(), self::getTaxonomyExtend() );
				if ($terms) {
					foreach ($terms as $t) {
						if ($tax) $tax .= ', ';
						$tax .= $t->name;
					}
				}
				echo $tax;
				break;

			case 'imagem':

				if (get_field('escolha_a_imagem_deste_destaque')) {
					echo '<p><strong>Imagem</strong></p>';
					echo '<img src="' . get_field('escolha_a_imagem_deste_destaque')["sizes"]["thumbnail"] . '" width="75px">';

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


}