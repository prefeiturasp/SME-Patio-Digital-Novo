<?php
/* Inicialização das Classes */
//require_once __ROOT__.'./classes/XTestes/aula04Singleton.php';
//require_once __ROOT__.'/classes/BlocosDeLayout/BlocosDeLayout.php';
//require_once __ROOT__.'/classes/BlocosDeLayout/BlocosDeLayoutMetabox.php';

require_once __ROOT__.'./classes/LoadDependences.php';

require_once __ROOT__.'/classes/SliderResponsivo/SliderResponsivo.php';

require_once __ROOT__.'/classes/DesignPatterns/Factory.php';

require_once __ROOT__.'/classes/PaginaFilha/PaginaFilha.php';
require_once __ROOT__.'/classes/Breadcrumbs/Breadcrumbs.php';

require_once __ROOT__.'/classes/MenuPaginasInternas/MenuPaginasInternasMetabox.php';
require_once __ROOT__.'/classes/MenuPaginasInternas/MenuPaginasInternasExibir.php';

require_once __ROOT__.'/classes/ModelosDePaginas/PaginaDestaques/PaginaDestaques.php';
require_once __ROOT__.'/classes/ModelosDePaginas/PaginaAbas/PaginaAbas.php';
require_once __ROOT__.'/classes/ModelosDePaginas/PaginaListaBullets/PaginaListaBullets.php';
require_once __ROOT__.'/classes/ModelosDePaginas/PaginaListaBullets/PaginaListaBulletsMetaBox.php';
require_once __ROOT__.'/classes/ModelosDePaginas/PaginaListaBullets/PaginaListaBulletMontaHtml.php';
require_once __ROOT__.'/classes/ModelosDePaginas/PaginaDepoimentos/PaginaDepoimentos.php';
require_once __ROOT__.'/classes/ModelosDePaginas/PaginaGraficos/PaginaGraficos.php';
require_once __ROOT__.'/classes/ModelosDePaginas/PaginaImagemDestacadaTopo/PaginaImagemDestacadaTopo.php';
require_once __ROOT__.'/classes/ModelosDePaginas/PaginaMapa/PaginaMapa.php';
require_once __ROOT__.'/classes/ModelosDePaginas/PaginaNumerosRandomicos/PaginaNumeroRandomicos.php';
require_once __ROOT__.'/classes/ModelosDePaginas/PaginaPostsAlternados/PaginaPostsAlternados.php';
require_once __ROOT__.'/classes/ModelosDePaginas/PaginaServicos/PaginaServicos.php';
require_once __ROOT__.'/classes/ModelosDePaginas/PaginaTextoEsquerdaImagemDireita/PaginaTextoEsquerdaImagemDireita.php';
require_once __ROOT__.'/classes/ModelosDePaginas/PaginaContato/PaginaContato.php';
require_once __ROOT__.'/classes/ModelosDePaginas/PaginaThumbEsquerdoTextoDireita/PaginaThumbEsquerdoTextoDireita.php';

require_once __ROOT__.'/classes/BtCallToAction/BtCallToAction.php';

require_once __ROOT__.'/classes/Cpt/Cpt.php';
require_once __ROOT__.'/classes/Cpt/CptDestaque.php';
require_once __ROOT__.'/classes/Cpt/CptServico.php';
require_once __ROOT__.'/classes/Cpt/CptGrafico.php';
require_once __ROOT__.'/classes/Cpt/CptSliderResponsivo.php';
require_once __ROOT__.'/classes/Cpt/CptDepoimento.php';

require_once __ROOT__.'/classes/TemplateHierarchy/Portfolio/ArchivePortfolio.php';
require_once __ROOT__.'/classes/TemplateHierarchy/Portfolio/ArchivePortfolioDescricaoCpt.php';
require_once __ROOT__.'/classes/TemplateHierarchy/Portfolio/SinglePortfolio.php';

require_once __ROOT__.'/classes/TemplateHierarchy/Category/LoopCategory.php';
require_once __ROOT__.'/classes/TemplateHierarchy/Category/LoopSingle.php';

require_once __ROOT__.'/classes/TemplateHierarchy/NotFound/Loop404.php';

require_once __ROOT__.'/classes/TemplateHierarchy/Search/LoopSearch.php';
require_once __ROOT__.'/classes/TemplateHierarchy/Search/SearchForm.php';


//require_once __ROOT__.'/classes/autoload.php';

/* Inicialização CPTs */
$cptSliderResponsivo = new \Classes\Cpt\Cpt('slider_responsivo', 'slider_responsivo', 'Sliders Responsivos', 'Todos os Sliders', 'Sliders Responsivos', 'Slider Responsivo', 'categorias-slider_responsivo', 'Categorias de Slider Responsivo', 'Categoria de Slider Responsivo', 'dashicons-format-image');
$cptSliderResponsivoExtend = new \Classes\Cpt\CptSliderResponsivo();
$cptSliderDestaque = new \Classes\Cpt\Cpt('destaque', 'destaque', 'Destaques', 'Todos os Destaques', 'Destaques', 'Destaque', 'categorias-destaque', 'Categorias de Destaques', 'Categoria de Destaque', 'dashicons-star-filled');
$cptSliderDestaqueExtend = new \Classes\Cpt\CptDestaque();
$cptServico = new \Classes\Cpt\Cpt('servico', 'servico', 'Serviços', 'Todos os Sliders', 'Serviços', 'Serviço', 'categorias-servico', 'Categorias de Serviços', 'Categorias de Serviços', 'dashicons-awards');
$cptServicoExtend = new \Classes\Cpt\CptServico();
$cptDepoimento = new \Classes\Cpt\Cpt('depoimento', 'depoimento', 'Depoimentos', 'Todos os Depoimentos', 'Depoimentos', 'Depoimento', 'categorias-depoimento', 'Categorias de Depoimentos', 'Categoria de Depoimento', 'dashicons-megaphone');
$cptDepoimentoExtend = new \Classes\Cpt\CptDepoimento();
$cptNumerosRandomicos = new \Classes\Cpt\Cpt('numero_randomico', 'numero_randomico', 'Números Randômicos', 'Todos os Números Randômicos', 'Números Randômicos', 'Número Randômico', 'categorias-numero-randomico', 'Categorias de Números Randômicos', 'Categoria de Número Randômico', 'dashicons-dashboard');
$cptPortfolio = new \Classes\Cpt\Cpt('portfolio', 'portfolio', 'Portfólio', 'Todos os Portfólios', 'Portfólios', 'Portfólio', 'portfolios', 'Categorias de Portfólios', 'Categoria de Portfólio', 'dashicons-art');