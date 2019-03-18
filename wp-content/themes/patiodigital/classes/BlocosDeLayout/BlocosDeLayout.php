<?php

namespace Classes\BlocosDeLayout;

use Classes\PaginaFilha\PaginaFilha;


class BlocosDeLayout {
	public function __construct()
	{
		echo '<h1>Ollyver Entrei BlocosDeLayout '.PaginaFilha::getIdPaginaCorreta().'</h1>';

	}
}