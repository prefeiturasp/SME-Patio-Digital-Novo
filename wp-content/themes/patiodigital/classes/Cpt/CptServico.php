<?php

namespace Classes\Cpt;


class CptServico extends Cpt
{

	public function __construct()
	{

		$this->cptSlug = self::getCptSlugExtend();

		add_filter('manage_posts_columns', array($this, 'exibe_cols'), 10, 2);
		add_action('manage_' . self::getCptSlugExtend() . '_posts_custom_column', array($this, 'cols_content'));

	}

	//Exibindo as colunas no Dashboard
	public function exibe_cols($cols, $post_type)
	{

		if ($post_type == $this->cptSlug) {

			$cols['icone'] = 'Ícone';
			$cols['info'] = 'Info Serviço';

		}
		return $cols;
	}

	//Exibindo as informações correspondentes de cada coluna
	public function cols_content( $col )
	{

		//global $post;
		switch ( $col ) {
			case 'icone':
				$icone = get_field('escolha_um_icone_servicos');
				echo '<h1><i class="fa '.$icone.'"></i></h1>';
				break;

			case 'info':
				$info = get_field('caracteristicas_dos_servicos');
				echo '<h4>'.$info.'</h4>';
				break;
		}
	}

}