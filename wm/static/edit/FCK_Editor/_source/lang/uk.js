/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Ukrainian language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Contains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['uk'] =
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
	editorTitle : 'Текстовий редактор, %1',
	editorHelp : 'натиснть ALT 0 для довдки',

	// ARIA descriptions.
	toolbars	: 'Панель нструментв редактора',
	editor		: 'Текстовий редактор',

	// Toolbar buttons without dialogs.
	source			: 'Джерело',
	newPage			: 'Нова сторнка',
	save			: 'Зберегти',
	preview			: 'Попереднй перегляд',
	cut				: 'Вирзати',
	copy			: 'Копювати',
	paste			: 'Вставити',
	print			: 'Друк',
	underline		: 'Пдкреслений',
	bold			: 'Жирний',
	italic			: 'Курсив',
	selectAll		: 'Видлити все',
	removeFormat	: 'Очистити форматування',
	strike			: 'Закреслений',
	subscript		: 'Нижнй ндекс',
	superscript		: 'Верхнй ндекс',
	horizontalrule	: 'Горизонтальна лня',
	pagebreak		: 'Вставити розрив сторнки',
	pagebreakAlt		: 'Розрив Сторнки',
	unlink			: 'Видалити посилання',
	undo			: 'Повернути',
	redo			: 'Повторити',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Огляд',
		url				: 'URL',
		protocol		: 'Протокол',
		upload			: 'Надслати',
		uploadSubmit	: 'Надслати на сервер',
		image			: 'Зображення',
		flash			: 'Flash',
		form			: 'Форма',
		checkbox		: 'Галочка',
		radio			: 'Кнопка вибору',
		textField		: 'Текстове поле',
		textarea		: 'Текстова область',
		hiddenField		: 'Приховане поле',
		button			: 'Кнопка',
		select			: 'Список',
		imageButton		: 'Кнопка з зображенням',
		notSet			: '<не визначено>',
		id				: 'дентифкатор',
		name			: 'м\'я',
		langDir			: 'Напрямок мови',
		langDirLtr		: 'Злва направо (LTR)',
		langDirRtl		: 'Справа налво (RTL)',
		langCode		: 'Код мови',
		longDescr		: 'Довгий опис URL',
		cssClass		: 'Клас CSS',
		advisoryTitle	: 'Заголовок',
		cssStyle		: 'Стиль CSS',
		ok				: 'ОК',
		cancel			: 'Скасувати',
		close			: 'Закрити',
		preview			: 'Попереднй перегляд',
		generalTab		: 'Основне',
		advancedTab		: 'Додаткове',
		validateNumberFailed : 'Значення не  цлим числом.',
		confirmNewPage	: 'Вс незбережен змни будуть втрачен. Ви впевнен, що хочете завантажити нову сторнку?',
		confirmCancel	: 'Деяк опц змнено. Закрити вкно без збереження змн?',
		options			: 'Опц',
		target			: 'Цль',
		targetNew		: 'Нове вкно (_blank)',
		targetTop		: 'Поточне вкно (_top)',
		targetSelf		: 'Поточний фрейм/вкно (_self)',
		targetParent	: 'Батьквський фрейм/вкно (_parent)',
		langDirLTR		: 'Злва направо (LTR)',
		langDirRTL		: 'Справа налво (RTL)',
		styles			: 'Стиль CSS',
		cssClasses		: 'Клас CSS',
		width			: 'Ширина',
		height			: 'Висота',
		align			: 'Вирвнювання',
		alignLeft		: 'По лвому краю',
		alignRight		: 'По правому краю',
		alignCenter		: 'По центру',
		alignTop		: 'По верхньому краю',
		alignMiddle		: 'По середин',
		alignBottom		: 'По нижньому краю',
		invalidValue	: 'Invalid value.', // MISSING
		invalidHeight	: 'Висота повинна бути цлим числом.',
		invalidWidth	: 'Ширина повинна бути цлим числом.',
		invalidCssLength	: 'Значення, вказане для "%1" в пол повинно бути позитивним числом або без дйсного вимру CSS блоку (px, %, in, cm, mm, em, ex, pt, or pc).',
		invalidHtmlLength	: 'Значення, вказане для "%1" в пол повинно бути позитивним числом або без дйсного вимру HTML блоку (px or %).',
		invalidInlineStyle	: 'Значення, вказане для вбудованого стилю повинне складатися з одного чи клькох кортежв у формат "м\'я : значення", роздлених крапкою з комою.',
		cssLengthTooltip	: 'Введть номер значення в пкселях або число з дйсною одиниц CSS (px, %, in, cm, mm, em, ex, pt, or pc).',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, не доступне</span>'
	},

	contextmenu :
	{
		options : 'Опц контекстного меню'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Спецальний символ',
		title		: 'Оберть спецальний символ',
		options : 'Опц'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Вставити/Редагувати посилання',
		other 		: '<нший>',
		menu		: 'Вставити посилання',
		title		: 'Посилання',
		info		: 'нформаця посилання',
		target		: 'Цль',
		upload		: 'Надслати',
		advanced	: 'Додаткове',
		type		: 'Тип посилання',
		toUrl		: 'URL',
		toAnchor	: 'Якр на цю сторнку',
		toEmail		: 'Ел. пошта',
		targetFrame		: '<фрейм>',
		targetPopup		: '<випливаюче вкно>',
		targetFrameName	: 'м\'я цльового фрейму',
		targetPopupName	: 'м\'я випливаючого вкна',
		popupFeatures	: 'Властивост випливаючого вкна',
		popupResizable	: 'Масштабоване',
		popupStatusBar	: 'Рядок статусу',
		popupLocationBar: 'Панель локац',
		popupToolbar	: 'Панель нструментв',
		popupMenuBar	: 'Панель меню',
		popupFullScreen	: 'Повний екран (IE)',
		popupScrollBars	: 'Стрчки прокрутки',
		popupDependent	: 'Залежний (Netscape)',
		popupLeft		: 'Позиця злва',
		popupTop		: 'Позиця зверху',
		id				: 'дентифкатор',
		langDir			: 'Напрямок мови',
		langDirLTR		: 'Злва направо (LTR)',
		langDirRTL		: 'Справа налво (RTL)',
		acccessKey		: 'Гаряча клавша',
		name			: 'м\'я',
		langCode			: 'Код мови',
		tabIndex			: 'Послдовнсть переходу',
		advisoryTitle		: 'Заголовок',
		advisoryContentType	: 'Тип вмсту',
		cssClasses		: 'Клас CSS',
		charset			: 'Кодування',
		styles			: 'Стиль CSS',
		rel			: 'Зв\'язок',
		selectAnchor		: 'Оберть якр',
		anchorName		: 'За м\'ям елементу',
		anchorId			: 'За дентифкатором елементу',
		emailAddress		: 'Адреса ел. пошти',
		emailSubject		: 'Тема листа',
		emailBody		: 'Тло повдомлення',
		noAnchors		: '(В цьому документ нема якорв)',
		noUrl			: 'Будь ласка, вкажть URL посилання',
		noEmail			: 'Будь ласка, вкажть адрес ел. пошти'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Вставити/Редагувати якр',
		menu		: 'Властивост якоря',
		title		: 'Властивост якоря',
		name		: 'м\'я якоря',
		errorName	: 'Будь ласка, вкажть м\'я якоря',
		remove		: 'Прибрати якр'
	},

	// List style dialog
	list:
	{
		numberedTitle		: 'Опц нумерованого списку',
		bulletedTitle		: 'Опц маркованого списку',
		type				: 'Тип',
		start				: 'Почати з...',
		validateStartNumber				:'Початковий номер списку повинен бути цлим числом.',
		circle				: 'Кльце',
		disc				: 'Кружечок',
		square				: 'Квадратик',
		none				: 'Нема',
		notset				: '<не вказано>',
		armenian			: 'Врменська нумераця',
		georgian			: 'Грузинська нумераця (an, ban, gan  т.д.)',
		lowerRoman			: 'Мал римськ (i, ii, iii, iv, v  т.д.)',
		upperRoman			: 'Велик римськ (I, II, III, IV, V  т.д.)',
		lowerAlpha			: 'Мал лат. букви (a, b, c, d, e  т.д.)',
		upperAlpha			: 'Велик лат. букви (A, B, C, D, E  т.д.)',
		lowerGreek			: 'Мал гр. букви (альфа, бета, гамма  т.д.)',
		decimal				: 'Десятков (1, 2, 3  т.д.)',
		decimalLeadingZero	: 'Десятков з нулем (01, 02, 03  т.д.)'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Знайти  замнити',
		find				: 'Пошук',
		replace				: 'Замна',
		findWhat			: 'Шукати:',
		replaceWith			: 'Замнити на:',
		notFoundMsg			: 'Вказаний текст не знайдено.',
		findOptions			: 'Параметри Пошуку',
		matchCase			: 'Враховувати регстр',
		matchWord			: 'Збг цлих слв',
		matchCyclic			: 'Циклчна замна',
		replaceAll			: 'Замнити все',
		replaceSuccessMsg	: '%1 спвпаднь(ня) замнено.'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Таблиця',
		title		: 'Властивост таблиц',
		menu		: 'Властивост таблиц',
		deleteTable	: 'Видалити таблицю',
		rows		: 'Рядки',
		columns		: 'Стовбц',
		border		: 'Розмр рамки',
		widthPx		: 'пкселв',
		widthPc		: 'вдсоткв',
		widthUnit	: 'Одиниц вимр.',
		cellSpace	: 'Промжок',
		cellPad		: 'Внутр. вдступ',
		caption		: 'Заголовок таблиц',
		summary		: 'Детальний опис заголовку таблиц',
		headers		: 'Заголовки стовбцв/рядкв',
		headersNone		: 'Без заголовкв',
		headersColumn	: 'Стовбц',
		headersRow		: 'Рядки',
		headersBoth		: 'Стовбц  рядки',
		invalidRows		: 'Кльксть рядкв повинна бути бльшою 0.',
		invalidCols		: 'Кльксть стовбцв повинна бути бльшою 0.',
		invalidBorder	: 'Розмр рамки повинен бути цлим числом.',
		invalidWidth	: 'Ширина таблиц повинна бути цлим числом.',
		invalidHeight	: 'Висота таблиц повинна бути цлим числом.',
		invalidCellSpacing	: 'Промжок мж комрками повинен бути цлим числом.',
		invalidCellPadding	: 'Внутр. вдступ комрки повинен бути цлим числом.',

		cell :
		{
			menu			: 'Комрки',
			insertBefore	: 'Вставити комрку перед',
			insertAfter		: 'Вставити комрку псля',
			deleteCell		: 'Видалити комрки',
			merge			: 'Об\'днати комрки',
			mergeRight		: 'Об\'днати справа',
			mergeDown		: 'Об\'днати донизу',
			splitHorizontal	: 'Роздлити комрку по горизонтал',
			splitVertical	: 'Роздлити комрку по вертикал',
			title			: 'Властивост комрки',
			cellType		: 'Тип комрки',
			rowSpan			: 'Об\'днання рядкв',
			colSpan			: 'Об\'днання стовпцв',
			wordWrap		: 'Автоперенесення тексту',
			hAlign			: 'Гориз. вирвнювання',
			vAlign			: 'Верт. вирвнювання',
			alignBaseline	: 'По базовй лн',
			bgColor			: 'Колр фону',
			borderColor		: 'Колр рамки',
			data			: 'Дан',
			header			: 'Заголовок',
			yes				: 'Так',
			no				: 'Н',
			invalidWidth	: 'Ширина комрки повинна бути цлим числом.',
			invalidHeight	: 'Висота комрки повинна бути цлим числом.',
			invalidRowSpan	: 'Кльксть об\'днуваних рядкв повинна бути цлим числом.',
			invalidColSpan	: 'Кльксть об\'днуваних стовбцв повинна бути цлим числом.',
			chooseColor		: 'Обрати'
		},

		row :
		{
			menu			: 'Рядки',
			insertBefore	: 'Вставити рядок перед',
			insertAfter		: 'Вставити рядок псля',
			deleteRow		: 'Видалити рядки'
		},

		column :
		{
			menu			: 'Стовбц',
			insertBefore	: 'Вставити стовбець перед',
			insertAfter		: 'Вставити стовбець псля',
			deleteColumn	: 'Видалити стовбц'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Властивост кнопки',
		text		: 'Значення',
		type		: 'Тип',
		typeBtn		: 'Кнопка (button)',
		typeSbm		: 'Надслати (submit)',
		typeRst		: 'Очистити (reset)'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Властивост галочки',
		radioTitle	: 'Властивост кнопки вибору',
		value		: 'Значення',
		selected	: 'Обрана'
	},

	// Form Dialog.
	form :
	{
		title		: 'Властивост форми',
		menu		: 'Властивост форми',
		action		: 'Дя',
		method		: 'Метод',
		encoding	: 'Кодування'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Властивост списку',
		selectInfo	: 'нфо',
		opAvail		: 'Доступн варанти',
		value		: 'Значення',
		size		: 'Кльксть',
		lines		: 'видимих позицй у списку',
		chkMulti	: 'Список з мультивибором',
		opText		: 'Текст',
		opValue		: 'Значення',
		btnAdd		: 'Добавити',
		btnModify	: 'Змнити',
		btnUp		: 'Вгору',
		btnDown		: 'Вниз',
		btnSetValue : 'Встановити як обране значення',
		btnDelete	: 'Видалити'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Властивост текстово област',
		cols		: 'Стовбц',
		rows		: 'Рядки'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Властивост текстового поля',
		name		: 'м\'я',
		value		: 'Значення',
		charWidth	: 'Ширина',
		maxChars	: 'Макс. к-ть символв',
		type		: 'Тип',
		typeText	: 'Текст',
		typePass	: 'Пароль'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Властивост прихованого поля',
		name	: 'м\'я',
		value	: 'Значення'
	},

	// Image Dialog.
	image :
	{
		title		: 'Властивост зображення',
		titleButton	: 'Властивост кнопки з зображенням',
		menu		: 'Властивост зображення',
		infoTab		: 'нформаця про зображення',
		btnUpload	: 'Надслати на сервер',
		upload		: 'Надслати',
		alt			: 'Альтернативний текст',
		lockRatio	: 'Зберегти пропорц',
		resetSize	: 'Очистити поля розмрв',
		border		: 'Рамка',
		hSpace		: 'Гориз. вдступ',
		vSpace		: 'Верт. вдступ',
		alertUrl	: 'Будь ласка, вкажть URL зображення',
		linkTab		: 'Посилання',
		button2Img	: 'Бажате перетворити обрану кнопку-зображення на просте зображення?',
		img2Button	: 'Бажате перетворити обране зображення на кнопку-зображення?',
		urlMissing	: 'Вкажть URL зображення.',
		validateBorder	: 'Ширина рамки повинна бути цлим числом.',
		validateHSpace	: 'Гориз. вдступ повинен бути цлим числом.',
		validateVSpace	: 'Верт. вдступ повинен бути цлим числом.'
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Властивост Flash',
		propertiesTab	: 'Властивост',
		title			: 'Властивост Flash',
		chkPlay			: 'Автопрогравання',
		chkLoop			: 'Циклчно',
		chkMenu			: 'Дозволити меню Flash',
		chkFull			: 'Дозволити повноекранний перегляд',
 		scale			: 'Масштаб',
		scaleAll		: 'Показати все',
		scaleNoBorder	: 'Без рамки',
		scaleFit		: 'Поч. розмр',
		access			: 'Доступ до скрипта',
		accessAlways	: 'Завжди',
		accessSameDomain: 'З того ж домена',
		accessNever		: 'Нколи',
		alignAbsBottom	: 'По нижньому краю (abs)',
		alignAbsMiddle	: 'По середин (abs)',
		alignBaseline	: 'По базовй лн',
		alignTextTop	: 'Текст по верхньому краю',
		quality			: 'Яксть',
		qualityBest		: 'Вдмнна',
		qualityHigh		: 'Висока',
		qualityAutoHigh	: 'Автом. вдмнна',
		qualityMedium	: 'Середня',
		qualityAutoLow	: 'Автом. низька',
		qualityLow		: 'Низька',
		windowModeWindow: 'Вкно',
		windowModeOpaque: 'Непрозорсть',
		windowModeTransparent : 'Прозорсть',
		windowMode		: 'Вконний режим',
		flashvars		: 'Змнн Flash',
		bgcolor			: 'Колр фону',
		hSpace			: 'Гориз. вдступ',
		vSpace			: 'Верт. вдступ',
		validateSrc		: 'Будь ласка, вкажть URL посилання',
		validateHSpace	: 'Гориз. вдступ повинен бути цлим числом.',
		validateVSpace	: 'Верт. вдступ повинен бути цлим числом.'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Переврити орфографю',
		title			: 'Переврка орфограф',
		notAvailable	: 'Вибачте, але сервс нараз недоступний.',
		errorLoading	: 'Помилка завантаження : %s.',
		notInDic		: 'Нема в словнику',
		changeTo		: 'Замнити на',
		btnIgnore		: 'Пропустити',
		btnIgnoreAll	: 'Пропустити все',
		btnReplace		: 'Замнити',
		btnReplaceAll	: 'Замнити все',
		btnUndo			: 'Назад',
		noSuggestions	: '- нема варантв -',
		progress		: 'Виконуться переврка орфограф...',
		noMispell		: 'Переврку орфограф завершено: помилок не знайдено',
		noChanges		: 'Переврку орфограф завершено: жодне слово не змнено',
		oneChange		: 'Переврку орфограф завершено: змнено одне слово',
		manyChanges		: 'Переврку орфограф завершено: 1% слв(ова) змнено',
		ieSpellDownload	: 'Модуль переврки орфограф не встановлено. Бажате завантажити його зараз?'
	},

	smiley :
	{
		toolbar	: 'Смайлик',
		title	: 'Вставити смайлик',
		options : 'Опц смайликв'
	},

	elementsPath :
	{
		eleLabel : 'Шлях',
		eleTitle : '%1 елемент'
	},

	numberedlist	: 'Нумерований список',
	bulletedlist	: 'Маркрований список',
	indent			: 'Збльшити вдступ',
	outdent			: 'Зменшити вдступ',

	justify :
	{
		left	: 'По лвому краю',
		center	: 'По центру',
		right	: 'По правому краю',
		block	: 'По ширин'
	},

	blockquote : 'Цитата',

	clipboard :
	{
		title		: 'Вставити',
		cutError	: 'Налаштування безпеки Вашого браузера не дозволяють редактору автоматично виконувати операц вирзування. Будь ласка, використовуйте клаватуру для цього (Ctrl/Cmd+X)',
		copyError	: 'Налаштування безпеки Вашого браузера не дозволяють редактору автоматично виконувати операц копювання. Будь ласка, використовуйте клаватуру для цього (Ctrl/Cmd+C).',
		pasteMsg	: 'Будь ласка, вставте нформацю з буфера обмну в цю область, користуючись комбнацю клавш (<STRONG>Ctrl/Cmd+V</STRONG>), та натиснть <STRONG>OK</STRONG>.',
		securityMsg	: 'Редактор не може отримати прямий доступ до буферу обмну у зв\'язку з налаштуваннями Вашого браузера. Вам потрбно вставити нформацю в це вкно.',
		pasteArea	: 'Область вставки'
	},

	pastefromword :
	{
		confirmCleanup	: 'Текст, що Ви намагатесь вставити, схожий на скопйований з Word. Бажате очистити його форматування перед вставлянням?',
		toolbar			: 'Вставити з Word',
		title			: 'Вставити з Word',
		error			: 'Неможливо очистити форматування через внутршню помилку.'
	},

	pasteText :
	{
		button	: 'Вставити тльки текст',
		title	: 'Вставити тльки текст'
	},

	templates :
	{
		button			: 'Шаблони',
		title			: 'Шаблони змсту',
		options : 'Опц шаблону',
		insertOption	: 'Замнити поточний вмст',
		selectPromptMsg	: 'Оберть, будь ласка, шаблон для вдкриття в редактор<br>(поточний змст буде втрачено):',
		emptyListMsg	: '(Не знайдено жодного шаблону)'
	},

	showBlocks : 'Показувати блоки',

	stylesCombo :
	{
		label		: 'Стиль',
		panelTitle	: 'Стил форматування',
		panelTitle1	: 'Блочн стил',
		panelTitle2	: 'Рядков стил',
		panelTitle3	: 'Об\'ктн стил'
	},

	format :
	{
		label		: 'Форматування',
		panelTitle	: 'Форматування параграфа',

		tag_p		: 'Нормальний',
		tag_pre		: 'Форматований',
		tag_address	: 'Адреса',
		tag_h1		: 'Заголовок 1',
		tag_h2		: 'Заголовок 2',
		tag_h3		: 'Заголовок 3',
		tag_h4		: 'Заголовок 4',
		tag_h5		: 'Заголовок 5',
		tag_h6		: 'Заголовок 6',
		tag_div		: 'Нормальний (div)'
	},

	div :
	{
		title				: 'Створити блок-контейнер',
		toolbar				: 'Створити блок-контейнер',
		cssClassInputLabel	: 'Клас CSS',
		styleSelectLabel	: 'Стиль CSS',
		IdInputLabel		: 'дентифкатор',
		languageCodeInputLabel	: 'Код мови',
		inlineStyleInputLabel	: 'Вписаний стиль',
		advisoryTitleInputLabel	: 'Змст випливаючо пдказки',
		langDirLabel		: 'Напрямок мови',
		langDirLTRLabel		: 'Злва направо (LTR)',
		langDirRTLLabel		: 'Справа налво (RTL)',
		edit				: 'Редагувати блок',
		remove				: 'Видалити блок'
  	},

	iframe :
	{
		title		: 'Налаштування для IFrame',
		toolbar		: 'IFrame',
		noUrl		: 'Будь ласка введть посилання для IFrame',
		scrolling	: 'Увмкнути прокрутку',
		border		: 'Показати рамки фрейму'
	},

	font :
	{
		label		: 'Шрифт',
		voiceLabel	: 'Шрифт',
		panelTitle	: 'Шрифт'
	},

	fontSize :
	{
		label		: 'Розмр',
		voiceLabel	: 'Розмр шрифту',
		panelTitle	: 'Розмр'
	},

	colorButton :
	{
		textColorTitle	: 'Колр тексту',
		bgColorTitle	: 'Колр фону',
		panelTitle		: 'Кольори',
		auto			: 'Авто',
		more			: 'Кольори...'
	},

	colors :
	{
		'000' : 'Чорний',
		'800000' : 'Бордовий',
		'8B4513' : 'Коричневий',
		'2F4F4F' : 'Темний сро-зелений',
		'008080' : 'Морсько хвил',
		'000080' : 'Сливовий',
		'4B0082' : 'ндиго',
		'696969' : 'Темносрий',
		'B22222' : 'Темночервоний',
		'A52A2A' : 'Каштановий',
		'DAA520' : 'Бежевий',
		'006400' : 'Темнозелений',
		'40E0D0' : 'Брюзовий',
		'0000CD' : 'Темносинй',
		'800080' : 'Пурпурний',
		'808080' : 'Срий',
		'F00' : 'Червоний',
		'FF8C00' : 'Темнооранжевий',
		'FFD700' : 'Жовтий',
		'008000' : 'Зелений',
		'0FF' : 'Синьо-зелений',
		'00F' : 'Синй',
		'EE82EE' : 'Фолетовий',
		'A9A9A9' : 'Свтлосрий',
		'FFA07A' : 'Рожевий',
		'FFA500' : 'Оранжевий',
		'FFFF00' : 'Яскравожовтий',
		'00FF00' : 'Салатовий',
		'AFEEEE' : 'Свтлобрюзовий',
		'ADD8E6' : 'Блакитний',
		'DDA0DD' : 'Свтлофолетовий',
		'D3D3D3' : 'Срблястий',
		'FFF0F5' : 'Свтлорожевий',
		'FAEBD7' : 'Свтлооранжевий',
		'FFFFE0' : 'Свтложовтий',
		'F0FFF0' : 'Свтлозелений',
		'F0FFFF' : 'Свтлий синьо-зелений',
		'F0F8FF' : 'Свтлоблакитний',
		'E6E6FA' : 'Лавандовий',
		'FFF' : 'Блий'
	},

	scayt :
	{
		title			: 'Перефрка орфограф по мр набору',
		opera_title		: 'Не пдтримуться в Opera',
		enable			: 'Ввмкнути SCAYT',
		disable			: 'Вимкнути SCAYT',
		about			: 'Про SCAYT',
		toggle			: 'Перемкнути SCAYT',
		options			: 'Опц',
		langs			: 'Мови',
		moreSuggestions	: 'Бльше варантв',
		ignore			: 'Пропустити',
		ignoreAll		: 'Пропустити вс',
		addWord			: 'Додати слово',
		emptyDic		: 'Назва словника повинна бути вказана.',

		optionsTab		: 'Опц',
		allCaps			: 'Пропустити прописн слова',
		ignoreDomainNames : 'Пропустити доменн назви',
		mixedCase		: 'Пропустити слова з змшаним регстром',
		mixedWithDigits	: 'Пропустити слова, що мстять цифри',

		languagesTab	: 'Мови',

		dictionariesTab	: 'Словники',
		dic_field_name	: 'Назва словника',
		dic_create		: 'Створити',
		dic_restore		: 'Вдновити',
		dic_delete		: 'Видалити',
		dic_rename		: 'Перейменувати',
		dic_info		: 'Як правило, користувацьк словники збергаються у cookie-файлах. Однак, cookie-файли мають обмеження на розмр. Якщо користувацький словник зроста в обсяз настльки, що вже не може бути збережений у cookie-файл, тод його можна зберегти на нашому сервер. Щоб зберегти Ваш персональний словник на нашому сервер необхдно вказати назву словника. Якщо Ви вже збергали словник на сервер, будь ласка, вкажть назву збереженого словника  натиснть кнопку Вдновити.',

		aboutTab		: 'Про SCAYT'
	},

	about :
	{
		title		: 'Про CKEditor',
		dlgTitle	: 'Про CKEditor',
		help	: 'Переврте $1 для допомоги.',
		userGuide : 'нструкця Користувача для CKEditor',
		moreInfo	: 'Щодо нформац з лцензування завтайте на наш сайт:',
		copy		: 'Copyright &copy; $1. Вс права застережено.'
	},

	maximize : 'Максимзувати',
	minimize : 'Мнмзувати',

	fakeobjects :
	{
		anchor		: 'Якр',
		flash		: 'Flash-анмаця',
		iframe		: 'IFrame',
		hiddenfield	: 'Прихован Поля',
		unknown		: 'Невдомий об\'кт'
	},

	resize : 'Потягнть для змни розмрв',

	colordialog :
	{
		title		: 'Обрати колр',
		options	:	'Опц кольорв',
		highlight	: 'Колр, на який вказу курсор',
		selected	: 'Обраний колр',
		clear		: 'Очистити'
	},

	toolbarCollapse	: 'Згорнути панель нструментв',
	toolbarExpand	: 'Розгорнути панель нструментв',

	toolbarGroups :
	{
		document : 'Документ',
		clipboard : 'Буфер обмну / Скасувати',
		editing : 'Редагування',
		forms : 'Форми',
		basicstyles : 'Основний Стиль',
		paragraph : 'Параграф',
		links : 'Посилання',
		insert : 'Вставити',
		styles : 'Стил',
		colors : 'Кольори',
		tools : 'нструменти'
	},

	bidi :
	{
		ltr : 'Напрямок тексту злва направо',
		rtl : 'Напрямок тексту справа налво'
	},

	docprops :
	{
		label : 'Властивост документа',
		title : 'Властивост документа',
		design : 'Дизайн',
		meta : 'Мета дан',
		chooseColor : 'Обрати',
		other : '<нший>',
		docTitle :	'Заголовок сторнки',
		charset : 	'Кодування набору символв',
		charsetOther : 'нше кодування набору символв',
		charsetASCII : 'ASCII',
		charsetCE : 'Центрально-вропейська',
		charsetCT : 'Китайська традицйна (Big5)',
		charsetCR : 'Кирилиця',
		charsetGR : 'Грецька',
		charsetJP : 'Японська',
		charsetKR : 'Корейська',
		charsetTR : 'Турецька',
		charsetUN : 'Юнкод (UTF-8)',
		charsetWE : 'Захдно-европейская',
		docType : 'Заголовок типу документу',
		docTypeOther : 'нший заголовок типу документу',
		xhtmlDec : 'Ввмкнути XHTML оголошення',
		bgColor : 'Колр тла',
		bgImage : 'URL зображення тла',
		bgFixed : 'Тло без прокрутки',
		txtColor : 'Колр тексту',
		margin : 'Вдступи сторнки',
		marginTop : 'Верхнй',
		marginLeft : 'Лвий',
		marginRight : 'Правий',
		marginBottom : 'Нижнй',
		metaKeywords : 'Ключов слова документа (роздлен комами)',
		metaDescription : 'Опис документа',
		metaAuthor : 'Автор',
		metaCopyright : 'Авторськ права',
		previewHtml : '<p>Це приклад<strong>тексту</strong>. Ви використовуте<a href="javascript:void(0)"> CKEditor </a>.</p>'
	}
};
