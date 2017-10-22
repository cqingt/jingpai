/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.plugins.setLang( 'a11yhelp', 'he',
{
	accessibilityHelp :
	{
		title : ' ',
		contents : ' .    (ESC).',
		legend :
		[
			{
				name : '',
				items :
						[
							{
								name : ' ',
								legend:
									'  ${toolbarFocus}    .       (TAB)   .       (SHIFT) +  (TAB)   .     (ENTER)     .'
							},

							{
								name : ' ( )',
								legend :
									' ,   (TAB)    ,   (SHIFT) +  (TAB)    ,   (ENTER)    ,   (ESC)  .      (),   (ALT) + F10    .      (TAB)   .      (SHIFT) +  (TAB)   .     (ENTER)   .'
							},

							{
								name : '  (Context Menu)',
								legend :
									' ${contextMenu}  APPLICATION KEY    .      (TAB)   .      (SHIFT) +  (TAB)   .     (ENTER)    .     (Sub-menu)        (ENTER)   .      (ESC)   .       (ESC).'
							},

							{
								name : '  (List boxes)',
								legend :
									'  ,      (TAB)   .      (SHIFT) +  (TAB) or  . Press SPACE or ENTER to select the list option. Press ESC to close the list-box.'
							},

							{
								name : '  (Elements Path)',
								legend :
									' ${elementsPathFocus}    .      (TAB)   .      (SHIFT) +  (TAB)   .     (ENTER)     .'
							}
						]
			},
			{
				name : '',
				items :
						[
							{
								name : '   ',
								legend : ' ${undo}'
							},
							{
								name : '    ',
								legend : ' ${redo}'
							},
							{
								name : ' ',
								legend : ' ${bold}'
							},
							{
								name : ' ',
								legend : ' ${italic}'
							},
							{
								name : '   ',
								legend : ' ${underline}'
							},
							{
								name : '  ',
								legend : ' ${link}'
							},
							{
								name : '   ',
								legend : ' ${toolbarCollapse}'
							},
							{
								name : '  ',
								legend : ' ${a11yHelp}'
							}
						]
			}
		]
	}
});
