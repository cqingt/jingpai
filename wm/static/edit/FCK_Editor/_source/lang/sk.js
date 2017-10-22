/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Slovak language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Contains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['sk'] =
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
	editorTitle : 'Editor formátovaného textu, %1',
	editorHelp : 'Stlacte ALT 0 pre nápovedu',

	// ARIA descriptions.
	toolbars	: 'Listy nástrojov editora',
	editor		: 'Editor formátovaného textu',

	// Toolbar buttons without dialogs.
	source			: 'Zdroj',
	newPage			: 'Nová stránka',
	save			: 'Ulozit',
	preview			: 'Náhlad',
	cut				: 'Vystrihnút',
	copy			: 'Kopírovat',
	paste			: 'Vlozit',
	print			: 'Tlac',
	underline		: 'Podciarknuté',
	bold			: 'Tucné',
	italic			: 'Kurzíva',
	selectAll		: 'Vybrat vsetko',
	removeFormat	: 'Odstránit formátovanie',
	strike			: 'Preciarknuté',
	subscript		: 'Doln'y index',
	superscript		: 'Horn'y index',
	horizontalrule	: 'Vlozit vodorovnú ciaru',
	pagebreak		: 'Vlozit oddelovac stránky pre tlac',
	pagebreakAlt		: 'Zalomenie strany',
	unlink			: 'Odstránit odkaz',
	undo			: 'Sp"at',
	redo			: 'Znovu',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Prechádzat server',
		url				: 'URL',
		protocol		: 'Protokol',
		upload			: 'Nahrat',
		uploadSubmit	: 'Odoslat to na server',
		image			: 'Obrázok',
		flash			: 'Flash',
		form			: 'Formulár',
		checkbox		: 'Zaskrtávacie polícko',
		radio			: 'Prepínac',
		textField		: 'Textové pole',
		textarea		: 'Textová oblast',
		hiddenField		: 'Skryté pole',
		button			: 'Tlacidlo',
		select			: 'Rozbalovací zoznam',
		imageButton		: 'Obrázkové tlacidlo',
		notSet			: '<nenastavené>',
		id				: 'Id',
		name			: 'Meno',
		langDir			: 'Orientácia jazyka',
		langDirLtr		: 'Zlava doprava (LTR)',
		langDirRtl		: 'Sprava dolava (RTL)',
		langCode		: 'Kód jazyka',
		longDescr		: 'Dlh'y popis URL',
		cssClass		: 'Triedy st'ylu',
		advisoryTitle	: 'Pomocn'y titulok',
		cssStyle		: 'St'yl',
		ok				: 'OK',
		cancel			: 'Zrusit',
		close			: 'Zatvorit',
		preview			: 'Náhlad',
		generalTab		: 'Hlavné',
		advancedTab		: 'Rozsírené',
		validateNumberFailed : 'Hodnota nieje císlo.',
		confirmNewPage	: 'Vsetky neulozené zmeny v tomto obsahu budú stratené. Ste si ist'y, ze chcete nacítat novú stránku?',
		confirmCancel	: 'Niektore moznosti boli zmenené. Naozaj chcete zavriet okno?',
		options			: 'Moznosti',
		target			: 'Ciel',
		targetNew		: 'Nové okno (_blank)',
		targetTop		: 'Najvrchnejsie okno (_top)',
		targetSelf		: 'To isté okno (_self)',
		targetParent	: 'Rodicovské okno (_parent)',
		langDirLTR		: 'Zlava doprava (LTR)',
		langDirRTL		: 'Sprava dolava (RTL)',
		styles			: 'St'yl',
		cssClasses		: 'Triedy st'ylu',
		width			: 'Sírka',
		height			: 'V'yska',
		align			: 'Zarovnanie',
		alignLeft		: 'Vlavo',
		alignRight		: 'Vpravo',
		alignCenter		: 'Na stred',
		alignTop		: 'Nahor',
		alignMiddle		: 'Na stred',
		alignBottom		: 'Dole',
		invalidValue	: 'Invalid value.', // MISSING
		invalidHeight	: 'V'yska musí byt císlo.',
		invalidWidth	: 'Sírka musí byt císlo.',
		invalidCssLength	: 'Specifikovaná hodnota pre pole "%1" musí byt kladné císlo s alebo bez platnej CSS mernej jednotky (px, %, in, cm, mm, em, ex, pt alebo pc).',
		invalidHtmlLength	: 'Specifikovaná hodnota pre pole "%1" musí byt kladné císlo s alebo bez platnej HTML mernej jednotky (px alebo %).',
		invalidInlineStyle	: 'Zadaná hodnota pre inline st'yl musí pozostávat s jedného, alebo viac dvojíc formátu "názov: hodnota", oddelen'ych bodkociarkou.',
		cssLengthTooltip	: 'Vlozte císlo pre hodnotu v pixeloch alebo císlo so správnou CSS jednotou (px, %, in, cm, mm, em, ex, pt, or pc).',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, nedostupn'y</span>'
	},

	contextmenu :
	{
		options : 'Moznosti kontextového menu'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Vlozit speciálny znak',
		title		: 'V'yber speciálneho znaku',
		options : 'Moznosti speciálneho znaku'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Odkaz',
		other 		: '<in'y>',
		menu		: 'Upravit odkaz',
		title		: 'Odkaz',
		info		: 'Informácie o odkaze',
		target		: 'Ciel',
		upload		: 'Nahrat',
		advanced	: 'Rozsírené',
		type		: 'Typ odkazu',
		toUrl		: 'URL',
		toAnchor	: 'Odkaz na kotvu v texte',
		toEmail		: 'E-mail',
		targetFrame		: '<rámec>',
		targetPopup		: '<vyskakovacie okno>',
		targetFrameName	: 'Názov rámu ciela',
		targetPopupName	: 'Názov vyskakovacieho okna',
		popupFeatures	: 'Vlastnosti vyskakovacieho okna',
		popupResizable	: 'Menitelná velkost (resizable)',
		popupStatusBar	: 'Stavov'y riadok (status bar)',
		popupLocationBar: 'Panel umiestnenia (location bar)',
		popupToolbar	: 'Panel nástrojov (toolbar)',
		popupMenuBar	: 'Panel ponuky (menu bar)',
		popupFullScreen	: 'Celá obrazovka (IE)',
		popupScrollBars	: 'Posuvníky (scroll bars)',
		popupDependent	: 'Závislost (Netscape)',
		popupLeft		: 'Lav'y okraj',
		popupTop		: 'Horn'y okraj',
		id				: 'Id',
		langDir			: 'Orientácia jazyka',
		langDirLTR		: 'Zlava doprava (LTR)',
		langDirRTL		: 'Sprava dolava (RTL)',
		acccessKey		: 'Prístupov'y klúc',
		name			: 'Názov',
		langCode			: 'Orientácia jazyka',
		tabIndex			: 'Poradie prvku (tab index)',
		advisoryTitle		: 'Pomocn'y titulok',
		advisoryContentType	: 'Pomocn'y typ obsahu',
		cssClasses		: 'Triedy st'ylu',
		charset			: 'Priradená znaková sada',
		styles			: 'St'yl',
		rel			: 'Vztah (rel)',
		selectAnchor		: 'Vybrat kotvu',
		anchorName		: 'Podla mena kotvy',
		anchorId			: 'Podla Id objektu',
		emailAddress		: 'E-Mailová adresa',
		emailSubject		: 'Predmet správy',
		emailBody		: 'Telo správy',
		noAnchors		: '(V dokumente nie sú dostupné ziadne kotvy)',
		noUrl			: 'Zadajte prosím URL odkazu',
		noEmail			: 'Zadajte prosím e-mailovú adresu'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Kotva',
		menu		: 'Upravit kotvu',
		title		: 'Vlastnosti kotvy',
		name		: 'Názov kotvy',
		errorName	: 'Zadajte prosím názov kotvy',
		remove		: 'Odstránit kotvu'
	},

	// List style dialog
	list:
	{
		numberedTitle		: 'Vlastnosti císelného zoznamu',
		bulletedTitle		: 'Vlastnosti odrázkového zoznamu',
		type				: 'Typ',
		start				: 'Zaciatok',
		validateStartNumber				:'Zaciatocné císlo císelného zoznamu musí byt celé císlo.',
		circle				: 'Kruh',
		disc				: 'Disk',
		square				: 'Stvorec',
		none				: 'Nic',
		notset				: '<nenastavené>',
		armenian			: 'Arménske císlovanie',
		georgian			: 'Gregoriánske císlovanie (an, ban, gan, atd.)',
		lowerRoman			: 'Malé rímske (i, ii, iii, iv, v, atd.)',
		upperRoman			: 'Velké rímske (I, II, III, IV, V, atd.)',
		lowerAlpha			: 'Malé latinské (a, b, c, d, e, atd.)',
		upperAlpha			: 'Velké latinské (A, B, C, D, E, atd.)',
		lowerGreek			: 'Malé grécke (alfa, beta, gama, atd.)',
		decimal				: 'Císelné (1, 2, 3, atd.)',
		decimalLeadingZero	: 'Císelné s nulou (01, 02, 03, atd.)'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Nájst a nahradit',
		find				: 'Hladat',
		replace				: 'Nahradit',
		findWhat			: 'Co hladat:',
		replaceWith			: 'Cím nahradit:',
		notFoundMsg			: 'Hladan'y text nebol nájden'y.',
		findOptions			: 'Nájst moznosti',
		matchCase			: 'Rozlisovat malé a velké písmená',
		matchWord			: 'Len celé slová',
		matchCyclic			: 'Cyklit zhodu',
		replaceAll			: 'Nahradit vsetko',
		replaceSuccessMsg	: '%1 v'yskyt(ov) nahraden'ych.'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Tabulka',
		title		: 'Vlastnosti tabulky',
		menu		: 'Vlastnosti tabulky',
		deleteTable	: 'Vymazat tabulku',
		rows		: 'Riadky',
		columns		: 'Stlpce',
		border		: 'Sírka rámu (border)',
		widthPx		: 'pixelov',
		widthPc		: 'percent',
		widthUnit	: 'jednotka sírky',
		cellSpace	: 'Vzdialenost buniek (cell spacing)',
		cellPad		: 'Odsadenie obsahu (cell padding)',
		caption		: 'Popis',
		summary		: 'Prehlad',
		headers		: 'Hlavicka',
		headersNone		: 'Ziadne',
		headersColumn	: 'Prv'y stlpec',
		headersRow		: 'Prv'y riadok',
		headersBoth		: 'Obe',
		invalidRows		: 'Pocet riadkov musí byt císlo v"acsie ako 0.',
		invalidCols		: 'Pocet stlpcov musí byt císlo v"acsie ako 0.',
		invalidBorder	: 'Sirka rámu musí byt císlo.',
		invalidWidth	: 'Sirka tabulky musí byt císlo.',
		invalidHeight	: 'V'yska tabulky musí byt císlo.',
		invalidCellSpacing	: 'Medzera m"adzi bunkami (cell spacing) musí byt kladné císlo.',
		invalidCellPadding	: 'Odsadenie v bunkách (cell padding) musí byt kladné císlo.',

		cell :
		{
			menu			: 'Bunka',
			insertBefore	: 'Vlozit bunku pred',
			insertAfter		: 'Vlozit bunku za',
			deleteCell		: 'Vymazat bunky',
			merge			: 'Zlúcit bunky',
			mergeRight		: 'Zlúcit doprava',
			mergeDown		: 'Zlúcit dole',
			splitHorizontal	: 'Rozdelit bunky horizontálne',
			splitVertical	: 'Rozdelit bunky vertikálne',
			title			: 'Vlastnosti bunky',
			cellType		: 'Typ bunky',
			rowSpan			: 'Rozsah riadkov',
			colSpan			: 'Rozsah stlpcov',
			wordWrap		: 'Zalomovanie riadkov',
			hAlign			: 'Horizontálne zarovnanie',
			vAlign			: 'Vertikálne zarovnanie',
			alignBaseline	: 'Základná ciara (baseline)',
			bgColor			: 'Farba pozadia',
			borderColor		: 'Farba rámu',
			data			: 'Dáta',
			header			: 'Hlavicka',
			yes				: ''Ano',
			no				: 'Nie',
			invalidWidth	: 'Sírka bunky musí byt císlo.',
			invalidHeight	: 'V'yska bunky musí byt císlo.',
			invalidRowSpan	: 'Rozsah riadkov musí byt celé císlo.',
			invalidColSpan	: 'Rozsah stlpcov musí byt celé císlo.',
			chooseColor		: 'Vybrat'
		},

		row :
		{
			menu			: 'Riadok',
			insertBefore	: 'Vlozit riadok pred',
			insertAfter		: 'Vlozit riadok po',
			deleteRow		: 'Vymazat riadky'
		},

		column :
		{
			menu			: 'Stlpec',
			insertBefore	: 'Vlozit stlpec pred',
			insertAfter		: 'Vlozit stlpec po',
			deleteColumn	: 'Zmazat stlpce'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Vlastnosti tlacidla',
		text		: 'Text (Hodnota)',
		type		: 'Typ',
		typeBtn		: 'Tlacidlo',
		typeSbm		: 'Odoslat',
		typeRst		: 'Resetovat'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Vlastnosti zaskrtávacieho polícka',
		radioTitle	: 'Vlastnosti prepínaca (radio button)',
		value		: 'Hodnota',
		selected	: 'Vybrané (selected)'
	},

	// Form Dialog.
	form :
	{
		title		: 'Vlastnosti formulára',
		menu		: 'Vlastnosti formulára',
		action		: 'Akcia (action)',
		method		: 'Metóda (method)',
		encoding	: 'Kódovanie (encoding)'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Vlastnosti rozbalovacieho zoznamu',
		selectInfo	: 'Informácie o v'ybere',
		opAvail		: 'Dostupné moznosti',
		value		: 'Hodnota',
		size		: 'Velkost',
		lines		: 'riadkov',
		chkMulti	: 'Povolit viacnásobn'y v'yber',
		opText		: 'Text',
		opValue		: 'Hodnota',
		btnAdd		: 'Pridat',
		btnModify	: 'Upravit',
		btnUp		: 'Hore',
		btnDown		: 'Dole',
		btnSetValue : 'Nastavit ako vybranú hodnotu',
		btnDelete	: 'Vymazat'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Vlastnosti textovej oblasti (textarea)',
		cols		: 'Stlpcov',
		rows		: 'Riadkov'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Vlastnosti textového pola',
		name		: 'Názov (name)',
		value		: 'Hodnota',
		charWidth	: 'Sírka pola (podla znakov)',
		maxChars	: 'Maximálny pocet znakov',
		type		: 'Typ',
		typeText	: 'Text',
		typePass	: 'Heslo'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Vlastnosti skrytého pola',
		name	: 'Názov (name)',
		value	: 'Hodnota'
	},

	// Image Dialog.
	image :
	{
		title		: 'Vlastnosti obrázka',
		titleButton	: 'Vlastnosti obrázkového tlacidla',
		menu		: 'Vlastnosti obrázka',
		infoTab		: 'Informácie o obrázku',
		btnUpload	: 'Odoslat to na server',
		upload		: 'Nahrat',
		alt			: 'Alternatívny text',
		lockRatio	: 'Pomer zámky',
		resetSize	: 'P^ovodná velkost',
		border		: 'Rám (border)',
		hSpace		: 'H-medzera',
		vSpace		: 'V-medzera',
		alertUrl	: 'Zadajte prosím URL obrázka',
		linkTab		: 'Odkaz',
		button2Img	: 'Chcete zmenit vybrané obrázkové tlacidlo na jednoduch'y obrázok?',
		img2Button	: 'Chcete zmenit vybran'y obrázok na obrázkové tlacidlo?',
		urlMissing	: 'Ch'yba URL zdroja obrázka.',
		validateBorder	: 'Rám (border) musí byt celé císlo.',
		validateHSpace	: 'H-medzera musí byt celé císlo.',
		validateVSpace	: 'V-medzera musí byt celé císlo.'
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Vlastnosti Flashu',
		propertiesTab	: 'Vlastnosti',
		title			: 'Vlastnosti Flashu',
		chkPlay			: 'Automatické prehrávanie',
		chkLoop			: 'Opakovanie',
		chkMenu			: 'Povolit Flash Menu',
		chkFull			: 'Povolit zobrazenie na celú obrazovku (fullscreen)',
 		scale			: 'Mierka',
		scaleAll		: 'Zobrazit vsetko',
		scaleNoBorder	: 'Bez okrajov',
		scaleFit		: 'Roztiahnut, aby sedelo presne',
		access			: 'Prístup skriptu',
		accessAlways	: 'Vzdy',
		accessSameDomain: 'Rovnaká doména',
		accessNever		: 'Nikdy',
		alignAbsBottom	: ''Uplne dole',
		alignAbsMiddle	: 'Do stredu',
		alignBaseline	: 'Na základnú ciaru',
		alignTextTop	: 'Na horn'y okraj textu',
		quality			: 'Kvalita',
		qualityBest		: 'Najlepsia',
		qualityHigh		: 'Vysoká',
		qualityAutoHigh	: 'Automaticky vysoká',
		qualityMedium	: 'Stredná',
		qualityAutoLow	: 'Automaticky nízka',
		qualityLow		: 'Nízka',
		windowModeWindow: 'Okno',
		windowModeOpaque: 'Nepriehladn'y',
		windowModeTransparent : 'Priehladn'y',
		windowMode		: 'Mód okna',
		flashvars		: 'Premenné pre Flash',
		bgcolor			: 'Farba pozadia',
		hSpace			: 'H-medzera',
		vSpace			: 'V-medzera',
		validateSrc		: 'URL nesmie byt prázdne.',
		validateHSpace	: 'H-medzera musí byt císlo.',
		validateVSpace	: 'V-medzera musí byt císlo'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Kontrola pravopisu',
		title			: 'Skontrolovat pravopis',
		notAvailable	: 'Prepácte, ale sluzba je momentálne nedostupná.',
		errorLoading	: 'Chyba pri nacítaní slovníka z adresy: %s.',
		notInDic		: 'Nie je v slovníku',
		changeTo		: 'Zmenit na',
		btnIgnore		: 'Ignorovat',
		btnIgnoreAll	: 'Ignorovat vsetko',
		btnReplace		: 'Prepísat',
		btnReplaceAll	: 'Prepísat vsetko',
		btnUndo			: 'Sp"at',
		noSuggestions	: '- Ziadny návrh -',
		progress		: 'Prebieha kontrola pravopisu...',
		noMispell		: 'Kontrola pravopisu dokoncená: Neboli nájdené ziadne chyby pravopisu',
		noChanges		: 'Kontrola pravopisu dokoncená: Neboli zmenené ziadne slová',
		oneChange		: 'Kontrola pravopisu dokoncená: Bolo zmenené jedno slovo',
		manyChanges		: 'Kontrola pravopisu dokoncená: Bolo zmenen'ych %1 slov',
		ieSpellDownload	: 'Kontrola pravopisu nie je naistalovaná. Chcete ju teraz stiahnut?'
	},

	smiley :
	{
		toolbar	: 'Smajlíky',
		title	: 'Vlozit smajlíka',
		options : 'Moznosti smajlíkov'
	},

	elementsPath :
	{
		eleLabel : 'Cesta prvkov',
		eleTitle : '%1 prvok'
	},

	numberedlist	: 'Vlozit/Odstránit císlovan'y zoznam',
	bulletedlist	: 'Vlozit/Odstránit zoznam s odrázkami',
	indent			: 'Zv"acsit odsadenie',
	outdent			: 'Zmensit odsadenie',

	justify :
	{
		left	: 'Zarovnat vlavo',
		center	: 'Zarovnat na stred',
		right	: 'Zarovnat vpravo',
		block	: 'Zarovnat do bloku'
	},

	blockquote : 'Citácia',

	clipboard :
	{
		title		: 'Vlozit',
		cutError	: 'Bezpecnostné nastavenia Vásho prehliadaca nedovolujú editoru automaticky spustit operáciu vystrihnutia. Prosím, pouzite na to klávesnicu (Ctrl/Cmd+X).',
		copyError	: 'Bezpecnostné nastavenia Vásho prehliadaca nedovolujú editoru automaticky spustit operáciu kopírovania. Prosím, pouzite na to klávesnicu (Ctrl/Cmd+C).',
		pasteMsg	: 'Prosím, vlozte nasledovn'y rámcek pouzitím klávesnice (<STRONG>Ctrl/Cmd+V</STRONG>) a stlacte OK.',
		securityMsg	: 'Kv^oli vasim bezpecnostn'ym nastaveniam prehliadaca editor nie je schopn'y pristupovat k vasej schránke na kopírovanie priamo. Vlozte to preto do tohto okna.',
		pasteArea	: 'Miesto pre vlozenie'
	},

	pastefromword :
	{
		confirmCleanup	: 'Vkladan'y text vyzerá byt skopírovan'y z Wordu. Chcete ho automaticky vycistit pred vkladaním?',
		toolbar			: 'Vlozit z Wordu',
		title			: 'Vlozit z Wordu',
		error			: 'Nebolo mozné vycistit vlozené dáta kv^oli internej chybe'
	},

	pasteText :
	{
		button	: 'Vlozit ako cist'y text',
		title	: 'Vlozit ako cist'y text'
	},

	templates :
	{
		button			: 'Sablóny',
		title			: 'Sablóny obsahu',
		options : 'Moznosti sablóny',
		insertOption	: 'Nahradit aktuálny obsah',
		selectPromptMsg	: 'Prosím vyberte sablónu na otvorenie v editore',
		emptyListMsg	: '(Ziadne sablóny nedefinované)'
	},

	showBlocks : 'Ukázat bloky',

	stylesCombo :
	{
		label		: 'St'yly',
		panelTitle	: 'Formátovanie st'ylov',
		panelTitle1	: 'St'yly bloku',
		panelTitle2	: 'Vnútroriadkové (inline) st'yly',
		panelTitle3	: 'St'yly objeku'
	},

	format :
	{
		label		: 'Formát',
		panelTitle	: 'Formát',

		tag_p		: 'Normálny',
		tag_pre		: 'Formátovan'y',
		tag_address	: 'Adresa',
		tag_h1		: 'Nadpis 1',
		tag_h2		: 'Nadpis 2',
		tag_h3		: 'Nadpis 3',
		tag_h4		: 'Nadpis 4',
		tag_h5		: 'Nadpis 5',
		tag_h6		: 'Nadpis 6',
		tag_div		: 'Normálny (DIV)'
	},

	div :
	{
		title				: 'Vytvorit Div kontajner',
		toolbar				: 'Vytvorit Div kontajner',
		cssClassInputLabel	: 'Triedy st'ylu',
		styleSelectLabel	: 'St'yl',
		IdInputLabel		: 'Id',
		languageCodeInputLabel	: 'Kód jazyka',
		inlineStyleInputLabel	: 'Inline st'yl',
		advisoryTitleInputLabel	: 'Pomocn'y titulok',
		langDirLabel		: 'Smer jazyka',
		langDirLTRLabel		: 'Zlava doprava (LTR)',
		langDirRTLLabel		: 'Zprava dolava (RTL)',
		edit				: 'Upravit Div',
		remove				: 'Odstránit Div'
  	},

	iframe :
	{
		title		: 'Vlastnosti IFrame',
		toolbar		: 'IFrame',
		noUrl		: 'Prosím, vlozte URL iframe',
		scrolling	: 'Povolit skrolovanie',
		border		: 'Zobrazit rám frame-u'
	},

	font :
	{
		label		: 'Font',
		voiceLabel	: 'Font',
		panelTitle	: 'Názov fontu'
	},

	fontSize :
	{
		label		: 'Velkost',
		voiceLabel	: 'Velkost písma',
		panelTitle	: 'Velkost písma'
	},

	colorButton :
	{
		textColorTitle	: 'Farba textu',
		bgColorTitle	: 'Farba pozadia',
		panelTitle		: 'Farby',
		auto			: 'Automaticky',
		more			: 'Viac farieb...'
	},

	colors :
	{
		'000' : 'Cierna',
		'800000' : 'Maroon',
		'8B4513' : 'Sedlová hnedá',
		'2F4F4F' : 'Tmavo bridlicovo sivá',
		'008080' : 'Modrozelená',
		'000080' : 'Tmavomodrá',
		'4B0082' : 'Indigo',
		'696969' : 'Tmavá sivá',
		'B22222' : 'Ohňová tehlová',
		'A52A2A' : 'Hnedá',
		'DAA520' : 'Zlatobyl',
		'006400' : 'Tmavá zelená',
		'40E0D0' : 'Tyrkysová',
		'0000CD' : 'Stredná modrá',
		'800080' : 'Purpurová',
		'808080' : 'Sivá',
		'F00' : 'Cervená',
		'FF8C00' : 'Tmavá oranzová',
		'FFD700' : 'Zlatá',
		'008000' : 'Zelená',
		'0FF' : 'Azúrová',
		'00F' : 'Modrá',
		'EE82EE' : 'Fialová',
		'A9A9A9' : 'Tmavá sivá',
		'FFA07A' : 'Svetlo lososová',
		'FFA500' : 'Oranzová',
		'FFFF00' : 'Zltá',
		'00FF00' : 'Vápenná',
		'AFEEEE' : 'Svetlo tyrkysová',
		'ADD8E6' : 'Svetlo modrá',
		'DDA0DD' : 'Slivková',
		'D3D3D3' : 'Svetlo sivá',
		'FFF0F5' : 'Levandulovo cervená',
		'FAEBD7' : 'Antická biela',
		'FFFFE0' : 'Svetlo zltá',
		'F0FFF0' : 'Medová',
		'F0FFFF' : 'Azúrová',
		'F0F8FF' : 'Alicovo modrá',
		'E6E6FA' : 'Levandulová',
		'FFF' : 'Biela'
	},

	scayt :
	{
		title			: 'Kontrola pravopisu pocas písania',
		opera_title		: 'Nepodporované Operou',
		enable			: 'Povolit KPPP (Kontrola pravopisu pocas písania)',
		disable			: 'Zakázat  KPPP (Kontrola pravopisu pocas písania)',
		about			: 'O KPPP (Kontrola pravopisu pocas písania)',
		toggle			: 'Prepnút KPPP (Kontrola pravopisu pocas písania)',
		options			: 'Moznosti',
		langs			: 'Jazyky',
		moreSuggestions	: 'Viac návrhov',
		ignore			: 'Ignorovat',
		ignoreAll		: 'Ignorovat vsetko',
		addWord			: 'Pridat slovo',
		emptyDic		: 'Názov slovníka by nemal byt prázdny.',

		optionsTab		: 'Moznosti',
		allCaps			: 'Ignorovat slová písané velk'ymi písmenami',
		ignoreDomainNames : 'Iznorovat názvy domén',
		mixedCase		: 'Ignorovat slová so smiesan'ymi velk'ymi a mal'ymi písmenami',
		mixedWithDigits	: 'Ignorovat slová s císlami',

		languagesTab	: 'Jazyky',

		dictionariesTab	: 'Slovníky',
		dic_field_name	: 'Názov slovníka',
		dic_create		: 'Vytvorit',
		dic_restore		: 'Obnovit',
		dic_delete		: 'Vymazat',
		dic_rename		: 'Premenovat',
		dic_info		: 'Spociatku je uzívatelsk'y slovník ulozen'y v cookie. Cookie vsak majú obmedzenú velkost. Ked uzívatelsk'y slovník narastie do bodu, kedy nem^oze byt ulozen'y v cookie, potom musí byt slovník ulozen'y na nasom serveri. Pre ulozenie vásho osobného slovníka na nás server by ste mali zadat názov pre vás slovník. Ak uz máte ulozen'y slovník, prosíme, napíste jeho názov a kliknite tlacidlo Obnovit.',

		aboutTab		: 'O'
	},

	about :
	{
		title		: 'O CKEditor-e',
		dlgTitle	: 'O CKEditor-e',
		help	: 'Zaskrtnite $1 pre pomoc.',
		userGuide : 'Pouzívatelská prírucka KCEditor-a',
		moreInfo	: 'Pre informácie o licenciách, prosíme, navstívte nasu web stránku:',
		copy		: 'Copyright &copy; $1. Vsetky práva vyhradené.'
	},

	maximize : 'Maximalizovat',
	minimize : 'Minimalizovat',

	fakeobjects :
	{
		anchor		: 'Kotva',
		flash		: 'Flash animácia',
		iframe		: 'IFrame',
		hiddenfield	: 'Skryté pole',
		unknown		: 'Neznámy objekt'
	},

	resize : 'Potiahnite pre zmenu velkosti',

	colordialog :
	{
		title		: 'Vyberte farbu',
		options	:	'Moznosti farby',
		highlight	: 'Zv'yraznit',
		selected	: 'Vybraná farba',
		clear		: 'Vycistit'
	},

	toolbarCollapse	: 'Zbalit listu nástrojov',
	toolbarExpand	: 'Rozbalit listu nástrojov',

	toolbarGroups :
	{
		document : 'Dokument',
		clipboard : 'Schránka pre kopírovanie/Sp"at',
		editing : 'Upravovanie',
		forms : 'Formuláre',
		basicstyles : 'Základné st'yly',
		paragraph : 'Odstavec',
		links : 'Odkazy',
		insert : 'Vlozit',
		styles : 'St'yly',
		colors : 'Farby',
		tools : 'Nástroje'
	},

	bidi :
	{
		ltr : 'Smer textu zlava doprava',
		rtl : 'Smer textu sprava dolava'
	},

	docprops :
	{
		label : 'Vlastnosti dokumentu',
		title : 'Vlastnosti dokumentu',
		design : 'Design',
		meta : 'Meta znacky',
		chooseColor : 'Vybrat',
		other : 'In'y...',
		docTitle :	'Titulok stránky',
		charset : 	'Znaková sada',
		charsetOther : 'Iná znaková sada',
		charsetASCII : 'ASCII',
		charsetCE : 'Stredoeurópska',
		charsetCT : 'Cínstina tradicná (Big5)',
		charsetCR : 'Cyrillika',
		charsetGR : 'Gréctina',
		charsetJP : 'Japoncina',
		charsetKR : 'Korejcina',
		charsetTR : 'Turectina',
		charsetUN : 'Unicode (UTF-8)',
		charsetWE : 'Západná európa',
		docType : 'Typ záhlavia dokumentu',
		docTypeOther : 'In'y typ záhlavia dokumentu',
		xhtmlDec : 'Vlozit deklarácie XHTML',
		bgColor : 'Farba pozadia',
		bgImage : 'URL obrázka na pozadí',
		bgFixed : 'Fixné pozadie',
		txtColor : 'Farba textu',
		margin : 'Okraje stránky (margins)',
		marginTop : 'Horn'y',
		marginLeft : 'Lav'y',
		marginRight : 'Prav'y',
		marginBottom : 'Doln'y',
		metaKeywords : 'Indexované klúcové slová dokumentu (oddelené ciarkou)',
		metaDescription : 'Popis dokumentu',
		metaAuthor : 'Autor',
		metaCopyright : 'Autorské práva (copyright)',
		previewHtml : '<p>Toto je nejak'y <strong>ukázkov'y text</strong>. Pouzívate <a href="javascript:void(0)">CKEditor</a>.</p>'
	}
};
