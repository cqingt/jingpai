/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.plugins.setLang( 'a11yhelp', 'eo',
{
	accessibilityHelp :
	{
		title : 'Uzindikoj pri atingeblo',
		contents : 'Helpilenhavo. Por fermi tiun dialogon, premu la ESKAPAN klavon.',
		legend :
		[
			{
				name : '^Generala^joj',
				items :
						[
							{
								name : 'Ilbreto de la redaktilo',
								legend:
									'Premu ${toolbarFocus} por atingi la ilbreton. Movi^gu al la sekva au antaua grupoj de la ilbreto per la klavoj TABA kaj MAJUSKLIGA-TABA. Movi^gu al la sekva au antaua butonoj de la ilbreto per la klavoj SAGO DEKSTREN kaj SAGO MALDEKSTREN. Premu la SPACETklavon au la ENENklavon por aktivigi la ilbretbutonon.'
							},

							{
								name : 'Redaktildialogo',
								legend :
									'En dialogo, premu la TABAN klavon por navigi al la sekva dialogkampo, premu la MAJUSKLIGAN + TABAN klavojn por reveni al la antaua kampo, premu la ENENklavon por sendi la dialogon, premu la ESKAPAN klavon por nuligi la dialogon. Por dialogoj kun pluraj retpa^goj sub langetoj, premu ALT + F10 por navigi al la langetlisto. Poste movi^gu al la sekva langeto per la klavo TABA au SAGO DEKSTREN. Movi^gu al la antaua langeto per la klavoj MAJUSKLIGA + TABA au  SAGO MALDEKSTREN. Premu la SPACETklavon au la ENENklavon por selekti la langetretpa^gon.'
							},

							{
								name : 'Kunteksta menuo de la redaktilo',
								legend :
									'Premu ${contextMenu} au entajpu la KLAVKOMBINA^JON por malfermi la kuntekstan menuon. Poste movi^gu al la sekva opcio de la menuo per la klavoj TABA au SAGO SUBEN. Movi^gu al la antaua opcio per la klavoj MAJUSKLGA + TABA au SAGO SUPREN. Premu la SPACETklavon au ENENklavon por selekti la menuopcion. Malfermu la submenuon de la kuranta opcio per la SPACETklavo au la ENENklavo au la SAGO DEKSTREN. Revenu al la elemento de la patra menuo per la klavoj ESKAPA au SAGO MALDEKSTREN. Fermu la kuntekstan menuon per la ESKAPA klavo.'
							},

							{
								name : 'Fallisto de la redaktilo',
								legend :
									'En fallisto, movi^gu al la sekva listelemento per la klavoj TABA au SAGO SUBEN. Movi^gu al la antaua listelemento per la klavoj MAJUSKLIGA + TABA au SAGO SUPREN. Premu la SPACETklavon au ENENklavon por selekti la opcion en la listo. Premu la ESKAPAN klavon por fermi la falmenuon.'
							},

							{
								name : 'Breto indikanta la vojon al la redaktilelementoj',
								legend :
									'Premu ${elementsPathFocus} por navigi al la breto indikanta la vojon al la redaktilelementoj. Movi^gu al la butono de la sekva elemento per la klavoj TABA au SAGO DEKSTREN. Movi^gu al la butono de la antaua elemento per la klavoj MAJUSKLIGA + TABA au SAGO MALDEKSTREN. Premu la SPACETklavon au ENENklavon por selekti la elementon en la redaktilo.'
							}
						]
			},
			{
				name : 'Komandoj',
				items :
						[
							{
								name : 'Komando malfari',
								legend : 'Premu ${undo}'
							},
							{
								name : 'Komando refari',
								legend : 'Premu ${redo}'
							},
							{
								name : 'Komando grasa',
								legend : 'Premu ${bold}'
							},
							{
								name : 'Komando kursiva',
								legend : 'Premu ${italic}'
							},
							{
								name : 'Komando substreki',
								legend : 'Premu ${underline}'
							},
							{
								name : 'Komando ligilo',
								legend : 'Premu ${link}'
							},
							{
								name : 'Komando faldi la ilbreton',
								legend : 'Premu ${toolbarCollapse}'
							},
							{
								name : 'Helpilo pri atingeblo',
								legend : 'Premu ${a11yHelp}'
							}
						]
			}
		]
	}
});
