/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.plugins.setLang( 'a11yhelp', 'fi',
{
	accessibilityHelp :
	{
		title : 'Saavutettavuus ohjeet',
		contents : 'Ohjeen sis"all"ot. Sulkeaksesi t"am"an dialogin paina ESC.',
		legend :
		[
			{
				name : 'Yleinen',
				items :
						[
							{
								name : 'Editorin ty"okalupalkki',
								legend:
									'Paina ${toolbarFocus} siirty"aksesi ty"okalupalkkiin. Siirry seuraavaan ja edelliseen ty"okalupalkin ryhm"a"an TAB ja SHIFT-TAB n"app"aimill"a. Siirry seuraavaan ja edelliseen ty"okalupainikkeeseen k"aytt"am"all"a NUOLI OIKEALLE tai NUOLI VASEMMALLE n"app"aimill"a. Paina V"ALILY"ONTI tai ENTER n"app"aint"a aktivoidaksesi ty"okalupainikkeen.'
							},

							{
								name : 'Editorin dialogi',
								legend :
									'Dialogin sis"all"a, painamalla TAB siirryt seuraavaan dialogin kentt"a"an, painamalla SHIFT+TAB siirryt aiempaan kentt"a"an, painamalla ENTER l"ahet"at dialogin, painamalla ESC peruutat dialogin. Dialogeille joissa on useita v"alilehti"a, paina ALT+F10 siirty"aksesi v"alillehtilistaan. Siirty"aksesi seuraavaan v"alilehteen paina TAB tai NUOLI OIKEALLE. Siirry edelliseen v"alilehteen painamalla SHIFT+TAB tai nuoli vasemmalle. Paina V"ALILY"ONTI tai ENTER valitaksesi v"alilehden.'
							},

							{
								name : 'Editorin oheisvalikko',
								legend :
									'Paina ${contextMenu} tai SOVELLUSPAINIKETTA avataksesi oheisvalikon. Liiku seuraavaan valikon vaihtoehtoon TAB tai NUOLI ALAS n"app"aimill"a. Siirry edelliseen vaihtoehtoon SHIFT+TAB tai NUOLI YL"OS n"app"aimill"a. Paina V"ALILY"ONTI tai ENTER valitaksesi valikon kohdan. Avataksesi nykyisen kohdan alivalikon paina V"ALILY"ONTI tai ENTER tai NUOLI OIKEALLE painiketta. Siirty"aksesi takaisin valikon ylemm"alle tasolle paina ESC tai NUOLI vasemmalle. Oheisvalikko suljetaan ESC painikkeella.'
							},

							{
								name : 'Editorin listalaatikko',
								legend :
									'Listalaatikon sis"all"a siirry seuraavaan listan kohtaan TAB tai NUOLI ALAS painikkeilla. Siirry edelliseen listan kohtaan SHIFT+TAB tai NUOLI YL"OS painikkeilla. Paina V"ALILY"ONTI tai ENTER valitaksesi listan vaihtoehdon. Paina ESC sulkeaksesi listalaatikon.'
							},

							{
								name : 'Editorin elementtipolun palkki',
								legend :
									'Paina ${elementsPathFocus} siirty"aksesi elementtipolun palkkiin. Siirry seuraavaan elementtipainikkeeseen TAB tai NUOLI OIKEALLE painikkeilla. Siirry aiempaan painikkeeseen SHIFT+TAB tai NUOLI VASEMMALLE painikkeilla. Paina V"ALILY"ONTI tai ENTER valitaksesi elementin editorissa.'
							}
						]
			},
			{
				name : 'Komennot',
				items :
						[
							{
								name : 'Peruuta komento',
								legend : 'Paina ${undo}'
							},
							{
								name : 'Tee uudelleen komento',
								legend : 'Paina ${redo}'
							},
							{
								name : 'Lihavoi komento',
								legend : 'Paina ${bold}'
							},
							{
								name : 'Kursivoi komento',
								legend : 'Paina ${italic}'
							},
							{
								name : 'Alleviivaa komento',
								legend : 'Paina ${underline}'
							},
							{
								name : 'Linkki komento',
								legend : 'Paina ${link}'
							},
							{
								name : 'Pienenn"a ty"okalupalkki komento',
								legend : 'Paina ${toolbarCollapse}'
							},
							{
								name : 'Saavutettavuus ohjeet',
								legend : 'Paina ${a11yHelp}'
							}
						]
			}
		]
	}
});
