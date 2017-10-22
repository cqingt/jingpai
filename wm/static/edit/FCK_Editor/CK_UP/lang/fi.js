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
 * @fileOverview Defines the {@link CKFinder.lang} object, for the Finnish
 *		language. Translated in Finnish 2010-12-15 by Petteri Salmela.
 */

/**
 * Constains the dictionary of language entries.
 * @namespace
 */
CKFinder.lang['fi'] =
{
	appTitle : 'CKFinder',

	// Common messages and labels.
	common :
	{
		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, ei k"aytett"aviss"a</span>',
		confirmCancel	: 'Valintoja on muutettu. Suljetaanko ikkuna kuitenkin?',
		ok				: 'OK',
		cancel			: 'Peru',
		confirmationTitle	: 'Varmistus',
		messageTitle	: 'Ilmoitus',
		inputTitle		: 'Kysymys',
		undo			: 'Peru',
		redo			: 'Tee uudelleen',
		skip			: 'Ohita',
		skipAll			: 'Ohita kaikki',
		makeDecision	: 'Mik"a toiminto suoritetaan?',
		rememberDecision: 'Muista valintani'
	},


	dir : 'ltr',
	HelpLang : 'fi',
	LangCode : 'fi',

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
	DateTime : 'yyyy-mm-dd HH:MM',
	DateAmPm : ['AM', 'PM'],

	// Folders
	FoldersTitle	: 'Kansiot',
	FolderLoading	: 'Lataan...',
	FolderNew		: 'Kirjoita uuden kansion nimi: ',
	FolderRename	: 'Kirjoita uusi nimi kansiolle ',
	FolderDelete	: 'Haluatko varmasti poistaa kansion "%1"?',
	FolderRenaming	: ' (Uudelleennime"a"a...)',
	FolderDeleting	: ' (Poistaa...)',

	// Files
	FileRename		: 'Kirjoita uusi tiedostonimi: ',
	FileRenameExt	: 'Haluatko varmasti muuttaa tiedostotarkennetta? Tiedosto voi muuttua k"aytt"okelvottomaksi.',
	FileRenaming	: 'Uudelleennime"a"a...',
	FileDelete		: 'Haluatko varmasti poistaa tiedoston "%1"?',
	FilesLoading	: 'Lataa...',
	FilesEmpty		: 'Tyhj"a kansio.',
	FilesMoved		: 'Tiedosto %1 siirretty nimelle %2:%3',
	FilesCopied		: 'Tiedosto %1 kopioitu nimelle %2:%3',

	// Basket
	BasketFolder		: 'Kori',
	BasketClear			: 'Tyhjenn"a kori',
	BasketRemove		: 'Poista korista',
	BasketOpenFolder	: 'Avaa ylemm"an tason kansio',
	BasketTruncateConfirm : 'Haluatko todella poistaa kaikki tiedostot korista?',
	BasketRemoveConfirm	: 'Haluatko todella poistaa tiedoston "%1" korista?',
	BasketEmpty			: 'Korissa ei ole tiedostoja. Lis"a"a raahaamalla.',
	BasketCopyFilesHere	: 'Kopioi tiedostot korista.',
	BasketMoveFilesHere	: 'Siirr"a tiedostot korista.',

	BasketPasteErrorOther	: 'Tiedoston %s virhe: %e',
	BasketPasteMoveSuccess	: 'Seuraavat tiedostot siirrettiin: %s',
	BasketPasteCopySuccess	: 'Seuraavat tiedostot kopioitiin: %s',

	// Toolbar Buttons (some used elsewhere)
	Upload		: 'Lataa palvelimelle',
	UploadTip	: 'Lataa uusi tiedosto palvelimelle',
	Refresh		: 'P"aivit"a',
	Settings	: 'Asetukset',
	Help		: 'Apua',
	HelpTip		: 'Apua',

	// Context Menus
	Select			: 'Valitse',
	SelectThumbnail : 'Valitse esikatselukuva',
	View			: 'N"ayt"a',
	Download		: 'Lataa palvelimelta',

	NewSubFolder	: 'Uusi alikansio',
	Rename			: 'Uudelleennime"a ',
	Delete			: 'Poista',

	CopyDragDrop	: 'Kopioi tiedosto t"ah"an',
	MoveDragDrop	: 'Siirr"a tiedosto t"ah"an',

	// Dialogs
	RenameDlgTitle		: 'Nime"a uudelleen',
	NewNameDlgTitle		: 'Uusi nimi',
	FileExistsDlgTitle	: 'Tiedostonimi on jo olemassa!',
	SysErrorDlgTitle : 'J"arjestelm"avirhe',

	FileOverwrite	: 'Ylikirjoita',
	FileAutorename	: 'Nime"a uudelleen automaattisesti',

	// Generic
	OkBtn		: 'OK',
	CancelBtn	: 'Peru',
	CloseBtn	: 'Sulje',

	// Upload Panel
	UploadTitle			: 'Lataa uusi tiedosto palvelimelle',
	UploadSelectLbl		: 'Valitse ladattava tiedosto',
	UploadProgressLbl	: '(Lataaminen palvelimelle k"aynniss"a...)',
	UploadBtn			: 'Lataa valittu tiedosto palvelimelle',
	UploadBtnCancel		: 'Peru',

	UploadNoFileMsg		: 'Valitse tiedosto tietokoneeltasi.',
	UploadNoFolder		: 'Valitse kansio ennen palvelimelle lataamista.',
	UploadNoPerms		: 'Tiedoston lataaminen palvelimelle ev"atty.',
	UploadUnknError		: 'Tiedoston siirrossa tapahtui virhe.',
	UploadExtIncorrect	: 'Tiedostotarkenne ei ole sallittu valitussa kansiossa.',

	// Settings Panel
	SetTitle		: 'Asetukset',
	SetView			: 'N"akym"a:',
	SetViewThumb	: 'Esikatselukuvat',
	SetViewList		: 'Luettelo',
	SetDisplay		: 'N"ayt"a:',
	SetDisplayName	: 'Tiedostonimi',
	SetDisplayDate	: 'P"aiv"am"a"ar"a',
	SetDisplaySize	: 'Tiedostokoko',
	SetSort			: 'Lajittele:',
	SetSortName		: 'aakkosj"arjestykseen',
	SetSortDate		: 'p"aiv"am"a"ar"an mukaan',
	SetSortSize		: 'tiedostokoon mukaan',

	// Status Bar
	FilesCountEmpty : '<Tyhj"a kansio>',
	FilesCountOne	: '1 tiedosto',
	FilesCountMany	: '%1 tiedostoa',

	// Size and Speed
	Kb				: '%1 kt',
	KbPerSecond		: '%1 kt/s',

	// Connector Error Messages.
	ErrorUnknown	: 'Pyynt"o"a ei voitu suorittaa. (Virhe %1)',
	Errors :
	{
	 10 : 'Virheellinen komento.',
	 11 : 'Pyynn"on resurssityyppi on m"a"arittelem"att"a.',
	 12 : 'Pyynn"on resurssityyppi on virheellinen.',
	102 : 'Virheellinen tiedosto- tai kansionimi.',
	103 : 'Oikeutesi eiv"at riit"a pyynn"on suorittamiseen.',
	104 : 'Tiedosto-oikeudet eiv"at riit"a pyynn"on suorittamiseen.',
	105 : 'Virheellinen tiedostotarkenne.',
	109 : 'Virheellinen pyynt"o.',
	110 : 'Tuntematon virhe.',
	115 : 'Samanniminen tiedosto tai kansio on jo olemassa.',
	116 : 'Kansiota ei l"oydy. Yrit"a uudelleen kansiop"aivityksen j"alkeen.',
	117 : 'Tiedostoa ei l"oydy. Yrit"a uudelleen kansiop"aivityksen j"alkeen.',
	118 : 'L"ahde- ja kohdekansio on sama!',
	201 : 'Samanniminen tiedosto on jo olemassa. Palvelimelle ladattu tiedosto on nimetty: "%1"',
	202 : 'Virheellinen tiedosto',
	203 : 'Virheellinen tiedosto. Tiedostokoko on liian suuri.',
	204 : 'Palvelimelle ladattu tiedosto on vioittunut.',
	205 : 'V"aliaikaishakemistoa ei ole m"a"aritetty palvelimelle lataamista varten.',
	206 : 'Palvelimelle lataaminen on peruttu turvallisuussyist"a. Tiedosto sis"alt"a"a HTML-tyylist"a dataa.',
	207 : 'Palvelimelle ladattu tiedosto on  nimetty: "%1"',
	300 : 'Tiedostosiirto ep"aonnistui.',
	301 : 'Tiedostokopiointi ep"aonnistui.',
	500 : 'Tiedostoselain on kytketty k"ayt"ost"a turvallisuussyist"a. Pyyd"a p"a"ak"aytt"aj"a"a tarkastamaan CKFinderin asetustiedosto.',
	501 : 'Esikatselukuvien tuki on kytketty toiminnasta.'
	},

	// Other Error Messages.
	ErrorMsg :
	{
		FileEmpty		: 'Tiedosto on nimett"av"a!',
		FileExists		: 'Tiedosto %s on jo olemassa',
		FolderEmpty		: 'Kansio on nimett"av"a!',

		FileInvChar		: 'Tiedostonimi ei voi sis"alt"a"a seuraavia merkkej"a: \n\\ / : * ? " < > |',
		FolderInvChar	: 'Kansionimi ei voi sis"alt"a"a seuraavia merkkej"a: \n\\ / : * ? " < > |',

		PopupBlockView	: 'Tiedostoa ei voitu avata uuteen ikkunaan. Salli selaimesi asetuksissa ponnahdusikkunat t"alle sivulle.'
	},

	// Imageresize plugin
	Imageresize :
	{
		dialogTitle		: 'Muuta kokoa %s',
		sizeTooBig		: 'Kuvan mittoja ei voi asettaa alkuper"aist"a suuremmiksi(%size).',
		resizeSuccess	: 'Kuvan koon muuttaminen onnistui.',
		thumbnailNew	: 'Luo uusi esikatselukuva.',
		thumbnailSmall	: 'Pieni (%s)',
		thumbnailMedium	: 'Keskikokoinen (%s)',
		thumbnailLarge	: 'Suuri (%s)',
		newSize			: 'Aseta uusi koko',
		width			: 'Leveys',
		height			: 'Korkeus',
		invalidHeight	: 'Viallinen korkeus.',
		invalidWidth	: 'Viallinen leveys.',
		invalidName		: 'Viallinen tiedostonimi.',
		newImage		: 'Luo uusi kuva',
		noExtensionChange : 'Tiedostom"a"arett"a ei voi vaihtaa.',
		imageSmall		: 'L"ahdekuva on liian pieni',
		contextMenuName	: 'Muuta kokoa'
	},

	// Fileeditor plugin
	Fileeditor :
	{
		save			: 'Tallenna',
		fileOpenError	: 'Tiedostoa ei voi avata.',
		fileSaveSuccess	: 'Tiedoston tallennus onnistui.',
		contextMenuName	: 'Muokkaa',
		loadingFile		: 'Tiedostoa ladataan ...'
	}
};
