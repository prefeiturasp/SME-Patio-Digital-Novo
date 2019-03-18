<?php

namespace Classes\MenuPaginasInternas;


use Classes\PaginaFilha\PaginaFilha;

class MenuPaginasInternasExibir
{
	private $existeMenu;
	private $menuEscolhido;
	private $menuEscolhidoPosicao;

	public function __construct($post, $page_ID_filha)
	{
	    $this->verificaSeExisteMenuCadastrado();
	}

	public function setExisteMenu($existeMenu)
	{
		$this->existeMenu = $existeMenu;
	}

	public function getExisteMenu()
	{
		return $this->existeMenu;
	}

	public function setMenuEscolhidoPosicao($menuEscolhidoPosicao)
	{
		$this->menuEscolhidoPosicao = $menuEscolhidoPosicao;
	}

	public function getMenuEscolhidoPosicao()
	{
		return $this->menuEscolhidoPosicao;
	}

	public function verificaSeExisteMenuCadastrado()
	{
		$this->menuEscolhido = get_post_meta(PaginaFilha::getIdPaginaCorreta(), 'meta_box_select_menus', true);
        $this->menuEscolhidoPosicao = get_post_meta(PaginaFilha::getIdPaginaCorreta(), 'meta_box_select_menus_posicao', true);

		if ($this->menuEscolhido != 'nenhum' && $this->menuEscolhido > 0) {
			$this->setExisteMenu(true);
			$this->setMenuEscolhidoPosicao($this->menuEscolhidoPosicao);
		} else {
			$this->setExisteMenu(false);
		}

	}

	public function ExibeMenu()
	{
		?>
		<?php
		if ($this->menuEscolhidoPosicao == 'vertical') {
			$divColunas = 'col-12 col-md-3';
			$menuClass = 'sm sm-vertical sm-simple main-menu';
		} else {
			$divColunas = 'col-12';
			$menuClass = 'sm sm-simple main-menu';
		}
		?>

        <div class="<?= $divColunas ?>">
            <div class="row padding-top-15 padding-bottom-30">
                <nav class="navbar navbar-expand-lg navbar-light bg-light cem-porcento" id="main-nav">
					<?php
					wp_nav_menu(array(
						'menu' => $this->menuEscolhido,
						'depth' => 4,
						'menu_class' => $menuClass,
						'container_class' => 'cem-porcento',
					));
					?>
                </nav>
            </div>
        </div>

		<?php
	}

}