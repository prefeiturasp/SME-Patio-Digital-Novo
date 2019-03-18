<?php

namespace Classes\BtCallToAction;


use Classes\PaginaFilha\PaginaFilha;

class BtCallToAction
{
	private $page_ID_filha;
	private $deseja_inserir_botao_call_to_action_nesta_pagina;
	private $insira_o_texto_do_box_call_to_action;
	private $insira_o_texto_do_botao_call_to_action;
	private $insira_a_url_deste_botao_call_to_action;
	private $deseja_abrir_em_uma_nova_aba_botao_call_to_action;
	private $insira_a_cor_do_box_call_to_action;
	private $insira_a_cor_do_botao_call_to_action_copiar;

	private $target;

	public function __construct()
	{
		$this->page_ID_filha  = PaginaFilha::getIdPaginaCorreta();

		$this->deseja_inserir_botao_call_to_action_nesta_pagina = get_field('deseja_inserir_botao_call_to_action_nesta_pagina', $this->page_ID_filha);
		$this->insira_o_texto_do_box_call_to_action = get_field('insira_o_texto_do_box_call_to_action', $this->page_ID_filha);
		$this->insira_o_texto_do_botao_call_to_action = get_field('insira_o_texto_do_botao_call_to_action', $this->page_ID_filha);
		$this->insira_a_url_deste_botao_call_to_action = get_field('insira_a_url_deste_botao_call_to_action', $this->page_ID_filha);
		$this->deseja_abrir_em_uma_nova_aba_botao_call_to_action = get_field('deseja_abrir_em_uma_nova_aba_botao_call_to_action', $this->page_ID_filha);
		$this->insira_a_cor_do_box_call_to_action = get_field('insira_a_cor_do_box_call_to_action', $this->page_ID_filha);
		$this->insira_a_cor_do_botao_call_to_action_copiar = get_field('insira_a_cor_do_botao_call_to_action_copiar', $this->page_ID_filha);

    	$this->configuracoesBtCallToAction();

	}


	public function configuracoesBtCallToAction(){

		if ($this->deseja_inserir_botao_call_to_action_nesta_pagina === 'sim'){
            if ($this->deseja_abrir_em_uma_nova_aba_botao_call_to_action === 'sim'){
                $this->target= '_blank';
            }else{
                $this->target = '_self';
            }
			$this->montaHtmlBtCallToAction();
		}else{
			return;
		}
	}

	public function montaHtmlBtCallToAction(){
		?>

		<div class="container sociedade-governo">
			<div class="row">
				<div style=" background: <?= $this->insira_a_cor_do_box_call_to_action ?>; border-color: <?= $this->insira_a_cor_do_box_call_to_action ?>" class="alerta col-12 d-flex justify-content-betweend-flex justify-content-between align-items-center">
					<span><?= $this->insira_o_texto_do_box_call_to_action ?></span>
					<a style="background: <?= $this->insira_a_cor_do_botao_call_to_action_copiar ?>; border-color: <?= $this->insira_a_cor_do_botao_call_to_action_copiar ?>; " target="<?= $this->target ?>" href="<?= $this->insira_a_url_deste_botao_call_to_action ?>" class="btn btn-info btn-lg"><?= $this->insira_o_texto_do_botao_call_to_action ?></a>
				</div>
			</div>
		</div>
		<?php
	}

}
