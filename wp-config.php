<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
if (stristr($_SERVER['HTTP_HOST'], 'local') == 'local') {
    define( 'DB_NAME', 'project_bal' );

    /** Имя пользователя MySQL */
    define( 'DB_USER', 'mysql' );

    /** Пароль к базе данных MySQL */
    define( 'DB_PASSWORD', 'mysql' );

}
else {
    define('DB_NAME', 'opad');
    /** MySQL database username */
    define('DB_USER', 'opad2016');
    /** MySQL database password */
    define('DB_PASSWORD', 'opad2016');
    define('WP_DEBUG', false);
}
/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );
/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

//global $locale;
//$locale = 'uk_UA';

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'NX~iXOHA3V&(p9]|(Zbay$e#yj_xWT6Bwgdy,.{b1Yu[?5]%zj:.WY.bCdmc4QPl' );
define( 'SECURE_AUTH_KEY',  '|}q!-J=wEHI!^.pp:FQ;1]@FxM>QjuPSZ1i{y&:]pjUxPuPz`iU^b)cl+|:=kBc.' );
define( 'LOGGED_IN_KEY',    '5X`lx}n0HJMRywA0eX=pFtCycB3~CW_E]^k>cLiT4?j@eHb}+Sj13OWy]Mz3PfE[' );
define( 'NONCE_KEY',        'I sO/kh:!M Eusl,=y,Cbp*b1p<e/Speo+*`T)aaDgNEXsdIrB1hb7SUk%9J>XG2' );
define( 'AUTH_SALT',        'X_D/p_89Cu9hlV_XL*Zv{YMmF:NivJpAx+gDg`-bWb9(0eFezm1<hw4dHO;(dM6(' );
define( 'SECURE_AUTH_SALT', '2lksUY!Us**sU>;+vM(?SpT=4p~iFRl@. }U2 !{Zihe0m.[Ae{`_8<tvC}KOxWd' );
define( 'LOGGED_IN_SALT',   '^>J$B0U0y-EB,P~_oP&U_1,f(yg_<5]WW`kJ$70zgTqaQ*m+zlr)@o^KRMOwxdGB' );
define( 'NONCE_SALT',       '^cD2MX,~o|P1P?^9X>WdTR5)w<@@ZpQl)xcDd8?fYX2-hpFV*GL<e4zxF22:.mL%' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
