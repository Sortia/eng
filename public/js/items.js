$(function () {
    $('body')
        .on('mouseup mousedown', '.eng:not(.no-change), .rus:not(.no-change)', function () {
            $(this).tip();
        })
        .on('click', '.eng:not(.no-change), .rus:not(.no-change)', function () { // only for hot keys
            $(this).tip();
        })
        .on('click', ".item-item .destroy", function () {
            let item = $(this).parent();

            delete_item(item);
        })
        .on('click', ".item-item .edit-item", function () {
            let item_label = $($(this).siblings('label.active'));

            item_label.prop('contenteditable', true).focus().addClass('no-change-item');

            moveCarriage(item_label);
        })
        .on('blur', '.no-change-item', function () {
            let word = $(this);

            word.removeClass('no-change-item').prop('contenteditable', false);

            let item = word.parent();
            let item_data = getItemData(item);

            update_item(item_data);
        })
        .on('click', ".item-flashcard .destroy", function () {
            let flashcard = $(this).parent();

            delete_flashcard(flashcard);
        })
        .on('click', "#all", function () {
            $('.voc-list :checkbox:checked').each(function () {
                $('.voc-list .toggle').each(function () {
                    $(this).parent().removeClass('hidden-item');
                });
            });
        })
        .on('click', "#active", function () {
            $('.voc-list .toggle:checked').each(function () {
                $(this).parent().addClass('hidden-item');
            });

            $('.voc-list .toggle:not(:checked)').each(function () {
                $(this).parent().removeClass('hidden-item');
            });
        })
        .on('click', "#completed", function () {
            $('.voc-list .toggle:not(:checked)').each(function () {
                $(this).parent().addClass('hidden-item');
            });

            $('.voc-list .toggle:checked').each(function () {
                $(this).parent().removeClass('hidden-item');
            });
        })
        .on('click', "#clear", function () {
            $('.voc-list .toggle:checked').each(function () {
                $(this).siblings('.destroy').click();
            });
        })
        .on('change', ".item-item .toggle", function () {
            let item = $(this).parent();
            let item_data = getItemData(item);

            update_item(item_data);
        })
        .on('click', "#back", function () {
            $("#new-eng").val('');
            $("#new-rus").val('');
            $('.voc-list li').not('li:last').remove();
            $('.item-page').addClass('hidden-page').removeAttr('value');
            $('.flashcard-page').removeClass('hidden-page');
        })
        .keypress(function (event) {

            switch (event.keyCode) {
                case 81: // shift + q
                case 1049:
                    $('.eng').addClass('hidden').removeClass('active');
                    $('.rus').addClass('active').removeClass('hidden');
                    $('.item-item').shuffle();
                    $('.eng').each(function () {
                        $(this).before($(this).siblings('.rus'));
                    });
                    break;

                case 87: // shift + w
                case 1062:

                    $('.rus').addClass('hidden').removeClass('active');
                    $('.eng').addClass('active').removeClass('hidden');
                    $('.item-item').shuffle();
                    $('.rus').each(function () {
                        $(this).before($(this).siblings('.eng'));
                    });
                    break;

                case 65: // shift + a
                case 1060:
                    $('#all').click();
                    break;

                case 83: // shift + s
                case 1067:
                    $('#active').click();
                    break;

                case 68: // shift + d
                case 1042:
                    $('#completed').click();
                    break;

                case 13: // enter
                    let eng = $("#new-eng");
                    let rus = $("#new-rus");

                    if (eng.val() || rus.val()) {
                        if (eng.val() === "" && rus.val() === "") window.stop();
                        if (eng.val() === "") rus_into_eng(rus.val());
                        else if (rus.val() === "") eng_into_rus(eng.val());
                        else {
                            let flashcard_id = $('.item-page').attr('value');
                            create_item(eng.val(), rus.val(), flashcard_id);
                        }
                    }
                }
            }
        );
});
