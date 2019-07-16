/* item - пара англ. слово - рус. слово */

//###################//
/* Функции для items */
{
    function get_items(block_id) {
        $.ajax({
            type: "POST",
            url: "/item",
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

    function create_item(eng, rus, block_id) {
        $.ajax({
            type: "POST",
            url: "/item/create",
            async: true,
            dataType: 'json',
            data: {
                rus: rus,
                eng: eng,
                parent: block_id
            },
        });
    }

    function delete_item(rus, eng) {
        $.ajax({
            type: "POST",
            url: "/item/delete",
            async: true,
            dataType: 'json',
            data: {
                del_rus: rus,
                del_eng: eng,
            },
        });
    }

    function save_item_status(status, item_id) {
        $.ajax({
            type: "POST",
            url: "/item/update",
            async: true,
            dataType: 'json',
            data: {
                status: status,
                item_id: item_id,
            },
        });
    }
}

//####################//
/* Функции для blocks */
{
    function create_block(block_name) {
        $.ajax({
            type: "POST",
            url: "/save",
            async: true,
            dataType: 'json',
            data: {
                block_name: block_name,
            },
        });
    }

    function delete_block(block_name) {
        $.ajax({
            type: "POST",
            url: "/delete",
            async: true,
            dataType: 'json',
            data: {
                del_block: block_name,
            },
        });
    }

    function save_block_status(status, block_id) {
        $.ajax({
            type: "POST",
            url: "/update",
            async: true,
            dataType: 'json',
            data: {
                status: status,
                block_id: block_id,
            },
        });
    }
}

//##########################################//
/* Функции перевода (Yandex.Translater API) */
{
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
}