/*
 * CKFinder
 * ========
 * http://ckfinder.com
 * Copyright (C) 2007-2011, CKSource - Frederico Knabben. All rights reserved.
 *
 * The software, this file and its contents are subject to the CKFinder
 * License. Please read the license.txt file before using, installing, copying,
 * modifying or distribute this file or part of its contents. The contents of
 * this file is part of the Source Code of CKFinder.
 *
 */

/**
 * @fileOverview Defines the {@link CKFinder.lang} object, for the Portuguese (Brazilian)
 *		language. This is the base file for all translations.
*/

/**
 * Constains the dictionary of language entries.
 * @namespace
 */
CKFinder.lang['pt-br'] =
{
	appTitle : 'CKFinder',

	// Common messages and labels.
	common :
	{
		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, unavailable</span>', // MISSING
		confirmCancel	: 'Algumas opc~oes foram modificadas. Deseja fechar a janela realmente?',
		ok				: 'OK',
		cancel			: 'Cancelar',
		confirmationTitle	: 'Confirmac~ao',
		messageTitle	: 'Informac~ao',
		inputTitle		: 'Pergunta',
		undo			: 'Desfazer',
		redo			: 'Refazer',
		skip			: 'Skip', // MISSING
		skipAll			: 'Skip all', // MISSING
		makeDecision	: 'What action should be taken?', // MISSING
		rememberDecision: 'Remember my decision' // MISSING
	},


	dir : 'ltr',
	HelpLang : 'en',
	LangCode : 'pt-br',

	// Date Format
	//		d    : Day
	//		dd   : Day (padding zero)
	//		m    : Month
	//		mm   : Month (padding zero)
	//		yy   : Year (two digits)
	//		yyyy : Year (four digits)
	//		h    : Hour (12 hour clock)
	//		hh   : Hour (12 hour clock, padding zero)
	//		H    : Hour (24 hour clock)
	//		HH   : Hour (24 hour clock, padding zero)
	//		M    : Minute
	//		MM   : Minute (padding zero)
	//		a    : Firt char of AM/PM
	//		aa   : AM/PM
	DateTime : 'dd/mm/yyyy HH:MM',
	DateAmPm : ['AM', 'PM'],

	// Folders
	FoldersTitle	: 'Pastas',
	FolderLoading	: 'Carregando...',
	FolderNew		: 'Favor informar o nome da nova pasta: ',
	FolderRename	: 'Favor informar o nome da nova pasta: ',
	FolderDelete	: 'Você tem certeza que deseja apagar a pasta "%1"?',
	FolderRenaming	: ' (Renomeando...)',
	FolderDeleting	: ' (Apagando...)',

	// Files
	FileRename		: 'Favor informar o nome do novo arquivo: ',
	FileRenameExt	: 'Você tem certeza que deseja alterar a extens~ao do arquivo? O arquivo pode ser danificado',
	FileRenaming	: 'Renomeando...',
	FileDelete		: 'Você tem certeza que deseja apagar o arquivo "%1"?',
	FilesLoading	: 'Carregando...',
	FilesEmpty		: 'Pasta vazia',
	FilesMoved		: 'Arquivo %1 movido para %2:%3',
	FilesCopied		: 'Arquivo %1 copiado em %2:%3',

	// Basket
	BasketFolder		: 'Cesta',
	BasketClear			: 'Limpa Cesta',
	BasketRemove		: 'Remove da cesta',
	BasketOpenFolder	: 'Abre a pasta original',
	BasketTruncateConfirm : 'Remover todos os arquivas da cesta?',
	BasketRemoveConfirm	: 'Remover o arquivo "%1" da cesta?',
	BasketEmpty			: 'No files in the basket, drag\'n\'drop some.', // MISSING
	BasketCopyFilesHere	: 'Copia Arquivos da Cesta',
	BasketMoveFilesHere	: 'Move os Arquivos da Cesta',

	BasketPasteErrorOther	: 'File %s error: %e', // MISSING
	BasketPasteMoveSuccess	: 'Os seguintes arquivos foram movidos: %s',
	BasketPasteCopySuccess	: 'Os sequintes arquivos foram copiados: %s',

	// Toolbar Buttons (some used elsewhere)
	Upload		: 'Enviar arquivo',
	UploadTip	: 'Enviar novo arquivo',
	Refresh		: 'Atualizar',
	Settings	: 'Configurac~oes',
	Help		: 'Ajuda',
	HelpTip		: 'Ajuda',

	// Context Menus
	Select			: 'Selecionar',
	SelectThumbnail : 'Selecionar miniatura',
	View			: 'Visualizar',
	Download		: 'Download',

	NewSubFolder	: 'Nova sub-pasta',
	Rename			: 'Renomear',
	Delete			: 'Apagar',

	CopyDragDrop	: 'Copia arquivo aqui',
	MoveDragDrop	: 'Move arquivo aqui',

	// Dialogs
	RenameDlgTitle		: 'Renomeia',
	NewNameDlgTitle		: 'Novo nome',
	FileExistsDlgTitle	: 'O arquivo já existe',
	SysErrorDlgTitle : 'System error', // MISSING

	FileOverwrite	: 'Sobrescrever',
	FileAutorename	: 'Renomeia automaticamente',

	// Generic
	OkBtn		: 'OK',
	CancelBtn	: 'Cancelar',
	CloseBtn	: 'Fechar',

	// Upload Panel
	UploadTitle			: 'Enviar novo arquivo',
	UploadSelectLbl		: 'Selecione o arquivo para enviar',
	UploadProgressLbl	: '(Enviado arquivo, favor aguardar...)',
	UploadBtn			: 'Enviar arquivo selecionado',
	UploadBtnCancel		: 'Cancelar',

	UploadNoFileMsg		: 'Favor selecionar o arquivo no seu computador',
	UploadNoFolder		: 'Favor selecionar a pasta antes the enviar o arquivo.',
	UploadNoPerms		: 'N~ao é permitido o envio de arquivos.',
	UploadUnknError		: 'Erro no envio do arquivo.',
	UploadExtIncorrect	: 'A extens~ao deste arquivo n~ao é permitida nesat pasta.',

	// Settings Panel
	SetTitle		: 'Configurac~oes',
	SetView			: 'Visualizar:',
	SetViewThumb	: 'Miniaturas',
	SetViewList		: 'Lista',
	SetDisplay		: 'Exibir:',
	SetDisplayName	: 'Arquivo',
	SetDisplayDate	: 'Data',
	SetDisplaySize	: 'Tamanho',
	SetSort			: 'Ordenar:',
	SetSortName		: 'por Nome do arquivo',
	SetSortDate		: 'por Data',
	SetSortSize		: 'por Tamanho',

	// Status Bar
	FilesCountEmpty : '<Pasta vazia>',
	FilesCountOne	: '1 arquivo',
	FilesCountMany	: '%1 arquivos',

	// Size and Speed
	Kb				: '%1 kB',
	KbPerSecond		: '%1 kB/s',

	// Connector Error Messages.
	ErrorUnknown	: 'N~ao foi possível completer o seu pedido. (Erro %1)',
	Errors :
	{
	 10 : 'Comando inválido.',
	 11 : 'O tipo de recurso n~ao foi especificado na solicitac~ao.',
	 12 : 'O recurso solicitado n~ao é válido.',
	102 : 'Nome do arquivo ou pasta inválido.',
	103 : 'N~ao foi possível completar a solicitac~ao por restric~oes de acesso.',
	104 : 'N~ao foi possível completar a solicitac~ao por restric~oes de acesso do sistema de arquivos.',
	105 : 'Extens~ao de arquivo inválida.',
	109 : 'Solicitac~ao inválida.',
	110 : 'Erro desconhecido.',
	115 : 'Uma arquivo ou pasta já existe com esse nome.',
	116 : 'Pasta n~ao encontrada. Atualize e tente novamente.',
	117 : 'Arquivo n~ao encontrado. Atualize a lista de arquivos e tente novamente.',
	118 : 'Source and target paths are equal.', // MISSING
	201 : 'Um arquivo com o mesmo nome já está disponível. O arquivo enviado foi renomeado para "%1"',
	202 : 'Arquivo inválido',
	203 : 'Arquivo inválido. O tamanho é muito grande.',
	204 : 'O arquivo enviado está corrompido.',
	205 : 'Nenhuma pasta temporária para envio está disponível no servidor.',
	206 : 'Transmiss~ao cancelada por raz~oes de seguranca. O arquivo contem dados HTML.',
	207 : 'O arquivo enviado foi renomeado para "%1"',
	300 : 'N~ao foi possível mover o(s) arquivo(s).',
	301 : 'N~ao foi possível copiar o(s) arquivos(s).',
	500 : 'A navegac~ao de arquivos está desativada por raz~oes de seguranca. Contacte o administrador do sistema.',
	501 : 'O suporte a miniaturas está desabilitado.'
	},

	// Other Error Messages.
	ErrorMsg :
	{
		FileEmpty		: 'O nome do arquivo n~ao pode ser vazio',
		FileExists		: 'O nome %s já é em uso',
		FolderEmpty		: 'O nome da pasta n~ao pode ser vazio',

		FileInvChar		: 'O nome do arquivo n~ao pode conter nenhum desses caracteres: \n\\ / : * ? " < > |',
		FolderInvChar	: 'O nome da pasta n~ao pode conter nenhum desses caracteres: \n\\ / : * ? " < > |',

		PopupBlockView	: 'N~ao foi possível abrir o arquivo em outra janela. Configure seu navegador e desabilite o bloqueio a popups para esse site.'
	},

	// Imageresize plugin
	Imageresize :
	{
		dialogTitle		: 'Redimensionar %s',
		sizeTooBig		: 'N~ao possível usar dimens~oes maiores do que as originais (%size).',
		resizeSuccess	: 'Imagem redimensionada corretamente.',
		thumbnailNew	: 'Cria nova anteprima',
		thumbnailSmall	: 'Pequeno (%s)',
		thumbnailMedium	: 'Médio (%s)',
		thumbnailLarge	: 'Grande (%s)',
		newSize			: 'Novas dimens~oes',
		width			: 'Largura',
		height			: 'Altura',
		invalidHeight	: 'Altura incorreta.',
		invalidWidth	: 'Largura incorreta.',
		invalidName		: 'O nome do arquivo n~ao é válido.',
		newImage		: 'Cria nova imagem',
		noExtensionChange : 'A extens~ao do arquivo n~ao pode ser modificada.',
		imageSmall		: 'A imagem original é muito pequena',
		contextMenuName	: 'Redimensionar'
	},

	// Fileeditor plugin
	Fileeditor :
	{
		save			: 'Salva',
		fileOpenError	: 'N~ao é possível abrir o arquivo.',
		fileSaveSuccess	: 'Arquivo salvado corretamente.',
		contextMenuName	: 'Modificar',
		loadingFile		: 'Carregando arquivo. Por favor aguarde...'
	}
};
