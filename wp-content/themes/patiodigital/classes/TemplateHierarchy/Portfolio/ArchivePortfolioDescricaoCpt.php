<?php

namespace Classes\TemplateHierarchy\Portfolio;


class ArchivePortfolioDescricaoCpt
{

	public function __construct()
	{
		add_action('admin_menu', array($this, 'descricaoPortfolio'));
	}

	function descricaoPortfolio()
	{
		// Criando o item Descrição do Portfolio no CPT Portfolio
		//add_submenu_page('menu-personalizado', 'Página de opções Submenu Home', 'Home', 'manage_options', 'menu-personalizado' );

		add_submenu_page('edit.php?post_type=portfolio', 'Descrição do Portfolio','Descrição do Portfolio','manage_options','descricao-portfolio',array($this, 'pagina_de_configuracoes'));

	}

	public 	function pagina_de_configuracoes() {


        if (!empty($_POST)) {
			$descricao_portfolio = $_POST['descricao-portfolio'];

			update_option('descricao_portfolio', $descricao_portfolio);

			echo '<div class="updated"><p>Opção atualizada com sucesso!</p></div>';
		}

		?>
		<div>
			<h2><span class="dashicons dashicons-format-aside icone-titulo-pagina-de-configuracoes"></span><?php _e( 'Insira a Descrição do Portfólio', 'patiodigital' ); ?></h2>
		</div>

		<form method="post" action="<?php echo admin_url('admin.php?page=descricao-portfolio'); ?>">
			<textarea id="" name="descricao-portfolio" cols="80" rows="10"><?= get_option('descricao_portfolio') ?></textarea><br>
			<p><input type="submit" value="Atualizar Descrição"></p>
		</form>

		<?php
	}

}

new ArchivePortfolioDescricaoCpt();