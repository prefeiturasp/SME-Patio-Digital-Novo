<?php

namespace Classes\DesignPatterns;


class Factory
{
	public function __construct()
	{
		add_filter( 'wp_get_attachment_image_attributes', array($this,'getAltTitleImagesThePostThumbnail'), 10, 2 );
	}

	public static function getAltTitleImagesCamposPersonalizados(array $arrayImagem){
		if (!$arrayImagem['alt']){
			$alt_imagem = $arrayImagem['title'];
		}else{
			$alt_imagem = $arrayImagem['alt'];
		}

		return array(
			'alt_imagem' => $alt_imagem,
			'title_imagem' => $arrayImagem['title'],
		);
	}

	public static function getAltTitleImagesThePostThumbnail( $attr=null, $attachment = null ) {

		$img_title = trim( strip_tags( $attachment->post_title ) );
		$img_alt = trim( strip_tags( $attachment->post_excerpt ) );

		if (!$img_alt){
			$img_alt = $img_title;
		}

		$attr['alt'] = $img_alt;
		$attr['title'] = $img_title;


		return $attr;
	}

	public static function getCPT(){
		$post_type = get_post_type(get_the_ID());
		return $post_type;
	}

	public static function getTaxonomy(){

		$query_object = get_queried_object();

		$taxonomyTax = $query_object->taxonomy;
		$taxonomySlug = $query_object->slug;
		$classeWP = get_class($query_object);

		if ($classeWP === 'WP_Term') {
			$taxonomyName = $query_object->name;
		}elseif($classeWP === 'WP_Post_Type'){
			$taxonomyName = $query_object->labels->name;
		}

		return array(
			'taxonomyTax' => $taxonomyTax,
			'taxonomySlug' => $taxonomySlug,
			'taxonomyName' => $taxonomyName,
		);
	}

	public static function getSlugsTaxDentroDoLoop(){
		$get_post_terms = wp_get_post_terms( get_the_ID(), 'portfolios' );
		$slugs_tax = '';
		foreach ($get_post_terms as $index => $term){
			$slugs_tax .=$term->slug.' ';
		}

		return $slugs_tax;
	}


}

new Factory();