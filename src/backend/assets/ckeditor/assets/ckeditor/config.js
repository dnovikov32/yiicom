/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
    config.toolbarGroups = [
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
        { name: 'paragraph', groups: [ 'list', 'align', 'paragraph' ] },
        { name: 'styles', groups: [ 'styles' ] },
        { name: 'links', groups: [ 'links' ] },
        { name: 'insert', groups: [ 'insert' ] },
        { name: 'tools', groups: [ 'tools' ] },
        { name: 'document', groups: [ 'mode'] }
    ];
    config.removeButtons = 'Subscript,Superscript,Scayt,HorizontalRule,Blockquote,Indent,Outdent,Styles,Font,Format,Flash,Smiley,PageBreak,Iframe,ShowBlocks,Save,Print,Preview,NewPage';

    config.height = 300;
    config.language = 'en';
    config.enterMode = CKEDITOR.ENTER_P;
    config.shiftEnterMode = CKEDITOR.ENTER_BR;
    config.entities = false;
    config.allowedContent = true;
    config.format_tags = 'p;h1;h2;h3;pre;div';
    config.extraAllowedContent = 'div';
    config.filebrowserBrowseUrl = '/elfinder/manager';
    config.filebrowserImageBrowseUrl = '/elfinder/manager?filter=image';
    config.filebrowserFlashBrowseUrl = '/elfinder/manager?filter=flash';

    // Allow empty tags
    config.protectedSource.push(/<a[^>]*><\/a>/g);
    config.protectedSource.push(/<i[^>]*><\/i>/g);
    config.protectedSource.push(/<em[^>]*><\/em>/g);
    config.protectedSource.push(/<li[^>]*><\/li>/g);
    config.protectedSource.push(/<span[^>]*><\/span>/g);
    config.protectedSource.push(/<div[^>]*><\/div>/g);

    config.extraPlugins = 'codemirror';
    config.codemirror = {
        indentUnit: 4,
        indentWithTabs: true,
        showFormatButton: false,
        showCommentButton: false,
        showUncommentButton: false,
        showAutoCompleteButton: false
    };

};





CKEDITOR.on( 'instanceReady', function(ev) {
    var editor = ev.editor,
        dataProcessor = editor.dataProcessor,
        htmlFilter = dataProcessor && dataProcessor.htmlFilter;

    var tags = ['div','h1','h2','h3','h4','h5','h6','p','pre','ul','li','table','td','tr','blockquote'],
        rules = {
            indent: true,
            breakBeforeOpen: true,
            breakAfterOpen: false,
            breakBeforeClose: false,
            breakAfterClose: true
        };


    tags.forEach(function(tag) {
        dataProcessor.writer.setRules(tag, rules);
    });

    // Disable tag attribute sort
    dataProcessor.writer.sortAttributes = false;

    // Out self closing tags the HTML4 way, like <br>.
    dataProcessor.writer.selfClosingEnd = '>';

    // Output properties as attributes, not styles.
    htmlFilter.addRules({
        elements: {
            $: function(element) {
                // Output dimensions of images as width and height
                if(element.name == 'img') {
                    var style = element.attributes.style;

                    if(style) {
                        // Get the width from the style.
                        var match = /(?:^|\s)width\s*:\s*(\d+)px/i.exec( style ),
                            width = match && match[1];

                        // Get the height from the style.
                        match = /(?:^|\s)height\s*:\s*(\d+)px/i.exec( style );
                        var height = match && match[1];

                        if(width) {
                            element.attributes.style = element.attributes.style.replace(/(?:^|\s)width\s*:\s*(\d+)px;?/i, '');
                            element.attributes.width = width;
                        }

                        if(height) {
                            element.attributes.style = element.attributes.style.replace(/(?:^|\s)height\s*:\s*(\d+)px;?/i, '');
                            element.attributes.height = height;
                        }
                    }
                }

                if(!element.attributes.style) {
                    delete element.attributes.style;
                }

                return element;
            }
        }
    });
});
