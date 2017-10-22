/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Norwegian language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Contains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['no'] =
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
	editorTitle : 'Rikteksteditor, %1',
	editorHelp : 'Trykk ALT 0 for hjelp',

	// ARIA descriptions.
	toolbars	: 'Verktoylinjer for editor',
	editor		: 'Rikteksteditor',

	// Toolbar buttons without dialogs.
	source			: 'Kilde',
	newPage			: 'Ny side',
	save			: 'Lagre',
	preview			: 'Forhandsvis',
	cut				: 'Klipp ut',
	copy			: 'Kopier',
	paste			: 'Lim inn',
	print			: 'Skriv ut',
	underline		: 'Understreking',
	bold			: 'Fet',
	italic			: 'Kursiv',
	selectAll		: 'Merk alt',
	removeFormat	: 'Fjern formatering',
	strike			: 'Gjennomstreking',
	subscript		: 'Senket skrift',
	superscript		: 'Hevet skrift',
	horizontalrule	: 'Sett inn horisontal linje',
	pagebreak		: 'Sett inn sideskift for utskrift',
	pagebreakAlt		: 'Sideskift',
	unlink			: 'Fjern lenke',
	undo			: 'Angre',
	redo			: 'Gjor om',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Bla igjennom server',
		url				: 'URL',
		protocol		: 'Protokoll',
		upload			: 'Last opp',
		uploadSubmit	: 'Send det til serveren',
		image			: 'Bilde',
		flash			: 'Flash',
		form			: 'Skjema',
		checkbox		: 'Avmerkingsboks',
		radio			: 'Alternativknapp',
		textField		: 'Tekstboks',
		textarea		: 'Tekstomrade',
		hiddenField		: 'Skjult felt',
		button			: 'Knapp',
		select			: 'Rullegardinliste',
		imageButton		: 'Bildeknapp',
		notSet			: '<ikke satt>',
		id				: 'Id',
		name			: 'Navn',
		langDir			: 'Sprakretning',
		langDirLtr		: 'Venstre til hoyre (VTH)',
		langDirRtl		: 'Hoyre til venstre (HTV)',
		langCode		: 'Sprakkode',
		longDescr		: 'Utvidet beskrivelse',
		cssClass		: 'Stilarkklasser',
		advisoryTitle	: 'Tittel',
		cssStyle		: 'Stil',
		ok				: 'OK',
		cancel			: 'Avbryt',
		close			: 'Lukk',
		preview			: 'Forhandsvis',
		generalTab		: 'Generelt',
		advancedTab		: 'Avansert',
		validateNumberFailed : 'Denne verdien er ikke et tall.',
		confirmNewPage	: 'Alle ulagrede endringer som er gjort i dette innholdet vil bli tapt. Er du sikker pa at du vil laste en ny side?',
		confirmCancel	: 'Noen av valgene har blitt endret. Er du sikker pa at du vil lukke dialogen?',
		options			: 'Valg',
		target			: 'Mal',
		targetNew		: 'Nytt vindu (_blank)',
		targetTop		: 'Hele vindu (_top)',
		targetSelf		: 'Samme vindu (_self)',
		targetParent	: 'Foreldrevindu (_parent)',
		langDirLTR		: 'Venstre til hoyre (VTH)',
		langDirRTL		: 'Hoyre til venstre (HTV)',
		styles			: 'Stil',
		cssClasses		: 'Stilarkklasser',
		width			: 'Bredde',
		height			: 'Hoyde',
		align			: 'Juster',
		alignLeft		: 'Venstre',
		alignRight		: 'Hoyre',
		alignCenter		: 'Midtjuster',
		alignTop		: 'Topp',
		alignMiddle		: 'Midten',
		alignBottom		: 'Bunn',
		invalidValue	: 'Ugyldig verdi.',
		invalidHeight	: 'Hoyde ma vaere et tall.',
		invalidWidth	: 'Bredde ma vaere et tall.',
		invalidCssLength	: 'Den angitte verdien for feltet "%1" ma vaere et positivt tall med eller uten en gyldig CSS-malingsenhet (px, %, in, cm, mm, em, ex, pt, eller pc).',
		invalidHtmlLength	: 'Den angitte verdien for feltet "%1" ma vaere et positivt tall med eller uten en gyldig HTML-malingsenhet (px eller %).',
		invalidInlineStyle	: 'Verdi angitt for inline stil ma besta av en eller flere sett med formatet "navn : verdi", separert med semikolon',
		cssLengthTooltip	: 'Skriv inn et tall for en piksel-verdi eller et tall med en gyldig CSS-enhet (px, %, in, cm, mm, em, ex, pt, eller pc).',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, utilgjenglig</span>'
	},

	contextmenu :
	{
		options : 'Alternativer for hoyreklikkmeny'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Sett inn spesialtegn',
		title		: 'Velg spesialtegn',
		options : 'Alternativer for spesialtegn'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Sett inn/Rediger lenke',
		other 		: '<annen>',
		menu		: 'Rediger lenke',
		title		: 'Lenke',
		info		: 'Lenkeinfo',
		target		: 'Mal',
		upload		: 'Last opp',
		advanced	: 'Avansert',
		type		: 'Lenketype',
		toUrl		: 'URL',
		toAnchor	: 'Lenke til anker i teksten',
		toEmail		: 'E-post',
		targetFrame		: '<ramme>',
		targetPopup		: '<popup-vindu>',
		targetFrameName	: 'Malramme',
		targetPopupName	: 'Navn pa popup-vindu',
		popupFeatures	: 'Egenskaper for popup-vindu',
		popupResizable	: 'Skalerbar',
		popupStatusBar	: 'Statuslinje',
		popupLocationBar: 'Adresselinje',
		popupToolbar	: 'Verktoylinje',
		popupMenuBar	: 'Menylinje',
		popupFullScreen	: 'Fullskjerm (IE)',
		popupScrollBars	: 'Scrollbar',
		popupDependent	: 'Avhenging (Netscape)',
		popupLeft		: 'Venstre posisjon',
		popupTop		: 'Topp-posisjon',
		id				: 'Id',
		langDir			: 'Sprakretning',
		langDirLTR		: 'Venstre til hoyre (VTH)',
		langDirRTL		: 'Hoyre til venstre (HTV)',
		acccessKey		: 'Aksessknapp',
		name			: 'Navn',
		langCode			: 'Sprakkode',
		tabIndex			: 'Tabindeks',
		advisoryTitle		: 'Tittel',
		advisoryContentType	: 'Type',
		cssClasses		: 'Stilarkklasser',
		charset			: 'Lenket tegnsett',
		styles			: 'Stil',
		rel			: 'Relasjon (rel)',
		selectAnchor		: 'Velg et anker',
		anchorName		: 'Anker etter navn',
		anchorId			: 'Element etter ID',
		emailAddress		: 'E-postadresse',
		emailSubject		: 'Meldingsemne',
		emailBody		: 'Melding',
		noAnchors		: '(Ingen anker i dokumentet)',
		noUrl			: 'Vennligst skriv inn lenkens URL',
		noEmail			: 'Vennligst skriv inn e-postadressen'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Sett inn/Rediger anker',
		menu		: 'Egenskaper for anker',
		title		: 'Egenskaper for anker',
		name		: 'Ankernavn',
		errorName	: 'Vennligst skriv inn ankernavnet',
		remove		: 'Fjern anker'
	},

	// List style dialog
	list:
	{
		numberedTitle		: 'Egenskaper for nummerert liste',
		bulletedTitle		: 'Egenskaper for punktmerket liste',
		type				: 'Type',
		start				: 'Start',
		validateStartNumber				:'Starten pa listen ma vaere et heltall.',
		circle				: 'Sirkel',
		disc				: 'Disk',
		square				: 'Firkant',
		none				: 'Ingen',
		notset				: '<ikke satt>',
		armenian			: 'Armensk nummerering',
		georgian			: 'Georgisk nummerering (an, ban, gan, osv.)',
		lowerRoman			: 'Romertall, sma (i, ii, iii, iv, v, osv.)',
		upperRoman			: 'Romertall, store (I, II, III, IV, V, osv.)',
		lowerAlpha			: 'Alfabetisk, sma (a, b, c, d, e, osv.)',
		upperAlpha			: 'Alfabetisk, store (A, B, C, D, E, osv.)',
		lowerGreek			: 'Gresk, sma (alpha, beta, gamma, osv.)',
		decimal				: 'Tall (1, 2, 3, osv.)',
		decimalLeadingZero	: 'Tall, med forstesiffer null (01, 02, 03, osv.)'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Sok og erstatt',
		find				: 'Sok',
		replace				: 'Erstatt',
		findWhat			: 'Sok etter:',
		replaceWith			: 'Erstatt med:',
		notFoundMsg			: 'Fant ikke soketeksten.',
		findOptions			: 'Sokealternativer',
		matchCase			: 'Skill mellom store og sma bokstaver',
		matchWord			: 'Bare hele ord',
		matchCyclic			: 'Sok i hele dokumentet',
		replaceAll			: 'Erstatt alle',
		replaceSuccessMsg	: '%1 tilfelle(r) erstattet.'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Tabell',
		title		: 'Egenskaper for tabell',
		menu		: 'Egenskaper for tabell',
		deleteTable	: 'Slett tabell',
		rows		: 'Rader',
		columns		: 'Kolonner',
		border		: 'Rammestorrelse',
		widthPx		: 'piksler',
		widthPc		: 'prosent',
		widthUnit	: 'Bredde-enhet',
		cellSpace	: 'Cellemarg',
		cellPad		: 'Cellepolstring',
		caption		: 'Tittel',
		summary		: 'Sammendrag',
		headers		: 'Overskrifter',
		headersNone		: 'Ingen',
		headersColumn	: 'Forste kolonne',
		headersRow		: 'Forste rad',
		headersBoth		: 'Begge',
		invalidRows		: 'Antall rader ma vaere et tall storre enn 0.',
		invalidCols		: 'Antall kolonner ma vaere et tall storre enn 0.',
		invalidBorder	: 'Rammestorrelse ma vaere et tall.',
		invalidWidth	: 'Tabellbredde ma vaere et tall.',
		invalidHeight	: 'Tabellhoyde ma vaere et tall.',
		invalidCellSpacing	: 'Cellemarg ma vaere et positivt tall.',
		invalidCellPadding	: 'Cellepolstring ma vaere et positivt tall.',

		cell :
		{
			menu			: 'Celle',
			insertBefore	: 'Sett inn celle for',
			insertAfter		: 'Sett inn celle etter',
			deleteCell		: 'Slett celler',
			merge			: 'Sla sammen celler',
			mergeRight		: 'Sla sammen hoyre',
			mergeDown		: 'Sla sammen ned',
			splitHorizontal	: 'Del celle horisontalt',
			splitVertical	: 'Del celle vertikalt',
			title			: 'Celleegenskaper',
			cellType		: 'Celletype',
			rowSpan			: 'Radspenn',
			colSpan			: 'Kolonnespenn',
			wordWrap		: 'Tekstbrytning',
			hAlign			: 'Horisontal justering',
			vAlign			: 'Vertikal justering',
			alignBaseline	: 'Grunnlinje',
			bgColor			: 'Bakgrunnsfarge',
			borderColor		: 'Rammefarge',
			data			: 'Data',
			header			: 'Overskrift',
			yes				: 'Ja',
			no				: 'Nei',
			invalidWidth	: 'Cellebredde ma vaere et tall.',
			invalidHeight	: 'Cellehoyde ma vaere et tall.',
			invalidRowSpan	: 'Radspenn ma vaere et heltall.',
			invalidColSpan	: 'Kolonnespenn ma vaere et heltall.',
			chooseColor		: 'Velg'
		},

		row :
		{
			menu			: 'Rader',
			insertBefore	: 'Sett inn rad for',
			insertAfter		: 'Sett inn rad etter',
			deleteRow		: 'Slett rader'
		},

		column :
		{
			menu			: 'Kolonne',
			insertBefore	: 'Sett inn kolonne for',
			insertAfter		: 'Sett inn kolonne etter',
			deleteColumn	: 'Slett kolonner'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Egenskaper for knapp',
		text		: 'Tekst (verdi)',
		type		: 'Type',
		typeBtn		: 'Knapp',
		typeSbm		: 'Send',
		typeRst		: 'Nullstill'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Egenskaper for avmerkingsboks',
		radioTitle	: 'Egenskaper for alternativknapp',
		value		: 'Verdi',
		selected	: 'Valgt'
	},

	// Form Dialog.
	form :
	{
		title		: 'Egenskaper for skjema',
		menu		: 'Egenskaper for skjema',
		action		: 'Handling',
		method		: 'Metode',
		encoding	: 'Encoding'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Egenskaper for rullegardinliste',
		selectInfo	: 'Info',
		opAvail		: 'Tilgjenglige alternativer',
		value		: 'Verdi',
		size		: 'Storrelse',
		lines		: 'Linjer',
		chkMulti	: 'Tillat flervalg',
		opText		: 'Tekst',
		opValue		: 'Verdi',
		btnAdd		: 'Legg til',
		btnModify	: 'Endre',
		btnUp		: 'Opp',
		btnDown		: 'Ned',
		btnSetValue : 'Sett som valgt',
		btnDelete	: 'Slett'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Egenskaper for tekstomrade',
		cols		: 'Kolonner',
		rows		: 'Rader'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Egenskaper for tekstfelt',
		name		: 'Navn',
		value		: 'Verdi',
		charWidth	: 'Tegnbredde',
		maxChars	: 'Maks antall tegn',
		type		: 'Type',
		typeText	: 'Tekst',
		typePass	: 'Passord'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Egenskaper for skjult felt',
		name	: 'Navn',
		value	: 'Verdi'
	},

	// Image Dialog.
	image :
	{
		title		: 'Bildeegenskaper',
		titleButton	: 'Egenskaper for bildeknapp',
		menu		: 'Bildeegenskaper',
		infoTab		: 'Bildeinformasjon',
		btnUpload	: 'Send det til serveren',
		upload		: 'Last opp',
		alt			: 'Alternativ tekst',
		lockRatio	: 'Las forhold',
		resetSize	: 'Tilbakestill storrelse',
		border		: 'Ramme',
		hSpace		: 'HMarg',
		vSpace		: 'VMarg',
		alertUrl	: 'Vennligst skriv bilde-urlen',
		linkTab		: 'Lenke',
		button2Img	: 'Vil du endre den valgte bildeknappen til et vanlig bilde?',
		img2Button	: 'Vil du endre det valgte bildet til en bildeknapp?',
		urlMissing	: 'Bildets adresse mangler.',
		validateBorder	: 'Ramme ma vaere et heltall.',
		validateHSpace	: 'HMarg ma vaere et heltall.',
		validateVSpace	: 'VMarg ma vaere et heltall.'
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Egenskaper for Flash-objekt',
		propertiesTab	: 'Egenskaper',
		title			: 'Flash-egenskaper',
		chkPlay			: 'Autospill',
		chkLoop			: 'Loop',
		chkMenu			: 'Sla pa Flash-meny',
		chkFull			: 'Tillat fullskjerm',
 		scale			: 'Skaler',
		scaleAll		: 'Vis alt',
		scaleNoBorder	: 'Ingen ramme',
		scaleFit		: 'Skaler til a passe',
		access			: 'Scripttilgang',
		accessAlways	: 'Alltid',
		accessSameDomain: 'Samme domene',
		accessNever		: 'Aldri',
		alignAbsBottom	: 'Abs bunn',
		alignAbsMiddle	: 'Abs midten',
		alignBaseline	: 'Bunnlinje',
		alignTextTop	: 'Tekst topp',
		quality			: 'Kvalitet',
		qualityBest		: 'Best',
		qualityHigh		: 'Hoy',
		qualityAutoHigh	: 'Auto hoy',
		qualityMedium	: 'Medium',
		qualityAutoLow	: 'Auto lav',
		qualityLow		: 'Lav',
		windowModeWindow: 'Vindu',
		windowModeOpaque: 'Opaque',
		windowModeTransparent : 'Gjennomsiktig',
		windowMode		: 'Vindumodus',
		flashvars		: 'Variabler for flash',
		bgcolor			: 'Bakgrunnsfarge',
		hSpace			: 'HMarg',
		vSpace			: 'VMarg',
		validateSrc		: 'Vennligst skriv inn lenkens url.',
		validateHSpace	: 'HMarg ma vaere et tall.',
		validateVSpace	: 'VMarg ma vaere et tall.'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Stavekontroll',
		title			: 'Stavekontroll',
		notAvailable	: 'Beklager, tjenesten er utilgjenglig na.',
		errorLoading	: 'Feil under lasting av applikasjonstjenestetjener: %s.',
		notInDic		: 'Ikke i ordboken',
		changeTo		: 'Endre til',
		btnIgnore		: 'Ignorer',
		btnIgnoreAll	: 'Ignorer alle',
		btnReplace		: 'Erstatt',
		btnReplaceAll	: 'Erstatt alle',
		btnUndo			: 'Angre',
		noSuggestions	: '- Ingen forslag -',
		progress		: 'Stavekontroll pagar...',
		noMispell		: 'Stavekontroll fullfort: ingen feilstavinger funnet',
		noChanges		: 'Stavekontroll fullfort: ingen ord endret',
		oneChange		: 'Stavekontroll fullfort: Ett ord endret',
		manyChanges		: 'Stavekontroll fullfort: %1 ord endret',
		ieSpellDownload	: 'Stavekontroll er ikke installert. Vil du laste den ned na?'
	},

	smiley :
	{
		toolbar	: 'Smil',
		title	: 'Sett inn smil',
		options : 'Alternativer for smil'
	},

	elementsPath :
	{
		eleLabel : 'Element-sti',
		eleTitle : '%1 element'
	},

	numberedlist	: 'Legg til/Fjern nummerert liste',
	bulletedlist	: 'Legg til/Fjern punktmerket liste',
	indent			: 'Ok innrykk',
	outdent			: 'Reduser innrykk',

	justify :
	{
		left	: 'Venstrejuster',
		center	: 'Midtstill',
		right	: 'Hoyrejuster',
		block	: 'Blokkjuster'
	},

	blockquote : 'Sitatblokk',

	clipboard :
	{
		title		: 'Lim inn',
		cutError	: 'Din nettlesers sikkerhetsinstillinger tillater ikke automatisk utklipping av tekst. Vennligst bruk snarveien (Ctrl/Cmd+X).',
		copyError	: 'Din nettlesers sikkerhetsinstillinger tillater ikke automatisk kopiering av tekst. Vennligst bruk snarveien (Ctrl/Cmd+C).',
		pasteMsg	: 'Vennligst lim inn i folgende boks med tastaturet (<STRONG>Ctrl/Cmd+V</STRONG>) og trykk <STRONG>OK</STRONG>.',
		securityMsg	: 'Din nettlesers sikkerhetsinstillinger gir ikke redigeringsverktoyet direkte tilgang til utklippstavlen. Du ma derfor lime det inn pa nytt i dette vinduet.',
		pasteArea	: 'Innlimingsomrade'
	},

	pastefromword :
	{
		confirmCleanup	: 'Teksten du limer inn ser ut til a vaere kopiert fra Word. Vil du renske den for du limer den inn?',
		toolbar			: 'Lim inn fra Word',
		title			: 'Lim inn fra Word',
		error			: 'Det var ikke mulig a renske den innlimte teksten pa grunn av en intern feil'
	},

	pasteText :
	{
		button	: 'Lim inn som ren tekst',
		title	: 'Lim inn som ren tekst'
	},

	templates :
	{
		button			: 'Maler',
		title			: 'Innholdsmaler',
		options : 'Alternativer for mal',
		insertOption	: 'Erstatt gjeldende innhold',
		selectPromptMsg	: 'Velg malen du vil apne i redigeringsverktoyet:',
		emptyListMsg	: '(Ingen maler definert)'
	},

	showBlocks : 'Vis blokker',

	stylesCombo :
	{
		label		: 'Stil',
		panelTitle	: 'Stilformater',
		panelTitle1	: 'Blokkstiler',
		panelTitle2	: 'Inlinestiler',
		panelTitle3	: 'Objektstiler'
	},

	format :
	{
		label		: 'Format',
		panelTitle	: 'Avsnittsformat',

		tag_p		: 'Normal',
		tag_pre		: 'Formatert',
		tag_address	: 'Adresse',
		tag_h1		: 'Overskrift 1',
		tag_h2		: 'Overskrift 2',
		tag_h3		: 'Overskrift 3',
		tag_h4		: 'Overskrift 4',
		tag_h5		: 'Overskrift 5',
		tag_h6		: 'Overskrift 6',
		tag_div		: 'Normal (DIV)'
	},

	div :
	{
		title				: 'Sett inn Div Container',
		toolbar				: 'Sett inn Div Container',
		cssClassInputLabel	: 'Stilark-klasser',
		styleSelectLabel	: 'Stil',
		IdInputLabel		: 'Id',
		languageCodeInputLabel	: ' Sprakkode',
		inlineStyleInputLabel	: 'Inlinestiler',
		advisoryTitleInputLabel	: 'Tittel',
		langDirLabel		: 'Sprakretning',
		langDirLTRLabel		: 'Venstre til hoyre (VTH)',
		langDirRTLLabel		: 'Hoyre til venstre (HTV)',
		edit				: 'Rediger Div',
		remove				: 'Fjern Div'
  	},

	iframe :
	{
		title		: 'Egenskaper for IFrame',
		toolbar		: 'IFrame',
		noUrl		: 'Vennligst skriv inn URL for iframe',
		scrolling	: 'Aktiver scrollefelt',
		border		: 'Viss ramme rundt iframe'
	},

	font :
	{
		label		: 'Skrift',
		voiceLabel	: 'Font',
		panelTitle	: 'Skrift'
	},

	fontSize :
	{
		label		: 'Storrelse',
		voiceLabel	: 'Font Storrelse',
		panelTitle	: 'Storrelse'
	},

	colorButton :
	{
		textColorTitle	: 'Tekstfarge',
		bgColorTitle	: 'Bakgrunnsfarge',
		panelTitle		: 'Farger',
		auto			: 'Automatisk',
		more			: 'Flere farger...'
	},

	colors :
	{
		'000' : 'Svart',
		'800000' : 'Rodbrun',
		'8B4513' : 'Salbrun',
		'2F4F4F' : 'Gronnsvart',
		'008080' : 'Blagronn',
		'000080' : 'Marineblatt',
		'4B0082' : 'Indigo',
		'696969' : 'Mork gra',
		'B22222' : 'Morkerod',
		'A52A2A' : 'Brun',
		'DAA520' : 'Lys brun',
		'006400' : 'Mork gronn',
		'40E0D0' : 'Turkis',
		'0000CD' : 'Medium bla',
		'800080' : 'Purpur',
		'808080' : 'Gra',
		'F00' : 'Rod',
		'FF8C00' : 'Mork oransje',
		'FFD700' : 'Gull',
		'008000' : 'Gronn',
		'0FF' : 'Cyan',
		'00F' : 'Bla',
		'EE82EE' : 'Fiolett',
		'A9A9A9' : 'Svak gra',
		'FFA07A' : 'Rosa-oransje',
		'FFA500' : 'Oransje',
		'FFFF00' : 'Gul',
		'00FF00' : 'Lime',
		'AFEEEE' : 'Svak turkis',
		'ADD8E6' : 'Lys Bla',
		'DDA0DD' : 'Plomme',
		'D3D3D3' : 'Lys gra',
		'FFF0F5' : 'Svak lavendelrosa',
		'FAEBD7' : 'Antikk-hvit',
		'FFFFE0' : 'Lys gul',
		'F0FFF0' : 'Honningmelon',
		'F0FFFF' : 'Svakt asurblatt',
		'F0F8FF' : 'Svak cyan',
		'E6E6FA' : 'Lavendel',
		'FFF' : 'Hvit'
	},

	scayt :
	{
		title			: 'Stavekontroll mens du skriver',
		opera_title		: 'Ikke stottet av Opera',
		enable			: 'Sla pa SCAYT',
		disable			: 'Sla av SCAYT',
		about			: 'Om SCAYT',
		toggle			: 'Veksle SCAYT',
		options			: 'Valg',
		langs			: 'Sprak',
		moreSuggestions	: 'Flere forslag',
		ignore			: 'Ignorer',
		ignoreAll		: 'Ignorer Alle',
		addWord			: 'Legg til ord',
		emptyDic		: 'Ordboknavn bor ikke vaere tom.',

		optionsTab		: 'Valg',
		allCaps			: 'Ikke kontroller ord med kun store bokstaver',
		ignoreDomainNames : 'Ikke kontroller domenenavn',
		mixedCase		: 'Ikke kontroller ord med blandet sma og store bokstaver',
		mixedWithDigits	: 'Ikke kontroller ord som inneholder tall',

		languagesTab	: 'Sprak',

		dictionariesTab	: 'Ordboker',
		dic_field_name	: 'Ordboknavn',
		dic_create		: 'Opprett',
		dic_restore		: 'Gjenopprett',
		dic_delete		: 'Slett',
		dic_rename		: 'Gi nytt navn',
		dic_info		: 'Brukerordboken lagres forst i en informasjonskapsel pa din maskin, men det er en begrensning pa hvor mye som kan lagres her. Nar ordboken blir for stor til a lagres i en informasjonskapsel, vil vi i stedet lagre ordboken pa var server. For a lagre din personlige ordbok pa var server, burde du velge et navn for ordboken din. Hvis du allerede har lagret en ordbok, vennligst skriv inn ordbokens navn og klikk pa Gjenopprett-knappen.',

		aboutTab		: 'Om'
	},

	about :
	{
		title		: 'Om CKEditor',
		dlgTitle	: 'Om CKEditor',
		help	: 'Se $1 for hjelp.',
		userGuide : 'CKEditors brukerveiledning',
		moreInfo	: 'For lisensieringsinformasjon, vennligst besok vart nettsted:',
		copy		: 'Copyright &copy; $1. Alle rettigheter reservert.'
	},

	maximize : 'Maksimer',
	minimize : 'Minimer',

	fakeobjects :
	{
		anchor		: 'Anker',
		flash		: 'Flash-animasjon',
		iframe		: 'IFrame',
		hiddenfield	: 'Skjult felt',
		unknown		: 'Ukjent objekt'
	},

	resize : 'Dra for a skalere',

	colordialog :
	{
		title		: 'Velg farge',
		options	:	'Alternativer for farge',
		highlight	: 'Merk',
		selected	: 'Valgt',
		clear		: 'Tom'
	},

	toolbarCollapse	: 'Skjul verktoylinje',
	toolbarExpand	: 'Vis verktoylinje',

	toolbarGroups :
	{
		document : 'Dokument',
		clipboard : 'Utklippstavle/Angre',
		editing : 'Redigering',
		forms : 'Skjema',
		basicstyles : 'Basisstiler',
		paragraph : 'Avsnitt',
		links : 'Lenker',
		insert : 'Innsetting',
		styles : 'Stiler',
		colors : 'Farger',
		tools : 'Verktoy'
	},

	bidi :
	{
		ltr : 'Tekstretning fra venstre til hoyre',
		rtl : 'Tekstretning fra hoyre til venstre'
	},

	docprops :
	{
		label : 'Dokumentegenskaper',
		title : 'Dokumentegenskaper',
		design : 'Design',
		meta : 'Meta-data',
		chooseColor : 'Velg',
		other : '<annen>',
		docTitle :	'Sidetittel',
		charset : 	'Tegnsett',
		charsetOther : 'Annet tegnsett',
		charsetASCII : 'ASCII',
		charsetCE : 'Sentraleuropeisk',
		charsetCT : 'Tradisonell kinesisk(Big5)',
		charsetCR : 'Kyrillisk',
		charsetGR : 'Gresk',
		charsetJP : 'Japansk',
		charsetKR : 'Koreansk',
		charsetTR : 'Tyrkisk',
		charsetUN : 'Unicode (UTF-8)',
		charsetWE : 'Vesteuropeisk',
		docType : 'Dokumenttype header',
		docTypeOther : 'Annet dokumenttype header',
		xhtmlDec : 'Inkluder XHTML-deklarasjon',
		bgColor : 'Bakgrunnsfarge',
		bgImage : 'URL for bakgrunnsbilde',
		bgFixed : 'Las bakgrunnsbilde',
		txtColor : 'Tekstfarge',
		margin : 'Sidemargin',
		marginTop : 'Topp',
		marginLeft : 'Venstre',
		marginRight : 'Hoyre',
		marginBottom : 'Bunn',
		metaKeywords : 'Dokument nokkelord (kommaseparert)',
		metaDescription : 'Dokumentbeskrivelse',
		metaAuthor : 'Forfatter',
		metaCopyright : 'Kopirett',
		previewHtml : '<p>Dette er en <strong>eksempeltekst</strong>. Du bruker <a href="javascript:void(0)">CKEditor</a>.</p>'
	}
};
