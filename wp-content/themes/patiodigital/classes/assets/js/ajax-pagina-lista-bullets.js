
jQuery(document).ready(function ($) {

    function contaParagrafosPai() {

        var numeroDeParagrafosPai = $( ".paragrafoPai" ).length;

        if (numeroDeParagrafosPai == 1){
            var valor = $(".paragrafoPai").find('input').val();
            if (valor == ""){
                deletaPostMeta();
            }
        }else if (numeroDeParagrafosPai == 0){
            deletaPostMeta();
        }
    }

    function deletaPostMeta() {

        var idDoPost = $('#inputHiddenPostId').val();

        jQuery.ajax({
            url: bloginfo.ajaxurl,
            type: 'post',
            data: {
                // você sempre deve passar o parâmetro 'action' com o nome da função que você criou no seu functions.php ou outro que você esteja incluindo nele
                action: 'deletaPostMeta',
                idDoPost : idDoPost,
            },

            success: function (data) {
                // transforma a data em objeto
                var $data = $(data);
                // This outputs the result of the ajax request
                $('#exibir_itens_lista_bullets').parent().append($data);
            },
        });

    }

    $('.addItensBullets').on('click', function () {

        var selectedSection = $('#itens_bullets').text();

        jQuery.ajax({
            url: bloginfo.ajaxurl,
            type: 'post',
            data: {
                // você sempre deve passar o parâmetro 'action' com o nome da função que você criou no seu functions.php ou outro que você esteja incluindo nele
                action: 'addStructureBox',
                section: selectedSection,
            },

            success: function (data) {
                // transforma a data em objeto
                var $data = $(data);
                // This outputs the result of the ajax request
                $('#exibir_itens_lista_bullets').parent().append($data);
            },
        });

    });
    
    $('.excluir_iten_bullet').on('click', function (e) {
        e.preventDefault();

        // Seleciona o elemeto pai do botão clicado, no caso o paragrafo
        var father = $(this).parent();

        //Remove o elemento pai com os filhos
        father.remove();

        contaParagrafosPai();
    });

    // Para exibir uma barra de progresso quando atualizar as fontes da API do Google Fonts

    $('#atualizar_fonts').on('click', function (e) {

        e.preventDefault();
        var idDoPost = $('#inputHiddenPostId').val();
        var gif_loader = $('#loader_gif');
        var conteudo_a_ser_exibido = $('#conteudo_a_ser_exibido');
        jQuery.ajax({
            url: bloginfo.ajaxurl,
            type: 'post',
            data: {
                action: 'verificaUltimaAtualizacaoFontSelector',
                idDoPost : idDoPost,
            },
            beforeSend: function () {
                gif_loader.append('<div id="temp_load" class="padding-top-15">Aguarde enquanto atualizamos as fontes...</div>');
            },

            success: function (data) {
                // transforma a data em objeto
                var $data = $(data);
                // This outputs the result of the ajax request
                conteudo_a_ser_exibido.html($data);
                $data.fadeIn(100, function () {
                    $('#temp_load').remove();
                    loading = false;

                })

            },

        });
    });



});