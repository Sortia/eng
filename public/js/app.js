// TODO bug with hot keys (shift + 1, 2, 3, ...) ?
let chars_arr = [
    ['q', 'й'], ['w', 'ц'], ['e', 'у'], ['r', 'к'], ['t', 'е'],
    ['y', 'н'], ['u', 'г'], ['i', 'ш'], ['o', 'щ'], ['p', 'з'],
    ['[', 'х'], [']', 'ъ'], ['a', 'ф'], ['s', 'ы'], ['d', 'в'],
    ['f', 'а'], ['g', 'п'], ['h', 'р'], ['j', 'о'], ['k', 'л'],
    ['l', 'д'], [';', 'ж'], ['\'', 'э'], ['z', 'я'], ['x', 'ч'],
    ['c', 'с'], ['v', 'м'], ['b', 'и'], ['n', 'т'], ['m', 'ь'],
    [',', 'б'], ['.', 'ю'], ['/', '.'], [' ', ' '], ['?', ','],
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

function add_couple(eng, rus, status, id) {
    $("#new-eng, #new-rus").val('');
    $(".voc-list").prepend
    (
        "<li class='view item-item' value='" + id + "'>\n" +
            "<input class='toggle' type='checkbox' " + status + ">\n" +
            "<label class='active eng'>" + eng + "</label>\n" +
            "<label class='hidden rus'>" + rus + "</label>\n" +
            "<i class='icon-pencil edit-item'></i>" +
            "<i class='destroy'></i>\n" +
        "</li>"
    );
    $('#new-eng').focus();
}

function add_block(block, id) {
    $('#new-block').val('');
    $(".block-list").prepend
    (
        "<li class='view item-block' value='" + id + "'>\n" +
            "<input class='toggle' type='checkbox' " + status + ">\n" +
            "<label class='block'>" + block + "</label>\n" +
            "<button class='destroy'></button>\n" +
        "</li>"
    );
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

function getItemData(item) {
    let item_id = item.val();
    let rus = item.children('.rus').text();
    let eng = item.children('.eng').text();
    let item_status = item.children('.toggle').prop("checked");

    return {id: item_id, rus: rus, eng: eng, status: item_status};
}

function getBlockData(block) {
    let block_id = block.val();
    let block_name = block.children('.block').text();
    let block_status = block.children('.toggle').prop("checked");

    return {id: block_id, name: block_name, status: block_status};
}

function moveCarriage(item) {
    let range = document.createRange();
    let sel = window.getSelection();

    range.setStart(item.get(0).childNodes[0], item.get(0).childNodes[0].length);
    range.collapse(true);

    sel.removeAllRanges();
    sel.addRange(range);
}