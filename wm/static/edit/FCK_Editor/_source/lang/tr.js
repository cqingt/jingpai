/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
* @fileOverview
*/

/**#@+
   @type String
   @example
*/

/**
 * Contains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['tr'] =
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
	editorTitle : 'Zengin metin edit"orü, %1',
	editorHelp : 'Yardim icin ALT 0 tusuna basin',

	// ARIA descriptions.
	toolbars	: 'Arac cubuklari Edit"orü',
	editor		: 'Zengin Metin Edit"orü',

	// Toolbar buttons without dialogs.
	source			: 'Kaynak',
	newPage			: 'Yeni Sayfa',
	save			: 'Kaydet',
	preview			: '"On Izleme',
	cut				: 'Kes',
	copy			: 'Kopyala',
	paste			: 'Yapistir',
	print			: 'Yazdir',
	underline		: 'Alti Cizgili',
	bold			: 'Kalin',
	italic			: 'Italik',
	selectAll		: 'Tümünü Sec',
	removeFormat	: 'Bicimi Kaldir',
	strike			: '"Ustü Cizgili',
	subscript		: 'Alt Simge',
	superscript		: '"Ust Simge',
	horizontalrule	: 'Yatay Satir Ekle',
	pagebreak		: 'Sayfa Sonu Ekle',
	pagebreakAlt		: 'Sayfa Sonu',
	unlink			: 'K"oprü Kaldir',
	undo			: 'Geri Al',
	redo			: 'Tekrarla',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Sunucuyu Gez',
		url				: 'URL',
		protocol		: 'Protokol',
		upload			: 'Karsiya Yükle',
		uploadSubmit	: 'Sunucuya Yolla',
		image			: 'Resim',
		flash			: 'Flash',
		form			: 'Form',
		checkbox		: 'Onay Kutusu',
		radio			: 'Secenek Dügmesi',
		textField		: 'Metin Girisi',
		textarea		: 'Cok Satirli Metin',
		hiddenField		: 'Gizli Veri',
		button			: 'Dügme',
		select			: 'Secim Menüsü',
		imageButton		: 'Resimli Dügme',
		notSet			: '<tanimlanmamis>',
		id				: 'Kimlik',
		name			: 'Ad',
		langDir			: 'Dil Y"onü',
		langDirLtr		: 'Soldan Saga (LTR)',
		langDirRtl		: 'Sagdan Sola (RTL)',
		langCode		: 'Dil Kodlamasi',
		longDescr		: 'Uzun Tanimli URL',
		cssClass		: 'Bicem Sayfasi Siniflari',
		advisoryTitle	: 'Danisma Basligi',
		cssStyle		: 'Bicem',
		ok				: 'Tamam',
		cancel			: 'Iptal',
		close			: 'Kapat',
		preview			: '"On g"osterim',
		generalTab		: 'Genel',
		advancedTab		: 'Gelismis',
		validateNumberFailed : 'Bu deger sayi degildir.',
		confirmNewPage	: 'Iceriginiz kayit edilmediginden dolayi kaybolacaktir. Yeni bir sayfa yüklemek istediginize eminsiniz?',
		confirmCancel	: 'Bazi secenekler degismistir. Dialog penceresini kapatmak istediginize eminmisiniz?',
		options			: 'Secenekler',
		target			: 'Hedef',
		targetNew		: 'Yeni Pencere (_blank)',
		targetTop		: 'Enüst Pencere (_top)',
		targetSelf		: 'Ayni Pencere (_self)',
		targetParent	: 'Ana Pencere (_parent)',
		langDirLTR		: 'Soldan Saga (LTR)',
		langDirRTL		: 'Sagdan Sola (RTL)',
		styles			: 'Stil',
		cssClasses		: 'Stil sayfasi Sinifi',
		width			: 'Genislik',
		height			: 'Yükseklik',
		align			: 'Hizalama',
		alignLeft		: 'Sol',
		alignRight		: 'Sag',
		alignCenter		: 'Merkez',
		alignTop		: 'Tepe',
		alignMiddle		: 'Orta',
		alignBottom		: 'Alt',
		invalidValue	: 'Invalid value.', // MISSING
		invalidHeight	: 'Yükseklik sayi olmalidir.',
		invalidWidth	: 'Genislik bir sayi olmalidir.',
		invalidCssLength	: 'Belirttiginiz sayi "%1" alani icin pozitif bir sayi CSS birim degeri olmalidir (px, %, in, cm, mm, em, ex, pt, veya pc).',
		invalidHtmlLength	: 'Belirttiginiz sayi "%1" alani icin pozitif bir sayi HTML birim degeri olmalidir (px veya %).',
		invalidInlineStyle	: 'Noktali virgülle ayrilmis: "deger adi," inline stil icin belirtilen deger biciminde bir veya daha fazla dizilerden olusmalidir.',
		cssLengthTooltip	: 'Pikseller icin bir numara girin veya gecerli bir CSS numarasi (px, %, in, cm, mm, em, ex, pt, veya pc).',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, hazir degildir</span>'
	},

	contextmenu :
	{
		options : 'Icerik Menüsü Secenekleri'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: '"Ozel Karakter Ekle',
		title		: '"Ozel Karakter Sec',
		options : '"Ozel Karakter Secenekleri'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Link Ekle/Düzenle',
		other 		: '<diger>',
		menu		: 'Link Düzenle',
		title		: 'Link',
		info		: 'Link Bilgisi',
		target		: 'Hedef',
		upload		: 'Karsiya Yükle',
		advanced	: 'Gelismis',
		type		: 'Link Türü',
		toUrl		: 'URL',
		toAnchor	: 'Bu sayfada capa',
		toEmail		: 'E-Posta',
		targetFrame		: '<cerceve>',
		targetPopup		: '<yeni acilan pencere>',
		targetFrameName	: 'Hedef Cerceve Adi',
		targetPopupName	: 'Yeni Acilan Pencere Adi',
		popupFeatures	: 'Yeni Acilan Pencere "Ozellikleri',
		popupResizable	: 'Resizable',
		popupStatusBar	: 'Durum Cubugu',
		popupLocationBar: 'Yer Cubugu',
		popupToolbar	: 'Arac Cubugu',
		popupMenuBar	: 'Menü Cubugu',
		popupFullScreen	: 'Tam Ekran (IE)',
		popupScrollBars	: 'Kaydirma Cubuklari',
		popupDependent	: 'Bagimli (Netscape)',
		popupLeft		: 'Sola G"ore Konum',
		popupTop		: 'Yukariya G"ore Konum',
		id				: 'Id',
		langDir			: 'Dil Y"onü',
		langDirLTR		: 'Soldan Saga (LTR)',
		langDirRTL		: 'Sagdan Sola (RTL)',
		acccessKey		: 'Erisim Tusu',
		name			: 'Ad',
		langCode			: 'Dil Y"onü',
		tabIndex			: 'Sekme Indeksi',
		advisoryTitle		: 'Danisma Basligi',
		advisoryContentType	: 'Danisma Icerik Türü',
		cssClasses		: 'Bicem Sayfasi Siniflari',
		charset			: 'Bagli Kaynak Karakter Gurubu',
		styles			: 'Bicem',
		rel			: 'Iliski',
		selectAnchor		: 'Baglanti Sec',
		anchorName		: 'Baglanti Adi ile',
		anchorId			: 'Eleman Kimlik Numarasi ile',
		emailAddress		: 'E-Posta Adresi',
		emailSubject		: 'Ileti Konusu',
		emailBody		: 'Ileti G"ovdesi',
		noAnchors		: '(Bu belgede hic capa yok)',
		noUrl			: 'Lütfen Link URL\'sini yazin',
		noEmail			: 'Lütfen E-posta adresini yazin'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Baglanti Ekle/Düzenle',
		menu		: 'Baglanti "Ozellikleri',
		title		: 'Baglanti "Ozellikleri',
		name		: 'Baglanti Adi',
		errorName	: 'Lütfen baglanti icin ad giriniz',
		remove		: 'Baglantiyi Kaldir'
	},

	// List style dialog
	list:
	{
		numberedTitle		: 'Sayilandirilmis Liste "Ozellikleri',
		bulletedTitle		: 'Simgeli Liste "Ozellikleri',
		type				: 'Tipi',
		start				: 'Basla',
		validateStartNumber				:'Liste baslangici tam sayi olmalidir.',
		circle				: 'Daire',
		disc				: 'Disk',
		square				: 'Kare',
		none				: 'Yok',
		notset				: '<ayarlanmamis>',
		armenian			: 'Ermenice sayilandirma',
		georgian			: 'Gürcüce numaralandirma (an, ban, gan, vs.)',
		lowerRoman			: 'Kücük Roman (i, ii, iii, iv, v, vs.)',
		upperRoman			: 'Büyük Roman (I, II, III, IV, V, vs.)',
		lowerAlpha			: 'Kücük Alpha (a, b, c, d, e, vs.)',
		upperAlpha			: 'Büyük Alpha (A, B, C, D, E, vs.)',
		lowerGreek			: 'Kücük Greek (alpha, beta, gamma, vs.)',
		decimal				: 'Ondalik (1, 2, 3, vs.)',
		decimalLeadingZero	: 'Basi sifirli ondalik (01, 02, 03, vs.)'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Bul ve Degistir',
		find				: 'Bul',
		replace				: 'Degistir',
		findWhat			: 'Aranan:',
		replaceWith			: 'Bununla degistir:',
		notFoundMsg			: 'Belirtilen yazi bulunamadi.',
		findOptions			: 'Secenekleri Bul',
		matchCase			: 'Büyük/kücük harf duyarli',
		matchWord			: 'Kelimenin tamami uysun',
		matchCyclic			: 'Eslesen d"ongü',
		replaceAll			: 'Tümünü Degistir',
		replaceSuccessMsg	: '%1 bulunanlardan degistirildi.'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Tablo',
		title		: 'Tablo "Ozellikleri',
		menu		: 'Tablo "Ozellikleri',
		deleteTable	: 'Tabloyu Sil',
		rows		: 'Satirlar',
		columns		: 'Sütunlar',
		border		: 'Kenar Kalinligi',
		widthPx		: 'piksel',
		widthPc		: 'yüzde',
		widthUnit	: 'genislik birimi',
		cellSpace	: 'Izgara kalinligi',
		cellPad		: 'Izgara yazi arasi',
		caption		: 'Baslik',
		summary		: '"Ozet',
		headers		: 'Basliklar',
		headersNone		: 'Yok',
		headersColumn	: 'Ilk Sütun',
		headersRow		: 'Ilk Satir',
		headersBoth		: 'Her Ikisi',
		invalidRows		: 'Satir sayisi 0 sayisindan büyük olmalidir.',
		invalidCols		: 'Sütün sayisi 0 sayisindan büyük olmalidir.',
		invalidBorder	: 'Cerceve büyüklüklügü sayi olmalidir.',
		invalidWidth	: 'Tablo genisligi sayi olmalidir.',
		invalidHeight	: 'Tablo yüksekligi sayi olmalidir.',
		invalidCellSpacing	: 'Hücre boslugu (spacing) sayi olmalidir.',
		invalidCellPadding	: 'Hücre araligi (padding) sayi olmalidir.',

		cell :
		{
			menu			: 'Hücre',
			insertBefore	: 'Hücre Ekle - "Once',
			insertAfter		: 'Hücre Ekle - Sonra',
			deleteCell		: 'Hücre Sil',
			merge			: 'Hücreleri Birlestir',
			mergeRight		: 'Birlestir - Sagdaki Ile ',
			mergeDown		: 'Birlestir - Asagidaki Ile ',
			splitHorizontal	: 'Hücreyi Yatay B"ol',
			splitVertical	: 'Hücreyi Dikey B"ol',
			title			: 'Hücre "Ozellikleri',
			cellType		: 'Hücre Tipi',
			rowSpan			: 'Satirlar Mesafesi (Span)',
			colSpan			: 'Sütünlar Mesafesi (Span)',
			wordWrap		: 'Kelime Kaydirma',
			hAlign			: 'Düsey Hizalama',
			vAlign			: 'Yatas Hizalama',
			alignBaseline	: 'Tabana',
			bgColor			: 'Arkaplan Rengi',
			borderColor		: 'Cerceve Rengi',
			data			: 'Veri',
			header			: 'Baslik',
			yes				: 'Evet',
			no				: 'Hayir',
			invalidWidth	: 'Hücre genisligi sayi olmalidir.',
			invalidHeight	: 'Hücre yüksekligi sayi olmalidir.',
			invalidRowSpan	: 'Satirlarin mesafesi tam sayi olmalidir.',
			invalidColSpan	: 'Sütünlarin mesafesi tam sayi olmalidir.',
			chooseColor		: 'Seciniz'
		},

		row :
		{
			menu			: 'Satir',
			insertBefore	: 'Satir Ekle - "Once',
			insertAfter		: 'Satir Ekle - Sonra',
			deleteRow		: 'Satir Sil'
		},

		column :
		{
			menu			: 'Sütun',
			insertBefore	: 'Kolon Ekle - "Once',
			insertAfter		: 'Kolon Ekle - Sonra',
			deleteColumn	: 'Sütun Sil'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Dügme "Ozellikleri',
		text		: 'Metin (Deger)',
		type		: 'Tip',
		typeBtn		: 'Dügme',
		typeSbm		: 'G"onder',
		typeRst		: 'Sifirla'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Onay Kutusu "Ozellikleri',
		radioTitle	: 'Secenek Dügmesi "Ozellikleri',
		value		: 'Deger',
		selected	: 'Secili'
	},

	// Form Dialog.
	form :
	{
		title		: 'Form "Ozellikleri',
		menu		: 'Form "Ozellikleri',
		action		: 'Islem',
		method		: 'Y"ontem',
		encoding	: 'Kodlama'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Secim Menüsü "Ozellikleri',
		selectInfo	: 'Bilgi',
		opAvail		: 'Mevcut Secenekler',
		value		: 'Deger',
		size		: 'Boyut',
		lines		: 'satir',
		chkMulti	: 'Coklu secime izin ver',
		opText		: 'Metin',
		opValue		: 'Deger',
		btnAdd		: 'Ekle',
		btnModify	: 'Düzenle',
		btnUp		: 'Yukari',
		btnDown		: 'Asagi',
		btnSetValue : 'Secili deger olarak ata',
		btnDelete	: 'Sil'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Cok Satirli Metin "Ozellikleri',
		cols		: 'Sütunlar',
		rows		: 'Satirlar'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Metin Girisi "Ozellikleri',
		name		: 'Ad',
		value		: 'Deger',
		charWidth	: 'Karakter Genisligi',
		maxChars	: 'En Fazla Karakter',
		type		: 'Tür',
		typeText	: 'Metin',
		typePass	: 'Sifre'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Gizli Veri "Ozellikleri',
		name	: 'Ad',
		value	: 'Deger'
	},

	// Image Dialog.
	image :
	{
		title		: 'Resim "Ozellikleri',
		titleButton	: 'Resimli Dügme "Ozellikleri',
		menu		: 'Resim "Ozellikleri',
		infoTab		: 'Resim Bilgisi',
		btnUpload	: 'Sunucuya Yolla',
		upload		: 'Karsiya Yükle',
		alt			: 'Alternatif Yazi',
		lockRatio	: 'Orani Kilitle',
		resetSize	: 'Boyutu Basa D"ondür',
		border		: 'Kenar',
		hSpace		: 'Yatay Bosluk',
		vSpace		: 'Dikey Bosluk',
		alertUrl	: 'Lütfen resmin URL\'sini yaziniz',
		linkTab		: 'K"oprü',
		button2Img	: 'Secili resim butonunu basit resime cevirmek istermisiniz?',
		img2Button	: 'Secili olan resimi, resimli butona cevirmek istermisiniz?',
		urlMissing	: 'Resmin URL kaynagi eksiktir.',
		validateBorder	: 'Cerceve tam sayi olmalidir.',
		validateHSpace	: 'HSpace tam sayi olmalidir.',
		validateVSpace	: 'VSpace tam sayi olmalidir.'
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Flash "Ozellikleri',
		propertiesTab	: '"Ozellikler',
		title			: 'Flash "Ozellikleri',
		chkPlay			: 'Otomatik Oynat',
		chkLoop			: 'D"ongü',
		chkMenu			: 'Flash Menüsünü Kullan',
		chkFull			: 'Tam ekrana Izinver',
 		scale			: 'Boyutlandir',
		scaleAll		: 'Hepsini G"oster',
		scaleNoBorder	: 'Kenar Yok',
		scaleFit		: 'Tam Sigdir',
		access			: 'Kod Izni',
		accessAlways	: 'Herzaman',
		accessSameDomain: 'Ayni domain',
		accessNever		: 'Asla',
		alignAbsBottom	: 'Tam Alti',
		alignAbsMiddle	: 'Tam Ortasi',
		alignBaseline	: 'Taban Cizgisi',
		alignTextTop	: 'Yazi Tepeye',
		quality			: 'Kalite',
		qualityBest		: 'En iyi',
		qualityHigh		: 'Yüksek',
		qualityAutoHigh	: 'Otomatik Yükseklik',
		qualityMedium	: 'Orta',
		qualityAutoLow	: 'Otomatik Düsüklük',
		qualityLow		: 'Düsük',
		windowModeWindow: 'Pencere',
		windowModeOpaque: 'Opak',
		windowModeTransparent : 'Seffaf',
		windowMode		: 'Pencere modu',
		flashvars		: 'Flash Degerleri',
		bgcolor			: 'Arka Renk',
		hSpace			: 'Yatay Bosluk',
		vSpace			: 'Dikey Bosluk',
		validateSrc		: 'Lütfen k"oprü URL\'sini yazin',
		validateHSpace	: 'HSpace sayi olmalidir.',
		validateVSpace	: 'VSpace sayi olmalidir.'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Yazim Denetimi',
		title			: 'Yazimi Denetle',
		notAvailable	: '"Uzügünüz, bu servis suanda hizmet disidir.',
		errorLoading	: 'Uygulamada yüklerken hata olustu: %s.',
		notInDic		: 'S"ozlükte Yok',
		changeTo		: 'Suna degistir:',
		btnIgnore		: 'Yoksay',
		btnIgnoreAll	: 'Tümünü Yoksay',
		btnReplace		: 'Degistir',
		btnReplaceAll	: 'Tümünü Degistir',
		btnUndo			: 'Geri Al',
		noSuggestions	: '- "Oneri Yok -',
		progress		: 'Yazim denetimi islemde...',
		noMispell		: 'Yazim denetimi tamamlandi: Yanlis yazima rastlanmadi',
		noChanges		: 'Yazim denetimi tamamlandi: Hicbir kelime degistirilmedi',
		oneChange		: 'Yazim denetimi tamamlandi: Bir kelime degistirildi',
		manyChanges		: 'Yazim denetimi tamamlandi: %1 kelime degistirildi',
		ieSpellDownload	: 'Yazim denetimi yüklenmemis. Simdi yüklemek ister misiniz?'
	},

	smiley :
	{
		toolbar	: 'Ifade',
		title	: 'Ifade Ekle',
		options : 'Ifade Secenekleri'
	},

	elementsPath :
	{
		eleLabel : 'Elementlerin yolu',
		eleTitle : '%1 elementi'
	},

	numberedlist	: 'Numarali Liste',
	bulletedlist	: 'Simgeli Liste',
	indent			: 'Sekme Arttir',
	outdent			: 'Sekme Azalt',

	justify :
	{
		left	: 'Sola Dayali',
		center	: 'Ortalanmis',
		right	: 'Saga Dayali',
		block	: 'Iki Kenara Yaslanmis'
	},

	blockquote : 'Blok Olustur',

	clipboard :
	{
		title		: 'Yapistir',
		cutError	: 'Gezgin yaziliminizin güvenlik ayarlari düzenleyicinin otomatik kesme islemine izin vermiyor. Islem icin (Ctrl/Cmd+X) tuslarini kullanin.',
		copyError	: 'Gezgin yaziliminizin güvenlik ayarlari düzenleyicinin otomatik kopyalama islemine izin vermiyor. Islem icin (Ctrl/Cmd+C) tuslarini kullanin.',
		pasteMsg	: 'Lütfen asagidaki kutunun icine yapistirin. (<STRONG>Ctrl/Cmd+V</STRONG>) ve <STRONG>Tamam</STRONG> butonunu tiklayin.',
		securityMsg	: 'Gezgin yaziliminizin güvenlik ayarlari düzenleyicinin direkt olarak panoya erisimine izin vermiyor. Bu pencere icine tekrar yapistirmalisiniz..',
		pasteArea	: 'Yapistirma Alani'
	},

	pastefromword :
	{
		confirmCleanup	: 'Yapistirmaya calistiginiz metin Word\'den kopyalanmistir. Yapistirmadan "once silmek istermisiniz?',
		toolbar			: 'Word\'den Yapistir',
		title			: 'Word\'den Yapistir',
		error			: 'Yapistirmadaki veri bilgisi hata düzelene kadar silinmeyecektir'
	},

	pasteText :
	{
		button	: 'Düz Metin Olarak Yapistir',
		title	: 'Düz Metin Olarak Yapistir'
	},

	templates :
	{
		button			: 'Sablonlar',
		title			: 'Icerik Sablonlari',
		options : 'Sablon Secenekleri',
		insertOption	: 'Mevcut icerik ile degistir',
		selectPromptMsg	: 'Düzenleyicide acmak icin lütfen bir sablon secin.<br>(hali hazirdaki icerik kaybolacaktir.):',
		emptyListMsg	: '(Belirli bir sablon secilmedi)'
	},

	showBlocks : 'Bloklari G"oster',

	stylesCombo :
	{
		label		: 'Bicem',
		panelTitle	: 'Stilleri Düzenliyor',
		panelTitle1	: 'Blok Stilleri',
		panelTitle2	: 'Inline Stilleri',
		panelTitle3	: 'Nesne Stilleri'
	},

	format :
	{
		label		: 'Bicim',
		panelTitle	: 'Bicim',

		tag_p		: 'Normal',
		tag_pre		: 'Bicimli',
		tag_address	: 'Adres',
		tag_h1		: 'Baslik 1',
		tag_h2		: 'Baslik 2',
		tag_h3		: 'Baslik 3',
		tag_h4		: 'Baslik 4',
		tag_h5		: 'Baslik 5',
		tag_h6		: 'Baslik 6',
		tag_div		: 'Paragraf (DIV)'
	},

	div :
	{
		title				: 'Div Icerigi Olustur',
		toolbar				: 'Div Icerigi Olustur',
		cssClassInputLabel	: 'Stilltipi Sinifi',
		styleSelectLabel	: 'Stil',
		IdInputLabel		: 'Id',
		languageCodeInputLabel	: ' Dil Kodu',
		inlineStyleInputLabel	: 'Inline Stili',
		advisoryTitleInputLabel	: 'Tavsiye Basligi',
		langDirLabel		: 'Dil Y"onü',
		langDirLTRLabel		: 'Soldan saga (LTR)',
		langDirRTLLabel		: 'Sagdan sola (RTL)',
		edit				: 'Div Düzenle',
		remove				: 'Div Kaldir'
  	},

	iframe :
	{
		title		: 'IFrame "Ozellikleri',
		toolbar		: 'IFrame',
		noUrl		: 'Lütfen IFrame k"oprü (URL) baglantisini yazin',
		scrolling	: 'Kaydirma cubuklarini aktif et',
		border		: 'Cerceve sinirlarini g"oster'
	},

	font :
	{
		label		: 'Yazi Türü',
		voiceLabel	: 'Font',
		panelTitle	: 'Yazi Türü'
	},

	fontSize :
	{
		label		: 'Boyut',
		voiceLabel	: 'Font Size',
		panelTitle	: 'Boyut'
	},

	colorButton :
	{
		textColorTitle	: 'Yazi Rengi',
		bgColorTitle	: 'Arka Renk',
		panelTitle		: 'Renkler',
		auto			: 'Otomatik',
		more			: 'Diger renkler...'
	},

	colors :
	{
		'000' : 'Siyah',
		'800000' : 'Kestane',
		'8B4513' : 'Koyu Kahverengi',
		'2F4F4F' : 'Koyu Kursuni Gri',
		'008080' : 'Teal',
		'000080' : 'Mavi',
		'4B0082' : 'Civit Mavisi',
		'696969' : 'Silik Gri',
		'B22222' : 'Ates Tuglasi',
		'A52A2A' : 'Kahverengi',
		'DAA520' : 'Altun Sirik',
		'006400' : 'Koyu Yesil',
		'40E0D0' : 'Turkuaz',
		'0000CD' : 'Orta Mavi',
		'800080' : 'Pembe',
		'808080' : 'Gri',
		'F00' : 'Kirmizi',
		'FF8C00' : 'Koyu Portakal',
		'FFD700' : 'Altin',
		'008000' : 'Yesil',
		'0FF' : 'Ciyan',
		'00F' : 'Mavi',
		'EE82EE' : 'Menekse',
		'A9A9A9' : 'Koyu Gri',
		'FFA07A' : 'Acik Sarimsi',
		'FFA500' : 'Portakal',
		'FFFF00' : 'Sari',
		'00FF00' : 'Acik Yesil',
		'AFEEEE' : 'S"onük Turkuaz',
		'ADD8E6' : 'Acik Mavi',
		'DDA0DD' : 'Mor',
		'D3D3D3' : 'Acik Gri',
		'FFF0F5' : 'Eflatun Pembe',
		'FAEBD7' : 'Antik Beyaz',
		'FFFFE0' : 'Acik Sari',
		'F0FFF0' : 'Balsarisi',
		'F0FFFF' : 'G"ok Mavisi',
		'F0F8FF' : 'Reha Mavi',
		'E6E6FA' : 'Eflatun',
		'FFF' : 'Beyaz'
	},

	scayt :
	{
		title			: 'Girmis oldugunuz kelime denetimi',
		opera_title		: 'Opera tarafindan desteklenmemektedir',
		enable			: 'SCAYT\'i etkinlestir',
		disable			: 'SCAYT\'i pasiflestir',
		about			: 'SCAYT\'i hakkinda',
		toggle			: 'SCAYT\'i degistir',
		options			: 'Secenekler',
		langs			: 'Diller',
		moreSuggestions	: 'Daha fazla "oneri',
		ignore			: 'Yoksay',
		ignoreAll		: 'Tümünü Yoksay',
		addWord			: 'Kelime Ekle',
		emptyDic		: 'S"ozlük adi bos olamaz.',

		optionsTab		: 'Secenekler',
		allCaps			: 'Tüm büyük kücük kelimeleri yoksay',
		ignoreDomainNames : 'Domain adlarini yoksay',
		mixedCase		: 'Karisik büyüklük ile S"ozcükler yoksay',
		mixedWithDigits	: 'Sayilarla Kelimeler yoksay',

		languagesTab	: 'Diller',

		dictionariesTab	: 'S"ozlükler',
		dic_field_name	: 'S"ozlük adi',
		dic_create		: 'Olustur',
		dic_restore		: 'Geri al',
		dic_delete		: 'Sil',
		dic_rename		: 'Yeniden adlandir',
		dic_info		: 'Baslangicta Kullanici S"ozlügü bir cerezde saklanir. Ancak, Cerezler boyutu sinirlidir. Kullanici S"ozlügü, cerezin icinde saklanamayacagi bir noktada, bizim sunucularimizin icindeki s"ozlükte saklanabilir. Bizim sunucu üzerinde kisisel S"ozlük saklamaniz icin, S"ozlüge bir ad belirtmelisiniz. Eger zaten bir sakli S"ozlük varsa, lütfen adini yazin ve Geri Yükle dügmesini tiklayin.',

		aboutTab		: 'Hakkinda'
	},

	about :
	{
		title		: 'CKEditor Hakkinda',
		dlgTitle	: 'CKEditor Hakkinda',
		help	: 'Yardim icin $1 kontrol edin.',
		userGuide : 'CKEditor Kullanici Kilavuzu',
		moreInfo	: 'Lisanslama hakkinda daha fazla bilgi almak icin lütfen sitemizi ziyaret edin:',
		copy		: 'Copyright &copy; $1. Tüm haklari saklidir.'
	},

	maximize : 'Büyült',
	minimize : 'Kücült',

	fakeobjects :
	{
		anchor		: 'Baglanti',
		flash		: 'Flash Animasyonu',
		iframe		: 'IFrame',
		hiddenfield	: 'Gizli Alan',
		unknown		: 'Bilinmeyen Nesne'
	},

	resize : 'Boyutlandirmak icin sürükle',

	colordialog :
	{
		title		: 'Renk sec',
		options	:	'Renk Secenekleri',
		highlight	: 'Isaretle',
		selected	: 'Secilmis',
		clear		: 'Temizle'
	},

	toolbarCollapse	: 'Arac cubuklarini topla',
	toolbarExpand	: 'Arac cubuklarini ac',

	toolbarGroups :
	{
		document : 'Belge',
		clipboard : 'Pano/Geri al',
		editing : 'Düzenleme',
		forms : 'Formlar',
		basicstyles : 'Temel Stiller',
		paragraph : 'Paragraf',
		links : 'Baglantilar',
		insert : 'Ekle',
		styles : 'Stiller',
		colors : 'Renkler',
		tools : 'Araclar'
	},

	bidi :
	{
		ltr : 'Metin y"onü soldan saga',
		rtl : 'Metin y"onü sagdan sola'
	},

	docprops :
	{
		label : 'Belge "Ozellikleri',
		title : 'Belge "Ozellikleri',
		design : 'Dizayn',
		meta : 'Tanim Bilgisi (Meta)',
		chooseColor : 'Seciniz',
		other : '<diger>',
		docTitle :	'Sayfa Basligi',
		charset : 	'Karakter Kümesi Kodlamasi',
		charsetOther : 'Diger Karakter Kümesi Kodlamasi',
		charsetASCII : 'ASCII',
		charsetCE : 'Orta Avrupa',
		charsetCT : 'Geleneksel Cince (Big5)',
		charsetCR : 'Kiril',
		charsetGR : 'Yunanca',
		charsetJP : 'Japonca',
		charsetKR : 'Korece',
		charsetTR : 'Türkce',
		charsetUN : 'Evrensel Kod (UTF-8)',
		charsetWE : 'Bati Avrupa',
		docType : 'Belge Türü Basligi',
		docTypeOther : 'Diger Belge Türü Basligi',
		xhtmlDec : 'XHTML Bildirimlerini Dahil Et',
		bgColor : 'Arka Plan Rengi',
		bgImage : 'Arka Plan Resim URLsi',
		bgFixed : 'Sabit Arka Plan',
		txtColor : 'Yazi Rengi',
		margin : 'Kenar Bosluklari',
		marginTop : 'Tepe',
		marginLeft : 'Sol',
		marginRight : 'Sag',
		marginBottom : 'Alt',
		metaKeywords : 'Belge Dizinleme Anahtar Kelimeleri (virgülle ayrilmis)',
		metaDescription : 'Belge Tanimi',
		metaAuthor : 'Yazar',
		metaCopyright : 'Telif',
		previewHtml : '<p>Bu bir <strong>"ornek metindir</strong>. <a href="javascript:void(0)">CKEditor</a> kullaniyorsunuz.</p>'
	}
};
