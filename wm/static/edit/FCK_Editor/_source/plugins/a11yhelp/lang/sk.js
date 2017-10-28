/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.plugins.setLang( 'a11yhelp', 'sk',
{
	accessibilityHelp :
	{
		title : 'Instrukcie prístupnosti',
		contents : 'Pomocn'y obsah. Pre zatvorenie tohto okna, stlacte ESC.',
		legend :
		[
			{
				name : 'Vseobecne',
				items :
						[
							{
								name : 'Lista nástrojov editora',
								legend:
									'Stlacte ${toolbarFocus} pre navigáciu na listu nástrojov. Medzi dalsou a predchádzajúcou listou nástrojov sa pohybujete s TAB a SHIFT-TAB. Medzi dalsím a predchádzajúcim tlacidlom na liste nástrojov sa pohybujete s pravou sípkou a lavou sípkou. Stlacte medzerník alebo ENTER pre aktiváciu tlacidla listy nástrojov.'
							},

							{
								name : 'Editorov'y dialóg',
								legend :
									'V dialogu, stlacte TAB pre navigáciu na dalsie dialógové pole, stlacte STIFT + TAB pre presun na predchádzajúce pole, stlacte ENTER pre odoslanie dialógu, stlacte ESC pre zrusenie dialógu. Pre dialógy, ktoré majú viac záloziek, stlacte ALT + F10 pre navigácou do zoznamu záloziek. Potom sa posúvajte k dalsej zálozke pomocou TAB alebo pravou sípkou. Pre presun k predchádzajúcej zálozke, stlacte SHIFT + TAB alebo lavú sípku. Stlacte medzerník alebo ENTER pre vybranie zálozky.'
							},

							{
								name : 'Editorové kontextové menu',
								legend :
									'Stlacte ${contextMenu} alebo APPLICATION KEY pre otvorenie kontextového menu. Potom sa presúvajte na dalsie moznosti menu s TAB alebo dolnou sípkou. Presunte sa k predchádzajúcej moznosti s SHIFT + TAB alebo hornou sípkou. Stlacte medzerník alebo ENTER pre v'yber moznosti menu. Otvorte pod-menu danej moznosti s medzerníkom, alebo ENTER, alebo pravou sípkou. Vrátte sa sp"at do polozky rodicovského menu s ESC alebo lavou sípkou. Zatvorte kontextové menu s ESC.'
							},

							{
								name : 'Editorov box zoznamu',
								legend :
									'V boxe zoznamu, presuňte sa na dalsiu polozku v zozname s TAB alebo dolnou sípkou. Presuňte sa k predchádzajúcej polozke v zozname so SHIFT + TAB alebo hornou sípkou. Stlacte medzerník alebo ENTER pre v'yber moznosti zoznamu. Stlacte ESC pre zatvorenie boxu zoznamu.'
							},

							{
								name : 'Editorove pásmo cesty prvku',
								legend :
									'Stlacte ${elementsPathFocus} pre navigovanie na pásmo cesty elementu. Presuňte sa na tlacidlo dalsieho prvku s TAB alebo pravou sípkou. Presuňte sa k predchádzajúcemu tlacidlu s SHIFT + TAB alebo lavou sípkou. Stlacte medzerník alebo ENTER pre v'yber prvku v editore.'
							}
						]
			},
			{
				name : 'Príkazy',
				items :
						[
							{
								name : 'Vrátit príkazy',
								legend : 'Stlacte ${undo}'
							},
							{
								name : 'Nanovo vrátit príkaz',
								legend : 'Stlacte ${redo}'
							},
							{
								name : 'Príkaz na stucnenie',
								legend : 'Stlacte ${bold}'
							},
							{
								name : 'Príkaz na kurzívu',
								legend : 'Stlacte ${italic}'
							},
							{
								name : 'Príkaz na podciarknutie',
								legend : 'Stlacte ${underline}'
							},
							{
								name : 'Príkaz na odkaz',
								legend : 'Stlacte ${link}'
							},
							{
								name : 'Príkaz na zbalenie listy nástrojov',
								legend : 'Stlacte ${toolbarCollapse}'
							},
							{
								name : 'Pomoc prístupnosti',
								legend : 'Stlacte ${a11yHelp}'
							}
						]
			}
		]
	}
});