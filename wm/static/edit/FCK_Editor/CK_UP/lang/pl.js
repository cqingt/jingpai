/*
 * CKFinder
 * ========
 * http://ckfinder.com
 * Copyright (C) 2007-2011, CKSource - Frederico Knabben. All rights reserved.
 *
 * The software, this file and its contents are subject to the CKFinder
 * License. Please read the license.txt file before using, installing, copying,
 * modifying or distribute this file or part of its contents. The contents of
 * this file is part of the Source Code of CKFinder.
 *
 */

/**
 * @fileOverview Defines the {@link CKFinder.lang} object, for the Polish
 *		language. This is the base file for all translations.
*/

/**
 * Constains the dictionary of language entries.
 * @namespace
 */
CKFinder.lang['pl'] =
{
	appTitle : 'CKFinder',

	// Common messages and labels.
	common :
	{
		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, wylaczone</span>',
		confirmCancel	: 'Pewne opcje zostaly zmienione. Czy na pewno zamkna'c okno dialogowe?',
		ok				: 'OK',
		cancel			: 'Anuluj',
		confirmationTitle	: 'Potwierdzenie',
		messageTitle	: 'Informacja',
		inputTitle		: 'Pytanie',
		undo			: 'Cofnij',
		redo			: 'Ponów',
		skip			: 'Pomiń',
		skipAll			: 'Pomiń wszystkie',
		makeDecision	: 'Wybierz jedna z opcji:',
		rememberDecision: 'Zapamietaj mój wybór'
	},


	dir : 'ltr',
	HelpLang : 'pl',
	LangCode : 'pl',

	// Date Format
	//		d    : Day
	//		dd   : Day (padding zero)
	//		m    : Month
	//		mm   : Month (padding zero)
	//		yy   : Year (two digits)
	//		yyyy : Year (four digits)
	//		h    : Hour (12 hour clock)
	//		hh   : Hour (12 hour clock, padding zero)
	//		H    : Hour (24 hour clock)
	//		HH   : Hour (24 hour clock, padding zero)
	//		M    : Minute
	//		MM   : Minute (padding zero)
	//		a    : Firt char of AM/PM
	//		aa   : AM/PM
	DateTime : 'yyyy-mm-dd HH:MM',
	DateAmPm : ['AM', 'PM'],

	// Folders
	FoldersTitle	: 'Katalogi',
	FolderLoading	: 'Ladowanie...',
	FolderNew		: 'Podaj nazwe nowego katalogu: ',
	FolderRename	: 'Podaj nowa nazwe katalogu: ',
	FolderDelete	: 'Czy na pewno chcesz usuna'c katalog "%1"?',
	FolderRenaming	: ' (Zmieniam nazwe...)',
	FolderDeleting	: ' (Kasowanie...)',

	// Files
	FileRename		: 'Podaj nowa nazwe pliku: ',
	FileRenameExt	: 'Czy na pewno chcesz zmieni'c rozszerzenie pliku? Moze to spowodowa'c problemy z otwieraniem pliku przez innych uzytkowników',
	FileRenaming	: 'Zmieniam nazwe...',
	FileDelete		: 'Czy na pewno chcesz usuna'c plik "%1"?',
	FilesLoading	: 'Ladowanie...',
	FilesEmpty		: 'Katalog jest pusty',
	FilesMoved		: 'Plik %1 zostal przeniesiony do %2:%3',
	FilesCopied		: 'Plik %1 zostal skopiowany do %2:%3',

	// Basket
	BasketFolder		: 'Koszyk',
	BasketClear			: 'Wyczy's'c koszyk',
	BasketRemove		: 'Usuń z koszyka',
	BasketOpenFolder	: 'Otwórz katalog z plikiem',
	BasketTruncateConfirm : 'Czy naprawde chcesz usuna'c wszystkie pliki z koszyka?',
	BasketRemoveConfirm	: 'Czy naprawde chcesz usuna'c plik "%1" z koszyka?',
	BasketEmpty			: 'Brak plików w koszyku, aby doda'c plik, przeciagnij i upu's'c (drag\'n\'drop) dowolny plik do koszyka.',
	BasketCopyFilesHere	: 'Skopiuj pliki z koszyka',
	BasketMoveFilesHere	: 'Przenie's pliki z koszyka',

	BasketPasteErrorOther	: 'Plik: %s blad: %e',
	BasketPasteMoveSuccess	: 'Nastepujace pliki zostaly przeniesione: %s',
	BasketPasteCopySuccess	: 'Nastepujace pliki zostaly skopiowane: %s',

	// Toolbar Buttons (some used elsewhere)
	Upload		: 'Wy'slij',
	UploadTip	: 'Wy'slij plik',
	Refresh		: 'Od'swiez',
	Settings	: 'Ustawienia',
	Help		: 'Pomoc',
	HelpTip		: 'Wskazówka',

	// Context Menus
	Select			: 'Wybierz',
	SelectThumbnail : 'Wybierz miniaturke',
	View			: 'Zobacz',
	Download		: 'Pobierz',

	NewSubFolder	: 'Nowy podkatalog',
	Rename			: 'Zmień nazwe',
	Delete			: 'Usuń',

	CopyDragDrop	: 'Skopiuj tutaj plik',
	MoveDragDrop	: 'Przenie's tutaj plik',

	// Dialogs
	RenameDlgTitle		: 'Zmiana nazwy',
	NewNameDlgTitle		: 'Nowa nazwa',
	FileExistsDlgTitle	: 'Plik juz istnieje',
	SysErrorDlgTitle : 'System error', // MISSING

	FileOverwrite	: 'Nadpisz',
	FileAutorename	: 'Zmień automatycznie nazwe',

	// Generic
	OkBtn		: 'OK',
	CancelBtn	: 'Anuluj',
	CloseBtn	: 'Zamknij',

	// Upload Panel
	UploadTitle			: 'Wy'slij plik',
	UploadSelectLbl		: 'Wybierz plik',
	UploadProgressLbl	: '(Trwa wysylanie pliku, prosze czeka'c...)',
	UploadBtn			: 'Wy'slij wybrany plik',
	UploadBtnCancel		: 'Anuluj',

	UploadNoFileMsg		: 'Wybierz plik ze swojego komputera',
	UploadNoFolder		: 'Wybierz katalog przed wyslaniem pliku.',
	UploadNoPerms		: 'Wysylanie plików nie jest dozwolone.',
	UploadUnknError		: 'Blad podczas wysylania pliku.',
	UploadExtIncorrect	: 'Rozszerzenie pliku nie jest dozwolone w tym katalogu.',

	// Settings Panel
	SetTitle		: 'Ustawienia',
	SetView			: 'Widok:',
	SetViewThumb	: 'Miniaturki',
	SetViewList		: 'Lista',
	SetDisplay		: 'Wy'swietlanie:',
	SetDisplayName	: 'Nazwa pliku',
	SetDisplayDate	: 'Data',
	SetDisplaySize	: 'Rozmiar pliku',
	SetSort			: 'Sortowanie:',
	SetSortName		: 'wg nazwy pliku',
	SetSortDate		: 'wg daty',
	SetSortSize		: 'wg rozmiaru',

	// Status Bar
	FilesCountEmpty : '<Pusty katalog>',
	FilesCountOne	: '1 plik',
	FilesCountMany	: 'Ilo's'c plików: %1',

	// Size and Speed
	Kb				: '%1 kB',
	KbPerSecond		: '%1 kB/s',

	// Connector Error Messages.
	ErrorUnknown	: 'Wykonanie operacji zakończylo sie niepowodzeniem. (Blad %1)',
	Errors :
	{
	 10 : 'Nieprawidlowe polecenie (command).',
	 11 : 'Brak wymaganego parametru: 'zródlo danych (type).',
	 12 : 'Nieprawidlowe 'zródlo danych (type).',
	102 : 'Nieprawidlowa nazwa pliku lub katalogu.',
	103 : 'Wykonanie operacji nie jest mozliwe: brak autoryzacji.',
	104 : 'Wykonanie operacji nie powiodlo sie z powodu niewystarczajacych uprawnień do systemu plików.',
	105 : 'Nieprawidlowe rozszerzenie.',
	109 : 'Nieprawilowe polecenie.',
	110 : 'Niezidentyfikowany blad.',
	115 : 'Plik lub katalog o podanej nazwie juz istnieje.',
	116 : 'Nie znaleziono katalogu. Od'swiez panel i spróbuj ponownie.',
	117 : 'Nie znaleziono pliku. Od'swiez liste plików i spróbuj ponownie.',
	118 : ''Sciezki 'zródlowa i docelowa sa jednakowe.',
	201 : 'Plik o podanej nazwie juz istnieje. Nazwa przeslanego pliku zostala zmieniona na "%1"',
	202 : 'Nieprawidlowy plik.',
	203 : 'Nieprawidlowy plik. Plik przekroczyl dozwolony rozmiar.',
	204 : 'Przeslany plik jest uszkodzony.',
	205 : 'Brak folderu tymczasowego na serwerze do przesylania plików.',
	206 : 'Przesylanie pliku zakończylo sie niepowodzeniem z powodów bezpieczeństwa. Plik zawiera dane przypominajace HTML.',
	207 : 'Nazwa przeslanego pliku zostala zmieniona na "%1"',
	300 : 'Przenoszenie nie powiodlo sie.',
	301 : 'Kopiowanie nie powiodo sie.',
	500 : 'Menedzer plików jest wylaczony z powodów bezpieczeństwa. Skontaktuj sie z administratorem oraz sprawd'z plik konfiguracyjny CKFindera.',
	501 : 'Tworzenie miniaturek jest wylaczone.'
	},

	// Other Error Messages.
	ErrorMsg :
	{
		FileEmpty		: 'Nazwa pliku nie moze by'c pusta',
		FileExists		: 'Plik %s juz istnieje',
		FolderEmpty		: 'Nazwa katalogu nie moze by'c pusta',

		FileInvChar		: 'Nazwa pliku nie moze zawiera'c zadnego z podanych znaków: \n\\ / : * ? " < > |',
		FolderInvChar	: 'Nazwa katalogu nie moze zawiera'c zadnego z podanych znaków: \n\\ / : * ? " < > |',

		PopupBlockView	: 'Otwarcie pliku w nowym oknie nie powiodlo sie. Prosze zmieni'c konfiguracje przegladarki i wylaczy'c wszelkie blokady okienek popup dla tej strony.'
	},

	// Imageresize plugin
	Imageresize :
	{
		dialogTitle		: 'Zmiana rozmiaru %s',
		sizeTooBig		: 'Nie mozesz zmieni'c wysoko'sci lub szeroko'sci na warto'sc wyzsza niz oryginalny rozmiar (%size).',
		resizeSuccess	: 'Obrazek zostal pomy'slnie przeskalowany.',
		thumbnailNew	: 'Utwórz nowa miniaturke',
		thumbnailSmall	: 'Maly (%s)',
		thumbnailMedium	: ''Sredni (%s)',
		thumbnailLarge	: 'Duzy (%s)',
		newSize			: 'Podaj nowe wymiary',
		width			: 'Szeroko's'c',
		height			: 'Wysoko's'c',
		invalidHeight	: 'Nieprawidlowa wysoko's'c.',
		invalidWidth	: 'Nieprawidlowa szeroko's'c.',
		invalidName		: 'Nieprawidlowa nazwa pliku.',
		newImage		: 'Utwórz nowy obrazek',
		noExtensionChange : 'Rozszerzenie pliku nie moze zostac zmienione.',
		imageSmall		: 'Plik 'zródlowy jest zbyt maly',
		contextMenuName	: 'Zmień rozmiar'
	},

	// Fileeditor plugin
	Fileeditor :
	{
		save			: 'Zapisz',
		fileOpenError	: 'Nie udalo sie otworzy'c pliku.',
		fileSaveSuccess	: 'Plik zostal zapisany pomy'slnie.',
		contextMenuName	: 'Edytuj',
		loadingFile		: 'Trwa ladowanie pliku, prosze czeka'c...'
	}
};
