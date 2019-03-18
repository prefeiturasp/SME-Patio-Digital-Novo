/*Anima Menu
/*Verifico o tamanho da tela, se for maior que 992 crio e add a classe que contem a animação ao hover do li do wp-nav-menu*/
var $s = jQuery.noConflict();

/*Ativacao Hamburger Menu Icons*/
$s(document).ready(function(){
    $s('#nav-icon1, #nav-icon2, #nav-icon3, #nav-icon4').click(function(){
        $s(this).toggleClass('open');
    });
});


/*Scripts para o Botao Voltar ao topo aparecer somente quando tiver rolagem para baixo*/
$s(function() {
    $s(window).scroll(function() {
        if($s(this).scrollTop() != 0) {
            $s('#toTop').fadeIn();
        } else {
            $s('#toTop').fadeOut();
        }
    });
    $s('#toTop').click(function() { $s('body,html').animate({scrollTop:0},800); });
});


/*Scripts para o fazer o menu aparecer somente quando rola a pagina*/
$s(document).ready(function() {
    var tam = $s(window).width();
    if (tam >=992 ){

        var nav = $s('#menu-scrow');

        $s(window).scroll(function () {
            if ($s(this).scrollTop() > 100) {
                nav.slideDown('normal', 'swing');
                /*nav.fadeIn();*/
            } else {
                nav.slideUp('normal', 'linear');
                /*nav.fadeOut();*/
            }
        });
    }
});



/*Script Simiao Dot Net que consegui retirar a ultima barra das urls - complemento da funcao colocar_ancora() do functions.php*/

$s(document).ready(function() {
    $s("li.menu-item a").each(function(){

        //Pego a Url
        var xis = $s(this).attr("href");
        var slug_front_page = wp_vars.slug_front_page;

        var regex_slug_front_page = new RegExp('/' + slug_front_page + '/');

            if (xis) {

                //Verifico se existe o slug da front page existe na url, se existir Ã© pq Ã© uma pÃ¡gina filha da home - uso regex
                if (xis.match(regex_slug_front_page)) {

                    //Se existir substituo a palavra "home" pela ancora "#"
                    var xis = xis.replace(regex_slug_front_page, "#");

                    //Retiro a ultima barra "/" da url para a ancora funcionar
                    $s(this).attr("href", xis.substr(0, xis.length - 1))

                } else {
                    $s(this).removeClass("scroll");
                }
        }
    });
});

/*Script para fazer a Rolagem suave das pÃ¡ginas*/
$s(document).ready(function() {
    //Funcionou

    var url = $s(location).attr('href');
    var nome_da_pagina = $s(location).attr('pathname');
    // Atribui Ã  Variavel url_inicial o retorno de uma funÃ§Ã£o criada no functions.php que passa o valor do get_home_url() e acrescento uma barra final "/"
    var url_inicial = wp_vars.url_front_page+'/';

    if(url === url_inicial){
        $s(".scroll").click(function(event){
            event.preventDefault();
            $s('html,body').animate({scrollTop:$s(this.hash).offset().top}, 800);
        });
    }else if(url.match(/#/)){
        $s(".scroll").click(function(event){
            event.preventDefault();
            $s('html,body').animate({scrollTop:$s(this.hash).offset().top}, 800);
        });
    }else{
        $s(".scroll").click(function(event){
            //event.preventDefault();
            $s('html,body').animate({scrollTop:$s(this.hash).offset().top}, 800);
        });
    }

});




/*Ativação carroussel depoimentos - página depoimentos */
$s('#myCarousel').carousel({
    interval:   4000
});

/*Ativação do Tool Tip Bootstrap*/
$s(document).ready(function() {
    $s(function () {
        $s('[data-toggle="tooltip"]').tooltip({html:true})
    });
});

/* Ativacao Wow*/
new WOW().init();
