/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * German language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Contains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['de'] =
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
	editorTitle : 'WYSIWYG-Editor, %1',
	editorHelp : 'Drücken Sie ALT 0 für Hilfe',

	// ARIA descriptions.
	toolbars	: 'Editor Symbolleisten',
	editor		: 'WYSIWYG-Editor',

	// Toolbar buttons without dialogs.
	source			: 'Quellcode',
	newPage			: 'Neue Seite',
	save			: 'Speichern',
	preview			: 'Vorschau',
	cut				: 'Ausschneiden',
	copy			: 'Kopieren',
	paste			: 'Einfügen',
	print			: 'Drucken',
	underline		: 'Unterstrichen',
	bold			: 'Fett',
	italic			: 'Kursiv',
	selectAll		: 'Alles ausw"ahlen',
	removeFormat	: 'Formatierungen entfernen',
	strike			: 'Durchgestrichen',
	subscript		: 'Tiefgestellt',
	superscript		: 'Hochgestellt',
	horizontalrule	: 'Horizontale Linie einfügen',
	pagebreak		: 'Seitenumbruch einfügen',
	pagebreakAlt		: 'Seitenumbruch einfügen',
	unlink			: 'Link entfernen',
	undo			: 'Rückg"angig',
	redo			: 'Wiederherstellen',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Server durchsuchen',
		url				: 'URL',
		protocol		: 'Protokoll',
		upload			: 'Hochladen',
		uploadSubmit	: 'Zum Server senden',
		image			: 'Bild',
		flash			: 'Flash',
		form			: 'Formular',
		checkbox		: 'Checkbox',
		radio			: 'Radiobutton',
		textField		: 'Textfeld einzeilig',
		textarea		: 'Textfeld mehrzeilig',
		hiddenField		: 'Verstecktes Feld',
		button			: 'Klickbutton',
		select			: 'Auswahlfeld',
		imageButton		: 'Bildbutton',
		notSet			: '<nichts>',
		id				: 'ID',
		name			: 'Name',
		langDir			: 'Schreibrichtung',
		langDirLtr		: 'Links nach Rechts (LTR)',
		langDirRtl		: 'Rechts nach Links (RTL)',
		langCode		: 'Sprachenkürzel',
		longDescr		: 'Langform URL',
		cssClass		: 'Stylesheet Klasse',
		advisoryTitle	: 'Titel Beschreibung',
		cssStyle		: 'Style',
		ok				: 'OK',
		cancel			: 'Abbrechen',
		close			: 'Schliessen',
		preview			: 'Vorschau',
		generalTab		: 'Allgemein',
		advancedTab		: 'Erweitert',
		validateNumberFailed : 'Dieser Wert ist keine Nummer.',
		confirmNewPage	: 'Alle nicht gespeicherten "Anderungen gehen verlohren. Sind Sie sicher die neue Seite zu laden?',
		confirmCancel	: 'Einige Optionen wurden ge"andert. Wollen Sie den Dialog dennoch schliessen?',
		options			: 'Optionen',
		target			: 'Zielseite',
		targetNew		: 'Neues Fenster (_blank)',
		targetTop		: 'Oberstes Fenster (_top)',
		targetSelf		: 'Gleiches Fenster (_self)',
		targetParent	: 'Oberes Fenster (_parent)',
		langDirLTR		: 'Links nach Rechts (LNR)',
		langDirRTL		: 'Rechts nach Links (RNL)',
		styles			: 'Style',
		cssClasses		: 'Stylesheet Klasse',
		width			: 'Breite',
		height			: 'H"ohe',
		align			: 'Ausrichtung',
		alignLeft		: 'Links',
		alignRight		: 'Rechts',
		alignCenter		: 'Zentriert',
		alignTop		: 'Oben',
		alignMiddle		: 'Mitte',
		alignBottom		: 'Unten',
		invalidValue	: 'Invalid value.', // MISSING
		invalidHeight	: 'H"ohe muss eine Zahl sein.',
		invalidWidth	: 'Breite muss eine Zahl sein.',
		invalidCssLength	: 'Wert spezifiziert für "%1" Feld muss ein positiver numerischer Wert sein mit oder ohne korrekte CSS Messeinheit (px, %, in, cm, mm, em, ex, pt oder pc).',
		invalidHtmlLength	: 'Wert spezifiziert für "%1" Feld muss ein positiver numerischer Wert sein mit oder ohne korrekte HTML Messeinheit (px oder %).',
		invalidInlineStyle	: 'Wert spezifiziert für inline Stilart muss enthalten ein oder mehr Tupels mit dem Format "Name : Wert" getrennt mit Semikolons.',
		cssLengthTooltip	: 'Gebe eine Zahl ein für ein Wert in pixels oder eine Zahl mit einer korrekten CSS Messeinheit (px, %, in, cm, mm, em, ex, pt oder pc).',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, nicht verfügbar</span>'
	},

	contextmenu :
	{
		options : 'Kontextmenü Optionen'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Sonderzeichen einfügen/editieren',
		title		: 'Sonderzeichen ausw"ahlen',
		options : 'Sonderzeichen Optionen'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Link einfügen/editieren',
		other 		: '<andere>',
		menu		: 'Link editieren',
		title		: 'Link',
		info		: 'Link-Info',
		target		: 'Zielseite',
		upload		: 'Hochladen',
		advanced	: 'Erweitert',
		type		: 'Link-Typ',
		toUrl		: 'URL',
		toAnchor	: 'Anker in dieser Seite',
		toEmail		: 'E-Mail',
		targetFrame		: '<Frame>',
		targetPopup		: '<Pop-up Fenster>',
		targetFrameName	: 'Ziel-Fenster-Name',
		targetPopupName	: 'Pop-up Fenster-Name',
		popupFeatures	: 'Pop-up Fenster-Eigenschaften',
		popupResizable	: 'Gr"osse "anderbar',
		popupStatusBar	: 'Statusleiste',
		popupLocationBar: 'Adress-Leiste',
		popupToolbar	: 'Symbolleiste',
		popupMenuBar	: 'Menü-Leiste',
		popupFullScreen	: 'Vollbild (IE)',
		popupScrollBars	: 'Rollbalken',
		popupDependent	: 'Abh"angig (Netscape)',
		popupLeft		: 'Linke Position',
		popupTop		: 'Obere Position',
		id				: 'Id',
		langDir			: 'Schreibrichtung',
		langDirLTR		: 'Links nach Rechts (LTR)',
		langDirRTL		: 'Rechts nach Links (RTL)',
		acccessKey		: 'Zugriffstaste',
		name			: 'Name',
		langCode			: 'Sprachenkürzel',
		tabIndex			: 'Tab-Index',
		advisoryTitle		: 'Titel Beschreibung',
		advisoryContentType	: 'Inhaltstyp',
		cssClasses		: 'Stylesheet Klasse',
		charset			: 'Ziel-Zeichensatz',
		styles			: 'Style',
		rel			: 'Beziehung',
		selectAnchor		: 'Anker ausw"ahlen',
		anchorName		: 'nach Anker Name',
		anchorId			: 'nach Element Id',
		emailAddress		: 'E-Mail Adresse',
		emailSubject		: 'Betreffzeile',
		emailBody		: 'Nachrichtentext',
		noAnchors		: '(keine Anker im Dokument vorhanden)',
		noUrl			: 'Bitte geben Sie die Link-URL an',
		noEmail			: 'Bitte geben Sie e-Mail Adresse an'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Anker einfügen/editieren',
		menu		: 'Anker-Eigenschaften',
		title		: 'Anker-Eigenschaften',
		name		: 'Anker Name',
		errorName	: 'Bitte geben Sie den Namen des Ankers ein',
		remove		: 'Anker entfernen'
	},

	// List style dialog
	list:
	{
		numberedTitle		: 'Nummerierte Listen-Eigenschaften',
		bulletedTitle		: 'Listen-Eigenschaften',
		type				: 'Typ',
		start				: 'Start',
		validateStartNumber				:'List Startnummer muss eine ganze Zahl sein.',
		circle				: 'Ring',
		disc				: 'Kreis',
		square				: 'Quadrat',
		none				: 'Keine',
		notset				: '<nicht gesetzt>',
		armenian			: 'Armenisch Nummerierung',
		georgian			: 'Georgisch Nummerierung (an, ban, gan, etc.)',
		lowerRoman			: 'Klein r"omisch (i, ii, iii, iv, v, etc.)',
		upperRoman			: 'Gross r"omisch (I, II, III, IV, V, etc.)',
		lowerAlpha			: 'Klein alpha (a, b, c, d, e, etc.)',
		upperAlpha			: 'Gross alpha (A, B, C, D, E, etc.)',
		lowerGreek			: 'Klein griechisch (alpha, beta, gamma, etc.)',
		decimal				: 'Dezimal (1, 2, 3, etc.)',
		decimalLeadingZero	: 'Dezimal mit führende  Null (01, 02, 03, etc.)'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Suchen und Ersetzen',
		find				: 'Suchen',
		replace				: 'Ersetzen',
		findWhat			: 'Suche nach:',
		replaceWith			: 'Ersetze mit:',
		notFoundMsg			: 'Der gesuchte Text wurde nicht gefunden.',
		findOptions			: 'Suchoptionen',
		matchCase			: 'Gross-Kleinschreibung beachten',
		matchWord			: 'Nur ganze Worte suchen',
		matchCyclic			: 'Zyklische Suche',
		replaceAll			: 'Alle ersetzen',
		replaceSuccessMsg	: '%1 vorkommen ersetzt.'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Tabelle',
		title		: 'Tabellen-Eigenschaften',
		menu		: 'Tabellen-Eigenschaften',
		deleteTable	: 'Tabelle l"oschen',
		rows		: 'Zeile',
		columns		: 'Spalte',
		border		: 'Rahmen',
		widthPx		: 'Pixel',
		widthPc		: '%',
		widthUnit	: 'Breite Einheit',
		cellSpace	: 'Zellenabstand aussen',
		cellPad		: 'Zellenabstand innen',
		caption		: '"Uberschrift',
		summary		: 'Inhaltsübersicht',
		headers		: 'Kopfzeile',
		headersNone		: 'Keine',
		headersColumn	: 'Erste Spalte',
		headersRow		: 'Erste Zeile',
		headersBoth		: 'Beide',
		invalidRows		: 'Die Anzahl der Zeilen muss gr"osser als 0 sein.',
		invalidCols		: 'Die Anzahl der Spalten muss gr"osser als 0 sein..',
		invalidBorder	: 'Die Rahmenbreite muss eine Zahl sein.',
		invalidWidth	: 'Die Tabellenbreite muss eine Zahl sein.',
		invalidHeight	: 'Die Tabellenbreite muss eine Zahl sein.',
		invalidCellSpacing	: 'Der Zellenabstand aussen muss eine positive Zahl sein.',
		invalidCellPadding	: 'Der Zellenabstand innen muss eine positive Zahl sein.',

		cell :
		{
			menu			: 'Zelle',
			insertBefore	: 'Zelle davor einfügen',
			insertAfter		: 'Zelle danach einfügen',
			deleteCell		: 'Zelle l"oschen',
			merge			: 'Zellen verbinden',
			mergeRight		: 'Nach rechts verbinden',
			mergeDown		: 'Nach unten verbinden',
			splitHorizontal	: 'Zelle horizontal teilen',
			splitVertical	: 'Zelle vertikal teilen',
			title			: 'Zellen-Eigenschaften',
			cellType		: 'Zellart',
			rowSpan			: 'Anzahl Zeilen verbinden',
			colSpan			: 'Anzahl Spalten verbinden',
			wordWrap		: 'Zeilenumbruch',
			hAlign			: 'Horizontale Ausrichtung',
			vAlign			: 'Vertikale Ausrichtung',
			alignBaseline	: 'Grundlinie',
			bgColor			: 'Hintergrundfarbe',
			borderColor		: 'Rahmenfarbe',
			data			: 'Daten',
			header			: '"Uberschrift',
			yes				: 'Ja',
			no				: 'Nein',
			invalidWidth	: 'Zellenbreite muss eine Zahl sein.',
			invalidHeight	: 'Zellenh"ohe muss eine Zahl sein.',
			invalidRowSpan	: '"Anzahl Zeilen verbinden" muss eine Ganzzahl sein.',
			invalidColSpan	: '"Anzahl Spalten verbinden" muss eine Ganzzahl sein.',
			chooseColor		: 'W"ahlen'
		},

		row :
		{
			menu			: 'Zeile',
			insertBefore	: 'Zeile oberhalb einfügen',
			insertAfter		: 'Zeile unterhalb einfügen',
			deleteRow		: 'Zeile entfernen'
		},

		column :
		{
			menu			: 'Spalte',
			insertBefore	: 'Spalte links davor einfügen',
			insertAfter		: 'Spalte rechts danach einfügen',
			deleteColumn	: 'Spalte l"oschen'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Button-Eigenschaften',
		text		: 'Text (Wert)',
		type		: 'Typ',
		typeBtn		: 'Button',
		typeSbm		: 'Absenden',
		typeRst		: 'Zurücksetzen'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Checkbox-Eigenschaften',
		radioTitle	: 'Optionsfeld-Eigenschaften',
		value		: 'Wert',
		selected	: 'ausgew"ahlt'
	},

	// Form Dialog.
	form :
	{
		title		: 'Formular-Eigenschaften',
		menu		: 'Formular-Eigenschaften',
		action		: 'Action',
		method		: 'Method',
		encoding	: 'Zeichenkodierung'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Auswahlfeld-Eigenschaften',
		selectInfo	: 'Info',
		opAvail		: 'M"ogliche Optionen',
		value		: 'Wert',
		size		: 'Gr"osse',
		lines		: 'Linien',
		chkMulti	: 'Erlaube Mehrfachauswahl',
		opText		: 'Text',
		opValue		: 'Wert',
		btnAdd		: 'Hinzufügen',
		btnModify	: '"Andern',
		btnUp		: 'Hoch',
		btnDown		: 'Runter',
		btnSetValue : 'Setze als Standardwert',
		btnDelete	: 'Entfernen'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Textfeld (mehrzeilig) Eigenschaften',
		cols		: 'Spalten',
		rows		: 'Reihen'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Textfeld (einzeilig) Eigenschaften',
		name		: 'Name',
		value		: 'Wert',
		charWidth	: 'Zeichenbreite',
		maxChars	: 'Max. Zeichen',
		type		: 'Typ',
		typeText	: 'Text',
		typePass	: 'Passwort'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Verstecktes Feld-Eigenschaften',
		name	: 'Name',
		value	: 'Wert'
	},

	// Image Dialog.
	image :
	{
		title		: 'Bild-Eigenschaften',
		titleButton	: 'Bildbutton-Eigenschaften',
		menu		: 'Bild-Eigenschaften',
		infoTab		: 'Bild-Info',
		btnUpload	: 'Zum Server senden',
		upload		: 'Hochladen',
		alt			: 'Alternativer Text',
		lockRatio	: 'Gr"ossenverh"altnis beibehalten',
		resetSize	: 'Gr"osse zurücksetzen',
		border		: 'Rahmen',
		hSpace		: 'Horizontal-Abstand',
		vSpace		: 'Vertikal-Abstand',
		alertUrl	: 'Bitte geben Sie die Bild-URL an',
		linkTab		: 'Link',
		button2Img	: 'M"ochten Sie den gew"ahlten Bild-Button in ein einfaches Bild umwandeln?',
		img2Button	: 'M"ochten Sie das gew"ahlten Bild in einen Bild-Button umwandeln?',
		urlMissing	: 'Imagequelle URL fehlt.',
		validateBorder	: 'Rahmen muss eine ganze Zahl sein.',
		validateHSpace	: 'Horizontal-Abstand muss eine ganze Zahl sein.',
		validateVSpace	: 'Vertikal-Abstand muss eine ganze Zahl sein.'
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Flash-Eigenschaften',
		propertiesTab	: 'Eigenschaften',
		title			: 'Flash-Eigenschaften',
		chkPlay			: 'Automatisch Abspielen',
		chkLoop			: 'Endlosschleife',
		chkMenu			: 'Flash-Menü aktivieren',
		chkFull			: 'Vollbildmodus erlauben',
 		scale			: 'Skalierung',
		scaleAll		: 'Alles anzeigen',
		scaleNoBorder	: 'Ohne Rand',
		scaleFit		: 'Passgenau',
		access			: 'Skript Zugang',
		accessAlways	: 'Immer',
		accessSameDomain: 'Gleiche Domain',
		accessNever		: 'Nie',
		alignAbsBottom	: 'Abs Unten',
		alignAbsMiddle	: 'Abs Mitte',
		alignBaseline	: 'Baseline',
		alignTextTop	: 'Text Oben',
		quality			: 'Qualit"at',
		qualityBest		: 'Beste',
		qualityHigh		: 'Hoch',
		qualityAutoHigh	: 'Auto Hoch',
		qualityMedium	: 'Medium',
		qualityAutoLow	: 'Auto Niedrig',
		qualityLow		: 'Niedrig',
		windowModeWindow: 'Fenster',
		windowModeOpaque: 'Deckend',
		windowModeTransparent : 'Transparent',
		windowMode		: 'Fenster Modus',
		flashvars		: 'Variablen für Flash',
		bgcolor			: 'Hintergrundfarbe',
		hSpace			: 'Horizontal-Abstand',
		vSpace			: 'Vertikal-Abstand',
		validateSrc		: 'Bitte geben Sie die Link-URL an',
		validateHSpace	: 'HSpace muss eine Zahl sein.',
		validateVSpace	: 'VSpace muss eine Zahl sein.'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Rechtschreibprüfung',
		title			: 'Rechtschreibprüfung',
		notAvailable	: 'Entschuldigung, aber dieser Dienst steht im Moment nicht zur Verfügung.',
		errorLoading	: 'Fehler beim laden des Dienstanbieters: %s.',
		notInDic		: 'Nicht im W"orterbuch',
		changeTo		: '"Andern in',
		btnIgnore		: 'Ignorieren',
		btnIgnoreAll	: 'Alle Ignorieren',
		btnReplace		: 'Ersetzen',
		btnReplaceAll	: 'Alle Ersetzen',
		btnUndo			: 'Rückg"angig',
		noSuggestions	: ' - keine Vorschl"age - ',
		progress		: 'Rechtschreibprüfung l"auft...',
		noMispell		: 'Rechtschreibprüfung abgeschlossen - keine Fehler gefunden',
		noChanges		: 'Rechtschreibprüfung abgeschlossen - keine Worte ge"andert',
		oneChange		: 'Rechtschreibprüfung abgeschlossen - ein Wort ge"andert',
		manyChanges		: 'Rechtschreibprüfung abgeschlossen - %1 W"orter ge"andert',
		ieSpellDownload	: 'Rechtschreibprüfung nicht installiert. M"ochten Sie sie jetzt herunterladen?'
	},

	smiley :
	{
		toolbar	: 'Smiley',
		title	: 'Smiley ausw"ahlen',
		options : 'Smiley Optionen'
	},

	elementsPath :
	{
		eleLabel : 'Elements Pfad',
		eleTitle : '%1 Element'
	},

	numberedlist	: 'Nummerierte Liste',
	bulletedlist	: 'Liste',
	indent			: 'Einzug erh"ohen',
	outdent			: 'Einzug verringern',

	justify :
	{
		left	: 'Linksbündig',
		center	: 'Zentriert',
		right	: 'Rechtsbündig',
		block	: 'Blocksatz'
	},

	blockquote : 'Zitatblock',

	clipboard :
	{
		title		: 'Einfügen',
		cutError	: 'Die Sicherheitseinstellungen Ihres Browsers lassen es nicht zu, den Text automatisch auszuschneiden. Bitte benutzen Sie die System-Zwischenablage über STRG-X (ausschneiden) und STRG-V (einfügen).',
		copyError	: 'Die Sicherheitseinstellungen Ihres Browsers lassen es nicht zu, den Text automatisch kopieren. Bitte benutzen Sie die System-Zwischenablage über STRG-C (kopieren).',
		pasteMsg	: 'Bitte fügen Sie den Text in der folgenden Box über die Tastatur (mit <STRONG>Strg+V</STRONG>) ein und best"atigen Sie mit <STRONG>OK</STRONG>.',
		securityMsg	: 'Aufgrund von Sicherheitsbeschr"ankungen Ihres Browsers kann der Editor nicht direkt auf die Zwischenablage zugreifen. Bitte fügen Sie den Inhalt erneut in diesem Fenster ein.',
		pasteArea	: 'Einfügebereich'
	},

	pastefromword :
	{
		confirmCleanup	: 'Der Text, den Sie einfügen m"ochten, scheint aus MS-Word kopiert zu sein. M"ochten Sie ihn zuvor bereinigen lassen?',
		toolbar			: 'Aus MS-Word einfügen',
		title			: 'Aus MS-Word einfügen',
		error			: 'Aufgrund eines internen Fehlers war es nicht m"oglich die eingefügten Daten zu bereinigen'
	},

	pasteText :
	{
		button	: 'Als Text einfügen',
		title	: 'Als Text einfügen'
	},

	templates :
	{
		button			: 'Vorlagen',
		title			: 'Vorlagen',
		options : 'Vorlagen Optionen',
		insertOption	: 'Aktuellen Inhalt ersetzen',
		selectPromptMsg	: 'Klicken Sie auf eine Vorlage, um sie im Editor zu "offnen (der aktuelle Inhalt wird dabei gel"oscht!):',
		emptyListMsg	: '(keine Vorlagen definiert)'
	},

	showBlocks : 'Bl"ocke anzeigen',

	stylesCombo :
	{
		label		: 'Stil',
		panelTitle	: 'Formatierungenstil',
		panelTitle1	: 'Block Stilart',
		panelTitle2	: 'Inline Stilart',
		panelTitle3	: 'Objekt Stilart'
	},

	format :
	{
		label		: 'Format',
		panelTitle	: 'Format',

		tag_p		: 'Normal',
		tag_pre		: 'Formatiert',
		tag_address	: 'Addresse',
		tag_h1		: '"Uberschrift 1',
		tag_h2		: '"Uberschrift 2',
		tag_h3		: '"Uberschrift 3',
		tag_h4		: '"Uberschrift 4',
		tag_h5		: '"Uberschrift 5',
		tag_h6		: '"Uberschrift 6',
		tag_div		: 'Normal (DIV)'
	},

	div :
	{
		title				: 'Div Container erzeugen',
		toolbar				: 'Div Container erzeugen',
		cssClassInputLabel	: 'Stylesheet Klasse',
		styleSelectLabel	: 'Style',
		IdInputLabel		: 'Id',
		languageCodeInputLabel	: 'Sprachenkürzel',
		inlineStyleInputLabel	: 'Inline Stil',
		advisoryTitleInputLabel	: 'Tooltip',
		langDirLabel		: 'Sprache Richtung',
		langDirLTRLabel		: 'Links nach Rechs (LTR)',
		langDirRTLLabel		: 'Rechs nach Links (RTL)',
		edit				: 'Div bearbeiten',
		remove				: 'Div entfernen'
  	},

	iframe :
	{
		title		: 'IFrame-Eigenschaften',
		toolbar		: 'IFrame',
		noUrl		: 'Bitte geben Sie die IFrame-URL an',
		scrolling	: 'Rollbalken anzeigen',
		border		: 'Rahmen anzeigen'
	},

	font :
	{
		label		: 'Schriftart',
		voiceLabel	: 'Schriftart',
		panelTitle	: 'Schriftart'
	},

	fontSize :
	{
		label		: 'Gr"osse',
		voiceLabel	: 'Schrifgr"osse',
		panelTitle	: 'Gr"osse'
	},

	colorButton :
	{
		textColorTitle	: 'Textfarbe',
		bgColorTitle	: 'Hintergrundfarbe',
		panelTitle		: 'Farben',
		auto			: 'Automatisch',
		more			: 'Weitere Farben...'
	},

	colors :
	{
		'000' : 'Schwarz',
		'800000' : 'Kastanienbraun',
		'8B4513' : 'Braun',
		'2F4F4F' : 'Dunkles Schiefergrau',
		'008080' : 'Blaugrün',
		'000080' : 'Navy',
		'4B0082' : 'Indigo',
		'696969' : 'Dunkelgrau',
		'B22222' : 'Ziegelrot',
		'A52A2A' : 'Braun',
		'DAA520' : 'Goldgelb',
		'006400' : 'Dunkelgrün',
		'40E0D0' : 'Türkis',
		'0000CD' : 'Medium Blau',
		'800080' : 'Lila',
		'808080' : 'Grau',
		'F00' : 'Rot',
		'FF8C00' : 'Dunkelorange',
		'FFD700' : 'Gold',
		'008000' : 'Grün',
		'0FF' : 'Cyan',
		'00F' : 'Blau',
		'EE82EE' : 'Hellviolett',
		'A9A9A9' : 'Dunkelgrau',
		'FFA07A' : 'Helles Lachsrosa',
		'FFA500' : 'Orange',
		'FFFF00' : 'Gelb',
		'00FF00' : 'Lime',
		'AFEEEE' : 'Blass-Türkis',
		'ADD8E6' : 'Hellblau',
		'DDA0DD' : 'Pflaumenblau',
		'D3D3D3' : 'Hellgrau',
		'FFF0F5' : 'Lavendel',
		'FAEBD7' : 'Antik Weiss',
		'FFFFE0' : 'Hellgelb',
		'F0FFF0' : 'Honigtau',
		'F0FFFF' : 'Azurblau',
		'F0F8FF' : 'Alice Blau',
		'E6E6FA' : 'Lavendel',
		'FFF' : 'Weiss'
	},

	scayt :
	{
		title			: 'Rechtschreibprüfung w"ahrend der Texteingabe (SCAYT)',
		opera_title		: 'Nicht von Opera unterstützt',
		enable			: 'SCAYT einschalten',
		disable			: 'SCAYT ausschalten',
		about			: '"Uber SCAYT',
		toggle			: 'SCAYT umschalten',
		options			: 'Optionen',
		langs			: 'Sprachen',
		moreSuggestions	: 'Mehr Vorschl"age',
		ignore			: 'Ignorieren',
		ignoreAll		: 'Alle ignorieren',
		addWord			: 'Wort hinzufügen',
		emptyDic		: 'W"orterbuchname sollte leer sein.',

		optionsTab		: 'Optionen',
		allCaps			: 'Gross geschriebenen W"orter ignorieren',
		ignoreDomainNames : 'Domain-Namen ignorieren',
		mixedCase		: 'W"orter mit gemischte Setzkasten ignorieren',
		mixedWithDigits	: 'W"orter mit Zahlen ignorieren',

		languagesTab	: 'Sprachen',

		dictionariesTab	: 'W"orterbücher',
		dic_field_name	: 'W"orterbuchname',
		dic_create		: 'Erzeugen',
		dic_restore		: 'Wiederherstellen',
		dic_delete		: 'L"oschen',
		dic_rename		: 'Umbenennen',
		dic_info		: 'Anfangs wird das Benutzerw"orterbuch in einem Cookie gespeichert. Allerdings sind Cookies in der Gr"osse begrenzt. Wenn das Benutzerw"orterbuch bis zu einem Punkt w"achst, wo es nicht mehr in einem Cookie gespeichert werden kann, wird das Benutzerw"orterbuch auf dem Server gespeichert. Um Ihr pers"onliches W"orterbuch auf dem Server zu speichern, müssen Sie einen Namen für das W"orterbuch angeben. Falls  Sie schon ein gespeicherte W"orterbuch haben, geben Sie bitte dessen Namen ein und klicken Sie auf die Schaltfl"ache Wiederherstellen.',

		aboutTab		: '"Uber'
	},

	about :
	{
		title		: '"Uber CKEditor',
		dlgTitle	: '"Uber CKEditor',
		help	: 'Prüfe $1 für Hilfe.',
		userGuide : 'CKEditor Benutzerhandbuch',
		moreInfo	: 'Für Informationen über unsere Lizenzbestimmungen besuchen sie bitte unsere Webseite:',
		copy		: 'Copyright &copy; $1. Alle Rechte vorbehalten.'
	},

	maximize : 'Maximieren',
	minimize : 'Minimieren',

	fakeobjects :
	{
		anchor		: 'Anker',
		flash		: 'Flash Animation',
		iframe		: 'IFrame',
		hiddenfield	: 'Verstecktes Feld',
		unknown		: 'Unbekanntes Objekt'
	},

	resize : 'Zum Vergr"ossern ziehen',

	colordialog :
	{
		title		: 'Farbe w"ahlen',
		options	:	'Farbeoptionen',
		highlight	: 'Hervorheben',
		selected	: 'Ausgew"ahlte Farbe',
		clear		: 'Entfernen'
	},

	toolbarCollapse	: 'Symbolleiste einklappen',
	toolbarExpand	: 'Symbolleiste ausklappen',

	toolbarGroups :
	{
		document : 'Dokument',
		clipboard : 'Zwischenablage/Rückg"angig',
		editing : 'Editieren',
		forms : 'Formularen',
		basicstyles : 'Grundstile',
		paragraph : 'Absatz',
		links : 'Links',
		insert : 'Einfügen',
		styles : 'Stile',
		colors : 'Farben',
		tools : 'Werkzeuge'
	},

	bidi :
	{
		ltr : 'Leserichtung von Links nach Rechts',
		rtl : 'Leserichtung von Rechts nach Links'
	},

	docprops :
	{
		label : 'Dokument-Eigenschaften',
		title : 'Dokument-Eigenschaften',
		design : 'Design',
		meta : 'Metadaten',
		chooseColor : 'W"ahlen',
		other : '<andere>',
		docTitle :	'Seitentitel',
		charset : 	'Zeichenkodierung',
		charsetOther : 'Andere Zeichenkodierung',
		charsetASCII : 'ASCII',
		charsetCE : 'Zentraleurop"aisch',
		charsetCT : 'traditionell Chinesisch (Big5)',
		charsetCR : 'Kyrillisch',
		charsetGR : 'Griechisch',
		charsetJP : 'Japanisch',
		charsetKR : 'Koreanisch',
		charsetTR : 'Türkisch',
		charsetUN : 'Unicode (UTF-8)',
		charsetWE : 'Westeurop"aisch',
		docType : 'Dokumententyp',
		docTypeOther : 'Anderer Dokumententyp',
		xhtmlDec : 'Beziehe XHTML Deklarationen ein',
		bgColor : 'Hintergrundfarbe',
		bgImage : 'Hintergrundbild URL',
		bgFixed : 'feststehender Hintergrund',
		txtColor : 'Textfarbe',
		margin : 'Seitenr"ander',
		marginTop : 'Oben',
		marginLeft : 'Links',
		marginRight : 'Rechts',
		marginBottom : 'Unten',
		metaKeywords : 'Schlüsselw"orter (durch Komma getrennt)',
		metaDescription : 'Dokument-Beschreibung',
		metaAuthor : 'Autor',
		metaCopyright : 'Copyright',
		previewHtml : '<p>Das ist ein <strong>Beispieltext</strong>. Du schreibst in <a href="javascript:void(0)">CKEditor</a>.</p>'
	}
};
