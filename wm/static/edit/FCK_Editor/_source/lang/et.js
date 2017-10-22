/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Estonian language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Contains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['et'] =
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
	editorTitle : 'Vormindatud teksti redaktor %1',
	editorHelp : 'Abi saamiseks vajuta ALT 0',

	// ARIA descriptions.
	toolbars	: 'Redaktori t"o"oriistaribad',
	editor		: 'Rikkalik tekstiredaktor',

	// Toolbar buttons without dialogs.
	source			: 'L"ahtekood',
	newPage			: 'Uus leht',
	save			: 'Salvestamine',
	preview			: 'Eelvaade',
	cut				: 'L~oika',
	copy			: 'Kopeeri',
	paste			: 'Aseta',
	print			: 'Printimine',
	underline		: 'Allajoonitud',
	bold			: 'Paks',
	italic			: 'Kursiiv',
	selectAll		: 'K~oige valimine',
	removeFormat	: 'Vormingu eemaldamine',
	strike			: 'L"abijoonitud',
	subscript		: 'Allindeks',
	superscript		: '"Ulaindeks',
	horizontalrule	: 'Horisontaaljoone sisestamine',
	pagebreak		: 'Lehevahetuskoha sisestamine',
	pagebreakAlt		: 'Lehevahetuskoht',
	unlink			: 'Lingi eemaldamine',
	undo			: 'Tagasiv~otmine',
	redo			: 'Toimingu kordamine',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Serveri sirvimine',
		url				: 'URL',
		protocol		: 'Protokoll',
		upload			: 'Laadi üles',
		uploadSubmit	: 'Saada serverisse',
		image			: 'Pilt',
		flash			: 'Flash',
		form			: 'Vorm',
		checkbox		: 'M"arkeruut',
		radio			: 'Raadionupp',
		textField		: 'Tekstilahter',
		textarea		: 'Tekstiala',
		hiddenField		: 'Varjatud lahter',
		button			: 'Nupp',
		select			: 'Valiklahter',
		imageButton		: 'Piltnupp',
		notSet			: '<m"a"aramata>',
		id				: 'ID',
		name			: 'Nimi',
		langDir			: 'Keele suund',
		langDirLtr		: 'Vasakult paremale (LTR)',
		langDirRtl		: 'Paremalt vasakule (RTL)',
		langCode		: 'Keele kood',
		longDescr		: 'Pikk kirjeldus URL',
		cssClass		: 'Stiilistiku klassid',
		advisoryTitle	: 'Soovituslik pealkiri',
		cssStyle		: 'Laad',
		ok				: 'OK',
		cancel			: 'Loobu',
		close			: 'Sulge',
		preview			: 'Eelvaade',
		generalTab		: '"Uldine',
		advancedTab		: 'T"apsemalt',
		validateNumberFailed : 'See v"a"artus pole number.',
		confirmNewPage	: 'K~oik salvestamata muudatused l"ahevad kaotsi. Kas oled kindel, et tahad laadida uue lehe?',
		confirmCancel	: 'M~oned valikud on muudetud. Kas oled kindel, et tahad dialoogi sulgeda?',
		options			: 'Valikud',
		target			: 'Sihtkoht',
		targetNew		: 'Uus aken (_blank)',
		targetTop		: 'K~oige ülemine aken (_top)',
		targetSelf		: 'Sama aken (_self)',
		targetParent	: 'Vanemaken (_parent)',
		langDirLTR		: 'Vasakult paremale (LTR)',
		langDirRTL		: 'Paremalt vasakule (RTL)',
		styles			: 'Stiili',
		cssClasses		: 'Stiililehe klassid',
		width			: 'Laius',
		height			: 'K~orgus',
		align			: 'Joondus',
		alignLeft		: 'Vasak',
		alignRight		: 'Paremale',
		alignCenter		: 'Kesk',
		alignTop		: '"Ules',
		alignMiddle		: 'Keskele',
		alignBottom		: 'Alla',
		invalidValue	: 'Invalid value.', // MISSING
		invalidHeight	: 'K~orgus peab olema number.',
		invalidWidth	: 'Laius peab olema number.',
		invalidCssLength	: '"%1" v"alja jaoks m"a"aratud v"a"artus peab olema positiivne t"aisarv CSS ühikuga (px, %, in, cm, mm, em, ex, pt v~oi pc) v~oi ilma.',
		invalidHtmlLength	: '"%1" v"alja jaoks m"a"aratud v"a"artus peab olema positiivne t"aisarv HTML ühikuga (px v~oi %) v~oi ilma.',
		invalidInlineStyle	: 'Reasisese stiili m"a"arangud peavad koosnema paarisv"a"artustest (tuples), mis on semikoolonitega eraldatult j"argnevas vormingus: "nimi : v"a"artus".',
		cssLengthTooltip	: 'Sisesta v"a"artus pikslites v~oi number koos sobiva CSS-i ühikuga (px, %, in, cm, mm, em, ex, pt v~oi pc).',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, pole saadaval</span>'
	},

	contextmenu :
	{
		options : 'Kontekstimenüü valikud'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Erim"argi sisestamine',
		title		: 'Erim"argi valimine',
		options : 'Erim"arkide valikud'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Lingi lisamine/muutmine',
		other 		: '<muu>',
		menu		: 'Muuda linki',
		title		: 'Link',
		info		: 'Lingi info',
		target		: 'Sihtkoht',
		upload		: 'Lae üles',
		advanced	: 'T"apsemalt',
		type		: 'Lingi liik',
		toUrl		: 'URL',
		toAnchor	: 'Ankur sellel lehel',
		toEmail		: 'E-post',
		targetFrame		: '<raam>',
		targetPopup		: '<hüpikaken>',
		targetFrameName	: 'Sihtm"ark raami nimi',
		targetPopupName	: 'Hüpikakna nimi',
		popupFeatures	: 'Hüpikakna omadused',
		popupResizable	: 'Suurust saab muuta',
		popupStatusBar	: 'Olekuriba',
		popupLocationBar: 'Aadressiriba',
		popupToolbar	: 'T"o"oriistariba',
		popupMenuBar	: 'Menüüriba',
		popupFullScreen	: 'T"aisekraan (IE)',
		popupScrollBars	: 'Kerimisribad',
		popupDependent	: 'S~oltuv (Netscape)',
		popupLeft		: 'Vasak asukoht',
		popupTop		: '"Ulemine asukoht',
		id				: 'ID',
		langDir			: 'Keele suund',
		langDirLTR		: 'Vasakult paremale (LTR)',
		langDirRTL		: 'Paremalt vasakule (RTL)',
		acccessKey		: 'Juurdep"a"asu v~oti',
		name			: 'Nimi',
		langCode			: 'Keele suund',
		tabIndex			: 'Tab indeks',
		advisoryTitle		: 'Juhendav tiitel',
		advisoryContentType	: 'Juhendava sisu tüüp',
		cssClasses		: 'Stiilistiku klassid',
		charset			: 'Lingitud ressursi m"argistik',
		styles			: 'Laad',
		rel			: 'Suhe',
		selectAnchor		: 'Vali ankur',
		anchorName		: 'Ankru nime j"argi',
		anchorId			: 'Elemendi id j"argi',
		emailAddress		: 'E-posti aadress',
		emailSubject		: 'S~onumi teema',
		emailBody		: 'S~onumi tekst',
		noAnchors		: '(Selles dokumendis pole ankruid)',
		noUrl			: 'Palun kirjuta lingi URL',
		noEmail			: 'Palun kirjuta e-posti aadress'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Ankru sisestamine/muutmine',
		menu		: 'Ankru omadused',
		title		: 'Ankru omadused',
		name		: 'Ankru nimi',
		errorName	: 'Palun sisesta ankru nimi',
		remove		: 'Eemalda ankur'
	},

	// List style dialog
	list:
	{
		numberedTitle		: 'Numberloendi omadused',
		bulletedTitle		: 'Punktloendi omadused',
		type				: 'Liik',
		start				: 'Algus',
		validateStartNumber				:'Loendi algusnumber peab olema t"aisarv.',
		circle				: 'Ring',
		disc				: 'T"app',
		square				: 'Ruut',
		none				: 'Puudub',
		notset				: '<pole m"a"aratud>',
		armenian			: 'Armeenia numbrid',
		georgian			: 'Gruusia numbrid (an, ban, gan, jne)',
		lowerRoman			: 'V"aiksed rooma numbrid (i, ii, iii, iv, v, jne)',
		upperRoman			: 'Suured rooma numbrid (I, II, III, IV, V, jne)',
		lowerAlpha			: 'V"aiket"ahed (a, b, c, d, e, jne)',
		upperAlpha			: 'Suurt"ahed (A, B, C, D, E, jne)',
		lowerGreek			: 'Kreeka v"aiket"ahed (alpha, beta, gamma, jne)',
		decimal				: 'Numbrid (1, 2, 3, jne)',
		decimalLeadingZero	: 'Numbrid algusnulliga (01, 02, 03, jne)'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Otsimine ja asendamine',
		find				: 'Otsi',
		replace				: 'Asenda',
		findWhat			: 'Otsitav:',
		replaceWith			: 'Asendus:',
		notFoundMsg			: 'Otsitud teksti ei leitud.',
		findOptions			: 'Otsingu valikud',
		matchCase			: 'Suur- ja v"aiket"ahtede eristamine',
		matchWord			: 'Ainult terved s~onad',
		matchCyclic			: 'J"atkatakse algusest',
		replaceAll			: 'Asenda k~oik',
		replaceSuccessMsg	: '%1 vastet asendati.'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Tabel',
		title		: 'Tabeli omadused',
		menu		: 'Tabeli omadused',
		deleteTable	: 'Kustuta tabel',
		rows		: 'Read',
		columns		: 'Veerud',
		border		: 'Joone suurus',
		widthPx		: 'pikslit',
		widthPc		: 'protsenti',
		widthUnit	: 'laiuse ühik',
		cellSpace	: 'Lahtri vahe',
		cellPad		: 'Lahtri t"aidis',
		caption		: 'Tabeli tiitel',
		summary		: 'Kokkuv~ote',
		headers		: 'P"aised',
		headersNone		: 'Puudub',
		headersColumn	: 'Esimene tulp',
		headersRow		: 'Esimene rida',
		headersBoth		: 'M~olemad',
		invalidRows		: 'Ridade arv peab olema nullist suurem.',
		invalidCols		: 'Tulpade arv peab olema nullist suurem.',
		invalidBorder	: '"A"arise suurus peab olema number.',
		invalidWidth	: 'Tabeli laius peab olema number.',
		invalidHeight	: 'Tabeli k~orgus peab olema number.',
		invalidCellSpacing	: 'Lahtrite vahe peab olema positiivne arv.',
		invalidCellPadding	: 'Lahtrite polsterdus (padding) peab olema positiivne arv.',

		cell :
		{
			menu			: 'Lahter',
			insertBefore	: 'Sisesta lahter enne',
			insertAfter		: 'Sisesta lahter peale',
			deleteCell		: 'Eemalda lahtrid',
			merge			: '"Uhenda lahtrid',
			mergeRight		: '"Uhenda paremale',
			mergeDown		: '"Uhenda alla',
			splitHorizontal	: 'Poolita lahter horisontaalselt',
			splitVertical	: 'Poolita lahter vertikaalselt',
			title			: 'Lahtri omadused',
			cellType		: 'Lahtri liik',
			rowSpan			: 'Ridade vahe',
			colSpan			: 'Tulpade vahe',
			wordWrap		: 'S~onade murdmine',
			hAlign			: 'Horisontaalne joondus',
			vAlign			: 'Vertikaalne joondus',
			alignBaseline	: 'Baasjoon',
			bgColor			: 'Tausta v"arv',
			borderColor		: '"A"arise v"arv',
			data			: 'Andmed',
			header			: 'P"ais',
			yes				: 'Jah',
			no				: 'Ei',
			invalidWidth	: 'Lahtri laius peab olema number.',
			invalidHeight	: 'Lahtri k~orgus peab olema number.',
			invalidRowSpan	: 'Ridade vahe peab olema t"aisarv.',
			invalidColSpan	: 'Tulpade vahe peab olema t"aisarv.',
			chooseColor		: 'Vali'
		},

		row :
		{
			menu			: 'Rida',
			insertBefore	: 'Sisesta rida enne',
			insertAfter		: 'Sisesta rida peale',
			deleteRow		: 'Eemalda read'
		},

		column :
		{
			menu			: 'Veerg',
			insertBefore	: 'Sisesta veerg enne',
			insertAfter		: 'Sisesta veerg peale',
			deleteColumn	: 'Eemalda veerud'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Nupu omadused',
		text		: 'Tekst (v"a"artus)',
		type		: 'Liik',
		typeBtn		: 'Nupp',
		typeSbm		: 'Saada',
		typeRst		: 'L"ahtesta'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'M"arkeruudu omadused',
		radioTitle	: 'Raadionupu omadused',
		value		: 'V"a"artus',
		selected	: 'M"argitud'
	},

	// Form Dialog.
	form :
	{
		title		: 'Vormi omadused',
		menu		: 'Vormi omadused',
		action		: 'Toiming',
		method		: 'Meetod',
		encoding	: 'Kodeering'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Valiklahtri omadused',
		selectInfo	: 'Info',
		opAvail		: 'V~oimalikud valikud:',
		value		: 'V"a"artus',
		size		: 'Suurus',
		lines		: 'ridu',
		chkMulti	: 'V~oimalik mitu valikut',
		opText		: 'Tekst',
		opValue		: 'V"a"artus',
		btnAdd		: 'Lisa',
		btnModify	: 'Muuda',
		btnUp		: '"Ules',
		btnDown		: 'Alla',
		btnSetValue : 'M"a"ara vaikimisi',
		btnDelete	: 'Kustuta'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Tekstiala omadused',
		cols		: 'Veerge',
		rows		: 'Ridu'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Tekstilahtri omadused',
		name		: 'Nimi',
		value		: 'V"a"artus',
		charWidth	: 'Laius (t"ahem"arkides)',
		maxChars	: 'Maksimaalselt t"ahem"arke',
		type		: 'Liik',
		typeText	: 'Tekst',
		typePass	: 'Parool'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Varjatud lahtri omadused',
		name	: 'Nimi',
		value	: 'V"a"artus'
	},

	// Image Dialog.
	image :
	{
		title		: 'Pildi omadused',
		titleButton	: 'Piltnupu omadused',
		menu		: 'Pildi omadused',
		infoTab		: 'Pildi info',
		btnUpload	: 'Saada serverisse',
		upload		: 'Lae üles',
		alt			: 'Alternatiivne tekst',
		lockRatio	: 'Lukusta kuvasuhe',
		resetSize	: 'L"ahtesta suurus',
		border		: 'Joon',
		hSpace		: 'H. vaheruum',
		vSpace		: 'V. vaheruum',
		alertUrl	: 'Palun kirjuta pildi URL',
		linkTab		: 'Link',
		button2Img	: 'Kas tahad teisendada valitud pildiga nupu tavaliseks pildiks?',
		img2Button	: 'Kas tahad teisendada valitud tavalise pildi pildiga nupuks?',
		urlMissing	: 'Pildi l"ahte-URL on puudu.',
		validateBorder	: '"A"arise laius peab olema t"aisarv.',
		validateHSpace	: 'Horisontaalne vaheruum peab olema t"aisarv.',
		validateVSpace	: 'Vertikaalne vaheruum peab olema t"aisarv.'
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Flashi omadused',
		propertiesTab	: 'Omadused',
		title			: 'Flashi omadused',
		chkPlay			: 'Automaatne start ',
		chkLoop			: 'Korduv',
		chkMenu			: 'Flashi menüü lubatud',
		chkFull			: 'T"aisekraan lubatud',
 		scale			: 'Mastaap',
		scaleAll		: 'N"aidatakse k~oike',
		scaleNoBorder	: '"A"arist ei ole',
		scaleFit		: 'T"apne sobivus',
		access			: 'Skriptide ligip"a"as',
		accessAlways	: 'K~oigile',
		accessSameDomain: 'Samalt domeenilt',
		accessNever		: 'Mitte ühelegi',
		alignAbsBottom	: 'Abs alla',
		alignAbsMiddle	: 'Abs keskele',
		alignBaseline	: 'Baasjoonele',
		alignTextTop	: 'Tekstist üles',
		quality			: 'Kvaliteet',
		qualityBest		: 'Parim',
		qualityHigh		: 'K~orge',
		qualityAutoHigh	: 'Automaatne k~orge',
		qualityMedium	: 'Keskmine',
		qualityAutoLow	: 'Automaatne madal',
		qualityLow		: 'Madal',
		windowModeWindow: 'Aken',
		windowModeOpaque: 'L"abipaistmatu',
		windowModeTransparent : 'L"abipaistev',
		windowMode		: 'Akna reziim',
		flashvars		: 'Flashi muutujad',
		bgcolor			: 'Tausta v"arv',
		hSpace			: 'H. vaheruum',
		vSpace			: 'V. vaheruum',
		validateSrc		: 'Palun kirjuta lingi URL',
		validateHSpace	: 'H. vaheruum peab olema number.',
		validateVSpace	: 'V. vaheruum peab olema number.'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: '~Oigekirjakontroll',
		title			: '~Oigekirjakontroll',
		notAvailable	: 'Kahjuks ei ole teenus praegu saadaval.',
		errorLoading	: 'Viga rakenduse teenushosti laadimisel: %s.',
		notInDic		: 'Puudub s~onastikust',
		changeTo		: 'Muuda',
		btnIgnore		: 'Ignoreeri',
		btnIgnoreAll	: 'Ignoreeri k~oiki',
		btnReplace		: 'Asenda',
		btnReplaceAll	: 'Asenda k~oik',
		btnUndo			: 'V~ota tagasi',
		noSuggestions	: '- Soovitused puuduvad -',
		progress		: 'Toimub ~oigekirja kontroll...',
		noMispell		: '~Oigekirja kontroll sooritatud: ~oigekirjuvigu ei leitud',
		noChanges		: '~Oigekirja kontroll sooritatud: ühtegi s~ona ei muudetud',
		oneChange		: '~Oigekirja kontroll sooritatud: üks s~ona muudeti',
		manyChanges		: '~Oigekirja kontroll sooritatud: %1 s~ona muudetud',
		ieSpellDownload	: '~Oigekirja kontrollija ei ole paigaldatud. Soovid sa selle alla laadida?'
	},

	smiley :
	{
		toolbar	: 'Emotikon',
		title	: 'Sisesta emotikon',
		options : 'Emotikonide valikud'
	},

	elementsPath :
	{
		eleLabel : 'Elementide asukoht',
		eleTitle : '%1 element'
	},

	numberedlist	: 'Numberloend',
	bulletedlist	: 'Punktloend',
	indent			: 'Taande suurendamine',
	outdent			: 'Taande v"ahendamine',

	justify :
	{
		left	: 'Vasakjoondus',
		center	: 'Keskjoondus',
		right	: 'Paremjoondus',
		block	: 'R"o"opjoondus'
	},

	blockquote : 'Blokktsitaat',

	clipboard :
	{
		title		: 'Asetamine',
		cutError	: 'Sinu veebisirvija turvaseaded ei luba redaktoril automaatselt l~oigata. Palun kasutage selleks klaviatuuri klahvikombinatsiooni (Ctrl/Cmd+X).',
		copyError	: 'Sinu veebisirvija turvaseaded ei luba redaktoril automaatselt kopeerida. Palun kasutage selleks klaviatuuri klahvikombinatsiooni (Ctrl/Cmd+C).',
		pasteMsg	: 'Palun aseta tekst j"argnevasse kasti kasutades klaviatuuri klahvikombinatsiooni (<STRONG>Ctrl/Cmd+V</STRONG>) ja vajuta seej"arel <STRONG>OK</STRONG>.',
		securityMsg	: 'Sinu veebisirvija turvaseadete t~ottu ei oma redaktor otsest ligip"a"asu l~oikelaua andmetele. Sa pead asetama need uuesti siia aknasse.',
		pasteArea	: 'Asetamise ala'
	},

	pastefromword :
	{
		confirmCleanup	: 'Tekst, mida tahad asetada n"aib p"arinevat Wordist. Kas tahad selle enne asetamist puhastada?',
		toolbar			: 'Asetamine Wordist',
		title			: 'Asetamine Wordist',
		error			: 'Asetatud andmete puhastamine ei olnud sisemise vea t~ottu v~oimalik'
	},

	pasteText :
	{
		button	: 'Asetamine tavalise tekstina',
		title	: 'Asetamine tavalise tekstina'
	},

	templates :
	{
		button			: 'Mall',
		title			: 'Sisumallid',
		options : 'Malli valikud',
		insertOption	: 'Praegune sisu asendatakse',
		selectPromptMsg	: 'Palun vali mall, mis avada redaktoris<br />(praegune sisu l"aheb kaotsi):',
		emptyListMsg	: '("Uhtegi malli ei ole defineeritud)'
	},

	showBlocks : 'Blokkide n"aitamine',

	stylesCombo :
	{
		label		: 'Stiil',
		panelTitle	: 'Vormindusstiilid',
		panelTitle1	: 'Blokkstiilid',
		panelTitle2	: 'Reasisesed stiilid',
		panelTitle3	: 'Objektistiilid'
	},

	format :
	{
		label		: 'Vorming',
		panelTitle	: 'Vorming',

		tag_p		: 'Tavaline',
		tag_pre		: 'Vormindatud',
		tag_address	: 'Aadress',
		tag_h1		: 'Pealkiri 1',
		tag_h2		: 'Pealkiri 2',
		tag_h3		: 'Pealkiri 3',
		tag_h4		: 'Pealkiri 4',
		tag_h5		: 'Pealkiri 5',
		tag_h6		: 'Pealkiri 6',
		tag_div		: 'Tavaline (DIV)'
	},

	div :
	{
		title				: 'Div-konteineri loomine',
		toolbar				: 'Div-konteineri loomine',
		cssClassInputLabel	: 'Stiililehe klassid',
		styleSelectLabel	: 'Stiil',
		IdInputLabel		: 'ID',
		languageCodeInputLabel	: ' Keelekood',
		inlineStyleInputLabel	: 'Reasisene stiil',
		advisoryTitleInputLabel	: 'Soovitatav pealkiri',
		langDirLabel		: 'Keele suund',
		langDirLTRLabel		: 'Vasakult paremale (LTR)',
		langDirRTLLabel		: 'Paremalt vasakule (RTL)',
		edit				: 'Muuda Div',
		remove				: 'Eemalda Div'
  	},

	iframe :
	{
		title		: 'IFrame omadused',
		toolbar		: 'IFrame',
		noUrl		: 'Vali iframe URLi liik',
		scrolling	: 'Kerimisribade lubamine',
		border		: 'Raami "a"arise n"aitamine'
	},

	font :
	{
		label		: 'Kiri',
		voiceLabel	: 'Kiri',
		panelTitle	: 'Kiri'
	},

	fontSize :
	{
		label		: 'Suurus',
		voiceLabel	: 'Kirja suurus',
		panelTitle	: 'Suurus'
	},

	colorButton :
	{
		textColorTitle	: 'Teksti v"arv',
		bgColorTitle	: 'Tausta v"arv',
		panelTitle		: 'V"arvid',
		auto			: 'Automaatne',
		more			: 'Rohkem v"arve...'
	},

	colors :
	{
		'000' : 'Must',
		'800000' : 'Kastanpruun',
		'8B4513' : 'Sadulapruun',
		'2F4F4F' : 'Tume paehall',
		'008080' : 'Sinakasroheline',
		'000080' : 'Meresinine',
		'4B0082' : 'Indigosinine',
		'696969' : 'Tumehall',
		'B22222' : 'Samottkivi',
		'A52A2A' : 'Pruun',
		'DAA520' : 'Kuldkollane',
		'006400' : 'Tumeroheline',
		'40E0D0' : 'Türkiissinine',
		'0000CD' : 'Keskmine sinine',
		'800080' : 'Lilla',
		'808080' : 'Hall',
		'F00' : 'Punanae',
		'FF8C00' : 'Tumeoranz',
		'FFD700' : 'Kuldne',
		'008000' : 'Roheline',
		'0FF' : 'Tsüaniidsinine',
		'00F' : 'Sinine',
		'EE82EE' : 'Violetne',
		'A9A9A9' : 'Tuhm hall',
		'FFA07A' : 'Hele l~ohe',
		'FFA500' : 'Oranz',
		'FFFF00' : 'Kollane',
		'00FF00' : 'Lubja hall',
		'AFEEEE' : 'Kahvatu türkiis',
		'ADD8E6' : 'Helesinine',
		'DDA0DD' : 'Ploomililla',
		'D3D3D3' : 'Helehall',
		'FFF0F5' : 'Lavendlipunane',
		'FAEBD7' : 'Antiikvalge',
		'FFFFE0' : 'Helekollane',
		'F0FFF0' : 'Meloniroheline',
		'F0FFFF' : 'Taevasinine',
		'F0F8FF' : 'Beebisinine',
		'E6E6FA' : 'Lavendel',
		'FFF' : 'Valge'
	},

	scayt :
	{
		title			: '~Oigekirjakontroll kirjutamise ajal',
		opera_title		: 'Operas pole toetatud',
		enable			: 'SCAYT lubatud',
		disable			: 'SCAYT keelatud',
		about			: 'SCAYT-ist l"ahemalt',
		toggle			: 'SCAYT sisse/v"alja lülitamine',
		options			: 'Valikud',
		langs			: 'Keeled',
		moreSuggestions	: 'Veel soovitusi',
		ignore			: 'Eira',
		ignoreAll		: 'Eira k~oiki',
		addWord			: 'Lisa s~ona',
		emptyDic		: 'S~onaraamatu nimi ei tohi olla tühi.',

		optionsTab		: 'Valikud',
		allCaps			: 'L"abivate suurt"ahtedega s~onade eiramine',
		ignoreDomainNames : 'Domeeninimede eiramine',
		mixedCase		: 'Tavap"aratu t~ostuga s~onade eiramine',
		mixedWithDigits	: 'Numbreid sisaldavate s~onade eiramine',

		languagesTab	: 'Keeled',

		dictionariesTab	: 'S~onaraamatud',
		dic_field_name	: 'S~onaraamatu nimi',
		dic_create		: 'Loo',
		dic_restore		: 'Taasta',
		dic_delete		: 'Kustuta',
		dic_rename		: 'Nimeta ümber',
		dic_info		: 'Alguses s"ailitatakse kasutaja s~onaraamatut küpsises. Küpsise suurus on piiratud. P"arast s~onaraamatu kasvamist nii suureks, et see küpsisesse ei mahu, v~oib s~onaraamatut hoida meie serveris. Oma isikliku s~onaraamatu hoidmiseks meie serveris pead andma sellele nime. Kui sa juba oled s~onaraamatu salvestanud, sisesta selle nimi ja kl~opsa taastamise nupule.',

		aboutTab		: 'L"ahemalt'
	},

	about :
	{
		title		: 'CKEditorist',
		dlgTitle	: 'CKEditorist',
		help	: 'Abi jaoks vaata $1.',
		userGuide : 'CKEditori kasutusjuhendit',
		moreInfo	: 'Litsentsi andmed leiab meie veebilehelt:',
		copy		: 'Copyright &copy; $1. K~oik ~oigused kaitstud.'
	},

	maximize : 'Maksimeerimine',
	minimize : 'Minimeerimine',

	fakeobjects :
	{
		anchor		: 'Ankur',
		flash		: 'Flashi animatsioon',
		iframe		: 'IFrame',
		hiddenfield	: 'Varjatud v"ali',
		unknown		: 'Tundmatu objekt'
	},

	resize : 'Suuruse muutmiseks lohista',

	colordialog :
	{
		title		: 'V"arvi valimine',
		options	:	'V"arvi valikud',
		highlight	: 'N"aidis',
		selected	: 'Valitud v"arv',
		clear		: 'Eemalda'
	},

	toolbarCollapse	: 'T"o"oriistariba peitmine',
	toolbarExpand	: 'T"o"oriistariba n"aitamine',

	toolbarGroups :
	{
		document : 'Dokument',
		clipboard : 'L~oikelaud/tagasiv~otmine',
		editing : 'Muutmine',
		forms : 'Vormid',
		basicstyles : 'P~ohistiilid',
		paragraph : 'L~oik',
		links : 'Lingid',
		insert : 'Sisesta',
		styles : 'Stiilid',
		colors : 'V"arvid',
		tools : 'T"o"oriistad'
	},

	bidi :
	{
		ltr : 'Teksti suund vasakult paremale',
		rtl : 'Teksti suund paremalt vasakule'
	},

	docprops :
	{
		label : 'Dokumendi omadused',
		title : 'Dokumendi omadused',
		design : 'Disain',
		meta : 'Meta andmed',
		chooseColor : 'Vali',
		other : '<muu>',
		docTitle :	'Lehekülje tiitel',
		charset : 	'M"argistiku kodeering',
		charsetOther : '"Ulej"a"anud m"argistike kodeeringud',
		charsetASCII : 'ASCII',
		charsetCE : 'Kesk-Euroopa',
		charsetCT : 'Hiina traditsiooniline (Big5)',
		charsetCR : 'Kirillisa',
		charsetGR : 'Kreeka',
		charsetJP : 'Jaapani',
		charsetKR : 'Korea',
		charsetTR : 'Türgi',
		charsetUN : 'Unicode (UTF-8)',
		charsetWE : 'L"a"ane-Euroopa',
		docType : 'Dokumendi tüüpp"ais',
		docTypeOther : 'Teised dokumendi tüüpp"aised',
		xhtmlDec : 'Arva kaasa XHTML deklaratsioonid',
		bgColor : 'Taustav"arv',
		bgImage : 'Taustapildi URL',
		bgFixed : 'Mittekeritav tagataust',
		txtColor : 'Teksti v"arv',
		margin : 'Lehekülje "a"arised',
		marginTop : '"Ulaserv',
		marginLeft : 'Vasakserv',
		marginRight : 'Paremserv',
		marginBottom : 'Alaserv',
		metaKeywords : 'Dokumendi v~otmes~onad (eraldatud komadega)',
		metaDescription : 'Dokumendi kirjeldus',
		metaAuthor : 'Autor',
		metaCopyright : 'Autori~oigus',
		previewHtml : '<p>See on <strong>n"aidistekst</strong>. Sa kasutad <a href="javascript:void(0)">CKEditori</a>.</p>'
	}
};
