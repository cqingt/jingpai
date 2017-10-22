/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Bengali/Bangla language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Contains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['bn'] =
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
	source			: '',
	newPage			: ' ',
	save			: ' ',
	preview			: '',
	cut				: '',
	copy			: '',
	paste			: '',
	print			: '',
	underline		: '',
	bold			: '',
	italic			: '',
	selectAll		: '  ',
	removeFormat	: ' ',
	strike			: ' ',
	subscript		: '',
	superscript		: '',
	horizontalrule	: '  ',
	pagebreak		: ' ',
	pagebreakAlt		: 'Page Break', // MISSING
	unlink			: ' ',
	undo			: '',
	redo			: '-',

	// Common messages and labels.
	common :
	{
		browseServer	: ' ',
		url				: 'URL',
		protocol		: '',
		upload			: '',
		uploadSubmit	: '   ',
		image			: '   ',
		flash			: '   ',
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
		langDir			: '  ',
		langDirLtr		: '   (LTR)',
		langDirRtl		: '   (RTL)',
		langCode		: ' ',
		longDescr		: 'URL   ',
		cssClass		: '- ',
		advisoryTitle	: ' ',
		cssStyle		: '',
		ok				: '',
		cancel			: '',
		close			: 'Close', // MISSING
		preview			: 'Preview', // MISSING
		generalTab		: 'General', // MISSING
		advancedTab		: '',
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
		toolbar		: '   ',
		title		: '   ',
		options : 'Special Character Options' // MISSING
	},

	// Link dialog.
	link :
	{
		toolbar		: '  ',
		other 		: '<other>', // MISSING
		menu		: ' ',
		title		: '',
		info		: ' ',
		target		: '',
		upload		: '',
		advanced	: '',
		type		: ' ',
		toUrl		: 'URL', // MISSING
		toAnchor	: '   ',
		toEmail		: '',
		targetFrame		: '<>',
		targetPopup		: '< >',
		targetFrameName	: '  ',
		targetPopupName	: '  ',
		popupFeatures	: '   ',
		popupResizable	: 'Resizable', // MISSING
		popupStatusBar	: ' ',
		popupLocationBar: ' ',
		popupToolbar	: ' ',
		popupMenuBar	: ' ',
		popupFullScreen	: '   (IE)',
		popupScrollBars	: ' ',
		popupDependent	: ' (Netscape)',
		popupLeft		: ' ',
		popupTop		: ' ',
		id				: 'Id', // MISSING
		langDir			: '  ',
		langDirLTR		: '   (LTR)',
		langDirRTL		: '   (RTL)',
		acccessKey		: ' ',
		name			: '',
		langCode			: '  ',
		tabIndex			: ' ',
		advisoryTitle		: ' ',
		advisoryContentType	: '  ',
		cssClasses		: '- ',
		charset			: '   ',
		styles			: '',
		rel			: 'Relationship', // MISSING
		selectAnchor		: ' ',
		anchorName		: '  ',
		anchorId			: '  ',
		emailAddress		: ' ',
		emailSubject		: ' ',
		emailBody		: ' ',
		noAnchors		: '(No anchors available in the document)', // MISSING
		noUrl			: '  URL   ',
		noEmail			: '     '
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: '',
		menu		: ' ',
		title		: ' ',
		name		: ' ',
		errorName	: '   ',
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
		title				: 'Find and Replace', // MISSING
		find				: '',
		replace				: '',
		findWhat			: '  :',
		replaceWith			: '   :',
		notFoundMsg			: '    ',
		findOptions			: 'Find Options', // MISSING
		matchCase			: ' ',
		matchWord			: '  ',
		matchCyclic			: 'Match cyclic', // MISSING
		replaceAll			: '  ',
		replaceSuccessMsg	: '%1 occurrence(s) replaced.' // MISSING
	},

	// Table Dialog
	table :
	{
		toolbar		: '   ',
		title		: ' ',
		menu		: ' ',
		deleteTable	: '  ',
		rows		: '',
		columns		: '',
		border		: ' ',
		widthPx		: '',
		widthPc		: '',
		widthUnit	: 'width unit', // MISSING
		cellSpace	: ' ',
		cellPad		: ' ',
		caption		: '',
		summary		: '',
		headers		: 'Headers', // MISSING
		headersNone		: 'None', // MISSING
		headersColumn	: 'First column', // MISSING
		headersRow		: 'First Row', // MISSING
		headersBoth		: 'Both', // MISSING
		invalidRows		: 'Number of rows must be a number greater than 0.', // MISSING
		invalidCols		: 'Number of columns must be a number greater than 0.', // MISSING
		invalidBorder	: 'Border size must be a number.', // MISSING
		invalidWidth	: 'Table width must be a number.', // MISSING
		invalidHeight	: 'Table height must be a number.', // MISSING
		invalidCellSpacing	: 'Cell spacing must be a positive number.', // MISSING
		invalidCellPadding	: 'Cell padding must be a positive number.', // MISSING

		cell :
		{
			menu			: '',
			insertBefore	: 'Insert Cell Before', // MISSING
			insertAfter		: 'Insert Cell After', // MISSING
			deleteCell		: '  ',
			merge			: '  ',
			mergeRight		: 'Merge Right', // MISSING
			mergeDown		: 'Merge Down', // MISSING
			splitHorizontal	: 'Split Cell Horizontally', // MISSING
			splitVertical	: 'Split Cell Vertically', // MISSING
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
			menu			: '',
			insertBefore	: 'Insert Row Before', // MISSING
			insertAfter		: 'Insert Row After', // MISSING
			deleteRow		: '  '
		},

		column :
		{
			menu			: '',
			insertBefore	: 'Insert Column Before', // MISSING
			insertAfter		: 'Insert Column After', // MISSING
			deleteColumn	: '  '
		}
	},

	// Button Dialog.
	button :
	{
		title		: ' ',
		text		: ' ()',
		type		: '',
		typeBtn		: 'Button', // MISSING
		typeSbm		: 'Submit', // MISSING
		typeRst		: 'Reset' // MISSING
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
		encoding	: 'Encoding' // MISSING
	},

	// Select Field Dialog.
	select :
	{
		title		: '  ',
		selectInfo	: '',
		opAvail		: ' ',
		value		: '',
		size		: '',
		lines		: ' ',
		chkMulti	: '   ',
		opText		: '',
		opValue		: '',
		btnAdd		: '',
		btnModify	: ' ',
		btnUp		: '',
		btnDown		: '',
		btnSetValue : '     ',
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
		btnUpload	: '   ',
		upload		: '',
		alt			: ' ',
		lockRatio	: '  ',
		resetSize	: '   ',
		border		: '',
		hSpace		: ' ',
		vSpace		: ' ',
		alertUrl	: '   URL  ',
		linkTab		: '',
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
		properties		: ' ',
		propertiesTab	: 'Properties', // MISSING
		title			: ' ',
		chkPlay			: ' ',
		chkLoop			: '',
		chkMenu			: '   ',
		chkFull			: 'Allow Fullscreen', // MISSING
 		scale			: '',
		scaleAll		: ' ',
		scaleNoBorder	: '  ',
		scaleFit		: ' ',
		access			: 'Script Access', // MISSING
		accessAlways	: 'Always', // MISSING
		accessSameDomain: 'Same domain', // MISSING
		accessNever		: 'Never', // MISSING
		alignAbsBottom	: 'Abs ',
		alignAbsMiddle	: 'Abs ',
		alignBaseline	: ' ',
		alignTextTop	: ' ',
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
		bgcolor			: ' ',
		hSpace			: ' ',
		vSpace			: ' ',
		validateSrc		: '  URL   ',
		validateHSpace	: 'HSpace must be a number.', // MISSING
		validateVSpace	: 'VSpace must be a number.' // MISSING
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: ' ',
		title			: 'Spell Check', // MISSING
		notAvailable	: 'Sorry, but service is unavailable now.', // MISSING
		errorLoading	: 'Error loading application service host: %s.', // MISSING
		notInDic		: ' ',
		changeTo		: ' ',
		btnIgnore		: ' ',
		btnIgnoreAll	: '  ',
		btnReplace		: ' ',
		btnReplaceAll	: '  ',
		btnUndo			: '',
		noSuggestions	: '-    -',
		progress		: '  ...',
		noMispell		: '  :     ',
		noChanges		: '  :     ',
		oneChange		: '  :      ',
		manyChanges		: '  : %1    ',
		ieSpellDownload	: '           ?'
	},

	smiley :
	{
		toolbar	: '',
		title	: '  ',
		options : 'Smiley Options' // MISSING
	},

	elementsPath :
	{
		eleLabel : 'Elements path', // MISSING
		eleTitle : '%1 element' // MISSING
	},

	numberedlist	: '  ',
	bulletedlist	: '  ',
	indent			: ' ',
	outdent			: ' ',

	justify :
	{
		left	: '  ',
		center	: '  ',
		right	: '  ',
		block	: ' '
	},

	blockquote : 'Block Quote', // MISSING

	clipboard :
	{
		title		: '',
		cutError	: '                  (Ctrl/Cmd+X)',
		copyError	: '                  (Ctrl/Cmd+C)',
		pasteMsg	: '       (<STRONG>Ctrl/Cmd+V</STRONG>)    <STRONG>OK</STRONG>  ',
		securityMsg	: 'Because of your browser security settings, the editor is not able to access your clipboard data directly. You are required to paste it again in this window.', // MISSING
		pasteArea	: 'Paste Area' // MISSING
	},

	pastefromword :
	{
		confirmCleanup	: 'The text you want to paste seems to be copied from Word. Do you want to clean it before pasting?', // MISSING
		toolbar			: ' ()',
		title			: ' ()',
		error			: 'It was not possible to clean up the pasted data due to an internal error' // MISSING
	},

	pasteText :
	{
		button	: '    ',
		title	: '    '
	},

	templates :
	{
		button			: '',
		title			: ' ',
		options : 'Template Options', // MISSING
		insertOption	: 'Replace actual contents', // MISSING
		selectPromptMsg	: '        <br>(   ):',
		emptyListMsg	: '(    )'
	},

	showBlocks : 'Show Blocks', // MISSING

	stylesCombo :
	{
		label		: '',
		panelTitle	: 'Formatting Styles', // MISSING
		panelTitle1	: 'Block Styles', // MISSING
		panelTitle2	: 'Inline Styles', // MISSING
		panelTitle3	: 'Object Styles' // MISSING
	},

	format :
	{
		label		: ' ',
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
		voiceLabel	: 'Font', // MISSING
		panelTitle	: ''
	},

	fontSize :
	{
		label		: '',
		voiceLabel	: 'Font Size', // MISSING
		panelTitle	: ''
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
		label : ' ',
		title : ' ',
		design : 'Design', // MISSING
		meta : '',
		chooseColor : 'Choose', // MISSING
		other : '<other>',
		docTitle :	' ',
		charset : 	'  ',
		charsetOther : '   ',
		charsetASCII : 'ASCII', // MISSING
		charsetCE : 'Central European', // MISSING
		charsetCT : 'Chinese Traditional (Big5)', // MISSING
		charsetCR : 'Cyrillic', // MISSING
		charsetGR : 'Greek', // MISSING
		charsetJP : 'Japanese', // MISSING
		charsetKR : 'Korean', // MISSING
		charsetTR : 'Turkish', // MISSING
		charsetUN : 'Unicode (UTF-8)', // MISSING
		charsetWE : 'Western European', // MISSING
		docType : '  ',
		docTypeOther : '   ',
		xhtmlDec : 'XHTML   ',
		bgColor : ' ',
		bgImage : '  URL',
		bgFixed : ' ',
		txtColor : ' ',
		margin : ' ',
		marginTop : '',
		marginLeft : '',
		marginRight : '',
		marginBottom : '',
		metaKeywords : '   (  )',
		metaDescription : ' ',
		metaAuthor : '',
		metaCopyright : '',
		previewHtml : '<p>This is some <strong>sample text</strong>. You are using <a href="javascript:void(0)">CKEditor</a>.</p>' // MISSING
	}
};
