<?php

namespace Classes\ModelosDePaginas\PaginaListaBullets;


class PaginaListaBulletsMetaBox
{

	private static $postId;
	private static $pageTemplate;
	protected static $itensBullets;
	protected static $qtdColunas;
	protected static $qtdItensPorColuna;
	protected static $iconeBullets;

	protected static $corDaFonte;
	protected static $corDoIconeBullet;
	protected static $googleFonts;

	protected $dtPrimeiraAtualizacao = '23-04-2018';
	protected $dtAtualizacaAtual;
	protected $dtProximaAtualizacao;

	public function __construct()
	{
		add_action('add_meta_boxes',  array($this, 'metaBoxAdd'));
		add_action('save_post', array($this, 'metaBoxSave'));

	}


	public static function getPostId(){
		if (self::$postId == NULL){
			self::$postId = get_the_ID();
		}
		return self::$postId;
	}
	public static function getPageTemplate(){
		if (self::$pageTemplate == NULL){
			self::$pageTemplate = get_post_meta(self::getPostId(), '_wp_page_template', true);
		}
		return self::$pageTemplate;
	}

	public static function getIensBullets(){
		if (self::$itensBullets == NULL){
			self::$itensBullets = get_post_meta(self::getPostId(), 'itens_bullets', 'false');
		}
		return self::$itensBullets;
	}

	public static function getQtdItensPorColuna(){
		if (self::$qtdItensPorColuna == NULL){
			self::$qtdItensPorColuna = get_post_meta(self::getPostId(), 'input_qtd_de_itens_por_coluna', 'true');
		}
		return self::$qtdItensPorColuna;
	}

	public static function getQtdColunas(){
		if (self::$qtdColunas == NULL){
			self::$qtdColunas = get_post_meta(self::getPostId(), 'input_qtd_de_colunas', 'true');
		}
		return self::$qtdColunas;
	}

	public static function getIconeBullet(){
		if (self::$iconeBullets == NULL){
			self::$iconeBullets = get_post_meta(self::getPostId(), 'select_bullets', 'true');
		}
		return self::$iconeBullets;
	}

	public static function getCorDaFonte(){
		if (self::$corDaFonte == NULL){
			self::$corDaFonte = get_post_meta(self::getPostId(), 'color_picker_cor_da_fonte', 'true');
		}
		return self::$corDaFonte;
	}

	public static function getCorIconeBullet(){
		if (self::$corDoIconeBullet == NULL){
			self::$corDoIconeBullet = get_post_meta(self::getPostId(), 'color_picker_cor_do_bullet', 'true');
		}
		return self::$corDoIconeBullet;
	}

	public static function getGoogleFonts(){
		if (self::$googleFonts == NULL){
			self::$googleFonts = get_post_meta(self::getPostId(), 'font-selector', 'true');
		}
		return self::$googleFonts;
	}

	public function metaBoxAdd(){
		if (self::getPageTemplate() == 'pagina-lista-bullets.php'){
			add_meta_box('meta-box-add-itens-lista-bullets', 'Configurações da Lista de Bullets', array($this,'metaBoxAddItensListaBullets'), 'page', 'normal', 'high');
		}
	}

