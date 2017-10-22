/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object for the
 * Polish language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Contains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['pl'] =
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
	editorTitle : 'Edytor tekstu sformatowanego, %1',
	editorHelp : 'W celu uzyskania pomocy naci'snij ALT 0',

	// ARIA descriptions.
	toolbars	: 'Paski narzedzi edytora',
	editor		: 'Edytor tekstu sformatowanego',

	// Toolbar buttons without dialogs.
	source			: ''Zródlo dokumentu',
	newPage			: 'Nowa strona',
	save			: 'Zapisz',
	preview			: 'Podglad',
	cut				: 'Wytnij',
	copy			: 'Kopiuj',
	paste			: 'Wklej',
	print			: 'Drukuj',
	underline		: 'Podkre'slenie',
	bold			: 'Pogrubienie',
	italic			: 'Kursywa',
	selectAll		: 'Zaznacz wszystko',
	removeFormat	: 'Usuń formatowanie',
	strike			: 'Przekre'slenie',
	subscript		: 'Indeks dolny',
	superscript		: 'Indeks górny',
	horizontalrule	: 'Wstaw pozioma linie',
	pagebreak		: 'Wstaw podzial strony',
	pagebreakAlt		: 'Wstaw podzial strony',
	unlink			: 'Usuń odno'snik',
	undo			: 'Cofnij',
	redo			: 'Ponów',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Przegladaj',
		url				: 'Adres URL',
		protocol		: 'Protokól',
		upload			: 'Wy'slij',
		uploadSubmit	: 'Wy'slij',
		image			: 'Obrazek',
		flash			: 'Flash',
		form			: 'Formularz',
		checkbox		: 'Pole wyboru (checkbox)',
		radio			: 'Przycisk opcji (radio)',
		textField		: 'Pole tekstowe',
		textarea		: 'Obszar tekstowy',
		hiddenField		: 'Pole ukryte',
		button			: 'Przycisk',
		select			: 'Lista wyboru',
		imageButton		: 'Przycisk graficzny',
		notSet			: '<nie ustawiono>',
		id				: 'Id',
		name			: 'Nazwa',
		langDir			: 'Kierunek tekstu',
		langDirLtr		: 'Od lewej do prawej (LTR)',
		langDirRtl		: 'Od prawej do lewej (RTL)',
		langCode		: 'Kod jezyka',
		longDescr		: 'Adres URL dlugiego opisu',
		cssClass		: 'Nazwa klasy CSS',
		advisoryTitle	: 'Opis obiektu docelowego',
		cssStyle		: 'Styl',
		ok				: 'OK',
		cancel			: 'Anuluj',
		close			: 'Zamknij',
		preview			: 'Podglad',
		generalTab		: 'Ogólne',
		advancedTab		: 'Zaawansowane',
		validateNumberFailed : 'Ta warto's'c nie jest liczba.',
		confirmNewPage	: 'Wszystkie niezapisane zmiany zostana utracone. Czy na pewno wczyta'c nowa strone?',
		confirmCancel	: 'Pewne opcje zostaly zmienione. Czy na pewno zamkna'c okno dialogowe?',
		options			: 'Opcje',
		target			: 'Obiekt docelowy',
		targetNew		: 'Nowe okno (_blank)',
		targetTop		: 'Okno najwyzej w hierarchii (_top)',
		targetSelf		: 'To samo okno (_self)',
		targetParent	: 'Okno nadrzedne (_parent)',
		langDirLTR		: 'Od lewej do prawej (LTR)',
		langDirRTL		: 'Od prawej do lewej (RTL)',
		styles			: 'Style',
		cssClasses		: 'Klasy arkusza stylów',
		width			: 'Szeroko's'c',
		height			: 'Wysoko's'c',
		align			: 'Wyrównaj',
		alignLeft		: 'Do lewej',
		alignRight		: 'Do prawej',
		alignCenter		: 'Do 'srodka',
		alignTop		: 'Do góry',
		alignMiddle		: 'Do 'srodka',
		alignBottom		: 'Do dolu',
		invalidValue	: 'Invalid value.', // MISSING
		invalidHeight	: 'Wysoko's'c musi by'c liczba.',
		invalidWidth	: 'Szeroko's'c musi by'c liczba.',
		invalidCssLength	: 'Warto's'c podana dla pola "%1" musi by'c liczba dodatnia bez jednostki lub z poprawna jednostka dlugo'sci zgodna z CSS (px, %, in, cm, mm, em, ex, pt lub pc).',
		invalidHtmlLength	: 'Warto's'c podana dla pola "%1" musi by'c liczba dodatnia bez jednostki lub z poprawna jednostka dlugo'sci zgodna z HTML (px lub %).',
		invalidInlineStyle	: 'Warto's'c podana dla stylu musi sklada'c sie z jednej lub wiekszej liczby krotek w formacie "nazwa : warto's'c", rozdzielonych 'srednikami.',
		cssLengthTooltip	: 'Wpisz liczbe dla warto'sci w pikselach lub liczbe wraz z jednostka dlugo'sci zgodna z CSS (px, %, in, cm, mm, em, ex, pt lub pc).',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, niedostepne</span>'
	},

	contextmenu :
	{
		options : 'Opcje menu kontekstowego'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Wstaw znak specjalny',
		title		: 'Wybierz znak specjalny',
		options : 'Opcje znaków specjalnych'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Wstaw/edytuj odno'snik',
		other 		: '<inny>',
		menu		: 'Edytuj odno'snik',
		title		: 'Odno'snik',
		info		: 'Informacje ',
		target		: 'Obiekt docelowy',
		upload		: 'Wy'slij',
		advanced	: 'Zaawansowane',
		type		: 'Typ odno'snika',
		toUrl		: 'Adres URL',
		toAnchor	: 'Odno'snik wewnatrz strony (kotwica)',
		toEmail		: 'Adres e-mail',
		targetFrame		: '<ramka>',
		targetPopup		: '<wyskakujace okno>',
		targetFrameName	: 'Nazwa ramki docelowej',
		targetPopupName	: 'Nazwa wyskakujacego okna',
		popupFeatures	: 'Wla'sciwo'sci wyskakujacego okna',
		popupResizable	: 'Skalowalny',
		popupStatusBar	: 'Pasek statusu',
		popupLocationBar: 'Pasek adresu',
		popupToolbar	: 'Pasek narzedzi',
		popupMenuBar	: 'Pasek menu',
		popupFullScreen	: 'Pelny ekran (IE)',
		popupScrollBars	: 'Paski przewijania',
		popupDependent	: 'Okno zalezne (Netscape)',
		popupLeft		: 'Pozycja w poziomie',
		popupTop		: 'Pozycja w pionie',
		id				: 'Id',
		langDir			: 'Kierunek tekstu',
		langDirLTR		: 'Od lewej do prawej (LTR)',
		langDirRTL		: 'Od prawej do lewej (RTL)',
		acccessKey		: 'Klawisz dostepu',
		name			: 'Nazwa',
		langCode			: 'Kod jezyka',
		tabIndex			: 'Indeks kolejno'sci',
		advisoryTitle		: 'Opis obiektu docelowego',
		advisoryContentType	: 'Typ MIME obiektu docelowego',
		cssClasses		: 'Nazwa klasy CSS',
		charset			: 'Kodowanie znaków obiektu docelowego',
		styles			: 'Styl',
		rel			: 'Relacja',
		selectAnchor		: 'Wybierz kotwice',
		anchorName		: 'Wg nazwy',
		anchorId			: 'Wg identyfikatora',
		emailAddress		: 'Adres e-mail',
		emailSubject		: 'Temat',
		emailBody		: 'Tre's'c',
		noAnchors		: '(W dokumencie nie zdefiniowano zadnych kotwic)',
		noUrl			: 'Podaj adres URL',
		noEmail			: 'Podaj adres e-mail'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Wstaw/edytuj kotwice',
		menu		: 'Wla'sciwo'sci kotwicy',
		title		: 'Wla'sciwo'sci kotwicy',
		name		: 'Nazwa kotwicy',
		errorName	: 'Wpisz nazwe kotwicy',
		remove		: 'Usuń kotwice'
	},

	// List style dialog
	list:
	{
		numberedTitle		: 'Wla'sciwo'sci list numerowanych',
		bulletedTitle		: 'Wla'sciwo'sci list wypunktowanych',
		type				: 'Typ punktora',
		start				: 'Poczatek',
		validateStartNumber				:'Liste musi rozpoczyna'c liczba calkowita.',
		circle				: 'Kolo',
		disc				: 'Okrag',
		square				: 'Kwadrat',
		none				: 'Brak',
		notset				: '<nie ustawiono>',
		armenian			: 'Numerowanie armeńskie',
		georgian			: 'Numerowanie gruzińskie (an, ban, gan itd.)',
		lowerRoman			: 'Male cyfry rzymskie (i, ii, iii, iv, v itd.)',
		upperRoman			: 'Duze cyfry rzymskie (I, II, III, IV, V itd.)',
		lowerAlpha			: 'Male litery (a, b, c, d, e itd.)',
		upperAlpha			: 'Duze litery (A, B, C, D, E itd.)',
		lowerGreek			: 'Male litery greckie (alpha, beta, gamma itd.)',
		decimal				: 'Liczby (1, 2, 3 itd.)',
		decimalLeadingZero	: 'Liczby z poczatkowym zerem (01, 02, 03 itd.)'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Znajd'z i zamień',
		find				: 'Znajd'z',
		replace				: 'Zamień',
		findWhat			: 'Znajd'z:',
		replaceWith			: 'Zastap przez:',
		notFoundMsg			: 'Nie znaleziono szukanego hasla.',
		findOptions			: 'Opcje wyszukiwania',
		matchCase			: 'Uwzglednij wielko's'c liter',
		matchWord			: 'Cale slowa',
		matchCyclic			: 'Cykliczne dopasowanie',
		replaceAll			: 'Zamień wszystko',
		replaceSuccessMsg	: '%1 wystapień zastapionych.'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Tabela',
		title		: 'Wla'sciwo'sci tabeli',
		menu		: 'Wla'sciwo'sci tabeli',
		deleteTable	: 'Usuń tabele',
		rows		: 'Liczba wierszy',
		columns		: 'Liczba kolumn',
		border		: 'Grubo's'c obramowania',
		widthPx		: 'piksele',
		widthPc		: '%',
		widthUnit	: 'jednostka szeroko'sci',
		cellSpace	: 'Odstep pomiedzy komórkami',
		cellPad		: 'Dopelnienie komórek',
		caption		: 'Tytul',
		summary		: 'Podsumowanie',
		headers		: 'Naglówki',
		headersNone		: 'Brak',
		headersColumn	: 'Pierwsza kolumna',
		headersRow		: 'Pierwszy wiersz',
		headersBoth		: 'Oba',
		invalidRows		: 'Liczba wierszy musi by'c wieksza niz 0.',
		invalidCols		: 'Liczba kolumn musi by'c wieksza niz 0.',
		invalidBorder	: 'Warto's'c obramowania musi by'c liczba.',
		invalidWidth	: 'Szeroko's'c tabeli musi by'c liczba.',
		invalidHeight	: 'Wysoko's'c tabeli musi by'c liczba.',
		invalidCellSpacing	: 'Odstep pomiedzy komórkami musi by'c liczba dodatnia.',
		invalidCellPadding	: 'Dopelnienie komórek musi by'c liczba dodatnia.',

		cell :
		{
			menu			: 'Komórka',
			insertBefore	: 'Wstaw komórke z lewej',
			insertAfter		: 'Wstaw komórke z prawej',
			deleteCell		: 'Usuń komórki',
			merge			: 'Polacz komórki',
			mergeRight		: 'Polacz z komórka z prawej',
			mergeDown		: 'Polacz z komórka ponizej',
			splitHorizontal	: 'Podziel komórke poziomo',
			splitVertical	: 'Podziel komórke pionowo',
			title			: 'Wla'sciwo'sci komórki',
			cellType		: 'Typ komórki',
			rowSpan			: 'Scalenie wierszy',
			colSpan			: 'Scalenie komórek',
			wordWrap		: 'Zawijanie slów',
			hAlign			: 'Wyrównanie poziome',
			vAlign			: 'Wyrównanie pionowe',
			alignBaseline	: 'Linia bazowa',
			bgColor			: 'Kolor tla',
			borderColor		: 'Kolor obramowania',
			data			: 'Dane',
			header			: 'Naglówek',
			yes				: 'Tak',
			no				: 'Nie',
			invalidWidth	: 'Szeroko's'c komórki musi by'c liczba.',
			invalidHeight	: 'Wysoko's'c komórki musi by'c liczba.',
			invalidRowSpan	: 'Scalenie wierszy musi by'c liczba calkowita.',
			invalidColSpan	: 'Scalenie komórek musi by'c liczba calkowita.',
			chooseColor		: 'Wybierz'
		},

		row :
		{
			menu			: 'Wiersz',
			insertBefore	: 'Wstaw wiersz powyzej',
			insertAfter		: 'Wstaw wiersz ponizej',
			deleteRow		: 'Usuń wiersze'
		},

		column :
		{
			menu			: 'Kolumna',
			insertBefore	: 'Wstaw kolumne z lewej',
			insertAfter		: 'Wstaw kolumne z prawej',
			deleteColumn	: 'Usuń kolumny'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Wla'sciwo'sci przycisku',
		text		: 'Tekst (Warto's'c)',
		type		: 'Typ',
		typeBtn		: 'Przycisk',
		typeSbm		: 'Wy'slij',
		typeRst		: 'Wyczy's'c'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Wla'sciwo'sci pola wyboru (checkbox)',
		radioTitle	: 'Wla'sciwo'sci przycisku opcji (radio)',
		value		: 'Warto's'c',
		selected	: 'Zaznaczone'
	},

	// Form Dialog.
	form :
	{
		title		: 'Wla'sciwo'sci formularza',
		menu		: 'Wla'sciwo'sci formularza',
		action		: 'Akcja',
		method		: 'Metoda',
		encoding	: 'Kodowanie'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Wla'sciwo'sci listy wyboru',
		selectInfo	: 'Informacje',
		opAvail		: 'Dostepne opcje',
		value		: 'Warto's'c',
		size		: 'Rozmiar',
		lines		: 'wierszy',
		chkMulti	: 'Wielokrotny wybór',
		opText		: 'Tekst',
		opValue		: 'Warto's'c',
		btnAdd		: 'Dodaj',
		btnModify	: 'Zmień',
		btnUp		: 'Do góry',
		btnDown		: 'Do dolu',
		btnSetValue : 'Ustaw jako zaznaczona',
		btnDelete	: 'Usuń'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Wla'sciwo'sci obszaru tekstowego',
		cols		: 'Liczba kolumn',
		rows		: 'Liczba wierszy'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Wla'sciwo'sci pola tekstowego',
		name		: 'Nazwa',
		value		: 'Warto's'c',
		charWidth	: 'Szeroko's'c w znakach',
		maxChars	: 'Szeroko's'c maksymalna',
		type		: 'Typ',
		typeText	: 'Tekst',
		typePass	: 'Haslo'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Wla'sciwo'sci pola ukrytego',
		name	: 'Nazwa',
		value	: 'Warto's'c'
	},

	// Image Dialog.
	image :
	{
		title		: 'Wla'sciwo'sci obrazka',
		titleButton	: 'Wla'sciwo'sci przycisku graficznego',
		menu		: 'Wla'sciwo'sci obrazka',
		infoTab		: 'Informacje o obrazku',
		btnUpload	: 'Wy'slij',
		upload		: 'Wy'slij',
		alt			: 'Tekst zastepczy',
		lockRatio	: 'Zablokuj proporcje',
		resetSize	: 'Przywró'c rozmiar',
		border		: 'Obramowanie',
		hSpace		: 'Odstep poziomy',
		vSpace		: 'Odstep pionowy',
		alertUrl	: 'Podaj adres obrazka.',
		linkTab		: 'Hiperlacze',
		button2Img	: 'Czy chcesz przekonwertowa'c zaznaczony przycisk graficzny do zwyklego obrazka?',
		img2Button	: 'Czy chcesz przekonwertowa'c zaznaczony obrazek do przycisku graficznego?',
		urlMissing	: 'Podaj adres URL obrazka.',
		validateBorder	: 'Warto's'c obramowania musi by'c liczba calkowita.',
		validateHSpace	: 'Warto's'c odstepu poziomego musi by'c liczba calkowita.',
		validateVSpace	: 'Warto's'c odstepu pionowego musi by'c liczba calkowita.'
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Wla'sciwo'sci obiektu Flash',
		propertiesTab	: 'Wla'sciwo'sci',
		title			: 'Wla'sciwo'sci obiektu Flash',
		chkPlay			: 'Autoodtwarzanie',
		chkLoop			: 'Petla',
		chkMenu			: 'Wlacz menu',
		chkFull			: 'Zezwól na pelny ekran',
 		scale			: 'Skaluj',
		scaleAll		: 'Pokaz wszystko',
		scaleNoBorder	: 'Bez obramowania',
		scaleFit		: 'Dokladne dopasowanie',
		access			: 'Dostep skryptów',
		accessAlways	: 'Zawsze',
		accessSameDomain: 'Ta sama domena',
		accessNever		: 'Nigdy',
		alignAbsBottom	: 'Do dolu',
		alignAbsMiddle	: 'Do 'srodka w pionie',
		alignBaseline	: 'Do linii bazowej',
		alignTextTop	: 'Do góry tekstu',
		quality			: 'Jako's'c',
		qualityBest		: 'Najlepsza',
		qualityHigh		: 'Wysoka',
		qualityAutoHigh	: 'Auto wysoka',
		qualityMedium	: ''Srednia',
		qualityAutoLow	: 'Auto niska',
		qualityLow		: 'Niska',
		windowModeWindow: 'Okno',
		windowModeOpaque: 'Nieprzezroczyste',
		windowModeTransparent : 'Przezroczyste',
		windowMode		: 'Tryb okna',
		flashvars		: 'Zmienne obiektu Flash',
		bgcolor			: 'Kolor tla',
		hSpace			: 'Odstep poziomy',
		vSpace			: 'Odstep pionowy',
		validateSrc		: 'Podaj adres URL',
		validateHSpace	: 'Odstep poziomy musi by'c liczba.',
		validateVSpace	: 'Odstep pionowy musi by'c liczba.'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Sprawd'z pisownie',
		title			: 'Sprawd'z pisownie',
		notAvailable	: 'Przepraszamy, ale usluga jest obecnie niedostepna.',
		errorLoading	: 'Blad wczytywania hosta aplikacji uslugi: %s.',
		notInDic		: 'Slowa nie ma w slowniku',
		changeTo		: 'Zmień na',
		btnIgnore		: 'Ignoruj',
		btnIgnoreAll	: 'Ignoruj wszystkie',
		btnReplace		: 'Zmień',
		btnReplaceAll	: 'Zmień wszystkie',
		btnUndo			: 'Cofnij',
		noSuggestions	: '- Brak sugestii -',
		progress		: 'Trwa sprawdzanie...',
		noMispell		: 'Sprawdzanie zakończone: nie znaleziono bledów',
		noChanges		: 'Sprawdzanie zakończone: nie zmieniono zadnego slowa',
		oneChange		: 'Sprawdzanie zakończone: zmieniono jedno slowo',
		manyChanges		: 'Sprawdzanie zakończone: zmieniono %l slów',
		ieSpellDownload	: 'Slownik nie jest zainstalowany. Czy chcesz go pobra'c?'
	},

	smiley :
	{
		toolbar	: 'Emotikony',
		title	: 'Wstaw emotikona',
		options : 'Opcje emotikonów'
	},

	elementsPath :
	{
		eleLabel : ''Sciezka elementów',
		eleTitle : 'element %1'
	},

	numberedlist	: 'Lista numerowana',
	bulletedlist	: 'Lista wypunktowana',
	indent			: 'Zwieksz wciecie',
	outdent			: 'Zmniejsz wciecie',

	justify :
	{
		left	: 'Wyrównaj do lewej',
		center	: 'Wy'srodkuj',
		right	: 'Wyrównaj do prawej',
		block	: 'Wyjustuj'
	},

	blockquote : 'Cytat',

	clipboard :
	{
		title		: 'Wklej',
		cutError	: 'Ustawienia bezpieczeństwa Twojej przegladarki nie pozwalaja na automatyczne wycinanie tekstu. Uzyj skrótu klawiszowego Ctrl/Cmd+X.',
		copyError	: 'Ustawienia bezpieczeństwa Twojej przegladarki nie pozwalaja na automatyczne kopiowanie tekstu. Uzyj skrótu klawiszowego Ctrl/Cmd+C.',
		pasteMsg	: 'Wklej tekst w ponizszym polu, uzywajac skrótu klawiaturowego (<STRONG>Ctrl/Cmd+V</STRONG>), i kliknij <STRONG>OK</STRONG>.',
		securityMsg	: 'Zabezpieczenia przegladarki uniemozliwiaja wklejenie danych bezpo'srednio do edytora. Prosze ponownie wklei'c dane w tym oknie.',
		pasteArea	: 'Obszar wklejania'
	},

	pastefromword :
	{
		confirmCleanup	: 'Tekst, który chcesz wklei'c, prawdopodobnie pochodzi z programu Microsoft Word. Czy chcesz go wyczy'sci'c przed wklejeniem?',
		toolbar			: 'Wklej z programu MS Word',
		title			: 'Wklej z programu MS Word',
		error			: 'Wyczyszczenie wklejonych danych nie bylo mozliwe z powodu wystapienia bledu.'
	},

	pasteText :
	{
		button	: 'Wklej jako czysty tekst',
		title	: 'Wklej jako czysty tekst'
	},

	templates :
	{
		button			: 'Szablony',
		title			: 'Szablony zawarto'sci',
		options : 'Opcje szablonów',
		insertOption	: 'Zastap obecna zawarto's'c',
		selectPromptMsg	: 'Wybierz szablon do otwarcia w edytorze<br>(obecna zawarto's'c okna edytora zostanie utracona):',
		emptyListMsg	: '(Brak zdefiniowanych szablonów)'
	},

	showBlocks : 'Pokaz bloki',

	stylesCombo :
	{
		label		: 'Styl',
		panelTitle	: 'Style formatujace',
		panelTitle1	: 'Style blokowe',
		panelTitle2	: 'Style liniowe',
		panelTitle3	: 'Style obiektowe'
	},

	format :
	{
		label		: 'Format',
		panelTitle	: 'Format',

		tag_p		: 'Normalny',
		tag_pre		: 'Tekst sformatowany',
		tag_address	: 'Adres',
		tag_h1		: 'Naglówek 1',
		tag_h2		: 'Naglówek 2',
		tag_h3		: 'Naglówek 3',
		tag_h4		: 'Naglówek 4',
		tag_h5		: 'Naglówek 5',
		tag_h6		: 'Naglówek 6',
		tag_div		: 'Normalny (DIV)'
	},

	div :
	{
		title				: 'Utwórz pojemnik Div',
		toolbar				: 'Utwórz pojemnik Div',
		cssClassInputLabel	: 'Klasy arkusza stylów',
		styleSelectLabel	: 'Styl',
		IdInputLabel		: 'Id',
		languageCodeInputLabel	: 'Kod jezyka',
		inlineStyleInputLabel	: 'Style liniowe',
		advisoryTitleInputLabel	: 'Opis obiektu docelowego',
		langDirLabel		: 'Kierunek tekstu',
		langDirLTRLabel		: 'Od lewej do prawej (LTR)',
		langDirRTLLabel		: 'Od prawej do lewej (RTL)',
		edit				: 'Edytuj pojemnik Div',
		remove				: 'Usuń pojemnik Div'
  	},

	iframe :
	{
		title		: 'Wla'sciwo'sci elementu IFrame',
		toolbar		: 'IFrame',
		noUrl		: 'Podaj adres URL elementu IFrame',
		scrolling	: 'Wlacz paski przewijania',
		border		: 'Pokaz obramowanie obiektu IFrame'
	},

	font :
	{
		label		: 'Czcionka',
		voiceLabel	: 'Czcionka',
		panelTitle	: 'Czcionka'
	},

	fontSize :
	{
		label		: 'Rozmiar',
		voiceLabel	: 'Rozmiar czcionki',
		panelTitle	: 'Rozmiar'
	},

	colorButton :
	{
		textColorTitle	: 'Kolor tekstu',
		bgColorTitle	: 'Kolor tla',
		panelTitle		: 'Kolory',
		auto			: 'Automatycznie',
		more			: 'Wiecej kolorów...'
	},

	colors :
	{
		'000' : 'Czarny',
		'800000' : 'Kasztanowy',
		'8B4513' : 'Czekoladowy',
		'2F4F4F' : 'Ciemnografitowy',
		'008080' : 'Morski',
		'000080' : 'Granatowy',
		'4B0082' : 'Indygo',
		'696969' : 'Ciemnoszary',
		'B22222' : 'Czerwień zelazowa',
		'A52A2A' : 'Brazowy',
		'DAA520' : 'Ciemnozloty',
		'006400' : 'Ciemnozielony',
		'40E0D0' : 'Turkusowy',
		'0000CD' : 'Ciemnoniebieski',
		'800080' : 'Purpurowy',
		'808080' : 'Szary',
		'F00' : 'Czerwony',
		'FF8C00' : 'Ciemnopomarańczowy',
		'FFD700' : 'Zloty',
		'008000' : 'Zielony',
		'0FF' : 'Cyjan',
		'00F' : 'Niebieski',
		'EE82EE' : 'Fioletowy',
		'A9A9A9' : 'Przygaszony szary',
		'FFA07A' : 'Lososiowy',
		'FFA500' : 'Pomarańczowy',
		'FFFF00' : 'Zólty',
		'00FF00' : 'Limonkowy',
		'AFEEEE' : 'Bladoturkusowy',
		'ADD8E6' : 'Jasnoniebieski',
		'DDA0DD' : ''Sliwkowy',
		'D3D3D3' : 'Jasnoszary',
		'FFF0F5' : 'Jasnolawendowy',
		'FAEBD7' : 'Kremowobialy',
		'FFFFE0' : 'Jasnozólty',
		'F0FFF0' : 'Bladozielony',
		'F0FFFF' : 'Jasnolazurowy',
		'F0F8FF' : 'Jasnoblekitny',
		'E6E6FA' : 'Lawendowy',
		'FFF' : 'Bialy'
	},

	scayt :
	{
		title			: 'Sprawd'z pisownie podczas pisania (SCAYT)',
		opera_title		: 'Funkcja nie jest obslugiwana przez przegladarke Opera',
		enable			: 'Wlacz SCAYT',
		disable			: 'Wylacz SCAYT',
		about			: 'Informacje o SCAYT',
		toggle			: 'Przelacz SCAYT',
		options			: 'Opcje',
		langs			: 'Jezyki',
		moreSuggestions	: 'Wiecej sugestii',
		ignore			: 'Ignoruj',
		ignoreAll		: 'Ignoruj wszystkie',
		addWord			: 'Dodaj slowo',
		emptyDic		: 'Nazwa slownika nie moze by'c pusta.',

		optionsTab		: 'Opcje',
		allCaps			: 'Ignoruj wyrazy pisane duzymi literami',
		ignoreDomainNames : 'Ignoruj nazwy domen',
		mixedCase		: 'Ignoruj wyrazy pisane duzymi i malymi literami',
		mixedWithDigits	: 'Ignoruj wyrazy zawierajace cyfry',

		languagesTab	: 'Jezyki',

		dictionariesTab	: 'Slowniki',
		dic_field_name	: 'Nazwa slownika',
		dic_create		: 'Utwórz',
		dic_restore		: 'Przywró'c',
		dic_delete		: 'Usuń',
		dic_rename		: 'Zmień nazwe',
		dic_info		: 'Poczatkowo slownik uzytkownika przechowywany jest w cookie. Pliki cookie maja jednak ograniczona pojemno's'c. Je'sli slownik uzytkownika przekroczy wielko's'c dopuszczalna dla pliku cookie, mozliwe jest przechowanie go na naszym serwerze. W celu zapisania slownika na serwerze niezbedne jest nadanie mu nazwy. Je'sli slownik zostal juz zapisany na serwerze, wystarczy poda'c jego nazwe i nacisna'c przycisk Przywró'c.',

		aboutTab		: 'Informacje o SCAYT'
	},

	about :
	{
		title		: 'Informacje o programie CKEditor',
		dlgTitle	: 'Informacje o programie CKEditor',
		help	: 'Pomoc znajdziesz w $1.',
		userGuide : 'podreczniku uzytkownika programu CKEditor',
		moreInfo	: 'Informacje na temat licencji mozna znale'z'c na naszej stronie:',
		copy		: 'Copyright &copy; $1. Wszelkie prawa zastrzezone.'
	},

	maximize : 'Maksymalizuj',
	minimize : 'Minimalizuj',

	fakeobjects :
	{
		anchor		: 'Kotwica',
		flash		: 'Animacja Flash',
		iframe		: 'IFrame',
		hiddenfield	: 'Pole ukryte',
		unknown		: 'Nieznany obiekt'
	},

	resize : 'Przeciagnij, aby zmieni'c rozmiar',

	colordialog :
	{
		title		: 'Wybierz kolor',
		options	:	'Opcje koloru',
		highlight	: 'Zaznacz',
		selected	: 'Wybrany',
		clear		: 'Wyczy's'c'
	},

	toolbarCollapse	: 'Zwiń pasek narzedzi',
	toolbarExpand	: 'Rozwiń pasek narzedzi',

	toolbarGroups :
	{
		document : 'Dokument',
		clipboard : 'Schowek/Wstecz',
		editing : 'Edycja',
		forms : 'Formularze',
		basicstyles : 'Style podstawowe',
		paragraph : 'Akapit',
		links : 'Hiperlacza',
		insert : 'Wstawianie',
		styles : 'Style',
		colors : 'Kolory',
		tools : 'Narzedzia'
	},

	bidi :
	{
		ltr : 'Kierunek tekstu od lewej strony do prawej',
		rtl : 'Kierunek tekstu od prawej strony do lewej'
	},

	docprops :
	{
		label : 'Wla'sciwo'sci dokumentu',
		title : 'Wla'sciwo'sci dokumentu',
		design : 'Projekt strony',
		meta : 'Znaczniki meta',
		chooseColor : 'Wybierz',
		other : 'Inne',
		docTitle :	'Tytul strony',
		charset : 	'Kodowanie znaków',
		charsetOther : 'Inne kodowanie znaków',
		charsetASCII : 'ASCII',
		charsetCE : ''Srodkowoeuropejskie',
		charsetCT : 'Chińskie tradycyjne (Big5)',
		charsetCR : 'Cyrylica',
		charsetGR : 'Greckie',
		charsetJP : 'Japońskie',
		charsetKR : 'Koreańskie',
		charsetTR : 'Tureckie',
		charsetUN : 'Unicode (UTF-8)',
		charsetWE : 'Zachodnioeuropejskie',
		docType : 'Definicja typu dokumentu',
		docTypeOther : 'Inna definicja typu dokumentu',
		xhtmlDec : 'Uwzglednij deklaracje XHTML',
		bgColor : 'Kolor tla',
		bgImage : 'Adres URL obrazka tla',
		bgFixed : 'Tlo nieruchome (nieprzewijajace sie)',
		txtColor : 'Kolor tekstu',
		margin : 'Marginesy strony',
		marginTop : 'Górny',
		marginLeft : 'Lewy',
		marginRight : 'Prawy',
		marginBottom : 'Dolny',
		metaKeywords : 'Slowa kluczowe dokumentu (oddzielone przecinkami)',
		metaDescription : 'Opis dokumentu',
		metaAuthor : 'Autor',
		metaCopyright : 'Prawa autorskie',
		previewHtml : '<p>To jest <strong>przykladowy tekst</strong>. Korzystasz z programu <a href="javascript:void(0)">CKEditor</a>.</p>'
	}
};
