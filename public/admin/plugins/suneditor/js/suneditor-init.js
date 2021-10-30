let editorKey = "sun_editor";
SUNEDITOR.create(editorKey, {
    display: 'block',
    width: '100%',
    height: 'auto',
    popupDisplay: 'full',
    charCounter: true,
    charCounterLabel: 'Characters :',
    imageGalleryUrl: 'https://etyswjpn79.execute-api.ap-northeast-1.amazonaws.com/suneditor-demo',
    buttonList: [
        // default
        ['save'],
        ['undo', 'redo'],
        ['font', 'fontSize', 'formatBlock'],
        ['paragraphStyle', 'blockquote'],
        ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
        ['fontColor', 'hiliteColor', 'textStyle'],
        ['removeFormat'],
        ['outdent', 'indent'],
        ['align', 'horizontalRule', 'list', 'lineHeight'],
        ['table', 'link', 'image', 'video', 'audio', 'math'],
        // ['imageGallery'],
        ['fullScreen', 'showBlocks', 'codeView'],
        ['preview', 'print'],
        // (min-width: 1565)
        ['%1565', [
            ['save', 'undo', 'redo'],
            ['font', 'fontSize', 'formatBlock'],
            ['paragraphStyle', 'blockquote'],
            ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
            ['fontColor', 'hiliteColor', 'textStyle'],
            ['removeFormat'],
            ['outdent', 'indent'],
            ['align', 'horizontalRule', 'list', 'lineHeight'],
            ['table', 'link', 'image', 'video', 'audio', 'math'],
            // ['imageGallery'],
            ['fullScreen', 'showBlocks', 'codeView' , 'preview', 'print'],
            // ['-right', ':i-More Misc-default.more_vertical', 'preview', 'print']
        ]],
        // (min-width: 1455)
        ['%1455', [
            ['save', 'undo', 'redo'],
            ['font', 'fontSize', 'formatBlock'],
            ['paragraphStyle', 'blockquote'],
            ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
            ['fontColor', 'hiliteColor', 'textStyle'],
            ['removeFormat'],
            ['outdent', 'indent'],
            ['align', 'horizontalRule', 'list', 'lineHeight'],
            ['table', 'link', 'image', 'video', 'audio', 'math'],
            // ['imageGallery'],
            ['fullScreen', 'showBlocks', 'codeView' , 'preview', 'print'],
            // ['-right', ':i-More Misc-default.more_vertical', 'fullScreen', 'showBlocks', 'codeView', 'preview', 'print']
        ]],
        // (min-width: 1326)
        ['%1326', [
            ['save', 'undo', 'redo'],
            ['font', 'fontSize', 'formatBlock'],
            ['paragraphStyle', 'blockquote'],
            ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
            ['fontColor', 'hiliteColor', 'textStyle'],
            ['removeFormat'],
            ['outdent', 'indent'],
            ['align', 'horizontalRule', 'list', 'lineHeight'],
            ['fullScreen', 'showBlocks', 'codeView' , 'preview', 'print'],
            // ['-right', ':r-More Rich-default.more_plus', 'table', 'link', 'image', 'video', 'audio', 'math', 'imageGallery']
        ]],
        // (min-width: 1123)
        ['%1123', [
            ['save', 'undo', 'redo'],
            [':p-More Paragraph-default.more_paragraph', 'font', 'fontSize', 'formatBlock', 'paragraphStyle', 'blockquote'],
            ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
            ['fontColor', 'hiliteColor', 'textStyle'],
            ['removeFormat'],
            ['outdent', 'indent'],
            ['align', 'horizontalRule', 'list', 'lineHeight'],
            ['-right', ':i-More Misc-default.more_vertical', 'fullScreen', 'showBlocks', 'codeView', 'preview', 'print'],
            ['-right', ':r-More Rich-default.more_plus', 'table', 'link', 'image', 'video', 'audio', 'math', 'imageGallery']
        ]],
        // (min-width: 817)
        ['%817', [
            ['save', 'undo', 'redo'],
            [':p-More Paragraph-default.more_paragraph', 'font', 'fontSize', 'formatBlock', 'paragraphStyle', 'blockquote'],
            ['bold', 'underline', 'italic', 'strike'],
            [':t-More Text-default.more_text', 'subscript', 'superscript', 'fontColor', 'hiliteColor', 'textStyle'],
            ['removeFormat'],
            ['outdent', 'indent'],
            ['align', 'horizontalRule', 'list', 'lineHeight'],
            ['-right', ':i-More Misc-default.more_vertical', 'fullScreen', 'showBlocks', 'codeView', 'preview', 'print'],
            ['-right', ':r-More Rich-default.more_plus', 'table', 'link', 'image', 'video', 'audio', 'math', 'imageGallery']
        ]],
        // (min-width: 673)
        ['%673', [
            ['save', 'undo', 'redo'],
            [':p-More Paragraph-default.more_paragraph', 'font', 'fontSize', 'formatBlock', 'paragraphStyle', 'blockquote'],
            [':t-More Text-default.more_text', 'bold', 'underline', 'italic', 'strike', 'subscript', 'superscript', 'fontColor', 'hiliteColor', 'textStyle'],
            ['removeFormat'],
            ['outdent', 'indent'],
            ['align', 'horizontalRule', 'list', 'lineHeight'],
            [':r-More Rich-default.more_plus', 'table', 'link', 'image', 'video', 'audio', 'math', 'imageGallery'],
            ['-right', ':i-More Misc-default.more_vertical', 'fullScreen', 'showBlocks', 'codeView', 'preview', 'print']
        ]],
        // (min-width: 525)
        ['%525', [
            ['save', 'undo', 'redo'],
            [':p-More Paragraph-default.more_paragraph', 'font', 'fontSize', 'formatBlock', 'paragraphStyle', 'blockquote'],
            [':t-More Text-default.more_text', 'bold', 'underline', 'italic', 'strike', 'subscript', 'superscript', 'fontColor', 'hiliteColor', 'textStyle'],
            ['removeFormat'],
            ['outdent', 'indent'],
            [':e-More Line-default.more_horizontal', 'align', 'horizontalRule', 'list', 'lineHeight'],
            [':r-More Rich-default.more_plus', 'table', 'link', 'image', 'video', 'audio', 'math', 'imageGallery'],
            ['-right', ':i-More Misc-default.more_vertical', 'fullScreen', 'showBlocks', 'codeView', 'preview', 'print']
        ]],
        // (min-width: 420)
        ['%420', [
            ['save', 'undo', 'redo'],
            [':p-More Paragraph-default.more_paragraph', 'font', 'fontSize', 'formatBlock', 'paragraphStyle', 'blockquote'],
            [':t-More Text-default.more_text', 'bold', 'underline', 'italic', 'strike', 'subscript', 'superscript', 'fontColor', 'hiliteColor', 'textStyle', 'removeFormat'],
            [':e-More Line-default.more_horizontal', 'outdent', 'indent', 'align', 'horizontalRule', 'list', 'lineHeight'],
            [':r-More Rich-default.more_plus', 'table', 'link', 'image', 'video', 'audio', 'math', 'imageGallery'],
            ['-right', ':i-More Misc-default.more_vertical', 'fullScreen', 'showBlocks', 'codeView', 'preview', 'print']
        ]]
    ],
    placeholder: 'Start typing something...',
    codeMirror: CodeMirror,
    katex: katex
});

