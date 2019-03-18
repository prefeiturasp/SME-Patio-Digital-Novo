/* Scripts Contagem de Números Animação - Essa função é chamada na página-numeros-randomicos.php
// Recebe por parâmetro o id da div atual e se é pagina filha
// Se NÃO for página filha, não acrescento 350px no scrollTop, para a animação ser vista sem rolagem da página.
// Faço as verificações e crio a animação
 */
function criaNumerosRancomicos(idContainer, sePaginaFilha) {

    var seletor = idContainer;



    $s(window).scroll(function () {

        var posicaoElemento = $s(seletor).offset().top;

        var scrollAtual = pageYOffset+300;

        if (scrollAtual >= posicaoElemento){
            $s(seletor + " > .count").each(function () {
                $s(this).prop('Counter', 0).animate({
                    Counter: $s(this).text()
                }, {
                    duration: 2000,
                    easing: 'swing',
                    step: function (now) {
                        $s(this).text(Math.ceil(now));

                    },
                    // Acrescentei este método para exibir o titulo do post quando termina a animação da contagem
                    complete: function () {
                        var texto = $s(this).attr("title");
                        $s(this).text(texto);
                        //$s(this).attr("style", "display: none !important");
                        $s(this).remove();
                        $s(".texto-count").attr("style", "display: block !important");
                        return;
                    },
                });
            });
        }



    });
};
