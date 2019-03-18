<?php
/*
 * Template Name: Modelo com Página Filha
 * Description: Modelo com Página Filha. Permite incluir qualquer modelo de página como filha.
 */
get_header();

use Classes\SliderResponsivo\SliderResponsivo;

$sliderResponsivo = new SliderResponsivo($page_ID);

$mypages = get_pages(
	array(
		'child_of' => $post->ID,
		'sort_column' => 'post_date',
		'sort_order' => 'desc'
	));

/*var_dump($mypages);*/

foreach ($mypages as $page) {
	$post_name = $page->post_name;
	$page_ID_filha = $page->ID;
	$template_page_name = get_page_template_slug($page_ID_filha);
	$template_page_name_sem_php = str_replace(".php", "", $template_page_name);

	if(trim($template_page_name == "")){
		$template_page_name = "page.php";
	}
	?>
    <div id="<?php echo $post_name ?>"></div>
	<?php
	require TEMPLATEPATH . '/' . $template_page_name;
}
?>
<?php

get_footer();
