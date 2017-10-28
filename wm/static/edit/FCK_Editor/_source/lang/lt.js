/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object for the
 * Lithuanian language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Contains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['lt'] =
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
	editorTitle : 'Pilnas redaktorius, %1',
	editorHelp : 'Spauskite ALT 0 del pagalbos',

	// ARIA descriptions.
	toolbars	: 'Redaktoriaus irankiai',
	editor		: 'Pilnas redaktorius',

	// Toolbar buttons without dialogs.
	source			: 'Saltinis',
	newPage			: 'Naujas puslapis',
	save			: 'Issaugoti',
	preview			: 'Perziūra',
	cut				: 'Iskirpti',
	copy			: 'Kopijuoti',
	paste			: 'Ideti',
	print			: 'Spausdinti',
	underline		: 'Pabrauktas',
	bold			: 'Pusjuodis',
	italic			: 'Kursyvas',
	selectAll		: 'Pazymeti viska',
	removeFormat	: 'Panaikinti formata',
	strike			: 'Perbrauktas',
	subscript		: 'Apatinis indeksas',
	superscript		: 'Virsutinis indeksas',
	horizontalrule	: 'Iterpti horizontalia linija',
	pagebreak		: 'Iterpti puslapiu skirtuka',
	pagebreakAlt		: 'Puslapio skirtukas',
	unlink			: 'Panaikinti nuoroda',
	undo			: 'Atsaukti',
	redo			: 'Atstatyti',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Narsyti po serveri',
		url				: 'URL',
		protocol		: 'Protokolas',
		upload			: 'Siusti',
		uploadSubmit	: 'Siusti i serveri',
		image			: 'Vaizdas',
		flash			: 'Flash',
		form			: 'Forma',
		checkbox		: 'Zymimasis langelis',
		radio			: 'Zymimoji akute',
		textField		: 'Teksto laukas',
		textarea		: 'Teksto sritis',
		hiddenField		: 'Nerodomas laukas',
		button			: 'Mygtukas',
		select			: 'Atrankos laukas',
		imageButton		: 'Vaizdinis mygtukas',
		notSet			: '<nera nustatyta>',
		id				: 'Id',
		name			: 'Vardas',
		langDir			: 'Teksto kryptis',
		langDirLtr		: 'Is kaires i desine (LTR)',
		langDirRtl		: 'Is desines i kaire (RTL)',
		langCode		: 'Kalbos kodas',
		longDescr		: 'Ilgas aprasymas URL',
		cssClass		: 'Stiliu lenteles klases',
		advisoryTitle	: 'Konsultacine antraste',
		cssStyle		: 'Stilius',
		ok				: 'OK',
		cancel			: 'Nutraukti',
		close			: 'Uzdaryti',
		preview			: 'Perziūreti',
		generalTab		: 'Bendros savybes',
		advancedTab		: 'Papildomas',
		validateNumberFailed : 'Si reiksme nera skaicius.',
		confirmNewPage	: 'Visas neissaugotas turinys bus prarastas. Ar tikrai norite ikrauti nauja puslapi?',
		confirmCancel	: 'Kai kurie parametrai pasikeite. Ar tikrai norite uzverti langa?',
		options			: 'Parametrai',
		target			: 'Tiksline nuoroda',
		targetNew		: 'Naujas langas (_blank)',
		targetTop		: 'Virsutinis langas (_top)',
		targetSelf		: 'Esamas langas (_self)',
		targetParent	: 'Paskutinis langas (_parent)',
		langDirLTR		: 'Is kaires i desine (LTR)',
		langDirRTL		: 'Is desines i kaire (RTL)',
		styles			: 'Stilius',
		cssClasses		: 'Stiliu klases',
		width			: 'Plotis',
		height			: 'Aukstis',
		align			: 'Lygiuoti',
		alignLeft		: 'Kaire',
		alignRight		: 'Desine',
		alignCenter		: 'Centra',
		alignTop		: 'Virsūne',
		alignMiddle		: 'Viduri',
		alignBottom		: 'Apacia',
		invalidValue	: 'Invalid value.', // MISSING
		invalidHeight	: 'Aukstis turi būti nurodytas skaiciais.',
		invalidWidth	: 'Plotis turi būti nurodytas skaiciais.',
		invalidCssLength	: 'Reiksme nurodyta "%1" laukui, turi būti teigiamas skaicius su arba be tinkamo CSS matavimo vieneto (px, %, in, cm, mm, em, ex, pt arba pc).',
		invalidHtmlLength	: 'Reiksme nurodyta "%1" laukui, turi būti teigiamas skaicius su arba be tinkamo HTML matavimo vieneto (px arba %).',
		invalidInlineStyle	: 'Reiksme nurodyta vidiniame stiliuje turi būti sudaryta is vieno siu reiksmiu "vardas : reiksme", atskirta kabliataskiais.',
		cssLengthTooltip	: 'Iveskite reiksme pikseliais arba skaiciais su tinkamu CSS vienetu (px, %, in, cm, mm, em, ex, pt arba pc).',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, netinkamas</span>'
	},

	contextmenu :
	{
		options : 'Kontekstinio meniu parametrai'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Iterpti specialu simboli',
		title		: 'Pasirinkite specialu simboli',
		options : 'Specialaus simbolio nustatymai'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Iterpti/taisyti nuoroda',
		other 		: '<kitas>',
		menu		: 'Taisyti nuoroda',
		title		: 'Nuoroda',
		info		: 'Nuorodos informacija',
		target		: 'Paskirties vieta',
		upload		: 'Siusti',
		advanced	: 'Papildomas',
		type		: 'Nuorodos tipas',
		toUrl		: 'Nuoroda',
		toAnchor	: 'Zyme siame puslapyje',
		toEmail		: 'El.pastas',
		targetFrame		: '<kadras>',
		targetPopup		: '<isskleidziamas langas>',
		targetFrameName	: 'Paskirties kadro vardas',
		targetPopupName	: 'Paskirties lango vardas',
		popupFeatures	: 'Isskleidziamo lango savybes',
		popupResizable	: 'Kintamas dydis',
		popupStatusBar	: 'Būsenos juosta',
		popupLocationBar: 'Adreso juosta',
		popupToolbar	: 'Mygtuku juosta',
		popupMenuBar	: 'Meniu juosta',
		popupFullScreen	: 'Visas ekranas (IE)',
		popupScrollBars	: 'Slinkties juostos',
		popupDependent	: 'Priklausomas (Netscape)',
		popupLeft		: 'Kaire pozicija',
		popupTop		: 'Virsutine pozicija',
		id				: 'Id',
		langDir			: 'Teksto kryptis',
		langDirLTR		: 'Is kaires i desine (LTR)',
		langDirRTL		: 'Is desines i kaire (RTL)',
		acccessKey		: 'Prieigos raktas',
		name			: 'Vardas',
		langCode			: 'Teksto kryptis',
		tabIndex			: 'Tabuliavimo indeksas',
		advisoryTitle		: 'Konsultacine antraste',
		advisoryContentType	: 'Konsultacinio turinio tipas',
		cssClasses		: 'Stiliu lenteles klases',
		charset			: 'Susietu istekliu simboliu lentele',
		styles			: 'Stilius',
		rel			: 'Sasajos',
		selectAnchor		: 'Pasirinkite zyme',
		anchorName		: 'Pagal zymes varda',
		anchorId			: 'Pagal zymes Id',
		emailAddress		: 'El.pasto adresas',
		emailSubject		: 'Zinutes tema',
		emailBody		: 'Zinutes turinys',
		noAnchors		: '(Siame dokumente zymiu nera)',
		noUrl			: 'Prasome ivesti nuorodos URL',
		noEmail			: 'Prasome ivesti el.pasto adresa'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Iterpti/modifikuoti zyme',
		menu		: 'Zymes savybes',
		title		: 'Zymes savybes',
		name		: 'Zymes vardas',
		errorName	: 'Prasome ivesti zymes varda',
		remove		: 'Pasalinti zyme'
	},

	// List style dialog
	list:
	{
		numberedTitle		: 'Skaitmeninio saraso nustatymai',
		bulletedTitle		: 'Zenklelinio saraso nustatymai',
		type				: 'Rūsis',
		start				: 'Pradzia',
		validateStartNumber				:'Saraso pradzios skaitmuo turi būti sveikas skaicius.',
		circle				: 'Apskritimas',
		disc				: 'Diskas',
		square				: 'Kvadratas',
		none				: 'Niekas',
		notset				: '<nenurodytas>',
		armenian			: 'Armeniski skaitmenys',
		georgian			: 'Gruziniski skaitmenys (an, ban, gan, t.t)',
		lowerRoman			: 'Mazosios Romenu (i, ii, iii, iv, v, t.t)',
		upperRoman			: 'Didziosios Romenu (I, II, III, IV, V, t.t)',
		lowerAlpha			: 'Mazosios Alpha (a, b, c, d, e, t.t)',
		upperAlpha			: 'Didziosios Alpha (A, B, C, D, E, t.t)',
		lowerGreek			: 'Mazosios Graiku (alpha, beta, gamma, t.t)',
		decimal				: 'Desimtainis (1, 2, 3, t.t)',
		decimalLeadingZero	: 'Desimtainis su nuliu priekyje (01, 02, 03, t.t)'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Surasti ir pakeisti',
		find				: 'Rasti',
		replace				: 'Pakeisti',
		findWhat			: 'Surasti teksta:',
		replaceWith			: 'Pakeisti tekstu:',
		notFoundMsg			: 'Nurodytas tekstas nerastas.',
		findOptions			: 'Paieskos nustatymai',
		matchCase			: 'Skirti didziasias ir mazasias raides',
		matchWord			: 'Atitikti pilna zodi',
		matchCyclic			: 'Sutampantis cikliskumas',
		replaceAll			: 'Pakeisti viska',
		replaceSuccessMsg	: '%1 sutapimas(u) buvo pakeisti.'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Lentele',
		title		: 'Lenteles savybes',
		menu		: 'Lenteles savybes',
		deleteTable	: 'Salinti lentele',
		rows		: 'Eilutes',
		columns		: 'Stulpeliai',
		border		: 'Remelio dydis',
		widthPx		: 'taskais',
		widthPc		: 'procentais',
		widthUnit	: 'plocio vienetas',
		cellSpace	: 'Tarpas tarp langeliu',
		cellPad		: 'Trapas nuo langelio remo iki teksto',
		caption		: 'Antraste',
		summary		: 'Santrauka',
		headers		: 'Antrastes',
		headersNone		: 'Nera',
		headersColumn	: 'Pirmas stulpelis',
		headersRow		: 'Pirma eilute',
		headersBoth		: 'Abu',
		invalidRows		: 'Skaicius turi būti didesnis nei 0.',
		invalidCols		: 'Skaicius turi būti didesnis nei 0.',
		invalidBorder	: 'Reiksme turi būti nurodyta skaiciumi.',
		invalidWidth	: 'Reiksme turi būti nurodyta skaiciumi.',
		invalidHeight	: 'Reiksme turi būti nurodyta skaiciumi.',
		invalidCellSpacing	: 'Reiksme turi būti nurodyta skaiciumi.',
		invalidCellPadding	: 'Reiksme turi būti nurodyta skaiciumi.',

		cell :
		{
			menu			: 'Langelis',
			insertBefore	: 'Iterpti langeli pries',
			insertAfter		: 'Iterpti langeli po',
			deleteCell		: 'Salinti langelius',
			merge			: 'Sujungti langelius',
			mergeRight		: 'Sujungti su desine',
			mergeDown		: 'Sujungti su apacia',
			splitHorizontal	: 'Skaidyti langeli horizontaliai',
			splitVertical	: 'Skaidyti langeli vertikaliai',
			title			: 'Cell nustatymai',
			cellType		: 'Cell rūsis',
			rowSpan			: 'Eiluciu Span',
			colSpan			: 'Stulpeliu Span',
			wordWrap		: 'Sutraukti raides',
			hAlign			: 'Horizontalus lygiavimas',
			vAlign			: 'Vertikalus lygiavimas',
			alignBaseline	: 'Apatine linija',
			bgColor			: 'Fono spalva',
			borderColor		: 'Remelio spalva',
			data			: 'Data',
			header			: 'Antraste',
			yes				: 'Taip',
			no				: 'Ne',
			invalidWidth	: 'Reiksme turi būti skaicius.',
			invalidHeight	: 'Reiksme turi būti skaicius.',
			invalidRowSpan	: 'Reiksme turi būti skaicius.',
			invalidColSpan	: 'Reiksme turi būti skaicius.',
			chooseColor		: 'Pasirinkite'
		},

		row :
		{
			menu			: 'Eilute',
			insertBefore	: 'Iterpti eilute pries',
			insertAfter		: 'Iterpti eilute po',
			deleteRow		: 'Salinti eilutes'
		},

		column :
		{
			menu			: 'Stulpelis',
			insertBefore	: 'Iterpti stulpeli pries',
			insertAfter		: 'Iterpti stulpeli po',
			deleteColumn	: 'Salinti stulpelius'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Mygtuko savybes',
		text		: 'Tekstas (Reiksme)',
		type		: 'Tipas',
		typeBtn		: 'Mygtukas',
		typeSbm		: 'Siusti',
		typeRst		: 'Isvalyti'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Zymimojo langelio savybes',
		radioTitle	: 'Zymimosios akutes savybes',
		value		: 'Reiksme',
		selected	: 'Pazymetas'
	},

	// Form Dialog.
	form :
	{
		title		: 'Formos savybes',
		menu		: 'Formos savybes',
		action		: 'Veiksmas',
		method		: 'Metodas',
		encoding	: 'Kodavimas'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Atrankos lauko savybes',
		selectInfo	: 'Informacija',
		opAvail		: 'Galimos parinktys',
		value		: 'Reiksme',
		size		: 'Dydis',
		lines		: 'eiluciu',
		chkMulti	: 'Leisti daugeriopa atranka',
		opText		: 'Tekstas',
		opValue		: 'Reiksme',
		btnAdd		: 'Itraukti',
		btnModify	: 'Modifikuoti',
		btnUp		: 'Aukstyn',
		btnDown		: 'Zemyn',
		btnSetValue : 'Laikyti pazymeta reiksme',
		btnDelete	: 'Trinti'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Teksto srities savybes',
		cols		: 'Ilgis',
		rows		: 'Plotis'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Teksto lauko savybes',
		name		: 'Vardas',
		value		: 'Reiksme',
		charWidth	: 'Ilgis simboliais',
		maxChars	: 'Maksimalus simboliu skaicius',
		type		: 'Tipas',
		typeText	: 'Tekstas',
		typePass	: 'Slaptazodis'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Nerodomo lauko savybes',
		name	: 'Vardas',
		value	: 'Reiksme'
	},

	// Image Dialog.
	image :
	{
		title		: 'Vaizdo savybes',
		titleButton	: 'Vaizdinio mygtuko savybes',
		menu		: 'Vaizdo savybes',
		infoTab		: 'Vaizdo informacija',
		btnUpload	: 'Siusti i serveri',
		upload		: 'Nusiusti',
		alt			: 'Alternatyvus Tekstas',
		lockRatio	: 'Islaikyti proporcija',
		resetSize	: 'Atstatyti dydi',
		border		: 'Remelis',
		hSpace		: 'Hor.Erdve',
		vSpace		: 'Vert.Erdve',
		alertUrl	: 'Prasome ivesti vaizdo URL',
		linkTab		: 'Nuoroda',
		button2Img	: 'Ar norite mygtuka paversti paprastu paveiksliuku?',
		img2Button	: 'Ar norite paveiksliuka paversti mygtuku?',
		urlMissing	: 'Paveiksliuko nuorodos nera.',
		validateBorder	: 'Reiksme turi būti sveikas skaicius.',
		validateHSpace	: 'Reiksme turi būti sveikas skaicius.',
		validateVSpace	: 'Reiksme turi būti sveikas skaicius.'
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Flash savybes',
		propertiesTab	: 'Nustatymai',
		title			: 'Flash savybes',
		chkPlay			: 'Automatinis paleidimas',
		chkLoop			: 'Ciklas',
		chkMenu			: 'Leisti Flash meniu',
		chkFull			: 'Leisti per visa ekrana',
 		scale			: 'Mastelis',
		scaleAll		: 'Rodyti visa',
		scaleNoBorder	: 'Be remelio',
		scaleFit		: 'Tikslus atitikimas',
		access			: 'Skripto priejimas',
		accessAlways	: 'Visada',
		accessSameDomain: 'Tas pats domenas',
		accessNever		: 'Niekada',
		alignAbsBottom	: 'Absoliucia apacia',
		alignAbsMiddle	: 'Absoliutu viduri',
		alignBaseline	: 'Apatine linija',
		alignTextTop	: 'Teksto virsūne',
		quality			: 'Kokybe',
		qualityBest		: 'Geriausia',
		qualityHigh		: 'Gera',
		qualityAutoHigh	: 'Automatiskai Gera',
		qualityMedium	: 'Vidutine',
		qualityAutoLow	: 'Automatiskai Zema',
		qualityLow		: 'Zema',
		windowModeWindow: 'Langas',
		windowModeOpaque: 'Nepermatomas',
		windowModeTransparent : 'Permatomas',
		windowMode		: 'Lango rezimas',
		flashvars		: 'Flash kintamieji',
		bgcolor			: 'Fono spalva',
		hSpace			: 'Hor.Erdve',
		vSpace			: 'Vert.Erdve',
		validateSrc		: 'Prasome ivesti nuorodos URL',
		validateHSpace	: 'HSpace turi būti skaicius.',
		validateVSpace	: 'VSpace turi būti skaicius.'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Rasybos tikrinimas',
		title			: 'Tikrinti klaidas',
		notAvailable	: 'Atleiskite, siuo metu servisas neprieinamas.',
		errorLoading	: 'Klaida ikraunant servisa: %s.',
		notInDic		: 'Zodyne nerastas',
		changeTo		: 'Pakeisti i',
		btnIgnore		: 'Ignoruoti',
		btnIgnoreAll	: 'Ignoruoti visus',
		btnReplace		: 'Pakeisti',
		btnReplaceAll	: 'Pakeisti visus',
		btnUndo			: 'Atsaukti',
		noSuggestions	: '- Nera pasiūlymu -',
		progress		: 'Vyksta rasybos tikrinimas...',
		noMispell		: 'Rasybos tikrinimas baigtas: Nerasta rasybos klaidu',
		noChanges		: 'Rasybos tikrinimas baigtas: Nera pakeistu zodziu',
		oneChange		: 'Rasybos tikrinimas baigtas: Vienas zodis pakeistas',
		manyChanges		: 'Rasybos tikrinimas baigtas: Pakeista %1 zodziu',
		ieSpellDownload	: 'Rasybos tikrinimas neinstaliuotas. Ar Jūs norite ji dabar atsisiusti?'
	},

	smiley :
	{
		toolbar	: 'Veideliai',
		title	: 'Iterpti veideli',
		options : 'Sypseneliu nustatymai'
	},

	elementsPath :
	{
		eleLabel : 'Elemento kelias',
		eleTitle : '%1 elementas'
	},

	numberedlist	: 'Numeruotas sarasas',
	bulletedlist	: 'Suzenklintas sarasas',
	indent			: 'Padidinti itrauka',
	outdent			: 'Sumazinti itrauka',

	justify :
	{
		left	: 'Lygiuoti kaire',
		center	: 'Centruoti',
		right	: 'Lygiuoti desine',
		block	: 'Lygiuoti abi puses'
	},

	blockquote : 'Citata',

	clipboard :
	{
		title		: 'Ideti',
		cutError	: 'Jūsu narsykles saugumo nustatymai neleidzia redaktoriui automatiskai ivykdyti iskirpimo operaciju. Tam prasome naudoti klaviatūra (Ctrl/Cmd+X).',
		copyError	: 'Jūsu narsykles saugumo nustatymai neleidzia redaktoriui automatiskai ivykdyti kopijavimo operaciju. Tam prasome naudoti klaviatūra (Ctrl/Cmd+C).',
		pasteMsg	: 'Zemiau esanciame ivedimo lauke idekite teksta, naudodami klaviatūra (<STRONG>Ctrl/Cmd+V</STRONG>) ir paspauskite mygtuka <STRONG>OK</STRONG>.',
		securityMsg	: 'Del jūsu narsykles saugumo nustatymu, redaktorius negali tiesiogiai pasiekti laikinosios atminties. Jums reikia nukopijuoti dar karta i si langa.',
		pasteArea	: 'Ikelti dali'
	},

	pastefromword :
	{
		confirmCleanup	: 'Tekstas, kuri ikeliate yra kopijuojamas is Word. Ar norite ji isvalyti pries ikeliant?',
		toolbar			: 'Ideti is Word',
		title			: 'Ideti is Word',
		error			: 'Del vidiniu sutrikimu, nepavyko isvalyti ikeliamo teksto'
	},

	pasteText :
	{
		button	: 'Ideti kaip gryna teksta',
		title	: 'Ideti kaip gryna teksta'
	},

	templates :
	{
		button			: 'Sablonai',
		title			: 'Turinio sablonai',
		options : 'Template Options',
		insertOption	: 'Pakeisti dabartini turini pasirinktu sablonu',
		selectPromptMsg	: 'Pasirinkite norima sablona<br>(<b>Demesio!</b> esamas turinys bus prarastas):',
		emptyListMsg	: '(Sablonu sarasas tuscias)'
	},

	showBlocks : 'Rodyti blokus',

	stylesCombo :
	{
		label		: 'Stilius',
		panelTitle	: 'Stiliu formatavimas',
		panelTitle1	: 'Bloku stiliai',
		panelTitle2	: 'Vidiniai stiliai',
		panelTitle3	: 'Objektu stiliai'
	},

	format :
	{
		label		: 'Srifto formatas',
		panelTitle	: 'Srifto formatas',

		tag_p		: 'Normalus',
		tag_pre		: 'Formuotas',
		tag_address	: 'Kreipinio',
		tag_h1		: 'Antrastinis 1',
		tag_h2		: 'Antrastinis 2',
		tag_h3		: 'Antrastinis 3',
		tag_h4		: 'Antrastinis 4',
		tag_h5		: 'Antrastinis 5',
		tag_h6		: 'Antrastinis 6',
		tag_div		: 'Normalus (DIV)'
	},

	div :
	{
		title				: 'Sukurti Div elementa',
		toolbar				: 'Sukurti Div elementa',
		cssClassInputLabel	: 'Stiliu klases',
		styleSelectLabel	: 'Stilius',
		IdInputLabel		: 'Id',
		languageCodeInputLabel	: ' Kalbos kodas',
		inlineStyleInputLabel	: 'Vidiniai stiliai',
		advisoryTitleInputLabel	: 'Patariamas pavadinimas',
		langDirLabel		: 'Kalbos nurodymai',
		langDirLTRLabel		: 'Is kaires i desine (LTR)',
		langDirRTLLabel		: 'Is desines i kaire (RTL)',
		edit				: 'Redaguoti Div',
		remove				: 'Pasalinti Div'
  	},

	iframe :
	{
		title		: 'IFrame nustatymai',
		toolbar		: 'IFrame',
		noUrl		: 'Nurodykite iframe nuoroda',
		scrolling	: 'Ijungti slankiklius',
		border		: 'Rodyti remeli'
	},

	font :
	{
		label		: 'Sriftas',
		voiceLabel	: 'Sriftas',
		panelTitle	: 'Sriftas'
	},

	fontSize :
	{
		label		: 'Srifto dydis',
		voiceLabel	: 'Srifto dydis',
		panelTitle	: 'Srifto dydis'
	},

	colorButton :
	{
		textColorTitle	: 'Teksto spalva',
		bgColorTitle	: 'Fono spalva',
		panelTitle		: 'Spalva',
		auto			: 'Automatinis',
		more			: 'Daugiau spalvu...'
	},

	colors :
	{
		'000' : 'Juoda',
		'800000' : 'Kastonine',
		'8B4513' : 'Tamsiai ruda',
		'2F4F4F' : 'Pilka tamsaus siferio',
		'008080' : 'Teal',
		'000080' : 'Karinis',
		'4B0082' : 'Indigo',
		'696969' : 'Tamsiai pilka',
		'B22222' : 'Ugnies',
		'A52A2A' : 'Ruda',
		'DAA520' : 'Aukso',
		'006400' : 'Tamsiai zalia',
		'40E0D0' : 'Turquoise',
		'0000CD' : 'Vidutine melyna',
		'800080' : 'Violetine',
		'808080' : 'Pilka',
		'F00' : 'Raudona',
		'FF8C00' : 'Tamsiai oranzine',
		'FFD700' : 'Auksine',
		'008000' : 'Zalia',
		'0FF' : 'Zydra',
		'00F' : 'Melyna',
		'EE82EE' : 'Violetine',
		'A9A9A9' : 'Dim Gray',
		'FFA07A' : 'Light Salmon',
		'FFA500' : 'Oranzine',
		'FFFF00' : 'Geltona',
		'00FF00' : 'Citrinu',
		'AFEEEE' : 'Pale Turquoise',
		'ADD8E6' : 'Sviesiai melyna',
		'DDA0DD' : 'Plum',
		'D3D3D3' : 'Sviesiai pilka',
		'FFF0F5' : 'Lavender Blush',
		'FAEBD7' : 'Antique White',
		'FFFFE0' : 'Sviesiai geltona',
		'F0FFF0' : 'Honeydew',
		'F0FFFF' : 'Azure',
		'F0F8FF' : 'Alice Blue',
		'E6E6FA' : 'Lavender',
		'FFF' : 'Balta'
	},

	scayt :
	{
		title			: 'Tikrinti klaidas kai rasoma',
		opera_title		: 'Nepalaikoma narsykleje Opera',
		enable			: 'Ijungti SCAYT',
		disable			: 'Isjungti SCAYT',
		about			: 'Apie SCAYT',
		toggle			: 'Perjungti SCAYT',
		options			: 'Parametrai',
		langs			: 'Kalbos',
		moreSuggestions	: 'Daugiau patarimu',
		ignore			: 'Ignoruoti',
		ignoreAll		: 'Ignoruoti viska',
		addWord			: 'Prideti zodi',
		emptyDic		: 'Zodyno vardas neturetu būti tuscias.',

		optionsTab		: 'Parametrai',
		allCaps			: 'Ignoruoti visas didziasias raides',
		ignoreDomainNames : 'Ignoruoti domenu vardus',
		mixedCase		: 'Ignoruoti maisyto dydzio raides',
		mixedWithDigits	: 'Ignoruoti raides su skaiciais',

		languagesTab	: 'Kalbos',

		dictionariesTab	: 'Zodynai',
		dic_field_name	: 'Zodyno pavadinimas',
		dic_create		: 'Sukurti',
		dic_restore		: 'Atstatyti',
		dic_delete		: 'Istrinti',
		dic_rename		: 'Pervadinti',
		dic_info		: 'Paprastai zodynas yra saugojamas sausaineliuose (cookies), kuriu dydis, bet kokiu atveju, yra apribotas. Esant sausaineliu apimties pervisiui, viskas bus saugoma serveryje. Jei norite is kart viska saugoti serveryje, turite sugalvoti zodynui pavadinima. Jei jau turite zodyna, irasykite pavadinima ir nuspauskite Atstatyti mygtuka.',

		aboutTab		: 'Apie'
	},

	about :
	{
		title		: 'Apie CKEditor',
		dlgTitle	: 'Apie CKEditor',
		help	: 'Patikrinkite $1 del pagalbos.',
		userGuide : 'CKEditor Vartotojo Gidas',
		moreInfo	: 'Del licencijavimo apsilankykite mūsu svetaineje:',
		copy		: 'Copyright &copy; $1. Visos teiss saugomos.'
	},

	maximize : 'Isdidinti',
	minimize : 'Sumazinti',

	fakeobjects :
	{
		anchor		: 'Zyme',
		flash		: 'Flash animacija',
		iframe		: 'IFrame',
		hiddenfield	: 'Pasleptas laukas',
		unknown		: 'Nezinomas objektas'
	},

	resize : 'Pavilkite, kad pakeistumete dydi',

	colordialog :
	{
		title		: 'Pasirinkite spalva',
		options	:	'Spalvos nustatymai',
		highlight	: 'Paryskinti',
		selected	: 'Pasirinkta spalva',
		clear		: 'Isvalyti'
	},

	toolbarCollapse	: 'Apjungti irankiu juosta',
	toolbarExpand	: 'Isplesti irankiu juosta',

	toolbarGroups :
	{
		document : 'Dokumentas',
		clipboard : 'Atmintine/Atgal',
		editing : 'Redagavimas',
		forms : 'Formos',
		basicstyles : 'Pagrindiniai stiliai',
		paragraph : 'Paragrafas',
		links : 'Nuorodos',
		insert : 'Iterpti',
		styles : 'Stiliai',
		colors : 'Spalvos',
		tools : 'Irankiai'
	},

	bidi :
	{
		ltr : 'Tekstas is kaires i desine',
		rtl : 'Tekstas is desines i kaire'
	},

	docprops :
	{
		label : 'Dokumento savybes',
		title : 'Dokumento savybes',
		design : 'Isdestymas',
		meta : 'Meta duomenys',
		chooseColor : 'Pasirinkite',
		other : '<kitas>',
		docTitle :	'Puslapio antraste',
		charset : 	'Simboliu kodavimo lentele',
		charsetOther : 'Kita simboliu kodavimo lentele',
		charsetASCII : 'ASCII',
		charsetCE : 'Centrines Europos',
		charsetCT : 'Tradicines kinu (Big5)',
		charsetCR : 'Kirilica',
		charsetGR : 'Graiku',
		charsetJP : 'Japonu',
		charsetKR : 'Korejieciu',
		charsetTR : 'Turku',
		charsetUN : 'Unikodas (UTF-8)',
		charsetWE : 'Vakaru Europos',
		docType : 'Dokumento tipo antraste',
		docTypeOther : 'Kita dokumento tipo antraste',
		xhtmlDec : 'Itraukti XHTML deklaracijas',
		bgColor : 'Fono spalva',
		bgImage : 'Fono paveikslelio nuoroda (URL)',
		bgFixed : 'Neslenkantis fonas',
		txtColor : 'Teksto spalva',
		margin : 'Puslapio krastines',
		marginTop : 'Virsuje',
		marginLeft : 'Kaireje',
		marginRight : 'Desineje',
		marginBottom : 'Apacioje',
		metaKeywords : 'Dokumento indeksavimo raktiniai zodziai (atskirti kableliais)',
		metaDescription : 'Dokumento apibūdinimas',
		metaAuthor : 'Autorius',
		metaCopyright : 'Autorines teises',
		previewHtml : '<p>Tai yra <strong>pavyzdinis tekstas</strong>. Jūs naudojate <a href="javascript:void(0)">CKEditor</a>.</p>'
	}
};