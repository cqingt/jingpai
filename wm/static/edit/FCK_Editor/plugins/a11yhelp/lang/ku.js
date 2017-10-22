/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.plugins.setLang( 'a11yhelp', 'ku',
{
	accessibilityHelp :
	{
		title : ' ',
		contents : ' .  ESC    .',
		legend :
		[
			{
				name : '',
				items :
						[
							{
								name : ' ',
								legend:
									' ${toolbarFocus}   .         TAB  SHIFT-TAB.                .   SPACE  ENTER    .'
							},

							{
								name : ' ',
								legend :
									'  ,   TAB     ,   SHIFT + TAB     ,   ENTER   ,   ESC   .    () ,   ALT + F10    .        TAB     .       SHIFT + TAB     .   SPACE  ENTER    ().'
							},

							{
								name : ' ',
								legend :
									' ${contextMenu}   (Menu)    .         TAB             SHIFT+TAB      .   SPACE  ENTER    .          SPACE  ENTER     .        ESC     .      ESC .'
							},

							{
								name : '  ',
								legend :
									'  ,        TAB     .        SHIFT + TAB     .   SPACE  ENTER    .   ESC    .'
							},

							{
								name : ' ',
								legend :
									' ${elementsPathFocus}    .        TAB     .       SHIFT+TAB      .   SPACE  ENTER    .'
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
								name : ' ',
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
								name : ' ',
								legend : ' ${underline}'
							},
							{
								name : ' ',
								legend : ' ${link}'
							},
							{
								name : ' ',
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
