$(document).ready(function(){
    let validator = {
        errorHandle: function (errors) {
            this.removeErrors();

            Object.keys(errors).forEach(key => {
                let input = $('.user-form input[name=' + key + ']');
                let fieldErrors = errors[key];

                let string = '';

                fieldErrors.forEach(function (item) {
                    string += '<span>' + item + '</span></br>'
                })

                input.parent().find('.invalid-feedback').html(string);
                input.addClass('is-invalid');
            })
        },
        removeErrors: function () {
            $('.user-form input').removeClass('is-invalid');
        }
    }

    $('.user-form').submit(function(event){
        event.preventDefault();

        let form = $(this);

        $.ajax({
            type:'POST',
            url: form.attr('action'),
            data: form.serialize(),
            success: function(response){
                validator.removeErrors();
                $('.users-table').html(response);
                form[0].reset();
            },
            statusCode: {
                422: function(response) {
                    validator.errorHandle(response.responseJSON.errors);
                },
                500: function() {
                    alert('Проблема с сервером');
                }
            }
        });
    });
});