	public function metaBoxAddItensListaBullets(){
		wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');

		$values = get_post_custom(self::getPostId());

		// Passando o post id para o Ajax
		echo '<input id="inputHiddenPostId" name="inputHiddenPostId" type="hidden" value="'.self::getPostId().'">';

		echo '<div>';
		echo '<h4>Adicione os itens que deseja exibir na lista </h4>';
		// Botão que adiciona os campos de texto
		echo '<p><input class="addItensBullets" type="button" value="Adicionar Itens"></p>';

		if (self::getIensBullets()){

		    foreach (self::getIensBullets() as $posicao => $valor){
		        ?>
                <p class="paragrafoPai">
                    <input class="input_itens_bullets" type="text" name="itens_bullets[]" id="itens_bullets" value="<?php echo $valor ?>"/>
                    <button class="excluir_iten_bullet">X</button>
                </p>
                <?php
            }
        }

		// Para o Ajax Adicionar e Exibir os campos inputs para os itens da lista criados
		echo '<div style="display: inline" id="exibir_itens_lista_bullets"></div>';
		echo '</div>';

		echo '<div>';
		echo '<h4>Quantas Colunas deseja exibir?</h4>';
		?>
        <input class="regular-text" type="number" id="input_qtd_de_colunas" name="input_qtd_de_colunas" value="<?= $values['input_qtd_de_colunas'][0]?>">
		<?php
		echo '</div>';

		echo '<div>';
		echo '<h4>Quantos itens deseja exibir por coluna?</h4>';
		?>
            <input class="regular-text" type="number" id="input_qtd_de_itens_por_coluna" name="input_qtd_de_itens_por_coluna" value="<?= $values['input_qtd_de_itens_por_coluna'][0]?>">
        <?php
		echo '</div>';

		echo '<div>';

		echo '<h4>Escolha um Bullet para a Lista</h4>';
		$select_bullets = isset($values['select_bullets']) ? esc_attr($values['select_bullets'][0]) : '';

        ?>

        <select name="select_bullets" id="select_bullets">
            <option value="fa fa-certificate" <?php selected($select_bullets, 'fa fa-certificate'); ?> >&#xf0a3; fa fa-certificate	</option>
            <option value="fa fa-chain" <?php selected($select_bullets, 'fa fa-chain'); ?> >&#xf0c1; fa fa-chain </option>
            <option value="fa fa-chain-broken" <?php selected($select_bullets, 'fa fa-chain-broken'); ?> >&#xf127; fa fa-chain-broken </option>
            <option value="fa fa-check" <?php selected($select_bullets, 'fa fa-check'); ?> >&#xf00c; fa fa-check </option>
            <option value="fa fa-check-circle" <?php selected($select_bullets, 'fa fa-check-circle'); ?> >&#xf058; fa fa-check-circle </option>
            <option value="fa fa-check-circle-o" <?php selected($select_bullets, 'fa fa-check-circle-o'); ?> >&#xf05d; fa fa-check-circle-o </option>
            <option value="fa fa-check-square" <?php selected($select_bullets, 'fa fa-check-square'); ?> >&#xf14a; fa fa-check-square </option>
            <option value="fa fa-check-square-o" <?php selected($select_bullets, 'fa fa-check-square-o'); ?> >&#xf046; fa fa-check-square-o </option>
            <option value="fa fa-chevron-circle-down" <?php selected($select_bullets, 'fa fa-chevron-circle-down'); ?> >&#xf13a; fa fa-chevron-circle-down </option>
            <option value="fa fa-chevron-circle-left" <?php selected($select_bullets, 'fa fa-chevron-circle-left'); ?> >&#xf137; fa fa-chevron-circle-left </option>
            <option value="fa fa-chevron-circle-right" <?php selected($select_bullets, 'fa fa-chevron-circle-right'); ?> >&#xf138; fa fa-chevron-circle-right </option>
            <option value="fa fa-chevron-circle-up" <?php selected($select_bullets, 'fa fa-chevron-circle-up'); ?> >&#xf139; fa fa-chevron-circle-up </option>
            <option value="fa fa-chevron-down" <?php selected($select_bullets, 'fa fa-chevron-down'); ?> >&#xf078; fa fa-chevron-down </option>
            <option value="fa fa-chevron-left" <?php selected($select_bullets, 'fa fa-chevron-left'); ?> >&#xf053; fa fa-chevron-left </option>
            <option value="fa fa-chevron-right" <?php selected($select_bullets, 'fa fa-chevron-right'); ?> >&#xf054; fa fa-chevron-right </option>
            <option value="fa fa-chevron-up" <?php selected($select_bullets, 'fa fa-chevron-up'); ?> >&#xf077; fa fa-chevron-up </option>
            <option value="fa fa-child" <?php selected($select_bullets, 'fa fa-child'); ?> >&#xf1ae; fa fa-child </option>
            <option value="fa fa-adjust" <?php selected($select_bullets, 'fa fa-adjust'); ?> >&#xf042; fa fa-adjust </option>
            <option value="fa fa-align-center" <?php selected($select_bullets, 'fa fa-align-center'); ?> >&#xf037; fa fa-align-center </option>
            <option value="fa fa-align-justify" <?php selected($select_bullets, 'fa fa-align-justify'); ?> >&#xf039; fa fa-align-justify </option>
            <option value="fa fa-align-left" <?php selected($select_bullets, 'fa fa-align-left'); ?> >&#xf036; fa fa-align-left </option>
            <option value="fa fa-align-right" <?php selected($select_bullets, 'fa fa-align-right'); ?> >&#xf038; fa fa-align-right </option>
            <option value="fa fa-archive" <?php selected($select_bullets, 'fa fa-chain-broken'); ?> >&#xf187; fa fa-archive	</option>
            <option value="fa fa-area-chart" <?php selected($select_bullets, 'fa fa-area-chart'); ?> >&#xf1fe; fa fa-area-chart </option>
            <option value="fa fa-arrow-circle-down" <?php selected($select_bullets, 'fa fa-arrow-circle-down'); ?> >&#xf0ab; fa fa-arrow-circle-down</option>
            <option value="fa fa-arrow-circle-left" <?php selected($select_bullets, 'fa fa-arrow-circle-left'); ?> >&#xf0a8; fa fa-arrow-circle-left </option>
            <option value="fa fa-arrow-circle-o-down" <?php selected($select_bullets, 'fa fa-arrow-circle-o-down'); ?> >&#xf01a; fa fa-arrow-circle-o-down	</option>
            <option value="fa fa-arrow-circle-o-left" <?php selected($select_bullets, 'fa fa-arrow-circle-o-left'); ?> >&#xf190; fa fa-arrow-circle-o-left	</option>
            <option value="fa fa-arrow-circle-o-right" <?php selected($select_bullets, 'fa fa-arrow-circle-o-right'); ?> >&#xf18e; fa fa-arrow-circle-o-right </option>
            <option value="fa fa-arrow-circle-o-up" <?php selected($select_bullets, 'fa fa-arrow-circle-o-up'); ?> >&#xf01b; fa fa-arrow-circle-o-up </option>
            <option value="fa fa-arrow-circle-right" <?php selected($select_bullets, 'fa fa-arrow-circle-right'); ?> >&#xf0a9; fa fa-arrow-circle-right </option>
            <option value="fa fa-arrow-circle-up" <?php selected($select_bullets, 'fa fa-arrow-circle-up'); ?> >&#xf0aa; fa fa-arrow-circle-up </option>
            <option value="fa fa-arrow-down" <?php selected($select_bullets, 'fa fa-arrow-down'); ?> >&#xf063; fa fa-arrow-down </option>
            <option value="fa fa-arrow-left" <?php selected($select_bullets, 'fa fa-arrow-left'); ?> >&#xf060; fa fa-arrow-left </option>
            <option value="fa fa-arrow-right" <?php selected($select_bullets, 'fa fa-arrow-right'); ?> >&#xf061; fa fa-arrow-right	</option>
            <option value="fa fa-arrow-up" <?php selected($select_bullets, 'fa fa-arrow-up'); ?> >&#xf062; fa fa-arrow-up </option>

        </select>

        <?php
		echo '</div>';

		echo '<div>';
		?>

        <h4><strong><label for="color_picker_cor_da_fonte">Escolha a Cor da Fonte</label></strong></h4>
        <p>
            <input type="text" class="colorPicker" name="color_picker_cor_da_fonte" value="<?php echo $values['color_picker_cor_da_fonte'][0]; ?>" data-default-color="#e5e5e5" />
        </p>
        <?php
		echo '</div>';

		echo '<div>';
		?>

        <h4>
            <strong><label for="color_picker_cor_do_bullet">Escolha a Cor do Bullet</label></strong>
        </h4>
        <p>
            <input type="text" class="colorPicker" name="color_picker_cor_do_bullet" value="<?php echo $values['color_picker_cor_do_bullet'][0]; ?>" data-default-color="#e5e5e5" />
        </p>
		<?php
		echo '</div>';

		echo '<div class="padding-bottom-15">';
		echo '<h4><strong><label for="color_picker_cor_do_bullet">Escolha uma Fonte</label></strong></h4>';

		//$this->googleFontsImporter();
        //$this->exibeProgressBar();
        //$this->verificaUltimaAtualizacaoFontSelector();
		$this->googleFontSelect();

		echo '</div>';

		echo '<div class="padding-top-15 padding-bottom-15">';
		// Para o Ajax carregar a barra de progresso quando atualizar as fontes da API do Google Fonts
        echo '<button class="button-primary" id="atualizar_fonts">Atualizar a Lista de Fontes</button>';

		echo '<div id="loader_gif"></div>';

        // Aqui será carregado o conteúdo da Função em AJAX!!! -->
        echo '<div id="conteudo_a_ser_exibido"></div>';

		echo '</div>';

	}