// SUNEDITOR.create('editor_inline1', {
//     mode: 'inline',
//     display: 'block',
//     width: '100%',
//     height: '162',
//     popupDisplay: 'full',
//     buttonList: [
//         ['bold', 'underline', 'align', 'horizontalRule', 'list', 'table', 'codeView']
//     ],
//     placeholder: 'Start typing something...'
// });
// SUNEDITOR.create('editor_inline2', {
//     mode: 'inline',
//     display: 'block',
//     width: '100%',
//     height: '204',
//     popupDisplay: 'full',
//     buttonList: [
//         ['font', 'fontSize', 'formatBlock'],
//         ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
//         ['codeView']
//     ],
//     placeholder: 'Start typing something...'
// });
// SUNEDITOR.create('editor_inline3', {
//     mode: 'inline',
//     display: 'block',
//     width: '100%',
//     height: 'auto',
//     popupDisplay: 'full',
//     buttonList: [
//         ['link', 'image', 'video']
//     ],
//     placeholder: 'Start typing something...'
// });

// SUNEDITOR.create('editor_balloon', {
//     mode: 'balloon',
//     display: 'block',
//     width: '100%',
//     height: 'auto',
//     popupDisplay: 'full',
//     buttonList: [
//         ['fontSize', 'fontColor', 'bold', 'underline', 'align', 'horizontalRule', 'table', 'codeView']
//     ],
//     placeholder: 'Start typing something...'
// });

// SUNEDITOR.create('editor_balloon_always', {
//     mode: 'balloon-always',
//     display: 'block',
//     width: '100%',
//     height: 'auto',
//     popupDisplay: 'full',
//     buttonList: [
//         ['bold', 'italic', 'link', 'undo', 'redo']
//     ],
//     placeholder: 'Start typing something...'
// });


function openTab(evt, tabName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}


// function autosave(){
//     let isAutosave = document.getElementById(editorKey).hasAttribute("autosave");
//     if(isAutosave){

//     }
//     $(".se-btn._se_command_save.se-resizing-enabled.se-tooltip").trigger("click");
// }