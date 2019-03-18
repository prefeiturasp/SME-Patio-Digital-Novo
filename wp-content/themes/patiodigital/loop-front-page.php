<?php
use Classes\SliderResponsivo\SliderResponsivo;

$sliderResponsivo = new SliderResponsivo($page_ID);


// Argumentos para trazer as páginas que são filhas da Home
    $mypages = get_pages(
            array(
                'child_of' => $post->ID,
                'sort_column' => 'post_date',
                'sort_order' => 'desc'
    ));

    foreach ($mypages as $page) {
        $post_name = $page->post_name;
		$page_ID_filha = $page->ID;

        $template_page_name = get_page_template_slug($page_ID_filha);

		//Necessário para a ancora
        $template_page_name_sem_php = str_replace(".php", "", $template_page_name);

        if(trim($template_page_name == "")){
        	//necessário para substituir o Template Page Padrão do Wordpress (Modelo Parão ou Default Template), caso seja escolhido por engano esse Modelo Padrão como Modelo da Página
        	$template_page_name = "page.php";
        }
        ?>

        <!-- Necessário para a ancora -->
        <div id="<?php echo $post_name ?>"></div>

        <?php
        require get_template_directory()  . '/' . $template_page_name;
    }
    ?>
