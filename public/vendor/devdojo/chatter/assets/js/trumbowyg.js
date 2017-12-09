function initializeNewTrumbowyg(id){
    $('#'+id).trumbowyg({
        btns: [
            ['viewHTML'],
            ['formatting'],
            'btnGrp-semantic',
            ['link'],
            ['insertImage'],
            'btnGrp-justify',
            'btnGrp-lists',
            ['horizontalRule'],
            ['removeformat'],
            ['preformatted'],
            ['fullscreen']
        ]
    });
}

$('document').ready(function() {
    $('.trumbowyg').trumbowyg({
        btns: [
            ['viewHTML'],
            ['formatting'],
            'btnGrp-semantic',
            ['link'],
            ['insertImage', 'upload'],
            'btnGrp-justify',
            'btnGrp-lists',
            ['horizontalRule'],
            ['removeformat'],
            ['preformatted'],
            ['fullscreen']
        ],
        plugins: {
            //https://alex-d.github.io/Trumbowyg/documentation/plugins/#plugin-upload
            upload: {
                'serverPath': '/api/forum/media?api_token=' + window.FEMR.userToken,
                'fileFieldName': 'media',
                'headers':{

                    'X-CSRF-TOKEN': window.FEMR.csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                'urlPropertyName': 'url'
            }
        }
    });

    document.getElementById('new_discussion_loader').style.display = "none";
    document.getElementById('chatter_form_editor').style.display = "block";

    // check if user is in discussion view
    if ($('#new_discussion_loader_in_discussion_view').length > 0) {
        document.getElementById('new_discussion_loader_in_discussion_view').style.display = "none";
        document.getElementById('chatter_form_editor_in_discussion_view').style.display = "block";
    }
});
