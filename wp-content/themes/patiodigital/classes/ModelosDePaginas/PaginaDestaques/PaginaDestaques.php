<?php
/**
 * Created by PhpStorm.
 * User: ollyver
 * Date: 16/04/2018
 * Time: 10:28
 */

namespace Classes\ModelosDePaginas\PaginaDestaques;


use Classes\DesignPatterns\Factory;

class PaginaDestaques
{

	private  $pageIDfilha;
	private  $tipoDeDestaques;
	private  $corDosBoxesDestaques;
	private  $corDaFonteBoxes;
	private  $corDeFundoDosIconesDestaques;
	private  $corDosIconesDestaques;
	private  $corDaNumeracao;

	private  $imagemDoDestaque;
	private  $imagemEstiloIconeDoDestaque;
	private  $iconeDoDestaque;
	private  $numeracaoDoDestaque;

	private  $idTaxonomia;
	private  $quantidadeDestaquesPorLinha;
	private  $quantidadeTotalDeDestaques;
	private  $gridPaginaDestaques;
	private  $queryPaginaDestaques;

	private $desejaInibirLink;
	private $urlExterna;
	private $linkDoPost;
	private $targetDoPost;
	private $desejaAbrirUrlExternaEmUmaNovaAba;

	public function __construct($page_ID_filha)
	{
		$this->pageIDfilha = $page_ID_filha;

		$this->tipoDeDestaques = get_field('destaque_com_imagens_ou_boxes_ou_icones_ou_numeros', $page_ID_filha); //$page_ID veio do loop front page

		$this->corDosBoxesDestaques = get_field('escolha_a_cor_dos_boxes_destaques', $page_ID_filha); //$page_ID veio do loop front page
		$this->corDaFonteBoxes = get_field('escolha_a_cor_da_fonte_boxes', $page_ID_filha); //$page_ID veio do loop front page
		$this->corDeFundoDosIconesDestaques = get_field('escolher_a_cor_de_fundo_dos_icones_destaques', $page_ID_filha); //$page_ID veio do loop front page
		$this->corDosIconesDestaques = get_field('escolha_a_cor_dos_icones_destaques', $page_ID_filha); //$page_ID veio do loop front page
		$this->corDaNumeracao = get_field('escolha_a_cor_da_numeracao_destaques', $page_ID_filha); //$page_ID veio do loop front page


		$this->idTaxonomia = get_field('escolha_a_categoria_de_destaques_que_deseja_exibir_nesta_pagina', $page_ID_filha); //$page_ID veio do loop front page
		$this->quantidadeDestaquesPorLinha = get_field('quantidade_de_destaques_por_linha', $page_ID_filha); //$page_ID veio do loop front page
		$this->quantidadeTotalDeDestaques = get_field('quantidade_de_destaques', $page_ID_filha); //$page_ID veio do loop front page

		$this->gridPaginaDestaques();
		$this->montaQueryPaginaDestaques();
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


	public function gridPaginaDestaques(){

		$this->gridPaginaDestaques = (100 / $this->quantidadeDestaquesPorLinha) - 3;
		$this->gridPaginaDestaques .= '%';
	}

	public function montaQueryPaginaDestaques(){

		$args = array(
			'post_type' => 'destaque',
			'orderby' => 'title',
			'order' => 'ASC',
			'posts_per_page' => $this->quantidadeTotalDeDestaques,
			'tax_query' => array(
				array(
					'taxonomy' => 'categorias-destaque',
					'field' => 'term_id',
					'terms' => $this->idTaxonomia
				)
			)
		);

		$this->queryPaginaDestaques = new \WP_Query($args);

		$this->montaHtmlPaginaDestaques();
	}

	public function montaHtmlPaginaDestaques(){
		?>

		<div class="container">

			<div class="row">

				<?php
				//Exibe os destaques na quantidade escolhida da Categoria Destaques
				if ($this->queryPaginaDestaques->have_posts()) :
					$conta_posts = 0;
					?>
					<div class="container container-pagina-destaques-geral">
						<div class="row container-flexbox">
							<?php
							while ($this->queryPaginaDestaques->have_posts()) : $this->queryPaginaDestaques->the_post();


                            $this->imagemDoDestaque = get_field('escolha_a_imagem_deste_destaque');
                            $this->imagemEstiloIconeDoDestaque = get_field('escolha_a_imagem_estilo_icone_deste_destaque');

                            $this->iconeDoDestaque = get_field('escolha_o_icone_deste_destaque');
                            $this->numeracaoDoDestaque = get_field('escolha_a_numeracao_deste_destaque');

							$this->desejaInibirLink = trim(get_field('deseja_inibir_o_link'));
							$this->urlExterna = trim(get_field('url_externa'));
							$this->desejaAbrirUrlExternaEmUmaNovaAba = trim(get_field('deseja_abrir_em_uma_nova_aba'));

							if ($this->urlExterna != "") {
								$this->linkDoPost = $this->urlExterna;
								if($this->desejaAbrirUrlExternaEmUmaNovaAba == "sim"){
									$this->targetDoPost = '_blank';
								}else{
									$this->targetDoPost = "_self";
								}
							} else{
								$this->linkDoPost = get_the_permalink();
								$this->targetDoPost = "_self";
							}

							if ($this->desejaInibirLink == 'sim'){
								$this->linkDoPost = 'javascript:;';
								$this->targetDoPost = "_self";
							}

							if ($conta_posts == $this->quantidadeDestaquesPorLinha) {
							?>
						</div>
						<div class="row container-flexbox">
							<?php
							$conta_posts = 0;
							}

							if ($this->tipoDeDestaques == 'imagens'){
							    // Imagens (Card)
								$this->htmlDestaquesImagens();
							}elseif ($this->tipoDeDestaques == 'imagens_estilo_icone'){
								$this->htmlDestaquesImagensEstiloIcone();
							}elseif ($this->tipoDeDestaques == 'boxes'){
								$this->htmlDestaquesBoxes();
							}elseif ($this->tipoDeDestaques == 'icones'){
							    $this->htmlDestaquesIcones();

                            }elseif ($this->tipoDeDestaques == 'numeracao'){
							    $this->htmlDestaquesNumeracao();
                            }

							$conta_posts++;
							endwhile;
							?>
						</div>
					</div>
					<?php
				endif;
				wp_reset_postdata();
				?>
			</div>
		</div>

		<?php
	}

	// Imagens (Card)
	public function htmlDestaquesImagens(){
		?>
		<div class="card d-none d-sm-block wow zoomIn" style="flex-basis: <?= $this->gridPaginaDestaques ?>;">

            <?php if ($this->imagemDoDestaque["url"]) {
                ?>
                <div class="port-1 effect-3 container-img-pagina-destaques">
                    <a target="<?php echo $this->targetDoPost; ?>" href="<?php echo $this->linkDoPost; ?>"><img alt="<?= Factory::getAltTitleImagesCamposPersonalizados($this->imagemDoDestaque)['alt_imagem'] ?>" title="<?= Factory::getAltTitleImagesCamposPersonalizados($this->imagemDoDestaque)['title_imagem'] ?>" class="img-fluid aligncenter" src="<?= $this->imagemDoDestaque["url"] ?>"></a>
                </div>
            <?php } ?>
            <div class="card-body heigh-85">
                <h2 class="titulo-pagina-destaques">
                    <a target="<?php echo $this->targetDoPost; ?>" href="<?php echo $this->linkDoPost; ?>"><?php the_title(); ?></a>
                </h2>
                <div class="row sub-heading texto-pagina-destaques">
                    <a target="<?php echo $this->targetDoPost; ?>" href="<?php echo $this->linkDoPost; ?>"><?php the_excerpt(); ?></a>
                </div>
            </div>

            <div class="ml-4">
                <a class="btn btn-light btn-lg bt-pagina-destaques" target="<?php echo $this->targetDoPost; ?>" href="<?php echo $this->linkDoPost ?>">Veja Mais</a>
            </div>
		</div>

		<div class="card d-sm-none" style="flex-basis: <?= $this->gridPaginaDestaques ?>;">
			<?php if ($this->imagemDoDestaque["url"]) { ?>
            <div class="card-body">
				<div class="container-img-pagina-destaques">
					<a target="<?php echo $this->targetDoPost; ?>" href="<?php echo $this->linkDoPost ?>"><img alt="<?= Factory::getAltTitleImagesCamposPersonalizados($this->imagemDoDestaque)['alt_imagem'] ?>" title="<?= Factory::getAltTitleImagesCamposPersonalizados($this->imagemDoDestaque)['title_imagem'] ?>" class="img-fluid aligncenter" src="<?= $this->imagemDoDestaque["url"] ?>"></a>
				</div>
			<?php } ?>

                <h2 class="titulo-pagina-destaques">
                    <a target="<?php echo $this->targetDoPost; ?>" href="<?php echo $this->linkDoPost ?>"><?php the_title(); ?></a>
                </h2>

                <div class="row sub-heading texto-pagina-destaques">
                    <a target="<?php echo $this->targetDoPost; ?>" href="<?php echo $this->linkDoPost ?>"><?php the_excerpt(); ?></a>
                </div>
            </div>

            <div class="ml-4">
                <a class="btn btn-light btn-lg bt-pagina-destaques" target="<?php echo $this->targetDoPost; ?>" href="<?php echo $this->linkDoPost ?>">+ Veja Mais</a>
            </div>

		</div>

		<?php
	}

	public function htmlDestaquesImagensEstiloIcone(){
		?>
        <div class="card-imagens-estilo-icone border" style="padding:1%; flex-basis: <?= $this->gridPaginaDestaques ?>">
            <div class="row">
                <div class="col aligncenter">
                    <div class="heigh-55">
                        <?php if ($this->imagemEstiloIconeDoDestaque["url"]) { ?>
                            <a class="link-cinza" target="<?php echo $this->targetDoPost; ?>" href="<?php echo $this->linkDoPost; ?>">
                                <img alt="<?= Factory::getAltTitleImagesCamposPersonalizados($this->imagemEstiloIconeDoDestaque)['alt_imagem'] ?>" title="<?= Factory::getAltTitleImagesCamposPersonalizados($this->imagemEstiloIconeDoDestaque)['title_imagem'] ?>" class="img-fluid" src="<?= $this->imagemEstiloIconeDoDestaque["url"] ?>">
                            </a>
                        <?php } ?>
                    </div>
                    <div class="texto-pagina-destaques-imagens-estilo-icone">
                    <a class="link-cinza" target="<?php echo $this->targetDoPost; ?>" href="<?php echo $this->linkDoPost ?>"><?php the_content(); ?></a>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}

	public function htmlDestaquesBoxes(){
		?>

		<div class="card d-none d-md-block wow zoomIn" style="padding:1%; flex-basis: <?= $this->gridPaginaDestaques ?>; background-color: <?= $this->corDosBoxesDestaques?>">

			<h2>
				<span class="span-bigger"><a style="color: <?= $this->corDaFonteBoxes ?>" class="link-cinza" target="<?php echo $this->targetDoPost; ?>" href="<?php echo $this->linkDoPost; ?>"><?php the_title(); ?></a></span>
			</h2>
			<div class="row sub-heading">
				<span class="span-small"><a style="color: <?= $this->corDaFonteBoxes ?>" class="link-cinza" target="<?php echo $this->targetDoPost; ?>" href="<?php echo $this->linkDoPost; ?>"><?php the_excerpt(); ?></a></span>
			</div>
		</div>

		<div class="card d-block d-md-none" style="padding:1%; flex-basis: <?= $this->gridPaginaDestaques ?>; background-color: <?= $this->corDosBoxesDestaques?>">
			<h2>
				<span class="span-bigger"><a style="color: <?= $this->corDaFonteBoxes ?>" class="link-cinza" target="<?php echo $this->targetDoPost; ?>" href="<?php echo $this->linkDoPost; ?>"><?php the_title(); ?></a></span>
			</h2>
			<div class="row sub-heading">
				<span class="span-small"><a style="color: <?= $this->corDaFonteBoxes ?>" class="link-cinza" target="<?php echo $this->targetDoPost; ?>" href="<?php echo $this->linkDoPost; ?>"><?php the_excerpt(); ?></a></span>
			</div>

		</div>

		<?php

	}

	public function htmlDestaquesIcones(){
	    ?>

        <div class="card sem-borda" style="padding:1%; flex-basis: <?= $this->gridPaginaDestaques ?>; background-color: <?= $this->corDosBoxesDestaques?>">
            <div class='row container-pagina-destaques-icones'>
                <div class="wow fadeInLeft col-xs-12 col-sm-3 col-md-3 col-lg-3 texto-centralizado">
                    <i style="background-color: <?= $this->corDeFundoDosIconesDestaques ?>; color: <?= $this->corDosIconesDestaques ?>" class="fa <?php echo $this->iconeDoDestaque; ?>"></i>
                </div>
                <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                    <div class="row sub-heading-pagina-destaque-icone">

                    <h2>
                        <span class="span-bigger-text-align-left"><a style="color: <?= $this->corDaFonteBoxes ?>" class="link-cinza" target="<?php echo $this->targetDoPost; ?>" href="<?php echo $this->linkDoPost; ?>"><?php the_title(); ?></a></span>
                    </h2>

                        <a class="link-cinza" target="<?php echo $this->targetDoPost; ?>" href="<?php echo $this->linkDoPost ?>"><?php the_excerpt(); ?></a>
                    </div>
                </div>
            </div>
        </div>

        <?php

    }

    public function htmlDestaquesNumeracao(){
	    ?>
        <div class="card sem-borda" style="padding:1%; flex-basis: <?= $this->gridPaginaDestaques ?>;">
            <div class='row'>
                <div class="wow fadeInLeft col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <span class="pagina-destaques-numeros aligncenter" style="color: <?= $this->corDaNumeracao ?>"><?= $this->numeracaoDoDestaque ?></span>
                </div>
                <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                    <div class="row">
                    <h2>
                        <span class="span-bigger-text-align-left"><a style="color: <?= $this->corDaFonteBoxes ?>" class="link-cinza" target="<?php echo $this->targetDoPost; ?>" href="<?php echo $this->linkDoPost; ?>"><?php the_title(); ?></a></span>
                    </h2>

                        <a class="link-cinza" target="<?php echo $this->targetDoPost; ?>" href="<?php echo $this->linkDoPost ?>"><?php the_excerpt(); ?></a>
                    </div>
                </div>
            </div>
        </div>
        <?php

    }

}