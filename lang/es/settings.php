<?php
/**
 * Language file for config
 *
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

$lang['discussionPage']      = 'Nombre de la página de discusión (por defecto es <code>discussion:@ID@</code>, en donde el marcador de posición <code>@ID@</code> reemplaza el nombre actual de la página), el campo vacío deshabilita el enlace';
$lang['showDiscussion']      = 'Muestra el enlace de discusión en el menú de herramientas';
$lang['showLoginOnFooter']   = 'Mostrar enlace "pequeño" del login en el pie de página. Esta opción es útil cuando <code>hideLoginLink</code> está habilitado';
$lang['hideLoginLink']       = 'Ocultar el botón de inicio de sesión en la barra de navegación. Esta opción es útil en instalaciones "read-only" de (por ejemplo blog, sitio web personal)';
$lang['showUserHomeLink']    = 'Mostrar enlace a Página de Inicio de Usuario en la barra de navegación';
$lang['showCookieLawBanner'] = 'Mostrar el banner Cookie Law en el pie de página';
$lang['cookieLawBannerPage'] = 'Nombre de página del banner Cookie Law';
$lang['cookieLawPolicyPage'] = 'Nombre de página de política de Cookie Law';
$lang['browserTitle']        = 'Título del explorador para DokuWiki (por defecto es <code>@TITLE@ [@WIKI@]</code>, en donde el marcador de posición <code>@TITLE@</code> reemplaza el título de la página actual y <code>@WIKI@</code> reemplaza en nombre de la DokuWiki - ver configuración <a href="#config___title">title</a>';
$lang['showIndividualTool']  = 'Habilitar/Deshabilitar herramientas individuales de la barra de navegación';
$lang['showTools']           = 'Mostrar Herramientas en la barra de navegación';
$lang['individualTools']     = 'Dividir las Herramientas en un menú individual en la barra de navegación';
$lang['showTools_o_never']   = 'Nunca';
$lang['showTools_o_logged']  = 'Cuando está identificado (logged in)';
$lang['showTools_o_always']  = 'Siempre';
$lang['showSearchForm']      = 'Mostrar formulario de búsqueda en la barra de navegación';
$lang['showSearchForm_o_never']  = 'Nunca';
$lang['showSearchForm_o_logged'] = 'Cuando está identificado (logged in)';
$lang['showSearchForm_o_always'] = 'Siempre';
$lang['sidebarPosition']     = 'Posición de la barra lateral DokuWiki (<code>left</code> o <code>right</code>)';
$lang['rightSidebar']        = 'El nombre de la página de la Barra Lateral Derecha. El campo vacío deshabilita la barra lateral derecha.<br/>La Barra Lateral Derecha sólo se muestra cuando la <a href="#config___sidebar">barra lateral</a> predeterminada de DokuWiki está habilitada y está en la posición <code>left</code> (ver la configuración de <a href="#config___tpl____bootstrap3____sidebarPosition">tpl»bootstrap3»sidebarPosition</a>). Si sólo quieres la barra lateral en la posición derecha, establece la configuración de <a href="#config___tpl____bootstrap3____sidebarPosition">tpl»bootstrap3»sidebarPosition</a> con el valor <code>right</code>';
$lang['tableFullWidth']      = 'Habilitar el ancho de tabla a 100% (predeterminado en Bootstrap)';
$lang['semantic']            = 'Habilitar datos semánticos';
$lang['schemaOrgType']       = 'Tipo de Schema.org (<code>Article</code>, <code>NewsArticle</code>, <code>TechArticle</code>, <code>BlogPosting</code>)';
$lang['showTranslation']     = 'Mostrar barra de traducción (requiere <em>Translation Plugin</em>)';
$lang['showAdminMenu']       = 'Mostrar menú de Administración';
$lang['inverseNavbar']       = 'Barra de navegación (navbar) invertida';
$lang['fixedTopNavbar']      = 'Fijar la barra de navegación (navbar) a la parte de arriba';
$lang['fluidContainer']      = 'Habilitar el contenedor fluído (todo el ancho de la página)';
$lang['fluidContainerBtn']   = 'Mostrar un botón en la barra de navegación para expandir el contenedor';
$lang['pageOnPanel']         = 'Habilitar el panel alrededor de la página';
$lang['bootstrapTheme']      = 'Tema de Bootstrap';
$lang['bootstrapTheme_o_default']    = 'Tema Vanilla de Bootstrap';
$lang['bootstrapTheme_o_optional']   = 'Tema opcional de Bootstrap';
$lang['bootstrapTheme_o_custom']     = 'Tema personalizado de Bootstrap theme';
$lang['bootstrapTheme_o_bootswatch'] = 'Tema de Bootswatch.com';
$lang['customTheme']         = 'Inserta la URL del tema personalizado';
$lang['bootswatchTheme']     = 'Selecciona un tema de Bootswatch.com';
$lang['showThemeSwitcher']   = 'Mostrar selector de temas Bootswatch.com en la barra de navegación';
$lang['hideInThemeSwitcher'] = 'Ocultar temas en el selector de tema';
$lang['showPageInfo']        = 'Mostrar información de la página (por ejemplo: fecha, autor)';
$lang['showBadges']          = 'Mostrar botones insignia (DokuWiki, Donar, etc)';
$lang['leftSidebarGrid']     = 'Clases grid para barra lateral izquierda <code>col-{xs,sm,md,lg}-x</code> (ver documentación de <a href="http://getbootstrap.com/css/#grid" target="_blank">Bootstrap Grids</a>)';
$lang['rightSidebarGrid']    = 'Clases grid para barra lateral derecha <code>col-{xs,sm,md,lg}-x</code> (ver documentación de <a href="http://getbootstrap.com/css/#grid" target="_blank">Bootstrap Grids</a>)';
