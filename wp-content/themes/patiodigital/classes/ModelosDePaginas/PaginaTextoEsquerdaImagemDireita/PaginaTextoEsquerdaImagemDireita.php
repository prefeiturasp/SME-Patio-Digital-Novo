<?php

namespace Classes\ModelosDePaginas\PaginaTextoEsquerdaImagemDireita;

use Classes\PaginaFilha\PaginaFilha;
use Classes\DesignPatterns\Factory;


class PaginaTextoEsquerdaImagemDireita
{

	private $page_id;
	private $get_post;
	private $post_title;
	private $post_content;

	private $escolha_a_imagem_texto_esquerda_imagem_direita;

	private $deseja_exibir_imagem_ou_cor_de_background;
	private $escolha_a_cor_de_background;
	private $escolha_a_imagem_de_background;
	private $estilo_background;
	private $escolha_a_cor_do_texto;

	private $escolha_o_texto_do_botao;
	private $escolha_a_cor_do_botao;
	private $escolha_a_cor_do_texto_do_botao;

	private $deseja_exibir_botao_ou_imagem_como_botao;
	private $escolha_a_imagem_do_botao;
	private $botao_definitivo;

	private $escolha_o_link_do_botao;
	private $deseja_abrir_o_link_em_uma_nova_aba;
	private $target;


	public function __construct()
	{
		$this->page_id = PaginaFilha::getIdPaginaCorreta();
		$this->get_post = get_post( $this->page_id);
		$this->post_title = get_post( $this->page_id)->post_title;
		$this->post_content = get_post( $this->page_id)->post_content;
		$this->escolha_a_imagem_texto_esquerda_imagem_direita = get_field('escolha_a_imagem_texto_esquerda_imagem_direita', $this->page_id);
		$this->deseja_exibir_imagem_ou_cor_de_background = get_field('deseja_exibir_imagem_ou_cor_de_background', $this->page_id);
		$this->escolha_a_cor_de_background = get_field('escolha_a_cor_de_background', $this->page_id);
		$this->escolha_a_imagem_de_background = get_field('escolha_a_imagem_de_background', $this->page_id);
		$this->escolha_a_cor_do_texto = get_field('escolha_a_cor_do_texto', $this->page_id);
		$this->escolha_o_texto_do_botao = get_field('escolha_o_texto_do_botao', $this->page_id);

		$this->deseja_exibir_botao_ou_imagem_como_botao = get_field('deseja_exibir_botao_ou_imagem_como_botao', $this->page_id);

		$this->escolha_o_link_do_botao = get_field('escolha_o_link_do_botao', $this->page_id);
		$this->deseja_abrir_o_link_em_uma_nova_aba = get_field('deseja_abrir_o_link_em_uma_nova_aba', $this->page_id);
		$this->escolha_a_cor_do_botao = get_field('escolha_a_cor_do_botao', $this->page_id);
		$this->escolha_a_cor_do_texto_do_botao = get_field('escolha_a_cor_do_texto_do_botao', $this->page_id);

		$this->escolha_a_imagem_do_botao = get_field('escolha_a_imagem_do_botao', $this->page_id);
		$this->configuracoesPagina();
		$this->montaHtmlPaginaTextoEsquerdaImagemDireita();
	}



    public function configuracoesPagina(){
		$array_image_btn = $this->escolha_a_imagem_do_botao;

	    if ($this->deseja_exibir_imagem_ou_cor_de_background === 'cor'){
			$this->estilo_background = 'background-color: '.$this->escolha_a_cor_de_background;
        }elseif ($this->deseja_exibir_imagem_ou_cor_de_background === 'imagem'){
			$this->estilo_background = 'background: url('.$this->escolha_a_imagem_de_background['url'].') center center no-repeat;';
        }else{
			$this->estilo_background = 'background: none';
        }

	    if (trim($this->escolha_o_link_do_botao) === ''){
			$this->escolha_o_link_do_botao = 'javascript:;';
        }

	    if ($this->deseja_abrir_o_link_em_uma_nova_aba === 'sim'){
            $this->target = '_blank';
        }else{
	        $this->target = '_self';
        }

		if (trim($this->deseja_exibir_botao_ou_imagem_como_botao) === 'imagem_como_botao'){
			$this->botao_definitivo = '<a target="'.$this->target.'" href="'.$this->escolha_o_link_do_botao.'"><img alt="'.Factory::getAltTitleImagesCamposPersonalizados($array_image_btn)['alt_imagem'].'" title="'.Factory::getAltTitleImagesCamposPersonalizados($array_image_btn)['title_imagem'].'" class="botao-como-imagem" src="'.$this->escolha_a_imagem_do_botao['url'].'"></a>';
        }else{
			$this->botao_definitivo = '<a target="'.$this->target.'" style="background-color: '.$this->escolha_a_cor_do_botao.'; border-color: '.$this->escolha_a_cor_do_botao.'; color: '.$this->escolha_a_cor_do_texto_do_botao.'" href="'.$this->escolha_o_link_do_botao.'" class="btn btn-primary btn-lg mx-auto">'.$this->escolha_o_texto_do_botao.'</a>';
		}

    }

	public function montaHtmlPaginaTextoEsquerdaImagemDireita(){
	    $array_image = $this->escolha_a_imagem_texto_esquerda_imagem_direita;
		?>
		<div class="alimentacao-escolar" style="<?= $this->estilo_background ?>">
			<div class="container">
				<div class="row">
					<div class="col-12 col-md-12 col-lg-6 col-xl-6">
						<h2 style="color: <?= $this->escolha_a_cor_do_texto ?> !important;"><?= $this->post_title ?></h2>
						<p style="color: <?= $this->escolha_a_cor_do_texto ?>"><?=  apply_filters('the_content',$this->post_content) ?></p>
                        <?php
						echo $this->botao_definitivo;
                        ?>
					</div>
					<div class="col-12 col-md-12 col-lg-6 col-xl-6">
						<img src="<?= $array_image['url'] ?>" class="img-fluid aligncenter d-none d-lg-block" alt="<?= Factory::getAltTitleImagesCamposPersonalizados($array_image)['alt_imagem']?>" title="<?= Factory::getAltTitleImagesCamposPersonalizados($array_image)['title_imagem'] ?>">
					</div>
				</div>
			</div>
		</div>
		<?php

	}
}
