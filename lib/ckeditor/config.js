/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	 config.forcePasteAsPlainText = true;
};

for (var i in CKEDITOR.instances) {
    
    CKEDITOR.instances[i].on('change', function() { CKEDITOR.instances[i].updateElement() });
    CKEDITOR.instances[i].on('mouseenter', function() { CKEDITOR.instances[i].updateElement() });
    CKEDITOR.instances[i].on('mouseleave', function() { CKEDITOR.instances[i].updateElement() });
    CKEDITOR.instances[i].on('click', function() { CKEDITOR.instances[i].updateElement() });
    
    
}