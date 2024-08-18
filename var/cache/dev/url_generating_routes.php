<?php

// This file has been auto-generated by the Symfony Routing Component.

return [
    '_preview_error' => [['code', '_format'], ['_controller' => 'error_controller::preview', '_format' => 'html'], ['code' => '\\d+'], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '\\d+', 'code', true], ['text', '/_error']], [], [], []],
    '_wdt' => [['token'], ['_controller' => 'web_profiler.controller.profiler::toolbarAction'], [], [['variable', '/', '[^/]++', 'token', true], ['text', '/_wdt']], [], [], []],
    '_profiler_home' => [[], ['_controller' => 'web_profiler.controller.profiler::homeAction'], [], [['text', '/_profiler/']], [], [], []],
    '_profiler_search' => [[], ['_controller' => 'web_profiler.controller.profiler::searchAction'], [], [['text', '/_profiler/search']], [], [], []],
    '_profiler_search_bar' => [[], ['_controller' => 'web_profiler.controller.profiler::searchBarAction'], [], [['text', '/_profiler/search_bar']], [], [], []],
    '_profiler_phpinfo' => [[], ['_controller' => 'web_profiler.controller.profiler::phpinfoAction'], [], [['text', '/_profiler/phpinfo']], [], [], []],
    '_profiler_search_results' => [['token'], ['_controller' => 'web_profiler.controller.profiler::searchResultsAction'], [], [['text', '/search/results'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], [], []],
    '_profiler_open_file' => [[], ['_controller' => 'web_profiler.controller.profiler::openAction'], [], [['text', '/_profiler/open']], [], [], []],
    '_profiler' => [['token'], ['_controller' => 'web_profiler.controller.profiler::panelAction'], [], [['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], [], []],
    '_profiler_router' => [['token'], ['_controller' => 'web_profiler.controller.router::panelAction'], [], [['text', '/router'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], [], []],
    '_profiler_exception' => [['token'], ['_controller' => 'web_profiler.controller.exception_panel::body'], [], [['text', '/exception'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], [], []],
    '_profiler_exception_css' => [['token'], ['_controller' => 'web_profiler.controller.exception_panel::stylesheet'], [], [['text', '/exception.css'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], [], []],
    'app_home' => [[], ['_controller' => 'App\\Controller\\Admin\\DashboardController::redirection'], [], [['text', '/']], [], [], []],
    'admin' => [[], ['_controller' => 'App\\Controller\\Admin\\DashboardController::index'], [], [['text', '/admin']], [], [], []],
    'app_avatar_index' => [[], ['_controller' => 'App\\Controller\\AvatarController::index'], [], [['text', '/avatar/']], [], [], []],
    'save_avatar' => [[], ['_controller' => 'App\\Controller\\AvatarController::saveAvatar'], [], [['text', '/avatar/api/save-avatar']], [], [], []],
    'check_avatar' => [[], ['_controller' => 'App\\Controller\\AvatarController::checkUserAvatar'], [], [['text', '/avatar/api/check-avatar']], [], [], []],
    'app_avatar_new' => [[], ['_controller' => 'App\\Controller\\AvatarController::new'], [], [['text', '/avatar/new']], [], [], []],
    'app_avatar_show' => [['id'], ['_controller' => 'App\\Controller\\AvatarController::show'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/avatar']], [], [], []],
    'app_avatar_edit' => [['id'], ['_controller' => 'App\\Controller\\AvatarController::edit'], [], [['text', '/edit'], ['variable', '/', '[^/]++', 'id', true], ['text', '/avatar']], [], [], []],
    'app_avatar_delete' => [['id'], ['_controller' => 'App\\Controller\\AvatarController::delete'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/avatar']], [], [], []],
    'app_categorie_index' => [[], ['_controller' => 'App\\Controller\\CategorieController::index'], [], [['text', '/admin/categorie/']], [], [], []],
    'get_categories' => [[], ['_controller' => 'App\\Controller\\CategorieController::getCategories'], [], [['text', '/admin/categorie/api/categories']], [], [], []],
    'app_categorie_new' => [[], ['_controller' => 'App\\Controller\\CategorieController::new'], [], [['text', '/admin/categorie/new']], [], [], []],
    'app_categorie_show' => [['id'], ['_controller' => 'App\\Controller\\CategorieController::show'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/admin/categorie']], [], [], []],
    'app_categorie_edit' => [['id'], ['_controller' => 'App\\Controller\\CategorieController::edit'], [], [['text', '/edit'], ['variable', '/', '[^/]++', 'id', true], ['text', '/admin/categorie']], [], [], []],
    'app_categorie_delete' => [['id'], ['_controller' => 'App\\Controller\\CategorieController::delete'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/admin/categorie']], [], [], []],
    'app_product_index' => [[], ['_controller' => 'App\\Controller\\ProductController::index'], [], [['text', '/admin/product/']], [], [], []],
    'app_category_products' => [['id'], ['_controller' => 'App\\Controller\\ProductController::listProductsByCategory'], [], [['text', '/products'], ['variable', '/', '[^/]++', 'id', true], ['text', '/admin/product/categorie']], [], [], []],
    'app_product_new' => [[], ['_controller' => 'App\\Controller\\ProductController::new'], [], [['text', '/admin/product/new']], [], [], []],
    'app_product_show' => [['id'], ['_controller' => 'App\\Controller\\ProductController::show'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/admin/product']], [], [], []],
    'app_product_edit' => [['id'], ['_controller' => 'App\\Controller\\ProductController::edit'], [], [['text', '/edit'], ['variable', '/', '[^/]++', 'id', true], ['text', '/admin/product']], [], [], []],
    'app_product_delete' => [['id'], ['_controller' => 'App\\Controller\\ProductController::delete'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/admin/product']], [], [], []],
    'app_register' => [[], ['_controller' => 'App\\Controller\\RegistrationController::register'], [], [['text', '/admin/register']], [], [], []],
    'api_csrf_token' => [[], ['_controller' => 'App\\Controller\\RegistrationController::getToken'], [], [['text', '/api/csrf-token']], [], [], []],
    'app_register_from_register' => [[], ['_controller' => 'App\\Controller\\RegistrationController::registerFromFront'], [], [['text', '/register']], [], [], []],
    'app_verify_email' => [[], ['_controller' => 'App\\Controller\\RegistrationController::verifyUserEmail'], [], [['text', '/verify/email']], [], [], []],
    'app_login' => [[], ['_controller' => 'App\\Controller\\SecurityController::login'], [], [['text', '/login']], [], [], []],
    'api_csrf_cnx_token' => [[], ['_controller' => 'App\\Controller\\SecurityController::getCsrfToken'], [], [['text', '/connexion/api/csrf-token']], [], [], []],
    'app_connexionn' => [[], ['_controller' => 'App\\Controller\\SecurityController::loginFront2'], [], [['text', '/connexion2']], [], [], []],
    'app_logout' => [[], ['_controller' => 'App\\Controller\\SecurityController::logout'], [], [['text', '/logout']], [], [], []],
    'app_user' => [[], ['_controller' => 'App\\Controller\\UserController::index'], [], [['text', '/admin/user/']], [], [], []],
    'user_edit' => [['id'], ['_controller' => 'App\\Controller\\UserController::edit'], [], [['text', '/edit'], ['variable', '/', '[^/]++', 'id', true], ['text', '/admin/user']], [], [], []],
    'user_delete' => [['id'], ['_controller' => 'App\\Controller\\UserController::delete'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/admin/user/delete']], [], [], []],
    'user_profile' => [[], ['_controller' => 'App\\Controller\\UserController::profile'], [], [['text', '/admin/user/mon-profile']], [], [], []],
    'error500' => [[], ['_controller' => 'App\\Controller\\ErrorController::error500'], [], [['text', '/error500']], [], [], []],
    'error404' => [[], ['_controller' => 'App\\Controller\\ErrorController::error404'], [], [['text', '/error404']], [], [], []],
    'error_generic' => [[], ['_controller' => 'App\\Controller\\ErrorController::errorGeneric'], [], [['text', '/error']], [], [], []],
];
