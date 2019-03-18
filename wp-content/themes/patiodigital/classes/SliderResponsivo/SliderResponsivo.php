<?php

namespace Classes\SliderResponsivo;


class SliderResponsivo
{
    private static $sliderFoiExibido;

	private $pageId;
	private $desejaExibirSlider;
	private $sliderDoTemaOuExterno;
	private $categoriaSliderResponsivo;
	private $shortcodeGeradoPeloPlugin;

	private $querySliderResponsivo;

	private $desejaExibirTextoNesteSlider;
	private $corDaFonte;
	private $desejaExibirSombra;
	private $corDaSombra;

	private $desejaLinkParaEsteSlider;
	private $linkSlider;
	private $targetLink;

	private $desejaExibirMascaraNaImagem;
	private $escolhaACorDaMascaraNaImagem;

	public function __construct($pageId)
	{
		$this->pageId = $pageId;
		$this->desejaExibirSlider = get_field('deseja_exibir_slider', $this->pageId);
		$this->sliderDoTemaOuExterno =  get_field('slider_do_tema_ou_externo', $this->pageId);
		$this->categoriaSliderResponsivo = get_field('escolha_a_categoria_de_sliders_que_deseja_incluir', $this->pageId);
		$this->shortcodeGeradoPeloPlugin = do_shortcode(get_field('shortcode_gerado_pelo_plugin', $this->pageId));

		$this->montaQuerySliderResponsivo();
	}

	/**
	 * @return mixed
	 */
	public static function getSliderFoiExibido()
	{
		return self::$sliderFoiExibido;
	}

	/**
	 * @param mixed $sliderFoiExibido
	 */
	public static function setSliderFoiExibido($sliderFoiExibido)
	{
		self::$sliderFoiExibido = $sliderFoiExibido;
	}


	public function __set($name, $value)
	{
		$this->$name = $value;
	}

	public function __get($name)
	{
		return $this->$name;
	}

	public function geraLinkSlider(){
		if ($this->desejaLinkParaEsteSlider && $this->linkSlider != ''){
			$this->linkSlider = get_field('url_slider');
			if ($this->targetLink){
				$this->targetLink = '_blank';
			}else{
				$this->targetLink = '_self';
			}
		}else{
			$this->linkSlider = 'javascript:;';
		}
	}

	public function setaParametrosSlides(){
		$this->desejaExibirTextoNesteSlider = get_field('deseja_exibir_texto_neste_slider');
		$this->corDaFonte = get_field('escolha_a_cor_da_fonte');
		$this->desejaExibirSombra = get_field('sim_ou_não_exibir_sombras');
		$this->corDaSombra = get_field('cor_da_sombra');
		$this->desejaLinkParaEsteSlider = get_field('deseja_link_para_este_slider');
		$this->linkSlider = trim(get_field('url_slider'));
		$this->targetLink = get_field('link_slider_em_nova_aba');
		$this->desejaExibirMascaraNaImagem = get_field('deseja_exibir_mascara_na_imagem');
		$this->escolhaACorDaMascaraNaImagem = get_field('escolha_a_cor_da_mascara_na_imagem');
    }

    public function verificaSeExibeMascaraNaImagem(){

	    if ($this->desejaExibirMascaraNaImagem === 'sim'){
	       $hex =  $this->hex2rgb($this->escolhaACorDaMascaraNaImagem);

        }else{
			$hex ='';
        }

	    return $hex;

    }

    public function hex2rgb($hexColor)
	{
		$shorthand = (strlen($hexColor) == 4);

		list($r, $g, $b) = $shorthand? sscanf($hexColor, "#%1s%1s%1s") : sscanf($hexColor, "#%2s%2s%2s");

		return implode([
			"r" => hexdec($shorthand? "$r$r" : $r),
			"g" => hexdec($shorthand? "$g$g" : $g),
			"b" => hexdec($shorthand? "$b$b" : $b)
		], ',');
	}

	public function montaQuerySliderResponsivo()
	{
		if ($this->desejaExibirSlider) {

			if ($this->sliderDoTemaOuExterno == 'tema') {


				$args = array(
					'post_type' => 'slider_responsivo',
					'posts_per_page' => 1,
					'orderby'        => 'rand',
					'order' => 'ASC',
					'tax_query' => array(
						array(
							'taxonomy' => 'categorias-slider_responsivo',
							'field' => 'term_id',
							'terms' => $this->categoriaSliderResponsivo,
						)
					)
				);

				$this->querySliderResponsivo = new \WP_Query($args);

				$this->exibeSliderResponsivo();

			}elseif ($this->sliderDoTemaOuExterno == 'externo'){

				echo $this->shortcodeGeradoPeloPlugin;
			}

		}else{
			return;
		}

	}

	public function exibeSliderResponsivo(){
		?>

			<?php

			while ($this->querySliderResponsivo->have_posts()) : $this->querySliderResponsivo->the_post();

			    $this->setaParametrosSlides();

				$this->geraLinkSlider();

			    $hexadecimal = $this->verificaSeExibeMascaraNaImagem();

			    echo '<div style="--my-color-var: '.$hexadecimal.';" class="d-flex flex-row align-items-center bg-img-slider-unico">';

				if ($this->desejaExibirTextoNesteSlider){

					echo '<div class="container-texto-slider-unico align-items-center padding-lef-texto-slider">';

					if ($this->desejaExibirSombra){
						?>


                        <div class="d-flex flex-column">
                            <h3 class="titulo-slider-unico wow fadeInRight">
                                <a href="<?php echo $this->linkSlider ?>" target="<?php echo $this->targetLink ?>" style="color:<?php echo $this->corDaFonte ?>; text-shadow:0 1px 0 <?php echo $this->corDaSombra ?> "><?php the_title() ?></a>
                            </h3>
                            <h4 class="texto-slider-unico wow fadeInLeft">
                                <a href="<?php echo $this->linkSlider ?>" target="<?php echo $this->targetLink ?>" style="color:<?php echo $this->corDaFonte ?>; text-shadow:0 1px 0 <?php echo $this->corDaSombra ?> "><?php the_content() ?></a>
                            </h4>
                            <a href="<?= $this->linkSlider ?>" target="<?= $this->targetLink ?>" class="btn btn-primary-slider btn-lg">Confira</a>
                        </div>

						<?php
					}else{ ?>


                        <div class="d-flex flex-column margin-lef-texto-slider">
                            <h3 class="titulo-slider-unico wow fadeInRight float-none">
                                <a href="<?php echo $this->linkSlider ?>" target="<?php echo $this->targetLink ?>" style="color:<?php echo $this->corDaFonte ?>"><?php the_title() ?></a>
                            </h3>
                            <h4 class="texto-slider-unico wow fadeInLeft">
                                <a href="<?php echo $this->linkSlider ?>" target="<?php echo $this->targetLink ?>" style="color:<?php echo $this->corDaFonte ?>; text-shadow:0 1px 0"><?php the_content() ?></a>
                            </h4>
                           <a href="<?= $this->linkSlider ?>" target="<?= $this->targetLink ?>" class="btn btn-primary-slider btn-lg">Confira</a>
                        </div>

						<?php
					}
					echo '</div>';
				}

				?>
                <a class="link-slider-unico cem-porcento" href="<?php echo $this->linkSlider ?>" target="<?php echo $this->targetLink ?>"><?php the_post_thumbnail('full', array('class' => 'img-fluid cem-porcento', 'alt'=> get_the_title(), 'title'=> get_the_title()))?></a>
			<?php
            echo '</div>';
			endwhile;
			wp_reset_postdata();
			?>

		<?php

	}

}