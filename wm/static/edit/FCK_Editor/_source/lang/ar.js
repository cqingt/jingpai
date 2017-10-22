/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Arabic language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Contains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['ar'] =
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
	editorTitle : 'Rich text editor, %1', // MISSING
	editorHelp : 'Press ALT 0 for help', // MISSING

	// ARIA descriptions.
	toolbars	: 'Editor toolbars', // MISSING
	editor		: 'Rich Text Editor', // MISSING

	// Toolbar buttons without dialogs.
	source			: '',
	newPage			: ' ',
	save			: '',
	preview			: ' ',
	cut				: '',
	copy			: '',
	paste			: '',
	print			: '',
	underline		: '',
	bold			: '',
	italic			: '',
	selectAll		: ' ',
	removeFormat	: ' ',
	strike			: ' ',
	subscript		: '',
	superscript		: '',
	horizontalrule	: ' ',
	pagebreak		: '  ',
	pagebreakAlt		: 'Page Break', // MISSING
	unlink			: ' ',
	undo			: '',
	redo			: '',

	// Common messages and labels.
	common :
	{
		browseServer	: '',
		url				: '',
		protocol		: '',
		upload			: '',
		uploadSubmit	: '',
		image			: '',
		flash			: '',
		form			: '',
		checkbox		: ' ',
		radio			: ' ',
		textField		: ' ',
		textarea		: ' ',
		hiddenField		: '  ',
		button			: ' ',
		select			: '',
		imageButton		: ' ',
		notSet			: '< >',
		id				: '',
		name			: '',
		langDir			: ' ',
		langDirLtr		: '  (LTR)',
		langDirRtl		: '  (RTL)',
		langCode		: ' ',
		longDescr		: ' ',
		cssClass		: ' ',
		advisoryTitle	: ' ',
		cssStyle		: '',
		ok				: '',
		cancel			: ' ',
		close			: '',
		preview			: '',
		generalTab		: '',
		advancedTab		: '',
		validateNumberFailed : ' ',
		confirmNewPage	: '       .       ',
		confirmCancel	: '   .       ',
		options			: '',
		target			: 'Target', // MISSING
		targetNew		: 'New Window (_blank)', // MISSING
		targetTop		: 'Topmost Window (_top)', // MISSING
		targetSelf		: 'Same Window (_self)', // MISSING
		targetParent	: 'Parent Window (_parent)', // MISSING
		langDirLTR		: 'Left to Right (LTR)', // MISSING
		langDirRTL		: 'Right to Left (RTL)', // MISSING
		styles			: 'Style', // MISSING
		cssClasses		: 'Stylesheet Classes', // MISSING
		width			: '',
		height			: '',
		align			: '',
		alignLeft		: '',
		alignRight		: '',
		alignCenter		: '',
		alignTop		: '',
		alignMiddle		: '',
		alignBottom		: '',
		invalidValue	: 'Invalid value.', // MISSING
		invalidHeight	: '    .',
		invalidWidth	: '    .',
		invalidCssLength	: 'Value specified for the "%1" field must be a positive number with or without a valid CSS measurement unit (px, %, in, cm, mm, em, ex, pt, or pc).', // MISSING
		invalidHtmlLength	: 'Value specified for the "%1" field must be a positive number with or without a valid HTML measurement unit (px or %).', // MISSING
		invalidInlineStyle	: 'Value specified for the inline style must consist of one or more tuples with the format of "name : value", separated by semi-colons.', // MISSING
		cssLengthTooltip	: 'Enter a number for a value in pixels or a number with a valid CSS unit (px, %, in, cm, mm, em, ex, pt, or pc).', // MISSING

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">,  </span>'
	},

	contextmenu :
	{
		options : 'Context Menu Options' // MISSING
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: '  .',
		title		: ' ',
		options : 'Special Character Options' // MISSING
	},

	// Link dialog.
	link :
	{
		toolbar		: '',
		other 		: '<>',
		menu		: ' ',
		title		: ' ',
		info		: ' ',
		target		: ' ',
		upload		: '',
		advanced	: '',
		type		: ' ',
		toUrl		: 'URL', // MISSING
		toAnchor	: '   ',
		toEmail		: ' ',
		targetFrame		: '<>',
		targetPopup		: '< >',
		targetFrameName	: '  ',
		targetPopupName	: '  ',
		popupFeatures	: '  ',
		popupResizable	: ' ',
		popupStatusBar	: ' ',
		popupLocationBar: ' ',
		popupToolbar	: ' ',
		popupMenuBar	: ' ',
		popupFullScreen	: '  (IE)',
		popupScrollBars	: ' ',
		popupDependent	: ' (Netscape)',
		popupLeft		: ' ',
		popupTop		: ' ',
		id				: '',
		langDir			: ' ',
		langDirLTR		: '  (LTR)',
		langDirRTL		: '  (RTL)',
		acccessKey		: ' ',
		name			: '',
		langCode			: ' ',
		tabIndex			: '',
		advisoryTitle		: ' ',
		advisoryContentType	: ' ',
		cssClasses		: ' ',
		charset			: '  ',
		styles			: '',
		rel			: 'Relationship', // MISSING
		selectAnchor		: '  ',
		anchorName		: ' ',
		anchorId			: '  ',
		emailAddress		: '  ',
		emailSubject		: ' ',
		emailBody		: ' ',
		noAnchors		: '(      )',
		noUrl			: '        ',
		noEmail			: '     '
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: ' ',
		menu		: '  ',
		title		: '  ',
		name		: '  ',
		errorName	: '    ',
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
		title				: ' ',
		find				: '',
		replace				: '',
		findWhat			: ' :',
		replaceWith			: ' :',
		notFoundMsg			: '     .',
		findOptions			: 'Find Options', // MISSING
		matchCase			: '  ',
		matchWord			: ' ',
		matchCyclic			: ' ',
		replaceAll			: ' ',
		replaceSuccessMsg	: '  1%   '
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
		border		: '',
		widthPx		: '',
		widthPc		: '',
		widthUnit	: 'width unit', // MISSING
		cellSpace	: ' ',
		cellPad		: ' ',
		caption		: '',
		summary		: '',
		headers		: '',
		headersNone		: '',
		headersColumn	: ' ',
		headersRow		: ' ',
		headersBoth		: '',
		invalidRows		: '        .',
		invalidCols		: '        .',
		invalidBorder	: '     .',
		invalidWidth	: '     .',
		invalidHeight	: '     .',
		invalidCellSpacing	: '      .',
		invalidCellPadding	: '     ',

		cell :
		{
			menu			: '',
			insertBefore	: '  ',
			insertAfter		: '  ',
			deleteCell		: ' ',
			merge			: ' ',
			mergeRight		: ' ',
			mergeDown		: ' ',
			splitHorizontal	: '  ',
			splitVertical	: '  ',
			title			: ' ',
			cellType		: ' ',
			rowSpan			: ' ',
			colSpan			: ' ',
			wordWrap		: ' ',
			hAlign			: ' ',
			vAlign			: ' ',
			alignBaseline	: ' ',
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
		title		: '  ',
		text		: '/',
		type		: ' ',
		typeBtn		: '',
		typeSbm		: '',
		typeRst		: ' '
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
		action		: ' ',
		method		: '',
		encoding	: ''
	},

	// Select Field Dialog.
	select :
	{
		title		: '  ',
		selectInfo	: ' ',
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
		btnSetValue : ' ',
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
		maxChars	: '  ',
		type		: ' ',
		typeText	: '',
		typePass	: ' '
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
		btnUpload	: ' ',
		upload		: '',
		alt			: ' ',
		lockRatio	: ' ',
		resetSize	: '  ',
		border		: ' ',
		hSpace		: ' ',
		vSpace		: ' ',
		alertUrl	: '       .',
		linkTab		: '',
		button2Img	: '        ',
		img2Button	: '       ',
		urlMissing	: '   ',
		validateBorder	: 'Border must be a whole number.', // MISSING
		validateHSpace	: 'HSpace must be a whole number.', // MISSING
		validateVSpace	: 'VSpace must be a whole number.' // MISSING
	},

	// Flash Dialog
	flash :
	{
		properties		: ' ',
		propertiesTab	: '',
		title			: '  ',
		chkPlay			: ' ',
		chkLoop			: '',
		chkMenu			: '   ',
		chkFull			: ' ',
 		scale			: '',
		scaleAll		: ' ',
		scaleNoBorder	: ' ',
		scaleFit		: ' ',
		access			: '  ',
		accessAlways	: '',
		accessSameDomain: ' ',
		accessNever		: '',
		alignAbsBottom	: ' ',
		alignAbsMiddle	: ' ',
		alignBaseline	: ' ',
		alignTextTop	: ' ',
		quality			: '',
		qualityBest		: '',
		qualityHigh		: '',
		qualityAutoHigh	: ' ',
		qualityMedium	: '',
		qualityAutoLow	: ' ',
		qualityLow		: '',
		windowModeWindow: '',
		windowModeOpaque: ' ',
		windowModeTransparent : '',
		windowMode		: ' ',
		flashvars		: ' ',
		bgcolor			: ' ',
		hSpace			: ' ',
		vSpace			: ' ',
		validateSrc		: '       ',
		validateHSpace	: 'HSpace    .',
		validateVSpace	: 'VSpace    .'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: ' ',
		title			: ' ',
		notAvailable	: '      ',
		errorLoading	: '     : %s.',
		notInDic		: '  ',
		changeTo		: ' ',
		btnIgnore		: '',
		btnIgnoreAll	: ' ',
		btnReplace		: '',
		btnReplaceAll	: ' ',
		btnUndo			: '',
		noSuggestions	: '-    -',
		progress		: '  ',
		noMispell		: '  :       ',
		noChanges		: '  :     ',
		oneChange		: '  :     ',
		manyChanges		: '   :   %1  ',
		ieSpellDownload	: '  ()  .    '
	},

	smiley :
	{
		toolbar	: '',
		title	: ' ',
		options : 'Smiley Options' // MISSING
	},

	elementsPath :
	{
		eleLabel : 'Elements path', // MISSING
		eleTitle : ' 1%'
	},

	numberedlist	: '/  ',
	bulletedlist	: '/  ',
	indent			: '  ',
	outdent			: '  ',

	justify :
	{
		left	: '  ',
		center	: '',
		right	: '  ',
		block	: ''
	},

	blockquote : '',

	clipboard :
	{
		title		: '',
		cutError	: '       .       (Ctrl/Cmd+X).',
		copyError	: '       .       (Ctrl/Cmd+C).',
		pasteMsg	: '     (<STRONG>Ctrl/Cmd+V</STRONG>)        <STRONG></STRONG>.',
		securityMsg	: '                      .',
		pasteArea	: 'Paste Area' // MISSING
	},

	pastefromword :
	{
		confirmCleanup	: '        .        ',
		toolbar			: '  ',
		title			: '  ',
		error			: 'It was not possible to clean up the pasted data due to an internal error' // MISSING
	},

	pasteText :
	{
		button	: '  ',
		title	: '  '
	},

	templates :
	{
		button			: '',
		title			: ' ',
		options : 'Template Options', // MISSING
		insertOption	: ' ',
		selectPromptMsg	: '      ',
		emptyListMsg	: '(    )'
	},

	showBlocks : ' ',

	stylesCombo :
	{
		label		: '',
		panelTitle	: 'Formatting Styles', // MISSING
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
		tag_h1		: ' 1',
		tag_h2		: '  2',
		tag_h3		: '  3',
		tag_h4		: '  4',
		tag_h5		: '  5',
		tag_h6		: '  6',
		tag_div		: ' (DIV)'
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
		label		: '',
		voiceLabel	: ' ',
		panelTitle	: ' '
	},

	fontSize :
	{
		label		: ' ',
		voiceLabel	: ' ',
		panelTitle	: ' '
	},

	colorButton :
	{
		textColorTitle	: ' ',
		bgColorTitle	: ' ',
		panelTitle		: 'Colors', // MISSING
		auto			: '',
		more			: ' ...'
	},

	colors :
	{
		'000' : '',
		'800000' : '',
		'8B4513' : ' ',
		'2F4F4F' : '  ',
		'008080' : ' ',
		'000080' : ' ',
		'4B0082' : '',
		'696969' : ' ',
		'B22222' : '',
		'A52A2A' : '',
		'DAA520' : ' ',
		'006400' : ' ',
		'40E0D0' : '',
		'0000CD' : ' ',
		'800080' : ' ',
		'808080' : '',
		'F00' : '',
		'FF8C00' : ' ',
		'FFD700' : '',
		'008000' : '',
		'0FF' : '',
		'00F' : '',
		'EE82EE' : '',
		'A9A9A9' : ' ',
		'FFA07A' : ' ',
		'FFA500' : '',
		'FFFF00' : '',
		'00FF00' : '',
		'AFEEEE' : ' ',
		'ADD8E6' : ' ',
		'DDA0DD' : ' ',
		'D3D3D3' : ' ',
		'FFF0F5' : ' ',
		'FAEBD7' : ' ',
		'FFFFE0' : ' ',
		'F0FFF0' : '  ',
		'F0FFFF' : '',
		'F0F8FF' : '',
		'E6E6FA' : '',
		'FFF' : ''
	},

	scayt :
	{
		title			: '   ',
		opera_title		: 'Not supported by Opera', // MISSING
		enable			: ' SCAYT',
		disable			: ' SCAYT',
		about			: ' SCAYT',
		toggle			: ' SCAYT',
		options			: '',
		langs			: '',
		moreSuggestions	: '  ',
		ignore			: '',
		ignoreAll		: ' ',
		addWord			: ' ',
		emptyDic		: '     .',

		optionsTab		: '',
		allCaps			: 'Ignore All-Caps Words', // MISSING
		ignoreDomainNames : 'Ignore Domain Names', // MISSING
		mixedCase		: 'Ignore Words with Mixed Case', // MISSING
		mixedWithDigits	: 'Ignore Words with Numbers', // MISSING

		languagesTab	: '',

		dictionariesTab	: '',
		dic_field_name	: 'Dictionary name', // MISSING
		dic_create		: 'Create', // MISSING
		dic_restore		: 'Restore', // MISSING
		dic_delete		: 'Delete', // MISSING
		dic_rename		: 'Rename', // MISSING
		dic_info		: 'Initially the User Dictionary is stored in a Cookie. However, Cookies are limited in size. When the User Dictionary grows to a point where it cannot be stored in a Cookie, then the dictionary may be stored on our server. To store your personal dictionary on our server you should specify a name for your dictionary. If you already have a stored dictionary, please type its name and click the Restore button.', // MISSING

		aboutTab		: ''
	},

	about :
	{
		title		: ' CKEditor',
		dlgTitle	: ' CKEditor',
		help	: 'Check $1 for help.', // MISSING
		userGuide : 'CKEditor User\'s Guide', // MISSING
		moreInfo	: '          :',
		copy		: '  &copy; $1.   .'
	},

	maximize : '',
	minimize : '',

	fakeobjects :
	{
		anchor		: '',
		flash		: '  ',
		iframe		: 'IFrame', // MISSING
		hiddenfield	: 'Hidden Field', // MISSING
		unknown		: '  '
	},

	resize : '  ',

	colordialog :
	{
		title		: ' ',
		options	:	'Color Options', // MISSING
		highlight	: ' ',
		selected	: '',
		clear		: ''
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
		label : ' ',
		title : ' ',
		design : 'Design', // MISSING
		meta : ' ',
		chooseColor : '',
		other : '<>',
		docTitle :	' ',
		charset : 	' ',
		charsetOther : ' ',
		charsetASCII : 'ASCII', // MISSING
		charsetCE : ' ',
		charsetCT : '  (Big5)',
		charsetCR : '',
		charsetGR : '',
		charsetJP : '',
		charsetKR : '',
		charsetTR : '',
		charsetUN : 'Unicode (UTF-8)', // MISSING
		charsetWE : ' ',
		docType : '   ',
		docTypeOther : '    ',
		xhtmlDec : '     XHTML',
		bgColor : ' ',
		bgImage : '  ',
		bgFixed : '  ',
		txtColor : ' ',
		margin : ' ',
		marginTop : '',
		marginLeft : '',
		marginRight : '',
		marginBottom : '',
		metaKeywords : '  ( )',
		metaDescription : ' ',
		metaAuthor : '',
		metaCopyright : '',
		previewHtml : '<p>This is some <strong>sample text</strong>. You are using <a href="javascript:void(0)">CKEditor</a>.</p>' // MISSING
	}
};
