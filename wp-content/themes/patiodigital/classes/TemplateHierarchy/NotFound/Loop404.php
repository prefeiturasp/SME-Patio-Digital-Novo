<?php

namespace Classes\TemplateHierarchy\NotFound;


class Loop404
{
	protected $args404;
	protected $querys404;

	public function __construct()
	{
		$this->montaQuery404();
		$this->montaHtml404();

	}

	public function montaQuery404(){
		$this->args404 =
			array(
				'post_type' => array('page','post'),
				'post_parent' => 0,
				'numberposts' => 10,
			);

		$this->querys404 = get_posts($this->args404);
	}

	public function getPagesPostCadastrados(){

		if (count($this->querys404) > 0) {
			echo "<p>".ESTAPROCURANDO."</p>";

			echo '<ul class="list-group list-group-flush">';
			foreach ($this->querys404 as $post) {
				echo '<li class="list-group-item">';
				echo '<a target="_blank" class="texto-preto" href="' . get_permalink($post->ID) . '">' . $post->post_title . '</a>';
				echo '</li>';

			}
			echo "</ul>";
		}
	}

	public function montaHtml404(){
		?>
		<br>
		<div class="container">
			<div class="row">
				<div class='col-12'>
					<h2> <?= OOOPS ?></h2>

					<p><?php echo PEDIMOSDESCULPAS ?></p>
					<p><?php echo UTILIZEOMENUACIMA ?></p>

					<?php $this->getPagesPostCadastrados() ?>

				</div>
				<div class="col-12 text-right padding-top-30 padding-bottom-15">
					<a class="btn btn-primary" href="javascript:history.back();"><?php echo VOLTAR ?></a>
				</div>
			</div>
		</div>
		<?php
	}

}