<?php

namespace Classes\TemplateHierarchy\Search;


class SearchForm
{
	public static function searchFormLoopSearch(){
		?>
		<form action="<?php echo home_url( '/' ); ?>" method="get" class="navbar-form navbar-left" style="padding-top: 12px;">
			<fieldset>
				<div class="input-group mb-3">
					<input type="text" name="s" id="search" placeholder="<?php _e(BUSCAR,"wpbootstrap"); ?>" value="<?php the_search_query(); ?>" class="form-control" />
					<div class="input-group-append">
						<button type="submit" class="btn btn-outline-secondary bt-search-topo"><?php _e('<i class="fa fa-search"></i>','wpbootstrap'); ?></button>
					</div>
				</div>
			</fieldset>
		</form>
		<?php
	}

	public static function searchFormHeader(){
		?>
		<div class="d-none d-lg-block container-search-topo">
			<form id="demo-2" action="<?php echo home_url( '/' ); ?>" method="get" class="form-inline " style="padding-top: 12px;">
				<fieldset>
					<div class="input-group">
						<input type="search" name="s" id="search" placeholder="<?php _e(BUSCAR,"wpbootstrap"); ?>" value="<?php the_search_query(); ?>" class="input-search-topo" />
					</div>
				</fieldset>
			</form>
		</div>
		<div class="d-block d-sm-none d-none d-sm-block d-md-none d-none d-md-block d-lg-none">
			<form action="<?php echo home_url( '/' ); ?>" method="get" class="navbar-form navbar-left" style="padding-top: 12px;">
				<fieldset>
					<div class="input-group mb-3">
						<input type="text" name="s" id="search" placeholder="<?php _e(BUSCAR,"wpbootstrap"); ?>" value="<?php the_search_query(); ?>" class="form-control" />
						<div class="input-group-append">
							<button type="submit" class="btn btn-outline-secondary bt-search-topo"><?php _e('<i class="fa fa-search"></i>','wpbootstrap'); ?></button>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
		<?php
	}

}