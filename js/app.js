// TODO bug with hot keys (shift + 1, 2, 3, ...)
// TODO hot key tip when some elements hidden
let chars_arr = [
    ['q', 'й'],
    ['w', 'ц'],
    ['e', 'у'],
    ['r', 'к'],
    ['t', 'е'],
    ['y', 'н'],
    ['u', 'г'],
    ['i', 'ш'],
    ['o', 'щ'],
    ['p', 'з'],
    ['[', 'х'],
    [']', 'ъ'],
    ['a', 'ф'],
    ['s', 'ы'],
    ['d', 'в'],
    ['f', 'а'],
    ['g', 'п'],
    ['h', 'р'],
    ['j', 'о'],
    ['k', 'л'],
    ['l', 'д'],
    [';', 'ж'],
    ['\'', 'э'],
    ['\\', '\\'],
    ['z', 'я'],
    ['x', 'ч'],
    ['c', 'с'],
    ['v', 'м'],
    ['b', 'и'],
    ['n', 'т'],
    ['m', 'ь'],
    [',', 'б'],
    ['.', 'ю'],
    ['/', '.'],
    [' ', ' '],
    ['?', ','],
];

let shift_numder_arr = [
    '!', '@', '#', '$', '%', '^', '&', '*', '(', ')'
];

let eng_input = '';
let rus_input = '';


function char_replace(text, lang) {


    let new_str = "";
    let index1, index2;
    if (lang === 'eng') {

        if (eng_input !== undefined) {
            if (eng_input !== '') {
                text = text.replace(eng_input);
                new_str = eng_input.replace(text);
            }
        }

        index1 = 1;
        index2 = 0;
    }

    if (lang === 'rus') {
        if (rus_input !== undefined) {
            if (rus_input !== '') {
                text = text.replace(rus_input);
                new_str = rus_input.replace(text);
            }
        }

        index1 = 0;
        index2 = 1;
    }

    for (let i = 0; i < text.length; i++) {
        for (let j = 0; j < chars_arr.length; j++) {
            if (chars_arr[j][index1] === text[i]) {
                new_str += chars_arr[j][index2];
                break;
            }
            if (j === chars_arr.length - 1)
                new_str += text[i];
        }
    }
    return new_str;
}


