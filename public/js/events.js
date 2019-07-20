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
        let item = $($(this).siblings('label.active'));

        item.prop('contenteditable', true).focus().addClass('no-change');

        let range = document.createRange();
        let sel = window.getSelection();
        range.setStart(item.get(0).childNodes[0], item.get(0).childNodes[0].length);
        range.collapse(true);
        sel.removeAllRanges();
        sel.addRange(range);
    })
    .on('blur', '.no-change', function () {
        let word = $(this);

        word.removeClass('no-change').prop('contenteditable', false);

        let item = word.parent();
        let item_data = getItemData(item);

        update_item(item_data);
    })
    .on('click', ".item-block .destroy", function () {
        let block = $(this).parent();

        delete_block(block);
    })
    .on('click', ".block", function () {
        let block_id = $(this).parent().val();
        get_items(block_id);
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
    .on('change', ".item-block .toggle", function () {
        let status = $(this).prop("checked");
        let item_id = $(this).parents('.view').val();

        save_block_status(status, item_id);
    })
    .on('click', "#back", function () {
        $("#new-eng").val('');
        $("#new-rus").val('');
        $('.voc-list li').not('li:last').remove();
        $('.item-page').addClass('hidden-page').removeAttr('value');
        $('.block-page').removeClass('hidden-page');
    })
    .keypress(function (event) {
        let char_click = getChar(event);
        let number = shift_numder_arr.indexOf(char_click);

        if (number !== -1) {
            if (!$('.block-page').hasClass('hidden-page')) {
                $('.block:not(.hidden-block):eq(' + number + ')').click();
            } else {
                let item = $('.item-item:not(.hidden-item):eq(' + number + ')');

                if (item.children('.eng').hasClass('hidden'))
                    item.children('.rus').click();
                else item.children('.eng').click();
            }
        }

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

            case 66: // shift + b
            case 1048:
                $('#back').click();
                break;

            case 13: // enter
                let eng = $("#new-eng");
                let rus = $("#new-rus");
                let block = $('#new-block').val();

                if (eng.val() || rus.val()) {
                    if (eng.val() === "" && rus.val() === "") window.stop();
                    if (eng.val() === "") rus_into_eng(rus.val());
                    else if (rus.val() === "") eng_into_rus(eng.val());
                    else {
                        let block_id = $('.item-page').attr('value');
                        create_item(eng.val(), rus.val(), block_id);
                    }
                }
                if (block) {
                    create_block(block);
                }
            }
        }
    );

function getChar(event) {
    event = event || window.event;
    let keyCode = event.which || event.keyCode;
    return String.fromCharCode(keyCode);
}