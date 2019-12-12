$(function ($) {
    $('div#update-cartorio').on('shown.bs.modal', function (event) {
        let id = $(event.relatedTarget).data('idcartorio');
        let nome = $(event.relatedTarget).data('nome');

        $(this).find('.modal-header h5.modal-title').html('Atualizar (' + nome + ')');

        if (id) {
            $.ajax({
                type: "POST",
                url: "/cartorio/detalhe",
                data: {'id': id},
                beforeSend: function () {
                    $('div#update-cartorio').find('.preload').fadeIn('slow');
                },
                success: function (response) {
                    $('div#update-cartorio').find('div.modal-content .form').html(response);
                    mask_init();
                },
                error: function () {

                },
                complete: function () {
                    $('div#update-cartorio').find('.preload').fadeOut('slow');
                },
            });
        }
    });

    $('div#update-cartorio').on('hidden.bs.modal', function (event) {
        $(this).find('.modal-header h5.modal-title').html('');
        $(this).find('div.modal-content .form').html('');
    });

    $('div#create-cartorio').on('shown.bs.modal', function (event) {
        $(this).find('.modal-header h5.modal-title').html('Cadastrar cartório');

        $.ajax({
            type: "GET",
            url: "/cartorio/novo",
            beforeSend: function () {
                $('div#create-cartorio').find('.preload').fadeIn('slow');
            },
            success: function (response) {
                $('div#create-cartorio').find('div.modal-content .form').html(response);
                mask_init();
            },
            error: function () {

            },
            complete: function () {
                $('div#create-cartorio').find('.preload').fadeOut('slow');
            },
        });
    });

    $('div#create-cartorio').on('hidden.bs.modal', function (event) {
        $(this).find('.modal-header h5.modal-title').html('');
        $(this).find('div.modal-content .form').html('');
    });

    $('div#create-cartorio, div#update-cartorio').on('change', 'select[name=tipo_documento]', function () {
        let form = $(this).closest('form');

        switch ($(this).val()) {
            case '1':
                form.find('input[name=documento]').attr('disabled', false).val('');
                form.find('input[name=documento]').mask('000.000.000-00', {reverse: true});
                break;
            case '2':
                form.find('input[name=documento]').attr('disabled', false).val('');
                form.find('input[name=documento]').mask('00.000.000/0000-00', {reverse: true});
                break;
            default:
                form.find('input[name=documento]').attr('disabled', true).val('');
                break;
        }
    });

    $('div#create-cartorio').on('click', 'button.save', function (event) {
        var form = $('form[name=cartorio]');
        var erros = [];

        form.find('input.required, select.required').each(function () {
            $(this).removeClass('border-red');

            if ($(this).val() === '') {
                $(this).addClass('border-red');
                erros.push('O campo <b>' + $(this).parent().find('label[for=' + $(this).attr('id') + ']').text()
                    .replace(/[\*\:]/g, '') + '</b> é obrigatório.');
            }
        });

        form.find('div.erros div.message').hide('slow');

        if (!erros.length > 0) {
            $.ajax({
                type: "POST",
                url: "/cartorio/inserir",
                data: form.serialize(),
                beforeSend: function () {
                    $('div#update-cartorio').find('.preload').fadeIn('slow');
                },
                success: function (response) {
                    Swal.fire(response.title, response.msg, response.type).then(function () {
                        if (response.reload) {
                            location.reload();
                        }
                    });
                },
                error: function () {

                },
                complete: function () {
                    $('.preload').fadeOut('slow');
                }
            });
        } else {
            form.find('div.erros div.message').html(erros.join('<br>')).show("slow");
        }
    });

    $('div#update-cartorio').on('click', 'button.save', function (event) {
        var form = $('form[name=cartorio]');
        var erros = [];

        form.find('input.required, select.required').each(function () {
            $(this).removeClass('border-red');

            if ($(this).val() === '') {
                $(this).addClass('border-red');
                erros.push('O campo <b>' + $(this).parent().find('label[for=' + $(this).attr('id') + ']').text()
                        .replace(/[\*\:]/g, '') + '</b> é obrigatório.');
            }
        });

        form.find('div.erros div.message').hide('slow');

        if (!erros.length > 0) {
            $.ajax({
                type: "POST",
                url: "/cartorio/update",
                data: form.serialize(),
                beforeSend: function () {
                    $('div#update-cartorio').find('.preload').fadeIn('slow');
                },
                success: function (response) {
                    Swal.fire(response.title, response.msg, response.type).then(function () {
                        if (response.reload) {
                            window.location.reload();
                        }
                    });
                },
                error: function () {

                },
                complete: function () {
                    $('.preload').fadeOut('slow');
                }
            });
        } else {
            form.find('div.erros div.message').html(erros.join('<br>')).show("slow");
        }
    });

    $('.delete-cartorio').on('click', function (event) {
        event.preventDefault();

        let id = $(this).data('idcartorio');

        Swal.fire({
            title: 'Você tem certeza?',
            text: "Você deseja excluir o registro?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Não',
            confirmButtonText: 'Sim',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "/cartorio/delete",
                    data: {'id': id},
                    beforeSend: function () {
                        $('.preload').fadeIn('slow');
                    },
                    success: function (response) {
                        Swal.fire(response.title, response.msg, response.type).then(function () {
                            if (response.reload) {
                                window.location.reload();
                            }
                        });
                    },
                    error: function () {

                    },
                    complete: function () {
                        $('.preload').fadeOut('slow');
                    }
                });
            }
        });
    });

    $('form[name=enviar-email]').on('submit', function (e) {
        e.preventDefault();

        let erros = [];
        let data = new FormData($(this)[0]);
        let form = $(this);

        form.find('input.required, textarea.required').each(function () {
            $(this).removeClass('border-red');

            if ($(this).val() === '') {
                $(this).addClass('border-red');
                erros.push('O campo <b>' + $(this).parent().find('label[for=' + $(this).attr('id') + ']').text()
                        .replace(/[\*\:]/g, '') + '</b> é obrigatório.');
            }
        });

        form.find('div.erros div.message').hide('slow');

        if (!erros.length > 0) {
            $.ajax({
                type: "POST",
                url: "/enviar-email",
                data: data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function () {
                    $('.preload').fadeIn('slow');
                },
                success: function (response) {
                    Swal.fire(response.title, response.msg, response.type).then(function () {
                        if (response.reload) {
                            window.location.href = '/';
                        }
                    });
                },
                error: function () {

                },
                complete: function () {
                    $('.preload').fadeOut('slow');
                }
            });
        } else {
            form.find('div.erros div.message').html(erros.join('<br>')).show("slow");
        }
    });
});