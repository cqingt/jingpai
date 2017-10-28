/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.plugins.setLang( 'a11yhelp', 'ug',
{
	accessibilityHelp :
	{
		title : ' ',
		contents : ' .     ESC  .',
		legend :
		[
			{
				name : '',
				items :
						[
							{
								name : '  ',
								legend:
									'${toolbarFocus}     TAB  SHIFT+TAB              Enter    .'
							},

							{
								name : ' ',
								legend :
									'Inside a dialog, press TAB to navigate to next dialog field, press SHIFT + TAB to move to previous field, press ENTER to submit dialog, press ESC to cancel dialog. For dialogs that have multiple tab pages, press ALT + F10 to navigate to tab-list. Then move to next tab with TAB OR RIGTH ARROW. Move to previous tab with SHIFT + TAB or LEFT ARROW. Press SPACE or ENTER to select the tab page.'  // MISSING
							},

							{
								name : '   ',
								legend :
									'Press ${contextMenu} or APPLICATION KEY to open context-menu. Then move to next menu option with TAB or DOWN ARROW. Move to previous option with SHIFT+TAB or UP ARROW. Press SPACE or ENTER to select the menu option. Open sub-menu of current option with SPACE or ENTER or RIGHT ARROW. Go back to parent menu item with ESC or LEFT ARROW. Close context menu with ESC.'  // MISSING
							},

							{
								name : ' ',
								legend :
									'Inside a list-box, move to next list item with TAB OR DOWN ARROW. Move to previous list item with SHIFT + TAB or UP ARROW. Press SPACE or ENTER to select the list option. Press ESC to close the list-box.'  // MISSING
							},

							{
								name : '   ',
								legend :
									'${elementsPathFocus}      TAB         SHIFT+TAB           Enter    .'
							}
						]
			},
			{
				name : '',
				items :
						[
							{
								name : ' ',
								legend : '${undo}  '
							},
							{
								name : ' ',
								legend : '${redo}  '
							},
							{
								name : ' ',
								legend : '${bold}  '
							},
							{
								name : ' ',
								legend : '${italic}  '
							},
							{
								name : '  ',
								legend : '${underline}  '
							},
							{
								name : ' ',
								legend : '${link}  '
							},
							{
								name : '   ',
								legend : '${toolbarCollapse}  '
							},
							{
								name : '  ',
								legend : '${a11yHelp}  '
							}
						]
			}
		]
	}
});