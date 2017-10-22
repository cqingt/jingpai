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
 * @fileOverview Defines the {@link CKFinder.lang} object, for the English
 *		language. This is the base file for all translations.
 */

/**
 * Constains the dictionary of language entries.
 * @namespace
 */
CKFinder.lang['he'] =
{
	appTitle : 'CKFinder',

	// Common messages and labels.
	common :
	{
		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">,  </span>',
		confirmCancel	: '  .   ?',
		ok				: '',
		cancel			: '',
		confirmationTitle	: '',
		messageTitle	: '',
		inputTitle		: '',
		undo			: '',
		redo			: ' ',
		skip			: '',
		skipAll			: ' ',
		makeDecision	: '  ?',
		rememberDecision: ' '
	},


	dir : 'rtl',
	HelpLang : 'en',
	LangCode : 'he',

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
	DateTime : 'm/d/yyyy h:MM aa',
	DateAmPm : ['AM', 'PM'],

	// Folders
	FoldersTitle	: '',
	FolderLoading	: '...',
	FolderNew		: '   : ',
	FolderRename	: '   : ',
	FolderDelete	: '    "%1" ?',
	FolderRenaming	: ' ( ...)',
	FolderDeleting	: ' (...)',

	// Files
	FileRename		: '   : ',
	FileRenameExt	: '     ',
	FileRenaming	: ' ...',
	FileDelete		: '    "%1"?',
	FilesLoading	: '...',
	FilesEmpty		: ' ',
	FilesMoved		: ' %1  - %2:%3',
	FilesCopied		: ' %1  - %2:%3',

	// Basket
	BasketFolder		: '',
	BasketClear			: ' ',
	BasketRemove		: ' ',
	BasketOpenFolder	: '  ',
	BasketTruncateConfirm : '      ?',
	BasketRemoveConfirm	: '     "%1" ?',
	BasketEmpty			: '  ,   .',
	BasketCopyFilesHere	: '  ',
	BasketMoveFilesHere	: '  ',

	BasketPasteErrorOther	: ' %s : %e',
	BasketPasteMoveSuccess	: '  : %s',
	BasketPasteCopySuccess	: '  : %s',

	// Toolbar Buttons (some used elsewhere)
	Upload		: '',
	UploadTip	: '  ',
	Refresh		: '',
	Settings	: '',
	Help		: '',
	HelpTip		: '',

	// Context Menus
	Select			: '',
	SelectThumbnail : '  ',
	View			: '',
	Download		: '',

	NewSubFolder	: '- ',
	Rename			: ' ',
	Delete			: '',

	CopyDragDrop	: '  ',
	MoveDragDrop	: '  ',

	// Dialogs
	RenameDlgTitle		: ' ',
	NewNameDlgTitle		: ' ',
	FileExistsDlgTitle	: '  ',
	SysErrorDlgTitle : ' ',

	FileOverwrite	: '',
	FileAutorename	: '  ',

	// Generic
	OkBtn		: '',
	CancelBtn	: '',
	CloseBtn	: '',

	// Upload Panel
	UploadTitle			: '  ',
	UploadSelectLbl		: '  ',
	UploadProgressLbl	: '( ,  ...)',
	UploadBtn			: ' ',
	UploadBtnCancel		: '',

	UploadNoFileMsg		: '    ',
	UploadNoFolder		: '    .',
	UploadNoPerms		: '  .',
	UploadUnknError		: '  .',
	UploadExtIncorrect	: '      .',

	// Settings Panel
	SetTitle		: '',
	SetView			: ':',
	SetViewThumb	: ' ',
	SetViewList		: '',
	SetDisplay		: ':',
	SetDisplayName	: ' ',
	SetDisplayDate	: '',
	SetDisplaySize	: ' ',
	SetSort			: ':',
	SetSortName		: ' ',
	SetSortDate		: ' ',
	SetSortSize		: ' ',

	// Status Bar
	FilesCountEmpty : '< >',
	FilesCountOne	: ' 1',
	FilesCountMany	: '%1 ',

	// Size and Speed
	Kb				: '%1 kB',
	KbPerSecond		: '%1 kB/s',

	// Connector Error Messages.
	ErrorUnknown	: ' . . (Error %1)',
	Errors :
	{
	 10 : 'Invalid command.',
	 11 : 'The resource type was not specified in the request.',
	 12 : 'The requested resource type is not valid.',
	102 : 'Invalid file or folder name.',
	103 : 'It was not possible to complete the request due to authorization restrictions.',
	104 : 'It was not possible to complete the request due to file system permission restrictions.',
	105 : 'Invalid file extension.',
	109 : 'Invalid request.',
	110 : 'Unknown error.',
	115 : 'A file or folder with the same name already exists.',
	116 : 'Folder not found. Please refresh and try again.',
	117 : 'File not found. Please refresh the files list and try again.',
	118 : 'Source and target paths are equal.',
	201 : 'A file with the same name is already available. The uploaded file has been renamed to "%1"',
	202 : 'Invalid file',
	203 : 'Invalid file. The file size is too big.',
	204 : 'The uploaded file is corrupt.',
	205 : 'No temporary folder is available for upload in the server.',
	206 : 'Upload cancelled for security reasons. The file contains HTML like data.',
	207 : 'The uploaded file has been renamed to "%1"',
	300 : 'Moving file(s) failed.',
	301 : 'Copying file(s) failed.',
	500 : 'The file browser is disabled for security reasons. Please contact your system administrator and check the CKFinder configuration file.',
	501 : 'The thumbnails support is disabled.'
	},

	// Other Error Messages.
	ErrorMsg :
	{
		FileEmpty		: '     ',
		FileExists		: ' %s already exists',
		FolderEmpty		: '     ',

		FileInvChar		: '      : \n\\ / : * ? " < > |',
		FolderInvChar	: '      : \n\\ / : * ? " < > |',

		PopupBlockView	: '     .         .'
	},

	// Imageresize plugin
	Imageresize :
	{
		dialogTitle		: '  %s',
		sizeTooBig		: '           (%size).',
		resizeSuccess	: '  .',
		thumbnailNew	: '  )(',
		thumbnailSmall	: ' (%s)',
		thumbnailMedium	: ' (%s)',
		thumbnailLarge	: ' (%s)',
		newSize			: '  ',
		width			: '',
		height			: '',
		invalidHeight	: '  .',
		invalidWidth	: '  .',
		invalidName		: '   .',
		newImage		: '  ',
		noExtensionChange : '    .',
		imageSmall		: '   ',
		contextMenuName	: ' '
	},

	// Fileeditor plugin
	Fileeditor :
	{
		save			: '',
		fileOpenError	: '   .',
		fileSaveSuccess	: '  .',
		contextMenuName	: '',
		loadingFile		: ' ,  ...'
	}
};
