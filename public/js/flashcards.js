$(function () {
    $('body')
        .on('click', ".item-flashcard .edit-flashcard", function () {
            let flashcard_label = $($(this).siblings('.flashcard'));

            flashcard_label.prop('contenteditable', true).focus().addClass('no-change-flashcard');

            moveCarriage(flashcard_label);
        })
        .on('blur', '.no-change-flashcard', function () {
            let flashcard_label = $(this);

            flashcard_label.removeClass('no-change-flashcard').prop('contenteditable', false);

            let flashcard = flashcard_label.parent();
            let flashcard_data = getFlashcardData(flashcard);

            update_flashcard(flashcard_data);
        })
        .on('click', ".item-flashcard .destroy", function () {
            let flashcard = $(this).parent();

            delete_flashcard(flashcard);
        })
        .on('click', ".flashcard:not(.no-change-flashcard)", function () {
            console.log(1);
            let flashcard_id = $(this).parent().val();
            get_items(flashcard_id);
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
        .on('change', ".item-flashcard .toggle", function () {
            let flashcard = $(this).parent();
            let flashcard_data = getFlashcardData(flashcard);

            update_flashcard(flashcard_data);
        })
        .keypress(function (event) {

                switch (event.keyCode) {
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
                        let flashcard = $('#new-flashcard').val();

                        if (flashcard) {
                            create_flashcard(flashcard);
                        }
                }
            }
        );
});
