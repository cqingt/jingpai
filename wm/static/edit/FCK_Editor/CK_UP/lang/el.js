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
* @fileOverview
*/

/**
 * Constains the dictionary of language entries.
 * @namespace
 */
CKFinder.lang['el'] =
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
	LangCode : 'el',

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
	DateTime : 'dd/mm/yyyy HH:MM',
	DateAmPm : ['ΜΜ', 'ΠΜ'],

	// Folders
	FoldersTitle	: 'Φκελοι',
	FolderLoading	: 'Φρτωση...',
	FolderNew		: 'Παρακαλομε πληκτρολογστε την ονομασα του νου φακλου: ',
	FolderRename	: 'Παρακαλομε πληκτρολογστε την να ονομασα του φακλου: ',
	FolderDelete	: 'Εστε σγουροι τι θλετε να διαγρψετε το φκελο "%1";',
	FolderRenaming	: ' (Μετονομασα...)',
	FolderDeleting	: ' (Διαγραφ...)',

	// Files
	FileRename		: 'Παρακαλομε πληκτρολογστε την να ονομασα του αρχεου: ',
	FileRenameExt	: 'Εστε σγουροι τι θλετε να αλλξετε την επκταση του αρχεου; Μετ απ αυτ την ενργεια το αρχεο μπορε να μην μπορε να χρησιμοποιηθε',
	FileRenaming	: 'Μετονομασα...',
	FileDelete		: 'Εστε σγουροι τι θλετε να διαγρψετε το αρχεο "%1"?',
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
	Upload		: 'Μεταφρτωση',
	UploadTip	: 'Μεταφρτωση Νου Αρχεου',
	Refresh		: 'Ανανωση',
	Settings	: 'Ρυθμσει',
	Help		: 'Βοθεια',
	HelpTip		: 'Βοθεια',

	// Context Menus
	Select			: 'Επιλογ',
	SelectThumbnail : 'Επιλογ Μικρογραφα',
	View			: 'Προβολ',
	Download		: 'Λψη Αρχεου',

	NewSubFolder	: 'Νο Υποφκελο',
	Rename			: 'Μετονομασα',
	Delete			: 'Διαγραφ',

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
	CancelBtn	: 'Ακρωση',
	CloseBtn	: 'Κλεσιμο',

	// Upload Panel
	UploadTitle			: 'Μεταφρτωση Νου Αρχεου',
	UploadSelectLbl		: 'επιλξτε το αρχεο που θλετε να μεταφερθε κνοντα κλκ στο κουμπ',
	UploadProgressLbl	: '(Η μεταφρτωση εκτελεται, παρακαλομε περιμνετε...)',
	UploadBtn			: 'Μεταφρτωση Επιλεγμνου Αρχεου',
	UploadBtnCancel		: 'Cancel', // MISSING

	UploadNoFileMsg		: 'Παρακαλομε επιλξτε να αρχεο απ τον υπολογιστ σα',
	UploadNoFolder		: 'Please select folder before uploading.', // MISSING
	UploadNoPerms		: 'File upload not allowed.', // MISSING
	UploadUnknError		: 'Error sending the file.', // MISSING
	UploadExtIncorrect	: 'File extension not allowed in this folder.', // MISSING

	// Settings Panel
	SetTitle		: 'Ρυθμσει',
	SetView			: 'Προβολ:',
	SetViewThumb	: 'Μικρογραφε',
	SetViewList		: 'Λστα',
	SetDisplay		: 'Εμφνιση:',
	SetDisplayName	: 'νομα Αρχεου',
	SetDisplayDate	: 'Ημερομηνα',
	SetDisplaySize	: 'Μγεθο Αρχεου',
	SetSort			: 'Ταξινμηση:',
	SetSortName		: 'βσει νοματο Αρχεου',
	SetSortDate		: 'βσει Ημερομνια',
	SetSortSize		: 'βσει Μεγθου',

	// Status Bar
	FilesCountEmpty : '<Κεν Φκελο>',
	FilesCountOne	: '1 αρχεο',
	FilesCountMany	: '%1 αρχεα',

	// Size and Speed
	Kb				: '%1 kB',
	KbPerSecond		: '%1 kB/s',

	// Connector Error Messages.
	ErrorUnknown	: 'Η ενργεια δεν ταν δυνατν να εκτελεστε. (Σφλμα %1)',
	Errors :
	{
	 10 : 'Λανθασμνη Εντολ.',
	 11 : 'Το resource type δεν ταν δυνατν να προσδιορστε.',
	 12 : 'Το resource type δεν εναι γκυρο.',
	102 : 'Το νομα αρχεου  φακλου δεν εναι γκυρο.',
	103 : 'Δεν ταν δυνατ η εκτλεση τη ενργεια λγω λλειψη δικαιωμτων ασφαλεα.',
	104 : 'Δεν ταν δυνατ η εκτλεση τη ενργεια λγω περιορισμν του συστματο αρχεων.',
	105 : 'Λανθασμνη Επκταση Αρχεου.',
	109 : 'Λανθασμνη Ενργεια.',
	110 : 'γνωστο Λθο.',
	115 : 'Το αρχεο  φκελο υπρχει δη.',
	116 : 'Ο φκελο δεν βρθηκε. Παρακαλομε ανανεστε τη σελδα και προσπαθστε ξαν.',
	117 : 'Το αρχεο δεν βρθηκε. Παρακαλομε ανανεστε τη σελδα και προσπαθστε ξαν.',
	118 : 'Source and target paths are equal.', // MISSING
	201 : 'να αρχεο με την δια ονομασα υπρχει δη. Το μεταφορτωμνο αρχεο μετονομστηκε σε "%1"',
	202 : 'Λανθασμνο Αρχεο',
	203 : 'Λανθασμνο Αρχεο. Το μγεθο του αρχεου εναι πολ μεγλο.',
	204 : 'Το μεταφορτωμνο αρχεο εναι χαλασμνο.',
	205 : 'Δεν υπρχει προσωριν φκελο για να χρησιμοποιηθε για τι μεταφορτσει των αρχεων.',
	206 : 'Η μεταφρτωση ακυρθηκε για λγου ασφαλεα. Το αρχεο περιχει δεδομνα μορφ HTML.',
	207 : 'Το μεταφορτωμνο αρχεο μετονομστηκε σε "%1"',
	300 : 'Moving file(s) failed.', // MISSING
	301 : 'Copying file(s) failed.', // MISSING
	500 : 'Ο πλοηγ αρχεων χει απενεργοποιηθε για λγου ασφαλεα. Παρακαλομε επικοινωνστε με τον διαχειριστ τη ιστοσελδα και ελγξτε το αρχεο ρυθμσεων του πλοηγο (CKFinder).',
	501 : 'Η υποστριξη των μικρογραφιν χει απενεργοποιηθε.'
	},

	// Other Error Messages.
	ErrorMsg :
	{
		FileEmpty		: 'Η ονομασα του αρχεου δεν μπορε να εναι κεν',
		FileExists		: 'File %s already exists', // MISSING
		FolderEmpty		: 'Η ονομασα του φακλου δεν μπορε να εναι κεν',

		FileInvChar		: 'Η ονομασα του αρχεου δεν μπορε να περιχει του ακλουθου χαρακτρε: \n\\ / : * ? " < > |',
		FolderInvChar	: 'Η ονομασα του φακλου δεν μπορε να περιχει του ακλουθου χαρακτρε: \n\\ / : * ? " < > |',

		PopupBlockView	: 'Δεν ταν εφικτ να ανοξει το αρχεο σε νο παρθυρο. Παρακαλ, ελγξτε τι ρυθμσει του πλοηγο σα και απενεργοποιστε λου του popup blockers για αυτ την ιστοσελδα.'
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
