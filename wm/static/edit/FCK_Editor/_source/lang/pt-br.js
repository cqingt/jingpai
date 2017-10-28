/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
* @fileOverview
*/

/**#@+
   @type String
   @example
*/

/**
 * Contains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['pt-br'] =
{
	/**
	 * The language reading direction. Possible values are "rtl" for
	 * Right-To-Left languages (like Arabic) and "ltr" for Left-To-Right
	 * languages (like English).
	 * @default 'ltr'
	 */
	dir : 'ltr',

	/*
	 * Screenreader titles. Please note that screenreaders are not always capable
	 * of reading non-English words. So be careful while translating it.
	 */
	editorTitle : 'Editor de texto rico, %1',
	editorHelp : 'Pressione ALT+0 para ajuda',

	// ARIA descriptions.
	toolbars	: 'Barra de Ferramentas do Editor',
	editor		: 'Editor de Texto',

	// Toolbar buttons without dialogs.
	source			: 'Código-Fonte',
	newPage			: 'Novo',
	save			: 'Salvar',
	preview			: 'Visualizar',
	cut				: 'Recortar',
	copy			: 'Copiar',
	paste			: 'Colar',
	print			: 'Imprimir',
	underline		: 'Sublinhado',
	bold			: 'Negrito',
	italic			: 'Itálico',
	selectAll		: 'Selecionar Tudo',
	removeFormat	: 'Remover Formatac~ao',
	strike			: 'Tachado',
	subscript		: 'Subscrito',
	superscript		: 'Sobrescrito',
	horizontalrule	: 'Inserir Linha Horizontal',
	pagebreak		: 'Inserir Quebra de Página',
	pagebreakAlt		: 'Quebra de Página',
	unlink			: 'Remover Link',
	undo			: 'Desfazer',
	redo			: 'Refazer',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Localizar no Servidor',
		url				: 'URL',
		protocol		: 'Protocolo',
		upload			: 'Enviar ao Servidor',
		uploadSubmit	: 'Enviar para o Servidor',
		image			: 'Imagem',
		flash			: 'Flash',
		form			: 'Formulário',
		checkbox		: 'Caixa de Selec~ao',
		radio			: 'Bot~ao de Opc~ao',
		textField		: 'Caixa de Texto',
		textarea		: ''Area de Texto',
		hiddenField		: 'Campo Oculto',
		button			: 'Bot~ao',
		select			: 'Caixa de Listagem',
		imageButton		: 'Bot~ao de Imagem',
		notSet			: '<n~ao ajustado>',
		id				: 'Id',
		name			: 'Nome',
		langDir			: 'Direc~ao do idioma',
		langDirLtr		: 'Esquerda para Direita (LTR)',
		langDirRtl		: 'Direita para Esquerda (RTL)',
		langCode		: 'Idioma',
		longDescr		: 'Descric~ao da URL',
		cssClass		: 'Classe de CSS',
		advisoryTitle	: 'Título',
		cssStyle		: 'Estilos',
		ok				: 'OK',
		cancel			: 'Cancelar',
		close			: 'Fechar',
		preview			: 'Visualizar',
		generalTab		: 'Geral',
		advancedTab		: 'Avancado',
		validateNumberFailed : 'Este valor n~ao é um número.',
		confirmNewPage	: 'Todas as mudancas n~ao salvas ser~ao perdidas. Tem certeza de que quer abrir uma nova página?',
		confirmCancel	: 'Algumas opc~oes foram alteradas. Tem certeza de que quer fechar a caixa de diálogo?',
		options			: 'Opc~oes',
		target			: 'Destino',
		targetNew		: 'Nova Janela (_blank)',
		targetTop		: 'Janela de Cima (_top)',
		targetSelf		: 'Mesma Janela (_self)',
		targetParent	: 'Janela Pai (_parent)',
		langDirLTR		: 'Esquerda para Direita (LTR)',
		langDirRTL		: 'Direita para Esquerda (RTL)',
		styles			: 'Estilo',
		cssClasses		: 'Classes',
		width			: 'Largura',
		height			: 'Altura',
		align			: 'Alinhamento',
		alignLeft		: 'Esquerda',
		alignRight		: 'Direita',
		alignCenter		: 'Centralizado',
		alignTop		: 'Superior',
		alignMiddle		: 'Centralizado',
		alignBottom		: 'Inferior',
		invalidValue	: 'Valor inválido.',
		invalidHeight	: 'A altura tem que ser um número',
		invalidWidth	: 'A largura tem que ser um número.',
		invalidCssLength	: 'O valor do campo "%1" deve ser um número positivo opcionalmente seguido por uma válida unidade de medida de CSS (px, %, in, cm, mm, em, ex, pt, or pc).',
		invalidHtmlLength	: 'O valor do campo "%1" deve ser um número positivo opcionalmente seguido por uma válida unidade de medida de HTML (px or %).',
		invalidInlineStyle	: 'O valor válido para estilo deve conter uma ou mais tuplas no formato "nome : valor", separados por ponto e vírgula.',
		cssLengthTooltip	: 'Insira um número para valor em pixels ou um número seguido de uma válida unidade de medida de CSS (px, %, in, cm, mm, em, ex, pt, or pc).',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, indisponível</span>'
	},

	contextmenu :
	{
		options : 'Opc~oes Menu de Contexto'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Inserir Caractere Especial',
		title		: 'Selecione um Caractere Especial',
		options : 'Opc~oes de Caractere Especial'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Inserir/Editar Link',
		other 		: '<outro>',
		menu		: 'Editar Link',
		title		: 'Editar Link',
		info		: 'Informac~oes',
		target		: 'Destino',
		upload		: 'Enviar ao Servidor',
		advanced	: 'Avancado',
		type		: 'Tipo de hiperlink',
		toUrl		: 'URL',
		toAnchor	: '^Ancora nesta página',
		toEmail		: 'E-Mail',
		targetFrame		: '<frame>',
		targetPopup		: '<janela popup>',
		targetFrameName	: 'Nome do Frame de Destino',
		targetPopupName	: 'Nome da Janela Pop-up',
		popupFeatures	: 'Propriedades da Janela Pop-up',
		popupResizable	: 'Redimensionável',
		popupStatusBar	: 'Barra de Status',
		popupLocationBar: 'Barra de Enderecos',
		popupToolbar	: 'Barra de Ferramentas',
		popupMenuBar	: 'Barra de Menus',
		popupFullScreen	: 'Modo Tela Cheia (IE)',
		popupScrollBars	: 'Barras de Rolagem',
		popupDependent	: 'Dependente (Netscape)',
		popupLeft		: 'Esquerda',
		popupTop		: 'Topo',
		id				: 'Id',
		langDir			: 'Direc~ao do idioma',
		langDirLTR		: 'Esquerda para Direita (LTR)',
		langDirRTL		: 'Direita para Esquerda (RTL)',
		acccessKey		: 'Chave de Acesso',
		name			: 'Nome',
		langCode			: 'Direc~ao do idioma',
		tabIndex			: ''Indice de Tabulac~ao',
		advisoryTitle		: 'Título',
		advisoryContentType	: 'Tipo de Conteúdo',
		cssClasses		: 'Classe de CSS',
		charset			: 'Charset do Link',
		styles			: 'Estilos',
		rel			: 'Tipo de Relac~ao',
		selectAnchor		: 'Selecione uma ^ancora',
		anchorName		: 'Nome da ^ancora',
		anchorId			: 'Id da ^ancora',
		emailAddress		: 'Endereco E-Mail',
		emailSubject		: 'Assunto da Mensagem',
		emailBody		: 'Corpo da Mensagem',
		noAnchors		: '(N~ao há ^ancoras no documento)',
		noUrl			: 'Por favor, digite o endereco do Link',
		noEmail			: 'Por favor, digite o endereco de e-mail'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Inserir/Editar ^Ancora',
		menu		: 'Formatar ^Ancora',
		title		: 'Formatar ^Ancora',
		name		: 'Nome da ^Ancora',
		errorName	: 'Por favor, digite o nome da ^ancora',
		remove		: 'Remover ^Ancora'
	},

	// List style dialog
	list:
	{
		numberedTitle		: 'Propriedades da Lista Numerada',
		bulletedTitle		: 'Propriedades da Lista sem Numeros',
		type				: 'Tipo',
		start				: 'Início',
		validateStartNumber				:'O número inicial da lista deve ser um número inteiro.',
		circle				: 'Círculo',
		disc				: 'Disco',
		square				: 'Quadrado',
		none				: 'Nenhum',
		notset				: '<n~ao definido>',
		armenian			: 'Numerac~ao Armêna',
		georgian			: 'Numerac~ao da Geórgia (an, ban, gan, etc.)',
		lowerRoman			: 'Numerac~ao Romana minúscula (i, ii, iii, iv, v, etc.)',
		upperRoman			: 'Numerac~ao Romana maiúscula (I, II, III, IV, V, etc.)',
		lowerAlpha			: 'Numerac~ao Alfabética minúscula (a, b, c, d, e, etc.)',
		upperAlpha			: 'Numerac~ao Alfabética Maiúscula (A, B, C, D, E, etc.)',
		lowerGreek			: 'Numerac~ao Grega minúscula (alpha, beta, gamma, etc.)',
		decimal				: 'Numerac~ao Decimal (1, 2, 3, etc.)',
		decimalLeadingZero	: 'Numerac~ao Decimal com zeros (01, 02, 03, etc.)'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Localizar e Substituir',
		find				: 'Localizar',
		replace				: 'Substituir',
		findWhat			: 'Procurar por:',
		replaceWith			: 'Substituir por:',
		notFoundMsg			: 'O texto especificado n~ao foi encontrado.',
		findOptions			: 'Opc~oes',
		matchCase			: 'Coincidir Maiúsculas/Minúsculas',
		matchWord			: 'Coincidir a palavra inteira',
		matchCyclic			: 'Coincidir cíclico',
		replaceAll			: 'Substituir Tudo',
		replaceSuccessMsg	: '%1 ocorrência(s) substituída(s).'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Tabela',
		title		: 'Formatar Tabela',
		menu		: 'Formatar Tabela',
		deleteTable	: 'Apagar Tabela',
		rows		: 'Linhas',
		columns		: 'Colunas',
		border		: 'Borda',
		widthPx		: 'pixels',
		widthPc		: '%',
		widthUnit	: 'unidade largura',
		cellSpace	: 'Espacamento',
		cellPad		: 'Margem interna',
		caption		: 'Legenda',
		summary		: 'Resumo',
		headers		: 'Cabecalho',
		headersNone		: 'Nenhum',
		headersColumn	: 'Primeira coluna',
		headersRow		: 'Primeira linha',
		headersBoth		: 'Ambos',
		invalidRows		: 'O número de linhas tem que ser um número maior que 0.',
		invalidCols		: 'O número de colunas tem que ser um número maior que 0.',
		invalidBorder	: 'O tamanho da borda tem que ser um número.',
		invalidWidth	: 'A largura da tabela tem que ser um número.',
		invalidHeight	: 'A altura da tabela tem que ser um número.',
		invalidCellSpacing	: 'O espacamento das células tem que ser um número.',
		invalidCellPadding	: 'A margem interna das células tem que ser um número.',

		cell :
		{
			menu			: 'Célula',
			insertBefore	: 'Inserir célula a esquerda',
			insertAfter		: 'Inserir célula a direita',
			deleteCell		: 'Remover Células',
			merge			: 'Mesclar Células',
			mergeRight		: 'Mesclar com célula a direita',
			mergeDown		: 'Mesclar com célula abaixo',
			splitHorizontal	: 'Dividir célula horizontalmente',
			splitVertical	: 'Dividir célula verticalmente',
			title			: 'Propriedades da célula',
			cellType		: 'Tipo de célula',
			rowSpan			: 'Linhas cobertas',
			colSpan			: 'Colunas cobertas',
			wordWrap		: 'Quebra de palavra',
			hAlign			: 'Alinhamento horizontal',
			vAlign			: 'Alinhamento vertical',
			alignBaseline	: 'Patamar de alinhamento',
			bgColor			: 'Cor de fundo',
			borderColor		: 'Cor das bordas',
			data			: 'Dados',
			header			: 'Cabecalho',
			yes				: 'Sim',
			no				: 'N~ao',
			invalidWidth	: 'A largura da célula tem que ser um número.',
			invalidHeight	: 'A altura da célula tem que ser um número.',
			invalidRowSpan	: 'Linhas cobertas tem que ser um número inteiro.',
			invalidColSpan	: 'Colunas cobertas tem que ser um número inteiro.',
			chooseColor		: 'Escolher'
		},

		row :
		{
			menu			: 'Linha',
			insertBefore	: 'Inserir linha acima',
			insertAfter		: 'Inserir linha abaixo',
			deleteRow		: 'Remover Linhas'
		},

		column :
		{
			menu			: 'Coluna',
			insertBefore	: 'Inserir coluna a esquerda',
			insertAfter		: 'Inserir coluna a direita',
			deleteColumn	: 'Remover Colunas'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Formatar Bot~ao',
		text		: 'Texto (Valor)',
		type		: 'Tipo',
		typeBtn		: 'Bot~ao',
		typeSbm		: 'Enviar',
		typeRst		: 'Limpar'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Formatar Caixa de Selec~ao',
		radioTitle	: 'Formatar Bot~ao de Opc~ao',
		value		: 'Valor',
		selected	: 'Selecionado'
	},

	// Form Dialog.
	form :
	{
		title		: 'Formatar Formulário',
		menu		: 'Formatar Formulário',
		action		: 'Ac~ao',
		method		: 'Método',
		encoding	: 'Codificac~ao'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Formatar Caixa de Listagem',
		selectInfo	: 'Informac~oes',
		opAvail		: 'Opc~oes disponíveis',
		value		: 'Valor',
		size		: 'Tamanho',
		lines		: 'linhas',
		chkMulti	: 'Permitir múltiplas selec~oes',
		opText		: 'Texto',
		opValue		: 'Valor',
		btnAdd		: 'Adicionar',
		btnModify	: 'Modificar',
		btnUp		: 'Para cima',
		btnDown		: 'Para baixo',
		btnSetValue : 'Definir como selecionado',
		btnDelete	: 'Remover'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Formatar 'Area de Texto',
		cols		: 'Colunas',
		rows		: 'Linhas'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Formatar Caixa de Texto',
		name		: 'Nome',
		value		: 'Valor',
		charWidth	: 'Comprimento (em caracteres)',
		maxChars	: 'Número Máximo de Caracteres',
		type		: 'Tipo',
		typeText	: 'Texto',
		typePass	: 'Senha'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Formatar Campo Oculto',
		name	: 'Nome',
		value	: 'Valor'
	},

	// Image Dialog.
	image :
	{
		title		: 'Formatar Imagem',
		titleButton	: 'Formatar Bot~ao de Imagem',
		menu		: 'Formatar Imagem',
		infoTab		: 'Informac~oes da Imagem',
		btnUpload	: 'Enviar para o Servidor',
		upload		: 'Enviar',
		alt			: 'Texto Alternativo',
		lockRatio	: 'Travar Proporc~oes',
		resetSize	: 'Redefinir para o Tamanho Original',
		border		: 'Borda',
		hSpace		: 'HSpace',
		vSpace		: 'VSpace',
		alertUrl	: 'Por favor, digite a URL da imagem.',
		linkTab		: 'Link',
		button2Img	: 'Deseja transformar o bot~ao de imagem em uma imagem comum?',
		img2Button	: 'Deseja transformar a imagem em um bot~ao de imagem?',
		urlMissing	: 'URL da imagem está faltando.',
		validateBorder	: 'A borda deve ser um número inteiro.',
		validateHSpace	: 'O HSpace deve ser um número inteiro.',
		validateVSpace	: 'O VSpace deve ser um número inteiro.'
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Propriedades do Flash',
		propertiesTab	: 'Propriedades',
		title			: 'Propriedades do Flash',
		chkPlay			: 'Tocar Automaticamente',
		chkLoop			: 'Tocar Infinitamente',
		chkMenu			: 'Habilita Menu Flash',
		chkFull			: 'Permitir tela cheia',
 		scale			: 'Escala',
		scaleAll		: 'Mostrar tudo',
		scaleNoBorder	: 'Sem Borda',
		scaleFit		: 'Escala Exata',
		access			: 'Acesso ao script',
		accessAlways	: 'Sempre',
		accessSameDomain: 'Acessar Mesmo Domínio',
		accessNever		: 'Nunca',
		alignAbsBottom	: 'Inferior Absoluto',
		alignAbsMiddle	: 'Centralizado Absoluto',
		alignBaseline	: 'Baseline',
		alignTextTop	: 'Superior Absoluto',
		quality			: 'Qualidade',
		qualityBest		: 'Qualidade Melhor',
		qualityHigh		: 'Qualidade Alta',
		qualityAutoHigh	: 'Qualidade Alta Automática',
		qualityMedium	: 'Qualidade Média',
		qualityAutoLow	: 'Qualidade Baixa Automática',
		qualityLow		: 'Qualidade Baixa',
		windowModeWindow: 'Janela',
		windowModeOpaque: 'Opaca',
		windowModeTransparent : 'Transparente',
		windowMode		: 'Modo da janela',
		flashvars		: 'Variáveis do Flash',
		bgcolor			: 'Cor do Plano de Fundo',
		hSpace			: 'HSpace',
		vSpace			: 'VSpace',
		validateSrc		: 'Por favor, digite o endereco do link',
		validateHSpace	: 'O HSpace tem que ser um número',
		validateVSpace	: 'O VSpace tem que ser um número.'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Verificar Ortografia',
		title			: 'Corretor Ortográfico',
		notAvailable	: 'Desculpe, o servico n~ao está disponível no momento.',
		errorLoading	: 'Erro carregando servidor de aplicac~ao: %s.',
		notInDic		: 'N~ao encontrada',
		changeTo		: 'Alterar para',
		btnIgnore		: 'Ignorar uma vez',
		btnIgnoreAll	: 'Ignorar Todas',
		btnReplace		: 'Alterar',
		btnReplaceAll	: 'Alterar Todas',
		btnUndo			: 'Desfazer',
		noSuggestions	: '-sem sugest~oes de ortografia-',
		progress		: 'Verificac~ao ortográfica em andamento...',
		noMispell		: 'Verificac~ao encerrada: N~ao foram encontrados erros de ortografia',
		noChanges		: 'Verificac~ao ortográfica encerrada: N~ao houve alterac~oes',
		oneChange		: 'Verificac~ao ortográfica encerrada: Uma palavra foi alterada',
		manyChanges		: 'Verificac~ao ortográfica encerrada: %1 palavras foram alteradas',
		ieSpellDownload	: 'A verificac~ao ortográfica n~ao foi instalada. Você gostaria de realizar o download agora?'
	},

	smiley :
	{
		toolbar	: 'Emoticon',
		title	: 'Inserir Emoticon',
		options : 'Opc~oes de Emoticons'
	},

	elementsPath :
	{
		eleLabel : 'Caminho dos Elementos',
		eleTitle : 'Elemento %1'
	},

	numberedlist	: 'Lista numerada',
	bulletedlist	: 'Lista sem números',
	indent			: 'Aumentar Recuo',
	outdent			: 'Diminuir Recuo',

	justify :
	{
		left	: 'Alinhar Esquerda',
		center	: 'Centralizar',
		right	: 'Alinhar Direita',
		block	: 'Justificado'
	},

	blockquote : 'Citac~ao',

	clipboard :
	{
		title		: 'Colar',
		cutError	: 'As configurac~oes de seguranca do seu navegador n~ao permitem que o editor execute operac~oes de recortar automaticamente. Por favor, utilize o teclado para recortar (Ctrl/Cmd+X).',
		copyError	: 'As configurac~oes de seguranca do seu navegador n~ao permitem que o editor execute operac~oes de copiar automaticamente. Por favor, utilize o teclado para copiar (Ctrl/Cmd+C).',
		pasteMsg	: 'Transfira o link usado na caixa usando o teclado com (<STRONG>Ctrl/Cmd+V</STRONG>) e <STRONG>OK</STRONG>.',
		securityMsg	: 'As configurac~oes de seguranca do seu navegador n~ao permitem que o editor acesse os dados da área de transferência diretamente. Por favor cole o conteúdo manualmente nesta janela.',
		pasteArea	: ''Area para Colar'
	},

	pastefromword :
	{
		confirmCleanup	: 'O texto que você deseja colar parece ter sido copiado do Word. Você gostaria de remover a formatac~ao antes de colar?',
		toolbar			: 'Colar do Word',
		title			: 'Colar do Word',
		error			: 'N~ao foi possível limpar os dados colados devido a um erro interno'
	},

	pasteText :
	{
		button	: 'Colar como Texto sem Formatac~ao',
		title	: 'Colar como Texto sem Formatac~ao'
	},

	templates :
	{
		button			: 'Modelos de layout',
		title			: 'Modelo de layout de conteúdo',
		options : 'Opc~oes de Template',
		insertOption	: 'Substituir o conteúdo atual',
		selectPromptMsg	: 'Selecione um modelo de layout para ser aberto no editor<br>(o conteúdo atual será perdido):',
		emptyListMsg	: '(N~ao foram definidos modelos de layout)'
	},

	showBlocks : 'Mostrar blocos de código',

	stylesCombo :
	{
		label		: 'Estilo',
		panelTitle	: 'Estilos de Formatac~ao',
		panelTitle1	: 'Estilos de bloco',
		panelTitle2	: 'Estilos de texto corrido',
		panelTitle3	: 'Estilos de objeto'
	},

	format :
	{
		label		: 'Formatac~ao',
		panelTitle	: 'Formatac~ao',

		tag_p		: 'Normal',
		tag_pre		: 'Formatado',
		tag_address	: 'Endereco',
		tag_h1		: 'Título 1',
		tag_h2		: 'Título 2',
		tag_h3		: 'Título 3',
		tag_h4		: 'Título 4',
		tag_h5		: 'Título 5',
		tag_h6		: 'Título 6',
		tag_div		: 'Normal (DIV)'
	},

	div :
	{
		title				: 'Criar Container de DIV',
		toolbar				: 'Criar Container de DIV',
		cssClassInputLabel	: 'Classes de CSS',
		styleSelectLabel	: 'Estilo',
		IdInputLabel		: 'Id',
		languageCodeInputLabel	: 'Código de Idioma',
		inlineStyleInputLabel	: 'Estilo Inline',
		advisoryTitleInputLabel	: 'Título Consulta',
		langDirLabel		: 'Direc~ao da Escrita',
		langDirLTRLabel		: 'Esquerda para Direita (LTR)',
		langDirRTLLabel		: 'Direita para Esquerda (RTL)',
		edit				: 'Editar Div',
		remove				: 'Remover Div'
  	},

	iframe :
	{
		title		: 'Propriedade do IFrame',
		toolbar		: 'IFrame',
		noUrl		: 'Insira a URL do iframe',
		scrolling	: 'Abilita scrollbars',
		border		: 'Mostra borda do iframe'
	},

	font :
	{
		label		: 'Fonte',
		voiceLabel	: 'Fonte',
		panelTitle	: 'Fonte'
	},

	fontSize :
	{
		label		: 'Tamanho',
		voiceLabel	: 'Tamanho da fonte',
		panelTitle	: 'Tamanho'
	},

	colorButton :
	{
		textColorTitle	: 'Cor do Texto',
		bgColorTitle	: 'Cor do Plano de Fundo',
		panelTitle		: 'Cores',
		auto			: 'Automático',
		more			: 'Mais Cores...'
	},

	colors :
	{
		'000' : 'Preto',
		'800000' : 'Foquete',
		'8B4513' : 'Marrom 1',
		'2F4F4F' : 'Cinza 1',
		'008080' : 'Cerceta',
		'000080' : 'Azul Marinho',
		'4B0082' : ''Indigo',
		'696969' : 'Cinza 2',
		'B22222' : 'Tijolo de Fogo',
		'A52A2A' : 'Marrom 2',
		'DAA520' : 'Vara Dourada',
		'006400' : 'Verde Escuro',
		'40E0D0' : 'Turquesa',
		'0000CD' : 'Azul Médio',
		'800080' : 'Roxo',
		'808080' : 'Cinza 3',
		'F00' : 'Vermelho',
		'FF8C00' : 'Laranja Escuro',
		'FFD700' : 'Dourado',
		'008000' : 'Verde',
		'0FF' : 'Ciano',
		'00F' : 'Azul',
		'EE82EE' : 'Violeta',
		'A9A9A9' : 'Cinza Escuro',
		'FFA07A' : 'Salm~ao Claro',
		'FFA500' : 'Laranja',
		'FFFF00' : 'Amarelo',
		'00FF00' : 'Lima',
		'AFEEEE' : 'Turquesa Pálido',
		'ADD8E6' : 'Azul Claro',
		'DDA0DD' : 'Ameixa',
		'D3D3D3' : 'Cinza Claro',
		'FFF0F5' : 'Lavanda 1',
		'FAEBD7' : 'Branco Antiguidade',
		'FFFFE0' : 'Amarelo Claro',
		'F0FFF0' : 'Orvalho',
		'F0FFFF' : 'Azure',
		'F0F8FF' : 'Azul Alice',
		'E6E6FA' : 'Lavanda 2',
		'FFF' : 'Branco'
	},

	scayt :
	{
		title			: 'Correc~ao ortográfica durante a digitac~ao',
		opera_title		: 'N~ao suportado no Opera',
		enable			: 'Habilitar correc~ao ortográfica durante a digitac~ao',
		disable			: 'Desabilitar correc~ao ortográfica durante a digitac~ao',
		about			: 'Sobre a correc~ao ortográfica durante a digitac~ao',
		toggle			: 'Ativar/desativar correc~ao ortográfica durante a digitac~ao',
		options			: 'Opc~oes',
		langs			: 'Idiomas',
		moreSuggestions	: 'Mais sugest~oes',
		ignore			: 'Ignorar',
		ignoreAll		: 'Ignorar todas',
		addWord			: 'Adicionar palavra',
		emptyDic		: 'O nome do dicionário n~ao deveria estar vazio.',

		optionsTab		: 'Opc~oes',
		allCaps			: 'Ignorar palavras maiúsculas',
		ignoreDomainNames : 'Ignorar nomes de domínio',
		mixedCase		: 'Ignorar palavras com maiúsculas e minúsculas misturadas',
		mixedWithDigits	: 'Ignorar palavras com números',

		languagesTab	: 'Idiomas',

		dictionariesTab	: 'Dicionários',
		dic_field_name	: 'Nome do Dicionário',
		dic_create		: 'Criar',
		dic_restore		: 'Restaurar',
		dic_delete		: 'Excluir',
		dic_rename		: 'Renomear',
		dic_info		: 'Inicialmente, o dicionário do usuário fica armazenado em um Cookie. Porém, Cookies tem tamanho limitado, portanto quand o dicionário do usuário atingir o tamanho limite poderá ser armazenado no nosso servidor. Para armazenar seu dicionário pessoal no nosso servidor deverá especificar um nome para ele. Se já tiver um dicionário armazenado por favor especifique o seu nome e clique em Restaurar.',

		aboutTab		: 'Sobre'
	},

	about :
	{
		title		: 'Sobre o CKEditor',
		dlgTitle	: 'Sobre o CKEditor',
		help	: 'Verifique o $1 para obter ajuda.',
		userGuide : 'Guia do Usuário do CKEditor',
		moreInfo	: 'Para informac~oes sobre a licenca por favor visite o nosso site:',
		copy		: 'Copyright &copy; $1. Todos os direitos reservados.'
	},

	maximize : 'Maximizar',
	minimize : 'Minimize',

	fakeobjects :
	{
		anchor		: '^Ancora',
		flash		: 'Animac~ao em Flash',
		iframe		: 'IFrame',
		hiddenfield	: 'Campo Oculto',
		unknown		: 'Objeto desconhecido'
	},

	resize : 'Arraste para redimensionar',

	colordialog :
	{
		title		: 'Selecione uma Cor',
		options	:	'Opc~oes de Cor',
		highlight	: 'Grifar',
		selected	: 'Cor Selecionada',
		clear		: 'Limpar'
	},

	toolbarCollapse	: 'Diminuir Barra de Ferramentas',
	toolbarExpand	: 'Aumentar Barra de Ferramentas',

	toolbarGroups :
	{
		document : 'Documento',
		clipboard : 'Clipboard/Desfazer',
		editing : 'Edic~ao',
		forms : 'Formulários',
		basicstyles : 'Estilos Básicos',
		paragraph : 'Paragrafo',
		links : 'Links',
		insert : 'Inserir',
		styles : 'Estilos',
		colors : 'Cores',
		tools : 'Ferramentas'
	},

	bidi :
	{
		ltr : 'Direc~ao do texto da esquerda para a direita',
		rtl : 'Direc~ao do texto da direita para a esquerda'
	},

	docprops :
	{
		label : 'Propriedades Documento',
		title : 'Propriedades Documento',
		design : 'Design',
		meta : 'Meta Dados',
		chooseColor : 'Escolher',
		other : '<outro>',
		docTitle :	'Título da Página',
		charset : 	'Codificac~ao de Caracteres',
		charsetOther : 'Outra Codificac~ao de Caracteres',
		charsetASCII : 'ASCII',
		charsetCE : 'Europa Central',
		charsetCT : 'Chinês Tradicional (Big5)',
		charsetCR : 'Cirílico',
		charsetGR : 'Grego',
		charsetJP : 'Japonês',
		charsetKR : 'Coreano',
		charsetTR : 'Turco',
		charsetUN : 'Unicode (UTF-8)',
		charsetWE : 'Europa Ocidental',
		docType : 'Cabecalho Tipo de Documento',
		docTypeOther : 'Outro Tipo de Documento',
		xhtmlDec : 'Incluir Declarac~oes XHTML',
		bgColor : 'Cor do Plano de Fundo',
		bgImage : 'URL da Imagem de Plano de Fundo',
		bgFixed : 'Plano de Fundo Fixo',
		txtColor : 'Cor do Texto',
		margin : 'Margens da Página',
		marginTop : 'Superior',
		marginLeft : 'Inferior',
		marginRight : 'Direita',
		marginBottom : 'Inferior',
		metaKeywords : 'Palavras-chave de Indexac~ao do Documento (separadas por vírgula)',
		metaDescription : 'Descric~ao do Documento',
		metaAuthor : 'Autor',
		metaCopyright : 'Direitos Autorais',
		previewHtml : '<p>Este é um <strong>texto de exemplo</strong>. Você está usando <a href="javascript:void(0)">CKEditor</a>.</p>'
	}
};