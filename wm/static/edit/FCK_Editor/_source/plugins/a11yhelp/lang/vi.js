/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.plugins.setLang( 'a11yhelp', 'vi',
{
	accessibilityHelp :
	{
		title : 'Accessibility Instructions', // MISSING
		contents : 'Ni dung H tr. Nhn ESC d dóng hp thoi.',
		legend :
		[
			{
				name : 'Chung',
				items :
						[
							{
								name : 'Thanh c^ong c son th',
								legend:
									'Nhn ${toolbarFocus} d diu hng dn thanh c^ong c. Nhn TAB và SHIFT-TAB d chuyn dn nhóm thanh c^ong c khác. Nhn M~UI T^EN PHI hoc M~UI T^EN TR'AI d chuyn sang nút khác trên thanh c^ong c. Nhn PH'IM C'ACH hoc ENTER d kích hot nút trên thanh c^ong c.'
							},

							{
								name : 'Hp thoi Biên t',
								legend :
									'Inside a dialog, press TAB to navigate to next dialog field, press SHIFT + TAB to move to previous field, press ENTER to submit dialog, press ESC to cancel dialog. For dialogs that have multiple tab pages, press ALT + F10 to navigate to tab-list. Then move to next tab with TAB OR RIGTH ARROW. Move to previous tab with SHIFT + TAB or LEFT ARROW. Press SPACE or ENTER to select the tab page.'  // MISSING
							},

							{
								name : 'Trình dn Ng cnh cB son tho',
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
				name : 'Commands', // MISSING
				items :
						[
							{
								name : ' Undo command', // MISSING
								legend : 'Press ${undo}' // MISSING
							},
							{
								name : ' Redo command', // MISSING
								legend : 'Press ${redo}' // MISSING
							},
							{
								name : ' Bold command', // MISSING
								legend : 'Press ${bold}' // MISSING
							},
							{
								name : ' Italic command', // MISSING
								legend : 'Press ${italic}' // MISSING
							},
							{
								name : ' Underline command', // MISSING
								legend : 'Press ${underline}' // MISSING
							},
							{
								name : ' Link command', // MISSING
								legend : 'Press ${link}' // MISSING
							},
							{
								name : ' Toolbar Collapse command', // MISSING
								legend : 'Press ${toolbarCollapse}' // MISSING
							},
							{
								name : ' Accessibility Help', // MISSING
								legend : 'Press ${a11yHelp}' // MISSING
							}
						]
			}
		]
	}
});
