/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Greek language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Contains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['el'] =
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
	toolbars	: 'Εργαλειοθκε Επεξεργαστ',
	editor		: 'Επεξεργαστ Πλοσιου Κειμνου',

	// Toolbar buttons without dialogs.
	source			: 'HTML κδικα',
	newPage			: 'Να Σελδα',
	save			: 'Αποθκευση',
	preview			: 'Προεπισκπιση',
	cut				: 'Αποκοπ',
	copy			: 'Αντιγραφ',
	paste			: 'Επικλληση',
	print			: 'Εκτπωση',
	underline		: 'Υπογρμμιση',
	bold			: 'ντονα',
	italic			: 'Πλγια',
	selectAll		: 'Επιλογ λων',
	removeFormat	: 'Αφαρεση Μορφοποηση',
	strike			: 'Διαγρμμιση',
	subscript		: 'Δεκτη',
	superscript		: 'Εκθτη',
	horizontalrule	: 'Εισαγωγ Οριζντια Γραμμ',
	pagebreak		: 'Εισαγωγ τλου σελδα',
	pagebreakAlt		: 'Αλλαγ Σελδα',
	unlink			: 'Αφαρεση Συνδσμου (Link)',
	undo			: 'Αναρεση',
	redo			: 'Επαναφορ',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Εξερενηση διακομιστ',
		url				: 'URL',
		protocol		: 'Πρωτκολλο',
		upload			: 'Ανβασμα',
		uploadSubmit	: 'Αποστολ στον Διακομιστ',
		image			: 'Εικνα',
		flash			: 'Εισαγωγ Flash',
		form			: 'Φρμα',
		checkbox		: 'Κουτ επιλογ',
		radio			: 'Κουμπ επιλογ',
		textField		: 'Πεδο κειμνου',
		textarea		: 'Περιοχ κειμνου',
		hiddenField		: 'Κρυφ πεδο',
		button			: 'Κουμπ',
		select			: 'Πεδο επιλογ',
		imageButton		: 'Κουμπ εικνα',
		notSet			: '<δεν χει ρυθμιστε>',
		id				: 'Id',
		name			: 'νομα',
		langDir			: 'Κατεθυνση κειμνου',
		langDirLtr		: 'Αριστερ προ Δεξι (LTR)',
		langDirRtl		: 'Δεξι προ Αριστερ (RTL)',
		langCode		: 'Κωδικ Γλσσα',
		longDescr		: 'Αναλυτικ περιγραφ URL',
		cssClass		: 'Stylesheet Classes',
		advisoryTitle	: 'Ενδεικτικ ττλο',
		cssStyle		: 'Μορφ κειμνου',
		ok				: 'OK',
		cancel			: 'Ακρωση',
		close			: 'Κλεσιμο',
		preview			: 'Προεπισκπηση',
		generalTab		: 'Γενικ',
		advancedTab		: 'Για προχωρημνου',
		validateNumberFailed : 'Αυτ η τιμ δεν εναι αριθμ.',
		confirmNewPage	: 'Οι ποιε αλλαγ στο περιεχμενο θα χαθον. Εσαστε σγουροι τι θλετε να φορτσετε μια να σελδα;',
		confirmCancel	: 'Μερικ επιλογ χουν αλλξει. Εσαστε σγουροι τι θλετε να κλεσετε το παρθυρο διαλγου;',
		options			: 'Επιλογ',
		target			: 'Προορισμ',
		targetNew		: 'Νο Παρθυρο (_blank)',
		targetTop		: 'Αρχικ Περιοχ (_top)',
		targetSelf		: 'δια Περιοχ (_self)',
		targetParent	: 'Γονεκ Παρθυρο (_parent)',
		langDirLTR		: 'Αριστερ προ Δεξι (LTR)',
		langDirRTL		: 'Δεξι προ Αριστερ (RTL)',
		styles			: 'Μορφ',
		cssClasses		: 'Stylesheet Classes', // MISSING
		width			: 'Πλτο',
		height			: 'ψο',
		align			: 'Στοχιση',
		alignLeft		: 'Αριστερ',
		alignRight		: 'Δεξι',
		alignCenter		: 'Κντρο',
		alignTop		: 'Πνω',
		alignMiddle		: 'Μση',
		alignBottom		: 'Κτω',
		invalidValue	: 'Invalid value.', // MISSING
		invalidHeight	: 'Το ψο πρπει να εναι να αριθμ.',
		invalidWidth	: 'Το πλτο πρπει να εναι να αριθμ.',
		invalidCssLength	: 'Value specified for the "%1" field must be a positive number with or without a valid CSS measurement unit (px, %, in, cm, mm, em, ex, pt, or pc).', // MISSING
		invalidHtmlLength	: 'Value specified for the "%1" field must be a positive number with or without a valid HTML measurement unit (px or %).', // MISSING
		invalidInlineStyle	: 'Value specified for the inline style must consist of one or more tuples with the format of "name : value", separated by semi-colons.', // MISSING
		cssLengthTooltip	: 'Enter a number for a value in pixels or a number with a valid CSS unit (px, %, in, cm, mm, em, ex, pt, or pc).', // MISSING

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, unavailable</span>' // MISSING
	},

	contextmenu :
	{
		options : 'Επιλογ Αναδυμενου Μενο'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Εισαγωγ Ειδικο Χαρακτρα',
		title		: 'Επιλξτε ναν Ειδικ Χαρακτρα',
		options : 'Επιλογ Ειδικν Χαρακτρων'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Σνδεσμο',
		other 		: '<λλο>',
		menu		: 'Επεξεργασα Συνδσμου',
		title		: 'Σνδεσμο',
		info		: 'Πληροφορε Συνδσμου',
		target		: 'Παρθυρο Προορισμο',
		upload		: 'Ανβασμα',
		advanced	: 'Για προχωρημνου',
		type		: 'Τπο Συνδσμου',
		toUrl		: 'URL', // MISSING
		toAnchor	: 'γκυρα σε αυτ τη σελδα',
		toEmail		: 'E-Mail',
		targetFrame		: '<πλασιο>',
		targetPopup		: '<αναδυμενο παρθυρο>',
		targetFrameName	: 'νομα Παραθρου Προορισμο',
		targetPopupName	: 'νομα Αναδυμενου Παραθρου',
		popupFeatures	: 'Επιλογ Αναδυμενου Παραθρου',
		popupResizable	: 'Προσαρμοζμενο Μγεθο',
		popupStatusBar	: 'Γραμμ Κατσταση',
		popupLocationBar: 'Γραμμ Τοποθεσα',
		popupToolbar	: 'Εργαλειοθκη',
		popupMenuBar	: 'Γραμμ Επιλογν',
		popupFullScreen	: 'Πλρη Οθνη (IE)',
		popupScrollBars	: 'Μπρε Κλιση',
		popupDependent	: 'Εξαρτημνο (Netscape)',
		popupLeft		: 'Θση Αριστερ',
		popupTop		: 'Θση Πνω',
		id				: 'Id', // MISSING
		langDir			: 'Κατεθυνση Κειμνου',
		langDirLTR		: 'Αριστερ προ Δεξι (LTR)',
		langDirRTL		: 'Δεξι προ Αριστερ (RTL)',
		acccessKey		: 'Συντμευση',
		name			: 'νομα',
		langCode			: 'Κατεθυνση Κειμνου',
		tabIndex			: 'Σειρ Μεταπδηση',
		advisoryTitle		: 'Ενδεικτικ Ττλο',
		advisoryContentType	: 'Ενδεικτικ Τπο Περιεχομνου',
		cssClasses		: 'Stylesheet Classes',
		charset			: 'Κωδικοποηση Χαρακτρων Προσαρτημνη Πηγ',
		styles			: 'Μορφ',
		rel			: 'Σχση',
		selectAnchor		: 'Επιλξτε μια γκυρα',
		anchorName		: 'Βσει του Ονματο τη γκυρα',
		anchorId			: 'Βσει του Element Id',
		emailAddress		: 'Διεθυνση e-mail',
		emailSubject		: 'Θμα Μηνματο',
		emailBody		: 'Κεμενο Μηνματο',
		noAnchors		: '(Δεν υπρχουν γκυρε στο κεμενο)',
		noUrl			: 'Εισγετε την τοποθεσα (URL) του υπερσυνδσμου (Link)',
		noEmail			: 'Εισγετε την διεθυνση ηλεκτρονικο ταχυδρομεου'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Εισαγωγ/επεξεργασα γκυρα',
		menu		: 'Ιδιτητε γκυρα',
		title		: 'Ιδιτητε γκυρα',
		name		: 'νομα γκυρα',
		errorName	: 'Παρακαλομε εισγετε νομα γκυρα',
		remove		: 'Αφαρεση γκυρα'
	},

	// List style dialog
	list:
	{
		numberedTitle		: 'Ιδιτητε Αριθμημνη Λστα ',
		bulletedTitle		: 'Ιδιτητε Λστα Σημεων',
		type				: 'Τπο',
		start				: 'Εκκνηση',
		validateStartNumber				:'Ο αριθμ εκκνηση τη αρθμηση πρπει να εναι ακραιο αριθμ.',
		circle				: 'Κκλο',
		disc				: 'Δσκο',
		square				: 'Τετργωνο',
		none				: 'Τποτα',
		notset				: '<δεν χει οριστε>',
		armenian			: 'Armenian numbering', // MISSING
		georgian			: 'Georgian numbering (an, ban, gan, etc.)', // MISSING
		lowerRoman			: 'Lower Roman (i, ii, iii, iv, v, etc.)', // MISSING
		upperRoman			: 'Upper Roman (I, II, III, IV, V, etc.)', // MISSING
		lowerAlpha			: 'Lower Alpha (a, b, c, d, e, etc.)', // MISSING
		upperAlpha			: 'Upper Alpha (A, B, C, D, E, etc.)', // MISSING
		lowerGreek			: 'Lower Greek (alpha, beta, gamma, etc.)', // MISSING
		decimal				: 'Δεκαδικ (1, 2, 3, κτλ)',
		decimalLeadingZero	: 'Decimal leading zero (01, 02, 03, etc.)' // MISSING
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Αναζτηση και Αντικατσταση',
		find				: 'Αναζτηση',
		replace				: 'Αντικατσταση',
		findWhat			: 'Αναζτηση για:',
		replaceWith			: 'Αντικατσταση με:',
		notFoundMsg			: 'Το κεμενο δεν βρθηκε.',
		findOptions			: 'Find Options', // MISSING
		matchCase			: 'λεγχο πεζν/κεφαλαων',
		matchWord			: 'Ερεση πλρου λξη',
		matchCyclic			: 'Match cyclic', // MISSING
		replaceAll			: 'Αντικατσταση λων',
		replaceSuccessMsg	: '%1 occurrence(s) replaced.' // MISSING
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Πνακα',
		title		: 'Ιδιτητε Πνακα',
		menu		: 'Ιδιτητε Πνακα',
		deleteTable	: 'Διαγραφ πνακα',
		rows		: 'Γραμμ',
		columns		: 'Κολνε',
		border		: 'Πχο Περιγρμματο',
		widthPx		: 'pixels',
		widthPc		: 'τοι εκατ',
		widthUnit	: 'μονδα πλτου',
		cellSpace	: 'Διστημα κελιν',
		cellPad		: 'Γμισμα κελιν',
		caption		: 'Λεζντα',
		summary		: 'Περληψη',
		headers		: 'Κεφαλδε',
		headersNone		: 'Καννα',
		headersColumn	: 'Πρτη Στλη',
		headersRow		: 'Πρτη Σειρ',
		headersBoth		: 'Και τα δο',
		invalidRows		: 'Ο αριθμ των σειρν πρπει να εναι μεγαλτερο απ 0.',
		invalidCols		: 'Ο αριθμ των στηλν πρπει να εναι μεγαλτερο απ 0.',
		invalidBorder	: 'Το πχο του περιγρμματο πρπει να εναι να αριθμ.',
		invalidWidth	: 'Το πλτο του πνακα πρπει να εναι να αριθμ.',
		invalidHeight	: 'Το ψο του πνακα πρπει να εναι να αριθμ.',
		invalidCellSpacing	: 'Η απσταση μεταξ των κελιν πρπει να εναι να θετικ αριθμ.',
		invalidCellPadding	: 'Το γμισμα μσα στα κελι πρπει να εναι να θετικ αριθμ.',

		cell :
		{
			menu			: 'Κελ',
			insertBefore	: 'Εισαγωγ Κελιο Πριν',
			insertAfter		: 'Εισαγωγ Κελιο Μετ',
			deleteCell		: 'Διαγραφ Κελιν',
			merge			: 'Ενοποηση Κελιν',
			mergeRight		: 'Συγχνευση Με Δεξι',
			mergeDown		: 'Συγχνευση Με Κτω',
			splitHorizontal	: 'Οριζντιο Μορασμα Κελιο',
			splitVertical	: 'Κατακρυφο Μορασμα Κελιο',
			title			: 'Ιδιτητε Κελιο',
			cellType		: 'Τπο Κελιο',
			rowSpan			: 'Ερο Σειρν',
			colSpan			: 'Ερο Στηλν',
			wordWrap		: 'Word Wrap', // MISSING
			hAlign			: 'Οριζντια Στοχιση',
			vAlign			: 'Κθετη Στοχιση',
			alignBaseline	: 'Baseline', // MISSING
			bgColor			: 'Χρμα Φντου',
			borderColor		: 'Χρμα Περιγρμματο',
			data			: 'Δεδομνα',
			header			: 'Κεφαλδα',
			yes				: 'Ναι',
			no				: 'χι',
			invalidWidth	: 'Το πλτο του κελιο πρπει να εναι να αριθμ.',
			invalidHeight	: 'Το ψο του κελιο πρπει να εναι να αριθμ.',
			invalidRowSpan	: 'Rows span must be a whole number.', // MISSING
			invalidColSpan	: 'Columns span must be a whole number.', // MISSING
			chooseColor		: 'Επιλξτε'
		},

		row :
		{
			menu			: 'Σειρ',
			insertBefore	: 'Εισαγωγ Σειρ Απ Πνω',
			insertAfter		: 'Εισαγωγ Σειρ Απ Κτω',
			deleteRow		: 'Διαγραφ Γραμμν'
		},

		column :
		{
			menu			: 'Στλη',
			insertBefore	: 'Εισαγωγ Στλη Πριν',
			insertAfter		: 'Εισαγωγ Σειρ Μετ',
			deleteColumn	: 'Διαγραφ Κολωνν'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Ιδιτητε Κουμπιο',
		text		: 'Κεμενο (Τιμ)',
		type		: 'Τπο',
		typeBtn		: 'Κουμπ',
		typeSbm		: 'Υποβολ',
		typeRst		: 'Επαναφορ'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Ιδιτητε Κουτιο Επιλογ',
		radioTitle	: 'Ιδιτητε Κουμπιο Επιλογ',
		value		: 'Τιμ',
		selected	: 'Επιλεγμνο'
	},

	// Form Dialog.
	form :
	{
		title		: 'Ιδιτητε Φρμα',
		menu		: 'Ιδιτητε Φρμα',
		action		: 'Δρση',
		method		: 'Μθοδο',
		encoding	: 'Κωδικοποηση'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Ιδιτητε Πεδου Επιλογ',
		selectInfo	: 'Πληροφορε Πεδου Επιλογ',
		opAvail		: 'Διαθσιμε Επιλογ',
		value		: 'Τιμ',
		size		: 'Μγεθο',
		lines		: 'γραμμ',
		chkMulti	: 'Να επιτρπονται οι πολλαπλ επιλογ',
		opText		: 'Κεμενο',
		opValue		: 'Τιμ',
		btnAdd		: 'Προσθκη',
		btnModify	: 'Τροποποηση',
		btnUp		: 'Πνω',
		btnDown		: 'Κτω',
		btnSetValue : 'Προεπιλογ',
		btnDelete	: 'Διαγραφ'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Ιδιτητε Περιοχ Κειμνου',
		cols		: 'Στλε',
		rows		: 'Σειρ'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Ιδιτητε Πεδου Κειμνου',
		name		: 'νομα',
		value		: 'Τιμ',
		charWidth	: 'Πλτο Χαρακτρων',
		maxChars	: 'Μγιστοι χαρακτρε',
		type		: 'Τπο',
		typeText	: 'Κεμενο',
		typePass	: 'Κωδικ'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Ιδιτητε Κρυφο Πεδου',
		name	: 'νομα',
		value	: 'Τιμ'
	},

	// Image Dialog.
	image :
	{
		title		: 'Ιδιτητε Εικνα',
		titleButton	: 'Ιδιτητε Κουμπιο Εικνα',
		menu		: 'Ιδιτητε Εικνα',
		infoTab		: 'Πληροφορε Εικνα',
		btnUpload	: 'Αποστολ στον Διακομιστ',
		upload		: 'Ανβασμα',
		alt			: 'Εναλλακτικ Κεμενο',
		lockRatio	: 'Κλεδωμα Αναλογα',
		resetSize	: 'Επαναφορ Αρχικο Μεγθου',
		border		: 'Περγραμμα',
		hSpace		: 'Οριζντιο Διστημα',
		vSpace		: 'Κθετο Διστημα',
		alertUrl	: 'Εισγετε την τοποθεσα (URL) τη εικνα',
		linkTab		: 'Σνδεσμο',
		button2Img	: 'Θλετε να μετατρψετε το επιλεγμνο κουμπ εικνα σε απλ εικνα;',
		img2Button	: 'Do you want to transform the selected image on a image button?', // MISSING
		urlMissing	: 'Image source URL is missing.', // MISSING
		validateBorder	: 'Border must be a whole number.', // MISSING
		validateHSpace	: 'HSpace must be a whole number.', // MISSING
		validateVSpace	: 'VSpace must be a whole number.' // MISSING
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Ιδιτητε Flash',
		propertiesTab	: 'Ιδιτητε',
		title			: 'Ιδιτητε Flash',
		chkPlay			: 'Αυτματη Εκτλεση',
		chkLoop			: 'Επανληψη',
		chkMenu			: 'Ενεργοποηση Flash Menu',
		chkFull			: 'Allow Fullscreen', // MISSING
 		scale			: 'Μεγθυνση',
		scaleAll		: 'Εμφνιση λων',
		scaleNoBorder	: 'Χωρ Περγραμμα',
		scaleFit		: 'Ακριβ Μγεθο',
		access			: 'Script Access', // MISSING
		accessAlways	: 'Always', // MISSING
		accessSameDomain: 'Same domain', // MISSING
		accessNever		: 'Never', // MISSING
		alignAbsBottom	: 'Απλυτα Κτω',
		alignAbsMiddle	: 'Απλυτα στη Μση',
		alignBaseline	: 'Γραμμ Βση',
		alignTextTop	: 'Κορυφ Κειμνου',
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
		bgcolor			: 'Χρμα Υποβθρου',
		hSpace			: 'Οριζντιο Διστημα',
		vSpace			: 'Κθετο Διστημα',
		validateSrc		: 'Εισγετε την τοποθεσα (URL) του υπερσυνδσμου (Link)',
		validateHSpace	: 'HSpace must be a number.', // MISSING
		validateVSpace	: 'VSpace must be a number.' // MISSING
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Ορθογραφικ λεγχο',
		title			: 'Spell Check', // MISSING
		notAvailable	: 'Sorry, but service is unavailable now.', // MISSING
		errorLoading	: 'Error loading application service host: %s.', // MISSING
		notInDic		: 'Δεν υπρχει στο λεξικ',
		changeTo		: 'Αλλαγ σε',
		btnIgnore		: 'Αγνηση',
		btnIgnoreAll	: 'Αγνηση λων',
		btnReplace		: 'Αντικατσταση',
		btnReplaceAll	: 'Αντικατσταση λων',
		btnUndo			: 'Αναρεση',
		noSuggestions	: '- Δεν υπρχουν προτσει -',
		progress		: 'Γνεται ορθογραφικ λεγχο...',
		noMispell		: 'Ο ορθογραφικ λεγχο ολοκληρθηκε: Δεν βρθηκαν λθη',
		noChanges		: 'Ο ορθογραφικ λεγχο ολοκληρθηκε: Δεν λλαξαν λξει',
		oneChange		: 'Ο ορθογραφικ λεγχο ολοκληρθηκε: λλαξε μια λξη',
		manyChanges		: 'Ο ορθογραφικ λεγχο ολοκληρθηκε: λλαξαν %1 λξει',
		ieSpellDownload	: 'Δεν υπρχει εγκατεστημνο ορθογρφο. Θλετε να τον κατεβσετε τρα;'
	},

	smiley :
	{
		toolbar	: 'Smiley',
		title	: 'Επιλξτε να Smiley',
		options : 'Smiley Options' // MISSING
	},

	elementsPath :
	{
		eleLabel : 'Elements path', // MISSING
		eleTitle : '%1 element' // MISSING
	},

	numberedlist	: 'Εισαγωγ/Απομκρυνση Αριθμημνη Λστα',
	bulletedlist	: 'Εισαγωγ/Απομκρυνση Λστα Κουκκδων',
	indent			: 'Αξηση Εσοχ',
	outdent			: 'Μεωση Εσοχ',

	justify :
	{
		left	: 'Στοχιση Αριστερ',
		center	: 'Στοχιση στο Κντρο',
		right	: 'Στοχιση Δεξι',
		block	: 'Πλρη Στοχιση'
	},

	blockquote : 'Περιοχ Παρθεση',

	clipboard :
	{
		title		: 'Επικλληση',
		cutError	: 'Οι ρυθμσει ασφαλεα του φυλλομετρητ σα δεν επιτρπουν την επιλεγμνη εργασα αποκοπ. Χρησιμοποιεστε το πληκτρολγιο (Ctrl/Cmd+X).',
		copyError	: 'Οι ρυθμσει ασφαλεα του φυλλομετρητ σα δεν επιτρπουν την επιλεγμνη εργασα αντιγραφ. Χρησιμοποιεστε το πληκτρολγιο (Ctrl/Cmd+C).',
		pasteMsg	: 'Παρακαλ επικολστε στο ακλουθο κουτ χρησιμοποιντα το πληκτρολγιο (<strong>Ctrl/Cmd+V</strong>) και πατστε OK.',
		securityMsg	: 'Because of your browser security settings, the editor is not able to access your clipboard data directly. You are required to paste it again in this window.', // MISSING
		pasteArea	: 'Paste Area' // MISSING
	},

	pastefromword :
	{
		confirmCleanup	: 'The text you want to paste seems to be copied from Word. Do you want to clean it before pasting?', // MISSING
		toolbar			: 'Επικλληση απ το Word',
		title			: 'Επικλληση απ το Word',
		error			: 'It was not possible to clean up the pasted data due to an internal error' // MISSING
	},

	pasteText :
	{
		button	: 'Επικλληση ω Απλ Κεμενο',
		title	: 'Επικλληση ω Απλ Κεμενο'
	},

	templates :
	{
		button			: 'Πρτυπα',
		title			: 'Πρτυπα Περιεχομνου',
		options : 'Template Options', // MISSING
		insertOption	: 'Αντικατσταση υπρχοντων περιεχομνων',
		selectPromptMsg	: 'Παρακαλ επιλξτε πρτυπο για εισαγωγ στο πργραμμα',
		emptyListMsg	: '(Δεν χουν καθοριστε πρτυπα)'
	},

	showBlocks : 'Προβολ Περιοχν',

	stylesCombo :
	{
		label		: 'Μορφ',
		panelTitle	: 'Formatting Styles', // MISSING
		panelTitle1	: 'Block Styles', // MISSING
		panelTitle2	: 'Inline Styles', // MISSING
		panelTitle3	: 'Object Styles' // MISSING
	},

	format :
	{
		label		: 'Μορφοποηση',
		panelTitle	: 'Μορφοποηση Παραγρφου',

		tag_p		: 'Κανονικ',
		tag_pre		: 'Μορφοποιημνο',
		tag_address	: 'Διεθυνση',
		tag_h1		: 'Επικεφαλδα 1',
		tag_h2		: 'Επικεφαλδα 2',
		tag_h3		: 'Επικεφαλδα 3',
		tag_h4		: 'Επικεφαλδα 4',
		tag_h5		: 'Επικεφαλδα 5',
		tag_h6		: 'Επικεφαλδα 6',
		tag_div		: 'Normal (DIV)' // MISSING
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
		label		: 'Γραμματοσειρ',
		voiceLabel	: 'Font', // MISSING
		panelTitle	: 'νομα Γραμματοσειρ'
	},

	fontSize :
	{
		label		: 'Μγεθο',
		voiceLabel	: 'Font Size', // MISSING
		panelTitle	: 'Μγεθο Γραμματοσειρ'
	},

	colorButton :
	{
		textColorTitle	: 'Χρμα Κειμνου',
		bgColorTitle	: 'Χρμα Φντου',
		panelTitle		: 'Colors', // MISSING
		auto			: 'Αυτματα',
		more			: 'Περισστερα χρματα...'
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

	maximize : 'Μεγιστοποηση',
	minimize : 'Ελαχιστοποηση',

	fakeobjects :
	{
		anchor		: 'Anchor', // MISSING
		flash		: 'Flash Animation', // MISSING
		iframe		: 'IFrame', // MISSING
		hiddenfield	: 'Hidden Field', // MISSING
		unknown		: 'Unknown Object' // MISSING
	},

	resize : 'Σρσιμο για αλλαγ μεγθου',

	colordialog :
	{
		title		: 'Select color', // MISSING
		options	:	'Color Options', // MISSING
		highlight	: 'Highlight', // MISSING
		selected	: 'Selected Color', // MISSING
		clear		: 'Clear' // MISSING
	},

	toolbarCollapse	: 'Σμπτηξη Εργαλειοθκη',
	toolbarExpand	: 'Ανπτυξη Εργαλειοθκη',

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
		label : 'Ιδιτητε Εγγρφου',
		title : 'Ιδιτητε Εγγρφου',
		design : 'Design', // MISSING
		meta : 'Δεδομνα Meta',
		chooseColor : 'Choose', // MISSING
		other : 'λλο...',
		docTitle :	'Ττλο Σελδα',
		charset : 	'Κωδικοποηση Χαρακτρων',
		charsetOther : 'λλη Κωδικοποηση Χαρακτρων',
		charsetASCII : 'ASCII', // MISSING
		charsetCE : 'Κεντρικ Ευρπη',
		charsetCT : 'Παραδοσιακ κινζικα (Big5)',
		charsetCR : 'Κυριλλικ',
		charsetGR : 'Ελληνικ',
		charsetJP : 'Ιαπωνικ',
		charsetKR : 'Κορετικη',
		charsetTR : 'Τουρκικ',
		charsetUN : 'Διεθν (UTF-8)',
		charsetWE : 'Δυτικ Ευρπη',
		docType : 'Επικεφαλδα τπου εγγρφου',
		docTypeOther : 'λλη επικεφαλδα τπου εγγρφου',
		xhtmlDec : 'Να συμπεριληφθον οι δηλσει XHTML',
		bgColor : 'Χρμα φντου',
		bgImage : 'Διεθυνση εικνα φντου',
		bgFixed : 'Φντο χωρ κλιση',
		txtColor : 'Χρμα Γραμμτων',
		margin : 'Περιθρια σελδα',
		marginTop : 'Κορυφ',
		marginLeft : 'Αριστερ',
		marginRight : 'Δεξι',
		marginBottom : 'Κτω',
		metaKeywords : 'Λξει κλειδι δεκτε εγγρφου (διαχωρισμ με κμμα)',
		metaDescription : 'Περιγραφ εγγρφου',
		metaAuthor : 'Συγγραφα',
		metaCopyright : 'Πνευματικ Δικαιματα',
		previewHtml : '<p>This is some <strong>sample text</strong>. You are using <a href="javascript:void(0)">CKEditor</a>.</p>' // MISSING
	}
};
