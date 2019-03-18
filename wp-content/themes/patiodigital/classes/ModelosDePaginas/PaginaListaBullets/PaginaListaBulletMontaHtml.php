<?php

namespace Classes\ModelosDePaginas\PaginaListaBullets;


class PaginaListaBulletMontaHtml
{

	private $retornoIdPaginaCorreta;

    private $qtdColunas;
    private $qtdItensPorColuna;
    private $itensBullets;
    private $iconeBullets;
    private $fontSelector;
    private $colorPickerCorDaFonte;
    private $colorPickerCorDoBullet;

	private $numeroDeColunas;
	private $inicioArrayItensBullets;
	private $tamanhoArrayItensBullets;

	public function __construct($retornoIdPaginaCorreta)
	{
        $this->retornoIdPaginaCorreta = $retornoIdPaginaCorreta;
		$this->qtdColunas = $this->getPostMeta($this->retornoIdPaginaCorreta, 'input_qtd_de_colunas', true);
		$this->qtdItensPorColuna = $this->getPostMeta($this->retornoIdPaginaCorreta, 'input_qtd_de_itens_por_coluna', true);
		$this->itensBullets = $this->getPostMeta($this->retornoIdPaginaCorreta, 'itens_bullets', true);
		$this->iconeBullets = $this->getPostMeta($this->retornoIdPaginaCorreta, 'select_bullets', true);
		$this->fontSelector = $this->getPostMeta($this->retornoIdPaginaCorreta, 'font-selector', true);
		$this->colorPickerCorDaFonte = $this->getPostMeta($this->retornoIdPaginaCorreta, 'color_picker_cor_da_fonte', true);
		$this->colorPickerCorDoBullet = $this->getPostMeta($this->retornoIdPaginaCorreta, 'color_picker_cor_do_bullet', true);

		$this->incluiEstiloInline();

		$this->getNumeroColunas();
		$this->montaHtmlPaginaListaBullets();

	}

	public function __set($name, $value)
	{
		// TODO: Implement __set() method.
		$this->$name = $value;
	}

	public function __get($name)
	{
		// TODO: Implement __get() method.
		return $this->$name;
	}


	public static function __callStatic($name, $arguments){
		if (strpos($name,'upper') !== false) {
			return strtoupper($arguments[0]);
		}
	}



	public function incluiEstiloInline(){
		add_action('wp_head', array(self::hook_css()));
	}

	public function hook_css(){
		?>
        <style>
            @import url('https://fonts.googleapis.com/css?family=<?= $this->fontSelector ?>');
            #texto-lista-bullet-<?= $this->retornoIdPaginaCorreta ?> {
                font-family: <?= $this->fontSelector ?>;
                color: <?= $this->colorPickerCorDaFonte ?>;
            }
            #icones-pagina-lista-bullets-id-<?= $this->retornoIdPaginaCorreta ?>{
                color: <?= $this->colorPickerCorDoBullet ?>;

            }
        </style>
		<?php
    }



	private function getNumeroColunas(){
		$this->numeroDeColunas = (100 / $this->qtdColunas)-3;
		$this->numeroDeColunas .= '%';
    }

	private function arraySlice($arr, $ini, $end) {
		// O terceiro parâmetro como true, preserva os índices.
		return array_slice($arr, $ini, $end, true);
	}

	private function montaHtmlPaginaListaBullets(){
	    ?>

            <div class="container">
                <div class="container-flexbox center">
                    <?php
                    $this->montaColunas();
                    ?>
                </div>
            </div>

        <?php

	}


	private function montaColunas(){

		$this->inicioArrayItensBullets = 0;
		$this->tamanhoArrayItensBullets = $this->qtdItensPorColuna;

		for ($i = 1; $i <= $this->qtdColunas; $i++) {

            echo '<div class="item">';
            $this->montaItensBullets();
            echo '</div>';
			$this->inicioArrayItensBullets = $this->inicioArrayItensBullets + $this->qtdItensPorColuna;

		}

    }

	private function montaItensBullets(){


		$array = $this->arraySlice($this->itensBullets, $this->inicioArrayItensBullets, $this->tamanhoArrayItensBullets);
		foreach ($array as $valor){
			echo '<p id="texto-lista-bullet-'.$this->retornoIdPaginaCorreta.'"><strong><i id="icones-pagina-lista-bullets-id-'.$this->retornoIdPaginaCorreta.'" class="icones-pagina-lista-bullets '.$this->iconeBullets.'"></i> '.$valor.'</strong></p>';
		}
    }

    public function getPostMeta($idPost, $metaKey, $simples=true){
	    return get_post_meta($idPost, $metaKey, $simples );

    }


}