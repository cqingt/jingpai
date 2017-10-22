/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.plugins.setLang( 'a11yhelp', 'cs',
{
	accessibilityHelp :
	{
		title : 'Instrukce pro prístupnost',
		contents : 'Obsah nápovědy. Pro uzavrení tohoto dialogu stiskněte klávesu ESC.',
		legend :
		[
			{
				name : 'Obecné',
				items :
						[
							{
								name : 'Panel nástroju editoru',
								legend:
									'Stiskněte${toolbarFocus} k procházení panelu nástroju. Prejděte na dalsí a predchozí skupiny pomocí TAB a SHIFT-TAB. Prechod na dalsí a predchozí tlacítko panelu nástroju je pomocí SIPKA VPRAVO nebo SIPKA VLEVO. Stisknutím mezerníku nebo klávesy ENTER tlacítko aktivujete.'
							},

							{
								name : 'Dialogové okno editoru',
								legend :
									'Uvnitr dialogového okna stiskněte TAB pro presunutí na dalsí pole, stiskněte SHIFT + TAB pro presun na predchozí pole, stiskněte ENTER pro odeslání dialogu, stiskněte ESC pro jeho zrusení. Pro dialogová okna, která mají mnoho karet stiskněte ALT + F10 pr oprocházení seznamu karet. Pak se presuňte na dalsí kartu pomocí TAB nebo SIPKA VPRAVO. Pro presun na predchozí stiskněte SHIFT + TAB nebo SIPKA VLEVO. Stiskněte MEZERN'IK nebo ENTER pro vybrání stránky karet.'
							},

							{
								name : 'Kontextové menu editoru',
								legend :
									'Stiskněte ${contextMenu} nebo klávesu APPLICATION k otevrení kontextového menu. Pak se presuňte na dalsí moznost menu pomocí TAB nebo SIPKY DOLU. Presuňte se na predchozí moznost pomocí  SHIFT+TAB nebo SIPKY NAHORU. Stiskněte MEZERN'IK nebo ENTER pro zvolení moznosti menu. Podmenu soucasné moznosti otevrete pomocí MEZERN'IKU nebo ENTER ci SIPKY DOLEVA. Kontextové menu uzavrete stiskem ESC.'
							},

							{
								name : 'Rámecek seznamu editoru',
								legend :
									'Uvnitr rámecku seznamu se presunete na dalsí polozku menu pomocí TAB nebo SIPKA DOLU. Na predchozí polozku se presunete SHIFT + TAB nebo SIPKA NAHORU. Stiskněte MEZERN'IK nebo ENTER pro zvolení moznosti seznamu. Stiskněte ESC pro uzavrení seznamu.'
							},

							{
								name : 'Lista cesty prvku v editoru',
								legend :
									'Stiskněte ${elementsPathFocus} pro procházení listy cesty prvku. Na dalsí tlacítko prvku se presunete pomocí TAB nebo SIPKA VPRAVO. Na predchozí polozku se presunete pomocí SHIFT + TAB nebo SIPKA VLEVO. Stiskněte MEZERN'IK nebo ENTER pro vybrání prvku v editoru.'
							}
						]
			},
			{
				name : 'Príkazy',
				items :
						[
							{
								name : ' Príkaz Zpět',
								legend : 'Stiskněte ${undo}'
							},
							{
								name : ' Príkaz Znovu',
								legend : 'Stiskněte ${redo}'
							},
							{
								name : ' Príkaz Tucné',
								legend : 'Stiskněte ${bold}'
							},
							{
								name : ' Príkaz Kurzíva',
								legend : 'Stiskněte ${italic}'
							},
							{
								name : ' Príkaz Podtrzení',
								legend : 'Stiskněte ${underline}'
							},
							{
								name : ' Príkaz Odkaz',
								legend : 'Stiskněte ${link}'
							},
							{
								name : ' Príkaz Skr'yt panel nástroju',
								legend : 'Stiskněte ${toolbarCollapse}'
							},
							{
								name : ' Nápověda prístupnosti',
								legend : 'Stiskněte ${a11yHelp}'
							}
						]
			}
		]
	}
});
