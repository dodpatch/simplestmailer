
    $(() => {
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        })
        // function reset() {
        //     $('#email').removeClass('input-invalid');
        //     $('#message').removeClass('input-invalid');
        //     $('legend').show();
        //     $('span').html('');
        //     $('.alert').hide();
        // }
        $('#social').submit((e) => {
            let that = e.currentTarget;
            e.preventDefault();
            reset();
            $('.pure-form-message').html('');
            $.ajax({
                method: $(that).attr('method'),
                url: $(that).attr('action'),
                data: $(that).serialize()
            })
            .done((data) => {
                $('legend').hide();
                $('.alert').show('slow');
            })
            .fail((data) => {
                if(data.status == 422) {
                    $.each(data.responseJSON.errors, function (i, error) {
                        $('form')
                            .find('[name="' + i + '"]')
                            .addClass('input-invalid')
                            .next()
                            .append(error[0]);
                    });
                }
            });
        });
        $('#open').on('click', (e) => {
            reset();
            $('input').val('');
            $('textarea').val('');
        });
    });
