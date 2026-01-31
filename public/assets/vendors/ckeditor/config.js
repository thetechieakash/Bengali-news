/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
};

CKEDITOR.editorConfig = function(config){
	config.extraPlugins = 'fontawesome';
	config.contentsCss = [
		'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css'
	];
};	
CKEDITOR.dtd.$removeEmpty['i'] = false;	
CKEDITOR.config.allowedContent = true;