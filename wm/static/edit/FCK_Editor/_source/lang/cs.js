/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Czech language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Contains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['cs'] =
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
	editorTitle : 'Textov'y editor, %1',
	editorHelp : 'Stiskněte ALT 0 pro nápovědu',

	// ARIA descriptions.
	toolbars	: 'Panely nástroju editoru',
	editor		: 'Textov'y editor',

	// Toolbar buttons without dialogs.
	source			: 'Zdroj',
	newPage			: 'Nová stránka',
	save			: 'Ulozit',
	preview			: 'Náhled',
	cut				: 'Vyjmout',
	copy			: 'Kopírovat',
	paste			: 'Vlozit',
	print			: 'Tisk',
	underline		: 'Podtrzené',
	bold			: 'Tucné',
	italic			: 'Kurzíva',
	selectAll		: 'Vybrat vse',
	removeFormat	: 'Odstranit formátování',
	strike			: 'Preskrtnuté',
	subscript		: 'Dolní index',
	superscript		: 'Horní index',
	horizontalrule	: 'Vlozit vodorovnou linku',
	pagebreak		: 'Vlozit konec stránky',
	pagebreakAlt		: 'Konec stránky',
	unlink			: 'Odstranit odkaz',
	undo			: 'Zpět',
	redo			: 'Znovu',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Vybrat na serveru',
		url				: 'URL',
		protocol		: 'Protokol',
		upload			: 'Odeslat',
		uploadSubmit	: 'Odeslat na server',
		image			: 'Obrázek',
		flash			: 'Flash',
		form			: 'Formulár',
		checkbox		: 'Zaskrtávací polícko',
		radio			: 'Prepínac',
		textField		: 'Textové pole',
		textarea		: 'Textová oblast',
		hiddenField		: 'Skryté pole',
		button			: 'Tlacítko',
		select			: 'Seznam',
		imageButton		: 'Obrázkové tlacítko',
		notSet			: '<nenastaveno>',
		id				: 'Id',
		name			: 'Jméno',
		langDir			: 'Směr jazyka',
		langDirLtr		: 'Zleva doprava (LTR)',
		langDirRtl		: 'Zprava doleva (RTL)',
		langCode		: 'Kód jazyka',
		longDescr		: 'Dlouh'y popis URL',
		cssClass		: 'Trída stylu',
		advisoryTitle	: 'Pomocn'y titulek',
		cssStyle		: 'Styl',
		ok				: 'OK',
		cancel			: 'Zrusit',
		close			: 'Zavrít',
		preview			: 'Náhled',
		generalTab		: 'Obecné',
		advancedTab		: 'Rozsírené',
		validateNumberFailed : 'Zadaná hodnota není císelná.',
		confirmNewPage	: 'Jakékoliv neulozené změny obsahu budou ztraceny. Skutecně chcete otevrít novou stránku?',
		confirmCancel	: 'Některá z nastavení byla změněna. Skutecně chcete zavrít dialogové okno?',
		options			: 'Nastavení',
		target			: 'Cíl',
		targetNew		: 'Nové okno (_blank)',
		targetTop		: 'Okno nejvyssí úrovně (_top)',
		targetSelf		: 'Stejné okno (_self)',
		targetParent	: 'Rodicovské okno (_parent)',
		langDirLTR		: 'Zleva doprava (LTR)',
		langDirRTL		: 'Zprava doleva (RTL)',
		styles			: 'Styly',
		cssClasses		: 'Trídy stylu',
		width			: 'Sírka',
		height			: 'V'yska',
		align			: 'Zarovnání',
		alignLeft		: 'Vlevo',
		alignRight		: 'Vpravo',
		alignCenter		: 'Na stred',
		alignTop		: 'Nahoru',
		alignMiddle		: 'Na stred',
		alignBottom		: 'Dolu',
		invalidValue	: 'Neplatná hodnota.',
		invalidHeight	: 'Zadaná v'yska musí b'yt císlo.',
		invalidWidth	: 'Sírka musí b'yt císlo.',
		invalidCssLength	: 'Hodnota urcená pro pole "%1" musí b'yt kladné císlo bez nebo s platnou jednotkou míry CSS (px, %, in, cm, mm, em, ex, pt, nebo pc).',
		invalidHtmlLength	: 'Hodnota urcená pro pole "%1" musí b'yt kladné císlo bez nebo s platnou jednotkou míry HTML (px nebo %).',
		invalidInlineStyle	: 'Hodnota urcená pro rádkov'y styl se musí skládat z jedné nebo více n-tic ve formátu "název : hodnota", oddělené stredníky',
		cssLengthTooltip	: 'Zadejte císlo jako hodnotu v pixelech nebo císlo s platnou jednotkou CSS (px, %, v cm, mm, em, ex, pt, nebo pc).',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, nedostupné</span>'
	},

	contextmenu :
	{
		options : 'Nastavení kontextové nabídky'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Vlozit speciální znaky',
		title		: 'V'yběr speciálního znaku',
		options : 'Nastavení speciálních znaku'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Odkaz',
		other 		: '<jin'y>',
		menu		: 'Změnit odkaz',
		title		: 'Odkaz',
		info		: 'Informace o odkazu',
		target		: 'Cíl',
		upload		: 'Odeslat',
		advanced	: 'Rozsírené',
		type		: 'Typ odkazu',
		toUrl		: 'URL',
		toAnchor	: 'Kotva v této stránce',
		toEmail		: 'E-mail',
		targetFrame		: '<rámec>',
		targetPopup		: '<vyskakovací okno>',
		targetFrameName	: 'Název cílového rámu',
		targetPopupName	: 'Název vyskakovacího okna',
		popupFeatures	: 'Vlastnosti vyskakovacího okna',
		popupResizable	: 'Umozňující měnit velikost',
		popupStatusBar	: 'Stavov'y rádek',
		popupLocationBar: 'Panel umístění',
		popupToolbar	: 'Panel nástroju',
		popupMenuBar	: 'Panel nabídky',
		popupFullScreen	: 'Celá obrazovka (IE)',
		popupScrollBars	: 'Posuvníky',
		popupDependent	: 'Závislost (Netscape)',
		popupLeft		: 'Lev'y okraj',
		popupTop		: 'Horní okraj',
		id				: 'Id',
		langDir			: 'Směr jazyka',
		langDirLTR		: 'Zleva doprava (LTR)',
		langDirRTL		: 'Zprava doleva (RTL)',
		acccessKey		: 'Prístupov'y klíc',
		name			: 'Jméno',
		langCode			: 'Kód jazyka',
		tabIndex			: 'Poradí prvku',
		advisoryTitle		: 'Pomocn'y titulek',
		advisoryContentType	: 'Pomocn'y typ obsahu',
		cssClasses		: 'Trída stylu',
		charset			: 'Prirazená znaková sada',
		styles			: 'Styl',
		rel			: 'Vztah',
		selectAnchor		: 'Vybrat kotvu',
		anchorName		: 'Podle jména kotvy',
		anchorId			: 'Podle Id objektu',
		emailAddress		: 'E-mailová adresa',
		emailSubject		: 'Predmět zprávy',
		emailBody		: 'Tělo zprávy',
		noAnchors		: '(Ve stránce není definována zádná kotva!)',
		noUrl			: 'Zadejte prosím URL odkazu',
		noEmail			: 'Zadejte prosím e-mailovou adresu'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Zálozka',
		menu		: 'Vlastnosti zálozky',
		title		: 'Vlastnosti zálozky',
		name		: 'Název zálozky',
		errorName	: 'Zadejte prosím název zálozky',
		remove		: 'Odstranit zálozku'
	},

	// List style dialog
	list:
	{
		numberedTitle		: 'Vlastnosti císlování',
		bulletedTitle		: 'Vlastnosti odrázek',
		type				: 'Typ',
		start				: 'Pocátek',
		validateStartNumber				:'Císlování musí zacínat cel'ym císlem.',
		circle				: 'Krouzky',
		disc				: 'Kolecka',
		square				: 'Ctverce',
		none				: 'Nic',
		notset				: '<nenastaveno>',
		armenian			: 'Arménské',
		georgian			: 'Gruzínské (an, ban, gan, atd.)',
		lowerRoman			: 'Malé rímské (i, ii, iii, iv, v, atd.)',
		upperRoman			: 'Velké rímské (I, II, III, IV, V, atd.)',
		lowerAlpha			: 'Malá latinka (a, b, c, d, e, atd.)',
		upperAlpha			: 'Velká latinka (A, B, C, D, E, atd.)',
		lowerGreek			: 'Malé recké (alpha, beta, gamma, atd.)',
		decimal				: 'Arabská císla (1, 2, 3, atd.)',
		decimalLeadingZero	: 'Arabská císla uvozená nulou (01, 02, 03, atd.)'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Najít a nahradit',
		find				: 'Hledat',
		replace				: 'Nahradit',
		findWhat			: 'Co hledat:',
		replaceWith			: 'Cím nahradit:',
		notFoundMsg			: 'Hledan'y text nebyl nalezen.',
		findOptions			: 'Moznosti hledání',
		matchCase			: 'Rozlisovat velikost písma',
		matchWord			: 'Pouze celá slova',
		matchCyclic			: 'Procházet opakovaně',
		replaceAll			: 'Nahradit vse',
		replaceSuccessMsg	: '%1 nahrazení.'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Tabulka',
		title		: 'Vlastnosti tabulky',
		menu		: 'Vlastnosti tabulky',
		deleteTable	: 'Smazat tabulku',
		rows		: 'Rádky',
		columns		: 'Sloupce',
		border		: 'Ohranicení',
		widthPx		: 'bodu',
		widthPc		: 'procent',
		widthUnit	: 'jednotka sírky',
		cellSpace	: 'Vzdálenost buněk',
		cellPad		: 'Odsazení obsahu v buňce',
		caption		: 'Popis',
		summary		: 'Souhrn',
		headers		: 'Záhlaví',
		headersNone		: 'Zádné',
		headersColumn	: 'První sloupec',
		headersRow		: 'První rádek',
		headersBoth		: 'Obojí',
		invalidRows		: 'Pocet rádku musí b'yt císlo větsí nez 0.',
		invalidCols		: 'Pocet sloupcu musí b'yt císlo větsí nez 0.',
		invalidBorder	: 'Zdaná velikost okraje musí b'yt císelná.',
		invalidWidth	: 'Sírka tabulky musí b'yt císlo.',
		invalidHeight	: 'Zadaná v'yska tabulky musí b'yt císelná.',
		invalidCellSpacing	: 'Zadaná vzdálenost buněk musí b'yt císelná.',
		invalidCellPadding	: 'Zadané odsazení obsahu v buňce musí b'yt císelné.',

		cell :
		{
			menu			: 'Buňka',
			insertBefore	: 'Vlozit buňku pred',
			insertAfter		: 'Vlozit buňku za',
			deleteCell		: 'Smazat buňky',
			merge			: 'Sloucit buňky',
			mergeRight		: 'Sloucit doprava',
			mergeDown		: 'Sloucit dolu',
			splitHorizontal	: 'Rozdělit buňky vodorovně',
			splitVertical	: 'Rozdělit buňky svisle',
			title			: 'Vlastnosti buňky',
			cellType		: 'Typ buňky',
			rowSpan			: 'Spojit rádky',
			colSpan			: 'Spojit sloupce',
			wordWrap		: 'Zalamování',
			hAlign			: 'Vodorovné zarovnání',
			vAlign			: 'Svislé zarovnání',
			alignBaseline	: 'Na úcarí',
			bgColor			: 'Barva pozadí',
			borderColor		: 'Barva okraje',
			data			: 'Data',
			header			: 'Hlavicka',
			yes				: 'Ano',
			no				: 'Ne',
			invalidWidth	: 'Sírka buňky musí b'yt císlo.',
			invalidHeight	: 'Zadaná v'yska buňky musí b'yt císlená.',
			invalidRowSpan	: 'Zadan'y pocet sloucen'ych rádku musí b'yt celé císlo.',
			invalidColSpan	: 'Zadan'y pocet sloucen'ych sloupcu musí b'yt celé císlo.',
			chooseColor		: 'V'yběr'
		},

		row :
		{
			menu			: 'Rádek',
			insertBefore	: 'Vlozit rádek pred',
			insertAfter		: 'Vlozit rádek za',
			deleteRow		: 'Smazat rádky'
		},

		column :
		{
			menu			: 'Sloupec',
			insertBefore	: 'Vlozit sloupec pred',
			insertAfter		: 'Vlozit sloupec za',
			deleteColumn	: 'Smazat sloupec'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Vlastnosti tlacítka',
		text		: 'Popisek',
		type		: 'Typ',
		typeBtn		: 'Tlacítko',
		typeSbm		: 'Odeslat',
		typeRst		: 'Obnovit'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Vlastnosti zaskrtávacího polícka',
		radioTitle	: 'Vlastnosti prepínace',
		value		: 'Hodnota',
		selected	: 'Zaskrtnuto'
	},

	// Form Dialog.
	form :
	{
		title		: 'Vlastnosti formuláre',
		menu		: 'Vlastnosti formuláre',
		action		: 'Akce',
		method		: 'Metoda',
		encoding	: 'Kódování'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Vlastnosti seznamu',
		selectInfo	: 'Info',
		opAvail		: 'Dostupná nastavení',
		value		: 'Hodnota',
		size		: 'Velikost',
		lines		: 'Rádku',
		chkMulti	: 'Povolit mnohonásobné v'yběry',
		opText		: 'Text',
		opValue		: 'Hodnota',
		btnAdd		: 'Pridat',
		btnModify	: 'Změnit',
		btnUp		: 'Nahoru',
		btnDown		: 'Dolu',
		btnSetValue : 'Nastavit jako vybranou hodnotu',
		btnDelete	: 'Smazat'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Vlastnosti textové oblasti',
		cols		: 'Sloupcu',
		rows		: 'Rádku'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Vlastnosti textového pole',
		name		: 'Název',
		value		: 'Hodnota',
		charWidth	: 'Sírka ve znacích',
		maxChars	: 'Maximální pocet znaku',
		type		: 'Typ',
		typeText	: 'Text',
		typePass	: 'Heslo'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Vlastnosti skrytého pole',
		name	: 'Název',
		value	: 'Hodnota'
	},

	// Image Dialog.
	image :
	{
		title		: 'Vlastnosti obrázku',
		titleButton	: 'Vlastností obrázkového tlacítka',
		menu		: 'Vlastnosti obrázku',
		infoTab		: 'Informace o obrázku',
		btnUpload	: 'Odeslat na server',
		upload		: 'Odeslat',
		alt			: 'Alternativní text',
		lockRatio	: 'Zámek',
		resetSize	: 'Puvodní velikost',
		border		: 'Okraje',
		hSpace		: 'Horizontální mezera',
		vSpace		: 'Vertikální mezera',
		alertUrl	: 'Zadejte prosím URL obrázku',
		linkTab		: 'Odkaz',
		button2Img	: 'Skutecně chcete prevést zvolené obrázkové tlacítko na obycejn'y obrázek?',
		img2Button	: 'Skutecně chcete prevést zvolen'y obrázek na obrázkové tlacítko?',
		urlMissing	: 'Zadané URL zdroje obrázku nebylo nalezeno.',
		validateBorder	: 'Okraj musí b'yt nastaven v cel'ych císlech.',
		validateHSpace	: 'Horizontální mezera musí b'yt nastavena v cel'ych císlech.',
		validateVSpace	: 'Vertikální mezera musí b'yt nastavena v cel'ych císlech.'
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Vlastnosti Flashe',
		propertiesTab	: 'Vlastnosti',
		title			: 'Vlastnosti Flashe',
		chkPlay			: 'Automatické spustění',
		chkLoop			: 'Opakování',
		chkMenu			: 'Nabídka Flash',
		chkFull			: 'Povolit celoobrazovkov'y rezim',
 		scale			: 'Zobrazit',
		scaleAll		: 'Zobrazit vse',
		scaleNoBorder	: 'Bez okraje',
		scaleFit		: 'Prizpusobit',
		access			: 'Prístup ke skriptu',
		accessAlways	: 'Vzdy',
		accessSameDomain: 'Ve stejné doméně',
		accessNever		: 'Nikdy',
		alignAbsBottom	: 'Zcela dolu',
		alignAbsMiddle	: 'Doprostred',
		alignBaseline	: 'Na úcarí',
		alignTextTop	: 'Na horní okraj textu',
		quality			: 'Kvalita',
		qualityBest		: 'Nejlepsí',
		qualityHigh		: 'Vysoká',
		qualityAutoHigh	: 'Vysoká - auto',
		qualityMedium	: 'Strední',
		qualityAutoLow	: 'Nízká - auto',
		qualityLow		: 'Nejnizsí',
		windowModeWindow: 'Okno',
		windowModeOpaque: 'Nepruhledné',
		windowModeTransparent : 'Pruhledné',
		windowMode		: 'Rezim okna',
		flashvars		: 'Proměnné pro Flash',
		bgcolor			: 'Barva pozadí',
		hSpace			: 'Horizontální mezera',
		vSpace			: 'Vertikální mezera',
		validateSrc		: 'Zadejte prosím URL odkazu',
		validateHSpace	: 'Zadaná horizontální mezera musí b'yt císlo.',
		validateVSpace	: 'Zadaná vertikální mezera musí b'yt císlo.'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Zkontrolovat pravopis',
		title			: 'Kontrola pravopisu',
		notAvailable	: 'Omlouváme se, ale sluzba nyní není dostupná.',
		errorLoading	: 'Chyba nahrávání sluzby aplikace z: %s.',
		notInDic		: 'Není ve slovníku',
		changeTo		: 'Změnit na',
		btnIgnore		: 'Preskocit',
		btnIgnoreAll	: 'Preskakovat vse',
		btnReplace		: 'Zaměnit',
		btnReplaceAll	: 'Zaměňovat vse',
		btnUndo			: 'Zpět',
		noSuggestions	: '- zádné návrhy -',
		progress		: 'Probíhá kontrola pravopisu...',
		noMispell		: 'Kontrola pravopisu dokoncena: Zádné pravopisné chyby nenalezeny',
		noChanges		: 'Kontrola pravopisu dokoncena: Beze změn',
		oneChange		: 'Kontrola pravopisu dokoncena: Jedno slovo změněno',
		manyChanges		: 'Kontrola pravopisu dokoncena: %1 slov změněno',
		ieSpellDownload	: 'Kontrola pravopisu není nainstalována. Chcete ji nyní stáhnout?'
	},

	smiley :
	{
		toolbar	: 'Smajlíci',
		title	: 'Vkládání smajlíku',
		options : 'Nastavení smajlíku'
	},

	elementsPath :
	{
		eleLabel : 'Cesta objektu',
		eleTitle : '%1 objekt'
	},

	numberedlist	: 'Císlování',
	bulletedlist	: 'Odrázky',
	indent			: 'Zvětsit odsazení',
	outdent			: 'Zmensit odsazení',

	justify :
	{
		left	: 'Zarovnat vlevo',
		center	: 'Zarovnat na stred',
		right	: 'Zarovnat vpravo',
		block	: 'Zarovnat do bloku'
	},

	blockquote : 'Citace',

	clipboard :
	{
		title		: 'Vlozit',
		cutError	: 'Bezpecnostní nastavení vaseho prohlízece nedovolují editoru spustit funkci pro vyjmutí zvoleného textu do schránky. Prosím vyjměte zvolen'y text do schránky pomocí klávesnice (Ctrl/Cmd+X).',
		copyError	: 'Bezpecnostní nastavení vaseho prohlízece nedovolují editoru spustit funkci pro kopírování zvoleného textu do schránky. Prosím zkopírujte zvolen'y text do schránky pomocí klávesnice (Ctrl/Cmd+C).',
		pasteMsg	: 'Do následujícího pole vlozte pozadovan'y obsah pomocí klávesnice (<STRONG>Ctrl/Cmd+V</STRONG>) a stiskněte <STRONG>OK</STRONG>.',
		securityMsg	: 'Z duvodu nastavení bezpecnosti vaseho prohlízece nemuze editor pristupovat prímo do schránky. Obsah schránky prosím vlozte znovu do tohoto okna.',
		pasteArea	: 'Oblast vkládání'
	},

	pastefromword :
	{
		confirmCleanup	: 'Jak je vidět, vkládan'y text je kopírován z Wordu. Chcete jej pred vlozením vycistit?',
		toolbar			: 'Vlozit z Wordu',
		title			: 'Vlozit z Wordu',
		error			: 'Z duvodu vnitrní chyby nebylo mozné provést vycistění vkládaného textu.'
	},

	pasteText :
	{
		button	: 'Vlozit jako cist'y text',
		title	: 'Vlozit jako cist'y text'
	},

	templates :
	{
		button			: 'Sablony',
		title			: 'Sablony obsahu',
		options : 'Nastavení sablon',
		insertOption	: 'Nahradit aktuální obsah',
		selectPromptMsg	: 'Prosím zvolte sablonu pro otevrení v editoru<br>(aktuální obsah editoru bude ztracen):',
		emptyListMsg	: '(Není definována zádná sablona)'
	},

	showBlocks : 'Ukázat bloky',

	stylesCombo :
	{
		label		: 'Styl',
		panelTitle	: 'Formátovací styly',
		panelTitle1	: 'Blokové styly',
		panelTitle2	: 'Rádkové styly',
		panelTitle3	: 'Objektové styly'
	},

	format :
	{
		label		: 'Formát',
		panelTitle	: 'Formát',

		tag_p		: 'Normální',
		tag_pre		: 'Naformátováno',
		tag_address	: 'Adresa',
		tag_h1		: 'Nadpis 1',
		tag_h2		: 'Nadpis 2',
		tag_h3		: 'Nadpis 3',
		tag_h4		: 'Nadpis 4',
		tag_h5		: 'Nadpis 5',
		tag_h6		: 'Nadpis 6',
		tag_div		: 'Normální (DIV)'
	},

	div :
	{
		title				: 'Vytvorit Div kontejner',
		toolbar				: 'Vytvorit Div kontejner',
		cssClassInputLabel	: 'Trídy stylu',
		styleSelectLabel	: 'Styly',
		IdInputLabel		: 'Id',
		languageCodeInputLabel	: ' Kód jazyka',
		inlineStyleInputLabel	: 'Vnitrní styly',
		advisoryTitleInputLabel	: 'Nápovědní titulek',
		langDirLabel		: 'Směr jazyka',
		langDirLTRLabel		: 'Zleva doprava (LTR)',
		langDirRTLLabel		: 'Zprava doleva (RTL)',
		edit				: 'Změnit Div',
		remove				: 'Odstranit Div'
  	},

	iframe :
	{
		title		: 'Vlastnosti IFrame',
		toolbar		: 'IFrame',
		noUrl		: 'Zadejte prosím URL obsahu pro IFrame',
		scrolling	: 'Zapnout posuvníky',
		border		: 'Zobrazit okraj'
	},

	font :
	{
		label		: 'Písmo',
		voiceLabel	: 'Písmo',
		panelTitle	: 'Písmo'
	},

	fontSize :
	{
		label		: 'Velikost',
		voiceLabel	: 'Velikost písma',
		panelTitle	: 'Velikost'
	},

	colorButton :
	{
		textColorTitle	: 'Barva textu',
		bgColorTitle	: 'Barva pozadí',
		panelTitle		: 'Barvy',
		auto			: 'Automaticky',
		more			: 'Více barev...'
	},

	colors :
	{
		'000' : 'Cerná',
		'800000' : 'Kastanová',
		'8B4513' : 'Sedlová hněd',
		'2F4F4F' : 'Tmavě bledě sedá',
		'008080' : 'Círka',
		'000080' : 'Námornická modr',
		'4B0082' : 'Inkoustová',
		'696969' : 'Tmavě sedá',
		'B22222' : 'Pálená cihla',
		'A52A2A' : 'Hnědá',
		'DAA520' : 'Zlat'y prut',
		'006400' : 'Tmavě zelená',
		'40E0D0' : 'Tyrkisová',
		'0000CD' : 'Stredně modrá',
		'800080' : 'Purpurová',
		'808080' : 'Sedá',
		'F00' : 'Cervená',
		'FF8C00' : 'Tmavě oranzová',
		'FFD700' : 'Zlatá',
		'008000' : 'Zelená',
		'0FF' : 'Azurová',
		'00F' : 'Modrá',
		'EE82EE' : 'Fialová',
		'A9A9A9' : 'Kalně sedá',
		'FFA07A' : 'Světle lososová',
		'FFA500' : 'Oranzová',
		'FFFF00' : 'Zlutá',
		'00FF00' : 'Limetková',
		'AFEEEE' : 'Bledě tyrkisová',
		'ADD8E6' : 'Světle modrá',
		'DDA0DD' : 'Svestková',
		'D3D3D3' : 'Světle sedá',
		'FFF0F5' : 'Levandulově ruměnná',
		'FAEBD7' : 'Antická bílá',
		'FFFFE0' : 'Světle zlutá',
		'F0FFF0' : 'Medová rosa',
		'F0FFFF' : 'Azurová',
		'F0F8FF' : 'Alencina modrá',
		'E6E6FA' : 'Levandulová',
		'FFF' : 'Bílá'
	},

	scayt :
	{
		title			: 'Kontrola pravopisu během psaní (SCAYT)',
		opera_title		: 'Toto Opera nepodporuje',
		enable			: 'Zapnout SCAYT',
		disable			: 'Vypnout SCAYT',
		about			: 'O aplikaci SCAYT',
		toggle			: 'Vypínac SCAYT',
		options			: 'Nastavení',
		langs			: 'Jazyky',
		moreSuggestions	: 'Více návrhu',
		ignore			: 'Preskocit',
		ignoreAll		: 'Preskocit vse',
		addWord			: 'Pridat slovo',
		emptyDic		: 'Název slovníku nesmí b'yt prázdn'y.',

		optionsTab		: 'Nastavení',
		allCaps			: 'Ignorovat slova tvorená velk'ymi písmeny',
		ignoreDomainNames : 'Ignorovat doménová jména',
		mixedCase		: 'Ignorovat slova obsahující ruznou velikost písma',
		mixedWithDigits	: 'Ignorovat slova obsahující císla',

		languagesTab	: 'Jazyky',

		dictionariesTab	: 'Slovníky',
		dic_field_name	: 'Název slovníku',
		dic_create		: 'Vytvorit',
		dic_restore		: 'Obnovit',
		dic_delete		: 'Smazat',
		dic_rename		: 'Prejmenovat',
		dic_info		: 'Zpocátku se uzivatelsk'y slovník ukládá do cookies ve vasem prohlízeci. Ovsem cookies mají omezenou velikost, takze kdyz slovník dosáhne velikosti, kdy se jiz do cookies nevejde, muze b'yt ulozen na nasem serveru. Chcete-li ulozit vás osobní slovník na nasem serveru, je treba slovník nejdríve pojmenovat. Máte-li jiz slovník pojmenován a ulozen, zadejte jeho název a klepněte na tlacítko Obnovit.',

		aboutTab		: 'O aplikaci'
	},

	about :
	{
		title		: 'O aplikaci CKEditor',
		dlgTitle	: 'O aplikaci CKEditor',
		help	: 'Prohlédněte si $1 pro nápovědu.',
		userGuide : 'Uzivatelská prírucka CKEditor',
		moreInfo	: 'Pro informace o lincenci navstivte nasi webovou stránku:',
		copy		: 'Copyright &copy; $1. All rights reserved.'
	},

	maximize : 'Maximalizovat',
	minimize : 'Minimalizovat',

	fakeobjects :
	{
		anchor		: 'Zálozka',
		flash		: 'Flash animace',
		iframe		: 'IFrame',
		hiddenfield	: 'Skryté pole',
		unknown		: 'Neznám'y objekt'
	},

	resize : 'Uchopit pro změnu velikosti',

	colordialog :
	{
		title		: 'V'yběr barvy',
		options	:	'Nastavení barvy',
		highlight	: 'Zv'yraznit',
		selected	: 'Vybráno',
		clear		: 'Vycistit'
	},

	toolbarCollapse	: 'Skr'yt panel nástroju',
	toolbarExpand	: 'Zobrazit panel nástroju',

	toolbarGroups :
	{
		document : 'Dokument',
		clipboard : 'Schránka/Zpět',
		editing : ''Upravy',
		forms : 'Formuláre',
		basicstyles : 'Základní styly',
		paragraph : 'Odstavec',
		links : 'Odkazy',
		insert : 'Vlozit',
		styles : 'Styly',
		colors : 'Barvy',
		tools : 'Nástroje'
	},

	bidi :
	{
		ltr : 'Směr textu zleva doprava',
		rtl : 'Směr textu zprava doleva'
	},

	docprops :
	{
		label : 'Vlastnosti dokumentu',
		title : 'Vlastnosti dokumentu',
		design : 'Vzhled',
		meta : 'Metadata',
		chooseColor : 'V'yběr',
		other : '<jin'y>',
		docTitle :	'Titulek stránky',
		charset : 	'Znaková sada',
		charsetOther : 'Dalsí znaková sada',
		charsetASCII : 'ASCII',
		charsetCE : 'Stredoevropské jazyky',
		charsetCT : 'Tradicní cínstina (Big5)',
		charsetCR : 'Cyrilice',
		charsetGR : 'Rectina',
		charsetJP : 'Japonstina',
		charsetKR : 'Korejstina',
		charsetTR : 'Turectina',
		charsetUN : 'Unicode (UTF-8)',
		charsetWE : 'Západoevropské jazyky',
		docType : 'Typ dokumentu',
		docTypeOther : 'Jin'y typ dokumetu',
		xhtmlDec : 'Zahrnout deklarace XHTML',
		bgColor : 'Barva pozadí',
		bgImage : 'URL obrázku na pozadí',
		bgFixed : 'Nerolovatelné (Pevné) pozadí',
		txtColor : 'Barva textu',
		margin : 'Okraje stránky',
		marginTop : 'Horní',
		marginLeft : 'Lev'y',
		marginRight : 'Prav'y',
		marginBottom : 'Dolní',
		metaKeywords : 'Klícová slova (oddělená cárkou)',
		metaDescription : 'Popis dokumentu',
		metaAuthor : 'Autor',
		metaCopyright : 'Autorská práva',
		previewHtml : '<p>Toto je <strong>ukázkov'y text</strong>. Pouzíváte <a href="javascript:void(0)">CKEditor</a>.</p>'
	}
};
