<?php

namespace Classes\Cpt;


class CptGrafico extends Cpt
{
	public function __construct()
	{

		$this->cptSlug = self::getCptSlugExtend();

		add_filter('manage_posts_columns', array($this, 'exibe_cols'), 20, 2);
		add_action('manage_' . $this->cptSlug . '_posts_custom_column', array($this, 'cols_content'));


	}

	//Exibindo as colunas no Dashboard
	public function exibe_cols($cols, $post_type)
	{

		if ($post_type == $this->cptSlug) {
			unset($cols['imagem']);
			$cols['categoria'] = 'Categoria';
			$cols['porcentagem'] = 'Porcentagem do Gráfico';

		}
		return $cols;
	}

	//Exibindo as informações correspondentes de cada coluna
	public function cols_content( $col )
	{
		//global $post;
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

			case 'porcentagem':
				$icone = get_field('escolha_a_porcentagem_a_ser_exibida_no_grafico');
				echo '<h1>'.$icone.'%</h1>';
				break;
		}
	}
}