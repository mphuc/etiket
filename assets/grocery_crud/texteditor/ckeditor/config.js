/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config
	config.toolbar = 'Full';
 
/*	config.toolbar_Full =
	[
		{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript'] },
		{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote',
		'-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'] },
		{ name: 'styles', items : [ 'Format','Font'] },
		{ name: 'colors', items : [ 'TextColor','BGColor' ] },
		{ name: 'insert', items : [ 'Image','Table','HorizontalRule','Smiley','PageBreak' ] },
		{ name: 'document', items : [ 'Source','Preview','Print','-','Templates' ] },
		{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo'] },
		{ name: 'editing', items : [ 'Find'] },
		{ name: 'forms'},
		{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
		
		{ name: 'tools', items : [ 'Maximize'] }
	];*/
	 config.toolbar_Full =
		[
			{ name: 'styles', items : [ 'Format','Font'] },
			{ name: 'colors', items : [ 'TextColor','BGColor' ] },
			{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript'] },
			{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote',
			'-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'] },
			{ name: 'insert', items : [ 'Image','Table','HorizontalRule','Smiley','PageBreak' ] },
			{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
			{ name: 'links', items : [ 'Link','Anchor' ] },
			{ name: 'document', items : [ 'Source','Print','-','Templates' ] },
			{ name: 'editing', items : [ 'Find'] },
			{ name: 'forms'},
			{ name: 'tools', items : [ 'Maximize' ] }
		];
	config.smiley_path = '/2016_hcei/assets/smiley/';
	config.smiley_images = [
    'regular_smile.gif','sad_smile.gif','wink_smile.gif','teeth_smile.gif','confused_smile.gif','tongue_smile.gif',
    'embarrassed_smile.gif','omg_smile.gif','whatchutalkingabout_smile.gif','angry_smile.gif','angel_smile.gif','shades_smile.gif',
    'devil_smile.gif','cry_smile.gif','lightbulb.gif','thumbs_down.gif','thumbs_up.gif','heart.gif',
    'broken_heart.gif','kiss.gif','envelope.gif'
	];
	config.smiley_descriptions = [
    ':)', ':(', ';)', ':D', ':/', ':P', ':*)', ':-o',
    ':|', '>:(', 'o:)', '8-)', '>:-)', ';(', '', '', '',
    '', '', ':-*', ''
	];	
	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.skin = 'office2013';
};
