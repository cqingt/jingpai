/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Hungarian language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Contains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['hu'] =
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
	editorTitle : 'HTML szerkeszt"o, %1',
	editorHelp : 'Press ALT 0 for help', // MISSING

	// ARIA descriptions.
	toolbars	: 'Szerkeszt"o Eszk"oztár',
	editor		: 'HTML szerkeszt"o',

	// Toolbar buttons without dialogs.
	source			: 'Forráskód',
	newPage			: ''Uj oldal',
	save			: 'Mentés',
	preview			: 'El"onézet',
	cut				: 'Kivágás',
	copy			: 'Másolás',
	paste			: 'Beillesztés',
	print			: 'Nyomtatás',
	underline		: 'Aláhúzott',
	bold			: 'Félk"ovér',
	italic			: 'D"olt',
	selectAll		: 'Mindent kijel"ol',
	removeFormat	: 'Formázás eltávolítása',
	strike			: ''Athúzott',
	subscript		: 'Alsó index',
	superscript		: 'Fels"o index',
	horizontalrule	: 'Elválasztóvonal beillesztése',
	pagebreak		: 'Oldalt"orés beillesztése',
	pagebreakAlt		: 'Oldalt"orés',
	unlink			: 'Hivatkozás t"orlése',
	undo			: 'Visszavonás',
	redo			: 'Ismétlés',

	// Common messages and labels.
	common :
	{
		browseServer	: 'B"ongészés a szerveren',
		url				: 'Hivatkozás',
		protocol		: 'Protokoll',
		upload			: 'Felt"oltés',
		uploadSubmit	: 'Küldés a szerverre',
		image			: 'Kép',
		flash			: 'Flash',
		form			: '"Urlap',
		checkbox		: 'Jel"ol"onégyzet',
		radio			: 'Választógomb',
		textField		: 'Sz"ovegmez"o',
		textarea		: 'Sz"ovegterület',
		hiddenField		: 'Rejtettmez"o',
		button			: 'Gomb',
		select			: 'Leg"ordül"o lista',
		imageButton		: 'Képgomb',
		notSet			: '<nincs beállítva>',
		id				: 'Azonosító',
		name			: 'Név',
		langDir			: ''Irás iránya',
		langDirLtr		: 'Balról jobbra',
		langDirRtl		: 'Jobbról balra',
		langCode		: 'Nyelv kódja',
		longDescr		: 'Részletes leírás webcíme',
		cssClass		: 'Stíluskészlet',
		advisoryTitle	: 'Súgócimke',
		cssStyle		: 'Stílus',
		ok				: 'Rendben',
		cancel			: 'Mégsem',
		close			: 'Bezárás',
		preview			: 'El"onézet',
		generalTab		: ''Altalános',
		advancedTab		: 'További opciók',
		validateNumberFailed : 'A mez"obe csak számokat írhat.',
		confirmNewPage	: 'Minden nem mentett változás el fog veszni! Biztosan be szeretné t"olteni az oldalt?',
		confirmCancel	: 'Az "urlap tartalma megváltozott, ám a változásokat nem r"ogzítette. Biztosan be szeretné zárni az "urlapot?',
		options			: 'Beállítások',
		target			: 'Cél',
		targetNew		: ''Uj ablak (_blank)',
		targetTop		: 'Legfels"o ablak (_top)',
		targetSelf		: 'Aktuális ablakban (_self)',
		targetParent	: 'Szül"o ablak (_parent)',
		langDirLTR		: 'Balról jobbra (LTR)',
		langDirRTL		: 'Jobbról balra (RTL)',
		styles			: 'Stílus',
		cssClasses		: 'Stíluslap osztály',
		width			: 'Szélesség',
		height			: 'Magasság',
		align			: 'Igazítás',
		alignLeft		: 'Bal',
		alignRight		: 'Jobbra',
		alignCenter		: 'K"ozépre',
		alignTop		: 'Tetejére',
		alignMiddle		: 'K"ozépre',
		alignBottom		: 'Aljára',
		invalidValue	: 'Invalid value.', // MISSING
		invalidHeight	: 'A magasság mez"obe csak számokat írhat.',
		invalidWidth	: 'A szélesség mez"obe csak számokat írhat.',
		invalidCssLength	: '"%1"-hez megadott érték csakis egy pozitív szám lehet, esetleg egy érvényes CSS egységgel megjel"olve(px, %, in, cm, mm, em, ex, pt vagy pc).',
		invalidHtmlLength	: '"%1"-hez megadott érték csakis egy pozitív szám lehet, esetleg egy érvényes HTML egységgel megjel"olve(px vagy %).',
		invalidInlineStyle	: 'Value specified for the inline style must consist of one or more tuples with the format of "name : value", separated by semi-colons.', // MISSING
		cssLengthTooltip	: 'Enter a number for a value in pixels or a number with a valid CSS unit (px, %, in, cm, mm, em, ex, pt, or pc).', // MISSING

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, nem elérhet"o</span>'
	},

	contextmenu :
	{
		options : 'Helyi menü opciók'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Speciális karakter beillesztése',
		title		: 'Speciális karakter választása',
		options : 'Speciális karakter opciók'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Hivatkozás beillesztése/módosítása',
		other 		: '<más>',
		menu		: 'Hivatkozás módosítása',
		title		: 'Hivatkozás tulajdonságai',
		info		: 'Alaptulajdonságok',
		target		: 'Tartalom megjelenítése',
		upload		: 'Felt"oltés',
		advanced	: 'További opciók',
		type		: 'Hivatkozás típusa',
		toUrl		: 'URL',
		toAnchor	: 'Horgony az oldalon',
		toEmail		: 'E-Mail',
		targetFrame		: '<keretben>',
		targetPopup		: '<felugró ablakban>',
		targetFrameName	: 'Keret neve',
		targetPopupName	: 'Felugró ablak neve',
		popupFeatures	: 'Felugró ablak jellemz"oi',
		popupResizable	: ''Atméretezés',
		popupStatusBar	: ''Allapotsor',
		popupLocationBar: 'Címsor',
		popupToolbar	: 'Eszk"oztár',
		popupMenuBar	: 'Menü sor',
		popupFullScreen	: 'Teljes képerny"o (csak IE)',
		popupScrollBars	: 'G"ordít"osáv',
		popupDependent	: 'Szül"oh"oz kapcsolt (csak Netscape)',
		popupLeft		: 'Bal pozíció',
		popupTop		: 'Fels"o pozíció',
		id				: 'Id',
		langDir			: ''Irás iránya',
		langDirLTR		: 'Balról jobbra',
		langDirRTL		: 'Jobbról balra',
		acccessKey		: 'Billenty"ukombináció',
		name			: 'Név',
		langCode			: ''Irás iránya',
		tabIndex			: 'Tabulátor index',
		advisoryTitle		: 'Súgócimke',
		advisoryContentType	: 'Súgó tartalomtípusa',
		cssClasses		: 'Stíluskészlet',
		charset			: 'Hivatkozott tartalom kódlapja',
		styles			: 'Stílus',
		rel			: 'Kapcsolat típusa',
		selectAnchor		: 'Horgony választása',
		anchorName		: 'Horgony név szerint',
		anchorId			: 'Azonosító szerint',
		emailAddress		: 'E-Mail cím',
		emailSubject		: '"Uzenet tárgya',
		emailBody		: '"Uzenet',
		noAnchors		: '(Nincs horgony a dokumentumban)',
		noUrl			: 'Adja meg a hivatkozás webcímét',
		noEmail			: 'Adja meg az E-Mail címet'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Horgony beillesztése/szerkesztése',
		menu		: 'Horgony tulajdonságai',
		title		: 'Horgony tulajdonságai',
		name		: 'Horgony neve',
		errorName	: 'Kérem adja meg a horgony nevét',
		remove		: 'Horgony eltávolítása'
	},

	// List style dialog
	list:
	{
		numberedTitle		: 'Sorszámozott lista tulajdonságai',
		bulletedTitle		: 'Pontozott lista tulajdonságai',
		type				: 'Típus',
		start				: 'Kezd"oszám',
		validateStartNumber				:'A kezd"oszám nem lehet t"ort érték.',
		circle				: 'K"or',
		disc				: 'Korong',
		square				: 'Négyzet',
		none				: 'Nincs',
		notset				: '<Nincs beállítva>',
		armenian			: '"Ormény számozás',
		georgian			: 'Grúz számozás (an, ban, gan, stb.)',
		lowerRoman			: 'Római kisbet"us (i, ii, iii, iv, v, stb.)',
		upperRoman			: 'Római nagybet"us (I, II, III, IV, V, stb.)',
		lowerAlpha			: 'Kisbet"us (a, b, c, d, e, stb.)',
		upperAlpha			: 'Nagybet"us (A, B, C, D, E, stb.)',
		lowerGreek			: 'G"or"og (alpha, beta, gamma, stb.)',
		decimal				: 'Arab számozás (1, 2, 3, stb.)',
		decimalLeadingZero	: 'Számozás bevezet"o nullákkal (01, 02, 03, stb.)'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Keresés és csere',
		find				: 'Keresés',
		replace				: 'Csere',
		findWhat			: 'Keresett sz"oveg:',
		replaceWith			: 'Csere erre:',
		notFoundMsg			: 'A keresett sz"oveg nem található.',
		findOptions			: 'Find Options', // MISSING
		matchCase			: 'kis- és nagybet"u megkül"onb"oztetése',
		matchWord			: 'csak ha ez a teljes szó',
		matchCyclic			: 'Ciklikus keresés',
		replaceAll			: 'Az "osszes cseréje',
		replaceSuccessMsg	: '%1 egyez"oség cserélve.'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Táblázat',
		title		: 'Táblázat tulajdonságai',
		menu		: 'Táblázat tulajdonságai',
		deleteTable	: 'Táblázat t"orlése',
		rows		: 'Sorok',
		columns		: 'Oszlopok',
		border		: 'Szegélyméret',
		widthPx		: 'képpont',
		widthPc		: 'százalék',
		widthUnit	: 'Szélesség egység',
		cellSpace	: 'Cella térk"oz',
		cellPad		: 'Cella bels"o margó',
		caption		: 'Felirat',
		summary		: 'Leírás',
		headers		: 'Fejlécek',
		headersNone		: 'Nincsenek',
		headersColumn	: 'Els"o oszlop',
		headersRow		: 'Els"o sor',
		headersBoth		: 'Mindkett"o',
		invalidRows		: 'A sorok számának nagyobbnak kell lenni mint 0.',
		invalidCols		: 'Az oszlopok számának nagyobbnak kell lenni mint 0.',
		invalidBorder	: 'A szegélyméret mez"obe csak számokat írhat.',
		invalidWidth	: 'A szélesség mez"obe csak számokat írhat.',
		invalidHeight	: 'A magasság mez"obe csak számokat írhat.',
		invalidCellSpacing	: 'A cella térk"oz mez"obe csak számokat írhat.',
		invalidCellPadding	: 'A cella bels"o margó mez"obe csak számokat írhat.',

		cell :
		{
			menu			: 'Cella',
			insertBefore	: 'Beszúrás balra',
			insertAfter		: 'Beszúrás jobbra',
			deleteCell		: 'Cellák t"orlése',
			merge			: 'Cellák egyesítése',
			mergeRight		: 'Cellák egyesítése jobbra',
			mergeDown		: 'Cellák egyesítése lefelé',
			splitHorizontal	: 'Cellák szétválasztása vízszintesen',
			splitVertical	: 'Cellák szétválasztása függ"olegesen',
			title			: 'Cella tulajdonságai',
			cellType		: 'Cella típusa',
			rowSpan			: 'Függ"oleges egyesítés',
			colSpan			: 'Vízszintes egyesítés',
			wordWrap		: 'Hosszú sorok t"orése',
			hAlign			: 'Vízszintes igazítás',
			vAlign			: 'Függ"oleges igazítás',
			alignBaseline	: 'Alapvonalra',
			bgColor			: 'Háttér színe',
			borderColor		: 'Keret színe',
			data			: 'Adat',
			header			: 'Fejléc',
			yes				: 'Igen',
			no				: 'Nem',
			invalidWidth	: 'A szélesség mez"obe csak számokat írhat.',
			invalidHeight	: 'A magasság mez"obe csak számokat írhat.',
			invalidRowSpan	: 'A függ"oleges egyesítés mez"obe csak számokat írhat.',
			invalidColSpan	: 'A vízszintes egyesítés mez"obe csak számokat írhat.',
			chooseColor		: 'Válasszon'
		},

		row :
		{
			menu			: 'Sor',
			insertBefore	: 'Beszúrás f"olé',
			insertAfter		: 'Beszúrás alá',
			deleteRow		: 'Sorok t"orlése'
		},

		column :
		{
			menu			: 'Oszlop',
			insertBefore	: 'Beszúrás balra',
			insertAfter		: 'Beszúrás jobbra',
			deleteColumn	: 'Oszlopok t"orlése'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Gomb tulajdonságai',
		text		: 'Sz"oveg ('Erték)',
		type		: 'Típus',
		typeBtn		: 'Gomb',
		typeSbm		: 'Küldés',
		typeRst		: 'Alaphelyzet'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Jel"ol"onégyzet tulajdonságai',
		radioTitle	: 'Választógomb tulajdonságai',
		value		: ''Erték',
		selected	: 'Kiválasztott'
	},

	// Form Dialog.
	form :
	{
		title		: '"Urlap tulajdonságai',
		menu		: '"Urlap tulajdonságai',
		action		: 'Adatfeldolgozást végz"o hivatkozás',
		method		: 'Adatküldés módja',
		encoding	: 'Kódolás'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Leg"ordül"o lista tulajdonságai',
		selectInfo	: 'Alaptulajdonságok',
		opAvail		: 'Elérhet"o opciók',
		value		: ''Erték',
		size		: 'Méret',
		lines		: 'sor',
		chkMulti	: 't"obb sor is kiválasztható',
		opText		: 'Sz"oveg',
		opValue		: ''Erték',
		btnAdd		: 'Hozzáad',
		btnModify	: 'Módosít',
		btnUp		: 'Fel',
		btnDown		: 'Le',
		btnSetValue : 'Legyen az alapértelmezett érték',
		btnDelete	: 'T"or"ol'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Sz"ovegterület tulajdonságai',
		cols		: 'Karakterek száma egy sorban',
		rows		: 'Sorok száma'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Sz"ovegmez"o tulajdonságai',
		name		: 'Név',
		value		: ''Erték',
		charWidth	: 'Megjelenített karakterek száma',
		maxChars	: 'Maximális karakterszám',
		type		: 'Típus',
		typeText	: 'Sz"oveg',
		typePass	: 'Jelszó'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Rejtett mez"o tulajdonságai',
		name	: 'Név',
		value	: ''Erték'
	},

	// Image Dialog.
	image :
	{
		title		: 'Kép tulajdonságai',
		titleButton	: 'Képgomb tulajdonságai',
		menu		: 'Kép tulajdonságai',
		infoTab		: 'Alaptulajdonságok',
		btnUpload	: 'Küldés a szerverre',
		upload		: 'Felt"oltés',
		alt			: 'Buborék sz"oveg',
		lockRatio	: 'Arány megtartása',
		resetSize	: 'Eredeti méret',
		border		: 'Keret',
		hSpace		: 'Vízsz. táv',
		vSpace		: 'Függ. táv',
		alertUrl	: 'T"oltse ki a kép webcímét',
		linkTab		: 'Hivatkozás',
		button2Img	: 'A kiválasztott képgombból sima képet szeretne csinálni?',
		img2Button	: 'A kiválasztott képb"ol képgombot szeretne csinálni?',
		urlMissing	: 'Hiányzik a kép URL-je',
		validateBorder	: 'A keret méretének egész számot kell beírni!',
		validateHSpace	: 'Vízszintes távolságnak egész számot kell beírni!',
		validateVSpace	: 'Függ"oleges távolságnak egész számot kell beírni!'
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Flash tulajdonságai',
		propertiesTab	: 'Tulajdonságok',
		title			: 'Flash tulajdonságai',
		chkPlay			: 'Automata lejátszás',
		chkLoop			: 'Folyamatosan',
		chkMenu			: 'Flash menü engedélyezése',
		chkFull			: 'Teljes képerny"o engedélyezése',
 		scale			: 'Méretezés',
		scaleAll		: 'Mindent mutat',
		scaleNoBorder	: 'Keret nélkül',
		scaleFit		: 'Teljes kit"oltés',
		access			: 'Szkript hozzáférés',
		accessAlways	: 'Mindig',
		accessSameDomain: 'Azonos domainr"ol',
		accessNever		: 'Soha',
		alignAbsBottom	: 'Legaljára',
		alignAbsMiddle	: 'K"ozepére',
		alignBaseline	: 'Alapvonalhoz',
		alignTextTop	: 'Sz"oveg tetejére',
		quality			: 'Min"oség',
		qualityBest		: 'Legjobb',
		qualityHigh		: 'Jó',
		qualityAutoHigh	: 'Automata jó',
		qualityMedium	: 'K"ozepes',
		qualityAutoLow	: 'Automata gyenge',
		qualityLow		: 'Gyenge',
		windowModeWindow: 'Window',
		windowModeOpaque: 'Opaque',
		windowModeTransparent : 'Transparent',
		windowMode		: 'Ablak mód',
		flashvars		: 'Flash változók',
		bgcolor			: 'Háttérszín',
		hSpace			: 'Vízsz. táv',
		vSpace			: 'Függ. táv',
		validateSrc		: 'Adja meg a hivatkozás webcímét',
		validateHSpace	: 'A vízszintes távols"uág mez"obe csak számokat írhat.',
		validateVSpace	: 'A függ"oleges távols"uág mez"obe csak számokat írhat.'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Helyesírás-ellen"orzés',
		title			: 'Helyesírás ellen"orz"o',
		notAvailable	: 'Sajnálom, de a szolgáltatás jelenleg nem elérhet"o.',
		errorLoading	: 'Hiba a szolgáltatás host bet"oltése k"ozben: %s.',
		notInDic		: 'Nincs a szótárban',
		changeTo		: 'Módosítás',
		btnIgnore		: 'Kihagyja',
		btnIgnoreAll	: 'Mindet kihagyja',
		btnReplace		: 'Csere',
		btnReplaceAll	: '"Osszes cseréje',
		btnUndo			: 'Visszavonás',
		noSuggestions	: 'Nincs javaslat',
		progress		: 'Helyesírás-ellen"orzés folyamatban...',
		noMispell		: 'Helyesírás-ellen"orzés kész: Nem találtam hibát',
		noChanges		: 'Helyesírás-ellen"orzés kész: Nincs változtatott szó',
		oneChange		: 'Helyesírás-ellen"orzés kész: Egy szó cserélve',
		manyChanges		: 'Helyesírás-ellen"orzés kész: %1 szó cserélve',
		ieSpellDownload	: 'A helyesírás-ellen"orz"o nincs telepítve. Szeretné let"olteni most?'
	},

	smiley :
	{
		toolbar	: 'Hangulatjelek',
		title	: 'Hangulatjel beszúrása',
		options : 'Hangulatjel opciók'
	},

	elementsPath :
	{
		eleLabel : 'Elem utak',
		eleTitle : '%1 elem'
	},

	numberedlist	: 'Számozás',
	bulletedlist	: 'Felsorolás',
	indent			: 'Behúzás n"ovelése',
	outdent			: 'Behúzás cs"okkentése',

	justify :
	{
		left	: 'Balra',
		center	: 'K"ozépre',
		right	: 'Jobbra',
		block	: 'Sorkizárt'
	},

	blockquote : 'Idézet blokk',

	clipboard :
	{
		title		: 'Beillesztés',
		cutError	: 'A b"ongész"o biztonsági beállításai nem engedélyezik a szerkeszt"onek, hogy végrehajtsa a kivágás m"uveletet. Használja az alábbi billenty"ukombinációt (Ctrl/Cmd+X).',
		copyError	: 'A b"ongész"o biztonsági beállításai nem engedélyezik a szerkeszt"onek, hogy végrehajtsa a másolás m"uveletet. Használja az alábbi billenty"ukombinációt (Ctrl/Cmd+X).',
		pasteMsg	: 'Másolja be az alábbi mez"obe a <STRONG>Ctrl/Cmd+V</STRONG> billenty"uk lenyomásával, majd nyomjon <STRONG>Rendben</STRONG>-t.',
		securityMsg	: 'A b"ongész"o biztonsági beállításai miatt a szerkeszt"o nem képes hozzáférni a vágólap adataihoz. Illeszd be újra ebben az ablakban.',
		pasteArea	: 'Beszúrás mez"o'
	},

	pastefromword :
	{
		confirmCleanup	: ''Ugy t"unik a beillesztett sz"oveget Word-b"ol másolt át. Meg szeretné tisztítani a sz"oveget? (ajánlott)',
		toolbar			: 'Beillesztés Word-b"ol',
		title			: 'Beillesztés Word-b"ol',
		error			: 'Egy bels"o hiba miatt nem sikerült megtisztítani a sz"oveget'
	},

	pasteText :
	{
		button	: 'Beillesztés formázatlan sz"ovegként',
		title	: 'Beillesztés formázatlan sz"ovegként'
	},

	templates :
	{
		button			: 'Sablonok',
		title			: 'Elérhet"o sablonok',
		options : 'Sablon opciók',
		insertOption	: 'Kicseréli a jelenlegi tartalmat',
		selectPromptMsg	: 'Válassza ki melyik sablon nyíljon meg a szerkeszt"oben<br>(a jelenlegi tartalom elveszik):',
		emptyListMsg	: '(Nincs sablon megadva)'
	},

	showBlocks : 'Blokkok megjelenítése',

	stylesCombo :
	{
		label		: 'Stílus',
		panelTitle	: 'Formázási stílusok',
		panelTitle1	: 'Blokk stílusok',
		panelTitle2	: 'Inline stílusok',
		panelTitle3	: 'Objektum stílusok'
	},

	format :
	{
		label		: 'Formátum',
		panelTitle	: 'Formátum',

		tag_p		: 'Normál',
		tag_pre		: 'Formázott',
		tag_address	: 'Címsor',
		tag_h1		: 'Fejléc 1',
		tag_h2		: 'Fejléc 2',
		tag_h3		: 'Fejléc 3',
		tag_h4		: 'Fejléc 4',
		tag_h5		: 'Fejléc 5',
		tag_h6		: 'Fejléc 6',
		tag_div		: 'Bekezdés (DIV)'
	},

	div :
	{
		title				: 'DIV tároló létrehozása',
		toolbar				: 'DIV tároló létrehozása',
		cssClassInputLabel	: 'Stíluslap osztály',
		styleSelectLabel	: 'Stílus',
		IdInputLabel		: 'Azonosító',
		languageCodeInputLabel	: ' Nyelv kódja',
		inlineStyleInputLabel	: 'Inline stílus',
		advisoryTitleInputLabel	: 'Tipp sz"oveg',
		langDirLabel		: 'Nyelvi irány',
		langDirLTRLabel		: 'Balról jobbra (LTR)',
		langDirRTLLabel		: 'Jobbról balra (RTL)',
		edit				: 'DIV szerkesztése',
		remove				: 'DIV eltávolítása'
  	},

	iframe :
	{
		title		: 'IFrame Tulajdonságok',
		toolbar		: 'IFrame',
		noUrl		: 'Kérem írja be a iframe URL-t',
		scrolling	: 'G"ordít"osáv bekapcsolása',
		border		: 'Legyen keret'
	},

	font :
	{
		label		: 'Bet"utípus',
		voiceLabel	: 'Bet"utípus',
		panelTitle	: 'Bet"utípus'
	},

	fontSize :
	{
		label		: 'Méret',
		voiceLabel	: 'Bet"uméret',
		panelTitle	: 'Méret'
	},

	colorButton :
	{
		textColorTitle	: 'Bet"uszín',
		bgColorTitle	: 'Háttérszín',
		panelTitle		: 'Színek',
		auto			: 'Automatikus',
		more			: 'További színek...'
	},

	colors :
	{
		'000' : 'Fekete',
		'800000' : 'Bordó',
		'8B4513' : 'Barna',
		'2F4F4F' : 'S"otét türkiz',
		'008080' : 'Türkiz',
		'000080' : 'Király kék',
		'4B0082' : 'Indigó kék',
		'696969' : 'Szürke',
		'B22222' : 'Tégla v"or"os',
		'A52A2A' : 'V"or"os',
		'DAA520' : 'Arany sárga',
		'006400' : 'S"otét z"old',
		'40E0D0' : 'Türkiz',
		'0000CD' : 'Kék',
		'800080' : 'Lila',
		'808080' : 'Szürke',
		'F00' : 'Piros',
		'FF8C00' : 'S"otét narancs',
		'FFD700' : 'Arany',
		'008000' : 'Z"old',
		'0FF' : 'Türkiz',
		'00F' : 'Kék',
		'EE82EE' : 'Rózsaszín',
		'A9A9A9' : 'S"otét szürke',
		'FFA07A' : 'Lazac',
		'FFA500' : 'Narancs',
		'FFFF00' : 'Citromsárga',
		'00FF00' : 'Neon z"old',
		'AFEEEE' : 'Világos türkiz',
		'ADD8E6' : 'Világos kék',
		'DDA0DD' : 'Világos lila',
		'D3D3D3' : 'Világos szürke',
		'FFF0F5' : 'Lavender Blush',
		'FAEBD7' : 'T"ortfehér',
		'FFFFE0' : 'Világos sárga',
		'F0FFF0' : 'Menta',
		'F0FFFF' : 'Azúr kék',
		'F0F8FF' : 'Halvány kék',
		'E6E6FA' : 'Lavender',
		'FFF' : 'Fehér'
	},

	scayt :
	{
		title			: 'Helyesírás ellen"orzés gépelés k"ozben',
		opera_title		: 'Az Opera nem támogatja',
		enable			: 'SCAYT engedélyezése',
		disable			: 'SCAYT letiltása',
		about			: 'SCAYT névjegy',
		toggle			: 'SCAYT kapcsolása',
		options			: 'Beállítások',
		langs			: 'Nyelvek',
		moreSuggestions	: 'További javaslatok',
		ignore			: 'Kihagy',
		ignoreAll		: '"Osszes kihagyása',
		addWord			: 'Szó hozzáadása',
		emptyDic		: 'A szótár nevét meg kell adni.',

		optionsTab		: 'Beállítások',
		allCaps			: 'Nagybet"us szavak kihagyása',
		ignoreDomainNames : 'Domain nevek kihagyása',
		mixedCase		: 'Kis és nagybet"ut is tartalmazó szavak kihagyása',
		mixedWithDigits	: 'Számokat tartalmazó szavak kihagyása',

		languagesTab	: 'Nyelvek',

		dictionariesTab	: 'Szótár',
		dic_field_name	: 'Szótár neve',
		dic_create		: 'Létrehozás',
		dic_restore		: 'Visszaállítás',
		dic_delete		: 'T"orlés',
		dic_rename		: ''Atnevezés',
		dic_info		: 'Kezdetben a felhasználói szótár b"ongész"o sütiben tárolódik. Azonban a sütik maximális mérete korlátozott. Amikora a szótár akkora lesz, hogy már sütiben nem lehet tárolni, akkor a szótárat tárolhatja a szerveren is. Ehhez egy nevet kell megadni a szótárhoz. Amennyiben már van szerveren tárolt szótára, adja meg a nevét és kattintson a visszaállítás gombra.',

		aboutTab		: 'Névjegy'
	},

	about :
	{
		title		: 'CKEditor névjegy',
		dlgTitle	: 'CKEditor névjegy',
		help	: 'Itt találsz segítséget: $1',
		userGuide : 'CKEditor Felhasználói útmutató',
		moreInfo	: 'Licenszelési információkért kérjük látogassa meg weboldalunkat:',
		copy		: 'Copyright &copy; $1. Minden jog fenntartva.'
	},

	maximize : 'Teljes méret',
	minimize : 'Kis méret',

	fakeobjects :
	{
		anchor		: 'Horgony',
		flash		: 'Flash animáció',
		iframe		: 'IFrame',
		hiddenfield	: 'Rejtett mez~o',
		unknown		: 'Ismeretlen objektum'
	},

	resize : 'Húzza az átméretezéshez',

	colordialog :
	{
		title		: 'Válasszon színt',
		options	:	'Szín opciók',
		highlight	: 'Nagyítás',
		selected	: 'Kiválasztott',
		clear		: '"Urítés'
	},

	toolbarCollapse	: 'Eszk"oztár "osszecsukása',
	toolbarExpand	: 'Eszk"oztár szétnyitása',

	toolbarGroups :
	{
		document : 'Dokumentum',
		clipboard : 'Vágólap/Visszavonás',
		editing : 'Szerkesztés',
		forms : '"Urlapok',
		basicstyles : 'Alapstílusok',
		paragraph : 'Bekezdés',
		links : 'Hivatkozások',
		insert : 'Beszúrás',
		styles : 'Stílusok',
		colors : 'Színek',
		tools : 'Eszk"oz"ok'
	},

	bidi :
	{
		ltr : 'Sz"oveg iránya balról jobbra',
		rtl : 'Sz"oveg iránya jobbról balra'
	},

	docprops :
	{
		label : 'Dokumentum tulajdonságai',
		title : 'Dokumentum tulajdonságai',
		design : 'Design',
		meta : 'Meta adatok',
		chooseColor : 'Válasszon',
		other : '<más>',
		docTitle :	'Oldalcím',
		charset : 	'Karakterkódolás',
		charsetOther : 'Más karakterkódolás',
		charsetASCII : 'ASCII',
		charsetCE : 'K"ozép-Európai',
		charsetCT : 'Kínai Tradicionális (Big5)',
		charsetCR : 'Cyrill',
		charsetGR : 'G"or"og',
		charsetJP : 'Japán',
		charsetKR : 'Koreai',
		charsetTR : 'T"or"ok',
		charsetUN : 'Unicode (UTF-8)',
		charsetWE : 'Nyugat-Európai',
		docType : 'Dokumentum típus fejléc',
		docTypeOther : 'Más dokumentum típus fejléc',
		xhtmlDec : 'XHTML deklarációk beillesztése',
		bgColor : 'Háttérszín',
		bgImage : 'Háttérkép cím',
		bgFixed : 'Nem g"ordíthet"o háttér',
		txtColor : 'Bet"uszín',
		margin : 'Oldal margók',
		marginTop : 'Fels"o',
		marginLeft : 'Bal',
		marginRight : 'Jobb',
		marginBottom : 'Alsó',
		metaKeywords : 'Dokumentum keres"oszavak (vessz"ovel elválasztva)',
		metaDescription : 'Dokumentum leírás',
		metaAuthor : 'Szerz"o',
		metaCopyright : 'Szerz"oi jog',
		previewHtml : '<p>Ez itt egy <strong>példa</strong>. A <a href="javascript:void(0)">CKEditor</a>-t használod.</p>'
	}
};
