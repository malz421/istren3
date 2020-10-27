/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
 config.filebrowserBrowseUrl = '/alunaizy/assets/kcfinder/browse.php?opener=ckeditor&type=files';
   config.filebrowserImageBrowseUrl ='/alunaizy/assets/kcfinder/browse.php?opener=ckeditor&type=images';
   config.filebrowserFlashBrowseUrl = '/alunaizy/assets/kcfinder/browse.php?opener=ckeditor&type=flash';
   config.filebrowserUploadUrl = '/alunaizy/assets/kcfinder/upload.php?opener=ckeditor&type=files';
   config.filebrowserImageUploadUrl = '/alunaizy/assets/kcfinder/upload.php?opener=ckeditor&type=images';
   config.filebrowserFlashUploadUrl = '/alunaizy/assets/kcfinder/upload.php?opener=ckeditor&type=flash';
};
