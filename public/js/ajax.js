/* item - пара англ. слово - рус. слово */

//###################//
/* Функции для items */
{
    function get_items(flashcard_id) {
        $.ajax({
            type: "POST",
            url: "/item",
            async: true,
            dataType: 'json',
            data: {
                flashcard_id: flashcard_id,
            },
            success: function (data) {

                $('.flashcard-page').addClass('hidden-page');
                $('.item-page').removeClass('hidden-page').attr('value', flashcard_id);

                $(data).each(function (i, value) {
                    let eng = value['eng'];
                    let rus = value['rus'];
                    let id = value['id'];
                    let checked = parseInt(value['status']) === 1 ? 'checked' : '';
                    add_couple(eng, rus, checked, id);
                });
            }
        });
    }

    function create_item(eng, rus, flashcard_id) {
        $.ajax({
            type: "POST",
            url: "/item/create",
            async: true,
            dataType: 'json',
            data: {
                rus: rus,
                eng: eng,
                flashcard_id: flashcard_id
            },
            success: function (data) {
                add_couple(data.eng, data.rus, data.status, data.id);
            }
        });
    }

    function delete_item(item) {
        $.ajax({
            type: "POST",
            url: "/item/delete",
            async: true,
            dataType: 'json',
            data: {
                item_id: item.val(),
            },
            success: function () {
                item.remove();
            },
        });
    }

    function update_item(data) {
        $.ajax({
            type: "POST",
            url: "/item/update",
            async: true,
            dataType: 'json',
            data: data,
        });
    }
}

//####################//
/* Функции для flashcards */
{
    function create_flashcard(name) {
        $.ajax({
            type: "POST",
            url: "/flashcard/create",
            async: true,
            dataType: 'json',
            data: {
                name: name,
            },
            success: function (data) {
                add_flashcard(data.name, data.id);
            }
        });
    }

    function delete_flashcard(flashcard) {
        $.ajax({
            type: "POST",
            url: "/flashcard/delete",
            async: true,
            dataType: 'json',
            data: {
                flashcard_id: flashcard.val(),
            },
            success: function () {
                flashcard.remove();
            }
        });
    }

    function update_flashcard(data) {
        $.ajax({
            type: "POST",
            url: "/flashcard/update",
            async: true,
            dataType: 'json',
            data: data,
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

                if (eng !== rus) {
                    let flashcard_id = $('.item-page').attr('value');
                    create_item(eng, rus, flashcard_id);
                }

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

                if (eng !== rus) {
                    let flashcard_id = $('.item-page').attr('value');
                    create_item(eng, rus, flashcard_id);
                }
            }
        });
    }
}