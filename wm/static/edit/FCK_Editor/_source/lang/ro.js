/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Romanian language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Contains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['ro'] =
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
	editorHelp : 'Apasa ALT 0 pentru ajutor',

	// ARIA descriptions.
	toolbars	: 'Editeaza bara de unelte',
	editor		: 'Rich Text Editor',

	// Toolbar buttons without dialogs.
	source			: 'Sursa',
	newPage			: 'Pagina noua',
	save			: 'Salveaza',
	preview			: 'Previzualizare',
	cut				: 'Taie',
	copy			: 'Copiaza',
	paste			: 'Adauga',
	print			: 'Printeaza',
	underline		: 'Subliniat (underline)',
	bold			: '^Ingrosat (bold)',
	italic			: '^Inclinat (italic)',
	selectAll		: 'Selecteaza tot',
	removeFormat	: '^Inlatura formatarea',
	strike			: 'Taiat (strike through)',
	subscript		: 'Indice (subscript)',
	superscript		: 'Putere (superscript)',
	horizontalrule	: 'Insereaza linie orizontala',
	pagebreak		: 'Insereaza separator de pagina (Page Break)',
	pagebreakAlt		: 'Page Break',
	unlink			: '^Inlatura link (legatura web)',
	undo			: 'Starea anterioara (undo)',
	redo			: 'Starea ulterioara (redo)',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Rasfoieste server',
		url				: 'URL',
		protocol		: 'Protocol',
		upload			: '^Incarca',
		uploadSubmit	: 'Trimite la server',
		image			: 'Imagine',
		flash			: 'Flash',
		form			: 'Formular (Form)',
		checkbox		: 'Bifa (Checkbox)',
		radio			: 'Buton radio (RadioButton)',
		textField		: 'C^amp text (TextField)',
		textarea		: 'Suprafata text (Textarea)',
		hiddenField		: 'C^amp ascuns (HiddenField)',
		button			: 'Buton',
		select			: 'C^amp selectie (SelectionField)',
		imageButton		: 'Buton imagine (ImageButton)',
		notSet			: '<nesetat>',
		id				: 'Id',
		name			: 'Nume',
		langDir			: 'Directia cuvintelor',
		langDirLtr		: 'st^anga-dreapta (LTR)',
		langDirRtl		: 'dreapta-st^anga (RTL)',
		langCode		: 'Codul limbii',
		longDescr		: 'Descrierea lunga URL',
		cssClass		: 'Clasele cu stilul paginii (CSS)',
		advisoryTitle	: 'Titlul consultativ',
		cssStyle		: 'Stil',
		ok				: 'OK',
		cancel			: 'Anulare',
		close			: '^Inchide',
		preview			: 'Previzualizare',
		generalTab		: 'General',
		advancedTab		: 'Avansat',
		validateNumberFailed : 'Aceasta valoare nu este un numar.',
		confirmNewPage	: 'Orice modificari nesalvate ale acestui continut, vor fi pierdute. Sigur doriti ^incarcarea unei noi pagini?',
		confirmCancel	: 'C^ateva optiuni au fost schimbate. Sigur doriti sa ^inchideti dialogul?',
		options			: 'Optiuni',
		target			: 'Tinta',
		targetNew		: 'Fereastra noua (_blank)',
		targetTop		: 'Topmost Window (_top)',
		targetSelf		: '^In aceeasi fereastra (_self)',
		targetParent	: 'Parent Window (_parent)',
		langDirLTR		: 'St^anga spre Dreapta (LTR)',
		langDirRTL		: 'Dreapta spre St^anga (RTL)',
		styles			: 'Stil',
		cssClasses		: 'Stylesheet Classes',
		width			: 'Latime',
		height			: '^Inaltime',
		align			: 'Aliniere',
		alignLeft		: 'Mareste Bara',
		alignRight		: 'Dreapta',
		alignCenter		: 'Centru',
		alignTop		: 'Sus',
		alignMiddle		: 'Mijloc',
		alignBottom		: 'Jos',
		invalidValue	: 'Invalid value.', // MISSING
		invalidHeight	: '^Inaltimea trebuie sa fie un numar.',
		invalidWidth	: 'Latimea trebuie sa fie un numar.',
		invalidCssLength	: 'Value specified for the "%1" field must be a positive number with or without a valid CSS measurement unit (px, %, in, cm, mm, em, ex, pt, or pc).', // MISSING
		invalidHtmlLength	: 'Value specified for the "%1" field must be a positive number with or without a valid HTML measurement unit (px or %).', // MISSING
		invalidInlineStyle	: 'Value specified for the inline style must consist of one or more tuples with the format of "name : value", separated by semi-colons.', // MISSING
		cssLengthTooltip	: 'Enter a number for a value in pixels or a number with a valid CSS unit (px, %, in, cm, mm, em, ex, pt, or pc).', // MISSING

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, unavailable</span>' // MISSING
	},

	contextmenu :
	{
		options : 'Optiuni Meniu Contextual'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Insereaza caracter special',
		title		: 'Selecteaza caracter special',
		options : 'Optiuni caractere speciale'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Insereaza/Editeaza link (legatura web)',
		other 		: '<alt>',
		menu		: 'Editeaza Link',
		title		: 'Link (Legatura web)',
		info		: 'Informatii despre link (Legatura web)',
		target		: 'Tinta (Target)',
		upload		: '^Incarca',
		advanced	: 'Avansat',
		type		: 'Tipul link-ului (al legaturii web)',
		toUrl		: 'URL',
		toAnchor	: 'Ancora ^in aceasta pagina',
		toEmail		: 'E-Mail',
		targetFrame		: '<frame>',
		targetPopup		: '<fereastra popup>',
		targetFrameName	: 'Numele frameului tinta',
		targetPopupName	: 'Numele ferestrei popup',
		popupFeatures	: 'Proprietatile ferestrei popup',
		popupResizable	: 'Redimensionabil',
		popupStatusBar	: 'Bara de status',
		popupLocationBar: 'Bara de locatie',
		popupToolbar	: 'Bara de optiuni',
		popupMenuBar	: 'Bara de meniu',
		popupFullScreen	: 'Tot ecranul (Full Screen)(IE)',
		popupScrollBars	: 'Bare de derulare',
		popupDependent	: 'Dependent (Netscape)',
		popupLeft		: 'Pozitia la st^anga',
		popupTop		: 'Pozitia la dreapta',
		id				: 'Id',
		langDir			: 'Directia cuvintelor',
		langDirLTR		: 'st^anga-dreapta (LTR)',
		langDirRTL		: 'dreapta-st^anga (RTL)',
		acccessKey		: 'Tasta de acces',
		name			: 'Nume',
		langCode			: 'Directia cuvintelor',
		tabIndex			: 'Indexul tabului',
		advisoryTitle		: 'Titlul consultativ',
		advisoryContentType	: 'Tipul consultativ al titlului',
		cssClasses		: 'Clasele cu stilul paginii (CSS)',
		charset			: 'Setul de caractere al resursei legate',
		styles			: 'Stil',
		rel			: 'Relatie',
		selectAnchor		: 'Selectati o ancora',
		anchorName		: 'dupa numele ancorei',
		anchorId			: 'dupa Id-ul elementului',
		emailAddress		: 'Adresa de e-mail',
		emailSubject		: 'Subiectul mesajului',
		emailBody		: 'Optiuni Meniu Contextual',
		noAnchors		: '(Nicio ancora disponibila ^in document)',
		noUrl			: 'Va rugam sa scrieti URL-ul',
		noEmail			: 'Va rugam sa scrieti adresa de e-mail'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Insereaza/Editeaza ancora',
		menu		: 'Proprietati ancora',
		title		: 'Proprietati ancora',
		name		: 'Numele ancorei',
		errorName	: 'Va rugam scrieti numele ancorei',
		remove		: 'Elimina ancora'
	},

	// List style dialog
	list:
	{
		numberedTitle		: 'Proprietatile listei numerotate',
		bulletedTitle		: 'Proprietatile listei cu simboluri',
		type				: 'Tip',
		start				: 'Start',
		validateStartNumber				:'^Inceputul listei trebuie sa fie un numar ^intreg.',
		circle				: 'Cerc',
		disc				: 'Disc',
		square				: 'Patrat',
		none				: 'Nimic',
		notset				: '<nesetat>',
		armenian			: 'Numerotare armeniana',
		georgian			: 'Numerotare georgiana (an, ban, gan, etc.)',
		lowerRoman			: 'Cifre romane mici (i, ii, iii, iv, v, etc.)',
		upperRoman			: 'Cifre romane mari (I, II, III, IV, V, etc.)',
		lowerAlpha			: 'Litere mici (a, b, c, d, e, etc.)',
		upperAlpha			: 'Litere mari (A, B, C, D, E, etc.)',
		lowerGreek			: 'Litere grecesti mici (alpha, beta, gamma, etc.)',
		decimal				: 'Decimale (1, 2, 3, etc.)',
		decimalLeadingZero	: 'Decimale cu zero ^in fata (01, 02, 03, etc.)'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Gaseste si ^inlocuieste',
		find				: 'Gaseste',
		replace				: '^Inlocuieste',
		findWhat			: 'Gaseste:',
		replaceWith			: '^Inlocuieste cu:',
		notFoundMsg			: 'Textul specificat nu a fost gasit.',
		findOptions			: 'Find Options', // MISSING
		matchCase			: 'Deosebeste majuscule de minuscule (Match case)',
		matchWord			: 'Doar cuvintele ^intregi',
		matchCyclic			: 'Potriveste ciclic',
		replaceAll			: '^Inlocuieste tot',
		replaceSuccessMsg	: '%1 cautari ^inlocuite.'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Tabel',
		title		: 'Proprietatile tabelului',
		menu		: 'Proprietatile tabelului',
		deleteTable	: 'Sterge tabel',
		rows		: 'R^anduri',
		columns		: 'Coloane',
		border		: 'Marimea marginii',
		widthPx		: 'pixeli',
		widthPc		: 'procente',
		widthUnit	: 'unitate latime',
		cellSpace	: 'Spatiu ^intre celule',
		cellPad		: 'Spatiu ^in cadrul celulei',
		caption		: 'Titlu (Caption)',
		summary		: 'Rezumat',
		headers		: 'Antente',
		headersNone		: 'Nimic',
		headersColumn	: 'Prima coloana',
		headersRow		: 'Primul r^and',
		headersBoth		: 'Ambele',
		invalidRows		: 'Numarul r^andurilor trebuie sa fie mai mare dec^at 0.',
		invalidCols		: 'Numarul coloanelor trebuie sa fie mai mare dec^at 0.',
		invalidBorder	: 'Dimensiunea bordurii trebuie sa aibe un numar.',
		invalidWidth	: 'Latimea tabelului trebuie sa fie un numar.',
		invalidHeight	: 'Table height must be a number.', // MISSING
		invalidCellSpacing	: 'Spatierea celului trebuie sa fie un numar pozitiv.',
		invalidCellPadding	: 'Cell padding must be a positive number.', // MISSING

		cell :
		{
			menu			: 'Celula',
			insertBefore	: 'Insereaza celula ^inainte',
			insertAfter		: 'Insereaza celula dupa',
			deleteCell		: 'Sterge celule',
			merge			: 'Uneste celule',
			mergeRight		: 'Uneste la dreapta',
			mergeDown		: 'Uneste jos',
			splitHorizontal	: '^Imparte celula pe orizontala',
			splitVertical	: '^Imparte celula pe verticala',
			title			: 'Proprietati celula',
			cellType		: 'Tipul celulei',
			rowSpan			: 'Rows Span', // MISSING
			colSpan			: 'Columns Span', // MISSING
			wordWrap		: 'Word Wrap', // MISSING
			hAlign			: 'Aliniament orizontal',
			vAlign			: 'Aliniament vertical',
			alignBaseline	: 'Baseline', // MISSING
			bgColor			: 'Culoare fundal',
			borderColor		: 'Culoare bordura',
			data			: 'Data',
			header			: 'Antet',
			yes				: 'Da',
			no				: 'Nu',
			invalidWidth	: 'Latimea celulei trebuie sa fie un numar.',
			invalidHeight	: '^Inaltimea celulei trebuie sa fie un numar.',
			invalidRowSpan	: 'Rows span must be a whole number.', // MISSING
			invalidColSpan	: 'Columns span must be a whole number.', // MISSING
			chooseColor		: 'Alege'
		},

		row :
		{
			menu			: 'R^and',
			insertBefore	: 'Insereaza r^and ^inainte',
			insertAfter		: 'Insereaza r^and dupa',
			deleteRow		: 'Sterge r^anduri'
		},

		column :
		{
			menu			: 'Coloana',
			insertBefore	: 'Insereaza coloana ^inainte',
			insertAfter		: 'Insereaza coloana dupa',
			deleteColumn	: 'Sterge celule'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Proprietati buton',
		text		: 'Text (Valoare)',
		type		: 'Tip',
		typeBtn		: 'Buton',
		typeSbm		: 'Trimite',
		typeRst		: 'Reset'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Proprietati bifa (Checkbox)',
		radioTitle	: 'Proprietati buton radio (Radio Button)',
		value		: 'Valoare',
		selected	: 'Selectat'
	},

	// Form Dialog.
	form :
	{
		title		: 'Proprietati formular (Form)',
		menu		: 'Proprietati formular (Form)',
		action		: 'Actiune',
		method		: 'Metoda',
		encoding	: 'Encodare'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Proprietati c^amp selectie (Selection Field)',
		selectInfo	: 'Informatii',
		opAvail		: 'Optiuni disponibile',
		value		: 'Valoare',
		size		: 'Marime',
		lines		: 'linii',
		chkMulti	: 'Permite selectii multiple',
		opText		: 'Text',
		opValue		: 'Valoare',
		btnAdd		: 'Adauga',
		btnModify	: 'Modifica',
		btnUp		: 'Sus',
		btnDown		: 'Jos',
		btnSetValue : 'Seteaza ca valoare selectata',
		btnDelete	: 'Sterge'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Proprietati suprafata text (Textarea)',
		cols		: 'Coloane',
		rows		: 'Linii'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Proprietati c^amp text (Text Field)',
		name		: 'Nume',
		value		: 'Valoare',
		charWidth	: 'Largimea caracterului',
		maxChars	: 'Caractere maxime',
		type		: 'Tip',
		typeText	: 'Text',
		typePass	: 'Parola'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Proprietati c^amp ascuns (Hidden Field)',
		name	: 'Nume',
		value	: 'Valoare'
	},

	// Image Dialog.
	image :
	{
		title		: 'Proprietatile imaginii',
		titleButton	: 'Proprietati buton imagine (Image Button)',
		menu		: 'Proprietatile imaginii',
		infoTab		: 'Informatii despre imagine',
		btnUpload	: 'Trimite la server',
		upload		: '^Incarca',
		alt			: 'Text alternativ',
		lockRatio	: 'Pastreaza proportiile',
		resetSize	: 'Reseteaza marimea',
		border		: 'Margine',
		hSpace		: 'HSpace',
		vSpace		: 'VSpace',
		alertUrl	: 'Va rugam sa scrieti URL-ul imaginii',
		linkTab		: 'Link (Legatura web)',
		button2Img	: 'Do you want to transform the selected image button on a simple image?', // MISSING
		img2Button	: 'Do you want to transform the selected image on a image button?', // MISSING
		urlMissing	: 'Sursa URL a imaginii lipseste.',
		validateBorder	: 'Bordura trebuie sa fie un numar ^intreg.',
		validateHSpace	: 'Hspace trebuie sa fie un numar ^intreg.',
		validateVSpace	: 'Vspace trebuie sa fie un numar ^intreg.'
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Proprietatile flashului',
		propertiesTab	: 'Proprietati',
		title			: 'Proprietatile flashului',
		chkPlay			: 'Ruleaza automat',
		chkLoop			: 'Repeta (Loop)',
		chkMenu			: 'Activeaza meniul flash',
		chkFull			: 'Permite pe tot ecranul',
 		scale			: 'Scala',
		scaleAll		: 'Arata tot',
		scaleNoBorder	: 'Fara bordura (No border)',
		scaleFit		: 'Potriveste',
		access			: 'Acces script',
		accessAlways	: '^Intotdeauna',
		accessSameDomain: 'Acelasi domeniu',
		accessNever		: 'Niciodata',
		alignAbsBottom	: 'Jos absolut (Abs Bottom)',
		alignAbsMiddle	: 'Mijloc absolut (Abs Middle)',
		alignBaseline	: 'Linia de jos (Baseline)',
		alignTextTop	: 'Text sus',
		quality			: 'Calitate',
		qualityBest		: 'Cea mai buna',
		qualityHigh		: '^Inalta',
		qualityAutoHigh	: 'Auto ^inalta',
		qualityMedium	: 'Medie',
		qualityAutoLow	: 'Auto Joasa',
		qualityLow		: 'Joasa',
		windowModeWindow: 'Fereastra',
		windowModeOpaque: 'Opaca',
		windowModeTransparent : 'Transparenta',
		windowMode		: 'Mod fereastra',
		flashvars		: 'Variabile pentru flash',
		bgcolor			: 'Coloarea fundalului',
		hSpace			: 'HSpace',
		vSpace			: 'VSpace',
		validateSrc		: 'Va rugam sa scrieti URL-ul',
		validateHSpace	: 'Hspace trebuie sa fie un numar.',
		validateVSpace	: 'VSpace trebuie sa fie un numar'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Verifica scrierea textului',
		title			: 'Spell Check', // MISSING
		notAvailable	: 'Scuzati, dar serviciul nu este disponibil momentan.',
		errorLoading	: 'Eroare ^in lansarea aplicatiei service host %s.',
		notInDic		: 'Nu e ^in dictionar',
		changeTo		: 'Schimba ^in',
		btnIgnore		: 'Ignora',
		btnIgnoreAll	: 'Ignora toate',
		btnReplace		: '^Inlocuieste',
		btnReplaceAll	: '^Inlocuieste tot',
		btnUndo			: 'Starea anterioara (undo)',
		noSuggestions	: '- Fara sugestii -',
		progress		: 'Verificarea textului ^in desfasurare...',
		noMispell		: 'Verificarea textului terminata: Nicio greseala gasita',
		noChanges		: 'Verificarea textului terminata: Niciun cuv^ant modificat',
		oneChange		: 'Verificarea textului terminata: Un cuv^ant modificat',
		manyChanges		: 'Verificarea textului terminata: 1% cuvinte modificate',
		ieSpellDownload	: 'Unealta pentru verificat textul (Spell checker) neinstalata. Doriti sa o descarcati acum?'
	},

	smiley :
	{
		toolbar	: 'Figura expresiva (Emoticon)',
		title	: 'Insereaza o figura expresiva (Emoticon)',
		options : 'Optiuni figuri expresive'
	},

	elementsPath :
	{
		eleLabel : 'Calea elementelor',
		eleTitle : '%1 element' // MISSING
	},

	numberedlist	: 'Insereaza / Elimina Lista numerotata',
	bulletedlist	: 'Insereaza / Elimina Lista cu puncte',
	indent			: 'Creste indentarea',
	outdent			: 'Scade indentarea',

	justify :
	{
		left	: 'Aliniere la st^anga',
		center	: 'Aliniere centrala',
		right	: 'Aliniere la dreapta',
		block	: 'Aliniere ^in bloc (Block Justify)'
	},

	blockquote : 'Citat',

	clipboard :
	{
		title		: 'Adauga',
		cutError	: 'Setarile de securitate ale navigatorului (browser) pe care ^il folositi nu permit editorului sa execute automat operatiunea de taiere. Va rugam folositi tastatura (Ctrl/Cmd+X).',
		copyError	: 'Setarile de securitate ale navigatorului (browser) pe care ^il folositi nu permit editorului sa execute automat operatiunea de copiere. Va rugam folositi tastatura (Ctrl/Cmd+C).',
		pasteMsg	: 'Va rugam adaugati ^in casuta urmatoare folosind tastatura (<strong>Ctrl/Cmd+V</strong>) si apasati OK',
		securityMsg	: 'Din cauza setarilor de securitate ale programului dvs. cu care navigati pe internet (browser), editorul nu poate accesa direct datele din clipboard. Va trebui sa adaugati din nou datele ^in aceasta fereastra.',
		pasteArea	: 'Suprafata de adaugare'
	},

	pastefromword :
	{
		confirmCleanup	: 'Textul pe care doriti sa-l lipiti este din Word. Doriti curatarea textului ^inante de a-l adauga?',
		toolbar			: 'Adauga din Word',
		title			: 'Adauga din Word',
		error			: 'Nu a fost posibila curatarea datelor adaugate datorita unei erori interne'
	},

	pasteText :
	{
		button	: 'Adauga ca text simplu (Plain Text)',
		title	: 'Adauga ca text simplu (Plain Text)'
	},

	templates :
	{
		button			: 'Template-uri (sabloane)',
		title			: 'Template-uri (sabloane) de continut',
		options : 'Optiuni sabloane',
		insertOption	: '^Inlocuieste cuprinsul actual',
		selectPromptMsg	: 'Va rugam selectati template-ul (sablonul) ce se va deschide ^in editor<br>(continutul actual va fi pierdut):',
		emptyListMsg	: '(Niciun template (sablon) definit)'
	},

	showBlocks : 'Arata blocurile',

	stylesCombo :
	{
		label		: 'Stil',
		panelTitle	: 'Formatarea stilurilor',
		panelTitle1	: 'Block Styles', // MISSING
		panelTitle2	: 'Inline Styles', // MISSING
		panelTitle3	: 'Object Styles' // MISSING
	},

	format :
	{
		label		: 'Formatare',
		panelTitle	: 'Formatare',

		tag_p		: 'Normal',
		tag_pre		: 'Formatat',
		tag_address	: 'Adresa',
		tag_h1		: 'Heading 1',
		tag_h2		: 'Heading 2',
		tag_h3		: 'Heading 3',
		tag_h4		: 'Heading 4',
		tag_h5		: 'Heading 5',
		tag_h6		: 'Heading 6',
		tag_div		: 'Normal (DIV)'
	},

	div :
	{
		title				: 'Create Div Container', // MISSING
		toolbar				: 'Create Div Container', // MISSING
		cssClassInputLabel	: 'Stylesheet Classes', // MISSING
		styleSelectLabel	: 'Stil',
		IdInputLabel		: 'Id',
		languageCodeInputLabel	: 'Codul limbii',
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
		label		: 'Font',
		voiceLabel	: 'Font', // MISSING
		panelTitle	: 'Font'
	},

	fontSize :
	{
		label		: 'Marime',
		voiceLabel	: 'Font Size', // MISSING
		panelTitle	: 'Marime'
	},

	colorButton :
	{
		textColorTitle	: 'Culoarea textului',
		bgColorTitle	: 'Coloarea fundalului',
		panelTitle		: 'Colors', // MISSING
		auto			: 'Automatic',
		more			: 'Mai multe culori...'
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

	maximize : 'Mareste',
	minimize : 'Micsoreaza',

	fakeobjects :
	{
		anchor		: 'Anchor', // MISSING
		flash		: 'Flash Animation', // MISSING
		iframe		: 'IFrame', // MISSING
		hiddenfield	: 'Hidden Field', // MISSING
		unknown		: 'Unknown Object' // MISSING
	},

	resize : 'Trage pentru a redimensiona',

	colordialog :
	{
		title		: 'Select color', // MISSING
		options	:	'Color Options', // MISSING
		highlight	: 'Highlight', // MISSING
		selected	: 'Selected Color', // MISSING
		clear		: 'Clear' // MISSING
	},

	toolbarCollapse	: 'Micsoreaza Bara',
	toolbarExpand	: 'Mareste Bara',

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
		label : 'Proprietatile documentului',
		title : 'Proprietatile documentului',
		design : 'Design', // MISSING
		meta : 'Meta Tags', // MISSING
		chooseColor : 'Choose', // MISSING
		other : '<alt>',
		docTitle :	'Titlul paginii',
		charset : 	'Encoding setului de caractere',
		charsetOther : 'Alt encoding al setului de caractere',
		charsetASCII : 'ASCII', // MISSING
		charsetCE : 'Central European', // MISSING
		charsetCT : 'Chinezesc traditional (Big5)',
		charsetCR : 'Chirilic',
		charsetGR : 'Grecesc',
		charsetJP : 'Japonez',
		charsetKR : 'Corean',
		charsetTR : 'Turcesc',
		charsetUN : 'Unicode (UTF-8)', // MISSING
		charsetWE : 'Vest european',
		docType : 'Document Type Heading', // MISSING
		docTypeOther : 'Alt Document Type Heading',
		xhtmlDec : 'Include declaratii XHTML',
		bgColor : 'Culoarea fundalului (Background Color)',
		bgImage : 'URL-ul imaginii din fundal (Background Image URL)',
		bgFixed : 'Fundal neflotant, fix (Non-scrolling Background)',
		txtColor : 'Culoarea textului',
		margin : 'Marginile paginii',
		marginTop : 'Sus',
		marginLeft : 'St^anga',
		marginRight : 'Dreapta',
		marginBottom : 'Jos',
		metaKeywords : 'Cuvinte cheie dupa care se va indexa documentul (separate prin virgula)',
		metaDescription : 'Descrierea documentului',
		metaAuthor : 'Autor',
		metaCopyright : 'Drepturi de autor',
		previewHtml : '<p>This is some <strong>sample text</strong>. You are using <a href="javascript:void(0)">CKEditor</a>.</p>' // MISSING
	}
};
