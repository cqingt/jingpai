/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.plugins.setLang( 'a11yhelp', 'fa',
{
	accessibilityHelp :
	{
		title : ' ',
		contents : '  .      ESC   .',
		legend :
		[
			{
				name : '',
				items :
						[
							{
								name : '  ',
								legend:
									'${toolbarFocus}       .   Tab  Shif-Tab         .                 .  Space  Enter        .'
							},

							{
								name : '  ',
								legend :
									'      Tab        Shift+Tab       Enter      Esc             Alt+F10    Tab-List.        Tab    .      Shift+Tab    .  Space  Enter    .'
							},

							{
								name : '  ',
								legend :
									'${contextMenu}            .           Tab       .      Shift+Tab    .  Space  Enter      .          Space  Enter       .       Esc    .     Esc.'
							},

							{
								name : '  ',
								legend :
									'            TAB   Arrow Down  .           SHIFT + TAB  UP ARROW.  Space  ENTER      .  ESC      .'
							},

							{
								name : '   ',
								legend :
									'     ${elementsPathFocus}  .        Tab     .      Shift+Tab    .  Space  Enter      .'
							}
						]
			},
			{
				name : '',
				items :
						[
							{
								name : ' ',
								legend : ' ${undo}'
							},
							{
								name : '  ',
								legend : ' ${redo}'
							},
							{
								name : '  ',
								legend : ' ${bold}'
							},
							{
								name : '  ',
								legend : ' ${italic}'
							},
							{
								name : '  ',
								legend : ' ${underline}'
							},
							{
								name : ' ',
								legend : ' ${link}'
							},
							{
								name : '   ',
								legend : ' ${toolbarCollapse}'
							},
							{
								name : ' ',
								legend : ' ${a11yHelp}'
							}
						]
			}
		]
	}
});
