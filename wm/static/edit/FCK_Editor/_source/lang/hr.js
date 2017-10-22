/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Croatian language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Contains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['hr'] =
{
	/**
	 * The language reading direction. Possible values are "rtl" for
	 * Right-To-Left languages (like Arabic) and "ltr" for Left-To-Right
	 * languages (like English).
	 * @default 'ltr'
	 */
	dir : 'ltr',

	/*
	 * Screenreader titles. Please note that screenreaders are not always capable
	 * of reading non-English words. So be careful while translating it.
	 */
	editorTitle : 'Bogati uredivac teksta, %1',
	editorHelp : 'Pritisni ALT 0 za pomo'c',

	// ARIA descriptions.
	toolbars	: 'Alatne trake uredivaca teksta',
	editor		: 'Bogati uredivac teksta',

	// Toolbar buttons without dialogs.
	source			: 'K^od',
	newPage			: 'Nova stranica',
	save			: 'Snimi',
	preview			: 'Pregledaj',
	cut				: 'Izrezi',
	copy			: 'Kopiraj',
	paste			: 'Zalijepi',
	print			: 'Ispisi',
	underline		: 'Potcrtano',
	bold			: 'Podebljaj',
	italic			: 'Ukosi',
	selectAll		: 'Odaberi sve',
	removeFormat	: 'Ukloni formatiranje',
	strike			: 'Precrtano',
	subscript		: 'Subscript',
	superscript		: 'Superscript',
	horizontalrule	: 'Ubaci vodoravnu liniju',
	pagebreak		: 'Ubaci prijelom stranice',
	pagebreakAlt		: 'Prijelom stranice',
	unlink			: 'Ukloni link',
	undo			: 'Ponisti',
	redo			: 'Ponovi',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Pretrazi server',
		url				: 'URL',
		protocol		: 'Protokol',
		upload			: 'Posalji',
		uploadSubmit	: 'Posalji na server',
		image			: 'Slika',
		flash			: 'Flash',
		form			: 'Form',
		checkbox		: 'Checkbox',
		radio			: 'Radio Button',
		textField		: 'Text Field',
		textarea		: 'Textarea',
		hiddenField		: 'Hidden Field',
		button			: 'Button',
		select			: 'Selection Field',
		imageButton		: 'Image Button',
		notSet			: '<nije postavljeno>',
		id				: 'Id',
		name			: 'Naziv',
		langDir			: 'Smjer jezika',
		langDirLtr		: 'S lijeva na desno (LTR)',
		langDirRtl		: 'S desna na lijevo (RTL)',
		langCode		: 'K^od jezika',
		longDescr		: 'Dugacki opis URL',
		cssClass		: 'Stylesheet klase',
		advisoryTitle	: 'Advisory naslov',
		cssStyle		: 'Stil',
		ok				: 'OK',
		cancel			: 'Ponisti',
		close			: 'Zatvori',
		preview			: 'Pregledaj',
		generalTab		: 'Op'cenito',
		advancedTab		: 'Napredno',
		validateNumberFailed : 'Ova vrijednost nije broj.',
		confirmNewPage	: 'Sve napravljene promjene 'ce biti izgubljene ukoliko ih niste snimili. Sigurno zelite ucitati novu stranicu?',
		confirmCancel	: 'Neke od opcija su promjenjene. Sigurno zelite zatvoriti ovaj prozor?',
		options			: 'Opcije',
		target			: 'Odrediste',
		targetNew		: 'Novi prozor (_blank)',
		targetTop		: 'Vrsni prozor (_top)',
		targetSelf		: 'Isti prozor (_self)',
		targetParent	: 'Roditeljski prozor (_parent)',
		langDirLTR		: 'S lijeva na desno (LTR)',
		langDirRTL		: 'S desna na lijevo (RTL)',
		styles			: 'Stil',
		cssClasses		: 'Klase stilova',
		width			: 'Sirina',
		height			: 'Visina',
		align			: 'Poravnaj',
		alignLeft		: 'Lijevo',
		alignRight		: 'Desno',
		alignCenter		: 'Sredisnje',
		alignTop		: 'Vrh',
		alignMiddle		: 'Sredina',
		alignBottom		: 'Dolje',
		invalidValue	: 'Invalid value.', // MISSING
		invalidHeight	: 'Visina mora biti broj.',
		invalidWidth	: 'Sirina mora biti broj.',
		invalidCssLength	: 'Vrijednost odredena za "%1" polje mora biti pozitivni broj sa ili bez vaze'cih CSS mjernih jedinica (px, %, in, cm, mm, em, ex, pt ili pc).',
		invalidHtmlLength	: 'Vrijednost odredena za "%1" polje mora biti pozitivni broj sa ili bez vaze'cih HTML mjernih jedinica (px ili %).',
		invalidInlineStyle	: 'Vrijednost za linijski stil mora sadrzavati jednu ili vise definicija s formatom "naziv:vrijednost", odvojenih tocka-zarezom.',
		cssLengthTooltip	: 'Unesite broj za vrijednost u pikselima ili broj s vaze'cim CSS mjernim jedinicama (px, %, in, cm, mm, em, ex, pt ili pc).',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, nedostupno</span>'
	},

	contextmenu :
	{
		options : 'Opcije izbornika'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Ubaci posebne znakove',
		title		: 'Odaberite posebni karakter',
		options : 'Opcije specijalnih znakova'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Ubaci/promijeni link',
		other 		: '<drugi>',
		menu		: 'Promijeni link',
		title		: 'Link',
		info		: 'Link Info',
		target		: 'Meta',
		upload		: 'Posalji',
		advanced	: 'Napredno',
		type		: 'Link vrsta',
		toUrl		: 'URL',
		toAnchor	: 'Sidro na ovoj stranici',
		toEmail		: 'E-Mail',
		targetFrame		: '<okvir>',
		targetPopup		: '<popup prozor>',
		targetFrameName	: 'Ime ciljnog okvira',
		targetPopupName	: 'Naziv popup prozora',
		popupFeatures	: 'Mogu'cnosti popup prozora',
		popupResizable	: 'Promjenjiva velicina',
		popupStatusBar	: 'Statusna traka',
		popupLocationBar: 'Traka za lokaciju',
		popupToolbar	: 'Traka s alatima',
		popupMenuBar	: 'Izborna traka',
		popupFullScreen	: 'Cijeli ekran (IE)',
		popupScrollBars	: 'Scroll traka',
		popupDependent	: 'Ovisno (Netscape)',
		popupLeft		: 'Lijeva pozicija',
		popupTop		: 'Gornja pozicija',
		id				: 'Id',
		langDir			: 'Smjer jezika',
		langDirLTR		: 'S lijeva na desno (LTR)',
		langDirRTL		: 'S desna na lijevo (RTL)',
		acccessKey		: 'Pristupna tipka',
		name			: 'Naziv',
		langCode			: 'Smjer jezika',
		tabIndex			: 'Tab Indeks',
		advisoryTitle		: 'Advisory naslov',
		advisoryContentType	: 'Advisory vrsta sadrzaja',
		cssClasses		: 'Stylesheet klase',
		charset			: 'Kodna stranica povezanih resursa',
		styles			: 'Stil',
		rel			: 'Veza',
		selectAnchor		: 'Odaberi sidro',
		anchorName		: 'Po nazivu sidra',
		anchorId			: 'Po Id elementa',
		emailAddress		: 'E-Mail adresa',
		emailSubject		: 'Naslov',
		emailBody		: 'Sadrzaj poruke',
		noAnchors		: '(Nema dostupnih sidra)',
		noUrl			: 'Molimo upisite URL link',
		noEmail			: 'Molimo upisite e-mail adresu'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Ubaci/promijeni sidro',
		menu		: 'Svojstva sidra',
		title		: 'Svojstva sidra',
		name		: 'Ime sidra',
		errorName	: 'Molimo unesite ime sidra',
		remove		: 'Ukloni sidro'
	},

	// List style dialog
	list:
	{
		numberedTitle		: 'Svojstva brojcane liste',
		bulletedTitle		: 'Svojstva liste',
		type				: 'Vrsta',
		start				: 'Pocetak',
		validateStartNumber				:'Pocetak brojcane liste mora biti cijeli broj.',
		circle				: 'Krug',
		disc				: 'Disk',
		square				: 'Kvadrat',
		none				: 'Bez',
		notset				: '<nije odreden>',
		armenian			: 'Armenijska numeracija',
		georgian			: 'Gruzijska numeracija(an, ban, gan, etc.)',
		lowerRoman			: 'Romanska numeracija mala slova (i, ii, iii, iv, v, itd.)',
		upperRoman			: 'Romanska numeracija velika slova (I, II, III, IV, V, itd.)',
		lowerAlpha			: 'Znakovi mala slova (a, b, c, d, e, itd.)',
		upperAlpha			: 'Znakovi velika slova (A, B, C, D, E, itd.)',
		lowerGreek			: 'Grcka numeracija mala slova (alfa, beta, gama, itd).',
		decimal				: 'Decimalna numeracija (1, 2, 3, itd.)',
		decimalLeadingZero	: 'Decimalna s vode'com nulom (01, 02, 03, itd)'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Pronadi i zamijeni',
		find				: 'Pronadi',
		replace				: 'Zamijeni',
		findWhat			: 'Pronadi:',
		replaceWith			: 'Zamijeni s:',
		notFoundMsg			: 'Trazeni tekst nije pronaden.',
		findOptions			: 'Opcije trazenja',
		matchCase			: 'Usporedi mala/velika slova',
		matchWord			: 'Usporedi cijele rijeci',
		matchCyclic			: 'Usporedi kruzno',
		replaceAll			: 'Zamijeni sve',
		replaceSuccessMsg	: 'Zamijenjeno %1 pojmova.'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Tablica',
		title		: 'Svojstva tablice',
		menu		: 'Svojstva tablice',
		deleteTable	: 'Izbrisi tablicu',
		rows		: 'Redova',
		columns		: 'Kolona',
		border		: 'Velicina okvira',
		widthPx		: 'piksela',
		widthPc		: 'postotaka',
		widthUnit	: 'jedinica sirine',
		cellSpace	: 'Prostornost 'celija',
		cellPad		: 'Razmak 'celija',
		caption		: 'Naslov',
		summary		: 'Sazetak',
		headers		: 'Zaglavlje',
		headersNone		: 'Nista',
		headersColumn	: 'Prva kolona',
		headersRow		: 'Prvi red',
		headersBoth		: 'Oba',
		invalidRows		: 'Broj redova mora biti broj ve'ci od 0.',
		invalidCols		: 'Broj kolona mora biti broj ve'ci od 0.',
		invalidBorder	: 'Debljina ruba mora biti broj.',
		invalidWidth	: 'Sirina tablice mora biti broj.',
		invalidHeight	: 'Visina tablice mora biti broj.',
		invalidCellSpacing	: 'Prostornost 'celija mora biti broj.',
		invalidCellPadding	: 'Razmak 'celija mora biti broj.',

		cell :
		{
			menu			: ''Celija',
			insertBefore	: 'Ubaci 'celiju prije',
			insertAfter		: 'Ubaci 'celiju poslije',
			deleteCell		: 'Izbrisi 'celije',
			merge			: 'Spoji 'celije',
			mergeRight		: 'Spoji desno',
			mergeDown		: 'Spoji dolje',
			splitHorizontal	: 'Podijeli 'celiju vodoravno',
			splitVertical	: 'Podijeli 'celiju okomito',
			title			: 'Svojstva 'celije',
			cellType		: 'Vrsta 'celije',
			rowSpan			: 'Rows Span',
			colSpan			: 'Columns Span',
			wordWrap		: 'Prelazak u novi red',
			hAlign			: 'Vodoravno poravnanje',
			vAlign			: 'Okomito poravnanje',
			alignBaseline	: 'Osnovna linija',
			bgColor			: 'Boja pozadine',
			borderColor		: 'Boja ruba',
			data			: 'Podatak',
			header			: 'Zaglavlje',
			yes				: 'Da',
			no				: 'ne',
			invalidWidth	: 'Sirina 'celije mora biti broj.',
			invalidHeight	: 'Visina 'celije mora biti broj.',
			invalidRowSpan	: 'Rows span mora biti cijeli broj.',
			invalidColSpan	: 'Columns span mora biti cijeli broj.',
			chooseColor		: 'Odaberi'
		},

		row :
		{
			menu			: 'Red',
			insertBefore	: 'Ubaci red prije',
			insertAfter		: 'Ubaci red poslije',
			deleteRow		: 'Izbrisi redove'
		},

		column :
		{
			menu			: 'Kolona',
			insertBefore	: 'Ubaci kolonu prije',
			insertAfter		: 'Ubaci kolonu poslije',
			deleteColumn	: 'Izbrisi kolone'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Image Button svojstva',
		text		: 'Tekst (vrijednost)',
		type		: 'Vrsta',
		typeBtn		: 'Gumb',
		typeSbm		: 'Posalji',
		typeRst		: 'Ponisti'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Checkbox svojstva',
		radioTitle	: 'Radio Button svojstva',
		value		: 'Vrijednost',
		selected	: 'Odabrano'
	},

	// Form Dialog.
	form :
	{
		title		: 'Form svojstva',
		menu		: 'Form svojstva',
		action		: 'Akcija',
		method		: 'Metoda',
		encoding	: 'Encoding'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Selection svojstva',
		selectInfo	: 'Info',
		opAvail		: 'Dostupne opcije',
		value		: 'Vrijednost',
		size		: 'Velicina',
		lines		: 'linija',
		chkMulti	: 'Dozvoli visestruki odabir',
		opText		: 'Tekst',
		opValue		: 'Vrijednost',
		btnAdd		: 'Dodaj',
		btnModify	: 'Promijeni',
		btnUp		: 'Gore',
		btnDown		: 'Dolje',
		btnSetValue : 'Postavi kao odabranu vrijednost',
		btnDelete	: 'Obrisi'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Textarea svojstva',
		cols		: 'Kolona',
		rows		: 'Redova'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Text Field svojstva',
		name		: 'Ime',
		value		: 'Vrijednost',
		charWidth	: 'Sirina',
		maxChars	: 'Najvise karaktera',
		type		: 'Vrsta',
		typeText	: 'Tekst',
		typePass	: 'Sifra'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Hidden Field svojstva',
		name	: 'Ime',
		value	: 'Vrijednost'
	},

	// Image Dialog.
	image :
	{
		title		: 'Svojstva slika',
		titleButton	: 'Image Button svojstva',
		menu		: 'Svojstva slika',
		infoTab		: 'Info slike',
		btnUpload	: 'Posalji na server',
		upload		: 'Posalji',
		alt			: 'Alternativni tekst',
		lockRatio	: 'Zakljucaj odnos',
		resetSize	: 'Obrisi velicinu',
		border		: 'Okvir',
		hSpace		: 'HSpace',
		vSpace		: 'VSpace',
		alertUrl	: 'Unesite URL slike',
		linkTab		: 'Link',
		button2Img	: 'Zelite li promijeniti odabrani gumb u jednostavnu sliku?',
		img2Button	: 'Zelite li promijeniti odabranu sliku u gumb?',
		urlMissing	: 'Nedostaje URL slike.',
		validateBorder	: 'Okvir mora biti cijeli broj.',
		validateHSpace	: 'HSpace mora biti cijeli broj',
		validateVSpace	: 'VSpace mora biti cijeli broj.'
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Flash svojstva',
		propertiesTab	: 'Svojstva',
		title			: 'Flash svojstva',
		chkPlay			: 'Auto Play',
		chkLoop			: 'Ponavljaj',
		chkMenu			: 'Omogu'ci Flash izbornik',
		chkFull			: 'Omogu'ci Fullscreen',
 		scale			: 'Omjer',
		scaleAll		: 'Prikazi sve',
		scaleNoBorder	: 'Bez okvira',
		scaleFit		: 'Tocna velicina',
		access			: 'Script Access',
		accessAlways	: 'Uvijek',
		accessSameDomain: 'Ista domena',
		accessNever		: 'Nikad',
		alignAbsBottom	: 'Abs dolje',
		alignAbsMiddle	: 'Abs sredina',
		alignBaseline	: 'Bazno',
		alignTextTop	: 'Vrh teksta',
		quality			: 'Kvaliteta',
		qualityBest		: 'Best',
		qualityHigh		: 'High',
		qualityAutoHigh	: 'Auto High',
		qualityMedium	: 'Medium',
		qualityAutoLow	: 'Auto Low',
		qualityLow		: 'Low',
		windowModeWindow: 'Window',
		windowModeOpaque: 'Opaque',
		windowModeTransparent : 'Transparent',
		windowMode		: 'Vrsta prozora',
		flashvars		: 'Varijable za Flash',
		bgcolor			: 'Boja pozadine',
		hSpace			: 'HSpace',
		vSpace			: 'VSpace',
		validateSrc		: 'Molimo upisite URL link',
		validateHSpace	: 'HSpace mora biti broj.',
		validateVSpace	: 'VSpace mora biti broj.'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Provjeri pravopis',
		title			: 'Provjera pravopisa',
		notAvailable	: 'Zao nam je, ali usluga trenutno nije dostupna.',
		errorLoading	: 'Greska ucitavanja aplikacije: %s.',
		notInDic		: 'Nije u rjecniku',
		changeTo		: 'Promijeni u',
		btnIgnore		: 'Zanemari',
		btnIgnoreAll	: 'Zanemari sve',
		btnReplace		: 'Zamijeni',
		btnReplaceAll	: 'Zamijeni sve',
		btnUndo			: 'Vrati',
		noSuggestions	: '-Nema preporuke-',
		progress		: 'Provjera u tijeku...',
		noMispell		: 'Provjera zavrsena: Nema gresaka',
		noChanges		: 'Provjera zavrsena: Nije napravljena promjena',
		oneChange		: 'Provjera zavrsena: Jedna rijec promjenjena',
		manyChanges		: 'Provjera zavrsena: Promijenjeno %1 rijeci',
		ieSpellDownload	: 'Provjera pravopisa nije instalirana. Zelite li skinuti provjeru pravopisa?'
	},

	smiley :
	{
		toolbar	: 'Smjesko',
		title	: 'Ubaci smjeska',
		options : 'Opcije smjeska'
	},

	elementsPath :
	{
		eleLabel : 'Putanja elemenata',
		eleTitle : '%1 element'
	},

	numberedlist	: 'Brojcana lista',
	bulletedlist	: 'Obicna lista',
	indent			: 'Pomakni udesno',
	outdent			: 'Pomakni ulijevo',

	justify :
	{
		left	: 'Lijevo poravnanje',
		center	: 'Sredisnje poravnanje',
		right	: 'Desno poravnanje',
		block	: 'Blok poravnanje'
	},

	blockquote : 'Blockquote',

	clipboard :
	{
		title		: 'Zalijepi',
		cutError	: 'Sigurnosne postavke Vaseg pretrazivaca ne dozvoljavaju operacije automatskog izrezivanja. Molimo koristite kraticu na tipkovnici (Ctrl/Cmd+X).',
		copyError	: 'Sigurnosne postavke Vaseg pretrazivaca ne dozvoljavaju operacije automatskog kopiranja. Molimo koristite kraticu na tipkovnici (Ctrl/Cmd+C).',
		pasteMsg	: 'Molimo zaljepite unutar doljnjeg okvira koriste'ci tipkovnicu (<STRONG>Ctrl/Cmd+V</STRONG>) i kliknite <STRONG>OK</STRONG>.',
		securityMsg	: 'Zbog sigurnosnih postavki Vaseg pretrazivaca, editor nema direktan pristup Vasem meduspremniku. Potrebno je ponovno zalijepiti tekst u ovaj prozor.',
		pasteArea	: 'Prostor za ljepljenje'
	},

	pastefromword :
	{
		confirmCleanup	: 'Tekst koji zelite zalijepiti cini se da je kopiran iz Worda. Zelite li prije ocistiti tekst?',
		toolbar			: 'Zalijepi iz Worda',
		title			: 'Zalijepi iz Worda',
		error			: 'Nije mogu'ce ocistiti podatke za ljepljenje zbog interne greske'
	},

	pasteText :
	{
		button	: 'Zalijepi kao cisti tekst',
		title	: 'Zalijepi kao cisti tekst'
	},

	templates :
	{
		button			: 'Predlosci',
		title			: 'Predlosci sadrzaja',
		options : 'Opcije predlozaka',
		insertOption	: 'Zamijeni trenutne sadrzaje',
		selectPromptMsg	: 'Molimo odaberite predlozak koji zelite otvoriti<br>(stvarni sadrzaj 'ce biti izgubljen):',
		emptyListMsg	: '(Nema definiranih predlozaka)'
	},

	showBlocks : 'Prikazi blokove',

	stylesCombo :
	{
		label		: 'Stil',
		panelTitle	: 'Stilovi formatiranja',
		panelTitle1	: 'Block stilovi',
		panelTitle2	: 'Inline stilovi',
		panelTitle3	: 'Object stilovi'
	},

	format :
	{
		label		: 'Format',
		panelTitle	: 'Format',

		tag_p		: 'Normal',
		tag_pre		: 'Formatirano',
		tag_address	: 'Address',
		tag_h1		: 'Heading 1',
		tag_h2		: 'Heading 2',
		tag_h3		: 'Heading 3',
		tag_h4		: 'Heading 4',
		tag_h5		: 'Heading 5',
		tag_h6		: 'Heading 6',
		tag_div		: 'Normal (DIV)'
	},

	div :
	{
		title				: 'Napravi DIV kontejner',
		toolbar				: 'Napravi DIV kontejner',
		cssClassInputLabel	: 'Klase stilova',
		styleSelectLabel	: 'Stil',
		IdInputLabel		: 'Id',
		languageCodeInputLabel	: 'Jezicni kod',
		inlineStyleInputLabel	: 'Stil u liniji',
		advisoryTitleInputLabel	: 'Savjetodavni naslov',
		langDirLabel		: 'Smjer jezika',
		langDirLTRLabel		: 'S lijeva na desno (LTR)',
		langDirRTLLabel		: 'S desna na lijevo (RTL)',
		edit				: 'Uredi DIV',
		remove				: 'Ukloni DIV'
  	},

	iframe :
	{
		title		: 'IFrame svojstva',
		toolbar		: 'IFrame',
		noUrl		: 'Unesite URL iframe-a',
		scrolling	: 'Omogu'ci trake za skrolanje',
		border		: 'Prikazi okvir IFrame-a'
	},

	font :
	{
		label		: 'Font',
		voiceLabel	: 'Font',
		panelTitle	: 'Font'
	},

	fontSize :
	{
		label		: 'Velicina',
		voiceLabel	: 'Velicina slova',
		panelTitle	: 'Velicina'
	},

	colorButton :
	{
		textColorTitle	: 'Boja teksta',
		bgColorTitle	: 'Boja pozadine',
		panelTitle		: 'Boje',
		auto			: 'Automatski',
		more			: 'Vise boja...'
	},

	colors :
	{
		'000' : 'Crna',
		'800000' : 'Kesten',
		'8B4513' : 'Smeda',
		'2F4F4F' : 'Tamno siva',
		'008080' : 'Teal',
		'000080' : 'Mornarska',
		'4B0082' : 'Indigo',
		'696969' : 'Tamno siva',
		'B22222' : 'Vatrena cigla',
		'A52A2A' : 'Smeda',
		'DAA520' : 'Zlatna',
		'006400' : 'Tamno zelena',
		'40E0D0' : 'Tirkizna',
		'0000CD' : 'Srednje plava',
		'800080' : 'Ljubicasta',
		'808080' : 'Siva',
		'F00' : 'Crvena',
		'FF8C00' : 'Tamno narandasta',
		'FFD700' : 'Zlatna',
		'008000' : 'Zelena',
		'0FF' : 'Cijan',
		'00F' : 'Plava',
		'EE82EE' : 'Ljubicasta',
		'A9A9A9' : 'Mutno siva',
		'FFA07A' : 'Svijetli losos',
		'FFA500' : 'Narandasto',
		'FFFF00' : 'Zuto',
		'00FF00' : 'Limun',
		'AFEEEE' : 'Blijedo tirkizna',
		'ADD8E6' : 'Svijetlo plava',
		'DDA0DD' : 'Sljiva',
		'D3D3D3' : 'Svijetlo siva',
		'FFF0F5' : 'Lavanda rumeno',
		'FAEBD7' : 'Antikno bijela',
		'FFFFE0' : 'Svijetlo zuta',
		'F0FFF0' : 'Med',
		'F0FFFF' : 'Azurna',
		'F0F8FF' : 'Alice plava',
		'E6E6FA' : 'Lavanda',
		'FFF' : 'Bijela'
	},

	scayt :
	{
		title			: 'Provjeri pravopis tijekom tipkanja (SCAYT)',
		opera_title		: 'Nije podrzano u Operi',
		enable			: 'Omogu'ci SCAYT',
		disable			: 'Onemogu'ci SCAYT',
		about			: 'O SCAYT',
		toggle			: 'Omogu'cu/Onemogu'ci SCAYT',
		options			: 'Opcije',
		langs			: 'Jezici',
		moreSuggestions	: 'Vise prijedloga',
		ignore			: 'Zanemari',
		ignoreAll		: 'Zanemari sve',
		addWord			: 'Dodaj rijec',
		emptyDic		: 'Naziv rjecnika ne smije biti prazno.',

		optionsTab		: 'Opcije',
		allCaps			: 'Ignoriraj rijeci s velikim slovima',
		ignoreDomainNames : 'Ignoriraj nazive domena',
		mixedCase		: 'Ignoriraj rijeci s mijesanim slovima',
		mixedWithDigits	: 'Ignoriraj rijeci s brojevima',

		languagesTab	: 'Jezici',

		dictionariesTab	: 'Rjecnici',
		dic_field_name	: 'Naziv rijecnika',
		dic_create		: 'Napravi',
		dic_restore		: 'Povrati',
		dic_delete		: 'Obrisi',
		dic_rename		: 'Promijeni naziv',
		dic_info		: 'Na pocetku se korisnicki Rijecnik sprema u Cookie. Nazalost, velicina im je ogranicena. Kada korisnicki Rijecnik naraste preko te velicine, Rijecnik 'ce biti smjesten na nas server. Kako bi se korisnicki Rijecnik spremio na nas server morate odabrati naziv Vaseg Rijecnika. Ukoliko ste ve'c prije spremali Rijecnik na nase servere, unesite naziv Rijecnika i pritisnite na Povrati.',

		aboutTab		: 'O SCAYT'
	},

	about :
	{
		title		: 'O CKEditoru',
		dlgTitle	: 'O CKEditoru',
		help	: 'Provjeri $1 za pomo'c.',
		userGuide : 'Vodic za CKEditor korisnike',
		moreInfo	: 'Za informacije o licencama posjetite nasu web stranicu:',
		copy		: 'Copyright &copy; $1. All rights reserved.'
	},

	maximize : 'Pove'caj',
	minimize : 'Smanji',

	fakeobjects :
	{
		anchor		: 'Sidro',
		flash		: 'Flash animacija',
		iframe		: 'IFrame',
		hiddenfield	: 'Sakriveno polje',
		unknown		: 'Nepoznati objekt'
	},

	resize : 'Povuci za promjenu velicine',

	colordialog :
	{
		title		: 'Odaberi boju',
		options	:	'Opcije boje',
		highlight	: 'Istaknuto',
		selected	: 'Odabrana boja',
		clear		: 'Ocisti'
	},

	toolbarCollapse	: 'Smanji alatnu traku',
	toolbarExpand	: 'Prosiri alatnu traku',

	toolbarGroups :
	{
		document : 'Dokument',
		clipboard : 'Meduspremnik/Ponisti',
		editing : 'Uredivanje',
		forms : 'Forme',
		basicstyles : 'Osnovni stilovi',
		paragraph : 'Paragraf',
		links : 'Veze',
		insert : 'Umetni',
		styles : 'Stilovi',
		colors : 'Boje',
		tools : 'Alatke'
	},

	bidi :
	{
		ltr : 'Smjer teksta s lijeva na desno',
		rtl : 'Smjer teksta s desna na lijevo'
	},

	docprops :
	{
		label : 'Svojstva dokumenta',
		title : 'Svojstva dokumenta',
		design : 'Dizajn',
		meta : 'Meta Data',
		chooseColor : 'Odaberi',
		other : '<drugi>',
		docTitle :	'Naslov stranice',
		charset : 	'Enkodiranje znakova',
		charsetOther : 'Ostalo enkodiranje znakova',
		charsetASCII : 'ASCII',
		charsetCE : 'Sredisnja Europa',
		charsetCT : 'Tradicionalna kineska (Big5)',
		charsetCR : ''Cirilica',
		charsetGR : 'Grcka',
		charsetJP : 'Japanska',
		charsetKR : 'Koreanska',
		charsetTR : 'Turska',
		charsetUN : 'Unicode (UTF-8)',
		charsetWE : 'Zapadna Europa',
		docType : 'Zaglavlje vrste dokumenta',
		docTypeOther : 'Ostalo zaglavlje vrste dokumenta',
		xhtmlDec : 'Ubaci XHTML deklaracije',
		bgColor : 'Boja pozadine',
		bgImage : 'URL slike pozadine',
		bgFixed : 'Pozadine se ne pomice',
		txtColor : 'Boja teksta',
		margin : 'Margine stranice',
		marginTop : 'Vrh',
		marginLeft : 'Lijevo',
		marginRight : 'Desno',
		marginBottom : 'Dolje',
		metaKeywords : 'Kljucne rijeci dokumenta (odvojene zarezom)',
		metaDescription : 'Opis dokumenta',
		metaAuthor : 'Autor',
		metaCopyright : 'Autorska prava',
		previewHtml : '<p>Ovo je neki <strong>primjer teksta</strong>. Vi koristite <a href="javascript:void(0)">CKEditor</a>.</p>'
	}
};
