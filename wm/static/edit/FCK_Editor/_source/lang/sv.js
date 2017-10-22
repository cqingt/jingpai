/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
* @fileOverview
*/

/**#@+
   @type String
   @example
*/

/**
 * Contains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['sv'] =
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
	editorHelp : 'Tryck ALT 0 f"or hj"alp',

	// ARIA descriptions.
	toolbars	: 'Editor toolbars', // MISSING
	editor		: 'Rich Text Editor',

	// Toolbar buttons without dialogs.
	source			: 'K"alla',
	newPage			: 'Ny sida',
	save			: 'Spara',
	preview			: 'F"orhandsgranska',
	cut				: 'Klipp ut',
	copy			: 'Kopiera',
	paste			: 'Klistra in',
	print			: 'Skriv ut',
	underline		: 'Understruken',
	bold			: 'Fet',
	italic			: 'Kursiv',
	selectAll		: 'Markera allt',
	removeFormat	: 'Radera formatering',
	strike			: 'Genomstruken',
	subscript		: 'Neds"ankta tecken',
	superscript		: 'Upph"ojda tecken',
	horizontalrule	: 'Infoga horisontal linje',
	pagebreak		: 'Infoga sidbrytning',
	pagebreakAlt		: 'Sidbrytning',
	unlink			: 'Radera l"ank',
	undo			: 'Angra',
	redo			: 'G"or om',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Bl"addra pa server',
		url				: 'URL',
		protocol		: 'Protokoll',
		upload			: 'Ladda upp',
		uploadSubmit	: 'Skicka till server',
		image			: 'Bild',
		flash			: 'Flash',
		form			: 'Formul"ar',
		checkbox		: 'Kryssruta',
		radio			: 'Alternativknapp',
		textField		: 'Textf"alt',
		textarea		: 'Textruta',
		hiddenField		: 'Dolt f"alt',
		button			: 'Knapp',
		select			: 'Flervalslista',
		imageButton		: 'Bildknapp',
		notSet			: '<ej angivet>',
		id				: 'Id',
		name			: 'Namn',
		langDir			: 'Sprakriktning',
		langDirLtr		: 'V"anster till H"oger (VTH)',
		langDirRtl		: 'H"oger till V"anster (HTV)',
		langCode		: 'Sprakkod',
		longDescr		: 'URL-beskrivning',
		cssClass		: 'Stilmall',
		advisoryTitle	: 'Titel',
		cssStyle		: 'Stilmall',
		ok				: 'OK',
		cancel			: 'Avbryt',
		close			: 'St"ang',
		preview			: 'F"orhandsgranska',
		generalTab		: 'Allm"ant',
		advancedTab		: 'Avancerad',
		validateNumberFailed : 'V"ardet "ar inte ett nummer.',
		confirmNewPage	: 'Alla "andringar i innehallet kommer att f"orloras. "Ar du s"aker pa att du vill ladda en ny sida?',
		confirmCancel	: 'Nagra av de alternativ har "andrats. "Ar du s"aker pa att st"anga dialogrutan?',
		options			: 'Alternativ',
		target			: 'Mal',
		targetNew		: 'Nytt f"onster (_blank)',
		targetTop		: '"Oversta f"onstret (_top)',
		targetSelf		: 'Samma f"onster (_self)',
		targetParent	: 'F"oregaende f"onster (_parent)',
		langDirLTR		: 'V"anster till h"oger (LTR)',
		langDirRTL		: 'H"oger till v"anster (RTL)',
		styles			: 'Stil',
		cssClasses		: 'Stilmallar',
		width			: 'Bredd',
		height			: 'H"ojd',
		align			: 'Justering',
		alignLeft		: 'V"anster',
		alignRight		: 'H"oger',
		alignCenter		: 'Centrerad',
		alignTop		: '"Overkant',
		alignMiddle		: 'Mitten',
		alignBottom		: 'Nederkant',
		invalidValue	: 'Invalid value.', // MISSING
		invalidHeight	: 'H"ojd maste vara ett nummer.',
		invalidWidth	: 'Bredd maste vara ett nummer.',
		invalidCssLength	: 'Value specified for the "%1" field must be a positive number with or without a valid CSS measurement unit (px, %, in, cm, mm, em, ex, pt, or pc).', // MISSING
		invalidHtmlLength	: 'Value specified for the "%1" field must be a positive number with or without a valid HTML measurement unit (px or %).', // MISSING
		invalidInlineStyle	: 'Value specified for the inline style must consist of one or more tuples with the format of "name : value", separated by semi-colons.', // MISSING
		cssLengthTooltip	: 'Enter a number for a value in pixels or a number with a valid CSS unit (px, %, in, cm, mm, em, ex, pt, or pc).', // MISSING

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, Ej tillg"anglig</span>'
	},

	contextmenu :
	{
		options : 'Context Menu Options'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Klistra in ut"okat tecken',
		title		: 'V"alj ut"okat tecken',
		options : 'Special Character Options'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Infoga/Redigera l"ank',
		other 		: '<annan>',
		menu		: 'Redigera l"ank',
		title		: 'L"ank',
		info		: 'L"ankinformation',
		target		: 'Mal',
		upload		: 'Ladda upp',
		advanced	: 'Avancerad',
		type		: 'L"anktyp',
		toUrl		: 'URL',
		toAnchor	: 'Ankare i sidan',
		toEmail		: 'E-post',
		targetFrame		: '<ram>',
		targetPopup		: '<popup-f"onster>',
		targetFrameName	: 'Malets ramnamn',
		targetPopupName	: 'Popup-f"onstrets namn',
		popupFeatures	: 'Popup-f"onstrets egenskaper',
		popupResizable	: 'Resizable',
		popupStatusBar	: 'Statusf"alt',
		popupLocationBar: 'Adressf"alt',
		popupToolbar	: 'Verktygsf"alt',
		popupMenuBar	: 'Menyf"alt',
		popupFullScreen	: 'Helsk"arm (endast IE)',
		popupScrollBars	: 'Scrolllista',
		popupDependent	: 'Beroende (endast Netscape)',
		popupLeft		: 'Position fran v"anster',
		popupTop		: 'Position fran sidans topp',
		id				: 'Id',
		langDir			: 'Sprakriktning',
		langDirLTR		: 'V"anster till h"oger (VTH)',
		langDirRTL		: 'H"oger till v"anster (HTV)',
		acccessKey		: 'Beh"orighetsnyckel',
		name			: 'Namn',
		langCode			: 'Sprakriktning',
		tabIndex			: 'Tabindex',
		advisoryTitle		: 'Titel',
		advisoryContentType	: 'Innehallstyp',
		cssClasses		: 'Stylesheet class',
		charset			: 'Teckenuppst"allning',
		styles			: 'Stilmall',
		rel			: 'Relationship', // MISSING
		selectAnchor		: 'V"alj ett ankare',
		anchorName		: 'efter ankarnamn',
		anchorId			: 'efter objektid',
		emailAddress		: 'E-postadress',
		emailSubject		: '"Amne',
		emailBody		: 'Innehall',
		noAnchors		: '(Inga ankare kunde hittas)',
		noUrl			: 'Var god ange l"ankens URL',
		noEmail			: 'Var god ange E-postadress'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Infoga/Redigera ankarl"ank',
		menu		: 'Egenskaper f"or ankarl"ank',
		title		: 'Egenskaper f"or ankarl"ank',
		name		: 'Ankarnamn',
		errorName	: 'Var god ange ett ankarnamn',
		remove		: 'Remove Anchor' // MISSING
	},

	// List style dialog
	list:
	{
		numberedTitle		: 'Egenskaper f"or punktlista',
		bulletedTitle		: 'Egenskaper f"or punktlista',
		type				: 'Typ',
		start				: 'Start',
		validateStartNumber				:'List start number must be a whole number.',
		circle				: 'Cirkel',
		disc				: 'Disk',
		square				: 'Fyrkant',
		none				: 'Ingen',
		notset				: '<ej angiven>',
		armenian			: 'Armenisk numrering',
		georgian			: 'Georgisk numrering (an, ban, gan, etc.)',
		lowerRoman			: 'Romerska gemener (i, ii, iii, iv, v, etc.)',
		upperRoman			: 'Romerska versaler (I, II, III, IV, V, etc.)',
		lowerAlpha			: 'Alpha gemener (a, b, c, d, e, etc.)',
		upperAlpha			: 'Alpha versaler (A, B, C, D, E, etc.)',
		lowerGreek			: 'Grekiska gemener (alpha, beta, gamma, etc.)',
		decimal				: 'Decimal (1, 2, 3, etc.)',
		decimalLeadingZero	: 'Decimal nolla (01, 02, 03, etc.)'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'S"ok och ers"att',
		find				: 'S"ok',
		replace				: 'Ers"att',
		findWhat			: 'S"ok efter:',
		replaceWith			: 'Ers"att med:',
		notFoundMsg			: 'Angiven text kunde ej hittas.',
		findOptions			: 'Find Options', // MISSING
		matchCase			: 'Skiftl"age',
		matchWord			: 'Inkludera hela ord',
		matchCyclic			: 'Matcha cykliska',
		replaceAll			: 'Ers"att alla',
		replaceSuccessMsg	: '%1 f"orekomst(er) ersatta.'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Tabell',
		title		: 'Tabellegenskaper',
		menu		: 'Tabellegenskaper',
		deleteTable	: 'Radera tabell',
		rows		: 'Rader',
		columns		: 'Kolumner',
		border		: 'Kantstorlek',
		widthPx		: 'pixlar',
		widthPc		: 'procent',
		widthUnit	: 'enhet bredd',
		cellSpace	: 'Cellavstand',
		cellPad		: 'Cellutfyllnad',
		caption		: 'Rubrik',
		summary		: 'Sammanfattning',
		headers		: 'Ruberiker',
		headersNone		: 'Ingen',
		headersColumn	: 'F"orsta kolumnen',
		headersRow		: 'F"orsta raden',
		headersBoth		: 'Bada',
		invalidRows		: 'Antal rader maste vara st"orre "an 0.',
		invalidCols		: 'Antal kolumner maste vara ett nummer st"orre "an 0.',
		invalidBorder	: 'Ram maste vara ett nummer.',
		invalidWidth	: 'Tabell maste vara ett nummer.',
		invalidHeight	: 'Tabellens h"ojd maste vara ett nummer.',
		invalidCellSpacing	: 'Luft i cell maste vara ett nummer.',
		invalidCellPadding	: 'Luft i cell maste vara ett nummer.',

		cell :
		{
			menu			: 'Cell',
			insertBefore	: 'L"agg till cell f"ore',
			insertAfter		: 'L"agg till cell efter',
			deleteCell		: 'Radera celler',
			merge			: 'Sammanfoga celler',
			mergeRight		: 'Sammanfoga h"oger',
			mergeDown		: 'Sammanfoga ner',
			splitHorizontal	: 'Dela cell horisontellt',
			splitVertical	: 'Dela cell vertikalt',
			title			: 'Egenskaper f"or cell',
			cellType		: 'Celltyp',
			rowSpan			: 'Rad spann',
			colSpan			: 'Kolumnen spann',
			wordWrap		: 'Radbrytning',
			hAlign			: 'Horisontell justering',
			vAlign			: 'Vertikal justering',
			alignBaseline	: 'Baslinje',
			bgColor			: 'Bakgrundsf"arg',
			borderColor		: 'Ramf"arg',
			data			: 'Data',
			header			: 'Rubrik',
			yes				: 'Ja',
			no				: 'Nej',
			invalidWidth	: 'Cellens bredd maste vara ett nummer.',
			invalidHeight	: 'Cellens h"ojd maste vara ett nummer.',
			invalidRowSpan	: 'Radutvidgning maste vara ett heltal.',
			invalidColSpan	: 'Kolumn maste vara ett heltal.',
			chooseColor		: 'V"alj'
		},

		row :
		{
			menu			: 'Rad',
			insertBefore	: 'L"agg till Rad F"ore',
			insertAfter		: 'L"agg till rad efter',
			deleteRow		: 'Radera rad'
		},

		column :
		{
			menu			: 'Kolumn',
			insertBefore	: 'L"agg till kolumn f"ore',
			insertAfter		: 'L"agg till kolumn efter',
			deleteColumn	: 'Radera kolumn'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Egenskaper f"or knapp',
		text		: 'Text (v"arde)',
		type		: 'Typ',
		typeBtn		: 'Knapp',
		typeSbm		: 'Skicka',
		typeRst		: 'Aterst"all'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Egenskaper f"or kryssruta',
		radioTitle	: 'Egenskaper f"or alternativknapp',
		value		: 'V"arde',
		selected	: 'Vald'
	},

	// Form Dialog.
	form :
	{
		title		: 'Egenskaper f"or formul"ar',
		menu		: 'Egenskaper f"or formul"ar',
		action		: 'Funktion',
		method		: 'Metod',
		encoding	: 'Kodning'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Egenskaper f"or flervalslista',
		selectInfo	: 'Information',
		opAvail		: 'Befintliga val',
		value		: 'V"arde',
		size		: 'Storlek',
		lines		: 'Linjer',
		chkMulti	: 'Tillat flerval',
		opText		: 'Text',
		opValue		: 'V"arde',
		btnAdd		: 'L"agg till',
		btnModify	: 'Redigera',
		btnUp		: 'Upp',
		btnDown		: 'Ner',
		btnSetValue : 'Markera som valt v"arde',
		btnDelete	: 'Radera'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Egenskaper f"or textruta',
		cols		: 'Kolumner',
		rows		: 'Rader'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Egenskaper f"or textf"alt',
		name		: 'Namn',
		value		: 'V"arde',
		charWidth	: 'Teckenbredd',
		maxChars	: 'Max antal tecken',
		type		: 'Typ',
		typeText	: 'Text',
		typePass	: 'L"osenord'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Egenskaper f"or dolt f"alt',
		name	: 'Namn',
		value	: 'V"arde'
	},

	// Image Dialog.
	image :
	{
		title		: 'Bildegenskaper',
		titleButton	: 'Egenskaper f"or bildknapp',
		menu		: 'Bildegenskaper',
		infoTab		: 'Bildinformation',
		btnUpload	: 'Skicka till server',
		upload		: 'Ladda upp',
		alt			: 'Alternativ text',
		lockRatio	: 'Las h"ojd/bredd f"orhallanden',
		resetSize	: 'Aterst"all storlek',
		border		: 'Kant',
		hSpace		: 'Horis. marginal',
		vSpace		: 'Vert. marginal',
		alertUrl	: 'Var god och ange bildens URL',
		linkTab		: 'L"ank',
		button2Img	: 'Vill du omvandla den valda bildknappen pa en enkel bild?',
		img2Button	: 'Vill du omvandla den valda bildknappen pa en enkel bild?',
		urlMissing	: 'Bildk"allans URL saknas.',
		validateBorder	: 'Kantlinje maste vara ett heltal.',
		validateHSpace	: 'HSpace maste vara ett heltal.',
		validateVSpace	: 'VSpace maste vara ett heltal.'
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Flashegenskaper',
		propertiesTab	: 'Egenskaper',
		title			: 'Flashegenskaper',
		chkPlay			: 'Automatisk uppspelning',
		chkLoop			: 'Upprepa/Loopa',
		chkMenu			: 'Aktivera Flashmeny',
		chkFull			: 'Tillat helsk"arm',
 		scale			: 'Skala',
		scaleAll		: 'Visa allt',
		scaleNoBorder	: 'Ingen ram',
		scaleFit		: 'Exakt passning',
		access			: 'Script-tillgang',
		accessAlways	: 'Alltid',
		accessSameDomain: 'Samma dom"an',
		accessNever		: 'Aldrig',
		alignAbsBottom	: 'Absolut nederkant',
		alignAbsMiddle	: 'Absolut centrering',
		alignBaseline	: 'Baslinje',
		alignTextTop	: 'Text "overkant',
		quality			: 'Kvalitet',
		qualityBest		: 'B"ast',
		qualityHigh		: 'H"og',
		qualityAutoHigh	: 'Auto H"og',
		qualityMedium	: 'Medium',
		qualityAutoLow	: 'Auto Lag',
		qualityLow		: 'Lag',
		windowModeWindow: 'F"onster',
		windowModeOpaque: 'Opaque',
		windowModeTransparent : 'Transparent',
		windowMode		: 'F"onsterl"age',
		flashvars		: 'Variabler f"or Flash',
		bgcolor			: 'Bakgrundsf"arg',
		hSpace			: 'Horis. marginal',
		vSpace			: 'Vert. marginal',
		validateSrc		: 'Var god ange l"ankens URL',
		validateHSpace	: 'HSpace maste vara ett nummer.',
		validateVSpace	: 'VSpace maste vara ett nummer.'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Stavningskontroll',
		title			: 'Kontrollera stavning',
		notAvailable	: 'Tyv"arr "ar tj"ansten ej tillg"anglig nu',
		errorLoading	: 'Tj"ansten "ar ej tillg"anglig: %s.',
		notInDic		: 'Saknas i ordlistan',
		changeTo		: '"Andra till',
		btnIgnore		: 'Ignorera',
		btnIgnoreAll	: 'Ignorera alla',
		btnReplace		: 'Ers"att',
		btnReplaceAll	: 'Ers"att alla',
		btnUndo			: 'Angra',
		noSuggestions	: '- F"orslag saknas -',
		progress		: 'Stavningskontroll pagar...',
		noMispell		: 'Stavningskontroll slutf"ord: Inga stavfel patr"affades.',
		noChanges		: 'Stavningskontroll slutf"ord: Inga ord r"attades.',
		oneChange		: 'Stavningskontroll slutf"ord: Ett ord r"attades.',
		manyChanges		: 'Stavningskontroll slutf"ord: %1 ord r"attades.',
		ieSpellDownload	: 'Stavningskontrollen "ar ej installerad. Vill du g"ora det nu?'
	},

	smiley :
	{
		toolbar	: 'Smiley',
		title	: 'Infoga smiley',
		options : 'Smileyinst"allningar'
	},

	elementsPath :
	{
		eleLabel : 'Elementets s"okv"ag',
		eleTitle : '%1 element'
	},

	numberedlist	: 'Numrerad lista',
	bulletedlist	: 'Punktlista',
	indent			: '"Oka indrag',
	outdent			: 'Minska indrag',

	justify :
	{
		left	: 'V"ansterjustera',
		center	: 'Centrera',
		right	: 'H"ogerjustera',
		block	: 'Justera till marginaler'
	},

	blockquote : 'Blockcitat',

	clipboard :
	{
		title		: 'Klistra in',
		cutError	: 'S"akerhetsinst"allningar i Er webl"asare tillater inte atgarden Klipp ut. Anv"and (Ctrl/Cmd+X) ist"allet.',
		copyError	: 'S"akerhetsinst"allningar i Er webl"asare tillater inte atgarden Kopiera. Anv"and (Ctrl/Cmd+C) ist"allet',
		pasteMsg	: 'Var god och klistra in Er text i rutan nedan genom att anv"anda (<STRONG>Ctrl/Cmd+V</STRONG>) klicka sen pa <STRONG>OK</STRONG>.',
		securityMsg	: 'Pa grund av din webbl"asares s"akerhetsinst"allningar kan verktyget inte fa atkomst till urklippsdatan. Var god och anv"and detta f"onster ist"allet.',
		pasteArea	: 'Paste Area'
	},

	pastefromword :
	{
		confirmCleanup	: 'Texten du vill klistra in verkar vara kopierad fran Word. Vill du rensa innan du klistrar?',
		toolbar			: 'Klistra in fran Word',
		title			: 'Klistra in fran Word',
		error			: 'Det var inte m"ojligt att st"ada upp den inklistrade data pa grund av ett internt fel'
	},

	pasteText :
	{
		button	: 'Klistra in som vanlig text',
		title	: 'Klistra in som vanlig text'
	},

	templates :
	{
		button			: 'Sidmallar',
		title			: 'Sidmallar',
		options : 'Inst"allningar f"or mall',
		insertOption	: 'Ers"att aktuellt innehall',
		selectPromptMsg	: 'Var god v"alj en mall att anv"anda med editorn<br>(allt nuvarande innehall raderas):',
		emptyListMsg	: '(Ingen mall "ar vald)'
	},

	showBlocks : 'Visa block',

	stylesCombo :
	{
		label		: 'Anpassad stil',
		panelTitle	: 'Formatmallar',
		panelTitle1	: 'Blockstil',
		panelTitle2	: 'Inb"addad stil',
		panelTitle3	: 'Objektets stil'
	},

	format :
	{
		label		: 'Teckenformat',
		panelTitle	: 'Teckenformat',

		tag_p		: 'Normal',
		tag_pre		: 'Formaterad',
		tag_address	: 'Adress',
		tag_h1		: 'Rubrik 1',
		tag_h2		: 'Rubrik 2',
		tag_h3		: 'Rubrik 3',
		tag_h4		: 'Rubrik 4',
		tag_h5		: 'Rubrik 5',
		tag_h6		: 'Rubrik 6',
		tag_div		: 'Normal (DIV)'
	},

	div :
	{
		title				: 'Skapa Div container',
		toolbar				: 'Skapa Div container',
		cssClassInputLabel	: 'Stilmallar',
		styleSelectLabel	: 'Stil',
		IdInputLabel		: 'Id',
		languageCodeInputLabel	: ' Sprakkod',
		inlineStyleInputLabel	: 'Inline Style',
		advisoryTitleInputLabel	: 'Radgivande titel',
		langDirLabel		: 'Sprakriktning',
		langDirLTRLabel		: 'V"anster till H"oger (LTR)',
		langDirRTLLabel		: 'H"oger till v"anster (RTL)',
		edit				: 'Redigera Div',
		remove				: 'Ta bort Div'
  	},

	iframe :
	{
		title		: 'iFrame Egenskaper',
		toolbar		: 'iFrame',
		noUrl		: 'Skriv in URL f"or iFrame',
		scrolling	: 'Aktivera rullningslister',
		border		: 'Visa ramkant'
	},

	font :
	{
		label		: 'Typsnitt',
		voiceLabel	: 'Typsnitt',
		panelTitle	: 'Typsnitt'
	},

	fontSize :
	{
		label		: 'Storlek',
		voiceLabel	: 'Teckenstorlek',
		panelTitle	: 'Storlek'
	},

	colorButton :
	{
		textColorTitle	: 'Textf"arg',
		bgColorTitle	: 'Bakgrundsf"arg',
		panelTitle		: 'F"arger',
		auto			: 'Automatisk',
		more			: 'Fler f"arger...'
	},

	colors :
	{
		'000' : 'Svart',
		'800000' : 'R"odbrun',
		'8B4513' : 'M"orkbrun',
		'2F4F4F' : 'Skiffergra',
		'008080' : 'Kricka',
		'000080' : 'Marinbla',
		'4B0082' : 'Indigo',
		'696969' : 'M"orkgra',
		'B22222' : 'Tegelsten',
		'A52A2A' : 'Brun',
		'DAA520' : 'M"ork guld',
		'006400' : 'M"orkgr"on',
		'40E0D0' : 'Turkos',
		'0000CD' : 'Medium bla',
		'800080' : 'Lila',
		'808080' : 'Gra',
		'F00' : 'R"od',
		'FF8C00' : 'M"orkorange',
		'FFD700' : 'Guld',
		'008000' : 'Gr"on',
		'0FF' : 'Turkos',
		'00F' : 'Bla',
		'EE82EE' : 'Violett',
		'A9A9A9' : 'Matt gra',
		'FFA07A' : 'Laxrosa',
		'FFA500' : 'Orange',
		'FFFF00' : 'Gul',
		'00FF00' : 'Lime',
		'AFEEEE' : 'Ljusturkos',
		'ADD8E6' : 'Ljusbla',
		'DDA0DD' : 'Plommon',
		'D3D3D3' : 'Ljusgra',
		'FFF0F5' : 'Ljus lavender',
		'FAEBD7' : 'Antikvit',
		'FFFFE0' : 'Ljusgul',
		'F0FFF0' : 'Honung',
		'F0FFFF' : 'Azurbla',
		'F0F8FF' : 'Alicebla',
		'E6E6FA' : 'Lavender',
		'FFF' : 'Vit'
	},

	scayt :
	{
		title			: 'Stavningskontroll medan du skriver',
		opera_title		: 'St"ods ej av Opera',
		enable			: 'Aktivera SCAYT',
		disable			: 'Inaktivera SCAYT',
		about			: 'Om SCAYT',
		toggle			: 'V"axla SCAYT',
		options			: 'Inst"allningar',
		langs			: 'Sprak',
		moreSuggestions	: 'Fler f"orslag',
		ignore			: 'Ignorera',
		ignoreAll		: 'Ignorera alla',
		addWord			: 'L"agg till ord',
		emptyDic		: 'Ordlistans namn far ej vara tomt.',

		optionsTab		: 'Inst"allningar',
		allCaps			: 'Ignorera alla ord med enbart versaler',
		ignoreDomainNames : 'Ignorera dom"annamn',
		mixedCase		: 'Ignorera ord med blandat shiftl"age',
		mixedWithDigits	: 'Ignorera ord med nummer',

		languagesTab	: 'Sprak',

		dictionariesTab	: 'Ordlistor',
		dic_field_name	: 'Ordlistans namn',
		dic_create		: 'Skapa',
		dic_restore		: 'Aterst"all',
		dic_delete		: 'Ta bort',
		dic_rename		: 'Byt namn',
		dic_info		: 'Inledningsvis lagras ordlistan i en cookie. N"ar ordlista v"axer till en punkt d"ar det inte kan lagras i en cookie, lagras den pa var server. F"or att lagra din personliga ordlista pa var server du ska ange ett namn f"or din ordbok. Om du redan har en lagrad ordbok, skriv namnet och klicka pa knappen Aterst"all.',

		aboutTab		: 'Om'
	},

	about :
	{
		title		: 'Om CKEditor',
		dlgTitle	: 'Om CKEditor',
		help	: 'Check $1 for help.', // MISSING
		userGuide : 'CKEditor User\'s Guide', // MISSING
		moreInfo	: 'F"or information av licenciering bes"ok var hemsida:',
		copy		: 'Copyright &copy; $1. Alla r"attigheter reserverade.'
	},

	maximize : 'Maximera',
	minimize : 'Minimera',

	fakeobjects :
	{
		anchor		: 'Ankare',
		flash		: 'Flashanimation',
		iframe		: 'iFrame',
		hiddenfield	: 'G"omt f"alt',
		unknown		: 'Ok"ant objekt'
	},

	resize : 'Dra f"or att "andra storlek',

	colordialog :
	{
		title		: 'V"alj f"arg',
		options	:	'F"argalternativ',
		highlight	: 'Markera',
		selected	: 'Vald f"arg',
		clear		: 'Rensa'
	},

	toolbarCollapse	: 'D"olj verktygsf"alt',
	toolbarExpand	: 'Visa verktygsf"alt',

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
		ltr : 'Text riktning fran v"anster till h"oger',
		rtl : 'Text riktning fran h"oger till v"anster'
	},

	docprops :
	{
		label : 'Dokumentegenskaper',
		title : 'Dokumentegenskaper',
		design : 'Design', // MISSING
		meta : 'Metadata',
		chooseColor : 'V"alj',
		other : '<annan>',
		docTitle :	'Sidtitel',
		charset : 	'Teckenupps"attningar',
		charsetOther : '"Ovriga teckenupps"attningar',
		charsetASCII : 'ASCII', // MISSING
		charsetCE : 'Central Europa',
		charsetCT : 'Traditionell Kinesisk (Big5)',
		charsetCR : 'Kyrillisk',
		charsetGR : 'Grekiska',
		charsetJP : 'Japanska',
		charsetKR : 'Koreanska',
		charsetTR : 'Turkiska',
		charsetUN : 'Unicode (UTF-8)', // MISSING
		charsetWE : 'V"ast Europa',
		docType : 'Sidhuvud',
		docTypeOther : '"Ovriga sidhuvuden',
		xhtmlDec : 'Inkludera XHTML deklaration',
		bgColor : 'Bakgrundsf"arg',
		bgImage : 'Bakgrundsbildens URL',
		bgFixed : 'Fast bakgrund',
		txtColor : 'Textf"arg',
		margin : 'Sidmarginal',
		marginTop : 'Topp',
		marginLeft : 'V"anster',
		marginRight : 'H"oger',
		marginBottom : 'Botten',
		metaKeywords : 'Sidans nyckelord',
		metaDescription : 'Sidans beskrivning',
		metaAuthor : 'F"orfattare',
		metaCopyright : 'Upphovsr"att',
		previewHtml : '<p>This is some <strong>sample text</strong>. You are using <a href="javascript:void(0)">CKEditor</a>.</p>' // MISSING
	}
};