$(function () {

    $("#sortable").sortable({
        axis: "y"
    });

    $.fn.shuffle = function () {
        let allElems = this.get();

        let getRandom = function (max) {
            return Math.floor(Math.random() * max);
        };

        let shuffled = $.map(allElems, function () {
            let random = getRandom(allElems.length),
                randEl = $(allElems[random]).clone(true)[0];
            allElems.splice(random, 1);
            return randEl;
        });

        this.each(function (i) {
            $(this).replaceWith($(shuffled[i]));
        });

        return $(shuffled);
    };

    $.fn.tip = function () {

        let item = this.get();
        let another = $(item).siblings('.hidden');

        $(item).before(another);
        $(item).removeClass('active').addClass('hidden');
        $(another).removeClass('hidden').addClass('active');
    };

    function add_block(block_name) {
        $.ajax({
            type: "GET",
            url: "/save_block.php",
            async: true,
            dataType: 'json',
            data: {
                block_name: block_name,
            },
        });
    }

    function save_couple(eng, rus, block_id) {
        console.log(arguments);
        $.ajax({
            type: "GET",
            url: "/save_item.php",
            async: true,
            dataType: 'json',
            data: {
                rus: rus,
                eng: eng,
                parent: block_id
            },
        });
    }

    function delete_couple(rus, eng) {
        $.ajax({
            type: "GET",
            url: "/save_item.php",
            async: true,
            dataType: 'json',
            data: {
                del_rus: rus,
                del_eng: eng,
            },
        });
    }

    function save_status(status, item_id) {
        $.ajax({
            type: "GET",
            url: "/save_item.php",
            async: true,
            dataType: 'json',
            data: {
                status: status,
                item_id: item_id,
            },
        });
    }

    function save_status_block(status, block_id) {
        $.ajax({
            type: "GET",
            url: "/save_block.php",
            async: true,
            dataType: 'json',
            data: {
                status: status,
                block_id: block_id,
            },
        });
    }

    function rus_into_eng(rus) {

        let eng = "";

        $.ajax({
            type: "POST",
            url: "https://translate.yandex.net/api/v1.5/tr.json/translate",
            async: true,
            dataType: 'json',
            data: {
                key: "trnsl.1.1.20190111T100117Z.a6bfd7471ae95146.3099faf07ff344a3108946ac69ed18b2ad69a9a4",
                text: rus,
                lang: "ru-en",
                format: "plain",
                options: "",
            },
            success: function (data) {
                eng = data.text[0];
                $("#new-eng").val(eng);

                if (eng !== rus)
                    add_couple(eng, rus);
            }
        });
    }

    function eng_into_rus(eng) {

        let rus = "";

        $.ajax({
            type: "POST",
            url: "https://translate.yandex.net/api/v1.5/tr.json/translate",
            async: true,
            dataType: 'json',
            data: {
                key: "trnsl.1.1.20190111T100117Z.a6bfd7471ae95146.3099faf07ff344a3108946ac69ed18b2ad69a9a4",
                text: eng,
                lang: "en-ru",
                format: "plain",
                options: "",
            },
            success: function (data) {
                rus = data.text[0];
                $("#new-rus").val(rus);

                if (eng !== rus)
                    add_couple(eng, rus);
            }
        });
    }

    function get_couples_by_block_id(block_id) {
        $.ajax({
            type: "GET",
            url: "/save_item.php",
            async: true,
            dataType: 'json',
            data: {
                block_id: block_id,
            },
            success: function (data) {

                $('.block-page').addClass('hidden-page');
                $('.item-page').removeClass('hidden-page').attr('value', block_id);

                for (let i = 0; i < data.length; i++) {
                    let eng = data[i][2];
                    let rus = data[i][1];
                    let id = data[i][0];
                    let checked = parseInt(data[i][3]) === 1 ? 'checked' : '';
                    add_couple(eng, rus, checked, id);
                }
            }
        });
    }

    function delete_block(block_name) {
        $.ajax({
            type: "GET",
            url: "/save_block.php",
            async: true,
            dataType: 'json',
            data: {
                del_block: block_name,
            },
        });
    }

    function add_couple(eng, rus, status, id) {
        $("#new-eng, #new-rus").val("");
        $(".voc-list").prepend
        (
            "<li class=\"view item-item\" value='" + id + "'>\n" +
            "<input class=\"toggle\" type=\"checkbox\" " + status + ">\n" +
            "<label class=\"active eng\">" + eng + "</label>\n" +
            "<label class=\"hidden rus\">" + rus + "</label>\n" +
            "<button class=\"destroy\"></button>\n" +
            "</li>"
        );
        $('#new-eng').focus();
    }

    let delay_rus = (function () {
        let timer1 = 0;
        return function (callback, ms) {
            clearTimeout(timer1);
            timer1 = setTimeout(callback, ms);
        };
    })();

    let delay_eng = (function () {
        let timer2 = 0;
        return function (callback, ms) {
            clearTimeout(timer2);
            timer2 = setTimeout(callback, ms);
        };
    })();


    $(".new-todo").keyup(function () {
        if ($(this).hasClass('new-eng')) {

            let jQuery_eng_this = this;

            delay_eng(function () {
                let text = $(jQuery_eng_this).val();
                let new_str = char_replace(text, 'eng');
                $(jQuery_eng_this).val(new_str);
            }, 1500);
        }

        if ($(this).hasClass('new-rus')) {

            let jQuery_rus_this = this;

            delay_rus(function () {
                let text = $(jQuery_rus_this).val();
                let new_str = char_replace(text, 'rus');
                $(jQuery_rus_this).val(new_str);
            }, 1500);
        }
    });

    $('body')
        .on('mouseup mousedown', '.eng, .rus', function () {
            $(this).tip();
        })
        .on('click', '.eng, .rus', function () { // only for hot keys
            $(this).tip();
        })
        .on('click', ".item-item .destroy", function () {
            $(this).parent().remove();

            let rus = $(this).siblings('.rus').text();
            let eng = $(this).siblings('.eng').text();

            delete_couple(rus, eng);
        })
        .on('click', ".item-block .destroy", function () {
            $(this).parent().remove();

            let block_name = $(this).siblings('.block').text();

            delete_block(block_name);
        })
        .on('click', ".block", function () {
            let block_id = $(this).parent().val();
            get_couples_by_block_id(block_id);
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
            let status = $(this).prop("checked");
            let item_id = $(this).parents('.view').val();

            save_status(status, item_id);
        })
        .on('change', ".item-block .toggle", function () {
            let status = $(this).prop("checked");
            let item_id = $(this).parents('.view').val();

            save_status_block(status, item_id);
        })
        .on('click', "#back", function () {
            $("#new-eng").val('');
            $("#new-rus").val('');
            $('.voc-list li').not('li:last').remove();
            $('.item-page').addClass('hidden-page').removeAttr('value');
            $('.block-page').removeClass('hidden-page');
        })
        .keypress(function (event) {

            // console.log(event.keyCode);

                let char_click = getChar(event);
                let number = shift_numder_arr.indexOf(char_click);

                if (number !== -1) {
                    if (!$('.block-page').hasClass('hidden-page')) {
                        $('.block:eq(' + number + ')').click();
                    } else {
                        let item = $('.item-item:eq(' + number + ')');

                        if (item.children('.eng').hasClass('hidden'))
                            item.children('.rus').click();
                        else item.children('.eng').click();
                    }
                }

                switch (event.keyCode) {

                    case 81:
                    case 1049:
                        $('.eng').addClass('hidden').removeClass('active');
                        $('.rus').addClass('active').removeClass('hidden');
                        $('.item-item').shuffle();
                        $('.eng').each(function () {
                            $(this).before($(this).siblings('.rus'));
                        });
                        break;

                    case 87:
                    case 1062:

                        $('.rus').addClass('hidden').removeClass('active');
                        $('.eng').addClass('active').removeClass('hidden');
                        $('.item-item').shuffle();
                        $('.rus').each(function () {
                            $(this).before($(this).siblings('.eng'));
                        });
                        break;

                    case 65:
                    case 1060:
                        $('#all').click();
                        break;

                    case 83:
                    case 1067:
                        $('#active').click();
                        break;

                    case 68:
                    case 1042:
                        $('#completed').click();
                        break;

                    case 66:
                    case 1048:
                        $('#back').click();
                        break;

                    case 13:
                        let eng = $("#new-eng");
                        let rus = $("#new-rus");
                        let block = $('#new-block').val();

                        if(eng.val() || rus.val()) {
                            if (eng.val() === "" && rus.val() === "") window.stop();
                            if (eng.val() === "") rus_into_eng(rus.val());
                            else if (rus.val() === "") eng_into_rus(eng.val());
                            else {
                                let block_id = $('.item-page').attr('value');
                                console.log(eng.val(), rus.val(), block_id);
                                save_couple(eng.val(), rus.val(), block_id);
                                add_couple(eng.val(), rus.val());
                            }
                        }
                        if(block) {
                            add_block(block);
                        }

                }
            }
        );

    function getChar(event) {
        event = event || window.event;
        let keyCode = event.which || event.keyCode;
        return String.fromCharCode(keyCode);
    }
});