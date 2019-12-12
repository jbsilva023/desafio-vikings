$(window).on('load', function () {
    $('.preload').fadeOut('slow');
});

$(function ($) {
    mask_init();

    /* Evento que controle o submenu lateral, será exibido no momento do click
     * no dropdown-item dropdown-toggle
     */
    $('.dropdown-menu a.dropdown-toggle').on('click mouseover', function (e) {
        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        var $subMenu = $(this).next(".dropdown-menu");
        $subMenu.toggleClass('show');

        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function (e) {
            $('.dropdown-submenu .show').removeClass("show");
        });

        return false;
    });

    $('a.export-excel').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            type: "GET",
            url: "/arquivos/exportar/excel",
            cache: false,
            beforeSend: function () {
                $('.preload').fadeIn('slow');
            },
            success: function (response) {
                Swal.fire(response.title, response.msg, response.type).then(function () {
                    download(response);
                });
            },
            error: function () {

            },
            complete: function () {
                $('.preload').fadeOut('slow');
            }
        });
    });

    $('button[type=reset]').on('click', function (e) {
        e.preventDefault();
        let form = $(this).closest('form');
        let card = $(this).closest('.card');

        form.find('input, select').each(function () {
            $(this).val('');
        });

        card.find('div.card-filter').slideUp('slow', function (e) {
            $(this).removeClass('active');
        });

        $('button.abrir-filtro').show();

        if ($(this).hasClass('limpar-filtro')) {
            form.submit();
        }
    });

    $('div.card').on('click', 'div.buttons>button.abrir-filtro', function (e) {
        var card = $(this).closest('.card');
        var btn_abrir_filtro = $(this);

        if (card.find('div.card-filter').length > 0) {
            card.find('div.card-filter').slideDown('slow', function (e) {
                $(this).addClass('active');
            });
            btn_abrir_filtro.hide();
        }
    });
});

var CPFCNPJMask = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '000.000.000-00' : '00.000.000/0000-00';
}, spOptions = {
    onKeyPress: function (val, e, field, options) {
        field.mask(CPFCNPJMask.apply({}, arguments), options);
    }
};


function download(response)
{
    let a = document.createElement("a");
    a.href = response.file;
    a.download = response.name;
    document.body.appendChild(a);
    a.click();
    a.remove();
}

function mask_init()
{
    $('.date').mask('00/00/0000');
    $('.time').mask('00:00:00');
    $('.date_time').mask('00/00/0000 00:00:00');
    $('.cep').mask('00000-000');
    $('.phone').mask('9999-9999Z', {
        translation: {
            'Z': {
                pattern: /[0-9]/, optional: true
            }
        }
    });
    $('.phone_with_ddd').mask('(00) 0000-0000');
    $('.phone_us').mask('(000) 000-0000');
    $('.mixed').mask('AAA 000-S0S');
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
    $('.cpf_cnpj').mask(CPFCNPJMask, spOptions);
    $('.money').mask('000.000.000.000.000,00', {reverse: true});
    $('.money2').mask("#.##0,00", {reverse: true});

    var options = {
        onKeyPress: function (cpf, ev, el, op) {
            var masks = ['000.000.000-000', '00.000.000/0000-00'];
            $('.cpfcnpj').mask((cpf.length > 14) ? masks[1] : masks[0], op);
        }
    };

    $('.cpfcnpj').length > 11 ? $('.cpfcnpj').mask('00.000.000/0000-00', options) : $('.cpfcnpj').mask('000.000.000-00#', options);
}