<?php

namespace Classes\ModelosDePaginas\PaginaMapa;


class PaginaMapa
{
	protected $page_ID_filha;
	protected $iframe_google_maps;

	public function __construct($page_ID_filha)
	{
		$this->page_ID_filha=$page_ID_filha;
		$this->iframe_google_maps = get_field("insira_o_iframe_gerado_pelo_google_maps", $this->page_ID_filha);
		$this->montaHtmlMapa();
	}

	public function montaHtmlMapa(){
	?>
		<div class="container-fluid">

			<?php
			if (trim($this->iframe_google_maps) != "") {
				?>
				<div class="row">
					<div class="col map-responsive">
						<?= $this->iframe_google_maps ?>
					</div>
				</div>
			<?php } ?>
		</div>
	<?php

	}


}