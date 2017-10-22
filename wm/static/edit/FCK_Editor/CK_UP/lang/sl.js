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
* @fileOverview Defines the {@link CKFinder.lang} object, for the Slovenian
*		language. This is the base file for all translations.
*/

/**
 * Constains the dictionary of language entries.
 * @namespace
 */
CKFinder.lang['sl'] =
{
	appTitle : 'CKFinder',

	// Common messages and labels.
	common :
	{
		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, nedostopen</span>',
		confirmCancel	: 'Nekatere opcije so bile spremenjene. Ali res zelite zapreti pogovorno okno?',
		ok				: 'Potrdi',
		cancel			: 'Preklici',
		confirmationTitle	: 'Potrditev',
		messageTitle	: 'Informacija',
		inputTitle		: 'Vprasanje',
		undo			: 'Razveljavi',
		redo			: 'Obnovi',
		skip			: 'Preskoci',
		skipAll			: 'Preskoci vse',
		makeDecision	: 'Katera aktivnost naj se izvede?',
		rememberDecision: 'Zapomni si mojo izbiro'
	},


	dir : 'ltr', // MISSING
	HelpLang : 'en',
	LangCode : 'sl',

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
	DateTime : 'd.m.yyyy H:MM',
	DateAmPm : ['AM', 'PM'],

	// Folders
	FoldersTitle	: 'Mape',
	FolderLoading	: 'Nalagam...',
	FolderNew		: 'Vnesite ime za novo mapo: ',
	FolderRename	: 'Vnesite ime nove mape: ',
	FolderDelete	: 'Ali ste prepricani, da zelite zbrisati mapo "%1"?',
	FolderRenaming	: ' (Preimenujem...)',
	FolderDeleting	: ' (Brisem...)',

	// Files
	FileRename		: 'Vnesite novo ime datoteke: ',
	FileRenameExt	: 'Ali ste prepricani, da zelite spremeniti koncnico datoteke? Mozno je, da potem datoteka ne bo uporabna.',
	FileRenaming	: 'Preimenujem...',
	FileDelete		: 'Ali ste prepricani, da zelite izbrisati datoteko "%1"?',
	FilesLoading	: 'Nalagam...',
	FilesEmpty		: 'Prazna mapa',
	FilesMoved		: 'Datoteka %1 je bila premaknjena v %2:%3',
	FilesCopied		: 'Datoteka %1 je bila kopirana v %2:%3',

	// Basket
	BasketFolder		: 'Kos',
	BasketClear			: 'Izprazni kos',
	BasketRemove		: 'Odstrani iz kosa',
	BasketOpenFolder	: 'Odpri izvorno mapo',
	BasketTruncateConfirm : 'Ali res zelite odstraniti vse datoteke iz kosa?',
	BasketRemoveConfirm	: 'Ali res zelite odstraniti datoteko "%1" iz kosa?',
	BasketEmpty			: 'V kosu ni datotek. Lahko jih povlecete in spustite.',
	BasketCopyFilesHere	: 'Kopiraj datoteke iz kosa',
	BasketMoveFilesHere	: 'Premakni datoteke iz kosa',

	BasketPasteErrorOther	: 'Napaka z datoteko %s: %e',
	BasketPasteMoveSuccess	: 'Seznam premaknjenih datotek: %s',
	BasketPasteCopySuccess	: 'Seznam kopiranih datotek: %s',

	// Toolbar Buttons (some used elsewhere)
	Upload		: 'Nalozi na streznik',
	UploadTip	: 'Nalozi novo datoteko na streznik',
	Refresh		: 'Osvezi',
	Settings	: 'Nastavitve',
	Help		: 'Pomoc',
	HelpTip		: 'Pomoc',

	// Context Menus
	Select			: 'Izberi',
	SelectThumbnail : 'Izberi malo slicico (predogled)',
	View			: 'Predogled',
	Download		: 'Prenesi na svoj racunalnik',

	NewSubFolder	: 'Nova podmapa',
	Rename			: 'Preimenuj',
	Delete			: 'Zbrisi',

	CopyDragDrop	: 'Kopiraj datoteko',
	MoveDragDrop	: 'Premakni datoteko',

	// Dialogs
	RenameDlgTitle		: 'Preimenuj',
	NewNameDlgTitle		: 'Novo ime',
	FileExistsDlgTitle	: 'Datoteka ze obstaja',
	SysErrorDlgTitle : 'Sistemska napaka',

	FileOverwrite	: 'Prepisi',
	FileAutorename	: 'Avtomatsko preimenuj',

	// Generic
	OkBtn		: 'Potrdi',
	CancelBtn	: 'Preklici',
	CloseBtn	: 'Zapri',

	// Upload Panel
	UploadTitle			: 'Nalozi novo datoteko na streznik',
	UploadSelectLbl		: 'Izberi datoteko za prenos na streznik',
	UploadProgressLbl	: '(Prenos na streznik poteka, prosimo pocakajte...)',
	UploadBtn			: 'Prenesi izbrano datoteko na streznik',
	UploadBtnCancel		: 'Preklici',

	UploadNoFileMsg		: 'Prosimo izberite datoteko iz svojega racunalnika za prenos na streznik',
	UploadNoFolder		: 'Izberite mapo v katero se bo nalozilo datoteko!',
	UploadNoPerms		: 'Nalaganje datotek ni dovoljeno.',
	UploadUnknError		: 'Napaka pri posiljanju datoteke.',
	UploadExtIncorrect	: 'V tej mapi ta vrsta datoteke ni dovoljena.',

	// Settings Panel
	SetTitle		: 'Nastavitve',
	SetView			: 'Pogled:',
	SetViewThumb	: 'majhne slicice',
	SetViewList		: 'seznam',
	SetDisplay		: 'Prikaz:',
	SetDisplayName	: 'ime datoteke',
	SetDisplayDate	: 'datum',
	SetDisplaySize	: 'velikost datoteke',
	SetSort			: 'Razvrscanje:',
	SetSortName		: 'po imenu datoteke',
	SetSortDate		: 'po datumu',
	SetSortSize		: 'po velikosti',

	// Status Bar
	FilesCountEmpty : '<Prazna mapa>',
	FilesCountOne	: '1 datoteka',
	FilesCountMany	: '%1 datotek(e)',

	// Size and Speed
	Kb				: '%1 kB',
	KbPerSecond		: '%1 kB/sek',

	// Connector Error Messages.
	ErrorUnknown	: 'Prislo je do napake. (Napaka %1)',
	Errors :
	{
	 10 : 'Napacen ukaz.',
	 11 : 'V poizvedbi ni bil jasen tip (resource type).',
	 12 : 'Tip datoteke ni primeren.',
	102 : 'Napacno ime mape ali datoteke.',
	103 : 'Vasega ukaza se ne da izvesti zaradi tezav z avtorizacijo.',
	104 : 'Vasega ukaza se ne da izvesti zaradi tezav z nastavitvami pravic v datotecnem sistemu.',
	105 : 'Napacna koncnica datoteke.',
	109 : 'Napacna zahteva.',
	110 : 'Neznana napaka.',
	115 : 'Datoteka ali mapa s tem imenom ze obstaja.',
	116 : 'Mapa ni najdena. Prosimo osvezite okno in poskusite znova.',
	117 : 'Datoteka ni najdena. Prosimo osvezite seznam datotek in poskusite znova.',
	118 : 'Zacetna in koncna pot je ista.',
	201 : 'Datoteka z istim imenom ze obstaja. Nalozena datoteka je bila preimenovana v "%1"',
	202 : 'Neprimerna datoteka.',
	203 : 'Datoteka je prevelika in zasede prevec prostora.',
	204 : 'Nalozena datoteka je okvarjena.',
	205 : 'Na strezniku ni na voljo zacasna mapa za prenos datotek.',
	206 : 'Nalaganje je bilo prekinjeno zaradi varnostnih razlogov. Datoteka vsebuje podatke, ki spominjajo na HTML kodo.',
	207 : 'Nalozena datoteka je bila preimenovana v "%1"',
	300 : 'Premikanje datotek(e) ni uspelo.',
	301 : 'Kopiranje datotek(e) ni uspelo.',
	500 : 'Brskalnik je onemogocen zaradi varnostnih razlogov. Prosimo kontaktirajte upravljalca spletnih strani.',
	501 : 'Ni podpore za majhne slicice (predogled).'
	},

	// Other Error Messages.
	ErrorMsg :
	{
		FileEmpty		: 'Ime datoteke ne more biti prazno',
		FileExists		: 'Datoteka %s ze obstaja',
		FolderEmpty		: 'Mapa ne more biti prazna',

		FileInvChar		: 'Ime datoteke ne sme vsebovati naslednjih znakov: \n\\ / : * ? " < > |',
		FolderInvChar	: 'Ime mape ne sme vsebovati naslednjih znakov: \n\\ / : * ? " < > |',

		PopupBlockView	: 'Datoteke ni mozno odpreti v novem oknu. Prosimo nastavite svoj brskalnik tako, da bo dopuscal odpiranje oken (popups) oz. izklopite filtre za blokado odpiranja oken.'
	},

	// Imageresize plugin
	Imageresize :
	{
		dialogTitle		: 'Spremeni velikost slike %s',
		sizeTooBig		: 'Sirina ali visina slike ne moreta biti vecji kot je originalna velikost (%size).',
		resizeSuccess	: 'Velikost slike je bila uspesno spremenjena.',
		thumbnailNew	: 'Kreiraj novo majhno slicico',
		thumbnailSmall	: 'majhna (%s)',
		thumbnailMedium	: 'srednja (%s)',
		thumbnailLarge	: 'velika (%s)',
		newSize			: 'Dolocite novo velikost',
		width			: 'Sirina',
		height			: 'Visina',
		invalidHeight	: 'Nepravilna visina.',
		invalidWidth	: 'Nepravilna sirina.',
		invalidName		: 'Nepravilno ime datoteke.',
		newImage		: 'Kreiraj novo sliko',
		noExtensionChange : 'Koncnica datoteke se ne more spremeniti.',
		imageSmall		: 'Izvorna slika je premajhna',
		contextMenuName	: 'Spremeni velikost'
	},

	// Fileeditor plugin
	Fileeditor :
	{
		save			: 'Shrani',
		fileOpenError	: 'Datoteke ni mogoce odpreti.',
		fileSaveSuccess	: 'Datoteka je bila shranjena.',
		contextMenuName	: 'Uredi',
		loadingFile		: 'Nalaganje datoteke, prosimo pocakajte ...'
	}
};
