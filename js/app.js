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

let eng_input = '';
let rus_input = '';


function char_replace(text, lang) {


    let new_str = "";
    let index1, index2;
    console.log(new_str);
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

    function save_couple(eng, rus) {
        $.ajax({
            type: "GET",
            url: "/save_item.php",
            async: true,
            dataType: 'json',
            data: {
                rus: rus,
                eng: eng,
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

                if (eng !== rus) add_couple(eng, rus);
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

                if (eng !== rus) add_couple(eng, rus);
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

                for(let i = 0; i < data.length; i++) {
                    let eng = data[i][2];
                    let rus = data[i][1];
                    let id = data[i][0];
                    let checked = parseInt(data[i][3]) === 1 ? 'checked' : '';
                    add_couple(eng, rus, checked, id);

                    // $('.item-page');
                }
            }
        });
    }

    function add_couple(eng, rus, status, id) {
        console.log(arguments);
        $("#new-eng, #new-rus").val("");
        $(".todo-list").prepend
        (
            "<li class=\"view item-item\" value='"+ id +"'>\n" +
            "<input class=\"toggle\" type=\"checkbox\" "+ status +">\n" +
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
        .on('click', ".destroy", function () {
            $(this).parent().remove();

            let rus = $(this).siblings('.rus').text();
            let eng = $(this).siblings('.eng').text();

            delete_couple(rus, eng);
        })
        .on('click', ".block", function () {
            let block_id = $(this).parent().val();
            get_couples_by_block_id(block_id);
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
        .keypress(function (event) {

                switch (event.keyCode) {

                    case 81:
                    case 1049:
                        $('.eng').addClass('hidden').removeClass('active');
                        $('.rus').addClass('active').removeClass('hidden');
                        $('li').shuffle();
                        $('.eng').each(function () {
                            $(this).before($(this).siblings('.rus'));
                        });
                        break;

                    case 87:
                    case 1062:

                        $('.rus').addClass('hidden').removeClass('active');
                        $('.eng').addClass('active').removeClass('hidden');
                        $('li').shuffle();
                        $('.rus').each(function () {
                            $(this).before($(this).siblings('.eng'));
                        });
                        break;

                    case 13:
                        let eng = $("#new-eng");
                        let rus = $("#new-rus");

                        if (eng.val() === "" && rus.val() === "") window.stop();
                        if (eng.val() === "") rus_into_eng(rus.val());
                        else if (rus.val() === "") eng_into_rus(eng.val());
                        else {
                            add_couple(eng.val(), rus.val());
                            save_couple(eng, rus);
                        }
                }
            }
        );
});