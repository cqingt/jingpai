/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.plugins.setLang( 'a11yhelp', 'el',
{
	accessibilityHelp :
	{
		title : 'Οδηγε Προσβασιμτητα',
		contents : 'Περιεχμενα Βοθεια. Πατστε ESC για κλεσιμο.',
		legend :
		[
			{
				name : 'Γενικ',
				items :
						[
							{
								name : 'Εργαλειοθκη Επεξεργαστ',
								legend:
									'Πατστε ${toolbarFocus} για να περιηγηθετε στην γραμμ εργαλεων. Μετακινηθετε ανμεσα στι ομδε τη γραμμ εργαλεων με TAB και Shift-TAB. Μετακινηθετε ανμεσα στα κουμπα εργαλεων με ΔΕΞΙ και ΑΡΙΣΤΕΡΟ ΒΕΛΑΚΙ. Πατστε ΚΕΝΟ  ENTER για να ενεργοποισετε το ενεργ κουμπ εργαλεου.'
							},

							{
								name : 'Παρθυρο Διαλγου Επεξεργαστ',
								legend :
									'Μσα σε να παρθυρο διαλγου, πατστε TAB για να μεταβετε στο επμενο πεδο  SHIFT + TAB για να μεταβετε στο προηγομενο. Πατστε ENTER για να υποβλετε την φρμα. Πατστε ESC για να ακυρσετε την διαδικασα τη φρμα. Για παρθυρα διαλγων που χουν πολλ σελδε σε καρτλε πατστε ALT + F10 για να μεταβετε στην λστα των καρτλων. Στην συνχεια μπορετε να μεταβετε στην επμενη καρτλα πατντα TAB  RIGHT ARROW. Μπορετε να μεταβετε στην προηγομενη καρτλα πατντα SHIFT + TAB  LEFT ARROW. Πατστε SPACE  ENTER για να επιλξετε την καρτλα για προβολ.'
							},

							{
								name : 'Αναδυμενο Μενο Επεξεργαστ',
								legend :
									'Press ${contextMenu} or APPLICATION KEY to open context-menu. Then move to next menu option with TAB or DOWN ARROW. Move to previous option with SHIFT+TAB or UP ARROW. Press SPACE or ENTER to select the menu option. Open sub-menu of current option with SPACE or ENTER or RIGHT ARROW. Go back to parent menu item with ESC or LEFT ARROW. Close context menu with ESC.'  // MISSING
							},

							{
								name : 'Editor List Box', // MISSING
								legend :
									'Inside a list-box, move to next list item with TAB OR DOWN ARROW. Move to previous list item with SHIFT + TAB or UP ARROW. Press SPACE or ENTER to select the list option. Press ESC to close the list-box.'  // MISSING
							},

							{
								name : 'Editor Element Path Bar', // MISSING
								legend :
									'Press ${elementsPathFocus} to navigate to the elements path bar. Move to next element button with TAB or RIGHT ARROW. Move to previous button with  SHIFT+TAB or LEFT ARROW. Press SPACE or ENTER to select the element in editor.'  // MISSING
							}
						]
			},
			{
				name : 'Εντολ',
				items :
						[
							{
								name : ' Εντολ αναρεση',
								legend : 'Πατστε ${undo}'
							},
							{
								name : ' Εντολ επανληψη',
								legend : 'Πατστε ${redo}'
							},
							{
								name : ' Εντολ ντονη γραφ',
								legend : 'Πατστε ${bold}'
							},
							{
								name : ' Εντολ πλγια γραφ',
								legend : 'Πατστε ${italic}'
							},
							{
								name : ' Εντολ υπογρμμιση',
								legend : 'Πατστε ${underline}'
							},
							{
								name : ' Εντολ συνδσμου',
								legend : 'Πατστε ${link}'
							},
							{
								name : ' Εντολ Σμπτηξη Εργαλειοθκη',
								legend : 'Πατστε ${toolbarCollapse}'
							},
							{
								name : ' Βοθεια Προσβασιμτητα',
								legend : 'Πατστε ${a11yHelp}'
							}
						]
			}
		]
	}
});
