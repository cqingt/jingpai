/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Vietnamese language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Contains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['vi'] =
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
	editorTitle : 'Trình son tho phong phú, %1',
	editorHelp : 'Nhn ALT + 0 d dc giúp d',

	// ARIA descriptions.
	toolbars	: 'Thanh c^ong c',
	editor		: 'B son tho',

	// Toolbar buttons without dialogs.
	source			: 'M~a HTML',
	newPage			: 'Trang mi',
	save			: 'Lu',
	preview			: 'Xem trc',
	cut				: 'Ct',
	copy			: 'Sao chép',
	paste			: 'Dán',
	print			: 'In',
	underline		: 'Gch ch^an',
	bold			: 'Dm',
	italic			: 'Nghiêng',
	selectAll		: 'Chn tt c',
	removeFormat	: 'Xoá dnh dng',
	strike			: 'Gch xuyên ngang',
	subscript		: 'Ch s di',
	superscript		: 'Ch s trên',
	horizontalrule	: 'Chèn dng ph^an cách ngang',
	pagebreak		: 'Chèn ngt trang',
	pagebreakAlt		: 'Ngt trang',
	unlink			: 'Xoá liên kt',
	undo			: 'Kh^oi phc thao tác',
	redo			: 'Làm li thao tác',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Duyt trên máy ch',
		url				: 'URL',
		protocol		: 'Giao thc',
		upload			: 'Ti lên',
		uploadSubmit	: 'Ti lên máy ch',
		image			: 'Hình nh',
		flash			: 'Flash',
		form			: 'Biu mu',
		checkbox		: 'Nút kim',
		radio			: 'Nút chn',
		textField		: 'Trng van bn',
		textarea		: 'Vùng van bn',
		hiddenField		: 'Trng n',
		button			: 'Nút',
		select			: '^O chn',
		imageButton		: 'Nút hình nh',
		notSet			: '<kh^ong thit lp>',
		id				: 'Dnh danh',
		name			: 'Tên',
		langDir			: 'Hng ng^on ng',
		langDirLtr		: 'Trái sang phi (LTR)',
		langDirRtl		: 'Phi sang trái (RTL)',
		langCode		: 'M~a ng^on ng',
		longDescr		: 'M^o t URL',
		cssClass		: 'Lp Stylesheet',
		advisoryTitle	: 'Nhan d hng dn',
		cssStyle		: 'Kiu (style)',
		ok				: 'Dng 'y',
		cancel			: 'B qua',
		close			: 'Dóng',
		preview			: 'Xem trc',
		generalTab		: 'Tab chung',
		advancedTab		: 'Tab m rng',
		validateNumberFailed : 'Giá tr này kh^ong phi là s.',
		confirmNewPage	: 'Mi thay di kh^ong dc lu li, ni dung này s b mt. Bn có chc chn mun ti mt trang mi?',
		confirmCancel	: 'Mt vài tùy chn d~a b thay di. Bn có chc chn mun dóng hp thoi?',
		options			: 'Tùy chn',
		target			: 'Dích dn',
		targetNew		: 'Ca s mi (_blank)',
		targetTop		: 'Ca s trên cùng (_top)',
		targetSelf		: 'Ti trang (_self)',
		targetParent	: 'Ca s cha (_parent)',
		langDirLTR		: 'Trái sang phi (LTR)',
		langDirRTL		: 'Phi sang trái (RTL)',
		styles			: 'Kiu',
		cssClasses		: 'Lp CSS',
		width			: 'Chiu rng',
		height			: 'chiu cao',
		align			: 'V trí',
		alignLeft		: 'Trái',
		alignRight		: 'Phi',
		alignCenter		: 'Gia',
		alignTop		: 'Trên',
		alignMiddle		: 'Gia',
		alignBottom		: 'Di',
		invalidValue	: 'Invalid value.', // MISSING
		invalidHeight	: 'Chiu cao phi là s nguyên.',
		invalidWidth	: 'Chiu rng phi là s nguyên.',
		invalidCssLength	: 'Giá tr quy dnh cho trng "%1" phi là mt s dng có hoc kh^ong có mt dn v do CSS hp l (px, %, in, cm, mm, em, ex, pt, hoc pc).',
		invalidHtmlLength	: 'Giá tr quy dnh cho trng "%1" phi là mt s dng có hoc kh^ong có mt dn v do HTML hp l (px hoc %).',
		invalidInlineStyle	: 'Giá tr quy dnh cho kiu ni tuyn phi bao gm mt hoc nhiu d liu vi dnh dng "tên:giá tr", cách nhau bng du chm phy.',
		cssLengthTooltip	: 'Nhp mt giá tr theo pixel hoc mt s vi mt dn v CSS hp l (px, %, in, cm, mm, em, ex, pt, hoc pc).',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, kh^ong có</span>'
	},

	contextmenu :
	{
		options : 'Tùy chn menu b xung'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Chèn k'y t dc bit',
		title		: 'H~ay chn k'y t dc bit',
		options : 'Tùy chn các k'y t dc bit'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Chèn/Sa liên kt',
		other 		: '<khác>',
		menu		: 'Sa liên kt',
		title		: 'Liên kt',
		info		: 'Th^ong tin liên kt',
		target		: 'Dích',
		upload		: 'Ti lên',
		advanced	: 'M rng',
		type		: 'Kiu liên kt',
		toUrl		: 'URL',
		toAnchor	: 'Neo trong trang này',
		toEmail		: 'Th din t',
		targetFrame		: '<khung>',
		targetPopup		: '<ca s popup>',
		targetFrameName	: 'Tên khung dích',
		targetPopupName	: 'Tên ca s Popup',
		popupFeatures	: 'Dc dim ca ca s Popup',
		popupResizable	: 'Có th thay di kích c',
		popupStatusBar	: 'Thanh trng thái',
		popupLocationBar: 'Thanh v trí',
		popupToolbar	: 'Thanh c^ong c',
		popupMenuBar	: 'Thanh Menu',
		popupFullScreen	: 'Toàn màn hình (IE)',
		popupScrollBars	: 'Thanh cun',
		popupDependent	: 'Ph thuc (Netscape)',
		popupLeft		: 'V trí bên trái',
		popupTop		: 'V trí phía trên',
		id				: 'Dnh danh',
		langDir			: 'Hng ng^on ng',
		langDirLTR		: 'Trái sang phi (LTR)',
		langDirRTL		: 'Phi sang trái (RTL)',
		acccessKey		: 'Phím h tr truy cp',
		name			: 'Tên',
		langCode			: 'M~a ng^on ng',
		tabIndex			: 'Ch s ca Tab',
		advisoryTitle		: 'Nhan d hng dn',
		advisoryContentType	: 'Ni dung hng dn',
		cssClasses		: 'Lp Stylesheet',
		charset			: 'Bng m~a ca tài nguyên dc liên kt dn',
		styles			: 'Kiu (style)',
		rel			: 'Quan h',
		selectAnchor		: 'Chn mt dim neo',
		anchorName		: 'Theo tên dim neo',
		anchorId			: 'Theo dnh danh thành phn',
		emailAddress		: 'Th din t',
		emailSubject		: 'Tiêu d th^ong dip',
		emailBody		: 'Ni dung th^ong dip',
		noAnchors		: '(Kh^ong có dim neo nào trong tài liu)',
		noUrl			: 'H~ay da vào dng dn liên kt (URL)',
		noEmail			: 'H~ay da vào da ch th din t'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Chèn/Sa dim neo',
		menu		: 'Thuc tính dim neo',
		title		: 'Thuc tính dim neo',
		name		: 'Tên ca dim neo',
		errorName	: 'H~ay nhp vào tên ca dim neo',
		remove		: 'Xóa neo'
	},

	// List style dialog
	list:
	{
		numberedTitle		: 'Thuc tính danh sách có th t',
		bulletedTitle		: 'Thuc tính danh sách kh^ong th t',
		type				: 'Kiu loi',
		start				: 'Bt du',
		validateStartNumber				:'S bt du danh sách phi là mt s nguyên.',
		circle				: 'Khuyên tròn',
		disc				: 'Hình d~ia',
		square				: 'Hình vu^ong',
		none				: 'Kh^ong gì c',
		notset				: '<kh^ong thit lp>',
		armenian			: 'S theo kiu Armenian',
		georgian			: 'S theo kiu Georgian (an, ban, gan...)',
		lowerRoman			: 'S La M~a kiu thng (i, ii, iii, iv, v...)',
		upperRoman			: 'S La M~a kiu HOA (I, II, III, IV, V...)',
		lowerAlpha			: 'Kiu abc thng (a, b, c, d, e...)',
		upperAlpha			: 'Kiu ABC HOA (A, B, C, D, E...)',
		lowerGreek			: 'Kiu Hy Lp (alpha, beta, gamma...)',
		decimal				: 'Kiu s (1, 2, 3 ...)',
		decimalLeadingZero	: 'Kiu s (01, 02, 03...)'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Tìm kim và thay th',
		find				: 'Tìm kim',
		replace				: 'Thay th',
		findWhat			: 'Tìm chui:',
		replaceWith			: 'Thay bng:',
		notFoundMsg			: 'Kh^ong tìm thy chui cn tìm.',
		findOptions			: 'Tìm tùy chn',
		matchCase			: 'Ph^an bit ch hoa/thng',
		matchWord			: 'Ging toàn b t',
		matchCyclic			: 'Ging mt phn',
		replaceAll			: 'Thay th tt c',
		replaceSuccessMsg	: '%1 v trí d~a dc thay th.'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Bng',
		title		: 'Thuc tính bng',
		menu		: 'Thuc tính bng',
		deleteTable	: 'Xóa bng',
		rows		: 'S hàng',
		columns		: 'S ct',
		border		: 'Kích thc dng vin',
		widthPx		: 'Dim nh (px)',
		widthPc		: 'Phn tram (%)',
		widthUnit	: 'Dn v',
		cellSpace	: 'Khong cách gia các ^o',
		cellPad		: 'Khong dm gi ^o và ni dung',
		caption		: 'Du d',
		summary		: 'Tóm lc',
		headers		: 'Du d',
		headersNone		: 'Kh^ong có',
		headersColumn	: 'Ct du tiên',
		headersRow		: 'Hàng du tiên',
		headersBoth		: 'C hai',
		invalidRows		: 'S lng hàng phi là mt s ln hn 0.',
		invalidCols		: 'S lng ct phi là mt s ln hn 0.',
		invalidBorder	: 'Kích c ca dng biên phi là mt s nguyên.',
		invalidWidth	: 'Chiu rng ca bng phi là mt s nguyên.',
		invalidHeight	: 'Chiu cao ca bng phi là mt s nguyên.',
		invalidCellSpacing	: 'Khong cách gia các ^o phi là mt s nguyên.',
		invalidCellPadding	: 'Khong dm gia ^o và ni dung phi là mt s nguyên.',

		cell :
		{
			menu			: '^O',
			insertBefore	: 'Chèn ^o Phía trc',
			insertAfter		: 'Chèn ^o Phía sau',
			deleteCell		: 'Xoá ^o',
			merge			: 'Kt hp ^o',
			mergeRight		: 'Kt hp sang phi',
			mergeDown		: 'Kt hp xung di',
			splitHorizontal	: 'Ph^an tách ^o theo chiu ngang',
			splitVertical	: 'Ph^an tách ^o theo chiu dc',
			title			: 'Thuc tính ca ^o',
			cellType		: 'Kiu ca ^o',
			rowSpan			: 'Kt hp hàng',
			colSpan			: 'Kt hp ct',
			wordWrap		: 'Ch lin hàng',
			hAlign			: 'Canh l ngang',
			vAlign			: 'Canh l dc',
			alignBaseline	: 'Dng c s',
			bgColor			: 'Màu nn',
			borderColor		: 'Màu vin',
			data			: 'D liu',
			header			: 'Du d',
			yes				: 'Có',
			no				: 'Kh^ong',
			invalidWidth	: 'Chiu rng ca ^o phi là mt s nguyên.',
			invalidHeight	: 'Chiu cao ca ^o phi là mt s nguyên.',
			invalidRowSpan	: 'S hàng kt hp phi là mt s nguyên.',
			invalidColSpan	: 'S ct kt hp phi là mt s nguyên.',
			chooseColor		: 'Chn màu'
		},

		row :
		{
			menu			: 'Hàng',
			insertBefore	: 'Chèn hàng phía trc',
			insertAfter		: 'Chèn hàng phía sau',
			deleteRow		: 'Xoá hàng'
		},

		column :
		{
			menu			: 'Ct',
			insertBefore	: 'Chèn ct phía trc',
			insertAfter		: 'Chèn ct phía sau',
			deleteColumn	: 'Xoá ct'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Thuc tính ca nút',
		text		: 'Chui hin th (giá tr)',
		type		: 'Kiu',
		typeBtn		: 'Nút bm',
		typeSbm		: 'Nút gi',
		typeRst		: 'Nút nhp li'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Thuc tính nút kim',
		radioTitle	: 'Thuc tính nút chn',
		value		: 'Giá tr',
		selected	: 'Dc chn'
	},

	// Form Dialog.
	form :
	{
		title		: 'Thuc tính biu mu',
		menu		: 'Thuc tính biu mu',
		action		: 'Hành dng',
		method		: 'Phng thc',
		encoding	: 'Bng m~a'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Thuc tính ^o chn',
		selectInfo	: 'Th^ong tin',
		opAvail		: 'Các tùy chn có th s dng',
		value		: 'Giá tr',
		size		: 'Kích c',
		lines		: 'dòng',
		chkMulti	: 'Cho phép chn nhiu',
		opText		: 'Van bn',
		opValue		: 'Giá tr',
		btnAdd		: 'Thêm',
		btnModify	: 'Thay di',
		btnUp		: 'Lên',
		btnDown		: 'Xung',
		btnSetValue : 'Giá tr dc chn',
		btnDelete	: 'Nút xoá'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Thuc tính vùng van bn',
		cols		: 'S ct',
		rows		: 'S hàng'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Thuc tính trng van bn',
		name		: 'Tên',
		value		: 'Giá tr',
		charWidth	: 'D rng ca k'y t',
		maxChars	: 'S k'y t ti da',
		type		: 'Kiu',
		typeText	: 'K'y t',
		typePass	: 'Mt khu'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Thuc tính trng n',
		name	: 'Tên',
		value	: 'Giá tr'
	},

	// Image Dialog.
	image :
	{
		title		: 'Thuc tính ca nh',
		titleButton	: 'Thuc tính nút ca nh',
		menu		: 'Thuc tính ca nh',
		infoTab		: 'Th^ong tin ca nh',
		btnUpload	: 'Ti lên máy ch',
		upload		: 'Ti lên',
		alt			: 'Chú thích nh',
		lockRatio	: 'Gi nguyên t l',
		resetSize	: 'Kích thc gc',
		border		: 'Dng vin',
		hSpace		: 'Khong dm ngang',
		vSpace		: 'Khong dm dc',
		alertUrl	: 'H~ay da vào dng dn ca nh',
		linkTab		: 'Tab liên kt',
		button2Img	: 'Bn có mun chuyn nút bm bng nh dc chn thành nh?',
		img2Button	: 'Bn có mun chuyn di nh dc chn thành nút bm bng nh?',
		urlMissing	: 'Thiu dng dn hình nh',
		validateBorder	: 'Chiu rng ca dng vin phi là mt s nguyên dng',
		validateHSpace	: 'Khong dm ngang phi là mt s nguyên dng',
		validateVSpace	: 'Khong dm dc phi là mt s nguyên dng'
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Thuc tính Flash',
		propertiesTab	: 'Thuc tính',
		title			: 'Thuc tính Flash',
		chkPlay			: 'T dng chy',
		chkLoop			: 'Lp',
		chkMenu			: 'Cho phép bt menu ca Flash',
		chkFull			: 'Cho phép toàn màn hình',
 		scale			: 'T l',
		scaleAll		: 'Hin th tt c',
		scaleNoBorder	: 'Kh^ong dng vin',
		scaleFit		: 'Va vn',
		access			: 'Truy cp m~a',
		accessAlways	: 'Lu^on lu^on',
		accessSameDomain: 'Cùng tên min',
		accessNever		: 'Kh^ong bao gi',
		alignAbsBottom	: 'Di tuyt di',
		alignAbsMiddle	: 'Gia tuyt di',
		alignBaseline	: 'Dng c s',
		alignTextTop	: 'Phía trên ch',
		quality			: 'Cht lng',
		qualityBest		: 'Tt nht',
		qualityHigh		: 'Cao',
		qualityAutoHigh	: 'Cao t dng',
		qualityMedium	: 'Trung bình',
		qualityAutoLow	: 'Thp t dng',
		qualityLow		: 'Thp',
		windowModeWindow: 'Ca s',
		windowModeOpaque: 'M dc',
		windowModeTransparent : 'Trong sut',
		windowMode		: 'Ch d ca s',
		flashvars		: 'Các bin s dành cho Flash',
		bgcolor			: 'Màu nn',
		hSpace			: 'Khong dm ngang',
		vSpace			: 'Khong dm dc',
		validateSrc		: 'H~ay da vào dng dn liên kt',
		validateHSpace	: 'Khong dm ngang phi là s nguyên.',
		validateVSpace	: 'Khong dm dc phi là s nguyên.'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Kim tra chính t',
		title			: 'Kim tra chính t',
		notAvailable	: 'Xin li, dch v này hin ti kh^ong có.',
		errorLoading	: 'Li khi dang np dch v ng dng: %s.',
		notInDic		: 'Kh^ong có trong t din',
		changeTo		: 'Chuyn thành',
		btnIgnore		: 'B qua',
		btnIgnoreAll	: 'B qua tt c',
		btnReplace		: 'Thay th',
		btnReplaceAll	: 'Thay th tt c',
		btnUndo			: 'Phc hi li',
		noSuggestions	: '- Kh^ong da ra gi 'y v t -',
		progress		: 'Dang tin hành kim tra chính t...',
		noMispell		: 'Hoàn tt kim tra chính t: Kh^ong có li chính t',
		noChanges		: 'Hoàn tt kim tra chính t: Kh^ong có t nào dc thay di',
		oneChange		: 'Hoàn tt kim tra chính t: Mt t d~a dc thay di',
		manyChanges		: 'Hoàn tt kim tra chính t: %1 t d~a dc thay di',
		ieSpellDownload	: 'Chc nang kim tra chính t cha dc cài dt. Bn có mun ti v ngay b^ay gi?'
	},

	smiley :
	{
		toolbar	: 'Hình biu l cm xúc (mt ci)',
		title	: 'Chèn hình biu l cm xúc (mt ci)',
		options : 'Tùy chn hình  biu l cm xúc'
	},

	elementsPath :
	{
		eleLabel : 'Nh~an thành phn',
		eleTitle : '%1 thành phn'
	},

	numberedlist	: 'Chèn/Xoá Danh sách có th t',
	bulletedlist	: 'Chèn/Xoá Danh sách kh^ong th t',
	indent			: 'Dch vào trong',
	outdent			: 'Dch ra ngoài',

	justify :
	{
		left	: 'Canh trái',
		center	: 'Canh gia',
		right	: 'Canh phi',
		block	: 'Canh du'
	},

	blockquote : 'Khi trích dn',

	clipboard :
	{
		title		: 'Dán',
		cutError	: 'Các thit lp bo mt ca trình duyt kh^ong cho phép trình biên tp t dng thc thi lnh ct. H~ay s dng bàn phím cho lnh này (Ctrl/Cmd+X).',
		copyError	: 'Các thit lp bo mt ca trình duyt kh^ong cho phép trình biên tp t dng thc thi lnh sao chép. H~ay s dng bàn phím cho lnh này (Ctrl/Cmd+C).',
		pasteMsg	: 'H~ay dán ni dung vào trong khung bên di, s dng t hp phím (<STRONG>Ctrl/Cmd+V</STRONG>) và nhn vào nút <STRONG>Dng 'y</STRONG>.',
		securityMsg	: 'Do thit lp bo mt ca trình duyt nên trình biên tp kh^ong th truy cp trc tip vào ni dung d~a sao chép. Bn cn phi dán li ni dung vào ca s này.',
		pasteArea	: 'Khu vc dán'
	},

	pastefromword :
	{
		confirmCleanup	: 'Van bn bn mun dán có kèm dnh dng ca Word. Bn có mun loi b dnh dng Word trc khi dán?',
		toolbar			: 'Dán vi dnh dng Word',
		title			: 'Dán vi dnh dng Word',
		error			: 'Kh^ong th d làm sch các d liu dán do mt li ni b'
	},

	pasteText :
	{
		button	: 'Dán theo dnh dng van bn thun',
		title	: 'Dán theo dnh dng van bn thun'
	},

	templates :
	{
		button			: 'Mu dng sn',
		title			: 'Ni dung Mu dng sn',
		options : 'Tùy chn mu dng sn',
		insertOption	: 'Thay th ni dung hin ti',
		selectPromptMsg	: 'H~ay chn mu dng sn d m trong trình biên tp<br>(ni dung hin ti s b mt):',
		emptyListMsg	: '(Kh^ong có mu dng sn nào dc dnh ngh~ia)'
	},

	showBlocks : 'Hin th các khi',

	stylesCombo :
	{
		label		: 'Kiu',
		panelTitle	: 'Phong cách dnh dng',
		panelTitle1	: 'Kiu khi',
		panelTitle2	: 'Kiu trc tip',
		panelTitle3	: 'Kiu di tng'
	},

	format :
	{
		label		: 'Dnh dng',
		panelTitle	: 'Dnh dng',

		tag_p		: 'Bình thng (P)',
		tag_pre		: 'D~a thit lp',
		tag_address	: 'Address',
		tag_h1		: 'Heading 1',
		tag_h2		: 'Heading 2',
		tag_h3		: 'Heading 3',
		tag_h4		: 'Heading 4',
		tag_h5		: 'Heading 5',
		tag_h6		: 'Heading 6',
		tag_div		: 'Bình thng (DIV)'
	},

	div :
	{
		title				: 'To khi các thành phn',
		toolbar				: 'To khi các thành phn',
		cssClassInputLabel	: 'Các lp CSS',
		styleSelectLabel	: 'Kiu (style)',
		IdInputLabel		: 'Dnh danh (id)',
		languageCodeInputLabel	: 'M~a ng^on ng',
		inlineStyleInputLabel	: 'Kiu ni dòng',
		advisoryTitleInputLabel	: 'Nhan d hng dn',
		langDirLabel		: 'Hng ng^on ng',
		langDirLTRLabel		: 'Trái sang phi (LTR)',
		langDirRTLLabel		: 'Phi qua trái (RTL)',
		edit				: 'Chnh sa',
		remove				: 'Xóa b'
  	},

	iframe :
	{
		title		: 'Thuc tính iframe',
		toolbar		: 'Iframe',
		noUrl		: 'Vui lòng nhp da ch iframe',
		scrolling	: 'Kích hot thanh cun',
		border		: 'Hin th vin khung'
	},

	font :
	{
		label		: 'Ph^ong',
		voiceLabel	: 'Ph^ong',
		panelTitle	: 'Ph^ong'
	},

	fontSize :
	{
		label		: 'C ch',
		voiceLabel	: 'Kích c ph^ong',
		panelTitle	: 'C ch'
	},

	colorButton :
	{
		textColorTitle	: 'Màu ch',
		bgColorTitle	: 'Màu nn',
		panelTitle		: 'Màu sc',
		auto			: 'T dng',
		more			: 'Màu khác...'
	},

	colors :
	{
		'000' : 'Den',
		'800000' : 'Maroon',
		'8B4513' : 'Saddle Brown',
		'2F4F4F' : 'Dark Slate Gray',
		'008080' : 'Teal',
		'000080' : 'Navy',
		'4B0082' : 'Indigo',
		'696969' : 'Dark Gray',
		'B22222' : 'Fire Brick',
		'A52A2A' : 'N^au',
		'DAA520' : 'Golden Rod',
		'006400' : 'Dark Green',
		'40E0D0' : 'Turquoise',
		'0000CD' : 'Medium Blue',
		'800080' : 'Purple',
		'808080' : 'Xám',
		'F00' : 'D',
		'FF8C00' : 'Dark Orange',
		'FFD700' : 'Vàng',
		'008000' : 'Xanh lá c^ay',
		'0FF' : 'Cyan',
		'00F' : 'Xanh da tri',
		'EE82EE' : 'Tím',
		'A9A9A9' : 'Xám ti',
		'FFA07A' : 'Light Salmon',
		'FFA500' : 'Màu cam',
		'FFFF00' : 'Vàng',
		'00FF00' : 'Lime',
		'AFEEEE' : 'Pale Turquoise',
		'ADD8E6' : 'Light Blue',
		'DDA0DD' : 'Plum',
		'D3D3D3' : 'Light Grey',
		'FFF0F5' : 'Lavender Blush',
		'FAEBD7' : 'Antique White',
		'FFFFE0' : 'Light Yellow',
		'F0FFF0' : 'Honeydew',
		'F0FFFF' : 'Azure',
		'F0F8FF' : 'Alice Blue',
		'E6E6FA' : 'Lavender',
		'FFF' : 'Trng'
	},

	scayt :
	{
		title			: 'Kim tra chính t ngay khi g~o ch (SCAYT)',
		opera_title		: 'Kh^ong h tr trên trình duyt Opera',
		enable			: 'Bt SCAYT',
		disable			: 'Tt SCAYT',
		about			: 'Th^ong tin v SCAYT',
		toggle			: 'Bt tt SCAYT',
		options			: 'Tùy chn',
		langs			: 'Ng^on ng',
		moreSuggestions	: 'D xut thêm',
		ignore			: 'B qua',
		ignoreAll		: 'B qua tt c',
		addWord			: 'Thêm t',
		emptyDic		: 'Tên ca t din kh^ong dc d trng.',

		optionsTab		: 'Tùy chn',
		allCaps			: 'Kh^ong ph^an bit ch HOA ch thng',
		ignoreDomainNames : 'B qua tên min',
		mixedCase		: 'Kh^ong ph^an bit loi ch',
		mixedWithDigits	: 'Kh^ong ph^an bit ch và s',

		languagesTab	: 'Tab ng^on ng',

		dictionariesTab	: 'T din',
		dic_field_name	: 'Tên t din',
		dic_create		: 'To',
		dic_restore		: 'Phc hi',
		dic_delete		: 'Xóa',
		dic_rename		: 'Thay tên',
		dic_info		: 'Ban du, t din ngi dùng dc lu tr trong mt cookie. Tuy nhiên, kích thc cookie b gii hn. Khi ngi s dng t din phát trin dn dim kh^ong th dc lu tr trong cookie, t din s dc lu tr trên máy ch ca chúng t^oi. D lu tr t din cá nh^an ca bn trên máy ch ca chúng t^oi, bn nên xác dnh mt tên cho t din ca bn. Nu bn d~a có mt cun t din dc lu tr, xin vui lòng g~o tên ca nó và nhn vào nút Kh^oi phc.',

		aboutTab		: 'Th^ong tin'
	},

	about :
	{
		title		: 'Th^ong tin v CKEditor',
		dlgTitle	: 'Th^ong tin v CKEditor',
		help	: 'Kim tra $1 d dc giúp d.',
		userGuide : 'Hng dn s dng CKEditor',
		moreInfo	: 'Vui lòng ghé tham trang web ca chúng t^oi d có th^ong tin v giy phép:',
		copy		: 'Bn quyn &copy; $1. Gi toàn quyn.'
	},

	maximize : 'Phóng to ti da',
	minimize : 'Thu nh',

	fakeobjects :
	{
		anchor		: 'Dim neo',
		flash		: 'Flash',
		iframe		: 'IFrame',
		hiddenfield	: 'Trng n',
		unknown		: 'Di tng kh^ong r~o ràng'
	},

	resize : 'Kéo rê d thay di kích c',

	colordialog :
	{
		title		: 'Chn màu',
		options	:	'Tùy chn màu',
		highlight	: 'Màu chn',
		selected	: 'Màu d~a chn',
		clear		: 'Xóa b'
	},

	toolbarCollapse	: 'Thu gn thanh c^ong c',
	toolbarExpand	: 'M rng thnah c^ong c',

	toolbarGroups :
	{
		document : 'Tài liu',
		clipboard : 'Clipboard/Undo',
		editing : 'Chnh sa',
		forms : 'Bng biu',
		basicstyles : 'Kiu c bn',
		paragraph : 'Don',
		links : 'Liên kt',
		insert : 'Chèn',
		styles : 'Kiu',
		colors : 'Màu sc',
		tools : 'C^ong c'
	},

	bidi :
	{
		ltr : 'Van bn hng t trái sang phi',
		rtl : 'Van bn hng t phi sang trái'
	},

	docprops :
	{
		label : 'Thuc tính Tài liu',
		title : 'Thuc tính Tài liu',
		design : 'Thit k',
		meta : 'Siêu d liu',
		chooseColor : 'Chn màu',
		other : '<khác>',
		docTitle :	'Tiêu d Trang',
		charset : 	'Bng m~a k'y t',
		charsetOther : 'Bng m~a k'y t khác',
		charsetASCII : 'ASCII',
		charsetCE : 'Trung ^Au',
		charsetCT : 'Ting Trung Quc (Big5)',
		charsetCR : 'Ting Kirin',
		charsetGR : 'Ting Hy Lp',
		charsetJP : 'Ting Nht',
		charsetKR : 'Ting Hàn',
		charsetTR : 'Ting Th Nh~i K`y',
		charsetUN : 'Unicode (UTF-8)',
		charsetWE : 'T^ay ^Au',
		docType : 'Kiu D mc Tài liu',
		docTypeOther : 'Kiu D mc Tài liu khác',
		xhtmlDec : 'Bao gm c dnh ngh~ia XHTML',
		bgColor : 'Màu nn',
		bgImage : 'URL ca Hình nh nn',
		bgFixed : 'Kh^ong cun nn',
		txtColor : 'Màu ch',
		margin : 'Dng biên ca Trang',
		marginTop : 'Trên',
		marginLeft : 'Trái',
		marginRight : 'Phi',
		marginBottom : 'Di',
		metaKeywords : 'Các t khóa ch mc tài liu (ph^an cách bi du phy)',
		metaDescription : 'M^o t tài liu',
		metaAuthor : 'Tác gi',
		metaCopyright : 'Bn quyn',
		previewHtml : '<p>D^ay là mt s <strong>van bn mu</strong>. Bn dang s dng <a href="javascript:void(0)">CKEditor</a>.</p>'
	}
};
