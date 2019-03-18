<?php

namespace Classes\TemplateHierarchy\Portfolio;

use Classes\DesignPatterns\Factory;
use Classes\ModelosDePaginas\PaginaNumeroRandomicos;

class SinglePortfolio
{
    private $galeria;
    private $galeriaArray;
    private $deseja_exibir_imagem_e_texto_complementar;
    private $imagem_complementar;
    private $textoComplementar;

	public function __construct()
	{
	    $this->getFields();
		$this->montaConteudoSinglePortfolio();
	}

	public function getFields(){
	    $this->galeria =  get_field('escolha_as_imagens_do_portfolio');
	    $this->galeriaArray = explode(',', $this->galeria);
	    $this->deseja_exibir_imagem_e_texto_complementar = get_field('deseja_exibir_imagem_e_texto_complementar');
	    $this->imagem_complementar = get_field('selecione_a_imagem_complementar');
	    $this->textoComplementar = get_field('insira_o_texto_complementar');
    }

    public function getPhotoGalery(){

		if ($this->galeria) {

			echo '<div class="container">';
			echo '<div class="row">';

			echo '<h2 class="titulos-single-portfolio">Galeria de Fotos</h2>';

			foreach ($this->galeriaArray as $imgId) {
				echo '<div class="col-12 col-md-6 col-lg-6 col-xl-4 padding-bottom-15">';
				echo '<a data-rel="lightbox-gallery-single-portfolio" href="' . wp_get_attachment_url($imgId) . '"">';
				echo '<img class="img-fluid aligncenter" src="' . wp_get_attachment_url($imgId) . '"/>';
				echo '</a>';
				echo '</div>';
			}

			echo '</div>';
			echo '</div>';

		}

    }

    public function getImagemTextoComplementar(){

	    if ($this->deseja_exibir_imagem_e_texto_complementar === 'sim'){
	        ?>
                <div class="col-12">
                    <div class="row">
                        <div class='container'>
                            <h2 class="mt-4 mb-4">Participação da comunidade escolar</h2>
                                <div class="container-post-thumbnail-single-portfolio">
                                    <img class="img-fluid alignleft" src="<?= $this->imagem_complementar["sizes"]["medium"] ?>" alt="<?= Factory::getAltTitleImagesCamposPersonalizados($this->imagem_complementar)['alt_imagem']?>" title="<?= Factory::getAltTitleImagesCamposPersonalizados($this->imagem_complementar)['title_imagem']?>" />
                               </div>
                            <?= apply_filters('the_content', $this->textoComplementar); ?>
                        </div>
                    </div>
                </div>
            <?php
        }
    }

	public function montaConteudoSinglePortfolio()
	{
		if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="col-12">
                <div class="row">
                    <div class='container'>
                        <h1 class="titulo-taxonomias">
                            <?php the_title(); ?>
                        </h1>
                        <?php if (has_post_thumbnail()) {
                            echo '<div class="container-post-thumbnail-single-portfolio">';
                            the_post_thumbnail('medium', array('class' => 'img-fluid alignright', 'alt' => Factory::getAltTitleImagesThePostThumbnail()['alt'], 'title' => Factory::getAltTitleImagesThePostThumbnail()['title']));
                            echo '</div>';
                        } ?>
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
		<?php
		endwhile;
		else: ?>
            <p>
				<?php _e('Não existem posts cadastrados.', 'patiodigital'); ?>
            </p>
		<?php endif;

		new PaginaNumeroRandomicos\PaginaNumeroRandomicos();

		$this->getImagemTextoComplementar();

		$this->getPhotoGalery();


	}

}