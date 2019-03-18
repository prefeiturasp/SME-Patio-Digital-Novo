<?php

namespace Classes\PaginaContato;


use Classes\PaginaFilha\PaginaFilha;
use Classes\DesignPatterns\Factory;

class PaginaContato
{
	private $pageId;
	private $insira_o_shortcode_gerado_pelo_plugin_de_formularios;
	private $imagem_lado_esquerdo;
	private $link_imagem_lado_esquerdo;
	private $url_imagem;

	public function __construct()
	{
		$this->pageId = PaginaFilha::getIdPaginaCorreta();
		$this->insira_o_shortcode_gerado_pelo_plugin_de_formularios = get_field('insira_o_shortcode_gerado_pelo_plugin_de_formularios', $this->pageId);
		$this->imagem_lado_esquerdo = get_field('imagem_lado_esquerdo', $this->pageId);
		$this->verificaLinkImagem();
		$this->montaHtmlPaginaContato();
	}

	public function verificaLinkImagem(){
		$this->link_imagem_lado_esquerdo = get_field('link_imagem_lado_esquerdo', $this->pageId);
        if (trim($this->link_imagem_lado_esquerdo) !== ''){
            $this->url_imagem = $this->link_imagem_lado_esquerdo;
        }else{
			$this->url_imagem = 'javascript:;';
        }
	}

	public function montaHtmlPaginaContato(){
		?>
		<div class="container">
			<div class="row">

					<div class="col-12 col-md-7 container-form-pagina-contato">
						<?= do_shortcode($this->insira_o_shortcode_gerado_pelo_plugin_de_formularios) ?>
					</div>
					<div class="col-12 col-md-5 d-flex align-items-start">
						<a class="cem-porcento" href="<?= $this->url_imagem ?>"><img alt="<?= Factory::getAltTitleImagesCamposPersonalizados($this->imagem_lado_esquerdo)['alt_imagem'] ?>" title="<?= Factory::getAltTitleImagesCamposPersonalizados($this->imagem_lado_esquerdo)['title_imagem'] ?>" class="img-fluid aligncenter" src="<?= $this->imagem_lado_esquerdo['url'] ?>" alt="" title=""/></a>
					</div>

			</div>
		</div>
		<?php
	}

}