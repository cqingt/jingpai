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
 * @fileOverview Defines the {@link CKFinder.lang} object, for the Danish
 *		language. This is the base file for all translations.
*/

/**
 * Constains the dictionary of language entries.
 * @namespace
 */
CKFinder.lang['da'] =
{
	appTitle : 'CKFinder',

	// Common messages and labels.
	common :
	{
		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, ikke tilgaengelig</span>',
		confirmCancel	: 'Nogle af indstillingerne er blevet aendret. Er du sikker pa at lukke dialogen?',
		ok				: 'OK',
		cancel			: 'Annuller',
		confirmationTitle	: 'Bekraeftelse',
		messageTitle	: 'Information',
		inputTitle		: 'Sporgsmal',
		undo			: 'Fortryd',
		redo			: 'Annuller fortryd',
		skip			: 'Skip',
		skipAll			: 'Skip alle',
		makeDecision	: 'Hvad skal der foretages?',
		rememberDecision: 'Husk denne indstilling'
	},


	dir : 'ltr',
	HelpLang : 'en',
	LangCode : 'da',

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
	DateTime : 'dd-mm-yyyy HH:MM',
	DateAmPm : ['AM', 'PM'],

	// Folders
	FoldersTitle	: 'Mapper',
	FolderLoading	: 'Indlaeser...',
	FolderNew		: 'Skriv navnet pa den nye mappe: ',
	FolderRename	: 'Skriv det nye navn pa mappen: ',
	FolderDelete	: 'Er du sikker pa, at du vil slette mappen "%1" ?',
	FolderRenaming	: ' (Omdober...)',
	FolderDeleting	: ' (Sletter...)',

	// Files
	FileRename		: 'Skriv navnet pa den nye fil: ',
	FileRenameExt	: 'Er du sikker pa, at du vil aendre filtypen? Filen kan muligvis ikke bruges bagefter.',
	FileRenaming	: '(Omdober...)',
	FileDelete		: 'Er du sikker pa, at du vil slette filen "%1" ?',
	FilesLoading	: 'Indlaeser...',
	FilesEmpty		: 'Tom mappe',
	FilesMoved		: 'Filen %1 flyttet til %2:%3',
	FilesCopied		: 'Filen %1 kopieret til %2:%3',

	// Basket
	BasketFolder		: 'Kurv',
	BasketClear			: 'Tom kurv',
	BasketRemove		: 'Fjern fra kurv',
	BasketOpenFolder	: 'Aben overordnet mappe',
	BasketTruncateConfirm : 'Er du sikker pa at du vil tomme kurven?',
	BasketRemoveConfirm	: 'Er du sikker pa at du vil slette filen "%1" fra kurven?',
	BasketEmpty			: 'Ingen filer i kurven, brug musen til at traekke filer til kurven.',
	BasketCopyFilesHere	: 'Kopier Filer fra kurven',
	BasketMoveFilesHere	: 'Flyt Filer fra kurven',

	BasketPasteErrorOther	: 'Fil fejl: %e',
	BasketPasteMoveSuccess	: 'Folgende filer blev flyttet: %s',
	BasketPasteCopySuccess	: 'Folgende filer blev kopieret: %s',

	// Toolbar Buttons (some used elsewhere)
	Upload		: 'Upload',
	UploadTip	: 'Upload ny fil',
	Refresh		: 'Opdatér',
	Settings	: 'Indstillinger',
	Help		: 'Hjaelp',
	HelpTip		: 'Hjaelp',

	// Context Menus
	Select			: 'Vaelg',
	SelectThumbnail : 'Vaelg thumbnail',
	View			: 'Vis',
	Download		: 'Download',

	NewSubFolder	: 'Ny undermappe',
	Rename			: 'Omdob',
	Delete			: 'Slet',

	CopyDragDrop	: 'Kopier hertil',
	MoveDragDrop	: 'Flyt hertil',

	// Dialogs
	RenameDlgTitle		: 'Omdob',
	NewNameDlgTitle		: 'Nyt navn',
	FileExistsDlgTitle	: 'Filen eksisterer allerede',
	SysErrorDlgTitle : 'System fejl',

	FileOverwrite	: 'Overskriv',
	FileAutorename	: 'Auto-omdob',

	// Generic
	OkBtn		: 'OK',
	CancelBtn	: 'Annullér',
	CloseBtn	: 'Luk',

	// Upload Panel
	UploadTitle			: 'Upload ny fil',
	UploadSelectLbl		: 'Vaelg den fil, som du vil uploade',
	UploadProgressLbl	: '(Uploader, vent venligst...)',
	UploadBtn			: 'Upload filen',
	UploadBtnCancel		: 'Annuller',

	UploadNoFileMsg		: 'Vaelg en fil pa din computer',
	UploadNoFolder		: 'Venligst vaelg en mappe for upload startes.',
	UploadNoPerms		: 'Upload er ikke tilladt.',
	UploadUnknError		: 'Fejl ved upload.',
	UploadExtIncorrect	: 'Denne filtype er ikke tilladt i denne mappe.',

	// Settings Panel
	SetTitle		: 'Indstillinger',
	SetView			: 'Vis:',
	SetViewThumb	: 'Thumbnails',
	SetViewList		: 'Liste',
	SetDisplay		: 'Thumbnails:',
	SetDisplayName	: 'Filnavn',
	SetDisplayDate	: 'Dato',
	SetDisplaySize	: 'Storrelse',
	SetSort			: 'Sortering:',
	SetSortName		: 'efter filnavn',
	SetSortDate		: 'efter dato',
	SetSortSize		: 'efter storrelse',

	// Status Bar
	FilesCountEmpty : '<tom mappe>',
	FilesCountOne	: '1 fil',
	FilesCountMany	: '%1 filer',

	// Size and Speed
	Kb				: '%1 kB',
	KbPerSecond		: '%1 kB/s',

	// Connector Error Messages.
	ErrorUnknown	: 'Det var ikke muligt at fuldfore handlingen. (Fejl: %1)',
	Errors :
	{
	 10 : 'Ugyldig handling.',
	 11 : 'Ressourcetypen blev ikke angivet i anmodningen.',
	 12 : 'Ressourcetypen er ikke gyldig.',
	102 : 'Ugyldig fil eller mappenavn.',
	103 : 'Det var ikke muligt at fuldfore handlingen pa grund af en begraensning i rettigheder.',
	104 : 'Det var ikke muligt at fuldfore handlingen pa grund af en begraensning i filsystem rettigheder.',
	105 : 'Ugyldig filtype.',
	109 : 'Ugyldig anmodning.',
	110 : 'Ukendt fejl.',
	115 : 'En fil eller mappe med det samme navn eksisterer allerede.',
	116 : 'Mappen blev ikke fundet. Opdatér listen eller prov igen.',
	117 : 'Filen blev ikke fundet. Opdatér listen eller prov igen.',
	118 : 'Originalplacering og destination er ens',
	201 : 'En fil med det samme filnavn eksisterer allerede. Den uploadede fil er blevet omdobt til "%1"',
	202 : 'Ugyldig fil.',
	203 : 'Ugyldig fil. Filstorrelsen er for stor.',
	204 : 'Den uploadede fil er korrupt.',
	205 : 'Der er ikke en midlertidig mappe til upload til radighed pa serveren.',
	206 : 'Upload annulleret af sikkerhedsmaessige arsager. Filen indeholder HTML-lignende data.',
	207 : 'Den uploadede fil er blevet omdobt til "%1"',
	300 : 'Flytning af fil(er) fejlede.',
	301 : 'Kopiering af fil(er) fejlede.',
	500 : 'Filbrowseren er deaktiveret af sikkerhedsmaessige arsager. Kontakt systemadministratoren eller kontrollér CKFinders konfigurationsfil.',
	501 : 'Understottelse af thumbnails er deaktiveret.'
	},

	// Other Error Messages.
	ErrorMsg :
	{
		FileEmpty		: 'Filnavnet ma ikke vaere tomt',
		FileExists		: 'Fil %erne eksisterer allerede',
		FolderEmpty		: 'Mappenavnet ma ikke vaere tomt',

		FileInvChar		: 'Filnavnet ma ikke indeholde et af folgende tegn: \n\\ / : * ? " < > |',
		FolderInvChar	: 'Mappenavnet ma ikke indeholde et af folgende tegn: \n\\ / : * ? " < > |',

		PopupBlockView	: 'Det var ikke muligt at abne filen i et nyt vindue. Kontrollér konfigurationen i din browser, og deaktivér eventuelle popup-blokkere for denne hjemmeside.'
	},

	// Imageresize plugin
	Imageresize :
	{
		dialogTitle		: 'Rediger storrelse %s',
		sizeTooBig		: 'Kan ikke aendre billedets hojde eller bredde til en vaerdi storre end dets originale storrelse (%size).',
		resizeSuccess	: 'Storrelsen er nu aendret.',
		thumbnailNew	: 'Opret ny thumbnail',
		thumbnailSmall	: 'Lille (%s)',
		thumbnailMedium	: 'Mellem (%s)',
		thumbnailLarge	: 'Stor (%s)',
		newSize			: 'Rediger storrelse',
		width			: 'Bredde',
		height			: 'Hojde',
		invalidHeight	: 'Ugyldig hojde.',
		invalidWidth	: 'Ugyldig bredde.',
		invalidName		: 'Ugyldigt filenavn.',
		newImage		: 'Opret nyt billede.',
		noExtensionChange : 'Filtypen kan ikke aendres.',
		imageSmall		: 'Originalfilen er for lille',
		contextMenuName	: 'Rediger storrelse'
	},

	// Fileeditor plugin
	Fileeditor :
	{
		save			: 'Gem',
		fileOpenError	: 'Filen kan ikke abnes.',
		fileSaveSuccess	: 'Filen er nu gemt.',
		contextMenuName	: 'Rediger',
		loadingFile		: 'Henter fil, vent venligst...'
	}
};
