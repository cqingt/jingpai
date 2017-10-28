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
CKEDITOR.lang['ku'] =
{
	/**
	 * The language reading direction. Possible values are "rtl" for
	 * Right-To-Left languages (like Arabic) and "ltr" for Left-To-Right
	 * languages (like English).
	 * @default 'ltr'
	 */
	dir : 'rtl',

	/*
	 * Screenreader titles. Please note that screenreaders are not always capable
	 * of reading non-English words. So be careful while translating it.
	 */
	editorTitle : ' ',
	editorHelp : ' ALT  0   ',

	// ARIA descriptions.
	toolbars	: ' ',
	editor		: '  ',

	// Toolbar buttons without dialogs.
	source			: '',
	newPage			: ' ',
	save			: '',
	preview			: '',
	cut				: '',
	copy			: '',
	paste			: '',
	print			: '',
	underline		: '',
	bold			: '',
	italic			: '',
	selectAll		: ' ',
	removeFormat	: ' ',
	strike			: '',
	subscript		: '',
	superscript		: '',
	horizontalrule	: '  ',
	pagebreak		: '    ',
	pagebreakAlt		: ' ',
	unlink			: ' ',
	undo			: '',
	redo			: '',

	// Common messages and labels.
	common :
	{
		browseServer	: ' ',
		url				: ' ',
		protocol		: '',
		upload			: '',
		uploadSubmit	: '  ',
		image			: '',
		flash			: '',
		form			: '',
		checkbox		: ' ',
		radio			: ' ',
		textField		: ' ',
		textarea		: ' ',
		hiddenField		: ' ',
		button			: '',
		select			: ' ',
		imageButton		: ' ',
		notSet			: '< >',
		id				: '',
		name			: '',
		langDir			: ' ',
		langDirLtr		: '   (LTR)',
		langDirRtl		: '   (RTL)',
		langCode		: ' ',
		longDescr		: '  ',
		cssClass		: '  ',
		advisoryTitle	: ' ',
		cssStyle		: '',
		ok				: '',
		cancel			: '',
		close			: '',
		preview			: '',
		generalTab		: '',
		advancedTab		: '',
		validateNumberFailed : '       .',
		confirmNewPage	: '                  ',
		confirmCancel	: '  .     ',
		options			: '',
		target			: '',
		targetNew		: '  (_blank)',
		targetTop		: '  (_top)',
		targetSelf		: '  (_self)',
		targetParent	: '  (_parent)',
		langDirLTR		: '   (LTR)',
		langDirRTL		: '   (RTL)',
		styles			: '',
		cssClasses		: '  ',
		width			: '',
		height			: '',
		align			: '',
		alignLeft		: '',
		alignRight		: '',
		alignCenter		: '',
		alignTop		: '',
		alignMiddle		: '',
		alignBottom		: '',
		invalidValue	: ' .',
		invalidHeight	: '   .',
		invalidWidth	: '   .',
		invalidCssLength	: '     "%1"         (px, %, in, cm, mm, em, ex, pt,  pc).',
		invalidHtmlLength	: '     "%1"         HTML (px  %).',
		invalidInlineStyle	: '          " : ",  ',
		cssLengthTooltip	: '    piksel    CSS (px, %, in, cm, mm, em, ex, pt,  pc).',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">,  </span>'
	},

	contextmenu :
	{
		options : '    '
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: '  ',
		title		: '  ',
		options : '  '
	},

	// Link dialog.
	link :
	{
		toolbar		: '/ ',
		other 		: '<>',
		menu		: ' ',
		title		: '',
		info		: ' ',
		target		: '',
		upload		: '',
		advanced	: '',
		type		: ' ',
		toUrl		: ' ',
		toAnchor	: '    ',
		toEmail		: '',
		targetFrame		: '<>',
		targetPopup		: '< >',
		targetFrameName	: '  ',
		targetPopupName	: '  ',
		popupFeatures	: '  ',
		popupResizable	: '  ',
		popupStatusBar	: ' ',
		popupLocationBar: '  ',
		popupToolbar	: ' ',
		popupMenuBar	: ' ',
		popupFullScreen	: '   (IE)',
		popupScrollBars	: ' ',
		popupDependent	: ' (Netscape)',
		popupLeft		: ' ',
		popupTop		: ' ',
		id				: '',
		langDir			: ' ',
		langDirLTR		: '   (LTR)',
		langDirRTL		: '   (RTL)',
		acccessKey		: ' ',
		name			: '',
		langCode			: ' ',
		tabIndex			: '   ',
		advisoryTitle		: ' ',
		advisoryContentType	: '  ',
		cssClasses		: '  ',
		charset			: '  ',
		styles			: '',
		rel			: ' (rel)',
		selectAnchor		: ' ',
		anchorName		: '  ',
		anchorId			: '  ',
		emailAddress		: ' ',
		emailSubject		: ' ',
		emailBody		: ' ',
		noAnchors		: '(      )',
		noUrl			: '   ',
		noEmail			: '   '
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: '/ ',
		menu		: ' ',
		title		: ' ',
		name		: ' ',
		errorName	: '   ',
		remove		: ' '
	},

	// List style dialog
	list:
	{
		numberedTitle		: '  ',
		bulletedTitle		: '  ',
		type				: '',
		start				: '',
		validateStartNumber				:'      .',
		circle				: '',
		disc				: '',
		square				: '',
		none				: '',
		notset				: '<>',
		armenian			: '  ',
		georgian			: '   (an, ban, gan, .)',
		lowerRoman			: '   (i, ii, iii, iv, v, .)',
		upperRoman			: '   (I, II, III, IV, V, .)',
		lowerAlpha			: '  (a, b, c, d, e, .)',
		upperAlpha			: '  (A, B, C, D, E, .)',
		lowerGreek			: '  (alpha, beta, gamma, .)',
		decimal				: ' (1, 2, 3, .)',
		decimalLeadingZero	: '   (01, 02, 03, .)'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: '  ',
		find				: '',
		replace				: '',
		findWhat			: ' :',
		replaceWith			: ' :',
		notFoundMsg			: '   .',
		findOptions			: ' ',
		matchCase			: '    ',
		matchWord			: '  ',
		matchCyclic			: '  ',
		replaceAll			: ' ',
		replaceSuccessMsg	: ' ()  . %1'
	},

	// Table Dialog
	table :
	{
		toolbar		: '',
		title		: ' ',
		menu		: ' ',
		deleteTable	: ' ',
		rows		: '',
		columns		: '',
		border		: ' ',
		widthPx		: ' - ',
		widthPc		: '',
		widthUnit	: ' ',
		cellSpace	: ' ',
		cellPad		: ' ',
		caption		: '',
		summary		: '',
		headers		: '',
		headersNone		: '',
		headersColumn	: ' ',
		headersRow		: ' ',
		headersBoth		: '',
		invalidRows		: '      0.',
		invalidCols		: '      0.',
		invalidBorder	: '     .',
		invalidWidth	: '     .',
		invalidHeight	: '     .',
		invalidCellSpacing	: '     .',
		invalidCellPadding	: '     .',

		cell :
		{
			menu			: '',
			insertBefore	: '  ',
			insertAfter		: '  ',
			deleteCell		: ' ',
			merge			: ' ',
			mergeRight		: '  ',
			mergeDown		: '  ',
			splitHorizontal	: '  ',
			splitVertical	: '  ',
			title			: ' ',
			cellType		: ' ',
			rowSpan			: '  ',
			colSpan			: ' ',
			wordWrap		: ' ',
			hAlign			: ' ',
			vAlign			: ' ',
			alignBaseline	: '',
			bgColor			: ' ',
			borderColor		: ' ',
			data			: '',
			header			: '',
			yes				: '',
			no				: '',
			invalidWidth	: '     .',
			invalidHeight	: '     .',
			invalidRowSpan	: '      .',
			invalidColSpan	: '      .',
			chooseColor		: ''
		},

		row :
		{
			menu			: '',
			insertBefore	: '  ',
			insertAfter		: '  ',
			deleteRow		: ' '
		},

		column :
		{
			menu			: '',
			insertBefore	: '  ',
			insertAfter		: '  ',
			deleteColumn	: ' '
		}
	},

	// Button Dialog.
	button :
	{
		title		: ' ',
		text		: '() ',
		type		: '',
		typeBtn		: '',
		typeSbm		: '',
		typeRst		: ''
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : '  ',
		radioTitle	: '  ',
		value		: '',
		selected	: ''
	},

	// Form Dialog.
	form :
	{
		title		: ' ',
		menu		: ' ',
		action		: '',
		method		: '',
		encoding	: ''
	},

	// Select Field Dialog.
	select :
	{
		title		: '  ',
		selectInfo	: '',
		opAvail		: ' ',
		value		: '',
		size		: '',
		lines		: '',
		chkMulti	: '  ',
		opText		: '',
		opValue		: '',
		btnAdd		: '',
		btnModify	: '',
		btnUp		: '',
		btnDown		: '',
		btnSetValue : '   ',
		btnDelete	: ''
	},

	// Textarea Dialog.
	textarea :
	{
		title		: '  ',
		cols		: '',
		rows		: ''
	},

	// Text Field Dialog.
	textfield :
	{
		title		: '  ',
		name		: '',
		value		: '',
		charWidth	: ' ',
		maxChars	: ' ',
		type		: '',
		typeText	: '',
		typePass	: ''
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: '  ',
		name	: '',
		value	: ''
	},

	// Image Dialog.
	image :
	{
		title		: ' ',
		titleButton	: '  ',
		menu		: ' ',
		infoTab		: ' ',
		btnUpload	: '  ',
		upload		: '',
		alt			: ' ',
		lockRatio	: ' ',
		resetSize	: ' ',
		border		: '',
		hSpace		: ' ',
		vSpace		: ' ',
		alertUrl	: '    ',
		linkTab		: '',
		button2Img	: '        ',
		img2Button	: '       ',
		urlMissing	: '   ',
		validateBorder	: '     .',
		validateHSpace	: '      .',
		validateVSpace	: '      .'
	},

	// Flash Dialog
	flash :
	{
		properties		: ' ',
		propertiesTab	: '',
		title			: ' ',
		chkPlay			: '   ',
		chkLoop			: '',
		chkMenu			: '  ',
		chkFull			: '    ',
 		scale			: '',
		scaleAll		: ' ',
		scaleNoBorder	: ' ',
		scaleFit		: ' ',
		access			: ' ',
		accessAlways	: '',
		accessSameDomain: ' ',
		accessNever		: '',
		alignAbsBottom	: ' ',
		alignAbsMiddle	: '',
		alignBaseline	: '',
		alignTextTop	: ' ',
		quality			: '',
		qualityBest		: '',
		qualityHigh		: '',
		qualityAutoHigh	: ' ',
		qualityMedium	: '',
		qualityAutoLow	: ' ',
		qualityLow		: '',
		windowModeWindow: '',
		windowModeOpaque: '',
		windowModeTransparent : '',
		windowMode		: ' ',
		flashvars		: '  ',
		bgcolor			: ' ',
		hSpace			: ' ',
		vSpace			: ' ',
		validateSrc		: '    ',
		validateHSpace	: '    .',
		validateVSpace	: '    .'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: ' ',
		title			: ' ',
		notAvailable	: '    .',
		errorLoading	: '    : %s.',
		notInDic		: ' ',
		changeTo		: ' ',
		btnIgnore		: ' ',
		btnIgnoreAll	: ' ',
		btnReplace		: '',
		btnReplaceAll	: ' ',
		btnUndo			: '',
		noSuggestions	: '-   -',
		progress		: '   ...',
		noMispell		: '   :    ',
		noChanges		: '   :   ',
		oneChange		: '   :   ',
		manyChanges		: '   :  %1   ',
		ieSpellDownload	: '  .   ?'
	},

	smiley :
	{
		toolbar	: '',
		title	: ' ',
		options : ' '
	},

	elementsPath :
	{
		eleLabel : ' ',
		eleTitle : '%1 '
	},

	numberedlist	: '/  ',
	bulletedlist	: '/  ',
	indent			: ' ',
	outdent			: ' ',

	justify :
	{
		left	: '  ',
		center	: '',
		right	: '  ',
		block	: ''
	},

	blockquote : '  ',

	clipboard :
	{
		title		: '',
		cutError	: '      .         (Ctrl/Cmd+X).',
		copyError	: '       .         (Ctrl/Cmd+C).',
		pasteMsg	: '         (<STRONG>Ctrl/Cmd+V</STRONG>)    .',
		securityMsg	: '        .      .',
		pasteArea	: ' '
	},

	pastefromword :
	{
		confirmCleanup	: '      word .      ',
		toolbar			: '  Word',
		title			: '  Word',
		error			: '       '
	},

	pasteText :
	{
		button	: '   ',
		title	: '   '
	},

	templates :
	{
		button			: '',
		title			: ' ',
		options : ' ',
		insertOption	: '    ',
		selectPromptMsg	: '     :',
		emptyListMsg	: '(  )'
	},

	showBlocks : ' ',

	stylesCombo :
	{
		label		: '',
		panelTitle	: ' ',
		panelTitle1	: ' ',
		panelTitle2	: ' ',
		panelTitle3	: ' '
	},

	format :
	{
		label		: '',
		panelTitle	: ' ',

		tag_p		: '',
		tag_pre		: '',
		tag_address	: '',
		tag_h1		: ' ',
		tag_h2		: ' ',
		tag_h3		: ' ',
		tag_h4		: ' ',
		tag_h5		: ' ',
		tag_h6		: ' ',
		tag_div		: '(DIV)- '
	},

	div :
	{
		title				: '  Div',
		toolbar				: '  Div',
		cssClassInputLabel	: '  ',
		styleSelectLabel	: '',
		IdInputLabel		: '',
		languageCodeInputLabel	: ' ',
		inlineStyleInputLabel	: ' ',
		advisoryTitleInputLabel	: '',
		langDirLabel		: ' ',
		langDirLTRLabel		: '   (LTR)',
		langDirRTLLabel		: '   (RTL)',
		edit				: ' Div',
		remove				: ' Div'
  	},

	iframe :
	{
		title		: ' ',
		toolbar		: '',
		noUrl		: '     ',
		scrolling	: ' ',
		border		: '   '
	},

	font :
	{
		label		: '',
		voiceLabel	: '',
		panelTitle	: ' '
	},

	fontSize :
	{
		label		: '',
		voiceLabel	: ' ',
		panelTitle	: ' '
	},

	colorButton :
	{
		textColorTitle	: ' ',
		bgColorTitle	: ' ',
		panelTitle		: '',
		auto			: '',
		more			: ' ...'
	},

	colors :
	{
		'000' : '',
		'800000' : ' ',
		'8B4513' : '',
		'2F4F4F' : ' ',
		'008080' : ' ',
		'000080' : ' ',
		'4B0082' : ' ',
		'696969' : ' ',
		'B22222' : ' ',
		'A52A2A' : '',
		'DAA520' : ' ',
		'006400' : ' ',
		'40E0D0' : '  ',
		'0000CD' : ' ',
		'800080' : '',
		'808080' : '',
		'F00' : '',
		'FF8C00' : ' ',
		'FFD700' : '',
		'008000' : '',
		'0FF' : ' ',
		'00F' : '',
		'EE82EE' : '',
		'A9A9A9' : ' ',
		'FFA07A' : ' ',
		'FFA500' : '',
		'FFFF00' : '',
		'00FF00' : '',
		'AFEEEE' : ' ',
		'ADD8E6' : '  ',
		'DDA0DD' : ' ',
		'D3D3D3' : ' ',
		'FFF0F5' : '  ',
		'FAEBD7' : ' ',
		'FFFFE0' : ' ',
		'F0FFF0' : ' ',
		'F0FFFF' : '  ',
		'F0F8FF' : '   ',
		'E6E6FA' : '',
		'FFF' : ''
	},

	scayt :
	{
		title			: '   ',
		opera_title		: '   Opera',
		enable			: ' SCAYT',
		disable			: ' SCAYT',
		about			: ' SCAYT',
		toggle			: ' SCAYT',
		options			: '',
		langs			: '',
		moreSuggestions	: ' ',
		ignore			: '',
		ignoreAll		: ' ',
		addWord			: ' ',
		emptyDic		: '    .',

		optionsTab		: '',
		allCaps			: '    ',
		ignoreDomainNames : ' ',
		mixedCase		: '     ',
		mixedWithDigits	: '   ',

		languagesTab	: '',

		dictionariesTab	: '',
		dic_field_name	: ' ',
		dic_create		: '',
		dic_restore		: '',
		dic_delete		: '',
		dic_rename		: ' ',
		dic_info		: '       Cookie,        .                  .        ,     .     ,         .',

		aboutTab		: ''
	},

	about :
	{
		title		: ' CKEditor',
		dlgTitle	: ' CKEditor',
		help	: ' $1   .',
		userGuide : ' CKEditors',
		moreInfo	: '   ,    :',
		copy		: '  &copy; $1.  .'
	},

	maximize : ' ',
	minimize : ' ',

	fakeobjects :
	{
		anchor		: '',
		flash		: '',
		iframe		: '',
		hiddenfield	: ' ',
		unknown		: ' '
	},

	resize : '   ',

	colordialog :
	{
		title		: ' ',
		options	:	' ',
		highlight	: '',
		selected	: '',
		clear		: ''
	},

	toolbarCollapse	: '  ',
	toolbarExpand	: '  ',

	toolbarGroups :
	{
		document : '',
		clipboard : '/',
		editing : '',
		forms : '',
		basicstyles : ' ',
		paragraph : '',
		links : '',
		insert : ' ',
		styles : '',
		colors : '',
		tools : ''
	},

	bidi :
	{
		ltr : '    ',
		rtl : '    '
	},

	docprops :
	{
		label : ' ',
		title : ' ',
		design : '',
		meta : ' ',
		chooseColor : '',
		other : '...',
		docTitle :	' ',
		charset : 	'  ',
		charsetOther : '   ',
		charsetASCII : 'ASCII',
		charsetCE : ' ',
		charsetCT : '(Big5)',
		charsetCR : '',
		charsetGR : '',
		charsetJP : '',
		charsetKR : '',
		charsetTR : '',
		charsetUN : 'Unicode (UTF-8)',
		charsetWE : ' ',
		docType : '  ',
		docTypeOther : '   ',
		xhtmlDec : ' XHTML ',
		bgColor : ' ',
		bgImage : '   ',
		bgFixed : '  ()  ',
		txtColor : ' ',
		margin : ' ',
		marginTop : '',
		marginLeft : '',
		marginRight : '',
		marginBottom : '',
		metaKeywords : '  (   )',
		metaDescription : ' ',
		metaAuthor : '',
		metaCopyright : ' ',
		previewHtml : '<p>   <strong></strong>.   <a href="javascript:void(0)">CKEditor</a>.</p>'
	}
};