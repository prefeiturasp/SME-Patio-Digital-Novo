jQuery(document).ready(function ($) {

    $('#bt_layout_img_esq_txt_dir').on('click', function (evento) {

        evento.preventDefault();

        jQuery.ajax({
            url: bloginfo.ajaxurl,
            type: 'post',
            data: {
                action: 'addBlocoLayoutImgEsquerdaTextoDireita',
            },
            success: function (data) {
                var $data = $(data);
                $('#exibir_bloco_layout_img_esquerda_texto_direito').parent().append($data);
            },

            error: function () {
                $('#exibir_bloco_layout_img_esquerda_texto_direito').parent().append("<h4>Erro, não foi possível adicionar o bloco de layout. Tente outra vez!</h4>");
            },

        });



        $('#img_esquerda').on('change', function (e) {
            debugger;
           console.log(e);

        });



    });



});