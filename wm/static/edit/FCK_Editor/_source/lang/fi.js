/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object for the
 * Finnish language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Contains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['fi'] =
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
	editorTitle : 'Rikastekstieditori, %1',
	editorHelp : 'Paina ALT 0 n"ahd"aksesi ohjeen',

	// ARIA descriptions.
	toolbars	: 'Editorin ty"okalupalkit',
	editor		: 'Rikastekstieditori',

	// Toolbar buttons without dialogs.
	source			: 'Koodi',
	newPage			: 'Tyhjenn"a',
	save			: 'Tallenna',
	preview			: 'Esikatsele',
	cut				: 'Leikkaa',
	copy			: 'Kopioi',
	paste			: 'Liit"a',
	print			: 'Tulosta',
	underline		: 'Alleviivattu',
	bold			: 'Lihavoitu',
	italic			: 'Kursivoitu',
	selectAll		: 'Valitse kaikki',
	removeFormat	: 'Poista muotoilu',
	strike			: 'Yliviivattu',
	subscript		: 'Alaindeksi',
	superscript		: 'Yl"aindeksi',
	horizontalrule	: 'Lis"a"a murtoviiva',
	pagebreak		: 'Lis"a"a sivunvaihto',
	pagebreakAlt		: 'Sivunvaihto',
	unlink			: 'Poista linkki',
	undo			: 'Kumoa',
	redo			: 'Toista',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Selaa palvelinta',
		url				: 'Osoite',
		protocol		: 'Protokolla',
		upload			: 'Lis"a"a tiedosto',
		uploadSubmit	: 'L"ahet"a palvelimelle',
		image			: 'Kuva',
		flash			: 'Flash-animaatio',
		form			: 'Lomake',
		checkbox		: 'Valintaruutu',
		radio			: 'Radiopainike',
		textField		: 'Tekstikentt"a',
		textarea		: 'Tekstilaatikko',
		hiddenField		: 'Piilokentt"a',
		button			: 'Painike',
		select			: 'Valintakentt"a',
		imageButton		: 'Kuvapainike',
		notSet			: '<ei asetettu>',
		id				: 'Tunniste',
		name			: 'Nimi',
		langDir			: 'Kielen suunta',
		langDirLtr		: 'Vasemmalta oikealle (LTR)',
		langDirRtl		: 'Oikealta vasemmalle (RTL)',
		langCode		: 'Kielikoodi',
		longDescr		: 'Pitk"an kuvauksen URL',
		cssClass		: 'Tyyliluokat',
		advisoryTitle	: 'Avustava otsikko',
		cssStyle		: 'Tyyli',
		ok				: 'OK',
		cancel			: 'Peruuta',
		close			: 'Sulje',
		preview			: 'Esikatselu',
		generalTab		: 'Yleinen',
		advancedTab		: 'Lis"aominaisuudet',
		validateNumberFailed : 'Arvon pit"a"a olla numero.',
		confirmNewPage	: 'Kaikki tallentamattomat muutokset t"ah"an sis"alt"o"on menetet"a"an. Oletko varma, ett"a haluat ladata uuden sivun?',
		confirmCancel	: 'Jotkut asetuksista on muuttuneet. Oletko varma, ett"a haluat sulkea valintaikkunan?',
		options			: 'Asetukset',
		target			: 'Kohde',
		targetNew		: 'Uusi ikkuna (_blank)',
		targetTop		: 'P"a"allimm"ainen ikkuna (_top)',
		targetSelf		: 'Sama ikkuna (_self)',
		targetParent	: 'Ylemm"an tason ikkuna (_parent)',
		langDirLTR		: 'Vasemmalta oikealle (LTR)',
		langDirRTL		: 'Oikealta vasemmalle (RTL)',
		styles			: 'Tyyli',
		cssClasses		: 'Tyylitiedoston luokat',
		width			: 'Leveys',
		height			: 'Korkeus',
		align			: 'Kohdistus',
		alignLeft		: 'Vasemmalle',
		alignRight		: 'Oikealle',
		alignCenter		: 'Keskelle',
		alignTop		: 'Yl"os',
		alignMiddle		: 'Keskelle',
		alignBottom		: 'Alas',
		invalidValue	: 'Virheellinen arvo.',
		invalidHeight	: 'Korkeuden t"aytyy olla numero.',
		invalidWidth	: 'Leveyden t"aytyy olla numero.',
		invalidCssLength	: 'Kent"an "%1" arvon t"aytyy olla positiivinen luku CSS mittayksik"on (px, %, in, cm, mm, em, ex, pt tai pc) kanssa tai ilman.',
		invalidHtmlLength	: 'Kent"an "%1" arvon t"aytyy olla positiivinen luku HTML mittayksik"on (px tai %) kanssa tai ilman.',
		invalidInlineStyle	: 'Tyylille annetun arvon t"aytyy koostua yhdest"a tai useammasta "nimi : arvo" parista, jotka ovat eroteltuna toisistaan puolipisteill"a.',
		cssLengthTooltip	: 'Anna numeroarvo pikselein"a tai numeroarvo CSS mittayksik"on kanssa (px, %, in, cm, mm, em, ex, pt, tai pc).',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, ei saatavissa</span>'
	},

	contextmenu :
	{
		options : 'Pikavalikon ominaisuudet'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Lis"a"a erikoismerkki',
		title		: 'Valitse erikoismerkki',
		options : 'Erikoismerkin ominaisuudet'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Lis"a"a linkki/muokkaa linkki"a',
		other 		: '<muu>',
		menu		: 'Muokkaa linkki"a',
		title		: 'Linkki',
		info		: 'Linkin tiedot',
		target		: 'Kohde',
		upload		: 'Lis"a"a tiedosto',
		advanced	: 'Lis"aominaisuudet',
		type		: 'Linkkityyppi',
		toUrl		: 'Osoite',
		toAnchor	: 'Ankkuri t"ass"a sivussa',
		toEmail		: 'S"ahk"oposti',
		targetFrame		: '<kehys>',
		targetPopup		: '<popup ikkuna>',
		targetFrameName	: 'Kohdekehyksen nimi',
		targetPopupName	: 'Popup ikkunan nimi',
		popupFeatures	: 'Popup ikkunan ominaisuudet',
		popupResizable	: 'Venytett"av"a',
		popupStatusBar	: 'Tilarivi',
		popupLocationBar: 'Osoiterivi',
		popupToolbar	: 'Vakiopainikkeet',
		popupMenuBar	: 'Valikkorivi',
		popupFullScreen	: 'T"aysi ikkuna (IE)',
		popupScrollBars	: 'Vierityspalkit',
		popupDependent	: 'Riippuva (Netscape)',
		popupLeft		: 'Vasemmalta (px)',
		popupTop		: 'Ylh"a"alt"a (px)',
		id				: 'Tunniste',
		langDir			: 'Kielen suunta',
		langDirLTR		: 'Vasemmalta oikealle (LTR)',
		langDirRTL		: 'Oikealta vasemmalle (RTL)',
		acccessKey		: 'Pikan"app"ain',
		name			: 'Nimi',
		langCode			: 'Kielen suunta',
		tabIndex			: 'Tabulaattori indeksi',
		advisoryTitle		: 'Avustava otsikko',
		advisoryContentType	: 'Avustava sis"all"on tyyppi',
		cssClasses		: 'Tyyliluokat',
		charset			: 'Linkitetty kirjaimisto',
		styles			: 'Tyyli',
		rel			: 'Suhde',
		selectAnchor		: 'Valitse ankkuri',
		anchorName		: 'Ankkurin nimen mukaan',
		anchorId			: 'Ankkurin ID:n mukaan',
		emailAddress		: 'S"ahk"opostiosoite',
		emailSubject		: 'Aihe',
		emailBody		: 'Viesti',
		noAnchors		: '(Ei ankkureita t"ass"a dokumentissa)',
		noUrl			: 'Linkille on kirjoitettava URL',
		noEmail			: 'Kirjoita s"ahk"opostiosoite'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Lis"a"a ankkuri/muokkaa ankkuria',
		menu		: 'Ankkurin ominaisuudet',
		title		: 'Ankkurin ominaisuudet',
		name		: 'Nimi',
		errorName	: 'Ankkurille on kirjoitettava nimi',
		remove		: 'Poista ankkuri'
	},

	// List style dialog
	list:
	{
		numberedTitle		: 'Numeroidun listan ominaisuudet',
		bulletedTitle		: 'Numeroimattoman listan ominaisuudet',
		type				: 'Tyyppi',
		start				: 'Alku',
		validateStartNumber				:'Listan ensimm"aisen numeron tulee olla kokonaisluku.',
		circle				: 'Ympyr"a',
		disc				: 'Levy',
		square				: 'Neli"o',
		none				: 'Ei mik"a"an',
		notset				: '<ei asetettu>',
		armenian			: 'Armeenialainen numerointi',
		georgian			: 'Georgialainen numerointi (an, ban, gan, etc.)',
		lowerRoman			: 'Pienet roomalaiset (i, ii, iii, iv, v, jne.)',
		upperRoman			: 'Isot roomalaiset (I, II, III, IV, V, jne.)',
		lowerAlpha			: 'Pienet aakkoset (a, b, c, d, e, jne.)',
		upperAlpha			: 'Isot aakkoset (A, B, C, D, E, jne.)',
		lowerGreek			: 'Pienet kreikkalaiset (alpha, beta, gamma, jne.)',
		decimal				: 'Desimaalit (1, 2, 3, jne.)',
		decimalLeadingZero	: 'Desimaalit, alussa nolla (01, 02, 03, jne.)'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Etsi ja korvaa',
		find				: 'Etsi',
		replace				: 'Korvaa',
		findWhat			: 'Etsi mit"a:',
		replaceWith			: 'Korvaa t"all"a:',
		notFoundMsg			: 'Etsitty"a teksti"a ei l"oytynyt.',
		findOptions			: 'Hakuasetukset',
		matchCase			: 'Sama kirjainkoko',
		matchWord			: 'Koko sana',
		matchCyclic			: 'Kierr"a ymp"ari',
		replaceAll			: 'Korvaa kaikki',
		replaceSuccessMsg	: '%1 esiintym"a("a) korvattu.'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Taulu',
		title		: 'Taulun ominaisuudet',
		menu		: 'Taulun ominaisuudet',
		deleteTable	: 'Poista taulu',
		rows		: 'Rivit',
		columns		: 'Sarakkeet',
		border		: 'Rajan paksuus',
		widthPx		: 'pikseli"a',
		widthPc		: 'prosenttia',
		widthUnit	: 'leveysyksikk"o',
		cellSpace	: 'Solujen v"ali',
		cellPad		: 'Solujen sisennys',
		caption		: 'Otsikko',
		summary		: 'Yhteenveto',
		headers		: 'Yl"atunnisteet',
		headersNone		: 'Ei',
		headersColumn	: 'Ensimm"ainen sarake',
		headersRow		: 'Ensimm"ainen rivi',
		headersBoth		: 'Molemmat',
		invalidRows		: 'Rivien m"a"ar"an t"aytyy olla suurempi kuin 0.',
		invalidCols		: 'Sarakkeiden m"a"ar"an t"aytyy olla suurempi kuin 0.',
		invalidBorder	: 'Reunan koon t"aytyy olla numero.',
		invalidWidth	: 'Taulun leveyden t"aytyy olla numero.',
		invalidHeight	: 'Taulun korkeuden t"aytyy olla numero.',
		invalidCellSpacing	: 'Solujen v"alin t"aytyy olla numero.',
		invalidCellPadding	: 'Solujen sisennyksen t"aytyy olla numero.',

		cell :
		{
			menu			: 'Solu',
			insertBefore	: 'Lis"a"a solu eteen',
			insertAfter		: 'Lis"a"a solu per"a"an',
			deleteCell		: 'Poista solut',
			merge			: 'Yhdist"a solut',
			mergeRight		: 'Yhdist"a oikealla olevan kanssa',
			mergeDown		: 'Yhdist"a alla olevan kanssa',
			splitHorizontal	: 'Jaa solu vaakasuunnassa',
			splitVertical	: 'Jaa solu pystysuunnassa',
			title			: 'Solun ominaisuudet',
			cellType		: 'Solun tyyppi',
			rowSpan			: 'Rivin jatkuvuus',
			colSpan			: 'Solun jatkuvuus',
			wordWrap		: 'Rivitys',
			hAlign			: 'Horisontaali kohdistus',
			vAlign			: 'Vertikaali kohdistus',
			alignBaseline	: 'Alas (teksti)',
			bgColor			: 'Taustan v"ari',
			borderColor		: 'Reunan v"ari',
			data			: 'Data',
			header			: 'Yl"atunniste',
			yes				: 'Kyll"a',
			no				: 'Ei',
			invalidWidth	: 'Solun leveyden t"aytyy olla numero.',
			invalidHeight	: 'Solun korkeuden t"aytyy olla numero.',
			invalidRowSpan	: 'Rivin jatkuvuuden t"aytyy olla kokonaisluku.',
			invalidColSpan	: 'Solun jatkuvuuden t"aytyy olla kokonaisluku.',
			chooseColor		: 'Valitse'
		},

		row :
		{
			menu			: 'Rivi',
			insertBefore	: 'Lis"a"a rivi yl"apuolelle',
			insertAfter		: 'Lis"a"a rivi alapuolelle',
			deleteRow		: 'Poista rivit'
		},

		column :
		{
			menu			: 'Sarake',
			insertBefore	: 'Lis"a"a sarake vasemmalle',
			insertAfter		: 'Lis"a"a sarake oikealle',
			deleteColumn	: 'Poista sarakkeet'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Painikkeen ominaisuudet',
		text		: 'Teksti (arvo)',
		type		: 'Tyyppi',
		typeBtn		: 'Painike',
		typeSbm		: 'L"ahet"a',
		typeRst		: 'Tyhjenn"a'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Valintaruudun ominaisuudet',
		radioTitle	: 'Radiopainikkeen ominaisuudet',
		value		: 'Arvo',
		selected	: 'Valittu'
	},

	// Form Dialog.
	form :
	{
		title		: 'Lomakkeen ominaisuudet',
		menu		: 'Lomakkeen ominaisuudet',
		action		: 'Toiminto',
		method		: 'Tapa',
		encoding	: 'Enkoodaus'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Valintakent"an ominaisuudet',
		selectInfo	: 'Info',
		opAvail		: 'Ominaisuudet',
		value		: 'Arvo',
		size		: 'Koko',
		lines		: 'Rivit',
		chkMulti	: 'Salli usea valinta',
		opText		: 'Teksti',
		opValue		: 'Arvo',
		btnAdd		: 'Lis"a"a',
		btnModify	: 'Muuta',
		btnUp		: 'Yl"os',
		btnDown		: 'Alas',
		btnSetValue : 'Aseta valituksi',
		btnDelete	: 'Poista'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Tekstilaatikon ominaisuudet',
		cols		: 'Sarakkeita',
		rows		: 'Rivej"a'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Tekstikent"an ominaisuudet',
		name		: 'Nimi',
		value		: 'Arvo',
		charWidth	: 'Leveys',
		maxChars	: 'Maksimi merkkim"a"ar"a',
		type		: 'Tyyppi',
		typeText	: 'Teksti',
		typePass	: 'Salasana'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Piilokent"an ominaisuudet',
		name	: 'Nimi',
		value	: 'Arvo'
	},

	// Image Dialog.
	image :
	{
		title		: 'Kuvan ominaisuudet',
		titleButton	: 'Kuvapainikkeen ominaisuudet',
		menu		: 'Kuvan ominaisuudet',
		infoTab		: 'Kuvan tiedot',
		btnUpload	: 'L"ahet"a palvelimelle',
		upload		: 'Lis"a"a kuva',
		alt			: 'Vaihtoehtoinen teksti',
		lockRatio	: 'Lukitse suhteet',
		resetSize	: 'Alkuper"ainen koko',
		border		: 'Kehys',
		hSpace		: 'Vaakatila',
		vSpace		: 'Pystytila',
		alertUrl	: 'Kirjoita kuvan osoite (URL)',
		linkTab		: 'Linkki',
		button2Img	: 'Haluatko muuntaa valitun kuvan"app"aimen kuvaksi?',
		img2Button	: 'Haluatko muuntaa valitun kuvan kuvan"app"aimeksi?',
		urlMissing	: 'Kuvan l"ahdeosoite puuttuu.',
		validateBorder	: 'Kehyksen t"aytyy olla kokonaisluku.',
		validateHSpace	: 'HSpace-m"a"arityksen t"aytyy olla kokonaisluku.',
		validateVSpace	: 'VSpace-m"a"arityksen t"aytyy olla kokonaisluku.'
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Flash-ominaisuudet',
		propertiesTab	: 'Ominaisuudet',
		title			: 'Flash ominaisuudet',
		chkPlay			: 'Automaattinen k"aynnistys',
		chkLoop			: 'Toisto',
		chkMenu			: 'N"ayt"a Flash-valikko',
		chkFull			: 'Salli kokoruututila',
 		scale			: 'Levit"a',
		scaleAll		: 'N"ayt"a kaikki',
		scaleNoBorder	: 'Ei rajaa',
		scaleFit		: 'Tarkka koko',
		access			: 'Skriptien p"a"asy',
		accessAlways	: 'Aina',
		accessSameDomain: 'Sama verkkotunnus',
		accessNever		: 'Ei koskaan',
		alignAbsBottom	: 'Aivan alas',
		alignAbsMiddle	: 'Aivan keskelle',
		alignBaseline	: 'Alas (teksti)',
		alignTextTop	: 'Yl"os (teksti)',
		quality			: 'Laatu',
		qualityBest		: 'Paras',
		qualityHigh		: 'Korkea',
		qualityAutoHigh	: 'Automaattinen korkea',
		qualityMedium	: 'Keskitaso',
		qualityAutoLow	: 'Automaattinen matala',
		qualityLow		: 'Matala',
		windowModeWindow: 'Ikkuna',
		windowModeOpaque: 'L"apin"akyvyys',
		windowModeTransparent : 'L"apin"akyv"a',
		windowMode		: 'Ikkuna tila',
		flashvars		: 'Muuttujat Flash:lle',
		bgcolor			: 'Taustav"ari',
		hSpace			: 'Vaakatila',
		vSpace			: 'Pystytila',
		validateSrc		: 'Linkille on kirjoitettava URL',
		validateHSpace	: 'Vaakatilan t"aytyy olla numero.',
		validateVSpace	: 'Pystytilan t"aytyy olla numero.'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Tarkista oikeinkirjoitus',
		title			: 'Oikoluku',
		notAvailable	: 'Valitettavasti oikoluku ei ole k"ayt"oss"a t"all"a hetkell"a.',
		errorLoading	: 'Virhe ladattaessa oikolukupalvelua is"ann"alt"a: %s.',
		notInDic		: 'Ei sanakirjassa',
		changeTo		: 'Vaihda',
		btnIgnore		: 'J"at"a huomioimatta',
		btnIgnoreAll	: 'J"at"a kaikki huomioimatta',
		btnReplace		: 'Korvaa',
		btnReplaceAll	: 'Korvaa kaikki',
		btnUndo			: 'Kumoa',
		noSuggestions	: 'Ei ehdotuksia',
		progress		: 'Tarkistus k"aynniss"a...',
		noMispell		: 'Tarkistus valmis: Ei virheit"a',
		noChanges		: 'Tarkistus valmis: Yht"a"an sanaa ei muutettu',
		oneChange		: 'Tarkistus valmis: Yksi sana muutettiin',
		manyChanges		: 'Tarkistus valmis: %1 sanaa muutettiin',
		ieSpellDownload	: 'Oikeinkirjoituksen tarkistusta ei ole asennettu. Haluatko ladata sen nyt?'
	},

	smiley :
	{
		toolbar	: 'Hymi"o',
		title	: 'Lis"a"a hymi"o',
		options : 'Hymi"on ominaisuudet'
	},

	elementsPath :
	{
		eleLabel : 'Elementin polku',
		eleTitle : '%1 elementti'
	},

	numberedlist	: 'Numerointi',
	bulletedlist	: 'Luottelomerkit',
	indent			: 'Suurenna sisennyst"a',
	outdent			: 'Pienenn"a sisennyst"a',

	justify :
	{
		left	: 'Tasaa vasemmat reunat',
		center	: 'Keskit"a',
		right	: 'Tasaa oikeat reunat',
		block	: 'Tasaa molemmat reunat'
	},

	blockquote : 'Lainaus',

	clipboard :
	{
		title		: 'Liit"a',
		cutError	: 'Selaimesi turva-asetukset eiv"at salli editorin toteuttaa leikkaamista. K"ayt"a n"app"aimist"o"a leikkaamiseen (Ctrl+X).',
		copyError	: 'Selaimesi turva-asetukset eiv"at salli editorin toteuttaa kopioimista. K"ayt"a n"app"aimist"o"a kopioimiseen (Ctrl+C).',
		pasteMsg	: 'Liit"a painamalla (<STRONG>Ctrl+V</STRONG>) ja painamalla <STRONG>OK</STRONG>.',
		securityMsg	: 'Selaimesi turva-asetukset eiv"at salli editorin k"aytt"a"a leikep"oyt"a"a suoraan. Sinun pit"a"a suorittaa liitt"aminen t"ass"a ikkunassa.',
		pasteArea	: 'Leikealue'
	},

	pastefromword :
	{
		confirmCleanup	: 'Liitt"am"asi teksti n"aytt"aisi olevan Word-dokumentista. Haluatko siivota sen ennen liitt"amist"a? (Suositus: Kyll"a)',
		toolbar			: 'Liit"a Word-dokumentista',
		title			: 'Liit"a Word-dokumentista',
		error			: 'Liitetyn tiedon siivoaminen ei onnistunut sis"aisen virheen takia'
	},

	pasteText :
	{
		button	: 'Liit"a tekstin"a',
		title	: 'Liit"a tekstin"a'
	},

	templates :
	{
		button			: 'Pohjat',
		title			: 'Sis"alt"opohjat',
		options : 'Sis"alt"opohjan ominaisuudet',
		insertOption	: 'Korvaa editorin koko sis"alt"o',
		selectPromptMsg	: 'Valitse pohja editoriin<br>(aiempi sis"alt"o menetet"a"an):',
		emptyListMsg	: '(Ei m"a"ariteltyj"a pohjia)'
	},

	showBlocks : 'N"ayt"a elementit',

	stylesCombo :
	{
		label		: 'Tyyli',
		panelTitle	: 'Muotoilujen tyylit',
		panelTitle1	: 'Lohkojen tyylit',
		panelTitle2	: 'Rivinsis"aiset tyylit',
		panelTitle3	: 'Objektien tyylit'
	},

	format :
	{
		label		: 'Muotoilu',
		panelTitle	: 'Muotoilu',

		tag_p		: 'Normaali',
		tag_pre		: 'Muotoiltu',
		tag_address	: 'Osoite',
		tag_h1		: 'Otsikko 1',
		tag_h2		: 'Otsikko 2',
		tag_h3		: 'Otsikko 3',
		tag_h4		: 'Otsikko 4',
		tag_h5		: 'Otsikko 5',
		tag_h6		: 'Otsikko 6',
		tag_div		: 'Normaali (DIV)'
	},

	div :
	{
		title				: 'Luo div-kehikko',
		toolbar				: 'Luo div-kehikko',
		cssClassInputLabel	: 'Tyylitiedoston luokat',
		styleSelectLabel	: 'Tyyli',
		IdInputLabel		: 'Id',
		languageCodeInputLabel	: ' Kielen koodi',
		inlineStyleInputLabel	: 'Sis"atyyli',
		advisoryTitleInputLabel	: 'Ohjeistava otsikko',
		langDirLabel		: 'Kielen suunta',
		langDirLTRLabel		: 'Vasemmalta oikealle (LTR)',
		langDirRTLLabel		: 'Oikealta vasemmalle (RTL)',
		edit				: 'Muokkaa Divi"a',
		remove				: 'Poista Div'
  	},

	iframe :
	{
		title		: 'IFrame-kehyksen ominaisuudet',
		toolbar		: 'IFrame-kehys',
		noUrl		: 'Anna IFrame-kehykselle l"ahdeosoite (src)',
		scrolling	: 'N"ayt"a vierityspalkit',
		border		: 'N"ayt"a kehyksen reunat'
	},

	font :
	{
		label		: 'Kirjaisinlaji',
		voiceLabel	: 'Kirjaisinlaji',
		panelTitle	: 'Kirjaisinlaji'
	},

	fontSize :
	{
		label		: 'Koko',
		voiceLabel	: 'Kirjaisimen koko',
		panelTitle	: 'Koko'
	},

	colorButton :
	{
		textColorTitle	: 'Tekstiv"ari',
		bgColorTitle	: 'Taustav"ari',
		panelTitle		: 'V"arit',
		auto			: 'Automaattinen',
		more			: 'Lis"a"a v"arej"a...'
	},

	colors :
	{
		'000' : 'Musta',
		'800000' : 'Kastanjanruskea',
		'8B4513' : 'Satulanruskea',
		'2F4F4F' : 'Tumma liuskekivenharmaa',
		'008080' : 'Sinivihre"a',
		'000080' : 'Laivastonsininen',
		'4B0082' : 'Indigonsininen',
		'696969' : 'Tummanharmaa',
		'B22222' : 'Tiili',
		'A52A2A' : 'Ruskea',
		'DAA520' : 'Kultapiisku',
		'006400' : 'Tummanvihre"a',
		'40E0D0' : 'Turkoosi',
		'0000CD' : 'Keskisininen',
		'800080' : 'Purppura',
		'808080' : 'Harmaa',
		'F00' : 'Punainen',
		'FF8C00' : 'Tumma oranssi',
		'FFD700' : 'Kulta',
		'008000' : 'Vihre"a',
		'0FF' : 'Syaani',
		'00F' : 'Sininen',
		'EE82EE' : 'Violetti',
		'A9A9A9' : 'Tummanharmaa',
		'FFA07A' : 'Vaaleanlohenpunainen',
		'FFA500' : 'Oranssi',
		'FFFF00' : 'Keltainen',
		'00FF00' : 'Limetin vihre"a',
		'AFEEEE' : 'Haalea turkoosi',
		'ADD8E6' : 'Vaaleansininen',
		'DDA0DD' : 'Luumu',
		'D3D3D3' : 'Vaaleanharmaa',
		'FFF0F5' : 'Laventelinpunainen',
		'FAEBD7' : 'Antiikinvalkoinen',
		'FFFFE0' : 'Vaaleankeltainen',
		'F0FFF0' : 'Hunajameloni',
		'F0FFFF' : 'Asurinsininen',
		'F0F8FF' : 'Alice Blue -sininen',
		'E6E6FA' : 'Lavanteli',
		'FFF' : 'Valkoinen'
	},

	scayt :
	{
		title			: 'Oikolue kirjoitettaessa',
		opera_title		: 'Opera ei tue t"at"a ominaisuutta',
		enable			: 'Ota k"aytt"o"on oikoluku kirjoitettaessa',
		disable			: 'Poista k"ayt"ost"a oikoluku kirjoitetaessa',
		about			: 'Tietoja oikoluvusta kirjoitetaessa',
		toggle			: 'Vaihda oikoluku kirjoittaessa tilaa',
		options			: 'Asetukset',
		langs			: 'Kielet',
		moreSuggestions	: 'Lis"a"a ehdotuksia',
		ignore			: 'Ohita',
		ignoreAll		: 'Ohita kaikki',
		addWord			: 'Lis"a"a sana',
		emptyDic		: 'Sanakirjan nimi on annettava.',

		optionsTab		: 'Asetukset',
		allCaps			: 'Ohita sanat, jotka on kirjoitettu kokonaan isoilla kirjaimilla',
		ignoreDomainNames : 'Ohita verkkotunnukset',
		mixedCase		: 'Ohita sanat, joissa on sekoitettu isoja ja pieni"a kirjaimia',
		mixedWithDigits	: 'Ohita sanat, joissa on numeroita',

		languagesTab	: 'Kielet',

		dictionariesTab	: 'Sanakirjat',
		dic_field_name	: 'Sanakirjan nimi',
		dic_create		: 'Luo',
		dic_restore		: 'Palauta',
		dic_delete		: 'Poista',
		dic_rename		: 'Nime"a uudelleen',
		dic_info		: 'Oletuksena sanakirjat tallennetaan ev"asteeseen, mutta ev"asteiden koko on kuitenkin rajallinen. Sanakirjan kasvaessa niin suureksi, ettei se en"a"a mahdu ev"asteeseen, sanakirja t"aytyy tallentaa palvelimellemme. Tallentaaksesi sanakirjasi palvelimellemme tulee sinun antaa sille nimi. Jos olet jo tallentanut sanakirjan, anna sen nimi ja klikkaa Palauta-painiketta',

		aboutTab		: 'Tietoa'
	},

	about :
	{
		title		: 'Tietoa CKEditorista',
		dlgTitle	: 'Tietoa CKEditorista',
		help	: 'Katso ohjeet: $1.',
		userGuide : 'CKEditorin k"aytt"aj"aopas',
		moreInfo	: 'Lisenssitiedot l"oytyv"at kotisivuiltamme:',
		copy		: 'Copyright &copy; $1. Kaikki oikeuden pid"atet"a"an.'
	},

	maximize : 'Suurenna',
	minimize : 'Pienenn"a',

	fakeobjects :
	{
		anchor		: 'Ankkuri',
		flash		: 'Flash animaatio',
		iframe		: 'IFrame-kehys',
		hiddenfield	: 'Piilokentt"a',
		unknown		: 'Tuntematon objekti'
	},

	resize : 'Raahaa muuttaaksesi kokoa',

	colordialog :
	{
		title		: 'Valitse v"ari',
		options	:	'V"arin ominaisuudet',
		highlight	: 'Korostus',
		selected	: 'Valittu',
		clear		: 'Poista'
	},

	toolbarCollapse	: 'Kutista ty"okalupalkki',
	toolbarExpand	: 'Laajenna ty"okalupalkki',

	toolbarGroups :
	{
		document : 'Dokumentti',
		clipboard : 'Leikep"oyt"a/Kumoa',
		editing : 'Muokkaus',
		forms : 'Lomakkeet',
		basicstyles : 'Perustyylit',
		paragraph : 'Kappale',
		links : 'Linkit',
		insert : 'Lis"a"a',
		styles : 'Tyylit',
		colors : 'V"arit',
		tools : 'Ty"okalut'
	},

	bidi :
	{
		ltr : 'Tekstin suunta vasemmalta oikealle',
		rtl : 'Tekstin suunta oikealta vasemmalle'
	},

	docprops :
	{
		label : 'Dokumentin ominaisuudet',
		title : 'Dokumentin ominaisuudet',
		design : 'Sommittelu',
		meta : 'Metatieto',
		chooseColor : 'Valitse',
		other : '<muu>',
		docTitle :	'Sivun nimi',
		charset : 	'Merkist"okoodaus',
		charsetOther : 'Muu merkist"okoodaus',
		charsetASCII : 'ASCII',
		charsetCE : 'Keskieurooppalainen',
		charsetCT : 'Kiina, perinteinen (Big5)',
		charsetCR : 'Kyrillinen',
		charsetGR : 'Kreikka',
		charsetJP : 'Japani',
		charsetKR : 'Korealainen',
		charsetTR : 'Turkkilainen',
		charsetUN : 'Unicode (UTF-8)',
		charsetWE : 'L"ansieurooppalainen',
		docType : 'Dokumentin tyyppi',
		docTypeOther : 'Muu dokumentin tyyppi',
		xhtmlDec : 'Lis"a"a XHTML julistukset',
		bgColor : 'Taustav"ari',
		bgImage : 'Taustakuva',
		bgFixed : 'Paikallaanpysyv"a tausta',
		txtColor : 'Tekstiv"ari',
		margin : 'Sivun marginaalit',
		marginTop : 'Yl"a',
		marginLeft : 'Vasen',
		marginRight : 'Oikea',
		marginBottom : 'Ala',
		metaKeywords : 'Hakusanat (pilkulla erotettuna)',
		metaDescription : 'Kuvaus',
		metaAuthor : 'Tekij"a',
		metaCopyright : 'Tekij"anoikeudet',
		previewHtml : '<p>T"am"a on <strong>esimerkkiteksti"a</strong>. K"ayt"at juuri <a href="javascript:void(0)">CKEditoria</a>.</p>'
	}
};
