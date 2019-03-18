<?php
/** 
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'patiodigital_novo_wp');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '');

/** nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/****** Desativando o sistema de revisões ******/
define('WP_POST_REVISIONS', false );

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '{*_ (P5,y+CjQES%Hx*Y?!4s3T,=^fmOcFz*9S)pJAL,9,?+eh!xpvS?{w4IgE.]');
define('SECURE_AUTH_KEY',  '|&RvN`>1oYz}8`SkmLgK3LK}ASFY;A8!SjY*Pvp%Pv!$YP$(D4ub,+Z+dPyxC0}A');
define('LOGGED_IN_KEY',    'G7n! |rMw8CpeP9qak+4d$%8{@I(RBe4)]@p!f`qxo91hIdzOtS#Xp~C|-v;J]]W');
define('NONCE_KEY',        '/0|(.[cCqnX&`y`.%gz8fDcy8*g]>,V{@$2Ooa(A/H:=QF9.Np!c.UEC[qaRbVYJ');
define('AUTH_SALT',        'IUR]zHse-QP)tDtIR#!6K%)sV<%DqN1JJQz|Eq4a~1SN=`^0m-P{sF&|LJdCG6;K');
define('SECURE_AUTH_SALT', 'PJ=euT(TIRBY-^i#L##:@0mb1z7s|-=5&%lvM<_U9czcegGlx=.+*xq)^woF?[D}');
define('LOGGED_IN_SALT',   'G|/|U,:dg{Ns$<%/RO9!0^gB2m_i:C8$?<6v]hK.|IX)+c6(6_Z!}%{0A1#!.g ,');
define('NONCE_SALT',       '*+!+Q}nUU1hLWcN86#b3fl{D9,nv-SD8mS><,s4Ry(qXTa)CL3E<CR1fG.4k{xd(');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';


/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', false);



/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
