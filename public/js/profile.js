$(function () {
    $('#change_pass_btn').on('click', function (e) {

        e.preventDefault();

        if ($('#change_pass_block').css('display') === 'none')
            $('#change_pass_block').show();
        else {
            $('#change_pass_block').hide();
            $('#old_password').val('');
            $('#new_password').val('');
        }
    });

    $('#imgInp').on('change',  function () {
        $('#img_name').val($(this).val());
    });

    $('#profile_edit_btn').on('click', function (e) {

        e.preventDefault();

        $(this).hide();
        $('#profile_save_btn').show();
        $('#profile_fieldset').prop('disabled', false);
    });
});