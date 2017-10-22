/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Danish language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Contains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['da'] =
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
	editorTitle : 'Rich text editor, %1', // MISSING
	editorHelp : 'Tryk ALT 0 for hjaelp',

	// ARIA descriptions.
	toolbars	: 'Editors vaerktojslinjer',
	editor		: 'Rich Text Editor',

	// Toolbar buttons without dialogs.
	source			: 'Kilde',
	newPage			: 'Ny side',
	save			: 'Gem',
	preview			: 'Vis eksempel',
	cut				: 'Klip',
	copy			: 'Kopiér',
	paste			: 'Indsaet',
	print			: 'Udskriv',
	underline		: 'Understreget',
	bold			: 'Fed',
	italic			: 'Kursiv',
	selectAll		: 'Vaelg alt',
	removeFormat	: 'Fjern formatering',
	strike			: 'Gennemstreget',
	subscript		: 'Saenket skrift',
	superscript		: 'Haevet skrift',
	horizontalrule	: 'Indsaet vandret streg',
	pagebreak		: 'Indsaet sideskift',
	pagebreakAlt		: 'Sideskift',
	unlink			: 'Fjern hyperlink',
	undo			: 'Fortryd',
	redo			: 'Annullér fortryd',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Gennemse...',
		url				: 'URL',
		protocol		: 'Protokol',
		upload			: 'Upload',
		uploadSubmit	: 'Upload',
		image			: 'Indsaet billede',
		flash			: 'Indsaet Flash',
		form			: 'Indsaet formular',
		checkbox		: 'Indsaet afkrydsningsfelt',
		radio			: 'Indsaet alternativknap',
		textField		: 'Indsaet tekstfelt',
		textarea		: 'Indsaet tekstboks',
		hiddenField		: 'Indsaet skjult felt',
		button			: 'Indsaet knap',
		select			: 'Indsaet liste',
		imageButton		: 'Indsaet billedknap',
		notSet			: '<intet valgt>',
		id				: 'Id',
		name			: 'Navn',
		langDir			: 'Tekstretning',
		langDirLtr		: 'Fra venstre mod hojre (LTR)',
		langDirRtl		: 'Fra hojre mod venstre (RTL)',
		langCode		: 'Sprogkode',
		longDescr		: 'Udvidet beskrivelse',
		cssClass		: 'Typografiark (CSS)',
		advisoryTitle	: 'Titel',
		cssStyle		: 'Typografi (CSS)',
		ok				: 'OK',
		cancel			: 'Annullér',
		close			: 'Luk',
		preview			: 'Forhandsvisning',
		generalTab		: 'Generelt',
		advancedTab		: 'Avanceret',
		validateNumberFailed : 'Vaerdien er ikke et tal.',
		confirmNewPage	: 'Alt indhold, der ikke er blevet gemt, vil ga tabt. Er du sikker pa, at du vil indlaese en ny side?',
		confirmCancel	: 'Nogle af indstillingerne er blevet aendret. Er du sikker pa, at du vil lukke vinduet?',
		options			: 'Vis muligheder',
		target			: 'Mal',
		targetNew		: 'Nyt vindue (_blank)',
		targetTop		: 'Overste vindue (_top)',
		targetSelf		: 'Samme vindue (_self)',
		targetParent	: 'Samme vindue (_parent)',
		langDirLTR		: 'Venstre til hojre (LTR)',
		langDirRTL		: 'Hojre til venstre (RTL)',
		styles			: 'Style',
		cssClasses		: 'Stylesheetklasser',
		width			: 'Bredde',
		height			: 'Hojde',
		align			: 'Justering',
		alignLeft		: 'Venstre',
		alignRight		: 'Hojre',
		alignCenter		: 'Centreret',
		alignTop		: 'Overst',
		alignMiddle		: 'Centreret',
		alignBottom		: 'Nederst',
		invalidValue	: 'Invalid value.', // MISSING
		invalidHeight	: 'Hojde skal vaere et tal.',
		invalidWidth	: 'Bredde skal vaere et tal.',
		invalidCssLength	: 'Vaerdien specificeret for "%1" feltet skal vaere et positivt nummer med eller uden en CSS maleenhed  (px, %, in, cm, mm, em, ex, pt, eller pc).',
		invalidHtmlLength	: 'Vaerdien specificeret for "%1" feltet skal vaere et positivt nummer med eller uden en CSS maleenhed  (px eller %).',
		invalidInlineStyle	: 'Vaerdien specificeret for inline style skal indeholde en eller flere elementer med et format som "name:value", separeret af semikoloner',
		cssLengthTooltip	: 'Indsaet en numerisk vaerdi i pixel eller nummer med en gyldig CSS vaerdi (px, %, in, cm, mm, em, ex, pt, or pc).',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, ikke tilgaengelig</span>'
	},

	contextmenu :
	{
		options : 'Muligheder for hjaelpemenu'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Indsaet symbol',
		title		: 'Vaelg symbol',
		options : 'Muligheder for specialkarakterer'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Indsaet/redigér hyperlink',
		other 		: '<anden>',
		menu		: 'Redigér hyperlink',
		title		: 'Egenskaber for hyperlink',
		info		: 'Generelt',
		target		: 'Mal',
		upload		: 'Upload',
		advanced	: 'Avanceret',
		type		: 'Type',
		toUrl		: 'URL',
		toAnchor	: 'Bogmaerke pa denne side',
		toEmail		: 'E-mail',
		targetFrame		: '<ramme>',
		targetPopup		: '<popup vindue>',
		targetFrameName	: 'Destinationsvinduets navn',
		targetPopupName	: 'Popupvinduets navn',
		popupFeatures	: 'Egenskaber for popup',
		popupResizable	: 'Justérbar',
		popupStatusBar	: 'Statuslinje',
		popupLocationBar: 'Adresselinje',
		popupToolbar	: 'Vaerktojslinje',
		popupMenuBar	: 'Menulinje',
		popupFullScreen	: 'Fuld skaerm (IE)',
		popupScrollBars	: 'Scrollbar',
		popupDependent	: 'Koblet/dependent (Netscape)',
		popupLeft		: 'Position fra venstre',
		popupTop		: 'Position fra toppen',
		id				: 'Id',
		langDir			: 'Tekstretning',
		langDirLTR		: 'Fra venstre mod hojre (LTR)',
		langDirRTL		: 'Fra hojre mod venstre (RTL)',
		acccessKey		: 'Genvejstast',
		name			: 'Navn',
		langCode			: 'Tekstretning',
		tabIndex			: 'Tabulatorindeks',
		advisoryTitle		: 'Titel',
		advisoryContentType	: 'Indholdstype',
		cssClasses		: 'Typografiark',
		charset			: 'Tegnsaet',
		styles			: 'Typografi',
		rel			: 'Relation',
		selectAnchor		: 'Vaelg et anker',
		anchorName		: 'Efter ankernavn',
		anchorId			: 'Efter element-Id',
		emailAddress		: 'E-mailadresse',
		emailSubject		: 'Emne',
		emailBody		: 'Besked',
		noAnchors		: '(Ingen bogmaerker i dokumentet)',
		noUrl			: 'Indtast hyperlink-URL!',
		noEmail			: 'Indtast e-mailadresse!'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Indsaet/redigér bogmaerke',
		menu		: 'Egenskaber for bogmaerke',
		title		: 'Egenskaber for bogmaerke',
		name		: 'Bogmaerkenavn',
		errorName	: 'Indtast bogmaerkenavn',
		remove		: 'Fjern bogmaerke'
	},

	// List style dialog
	list:
	{
		numberedTitle		: 'Egenskaber for nummereret liste',
		bulletedTitle		: 'Vaerdier for cirkelpunktopstilling',
		type				: 'Type',
		start				: 'Start',
		validateStartNumber				:'Den nummererede liste skal starte med et rundt nummer',
		circle				: 'Cirkel',
		disc				: 'Vaerdier for diskpunktopstilling',
		square				: 'Firkant',
		none				: 'Ingen',
		notset				: '<ikke defineret>',
		armenian			: 'Armensk nummering',
		georgian			: 'Georgiansk nummering (an, ban, gan, etc.)',
		lowerRoman			: 'Sma romerske (i, ii, iii, iv, v, etc.)',
		upperRoman			: 'Store romerske (I, II, III, IV, V, etc.)',
		lowerAlpha			: 'Sma alfabet (a, b, c, d, e, etc.)',
		upperAlpha			: 'Store alfabet (A, B, C, D, E, etc.)',
		lowerGreek			: 'Sma graesk (alpha, beta, gamma, etc.)',
		decimal				: 'Decimal (1, 2, 3, osv.)',
		decimalLeadingZero	: 'Decimaler med 0 forst (01, 02, 03, etc.)'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Sog og erstat',
		find				: 'Sog',
		replace				: 'Erstat',
		findWhat			: 'Sog efter:',
		replaceWith			: 'Erstat med:',
		notFoundMsg			: 'Sogeteksten blev ikke fundet',
		findOptions			: 'Find muligheder',
		matchCase			: 'Forskel pa store og sma bogstaver',
		matchWord			: 'Kun hele ord',
		matchCyclic			: 'Match cyklisk',
		replaceAll			: 'Erstat alle',
		replaceSuccessMsg	: '%1 forekomst(er) erstattet.'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Tabel',
		title		: 'Egenskaber for tabel',
		menu		: 'Egenskaber for tabel',
		deleteTable	: 'Slet tabel',
		rows		: 'Raekker',
		columns		: 'Kolonner',
		border		: 'Rammebredde',
		widthPx		: 'pixels',
		widthPc		: 'procent',
		widthUnit	: 'Bredde pa enhed',
		cellSpace	: 'Celleafstand',
		cellPad		: 'Cellemargen',
		caption		: 'Titel',
		summary		: 'Resumé',
		headers		: 'Hoved',
		headersNone		: 'Ingen',
		headersColumn	: 'Forste kolonne',
		headersRow		: 'Forste raekke',
		headersBoth		: 'Begge',
		invalidRows		: 'Antallet af raekker skal vaere storre end 0.',
		invalidCols		: 'Antallet af kolonner skal vaere storre end 0.',
		invalidBorder	: 'Rammetykkelse skal vaere et tal.',
		invalidWidth	: 'Tabelbredde skal vaere et tal.',
		invalidHeight	: 'Tabelhojde skal vaere et tal.',
		invalidCellSpacing	: 'Celleafstand skal vaere et tal.',
		invalidCellPadding	: 'Cellemargen skal vaere et tal.',

		cell :
		{
			menu			: 'Celle',
			insertBefore	: 'Indsaet celle for',
			insertAfter		: 'Indsaet celle efter',
			deleteCell		: 'Slet celle',
			merge			: 'Flet celler',
			mergeRight		: 'Flet til hojre',
			mergeDown		: 'Flet nedad',
			splitHorizontal	: 'Del celle vandret',
			splitVertical	: 'Del celle lodret',
			title			: 'Celleegenskaber',
			cellType		: 'Celletype',
			rowSpan			: 'Raekke span (rows span)',
			colSpan			: 'Kolonne span (columns span)',
			wordWrap		: 'Tekstombrydning',
			hAlign			: 'Vandret justering',
			vAlign			: 'Lodret justering',
			alignBaseline	: 'Grundlinje',
			bgColor			: 'Baggrundsfarve',
			borderColor		: 'Rammefarve',
			data			: 'Data',
			header			: 'Hoved',
			yes				: 'Ja',
			no				: 'Nej',
			invalidWidth	: 'Cellebredde skal vaere et tal.',
			invalidHeight	: 'Cellehojde skal vaere et tal.',
			invalidRowSpan	: 'Raekke span skal vaere et heltal.',
			invalidColSpan	: 'Kolonne span skal vaere et heltal.',
			chooseColor		: 'Vaelg'
		},

		row :
		{
			menu			: 'Raekke',
			insertBefore	: 'Indsaet raekke for',
			insertAfter		: 'Indsaet raekke efter',
			deleteRow		: 'Slet raekke'
		},

		column :
		{
			menu			: 'Kolonne',
			insertBefore	: 'Indsaet kolonne for',
			insertAfter		: 'Indsaet kolonne efter',
			deleteColumn	: 'Slet kolonne'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Egenskaber for knap',
		text		: 'Tekst',
		type		: 'Type',
		typeBtn		: 'Knap',
		typeSbm		: 'Send',
		typeRst		: 'Nulstil'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Egenskaber for afkrydsningsfelt',
		radioTitle	: 'Egenskaber for alternativknap',
		value		: 'Vaerdi',
		selected	: 'Valgt'
	},

	// Form Dialog.
	form :
	{
		title		: 'Egenskaber for formular',
		menu		: 'Egenskaber for formular',
		action		: 'Handling',
		method		: 'Metode',
		encoding	: 'Kodning (encoding)'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Egenskaber for liste',
		selectInfo	: 'Generelt',
		opAvail		: 'Valgmuligheder',
		value		: 'Vaerdi',
		size		: 'Storrelse',
		lines		: 'Linjer',
		chkMulti	: 'Tillad flere valg',
		opText		: 'Tekst',
		opValue		: 'Vaerdi',
		btnAdd		: 'Tilfoj',
		btnModify	: 'Redigér',
		btnUp		: 'Op',
		btnDown		: 'Ned',
		btnSetValue : 'Saet som valgt',
		btnDelete	: 'Slet'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Egenskaber for tekstboks',
		cols		: 'Kolonner',
		rows		: 'Raekker'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Egenskaber for tekstfelt',
		name		: 'Navn',
		value		: 'Vaerdi',
		charWidth	: 'Bredde (tegn)',
		maxChars	: 'Max. antal tegn',
		type		: 'Type',
		typeText	: 'Tekst',
		typePass	: 'Adgangskode'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Egenskaber for skjult felt',
		name	: 'Navn',
		value	: 'Vaerdi'
	},

	// Image Dialog.
	image :
	{
		title		: 'Egenskaber for billede',
		titleButton	: 'Egenskaber for billedknap',
		menu		: 'Egenskaber for billede',
		infoTab		: 'Generelt',
		btnUpload	: 'Upload fil til serveren',
		upload		: 'Upload',
		alt			: 'Alternativ tekst',
		lockRatio	: 'Las storrelsesforhold',
		resetSize	: 'Nulstil storrelse',
		border		: 'Ramme',
		hSpace		: 'Vandret margen',
		vSpace		: 'Lodret margen',
		alertUrl	: 'Indtast stien til billedet',
		linkTab		: 'Hyperlink',
		button2Img	: 'Vil du lave billedknappen om til et almindeligt billede?',
		img2Button	: 'Vil du lave billedet om til en billedknap?',
		urlMissing	: 'Kilde pa billed-URL mangler',
		validateBorder	: 'Kant skal vaere et helt nummer.',
		validateHSpace	: 'HSpace skal vaere et helt nummer.',
		validateVSpace	: 'VSpace skal vaere et helt nummer.'
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Egenskaber for Flash',
		propertiesTab	: 'Egenskaber',
		title			: 'Egenskaber for Flash',
		chkPlay			: 'Automatisk afspilning',
		chkLoop			: 'Gentagelse',
		chkMenu			: 'Vis Flash-menu',
		chkFull			: 'Tillad fuldskaerm',
 		scale			: 'Skalér',
		scaleAll		: 'Vis alt',
		scaleNoBorder	: 'Ingen ramme',
		scaleFit		: 'Tilpas storrelse',
		access			: 'Scriptadgang',
		accessAlways	: 'Altid',
		accessSameDomain: 'Samme domaene',
		accessNever		: 'Aldrig',
		alignAbsBottom	: 'Absolut nederst',
		alignAbsMiddle	: 'Absolut centreret',
		alignBaseline	: 'Grundlinje',
		alignTextTop	: 'Toppen af teksten',
		quality			: 'Kvalitet',
		qualityBest		: 'Bedste',
		qualityHigh		: 'Hoj',
		qualityAutoHigh	: 'Auto hoj',
		qualityMedium	: 'Medium',
		qualityAutoLow	: 'Auto lav',
		qualityLow		: 'Lav',
		windowModeWindow: 'Vindue',
		windowModeOpaque: 'Gennemsigtig (opaque)',
		windowModeTransparent : 'Transparent',
		windowMode		: 'Vinduestilstand',
		flashvars		: 'Variabler for Flash',
		bgcolor			: 'Baggrundsfarve',
		hSpace			: 'Vandret margen',
		vSpace			: 'Lodret margen',
		validateSrc		: 'Indtast hyperlink URL!',
		validateHSpace	: 'Vandret margen skal vaere et tal.',
		validateVSpace	: 'Lodret margen skal vaere et tal.'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Stavekontrol',
		title			: 'Stavekontrol',
		notAvailable	: 'Stavekontrol er desvaerre ikke tilgaengelig.',
		errorLoading	: 'Fejl ved indlaesning af host: %s.',
		notInDic		: 'Ikke i ordbogen',
		changeTo		: 'Forslag',
		btnIgnore		: 'Ignorér',
		btnIgnoreAll	: 'Ignorér alle',
		btnReplace		: 'Erstat',
		btnReplaceAll	: 'Erstat alle',
		btnUndo			: 'Tilbage',
		noSuggestions	: '(ingen forslag)',
		progress		: 'Stavekontrollen arbejder...',
		noMispell		: 'Stavekontrol faerdig: Ingen fejl fundet',
		noChanges		: 'Stavekontrol faerdig: Ingen ord aendret',
		oneChange		: 'Stavekontrol faerdig: Et ord aendret',
		manyChanges		: 'Stavekontrol faerdig: %1 ord aendret',
		ieSpellDownload	: 'Stavekontrol ikke installeret. Vil du installere den nu?'
	},

	smiley :
	{
		toolbar	: 'Smiley',
		title	: 'Vaelg smiley',
		options : 'Smileymuligheder'
	},

	elementsPath :
	{
		eleLabel : 'Sti pa element',
		eleTitle : '%1 element'
	},

	numberedlist	: 'Talopstilling',
	bulletedlist	: 'Punktopstilling',
	indent			: 'Forog indrykning',
	outdent			: 'Formindsk indrykning',

	justify :
	{
		left	: 'Venstrestillet',
		center	: 'Centreret',
		right	: 'Hojrestillet',
		block	: 'Lige margener'
	},

	blockquote : 'Blokcitat',

	clipboard :
	{
		title		: 'Indsaet',
		cutError	: 'Din browsers sikkerhedsindstillinger tillader ikke editoren at fa automatisk adgang til udklipsholderen.<br><br>Brug i stedet tastaturet til at klippe teksten (Ctrl/Cmd+X).',
		copyError	: 'Din browsers sikkerhedsindstillinger tillader ikke editoren at fa automatisk adgang til udklipsholderen.<br><br>Brug i stedet tastaturet til at kopiere teksten (Ctrl/Cmd+C).',
		pasteMsg	: 'Indsaet i feltet herunder (<STRONG>Ctrl/Cmd+V</STRONG>) og klik pa <STRONG>OK</STRONG>.',
		securityMsg	: 'Din browsers sikkerhedsindstillinger tillader ikke editoren at fa automatisk adgang til udklipsholderen.<br><br>Du skal indsaette udklipsholderens indhold i dette vindue igen.',
		pasteArea	: 'Indsaet omrade'
	},

	pastefromword :
	{
		confirmCleanup	: 'Den tekst du forsoger at indsaette ser ud til at komme fra Word. Vil du rense teksten for den indsaettes?',
		toolbar			: 'Indsaet fra Word',
		title			: 'Indsaet fra Word',
		error			: 'Det var ikke muligt at fjerne formatteringen pa den indsatte tekst grundet en intern fejl'
	},

	pasteText :
	{
		button	: 'Indsaet som ikke-formateret tekst',
		title	: 'Indsaet som ikke-formateret tekst'
	},

	templates :
	{
		button			: 'Skabeloner',
		title			: 'Indholdsskabeloner',
		options : 'Skabelon muligheder',
		insertOption	: 'Erstat det faktiske indhold',
		selectPromptMsg	: 'Vaelg den skabelon, som skal abnes i editoren (nuvaerende indhold vil blive overskrevet):',
		emptyListMsg	: '(Der er ikke defineret nogen skabelon)'
	},

	showBlocks : 'Vis afsnitsmaerker',

	stylesCombo :
	{
		label		: 'Typografi',
		panelTitle	: 'Formattering pa stylesheet',
		panelTitle1	: 'Block typografi',
		panelTitle2	: 'Inline typografi',
		panelTitle3	: 'Object typografi'
	},

	format :
	{
		label		: 'Formatering',
		panelTitle	: 'Formatering',

		tag_p		: 'Normal',
		tag_pre		: 'Formateret',
		tag_address	: 'Adresse',
		tag_h1		: 'Overskrift 1',
		tag_h2		: 'Overskrift 2',
		tag_h3		: 'Overskrift 3',
		tag_h4		: 'Overskrift 4',
		tag_h5		: 'Overskrift 5',
		tag_h6		: 'Overskrift 6',
		tag_div		: 'Normal (DIV)'
	},

	div :
	{
		title				: 'Opret Div Container',
		toolbar				: 'Opret Div Container',
		cssClassInputLabel	: 'Typografiark',
		styleSelectLabel	: 'Style',
		IdInputLabel		: 'Id',
		languageCodeInputLabel	: ' Sprogkode',
		inlineStyleInputLabel	: 'Inline Style',
		advisoryTitleInputLabel	: 'Vejledende titel',
		langDirLabel		: 'Sprogretning',
		langDirLTRLabel		: 'Venstre til hojre (LTR)',
		langDirRTLLabel		: 'Hojre til venstre (RTL)',
		edit				: 'Rediger Div',
		remove				: 'Slet Div'
  	},

	iframe :
	{
		title		: 'Iframe egenskaber',
		toolbar		: 'Iframe',
		noUrl		: 'Venligst indsaet URL pa iframen',
		scrolling	: 'Aktiver scrollbars',
		border		: 'Vis kant pa rammen'
	},

	font :
	{
		label		: 'Skrifttype',
		voiceLabel	: 'Skrifttype',
		panelTitle	: 'Skrifttype'
	},

	fontSize :
	{
		label		: 'Skriftstorrelse',
		voiceLabel	: 'Skriftstorrelse',
		panelTitle	: 'Skriftstorrelse'
	},

	colorButton :
	{
		textColorTitle	: 'Tekstfarve',
		bgColorTitle	: 'Baggrundsfarve',
		panelTitle		: 'Farver',
		auto			: 'Automatisk',
		more			: 'Flere farver...'
	},

	colors :
	{
		'000' : 'Sort',
		'800000' : 'Morkerod',
		'8B4513' : 'Mork orange',
		'2F4F4F' : 'Dark Slate Gra',
		'008080' : 'Teal',
		'000080' : 'Navy',
		'4B0082' : 'Indigo',
		'696969' : 'Morkegra',
		'B22222' : 'Scarlet / Rod',
		'A52A2A' : 'Brun',
		'DAA520' : 'Guld',
		'006400' : 'Morkegron',
		'40E0D0' : 'Tyrkis',
		'0000CD' : 'Mellembla',
		'800080' : 'Lilla',
		'808080' : 'Gra',
		'F00' : 'Rod',
		'FF8C00' : 'Mork orange',
		'FFD700' : 'Guld',
		'008000' : 'Gron',
		'0FF' : 'Cyan',
		'00F' : 'Bla',
		'EE82EE' : 'Violet',
		'A9A9A9' : 'Matgra',
		'FFA07A' : 'Laksefarve',
		'FFA500' : 'Orange',
		'FFFF00' : 'Gul',
		'00FF00' : 'Lime',
		'AFEEEE' : 'Mat tyrkis',
		'ADD8E6' : 'Lysebla',
		'DDA0DD' : 'Plum',
		'D3D3D3' : 'Lysegra',
		'FFF0F5' : 'Lavender Blush',
		'FAEBD7' : 'Antikhvid',
		'FFFFE0' : 'Lysegul',
		'F0FFF0' : 'Gul / Beige',
		'F0FFFF' : 'Himmebla',
		'F0F8FF' : 'Alice blue',
		'E6E6FA' : 'Lavendel',
		'FFF' : 'Hvid'
	},

	scayt :
	{
		title			: 'Stavekontrol mens du skriver',
		opera_title		: 'Ikke supporteret af Opera',
		enable			: 'Aktivér SCAYT',
		disable			: 'Deaktivér SCAYT',
		about			: 'Om SCAYT',
		toggle			: 'Skift/toggle SCAYT',
		options			: 'Indstillinger',
		langs			: 'Sprog',
		moreSuggestions	: 'Flere forslag',
		ignore			: 'Ignorér',
		ignoreAll		: 'Ignorér alle',
		addWord			: 'Tilfoj ord',
		emptyDic		: 'Ordbogsnavn ma ikke vaere tom.',

		optionsTab		: 'Indstillinger',
		allCaps			: 'Ignorer alle store bogstaver',
		ignoreDomainNames : 'Ignorér domaenenavne',
		mixedCase		: 'Ignorer ord med store og sma bogstaver',
		mixedWithDigits	: 'Ignorér ord med numre',

		languagesTab	: 'Sprog',

		dictionariesTab	: 'Ordboger',
		dic_field_name	: 'Navn pa ordbog',
		dic_create		: 'Opret',
		dic_restore		: 'Gendan',
		dic_delete		: 'Slet',
		dic_rename		: 'Omdob',
		dic_info		: 'Til start er brugerordbogen gemt i en Cookie. Dog har Cookies en begraensning pa storrelse. Nar ordbogen nar en bestemt storrelse kan den blive gemt pa vores server. For at gemme din personlige ordbog pa vores server skal du angive et navn for denne. Safremt du allerede har gemt en ordbog, skriv navnet pa denne og klik pa Gendan knappen.',

		aboutTab		: 'Om'
	},

	about :
	{
		title		: 'Om CKEditor',
		dlgTitle	: 'Om CKEditor',
		help	: 'Se $1 for at fa hjaelp.',
		userGuide : 'CKEditor-brugermanual',
		moreInfo	: 'For informationer omkring licens, se venligst vores hjemmeside (pa engelsk):',
		copy		: 'Copyright &copy; $1. Alle rettigheder forbeholdes.'
	},

	maximize : 'Maksimér',
	minimize : 'Minimér',

	fakeobjects :
	{
		anchor		: 'Anker',
		flash		: 'Flashanimation',
		iframe		: 'Iframe',
		hiddenfield	: 'Skjult felt',
		unknown		: 'Ukendt objekt'
	},

	resize : 'Traek for at skalere',

	colordialog :
	{
		title		: 'Vaelg farve',
		options	:	'Farvemuligheder',
		highlight	: 'Markér',
		selected	: 'Valgt farve',
		clear		: 'Nulstil'
	},

	toolbarCollapse	: 'Sammenklap vaerktojslinje',
	toolbarExpand	: 'Udvid vaerktojslinje',

	toolbarGroups :
	{
		document : 'Dokument',
		clipboard : 'Udklipsholder/Fortryd',
		editing : 'Redigering',
		forms : 'Formularer',
		basicstyles : 'Basis styles',
		paragraph : 'Paragraf',
		links : 'Links',
		insert : 'Indsaet',
		styles : 'Typografier',
		colors : 'Farver',
		tools : 'Vaerktojer'
	},

	bidi :
	{
		ltr : 'Tekstretning fra venstre til hojre',
		rtl : 'Tekstretning fra hojre til venstre'
	},

	docprops :
	{
		label : 'Egenskaber for dokument',
		title : 'Egenskaber for dokument',
		design : 'Design',
		meta : 'Metatags',
		chooseColor : 'Vaelg',
		other : '<anden>',
		docTitle :	'Sidetitel',
		charset : 	'Tegnsaetskode',
		charsetOther : 'Anden tegnsaetskode',
		charsetASCII : 'ASCII',
		charsetCE : 'Centraleuropaeisk',
		charsetCT : 'Traditionel kinesisk (Big5)',
		charsetCR : 'Kyrillisk',
		charsetGR : 'Graesk',
		charsetJP : 'Japansk',
		charsetKR : 'Koreansk',
		charsetTR : 'Tyrkisk',
		charsetUN : 'Unicode (UTF-8)',
		charsetWE : 'Vesteuropaeisk',
		docType : 'Dokumenttype kategori',
		docTypeOther : 'Anden dokumenttype kategori',
		xhtmlDec : 'Inkludere XHTML deklartion',
		bgColor : 'Baggrundsfarve',
		bgImage : 'Baggrundsbillede URL',
		bgFixed : 'Fastlast baggrund',
		txtColor : 'Tekstfarve',
		margin : 'Sidemargen',
		marginTop : 'Overst',
		marginLeft : 'Venstre',
		marginRight : 'Hojre',
		marginBottom : 'Nederst',
		metaKeywords : 'Dokument index nogleord (kommasepareret)',
		metaDescription : 'Dokumentbeskrivelse',
		metaAuthor : 'Forfatter',
		metaCopyright : 'Copyright',
		previewHtml : '<p>Dette er et <strong>eksempel pa noget tekst</strong>. Du benytter <a href="javascript:void(0)">CKEditor</a>.</p>'
	}
};
