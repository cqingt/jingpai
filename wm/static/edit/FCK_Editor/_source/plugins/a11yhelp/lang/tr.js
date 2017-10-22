/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.plugins.setLang( 'a11yhelp', 'tr',
{
	accessibilityHelp :
	{
		title : 'Erisilebilirlik Talimatlari',
		contents : 'Yardim icerigi. Bu pencereyi kapatmak icin ESC tusuna basin.',
		legend :
		[
			{
				name : 'Genel',
				items :
						[
							{
								name : 'Arac Cubugu Edit"orü',
								legend:
									'Arac cubugunda gezinmek icin ${toolbarFocus} basin. TAB ve SHIFT-TAB ile "onceki ve sonraki arac cubugu grubuna tasiyin. SAG OK veya SOL OK ile "onceki ve sonraki bir arac cubugu dügmesini hareket ettirin. SPACE tusuna basin veya arac cubugu dügmesini etkinlestirmek icin ENTER tusna basin.'
							},

							{
								name : 'Dialog Edit"orü',
								legend :
									'Dialog penceresi icinde, sonraki iletisim alanina gitmek icin SEKME tusuna basin, "onceki alana gecmek icin SHIFT + TAB tusuna basin, pencereyi g"ondermek icin ENTER tusuna basin, dialog penceresini iptal etmek icin ESC tusuna basin. Birden cok sekme sayfalari olan diyaloglarin, sekme listesine gitmek icin ALT + F10 tuslarina basin. Sonra TAB veya SAG OK sonraki sekmeye tasiyin. SHIFT + TAB veya SOL OK ile "onceki sekmeye gecin. Sekme sayfayi secmek icin SPACE veya ENTER tusuna basin.'
							},

							{
								name : 'Icerik Menü Edit"orü',
								legend :
									'Icerik menüsünü acmak icin ${contextMenu} veya UYGULAMA TUSU\'na basin. Daha sonra SEKME veya ASAGI OK ile bir sonraki menü secenegi tasiyin. SHIFT + TAB veya YUKARI OK ile "onceki secenege gider. Menü secenegini secmek icin SPACE veya ENTER tusuna basin. Secili secenegin alt menüsünü SPACE ya da ENTER veya SAG OK acin. "Ust menü "ogesini gecmek icin ESC veya SOL OK ile geri d"onün. ESC ile baglam menüsünü kapatin.'
							},

							{
								name : 'Liste Kutusu Edit"orü',
								legend :
									'Liste kutusu icinde, bir sonraki liste "ogesine SEKME VEYA ASAGI OK ile tasiyin. SHIFT + TAB veya YUKARI "onceki liste "ogesi tasiyin. Liste secenegi secmek icin SPACE veya ENTER tusuna basin. Liste kutusunu kapatmak icin ESC tusuna basin.'
							},

							{
								name : 'Element Yol Cubugu Edit"orü',
								legend :
									'Elementlerin yol cubugunda gezinmek icin ${ElementsPathFocus} basin. SEKME veya SAG OK ile sonraki element dügmesine tasiyin. SHIFT + TAB veya SOL OK "onceki dügmeye hareket ettirin. Edit"or icindeki elementi secmek icin ENTER veya SPACE tusuna basin.'
							}
						]
			},
			{
				name : 'Komutlar',
				items :
						[
							{
								name : 'Komutu geri al',
								legend : '${undo} basin'
							},
							{
								name : ' Tekrar komutu uygula',
								legend : '${redo} basin'
							},
							{
								name : ' Kalin komut',
								legend : '${bold} basin'
							},
							{
								name : ' Italik komutu',
								legend : '${italic} basin'
							},
							{
								name : ' Alttan cizgi komutu',
								legend : '${underline} basin'
							},
							{
								name : ' Baglanti komutu',
								legend : '${link} basin'
							},
							{
								name : ' Arac cubugu Toplama komutu',
								legend : '${toolbarCollapse} basin'
							},
							{
								name : 'Erisilebilirlik Yardimi',
								legend : '${a11yHelp} basin'
							}
						]
			}
		]
	}
});
