/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Icelandic language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Contains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['is'] =
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
	editorHelp : 'Press ALT 0 for help', // MISSING

	// ARIA descriptions.
	toolbars	: 'Editor toolbars', // MISSING
	editor		: 'Rich Text Editor', // MISSING

	// Toolbar buttons without dialogs.
	source			: 'Kódi',
	newPage			: 'N'y sída',
	save			: 'Vista',
	preview			: 'Forskoda',
	cut				: 'Klippa',
	copy			: 'Afrita',
	paste			: 'Líma',
	print			: 'Prenta',
	underline		: 'Undirstrikad',
	bold			: 'Feitletrad',
	italic			: 'Skáletrad',
	selectAll		: 'Velja allt',
	removeFormat	: 'Fjarlaegja snid',
	strike			: 'Yfirstrikad',
	subscript		: 'Nidurskrifad',
	superscript		: 'Uppskrifad',
	horizontalrule	: 'Lódrétt lína',
	pagebreak		: 'Setja inn síduskil',
	pagebreakAlt		: 'Page Break', // MISSING
	unlink			: 'Fjarlaegja stiklu',
	undo			: 'Afturkalla',
	redo			: 'Haetta vid afturk"ollun',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Fletta í skjalasafni',
		url				: 'Vefslód',
		protocol		: 'Samskiptastadall',
		upload			: 'Senda upp',
		uploadSubmit	: 'Hlada upp',
		image			: 'Setja inn mynd',
		flash			: 'Flash',
		form			: 'Setja inn innsláttarform',
		checkbox		: 'Setja inn h"okunarreit',
		radio			: 'Setja inn valhnapp',
		textField		: 'Setja inn textareit',
		textarea		: 'Setja inn textasvaedi',
		hiddenField		: 'Setja inn falid svaedi',
		button			: 'Setja inn hnapp',
		select			: 'Setja inn lista',
		imageButton		: 'Setja inn myndahnapp',
		notSet			: '<ekkert valid>',
		id				: 'Audkenni',
		name			: 'Nafn',
		langDir			: 'Lesstefna',
		langDirLtr		: 'Frá vinstri til haegri (LTR)',
		langDirRtl		: 'Frá haegri til vinstri (RTL)',
		langCode		: 'Tungumálakódi',
		longDescr		: 'Nánari l'ysing',
		cssClass		: 'Stílsnidsflokkur',
		advisoryTitle	: 'Titill',
		cssStyle		: 'Stíll',
		ok				: ''I lagi',
		cancel			: 'Haetta vid',
		close			: 'Close', // MISSING
		preview			: 'Preview', // MISSING
		generalTab		: 'Almennt',
		advancedTab		: 'Taeknilegt',
		validateNumberFailed : 'This value is not a number.', // MISSING
		confirmNewPage	: 'Any unsaved changes to this content will be lost. Are you sure you want to load new page?', // MISSING
		confirmCancel	: 'Some of the options have been changed. Are you sure to close the dialog?', // MISSING
		options			: 'Options', // MISSING
		target			: 'Target', // MISSING
		targetNew		: 'New Window (_blank)', // MISSING
		targetTop		: 'Topmost Window (_top)', // MISSING
		targetSelf		: 'Same Window (_self)', // MISSING
		targetParent	: 'Parent Window (_parent)', // MISSING
		langDirLTR		: 'Left to Right (LTR)', // MISSING
		langDirRTL		: 'Right to Left (RTL)', // MISSING
		styles			: 'Style', // MISSING
		cssClasses		: 'Stylesheet Classes', // MISSING
		width			: 'Breidd',
		height			: 'Haed',
		align			: 'J"ofnun',
		alignLeft		: 'Vinstri',
		alignRight		: 'Haegri',
		alignCenter		: 'Midjad',
		alignTop		: 'Efst',
		alignMiddle		: 'Midjud',
		alignBottom		: 'Nedst',
		invalidValue	: 'Invalid value.', // MISSING
		invalidHeight	: 'Height must be a number.', // MISSING
		invalidWidth	: 'Width must be a number.', // MISSING
		invalidCssLength	: 'Value specified for the "%1" field must be a positive number with or without a valid CSS measurement unit (px, %, in, cm, mm, em, ex, pt, or pc).', // MISSING
		invalidHtmlLength	: 'Value specified for the "%1" field must be a positive number with or without a valid HTML measurement unit (px or %).', // MISSING
		invalidInlineStyle	: 'Value specified for the inline style must consist of one or more tuples with the format of "name : value", separated by semi-colons.', // MISSING
		cssLengthTooltip	: 'Enter a number for a value in pixels or a number with a valid CSS unit (px, %, in, cm, mm, em, ex, pt, or pc).', // MISSING

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, unavailable</span>' // MISSING
	},

	contextmenu :
	{
		options : 'Context Menu Options' // MISSING
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Setja inn merki',
		title		: 'Velja tákn',
		options : 'Special Character Options' // MISSING
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Stofna/breyta stiklu',
		other 		: '<annar>',
		menu		: 'Breyta stiklu',
		title		: 'Stikla',
		info		: 'Almennt',
		target		: 'Mark',
		upload		: 'Senda upp',
		advanced	: 'Taeknilegt',
		type		: 'Stikluflokkur',
		toUrl		: 'URL', // MISSING
		toAnchor	: 'Bókamerki á thessari sídu',
		toEmail		: 'Netfang',
		targetFrame		: '<rammi>',
		targetPopup		: '<sprettigluggi>',
		targetFrameName	: 'Nafn markglugga',
		targetPopupName	: 'Nafn sprettiglugga',
		popupFeatures	: 'Eigindi sprettiglugga',
		popupResizable	: 'Resizable', // MISSING
		popupStatusBar	: 'St"odustika',
		popupLocationBar: 'Fanglína',
		popupToolbar	: 'Verkfaerastika',
		popupMenuBar	: 'Vallína',
		popupFullScreen	: 'Heilskjár (IE)',
		popupScrollBars	: 'Skrunstikur',
		popupDependent	: 'Hád venslum (Netscape)',
		popupLeft		: 'Fjarlaegd frá vinstri',
		popupTop		: 'Fjarlaegd frá efri brún',
		id				: 'Id', // MISSING
		langDir			: 'Lesstefna',
		langDirLTR		: 'Frá vinstri til haegri (LTR)',
		langDirRTL		: 'Frá haegri til vinstri (RTL)',
		acccessKey		: 'Skammvalshnappur',
		name			: 'Nafn',
		langCode			: 'Lesstefna',
		tabIndex			: 'Radnúmer innsláttarreits',
		advisoryTitle		: 'Titill',
		advisoryContentType	: 'Tegund innihalds',
		cssClasses		: 'Stílsnidsflokkur',
		charset			: 'Táknróf',
		styles			: 'Stíll',
		rel			: 'Relationship', // MISSING
		selectAnchor		: 'Veldu akkeri',
		anchorName		: 'Eftir akkerisnafni',
		anchorId			: 'Eftir audkenni einingar',
		emailAddress		: 'Netfang',
		emailSubject		: 'Efni',
		emailBody		: 'Meginmál',
		noAnchors		: '<Engin bókamerki á skrá>',
		noUrl			: 'Sládu inn veffang stiklunnar!',
		noEmail			: 'Sládu inn netfang!'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Stofna/breyta kaflamerki',
		menu		: 'Eigindi kaflamerkis',
		title		: 'Eigindi kaflamerkis',
		name		: 'Nafn bókamerkis',
		errorName	: 'Sládu inn nafn bókamerkis!',
		remove		: 'Remove Anchor' // MISSING
	},

	// List style dialog
	list:
	{
		numberedTitle		: 'Numbered List Properties', // MISSING
		bulletedTitle		: 'Bulleted List Properties', // MISSING
		type				: 'Type', // MISSING
		start				: 'Start', // MISSING
		validateStartNumber				:'List start number must be a whole number.', // MISSING
		circle				: 'Circle', // MISSING
		disc				: 'Disc', // MISSING
		square				: 'Square', // MISSING
		none				: 'None', // MISSING
		notset				: '<not set>', // MISSING
		armenian			: 'Armenian numbering', // MISSING
		georgian			: 'Georgian numbering (an, ban, gan, etc.)', // MISSING
		lowerRoman			: 'Lower Roman (i, ii, iii, iv, v, etc.)', // MISSING
		upperRoman			: 'Upper Roman (I, II, III, IV, V, etc.)', // MISSING
		lowerAlpha			: 'Lower Alpha (a, b, c, d, e, etc.)', // MISSING
		upperAlpha			: 'Upper Alpha (A, B, C, D, E, etc.)', // MISSING
		lowerGreek			: 'Lower Greek (alpha, beta, gamma, etc.)', // MISSING
		decimal				: 'Decimal (1, 2, 3, etc.)', // MISSING
		decimalLeadingZero	: 'Decimal leading zero (01, 02, 03, etc.)' // MISSING
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Finna og skipta',
		find				: 'Leita',
		replace				: 'Skipta út',
		findWhat			: 'Leita ad:',
		replaceWith			: 'Skipta út fyrir:',
		notFoundMsg			: 'Leitartexti fannst ekki!',
		findOptions			: 'Find Options', // MISSING
		matchCase			: 'Gera greinarmun á! há!- og lágst"ofum',
		matchWord			: 'Adeins heil ord',
		matchCyclic			: 'Match cyclic', // MISSING
		replaceAll			: 'Skipta út allsstadar',
		replaceSuccessMsg	: '%1 occurrence(s) replaced.' // MISSING
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Tafla',
		title		: 'Eigindi t"oflu',
		menu		: 'Eigindi t"oflu',
		deleteTable	: 'Fella t"oflu',
		rows		: 'Radir',
		columns		: 'Dálkar',
		border		: 'Breidd ramma',
		widthPx		: 'myndeindir',
		widthPc		: 'prósent',
		widthUnit	: 'width unit', // MISSING
		cellSpace	: 'Bil milli reita',
		cellPad		: 'Reitaspássía',
		caption		: 'Titill',
		summary		: ''Afram',
		headers		: 'Fyrirsagnir',
		headersNone		: 'Engar',
		headersColumn	: 'Fyrsti dálkur',
		headersRow		: 'Fyrsta r"od',
		headersBoth		: 'Hvort tveggja',
		invalidRows		: 'Number of rows must be a number greater than 0.', // MISSING
		invalidCols		: 'Number of columns must be a number greater than 0.', // MISSING
		invalidBorder	: 'Border size must be a number.', // MISSING
		invalidWidth	: 'Table width must be a number.', // MISSING
		invalidHeight	: 'Table height must be a number.', // MISSING
		invalidCellSpacing	: 'Cell spacing must be a positive number.', // MISSING
		invalidCellPadding	: 'Cell padding must be a positive number.', // MISSING

		cell :
		{
			menu			: 'Reitur',
			insertBefore	: 'Skjóta inn reiti fyrir aftan',
			insertAfter		: 'Skjóta inn reiti fyrir framan',
			deleteCell		: 'Fella reit',
			merge			: 'Sameina reiti',
			mergeRight		: 'Sameina til haegri',
			mergeDown		: 'Sameina nidur á vid',
			splitHorizontal	: 'Kljúfa reit lárétt',
			splitVertical	: 'Kljúfa reit lódrétt',
			title			: 'Cell Properties', // MISSING
			cellType		: 'Cell Type', // MISSING
			rowSpan			: 'Rows Span', // MISSING
			colSpan			: 'Columns Span', // MISSING
			wordWrap		: 'Word Wrap', // MISSING
			hAlign			: 'Horizontal Alignment', // MISSING
			vAlign			: 'Vertical Alignment', // MISSING
			alignBaseline	: 'Baseline', // MISSING
			bgColor			: 'Background Color', // MISSING
			borderColor		: 'Border Color', // MISSING
			data			: 'Data', // MISSING
			header			: 'Header', // MISSING
			yes				: 'Yes', // MISSING
			no				: 'No', // MISSING
			invalidWidth	: 'Cell width must be a number.', // MISSING
			invalidHeight	: 'Cell height must be a number.', // MISSING
			invalidRowSpan	: 'Rows span must be a whole number.', // MISSING
			invalidColSpan	: 'Columns span must be a whole number.', // MISSING
			chooseColor		: 'Choose' // MISSING
		},

		row :
		{
			menu			: 'R"od',
			insertBefore	: 'Skjóta inn r"od fyrir ofan',
			insertAfter		: 'Skjóta inn r"od fyrir nedan',
			deleteRow		: 'Eyda r"od'
		},

		column :
		{
			menu			: 'Dálkur',
			insertBefore	: 'Skjóta inn dálki vinstra megin',
			insertAfter		: 'Skjóta inn dálki haegra megin',
			deleteColumn	: 'Fella dálk'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Eigindi hnapps',
		text		: 'Texti',
		type		: 'Gerd',
		typeBtn		: 'Hnappur',
		typeSbm		: 'Stadfesta',
		typeRst		: 'Hreinsa'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Eigindi markreits',
		radioTitle	: 'Eigindi valhnapps',
		value		: 'Gildi',
		selected	: 'Valid'
	},

	// Form Dialog.
	form :
	{
		title		: 'Eigindi innsláttarforms',
		menu		: 'Eigindi innsláttarforms',
		action		: 'Adgerd',
		method		: 'Adferd',
		encoding	: 'Encoding' // MISSING
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Eigindi lista',
		selectInfo	: 'Uppl'ysingar',
		opAvail		: 'Kostir',
		value		: 'Gildi',
		size		: 'Staerd',
		lines		: 'línur',
		chkMulti	: 'Leyfa fleiri kosti',
		opText		: 'Texti',
		opValue		: 'Gildi',
		btnAdd		: 'Baeta vid',
		btnModify	: 'Breyta',
		btnUp		: 'Upp',
		btnDown		: 'Nidur',
		btnSetValue : 'Merkja sem valid',
		btnDelete	: 'Eyda'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Eigindi textasvaedis',
		cols		: 'Dálkar',
		rows		: 'Línur'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Eigindi textareits',
		name		: 'Nafn',
		value		: 'Gildi',
		charWidth	: 'Breidd (leturtákn)',
		maxChars	: 'Hámarksfj"oldi leturtákna',
		type		: 'Gerd',
		typeText	: 'Texti',
		typePass	: 'Lykilord'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Eigindi falins svaedis',
		name	: 'Nafn',
		value	: 'Gildi'
	},

	// Image Dialog.
	image :
	{
		title		: 'Eigindi myndar',
		titleButton	: 'Eigindi myndahnapps',
		menu		: 'Eigindi myndar',
		infoTab		: 'Almennt',
		btnUpload	: 'Hlada upp',
		upload		: 'Hlada upp',
		alt			: 'Baklaegur texti',
		lockRatio	: 'Festa staerdarhlutfall',
		resetSize	: 'Reikna staerd',
		border		: 'Rammi',
		hSpace		: 'Vinstri bil',
		vSpace		: 'Haegri bil',
		alertUrl	: 'Sládu inn slódina ad myndinni',
		linkTab		: 'Stikla',
		button2Img	: 'Do you want to transform the selected image button on a simple image?', // MISSING
		img2Button	: 'Do you want to transform the selected image on a image button?', // MISSING
		urlMissing	: 'Image source URL is missing.', // MISSING
		validateBorder	: 'Border must be a whole number.', // MISSING
		validateHSpace	: 'HSpace must be a whole number.', // MISSING
		validateVSpace	: 'VSpace must be a whole number.' // MISSING
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Eigindi Flash',
		propertiesTab	: 'Properties', // MISSING
		title			: 'Eigindi Flash',
		chkPlay			: 'Sjálfvirk spilun',
		chkLoop			: 'Endurtekning',
		chkMenu			: 'S'yna Flash-valmynd',
		chkFull			: 'Allow Fullscreen', // MISSING
 		scale			: 'Skali',
		scaleAll		: 'S'yna allt',
		scaleNoBorder	: ''An ramma',
		scaleFit		: 'Fella skala ad staerd',
		access			: 'Script Access', // MISSING
		accessAlways	: 'Always', // MISSING
		accessSameDomain: 'Same domain', // MISSING
		accessNever		: 'Never', // MISSING
		alignAbsBottom	: 'Abs nedst',
		alignAbsMiddle	: 'Abs midjud',
		alignBaseline	: 'Grunnlína',
		alignTextTop	: 'Efri brún texta',
		quality			: 'Quality', // MISSING
		qualityBest		: 'Best', // MISSING
		qualityHigh		: 'High', // MISSING
		qualityAutoHigh	: 'Auto High', // MISSING
		qualityMedium	: 'Medium', // MISSING
		qualityAutoLow	: 'Auto Low', // MISSING
		qualityLow		: 'Low', // MISSING
		windowModeWindow: 'Window', // MISSING
		windowModeOpaque: 'Opaque', // MISSING
		windowModeTransparent : 'Transparent', // MISSING
		windowMode		: 'Window mode', // MISSING
		flashvars		: 'Variables for Flash', // MISSING
		bgcolor			: 'Bakgrunnslitur',
		hSpace			: 'Vinstri bil',
		vSpace			: 'Haegri bil',
		validateSrc		: 'Sládu inn veffang stiklunnar!',
		validateHSpace	: 'HSpace must be a number.', // MISSING
		validateVSpace	: 'VSpace must be a number.' // MISSING
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Villuleit',
		title			: 'Spell Check', // MISSING
		notAvailable	: 'Sorry, but service is unavailable now.', // MISSING
		errorLoading	: 'Error loading application service host: %s.', // MISSING
		notInDic		: 'Ekki í ordabókinni',
		changeTo		: 'Tillaga',
		btnIgnore		: 'Hunsa',
		btnIgnoreAll	: 'Hunsa allt',
		btnReplace		: 'Skipta',
		btnReplaceAll	: 'Skipta "ollu',
		btnUndo			: 'Til baka',
		noSuggestions	: '- engar till"ogur -',
		progress		: 'Villuleit í gangi...',
		noMispell		: 'Villuleit lokid: Engin villa fannst',
		noChanges		: 'Villuleit lokid: Engu ordi breytt',
		oneChange		: 'Villuleit lokid: Einu ordi breytt',
		manyChanges		: 'Villuleit lokid: %1 ordum breytt',
		ieSpellDownload	: 'Villuleit ekki sett upp.<br>Viltu setja hana upp?'
	},

	smiley :
	{
		toolbar	: 'Svipur',
		title	: 'Velja svip',
		options : 'Smiley Options' // MISSING
	},

	elementsPath :
	{
		eleLabel : 'Elements path', // MISSING
		eleTitle : '%1 element' // MISSING
	},

	numberedlist	: 'Númeradur listi',
	bulletedlist	: 'Punktalisti',
	indent			: 'Minnka inndrátt',
	outdent			: 'Auka inndrátt',

	justify :
	{
		left	: 'Vinstrij"ofnun',
		center	: 'Midja texta',
		right	: 'Haegrij"ofnun',
		block	: 'Jafna bádum megin'
	},

	blockquote : 'Inndráttur',

	clipboard :
	{
		title		: 'Líma',
		cutError	: '"Oryggisstillingar vafrans thíns leyfa ekki klippingu texta med músaradgerd. Notadu lyklabordid í klippa (Ctrl/Cmd+X).',
		copyError	: '"Oryggisstillingar vafrans thíns leyfa ekki afritun texta med músaradgerd. Notadu lyklabordid í afrita (Ctrl/Cmd+C).',
		pasteMsg	: 'Límdu í svaedid hér ad nedan og (<STRONG>Ctrl/Cmd+V</STRONG>) og smelltu á <STRONG>OK</STRONG>.',
		securityMsg	: 'Vegna "oryggisstillinga í vafranum thínum faer ritillinn ekki beinan adgang ad klippubordinu. Thú verdur ad líma innihaldid aftur inn í thennan glugga.',
		pasteArea	: 'Paste Area' // MISSING
	},

	pastefromword :
	{
		confirmCleanup	: 'The text you want to paste seems to be copied from Word. Do you want to clean it before pasting?', // MISSING
		toolbar			: 'Líma úr Word',
		title			: 'Líma úr Word',
		error			: 'It was not possible to clean up the pasted data due to an internal error' // MISSING
	},

	pasteText :
	{
		button	: 'Líma sem ósnidinn texta',
		title	: 'Líma sem ósnidinn texta'
	},

	templates :
	{
		button			: 'Snidmát',
		title			: 'Innihaldssnidmát',
		options : 'Template Options', // MISSING
		insertOption	: 'Skipta út raunverulegu innihaldi',
		selectPromptMsg	: 'Veldu snidmát til ad opna í ritlinum.<br>(Núverandi innihald víkur fyrir thví!):',
		emptyListMsg	: '(Ekkert snidmát er skilgreint!)'
	},

	showBlocks : 'S'yna blokkir',

	stylesCombo :
	{
		label		: 'Stílflokkur',
		panelTitle	: 'Formatting Styles', // MISSING
		panelTitle1	: 'Block Styles', // MISSING
		panelTitle2	: 'Inline Styles', // MISSING
		panelTitle3	: 'Object Styles' // MISSING
	},

	format :
	{
		label		: 'Stílsnid',
		panelTitle	: 'Stílsnid',

		tag_p		: 'Venjulegt letur',
		tag_pre		: 'Forsnidid',
		tag_address	: 'Vistfang',
		tag_h1		: 'Fyrirs"ogn 1',
		tag_h2		: 'Fyrirs"ogn 2',
		tag_h3		: 'Fyrirs"ogn 3',
		tag_h4		: 'Fyrirs"ogn 4',
		tag_h5		: 'Fyrirs"ogn 5',
		tag_h6		: 'Fyrirs"ogn 6',
		tag_div		: 'Venjulegt (DIV)'
	},

	div :
	{
		title				: 'Create Div Container', // MISSING
		toolbar				: 'Create Div Container', // MISSING
		cssClassInputLabel	: 'Stylesheet Classes', // MISSING
		styleSelectLabel	: 'Style', // MISSING
		IdInputLabel		: 'Id', // MISSING
		languageCodeInputLabel	: ' Language Code', // MISSING
		inlineStyleInputLabel	: 'Inline Style', // MISSING
		advisoryTitleInputLabel	: 'Advisory Title', // MISSING
		langDirLabel		: 'Language Direction', // MISSING
		langDirLTRLabel		: 'Left to Right (LTR)', // MISSING
		langDirRTLLabel		: 'Right to Left (RTL)', // MISSING
		edit				: 'Edit Div', // MISSING
		remove				: 'Remove Div' // MISSING
  	},

	iframe :
	{
		title		: 'IFrame Properties', // MISSING
		toolbar		: 'IFrame', // MISSING
		noUrl		: 'Please type the iframe URL', // MISSING
		scrolling	: 'Enable scrollbars', // MISSING
		border		: 'Show frame border' // MISSING
	},

	font :
	{
		label		: 'Leturgerd ',
		voiceLabel	: 'Font', // MISSING
		panelTitle	: 'Leturgerd '
	},

	fontSize :
	{
		label		: 'Leturstaerd ',
		voiceLabel	: 'Font Size', // MISSING
		panelTitle	: 'Leturstaerd '
	},

	colorButton :
	{
		textColorTitle	: 'Litur texta',
		bgColorTitle	: 'Bakgrunnslitur',
		panelTitle		: 'Colors', // MISSING
		auto			: 'Sjálfval',
		more			: 'Fleiri liti...'
	},

	colors :
	{
		'000' : 'Black', // MISSING
		'800000' : 'Maroon', // MISSING
		'8B4513' : 'Saddle Brown', // MISSING
		'2F4F4F' : 'Dark Slate Gray', // MISSING
		'008080' : 'Teal', // MISSING
		'000080' : 'Navy', // MISSING
		'4B0082' : 'Indigo', // MISSING
		'696969' : 'Dark Gray', // MISSING
		'B22222' : 'Fire Brick', // MISSING
		'A52A2A' : 'Brown', // MISSING
		'DAA520' : 'Golden Rod', // MISSING
		'006400' : 'Dark Green', // MISSING
		'40E0D0' : 'Turquoise', // MISSING
		'0000CD' : 'Medium Blue', // MISSING
		'800080' : 'Purple', // MISSING
		'808080' : 'Gray', // MISSING
		'F00' : 'Red', // MISSING
		'FF8C00' : 'Dark Orange', // MISSING
		'FFD700' : 'Gold', // MISSING
		'008000' : 'Green', // MISSING
		'0FF' : 'Cyan', // MISSING
		'00F' : 'Blue', // MISSING
		'EE82EE' : 'Violet', // MISSING
		'A9A9A9' : 'Dim Gray', // MISSING
		'FFA07A' : 'Light Salmon', // MISSING
		'FFA500' : 'Orange', // MISSING
		'FFFF00' : 'Yellow', // MISSING
		'00FF00' : 'Lime', // MISSING
		'AFEEEE' : 'Pale Turquoise', // MISSING
		'ADD8E6' : 'Light Blue', // MISSING
		'DDA0DD' : 'Plum', // MISSING
		'D3D3D3' : 'Light Grey', // MISSING
		'FFF0F5' : 'Lavender Blush', // MISSING
		'FAEBD7' : 'Antique White', // MISSING
		'FFFFE0' : 'Light Yellow', // MISSING
		'F0FFF0' : 'Honeydew', // MISSING
		'F0FFFF' : 'Azure', // MISSING
		'F0F8FF' : 'Alice Blue', // MISSING
		'E6E6FA' : 'Lavender', // MISSING
		'FFF' : 'White' // MISSING
	},

	scayt :
	{
		title			: 'Spell Check As You Type', // MISSING
		opera_title		: 'Not supported by Opera', // MISSING
		enable			: 'Enable SCAYT', // MISSING
		disable			: 'Disable SCAYT', // MISSING
		about			: 'About SCAYT', // MISSING
		toggle			: 'Toggle SCAYT', // MISSING
		options			: 'Options', // MISSING
		langs			: 'Languages', // MISSING
		moreSuggestions	: 'More suggestions', // MISSING
		ignore			: 'Ignore', // MISSING
		ignoreAll		: 'Ignore All', // MISSING
		addWord			: 'Add Word', // MISSING
		emptyDic		: 'Dictionary name should not be empty.', // MISSING

		optionsTab		: 'Options', // MISSING
		allCaps			: 'Ignore All-Caps Words', // MISSING
		ignoreDomainNames : 'Ignore Domain Names', // MISSING
		mixedCase		: 'Ignore Words with Mixed Case', // MISSING
		mixedWithDigits	: 'Ignore Words with Numbers', // MISSING

		languagesTab	: 'Languages', // MISSING

		dictionariesTab	: 'Dictionaries', // MISSING
		dic_field_name	: 'Dictionary name', // MISSING
		dic_create		: 'Create', // MISSING
		dic_restore		: 'Restore', // MISSING
		dic_delete		: 'Delete', // MISSING
		dic_rename		: 'Rename', // MISSING
		dic_info		: 'Initially the User Dictionary is stored in a Cookie. However, Cookies are limited in size. When the User Dictionary grows to a point where it cannot be stored in a Cookie, then the dictionary may be stored on our server. To store your personal dictionary on our server you should specify a name for your dictionary. If you already have a stored dictionary, please type its name and click the Restore button.', // MISSING

		aboutTab		: 'About' // MISSING
	},

	about :
	{
		title		: 'About CKEditor', // MISSING
		dlgTitle	: 'About CKEditor', // MISSING
		help	: 'Check $1 for help.', // MISSING
		userGuide : 'CKEditor User\'s Guide', // MISSING
		moreInfo	: 'For licensing information please visit our web site:', // MISSING
		copy		: 'Copyright &copy; $1. All rights reserved.' // MISSING
	},

	maximize : 'Maximize', // MISSING
	minimize : 'Minimize', // MISSING

	fakeobjects :
	{
		anchor		: 'Anchor', // MISSING
		flash		: 'Flash Animation', // MISSING
		iframe		: 'IFrame', // MISSING
		hiddenfield	: 'Hidden Field', // MISSING
		unknown		: 'Unknown Object' // MISSING
	},

	resize : 'Drag to resize', // MISSING

	colordialog :
	{
		title		: 'Select color', // MISSING
		options	:	'Color Options', // MISSING
		highlight	: 'Highlight', // MISSING
		selected	: 'Selected Color', // MISSING
		clear		: 'Clear' // MISSING
	},

	toolbarCollapse	: 'Collapse Toolbar', // MISSING
	toolbarExpand	: 'Expand Toolbar', // MISSING

	toolbarGroups :
	{
		document : 'Document', // MISSING
		clipboard : 'Clipboard/Undo', // MISSING
		editing : 'Editing', // MISSING
		forms : 'Forms', // MISSING
		basicstyles : 'Basic Styles', // MISSING
		paragraph : 'Paragraph', // MISSING
		links : 'Links', // MISSING
		insert : 'Insert', // MISSING
		styles : 'Styles', // MISSING
		colors : 'Colors', // MISSING
		tools : 'Tools' // MISSING
	},

	bidi :
	{
		ltr : 'Text direction from left to right', // MISSING
		rtl : 'Text direction from right to left' // MISSING
	},

	docprops :
	{
		label : 'Eigindi skjals',
		title : 'Eigindi skjals',
		design : 'Design', // MISSING
		meta : 'L'ysig"ogn',
		chooseColor : 'Choose', // MISSING
		other : '<annar>',
		docTitle :	'Titill sídu',
		charset : 	'Letursett',
		charsetOther : 'Annad letursett',
		charsetASCII : 'ASCII', // MISSING
		charsetCE : 'Mid-evrópskt',
		charsetCT : 'Kínverskt, hefdbundid (Big5)',
		charsetCR : 'K'yrilskt',
		charsetGR : 'Grískt',
		charsetJP : 'Japanskt',
		charsetKR : 'Kóreskt',
		charsetTR : 'Tyrkneskt',
		charsetUN : 'Unicode (UTF-8)', // MISSING
		charsetWE : 'Vestur-evrópst',
		docType : 'Flokkur skjalategunda',
		docTypeOther : 'Annar flokkur skjalategunda',
		xhtmlDec : 'Fella inn XHTML l'ysingu',
		bgColor : 'Bakgrunnslitur',
		bgImage : 'Slód bakgrunnsmyndar',
		bgFixed : 'Laestur bakgrunnur',
		txtColor : 'Litur texta',
		margin : 'Hlidarspássía',
		marginTop : 'Efst',
		marginLeft : 'Vinstri',
		marginRight : 'Haegri',
		marginBottom : 'Nedst',
		metaKeywords : 'Lykilord efnisordaskrár (adgreind med kommum)',
		metaDescription : 'L'ysing skjals',
		metaAuthor : 'H"ofundur',
		metaCopyright : 'H"ofundarréttur',
		previewHtml : '<p>This is some <strong>sample text</strong>. You are using <a href="javascript:void(0)">CKEditor</a>.</p>' // MISSING
	}
};
