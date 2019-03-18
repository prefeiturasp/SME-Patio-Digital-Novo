/*Ativacao SmartMenu Varios Níveis*/
var $s = jQuery.noConflict();
jQuery(document).ready(function ($) {

    var main_menu = $s('.main-menu');
    if (main_menu) {

        $s('.main-menu').smartmenus({
            mainMenuSubOffsetX: 10,
            mainMenuSubOffsetY: 0,
            subMenusSubOffsetX: 10,
            subMenusSubOffsetY: 0
        });
    }
});