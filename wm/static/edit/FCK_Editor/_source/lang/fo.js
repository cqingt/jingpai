/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Faroese language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Contains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['fo'] =
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
	editorHelp : 'Tr'yst ALT og 0 fyri vegleiding',

	// ARIA descriptions.
	toolbars	: 'Editor toolbars',
	editor		: 'Rich Text Editor',

	// Toolbar buttons without dialogs.
	source			: 'Kelda',
	newPage			: 'N'yggj sída',
	save			: 'Goym',
	preview			: 'Frums'yning',
	cut				: 'Kvett',
	copy			: 'Avrita',
	paste			: 'Innrita',
	print			: 'Prenta',
	underline		: 'Undirstrikad',
	bold			: 'Feit skrift',
	italic			: 'Skráskrift',
	selectAll		: 'Markera alt',
	removeFormat	: 'Strika snidgeving',
	strike			: 'Yvirstrikad',
	subscript		: 'Laekkad skrift',
	superscript		: 'Haekkad skrift',
	horizontalrule	: 'Ger vatnraetta linju',
	pagebreak		: 'Ger síduskift',
	pagebreakAlt		: 'Síduskift',
	unlink			: 'Strika tilkn'yti',
	undo			: 'Angra',
	redo			: 'Vend aftur',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Ambaetarakagi',
		url				: 'URL',
		protocol		: 'Protokoll',
		upload			: 'Send til ambaetaran',
		uploadSubmit	: 'Send til ambaetaran',
		image			: 'Myndir',
		flash			: 'Flash',
		form			: 'Formur',
		checkbox		: 'Flugubein',
		radio			: 'Radioknottur',
		textField		: 'Tekstteigur',
		textarea		: 'Tekstumrádi',
		hiddenField		: 'Fjaldur teigur',
		button			: 'Knottur',
		select			: 'Valskrá',
		imageButton		: 'Myndaknottur',
		notSet			: '<ikki sett>',
		id				: 'Id',
		name			: 'Navn',
		langDir			: 'Tekstkós',
		langDirLtr		: 'Frá vinstru til hogru (LTR)',
		langDirRtl		: 'Frá hogru til vinstru (RTL)',
		langCode		: 'Málkoda',
		longDescr		: 'Vídkad URL frágreiding',
		cssClass		: 'Typografi klassar',
		advisoryTitle	: 'Vegleidandi heiti',
		cssStyle		: 'Typografi',
		ok				: 'Gódkent',
		cancel			: 'Avl'yst',
		close			: 'Lat aftur',
		preview			: 'Frums'yn',
		generalTab		: 'Generelt',
		advancedTab		: 'Fjolbroytt',
		validateNumberFailed : 'Hetta er ikki eitt tal.',
		confirmNewPage	: 'Allar ikki goymdar broytingar í hesum innihaldid hvorva. Skal n'yggj sída lesast kortini?',
		confirmCancel	: 'Nakrir valmoguleikar eru broyttir. Ert tú vísur í, at dialogurin skal latast aftur?',
		options			: 'Options',
		target			: 'Target',
		targetNew		: 'N'ytt vindeyga (_blank)',
		targetTop		: 'Vindeyga ovast (_top)',
		targetSelf		: 'Sama vindeyga (_self)',
		targetParent	: 'Upphavligt vindeyga (_parent)',
		langDirLTR		: 'Frá vinstru til hogru (LTR)',
		langDirRTL		: 'Frá hogru til vinstru (RTL)',
		styles			: 'Style',
		cssClasses		: 'Stylesheet Classes',
		width			: 'Breidd',
		height			: 'Haedd',
		align			: 'Justering',
		alignLeft		: 'Vinstra',
		alignRight		: 'Hogra',
		alignCenter		: 'Midsett',
		alignTop		: 'Ovast',
		alignMiddle		: 'Midja',
		alignBottom		: 'Botnur',
		invalidValue	: 'Invalid value.', // MISSING
		invalidHeight	: 'Haedd má vera eitt tal.',
		invalidWidth	: 'Breidd má vera eitt tal.',
		invalidCssLength	: 'Virdid sett í "%1" feltid má vera eitt positivt tal, vid ella uttan gyldugum CSS mátieind (px, %, in, cm, mm, em, ex, pt, ella pc).',
		invalidHtmlLength	: 'Virdid sett í "%1" feltidield má vera eitt positivt tal, vid ella uttan gyldugum CSS mátieind (px ella %).',
		invalidInlineStyle	: 'Virdi specifiserad fyri inline style má hava eitt ella fleiri por (tuples) skrivad sum "name : value", hvort parid sundurskilt vid semi-colon.',
		cssLengthTooltip	: 'Skriva eitt tal fyri eitt virdi í pixels ella eitt tal vid gyldigum CSS eind (px, %, in, cm, mm, em, ex, pt, ella pc).',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, ikki tokt</span>'
	},

	contextmenu :
	{
		options : 'Context Menu Options'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Set inn sertekn',
		title		: 'Vel sertekn',
		options : 'Moguleikar vid serteknum'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Ger/broyt tilkn'yti',
		other 		: '<annad>',
		menu		: 'Broyt tilkn'yti',
		title		: 'Tilkn'yti',
		info		: 'Tilkn'ytis uppl'ysingar',
		target		: 'Target',
		upload		: 'Send til ambaetaran',
		advanced	: 'Fjolbroytt',
		type		: 'Tilkn'ytisslag',
		toUrl		: 'URL',
		toAnchor	: 'Tilkn'yti til marknastein í tekstinum',
		toEmail		: 'Teldupostur',
		targetFrame		: '<ramma>',
		targetPopup		: '<popup vindeyga>',
		targetFrameName	: 'Vís navn vindeygans',
		targetPopupName	: 'Popup vindeygans navn',
		popupFeatures	: 'Popup vindeygans vídkadu eginleikar',
		popupResizable	: 'Stodd kann broytast',
		popupStatusBar	: 'Stodufrágreidingarbjálki',
		popupLocationBar: 'Adressulinja',
		popupToolbar	: 'Ambodsbjálki',
		popupMenuBar	: 'Skrábjálki',
		popupFullScreen	: 'Fullur skermur (IE)',
		popupScrollBars	: 'Rullibjálki',
		popupDependent	: 'Bundid (Netscape)',
		popupLeft		: 'Frástoda frá vinstru',
		popupTop		: 'Frástoda frá íerva',
		id				: 'Id',
		langDir			: 'Tekstkós',
		langDirLTR		: 'Frá vinstru til hogru (LTR)',
		langDirRTL		: 'Frá hogru til vinstru (RTL)',
		acccessKey		: 'Snarvegiskn"ottur',
		name			: 'Navn',
		langCode			: 'Tekstkós',
		tabIndex			: 'Tabulator indeks',
		advisoryTitle		: 'Vegleidandi heiti',
		advisoryContentType	: 'Vegleidandi innihaldsslag',
		cssClasses		: 'Typografi klassar',
		charset			: 'Atkn'ytt teknsett',
		styles			: 'Typografi',
		rel			: 'Relatión',
		selectAnchor		: 'Vel ein marknastein',
		anchorName		: 'Eftir navni á marknasteini',
		anchorId			: 'Eftir element Id',
		emailAddress		: 'Teldupost-adressa',
		emailSubject		: 'Evni',
		emailBody		: 'Breydtekstur',
		noAnchors		: '(Eingir marknasteinar eru í hesum dokumentid)',
		noUrl			: 'Vinarliga skriva tilkn'yti (URL)',
		noEmail			: 'Vinarliga skriva teldupost-adressu'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Ger/broyt marknastein',
		menu		: 'Eginleikar fyri marknastein',
		title		: 'Eginleikar fyri marknastein',
		name		: 'Heiti marknasteinsins',
		errorName	: 'Vinarliga rita marknasteinsins heiti',
		remove		: 'Strika marknastein'
	},

	// List style dialog
	list:
	{
		numberedTitle		: 'Eginleikar fyri lista vid tolum',
		bulletedTitle		: 'Eginleikar fyri lista vid prikkum',
		type				: 'Slag',
		start				: 'Byrjan',
		validateStartNumber				:'Byrjunartalid fyri lista má vera eitt heiltal.',
		circle				: 'Sirkul',
		disc				: 'Disc',
		square				: 'F'yrkantur',
		none				: 'Einki',
		notset				: '<ikki sett>',
		armenian			: 'Armensk talskipan',
		georgian			: 'Georgisk talskipan (an, ban, gan, osv.)',
		lowerRoman			: 'Lítil rómaratol (i, ii, iii, iv, v, etc.)',
		upperRoman			: 'Stór rómaratol (I, II, III, IV, V, etc.)',
		lowerAlpha			: 'Lítlir bókstavir (a, b, c, d, e, etc.)',
		upperAlpha			: 'Stórir bókstavir (A, B, C, D, E, etc.)',
		lowerGreek			: 'Grikskt vid lítlum (alpha, beta, gamma, etc.)',
		decimal				: 'Vanlig tol (1, 2, 3, etc.)',
		decimalLeadingZero	: 'Tol vid null frammanfyri (01, 02, 03, etc.)'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Finn og broyt',
		find				: 'Leita',
		replace				: 'Yvirskriva',
		findWhat			: 'Finn:',
		replaceWith			: 'Yvirskriva vid:',
		notFoundMsg			: 'Leititeksturin vard ikki funnin',
		findOptions			: 'Finn moguleikar',
		matchCase			: 'Munur á stórum og smáum bókstavum',
		matchWord			: 'Bert heil ord',
		matchCyclic			: 'Match cyclic',
		replaceAll			: 'Yvirskriva alt',
		replaceSuccessMsg	: '%1 úrslit broytt.'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Tabell',
		title		: 'Eginleikar fyri tabell',
		menu		: 'Eginleikar fyri tabell',
		deleteTable	: 'Strika tabell',
		rows		: 'Rodir',
		columns		: 'Kolonnur',
		border		: 'Bordabreidd',
		widthPx		: 'pixels',
		widthPc		: 'prosent',
		widthUnit	: 'breiddar unit',
		cellSpace	: 'Fjarstoda millum meskar',
		cellPad		: 'Meskubreddi',
		caption		: 'Tabellfrágreiding',
		summary		: 'Samandráttur',
		headers		: 'Yvirskriftir',
		headersNone		: 'Eingin',
		headersColumn	: 'Fyrsta kolonna',
		headersRow		: 'Fyrsta rad',
		headersBoth		: 'Bádir',
		invalidRows		: 'Talid av rodum má vera eitt tal storri enn 0.',
		invalidCols		: 'Talid av kolonnum má vera eitt tal storri enn 0.',
		invalidBorder	: 'Borda-stodd má vera eitt tal.',
		invalidWidth	: 'Tabell-breidd má vera eitt tal.',
		invalidHeight	: 'Tabell-haedd má vera eitt tal.',
		invalidCellSpacing	: 'Cell spacing má vera eitt tal.',
		invalidCellPadding	: 'Cell padding má vera eitt tal.',

		cell :
		{
			menu			: 'Meski',
			insertBefore	: 'Set meska inn ádrenn',
			insertAfter		: 'Set meska inn aftaná',
			deleteCell		: 'Strika meskar',
			merge			: 'Flaetta meskar',
			mergeRight		: 'Flaetta meskar til hogru',
			mergeDown		: 'Flaetta saman',
			splitHorizontal	: 'Kloyv meska vatnraett',
			splitVertical	: 'Kloyv meska loddraett',
			title			: 'Mesku eginleikar',
			cellType		: 'Mesku slag',
			rowSpan			: 'Raed spenni',
			colSpan			: 'Kolonnu spenni',
			wordWrap		: 'Ordkloyving',
			hAlign			: 'Horisontal plasering',
			vAlign			: 'Loddrott plasering',
			alignBaseline	: 'Basislinja',
			bgColor			: 'Bakgrundslitur',
			borderColor		: 'Bordalitur',
			data			: 'Data',
			header			: 'Header',
			yes				: 'Ja',
			no				: 'Nei',
			invalidWidth	: 'Meskubreidd má vera eitt tal.',
			invalidHeight	: 'Meskuhaedd má vera eitt tal.',
			invalidRowSpan	: 'Radspennid má vera eitt heiltal.',
			invalidColSpan	: 'Kolonnuspennid má vera eitt heiltal.',
			chooseColor		: 'Vel'
		},

		row :
		{
			menu			: 'Rad',
			insertBefore	: 'Set rad inn ádrenn',
			insertAfter		: 'Set rad inn aftaná',
			deleteRow		: 'Strika rodir'
		},

		column :
		{
			menu			: 'Kolonna',
			insertBefore	: 'Set kolonnu inn ádrenn',
			insertAfter		: 'Set kolonnu inn aftaná',
			deleteColumn	: 'Strika kolonnur'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Eginleikar fyri knott',
		text		: 'Tekstur',
		type		: 'Slag',
		typeBtn		: 'Knottur',
		typeSbm		: 'Send',
		typeRst		: 'Nullstilla'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Eginleikar fyri flugubein',
		radioTitle	: 'Eginleikar fyri radioknott',
		value		: 'Virdi',
		selected	: 'Valt'
	},

	// Form Dialog.
	form :
	{
		title		: 'Eginleikar fyri Form',
		menu		: 'Eginleikar fyri Form',
		action		: 'Hending',
		method		: 'Háttur',
		encoding	: 'Encoding'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Eginleikar fyri valskrá',
		selectInfo	: 'Uppl'ysingar',
		opAvail		: 'Tokir moguleikar',
		value		: 'Virdi',
		size		: 'Stodd',
		lines		: 'Linjur',
		chkMulti	: 'Loyv fleiri valmoguleikum samstundis',
		opText		: 'Tekstur',
		opValue		: 'Virdi',
		btnAdd		: 'Legg afturat',
		btnModify	: 'Broyt',
		btnUp		: 'Upp',
		btnDown		: 'Nidur',
		btnSetValue : 'Set sum valt virdi',
		btnDelete	: 'Strika'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Eginleikar fyri tekstumrádi',
		cols		: 'kolonnur',
		rows		: 'rodir'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Eginleikar fyri tekstteig',
		name		: 'Navn',
		value		: 'Virdi',
		charWidth	: 'Breidd (sjónlig tekn)',
		maxChars	: 'Mest loyvdu tekn',
		type		: 'Slag',
		typeText	: 'Tekstur',
		typePass	: 'Loyniord'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Eginleikar fyri fjaldan teig',
		name	: 'Navn',
		value	: 'Virdi'
	},

	// Image Dialog.
	image :
	{
		title		: 'Myndaeginleikar',
		titleButton	: 'Eginleikar fyri myndaknott',
		menu		: 'Myndaeginleikar',
		infoTab		: 'Myndauppl'ysingar',
		btnUpload	: 'Send til ambaetaran',
		upload		: 'Send',
		alt			: 'Alternativur tekstur',
		lockRatio	: 'Laes lutfallid',
		resetSize	: 'Upprunastodd',
		border		: 'Bordi',
		hSpace		: 'Hogri breddi',
		vSpace		: 'Vinstri breddi',
		alertUrl	: 'Rita slódina til myndina',
		linkTab		: 'Tilkn'yti',
		button2Img	: 'Skal valdi myndaknottur gerast til vanliga mynd?',
		img2Button	: 'Skal valda mynd gerast til myndaknott?',
		urlMissing	: 'URL til mynd manglar.',
		validateBorder	: 'Bordi má vera eitt heiltal.',
		validateHSpace	: 'HSpace má vera eitt heiltal.',
		validateVSpace	: 'VSpace má vera eitt heiltal.'
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Flash eginleikar',
		propertiesTab	: 'Eginleikar',
		title			: 'Flash eginleikar',
		chkPlay			: 'Avspaelingin byrjar sjálv',
		chkLoop			: 'Endurspael',
		chkMenu			: 'Ger Flash skrá virkna',
		chkFull			: 'Loyv fullan skerm',
 		scale			: 'Skalering',
		scaleAll		: 'Vís alt',
		scaleNoBorder	: 'Eingin bordi',
		scaleFit		: 'Neyv skalering',
		access			: 'Script atgongd',
		accessAlways	: 'Altíd',
		accessSameDomain: 'Sama navnaoki',
		accessNever		: 'Ongantíd',
		alignAbsBottom	: 'Abs botnur',
		alignAbsMiddle	: 'Abs midja',
		alignBaseline	: 'Basislinja',
		alignTextTop	: 'Tekst toppur',
		quality			: 'Gódska',
		qualityBest		: 'Besta',
		qualityHigh		: 'Hog',
		qualityAutoHigh	: 'Auto hog',
		qualityMedium	: 'Medal',
		qualityAutoLow	: 'Auto Lág',
		qualityLow		: 'Lág',
		windowModeWindow: 'Rútur',
		windowModeOpaque: 'Ikki transparent',
		windowModeTransparent : 'Transparent',
		windowMode		: 'Slag av rúti',
		flashvars		: 'Variablar fyri Flash',
		bgcolor			: 'Bakgrundslitur',
		hSpace			: 'Hogri breddi',
		vSpace			: 'Vinstri breddi',
		validateSrc		: 'Vinarliga skriva tilkn'yti (URL)',
		validateHSpace	: 'HSpace má vera eitt tal.',
		validateVSpace	: 'VSpace má vera eitt tal.'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Kanna stavseting',
		title			: 'Kanna stavseting',
		notAvailable	: 'Tíverri, ikki tokt í lotuni.',
		errorLoading	: 'Feilur vid innlesing av application service host: %s.',
		notInDic		: 'Finst ikki í ordabókini',
		changeTo		: 'Broyt til',
		btnIgnore		: 'Forfjóna',
		btnIgnoreAll	: 'Forfjóna alt',
		btnReplace		: 'Yvirskriva',
		btnReplaceAll	: 'Yvirskriva alt',
		btnUndo			: 'Angra',
		noSuggestions	: '- Einki uppskot -',
		progress		: 'Raettstavarin arbeidir...',
		noMispell		: 'Raettstavarin lidugur: Eingin feilur funnin',
		noChanges		: 'Raettstavarin lidugur: Einki ord vard broytt',
		oneChange		: 'Raettstavarin lidugur: Eitt ord er broytt',
		manyChanges		: 'Raettstavarin lidugur: %1 ord broytt',
		ieSpellDownload	: 'Raettstavarin er ikki tokur í tekstvidgeranum. Vilt tú heinta hann nú?'
	},

	smiley :
	{
		toolbar	: 'Smiley',
		title	: 'Vel Smiley',
		options : 'Moguleikar fyri Smiley'
	},

	elementsPath :
	{
		eleLabel : 'Slód til elementir',
		eleTitle : '%1 element'
	},

	numberedlist	: 'Talmerktur listi',
	bulletedlist	: 'Punktmerktur listi',
	indent			: 'Okja reglubrotarinntriv',
	outdent			: 'Minka reglubrotarinntriv',

	justify :
	{
		left	: 'Vinstrasett',
		center	: 'Midsett',
		right	: 'Hograsett',
		block	: 'Javnir tekstkantar'
	},

	blockquote : 'Blockquote',

	clipboard :
	{
		title		: 'Innrita',
		cutError	: 'Trygdaruppseting alnótskagans fordar tekstvidgeranum í at kvetta tekstin. Vinarliga n'yt knappabordid til at kvetta tekstin (Ctrl/Cmd+X).',
		copyError	: 'Trygdaruppseting alnótskagans fordar tekstvidgeranum í at avrita tekstin. Vinarliga n'yt knappabordid til at avrita tekstin (Ctrl/Cmd+C).',
		pasteMsg	: 'Vinarliga koyr tekstin í hendan rútin vid knappabordinum (<strong>Ctrl/Cmd+V</strong>) og klikk á <strong>Gódtak</strong>.',
		securityMsg	: 'Trygdaruppseting alnótskagans fordar tekstvidgeranum í beinleidis atgongd til avritingarminnid. Tygum mugu royna aftur í hesum rútinum.',
		pasteArea	: 'Avritingarumrádi'
	},

	pastefromword :
	{
		confirmCleanup	: 'Teksturin, tú roynir at seta inn, s'ynist at stava frá Word. Skal teksturin reinsast fyrst?',
		toolbar			: 'Innrita frá Word',
		title			: 'Innrita frá Word',
		error			: 'Tad eydnadist ikki at reinsa tekstin vegna ein internan feil'
	},

	pasteText :
	{
		button	: 'Innrita som reinan tekst',
		title	: 'Innrita som reinan tekst'
	},

	templates :
	{
		button			: 'Skabelónir',
		title			: 'Innihaldsskabelónir',
		options : 'Moguleikar fyri Template',
		insertOption	: 'Yvirskriva núverandi innihald',
		selectPromptMsg	: 'Vinarliga vel ta skabelón, id skal opnast í tekstvidgeranum<br>(Hetta yvirskrivar núverandi innihald):',
		emptyListMsg	: '(Ongar skabelónir tokar)'
	},

	showBlocks : 'Vís blokkar',

	stylesCombo :
	{
		label		: 'Typografi',
		panelTitle	: 'Formatterings stílir',
		panelTitle1	: 'Blokk stílir',
		panelTitle2	: 'Inline stílir',
		panelTitle3	: 'Object stílir'
	},

	format :
	{
		label		: 'Skriftsnid',
		panelTitle	: 'Skriftsnid',

		tag_p		: 'Vanligt',
		tag_pre		: 'Snidgivid',
		tag_address	: 'Adressa',
		tag_h1		: 'Yvirskrift 1',
		tag_h2		: 'Yvirskrift 2',
		tag_h3		: 'Yvirskrift 3',
		tag_h4		: 'Yvirskrift 4',
		tag_h5		: 'Yvirskrift 5',
		tag_h6		: 'Yvirskrift 6',
		tag_div		: 'Vanligt (DIV)'
	},

	div :
	{
		title				: 'Ger Div Container',
		toolbar				: 'Ger Div Container',
		cssClassInputLabel	: 'Stylesheet Classes',
		styleSelectLabel	: 'Style',
		IdInputLabel		: 'Id',
		languageCodeInputLabel	: ' Language Code',
		inlineStyleInputLabel	: 'Inline Style',
		advisoryTitleInputLabel	: 'Advisory Title',
		langDirLabel		: 'Language Direction',
		langDirLTRLabel		: 'Vinstru til hogru (LTR)',
		langDirRTLLabel		: 'Hogru til vinstru (RTL)',
		edit				: 'Redigera Div',
		remove				: 'Strika Div'
  	},

	iframe :
	{
		title		: 'Moguleikar fyri IFrame',
		toolbar		: 'IFrame',
		noUrl		: 'Vinarliga skriva URL til iframe',
		scrolling	: 'Loyv scrollbars',
		border		: 'Vís frame kant'
	},

	font :
	{
		label		: 'Skrift',
		voiceLabel	: 'Skrift',
		panelTitle	: 'Skrift'
	},

	fontSize :
	{
		label		: 'Skriftstodd',
		voiceLabel	: 'Skriftstodd',
		panelTitle	: 'Skriftstodd'
	},

	colorButton :
	{
		textColorTitle	: 'Tekstlitur',
		bgColorTitle	: 'Bakgrundslitur',
		panelTitle		: 'Litir',
		auto			: 'Automatiskt',
		more			: 'Fleiri litir...'
	},

	colors :
	{
		'000' : 'Svart',
		'800000' : 'Maroon',
		'8B4513' : 'Sadilsbrúnt',
		'2F4F4F' : 'Dark Slate Gray',
		'008080' : 'Teal',
		'000080' : 'Navy',
		'4B0082' : 'Indigo',
		'696969' : 'Myrkagrátt',
		'B22222' : 'Fire Brick',
		'A52A2A' : 'Brúnt',
		'DAA520' : 'Gullstavur',
		'006400' : 'Myrkagront',
		'40E0D0' : 'Turquoise',
		'0000CD' : 'Medal blátt',
		'800080' : 'Purple',
		'808080' : 'Grátt',
		'F00' : 'Reytt',
		'FF8C00' : 'Myrkt appelsingult',
		'FFD700' : 'Gull',
		'008000' : 'Gront',
		'0FF' : 'Cyan',
		'00F' : 'Blátt',
		'EE82EE' : 'Violet',
		'A9A9A9' : 'Dokt grátt',
		'FFA07A' : 'Ljósur laksur',
		'FFA500' : 'Appelsingult',
		'FFFF00' : 'Gult',
		'00FF00' : 'Lime',
		'AFEEEE' : 'Pale Turquoise',
		'ADD8E6' : 'Ljósablátt',
		'DDA0DD' : 'Plum',
		'D3D3D3' : 'Ljósagrátt',
		'FFF0F5' : 'Lavender Blush',
		'FAEBD7' : 'Klassiskt hvítt',
		'FFFFE0' : 'Ljósagult',
		'F0FFF0' : 'Hunangsdoggur',
		'F0FFFF' : 'Azure',
		'F0F8FF' : 'Alice Blátt',
		'E6E6FA' : 'Lavender',
		'FFF' : 'Hvítt'
	},

	scayt :
	{
		title			: 'Kanna stavseting, medan tú skrivar',
		opera_title		: 'Ikki studlad í Opera',
		enable			: 'Loyv SCAYT',
		disable			: 'Nokta SCAYT',
		about			: 'Um SCAYT',
		toggle			: 'Toggle SCAYT',
		options			: 'Uppseting',
		langs			: 'Tungumál',
		moreSuggestions	: 'Fleiri tilrádingar',
		ignore			: 'Ignorera',
		ignoreAll		: 'Ignorera alt',
		addWord			: 'Legg ord afturat',
		emptyDic		: 'Heiti á ordabók eigur ikki at vera tómt.',

		optionsTab		: 'Uppseting',
		allCaps			: 'Loyp ord vid bert stórum stavum um',
		ignoreDomainNames : 'loyp okisnovn um',
		mixedCase		: 'Loyp ord vid blandadum smáum og stórum stavum um',
		mixedWithDigits	: 'Loyp ord vid tolum um',

		languagesTab	: 'Tungumál',

		dictionariesTab	: 'Ordabokur',
		dic_field_name	: 'Ordabókanavn',
		dic_create		: 'Uppraetta n'yggja',
		dic_restore		: 'Endurskapa',
		dic_delete		: 'Strika',
		dic_rename		: 'Broyt',
		dic_info		: 'Upprunaliga er brúkara-ordabókin goymd í eini cookie í tínum egna kaga. Men hesar cookies eru avmarkadar í stodd. Tá brúkara-ordabókin veksur seg ov stóra til eina cookie, so er moguligt at goyma hana á ambaetara okkara. Fyri at goyma persónligu ordabókina á ambaetaranum eigur tú at velja eitt navn til tína skuffu. Hevur tú longu goymt eina ordabók, so vinarliga skriva navnid og klikk á knottin Endurskapa.',

		aboutTab		: 'Um'
	},

	about :
	{
		title		: 'Um CKEditor',
		dlgTitle	: 'Um CKEditor',
		help	: 'Kekka $1 fyri hjálp.',
		userGuide : 'CKEditor Brúkaravegleiding',
		moreInfo	: 'Licens uppl'ysingar finnast á heimasídu okkara:',
		copy		: 'Copyright &copy; $1. All rights reserved.'
	},

	maximize : 'Maksimera',
	minimize : 'Minimera',

	fakeobjects :
	{
		anchor		: 'Anchor',
		flash		: 'Flash Animation',
		iframe		: 'IFrame',
		hiddenfield	: 'Fjaldur teigur',
		unknown		: ''Okent Object'
	},

	resize : 'Drag fyri at broyta stodd',

	colordialog :
	{
		title		: 'Vel lit',
		options	:	'Litmoguleikar',
		highlight	: 'Framheva',
		selected	: 'Valdur litur',
		clear		: 'Strika'
	},

	toolbarCollapse	: 'Lat Toolbar aftur',
	toolbarExpand	: 'Vís Toolbar',

	toolbarGroups :
	{
		document : 'Dokument',
		clipboard : 'Clipboard/Undo',
		editing : 'Editering',
		forms : 'Formar',
		basicstyles : 'Grundleggjandi Styles',
		paragraph : 'Reglubrot',
		links : 'Leinkjur',
		insert : 'Set inn',
		styles : 'Styles',
		colors : 'Litir',
		tools : 'Tól'
	},

	bidi :
	{
		ltr : 'Tekstkós frá vinstru til hogru',
		rtl : 'Tekstkós frá hogru til vinstru'
	},

	docprops :
	{
		label : 'Eginleikar fyri dokument',
		title : 'Eginleikar fyri dokument',
		design : 'Design',
		meta : 'META-uppl'ysingar',
		chooseColor : 'Vel',
		other : '<annad>',
		docTitle :	'Síduheiti',
		charset : 	'Teknsett koda',
		charsetOther : 'Onnur teknsett koda',
		charsetASCII : 'ASCII',
		charsetCE : 'Mideuropa',
		charsetCT : 'Kinesiskt traditionelt (Big5)',
		charsetCR : 'Cyrilliskt',
		charsetGR : 'Grikst',
		charsetJP : 'Japanskt',
		charsetKR : 'Koreanskt',
		charsetTR : 'Turkiskt',
		charsetUN : 'Unicode (UTF-8)',
		charsetWE : 'Vestureuropa',
		docType : 'Dokumentslag yvirskrift',
		docTypeOther : 'Annad dokumentslag yvirskrift',
		xhtmlDec : 'Vidfest XHTML deklaratiónir',
		bgColor : 'Bakgrundslitur',
		bgImage : 'Leid til bakgrundsmynd (URL)',
		bgFixed : 'Laest bakgrund (rullar ikki)',
		txtColor : 'Tekstlitur',
		margin : 'Sídubreddar',
		marginTop : 'Ovast',
		marginLeft : 'Vinstra',
		marginRight : 'Hogra',
		marginBottom : 'Nidast',
		metaKeywords : 'Dokument index lyklaord (sundurb'ytt vid komma)',
		metaDescription : 'Dokumentl'ysing',
		metaAuthor : 'Hovundur',
		metaCopyright : 'Upphavsraettindi',
		previewHtml : '<p>Hetta er ein <strong>royndartekstur</strong>. Tygum brúka <a href="javascript:void(0)">CKEditor</a>.</p>'
	}
};
