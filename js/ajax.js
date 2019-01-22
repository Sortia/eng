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