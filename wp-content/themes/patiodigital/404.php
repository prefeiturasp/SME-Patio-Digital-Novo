<?php
use Classes\TemplateHierarchy\NotFound\Loop404;
get_header();
global $post;
$template_hierarchy = new Loop404();
get_footer()
?>