	//Our custom meta box will be loaded on ajax
	public function add_custom_meta_box($post_name){
        ?>

        <p class="paragrafoPai">
		    <input class="input_itens_bullets" type="text" name="itens_bullets[]" id="itens_bullets" value=""/>
            <button class="excluir_iten_bullet">X</button>
        </p>

        <?php
	}

	public function addStructureBox() {
		$this->add_custom_meta_box($_POST['itens_bullets']);
		exit;
	}

	public function metaBoxSave(){

		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

		if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'my_meta_box_nonce')) return;

		if (!current_user_can('edit_post')) return;

		$campoSanitizadoInputItensBullets = $this->sanitizeCampos('itens_bullets');
		$this->geraGetOption('id_da_pagina_para_css_'.self::getPostId(), self::getPostId());


		if ( $campoSanitizadoInputItensBullets ) {
			update_post_meta(self::getPostId(), 'itens_bullets', $campoSanitizadoInputItensBullets);
		}

		if ( isset($_POST['input_qtd_de_itens_por_coluna']) ) {
			update_post_meta(self::getPostId(), 'input_qtd_de_itens_por_coluna', esc_attr($_POST['input_qtd_de_itens_por_coluna']));

		}

		if ( isset($_POST['input_qtd_de_colunas']) ) {
			update_post_meta(self::getPostId(), 'input_qtd_de_colunas', esc_attr($_POST['input_qtd_de_colunas']));
		}

		if ( isset($_POST['select_bullets']) ) {
			update_post_meta(self::getPostId(), 'select_bullets', esc_attr($_POST['select_bullets']));
		}

		if ( isset($_POST['color_picker_cor_da_fonte']) ) {
			update_post_meta(self::getPostId(), 'color_picker_cor_da_fonte', esc_attr($_POST['color_picker_cor_da_fonte']));
			$this->geraGetOption('color_picker_cor_da_fonte', self::getCorDaFonte());

		}

		if ( isset($_POST['color_picker_cor_do_bullet']) ) {
			update_post_meta(self::getPostId(), 'color_picker_cor_do_bullet', esc_attr($_POST['color_picker_cor_do_bullet']));
			$this->geraGetOption('color_picker_cor_do_bullet', self::getCorIconeBullet());
		}

		if ( isset($_POST['font-selector']) ) {
			update_post_meta(self::getPostId(), 'font-selector', esc_attr($_POST['font-selector']));
			$this->geraGetOption('font-selector', self::getGoogleFonts());
		}

	}

	public function sanitizeCampos($campo){

		if ($campo){
            // Good idea to make sure things are set before using them
            $campo = isset( $_POST[$campo] ) ? (array) $_POST[$campo] : array();

            // Any of the WordPress data sanitization functions can be used here
            $campoSanitizado = array_map( 'sanitize_text_field', $campo );

		return $campoSanitizado;

		}else{
	        return;
        }
    }

    public function deletaPostMeta(){
        delete_post_meta($_POST['idDoPost'], 'itens_bullets');
	}


	/**
     * Função que cria get_option para poder ser utilizada na folha de estilo dinâmica: wp-content/themes/patiodigital/classes/assets/css/pagina-lista-bullets-estilo-dinamico.php
	 * @param $option
	 * @param $valor
	 */
	public function geraGetOption($option, $valor){
		update_option($option, $valor);
    }

    public function exibeProgressBar(){

		//$ctx = stream_context_create();


		$config = array(
			"ssl"=> array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		);

		$context = stream_context_create($config);
		stream_context_set_params($context, array("notification" => array($this, "stream_notification_callback")));
		$url = "https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyD1b-JL1iKIb38mG8Aku1qZeJq3SqCg-V8";
		$fonts = file_get_contents("$url", false, $context);

		file_put_contents(__DIR__.'/fonts.txt', $fonts, $context);

    }

    public function stream_notification_callback($notification_code, $severity, $message, $message_code, $bytes_transferred, $bytes_max) {

		switch($notification_code) {
			case STREAM_NOTIFY_RESOLVE:
			case STREAM_NOTIFY_AUTH_REQUIRED:
			case STREAM_NOTIFY_COMPLETED:
			case STREAM_NOTIFY_FAILURE:
			case STREAM_NOTIFY_AUTH_RESULT:
				var_dump($notification_code, $severity, $message, $message_code, $bytes_transferred, $bytes_max);
				/* Ignore */
				break;

			case STREAM_NOTIFY_REDIRECTED:
				echo "<p>Being redirected to: </p>", $message, '<p>';
				break;

			case STREAM_NOTIFY_CONNECT:
				echo "<p><b>Atualizando os dados da API do Google Fonts</b></p>";
				sleep(1);
				break;

			case STREAM_NOTIFY_FILE_SIZE_IS:
				echo "Got the filesize: ", $bytes_max;
				break;

			case STREAM_NOTIFY_MIME_TYPE_IS:
				echo "<p><b>Tipo de arquivo: ", $message, '</b></p>';
				sleep(1);
				break;

			case STREAM_NOTIFY_PROGRESS:
				echo "<p><b>Atualizados ", $bytes_transferred, " concluído</b></p>";



/*				if ($bytes_transferred > 0) {
					if (!isset($filesize)) {
						printf("<p>Atualizando Arquivo.. %2d kb concluído..</p>", $bytes_transferred/1024);
						sleep(0.1);
					} else {
						$length = (int)(($bytes_transferred/$filesize)*100);
                        printf("\r[%-100s] %d%% (%2d/%2d kb)", str_repeat("=", $length). ">", $length, ($bytes_transferred/1024), $filesize/1024);
					}
				}*/
				break;
		}
		echo "\n";
	}


	public function verificaUltimaAtualizacaoFontSelector(){

        $ajaxIdDoPost = $_POST['idDoPost'];

		$ultimaAtualizacaoFontSelector = get_post_meta($ajaxIdDoPost , 'ultima-atualizacao-font-selector', true);

		if ($ultimaAtualizacaoFontSelector) {

			echo '<h4>Fontes Atualizadas!</h4>';

			if (strtotime($ultimaAtualizacaoFontSelector) <= strtotime(date('d-m-Y'))) {

				update_post_meta($ajaxIdDoPost, 'ultima-atualizacao-font-selector', date('d/m/Y', strtotime('+15 days')));

				$this->googleFontsImporter();

			}
		}else{

			update_post_meta($ajaxIdDoPost, 'ultima-atualizacao-font-selector', date('d/m/Y'));

			$this->googleFontsImporter();

		}

		//$this->googleFontSelect();

		//return;

    }
    public function googleFontsImporter(){

		 /*
         * Google Font Importer
         */

		$config = array(
			"ssl" => array(
				"verify_peer" => false,
				"verify_peer_name" => false,
			),
		);
		$context = stream_context_create($config);
		$url = "https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyD1b-JL1iKIb38mG8Aku1qZeJq3SqCg-V8";
		$fonts = file_get_contents("$url", false, $context);

		file_put_contents(__DIR__ . '/fonts.txt', $fonts);

		echo '<h4>Fontes Atualizadas!</h4>';

		return;
    }

    public function  googleFontSelect(){
        /*
        * Google Font Chooser
        */

        $path = __DIR__.'/fonts.txt';
		$request = file_get_contents( $path );
		$fonts = json_decode( $request );

		$values = get_post_custom(self::getPostId());
		$select_font_selector = isset($values['font-selector']) ? esc_attr($values['font-selector'][0]) : '';
?>



    <select name="font-selector" id="font-selector" style="font-family: '<?php echo $fonts->items[0]->family; ?>', Arial,​ sans-serif;" size="2" >
        <?php foreach ( $fonts->items as $font ) { ?>
            <optgroup style="font-family: '<?php echo $font->family; ?>', Arial,​ sans-serif;" data-src="http://fonts.googleapis.com/css?family=<?php echo str_replace(' ', '+', $font->family); ?>&text=<?php echo str_replace(' ', '+', $font->family); ?>">
                <option value="<?php echo $font->family; ?>" <?php selected($select_font_selector, $font->family); ?>  ><?php echo $font->family; ?></option>
            </optgroup>
        <?php } ?>

    </select>

<?php

    }


}

//new PaginaListaBulletsMetaBox();