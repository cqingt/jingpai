/*
 * CKFinder
 * ========
 * http://ckfinder.com
 * Copyright (C) 2007-2011, CKSource - Frederico Knabben. All rights reserved.
 *
 * The software, this file and its contents are subject to the CKFinder
 * License. Please read the license.txt file before using, installing, copying,
 * modifying or distribute this file or part of its contents. The contents of
 * this file is part of the Source Code of CKFinder.
 *
 */

/**
 * @fileOverview Defines the {@link CKFinder.lang} object, for the Slovak
 *		language. This is the base file for all translations.
*/

/**
 * Constains the dictionary of language entries.
 * @namespace
 */
CKFinder.lang['sk'] =
{
	appTitle : 'CKFinder', // MISSING

	// Common messages and labels.
	common :
	{
		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, unavailable</span>', // MISSING
		confirmCancel	: 'Some of the options have been changed. Are you sure to close the dialog?', // MISSING
		ok				: 'OK', // MISSING
		cancel			: 'Cancel', // MISSING
		confirmationTitle	: 'Confirmation', // MISSING
		messageTitle	: 'Information', // MISSING
		inputTitle		: 'Question', // MISSING
		undo			: 'Undo', // MISSING
		redo			: 'Redo', // MISSING
		skip			: 'Skip', // MISSING
		skipAll			: 'Skip all', // MISSING
		makeDecision	: 'What action should be taken?', // MISSING
		rememberDecision: 'Remember my decision' // MISSING
	},


	dir : 'ltr', // MISSING
	HelpLang : 'en',
	LangCode : 'sk',

	// Date Format
	//		d    : Day
	//		dd   : Day (padding zero)
	//		m    : Month
	//		mm   : Month (padding zero)
	//		yy   : Year (two digits)
	//		yyyy : Year (four digits)
	//		h    : Hour (12 hour clock)
	//		hh   : Hour (12 hour clock, padding zero)
	//		H    : Hour (24 hour clock)
	//		HH   : Hour (24 hour clock, padding zero)
	//		M    : Minute
	//		MM   : Minute (padding zero)
	//		a    : Firt char of AM/PM
	//		aa   : AM/PM
	DateTime : 'mm/dd/yyyy HH:MM',
	DateAmPm : ['AM', 'PM'],

	// Folders
	FoldersTitle	: 'Adresáre',
	FolderLoading	: 'Nahrávam...',
	FolderNew		: 'Zadajte prosím meno nového adresára: ',
	FolderRename	: 'Zadajte prosím meno nového adresára: ',
	FolderDelete	: 'Skutocne zmazat adresár "%1" ?',
	FolderRenaming	: ' (Prebieha premenovanie adresára...)',
	FolderDeleting	: ' (Prebieha zmazanie adresára...)',

	// Files
	FileRename		: 'Zadajte prosím meno nového súboru: ',
	FileRenameExt	: 'Skutocne chcete zmenit príponu súboru? Upozornenie: zmenou prípony sa súbor m^oze stat nepouziteln'ym, pokial prípona nie je podporovaná.',
	FileRenaming	: 'Prebieha premenovanie súboru...',
	FileDelete		: 'Skutocne chcete odstránit súbor "%1"?',
	FilesLoading	: 'Loading...', // MISSING
	FilesEmpty		: 'Empty folder', // MISSING
	FilesMoved		: 'File %1 moved into %2:%3', // MISSING
	FilesCopied		: 'File %1 copied into %2:%3', // MISSING

	// Basket
	BasketFolder		: 'Basket', // MISSING
	BasketClear			: 'Clear Basket', // MISSING
	BasketRemove		: 'Remove from basket', // MISSING
	BasketOpenFolder	: 'Open parent folder', // MISSING
	BasketTruncateConfirm : 'Do you really want to remove all files from the basket?', // MISSING
	BasketRemoveConfirm	: 'Do you really want to remove the file "%1" from the basket?', // MISSING
	BasketEmpty			: 'No files in the basket, drag\'n\'drop some.', // MISSING
	BasketCopyFilesHere	: 'Copy Files from Basket', // MISSING
	BasketMoveFilesHere	: 'Move Files from Basket', // MISSING

	BasketPasteErrorOther	: 'File %s error: %e', // MISSING
	BasketPasteMoveSuccess	: 'The following files were moved: %s', // MISSING
	BasketPasteCopySuccess	: 'The following files were copied: %s', // MISSING

	// Toolbar Buttons (some used elsewhere)
	Upload		: 'Prekopírovat na server (Upload)',
	UploadTip	: 'Prekopírovat nov'y súbor',
	Refresh		: 'Znovunacítat (Refresh)',
	Settings	: 'Nastavenia',
	Help		: 'Pomoc',
	HelpTip		: 'Pomoc',

	// Context Menus
	Select			: 'Vybrat',
	SelectThumbnail : 'Select Thumbnail', // MISSING
	View			: 'Náhlad',
	Download		: 'Stiahnut',

	NewSubFolder	: 'Nov'y podadresár',
	Rename			: 'Premenovat',
	Delete			: 'Zmazat',

	CopyDragDrop	: 'Copy file here', // MISSING
	MoveDragDrop	: 'Move file here', // MISSING

	// Dialogs
	RenameDlgTitle		: 'Rename', // MISSING
	NewNameDlgTitle		: 'New name', // MISSING
	FileExistsDlgTitle	: 'File already exists', // MISSING
	SysErrorDlgTitle : 'System error', // MISSING

	FileOverwrite	: 'Overwrite', // MISSING
	FileAutorename	: 'Auto-rename', // MISSING

	// Generic
	OkBtn		: 'OK',
	CancelBtn	: 'Zrusit',
	CloseBtn	: 'Zatvorit',

	// Upload Panel
	UploadTitle			: 'Nahrat nov'y súbor',
	UploadSelectLbl		: 'Vyberte súbor, ktor'y chcete prekopírovat na server',
	UploadProgressLbl	: '(Prebieha kopírovanie, cakajte prosím...)',
	UploadBtn			: 'Prekopírovat vybrat'y súbor',
	UploadBtnCancel		: 'Cancel', // MISSING

	UploadNoFileMsg		: 'Vyberte prosím súbor na Vasom pocítaci!',
	UploadNoFolder		: 'Please select folder before uploading.', // MISSING
	UploadNoPerms		: 'File upload not allowed.', // MISSING
	UploadUnknError		: 'Error sending the file.', // MISSING
	UploadExtIncorrect	: 'File extension not allowed in this folder.', // MISSING

	// Settings Panel
	SetTitle		: 'Nastavenia',
	SetView			: 'Náhlad:',
	SetViewThumb	: 'Miniobrázky',
	SetViewList		: 'Zoznam',
	SetDisplay		: 'Zobrazit:',
	SetDisplayName	: 'Názov súboru',
	SetDisplayDate	: 'Dátum',
	SetDisplaySize	: 'Velkost súboru',
	SetSort			: 'Zoradenie:',
	SetSortName		: 'podla názvu súboru',
	SetSortDate		: 'podla dátumu',
	SetSortSize		: 'podla velkosti',

	// Status Bar
	FilesCountEmpty : '<Prázdny adresár>',
	FilesCountOne	: '1 súbor',
	FilesCountMany	: '%1 súborov',

	// Size and Speed
	Kb				: '%1 kB',
	KbPerSecond		: '%1 kB/s',

	// Connector Error Messages.
	ErrorUnknown	: 'Server nemohol dokoncit spracovanie poziadavky. (Chyba %1)',
	Errors :
	{
	 10 : 'Neplatn'y príkaz.',
	 11 : 'V poziadavke nebol specifikovan'y typ súboru.',
	 12 : 'Nepodporovan'y typ súboru.',
	102 : 'Neplatn'y názov súboru alebo adresára.',
	103 : 'Nebolo mozné dokoncit spracovanie poziadavky kv^oli nepostacujúcej úrovni oprávnení.',
	104 : 'Nebolo mozné dokoncit spracovanie poziadavky kv^oli obmedzeniam v prístupov'ych právach ku súborom.',
	105 : 'Neplatná prípona súboru.',
	109 : 'Neplatná poziadavka.',
	110 : 'Neidentifikovaná chyba.',
	115 : 'Zadan'y súbor alebo adresár uz existuje.',
	116 : 'Adresár nebol nájden'y. Aktualizujte obsah adresára (Znovunacítat) a skúste znovu.',
	117 : 'Súbor nebol nájden'y. Aktualizujte obsah adresára (Znovunacítat) a skúste znovu.',
	118 : 'Source and target paths are equal.', // MISSING
	201 : 'Súbor so zadan'ym názvom uz existuje. Prekopírovan'y súbor bol premenovan'y na "%1"',
	202 : 'Neplatn'y súbor',
	203 : 'Neplatn'y súbor - súbor presahuje maximálnu povolenú velkost.',
	204 : 'Kopírovan'y súbor je poskoden'y.',
	205 : 'Server nemá specifikovan'y docasn'y adresár pre kopírované súbory.',
	206 : 'Kopírovanie prerusené kv^oli nedostatocnému zabezpeceniu. Súbor obsahuje HTML data.',
	207 : 'Prekopírovan'y súbor bol premenovan'y na "%1"',
	300 : 'Moving file(s) failed.', // MISSING
	301 : 'Copying file(s) failed.', // MISSING
	500 : 'Prehliadanie súborov je zakázané kv^oli bezpecnosti. Kontaktujte prosím administrátora a overte nastavenia v konfiguracnom súbore pre CKFinder.',
	501 : 'Momentálne nie je zapnutá podpora pre generáciu miniobrázkov.'
	},

	// Other Error Messages.
	ErrorMsg :
	{
		FileEmpty		: 'Názov súbor nesmie prázdny',
		FileExists		: 'File %s already exists', // MISSING
		FolderEmpty		: 'Názov adresára nesmie byt prázdny',

		FileInvChar		: 'Súbor nesmie obsahovat ziadny z nasledujúcich znakov: \n\\ / : * ? " < > |',
		FolderInvChar	: 'Adresár nesmie obsahovat ziadny z nasledujúcich znakov: \n\\ / : * ? " < > |',

		PopupBlockView	: 'Nebolo mozné otvorit súbor v novom okne. Overte nastavenia Vásho prehliadaca a zakázte vsetky blokovace popup okien pre túto webstránku.'
	},

	// Imageresize plugin
	Imageresize :
	{
		dialogTitle		: 'Resize %s', // MISSING
		sizeTooBig		: 'Cannot set image height or width to a value bigger than the original size (%size).', // MISSING
		resizeSuccess	: 'Image resized successfully.', // MISSING
		thumbnailNew	: 'Create new thumbnail', // MISSING
		thumbnailSmall	: 'Small (%s)', // MISSING
		thumbnailMedium	: 'Medium (%s)', // MISSING
		thumbnailLarge	: 'Large (%s)', // MISSING
		newSize			: 'Set new size', // MISSING
		width			: 'Width', // MISSING
		height			: 'Height', // MISSING
		invalidHeight	: 'Invalid height.', // MISSING
		invalidWidth	: 'Invalid width.', // MISSING
		invalidName		: 'Invalid file name.', // MISSING
		newImage		: 'Create new image', // MISSING
		noExtensionChange : 'The file extension cannot be changed.', // MISSING
		imageSmall		: 'Source image is too small', // MISSING
		contextMenuName	: 'Resize' // MISSING
	},

	// Fileeditor plugin
	Fileeditor :
	{
		save			: 'Save', // MISSING
		fileOpenError	: 'Unable to open file.', // MISSING
		fileSaveSuccess	: 'File saved successfully.', // MISSING
		contextMenuName	: 'Edit', // MISSING
		loadingFile		: 'Loading file, please wait...' // MISSING
	}
};
