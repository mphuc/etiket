
$(function(){

    var save_and_close = false;

    if($('#fancybox-loading')[0]){
        altair_helpers.content_preloader_hide();
    }

    //  Salva as informações e retorna a listagem inicial
    $('#save-and-go-back-button').click(function(){
        save_and_close = true;
        submitCrudForm($('#crudForm'), save_and_close);
    });
    //  Faz as verificações e submete o formulario
    $('.submit-form').on('click', function(){
        submitCrudForm($('#crudForm'), save_and_close);
    });

    $('.return-to-list').on('click', function() {
        UIkit.modal.confirm(message_alert_add_form, function(){
            window.location = list_url;
        });
        return false;
    });

});

function multipleupload() {
    UIkit.modal.confirm(message_alert_add_form, function(){
        
    });
    return false;
}
//  Mensagens para a aplicação
var alert_message = function(type_message, text_message){

    $('.modal-message.'+type_message).remove();

    var pesan = '<ul class="md-list md-list-addon alert '+type_message+' modal-message"><li><div class="md-list-addon-element"><i class="md-list-addon-icon material-icons uk-text-warning">&#xE8B2;</i></div><div class="md-list-content"><span class="md-list-heading">'+text_message+'</span></div></li></ul>';
    UIkit.notify({
        message : text_message,
        status  : 'warning',
        timeout : 5000,
        pos     : 'top-center'
    });
    $('#message-box').prepend(pesan);
    $('html, body').animate({
        scrollTop:0
    }, 600);
    altair_helpers.content_preloader_hide();
    window.setTimeout( function(){
        $('.modal-message.'+type_message).slideUp();
    }, 7000);
    return false;
};

//  Simula o efeito RESET no formulário de inserção de conteudo
function clearForm()
{
    
    $('#crudForm').find(':input').each(function() {
        switch(this.type) {
            case 'password':
            case 'select-multiple':
            case 'select-one':
            case 'text':
            case 'textarea':
                $(this).val('');
                break;
            case 'checkbox':
            case 'radio':
                this.checked = false;
        }
    });

    /* Clear upload inputs  */
    $('.open-file, .gc-file-upload, .hidden-upload-input').each(function(){
        $(this).val('');
    });

    $('.upload-success-url').hide();
    $('.fileinput-button').fadeIn("normal");
    /* -------------------- */

    $('.remove-all').each(function(){
        $(this).trigger('click');
    });

    $('.chosen-multiple-select, .chosen-select, .ajax-chosen-select').each(function(){
        $(this).trigger("liszt:updated");
    });
}

//  Submete o formulário para inserir os dados no BD
function submitCrudForm( crud_form, save_and_close ){
   console.log(crud_form);
    crud_form.ajaxSubmit({
        url: validation_url,
        dataType: 'json',
        cache: 'false',
        beforeSend: function(){
            altair_helpers.content_preloader_show();
        },
        afterSend: function(){
            altair_helpers.content_preloader_hide();
        },
        success: function(data){
            altair_helpers.content_preloader_hide();
            if(data.success)
            {
                $('#crudForm').ajaxSubmit({
                    dataType: 'text',
                    cache: 'false',
                    beforeSend: function(){
                        altair_helpers.content_preloader_show();
                    },
                    success: function(result){
                        data = $.parseJSON( result );
                        if(data.success)
                        {
                            if(save_and_close)
                            {
                                window.location = data.success_list_url;
                                return true;
                            }

                            $('.form-input-box').each(function(){
                                $(this).removeClass('error');
                            });
                            clearForm();
                            alert_message('success', data.success_message);
                        }
                        else
                        {
                            alert_message('error', message_insert_error);
                        }
                    },
                    error: function(){
                        alert_message('error', message_insert_error);
                    }
                });
            }
            else
            {

                $('.form-input-box').removeClass('error');
                alert_message('error', data.error_message);

                $.each(data.error_fields, function(index,value){
                    $('input[name='+index+']').addClass('error');
                });
            }
        },
        error: function(){
            altair_helpers.content_preloader_hide();
            alert_message('error', message_insert_error);
        }
    });
    return false;
}

//  Retornar para a tabela de listagem de dados inicial
function goToList(title_modal, message_text){

    if ($('#dialog_modal_message')[0]){
        $('#dialog_modal_message').remove();
    }

    var modal_content = '<div id="dialog_modal_message" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="dialog_modal_message_label" aria-hidden="true"><div class="modal-header">  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>  <h3 id="dialog_modal_message_label">' + title_modal + '</h3></div><div class="modal-body">  <p>'+ message_text + '</p></div><div class="modal-footer">  <button class="btn cancel-confirmation" data-dismiss="modal" aria-hidden="true">Cancel</button> <button class="btn btn-primary ok-confirmation">Ok</button></div></div>';
    $('#message-box').after(modal_content);

    $('#dialog_modal_message')
        .modal({ keyboard: false })
        .on('shown', function(){
            $(this).find('button.cancel-confirmation').click(function(){
                $('button.close').trigger('click');
            }).end().find('button.ok-confirmation').click(function(){
                window.location = list_url;
                $('button.close').trigger('click');
            });
        });

}


