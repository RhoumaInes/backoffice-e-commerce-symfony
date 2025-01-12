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
    'app_attribute_index' => [[], ['_controller' => 'App\\Controller\\AttributeController::index'], [], [['text', '/attribute/']], [], [], []],
    'app_attribute_new' => [[], ['_controller' => 'App\\Controller\\AttributeController::new'], [], [['text', '/attribute/new']], [], [], []],
    'app_attribute_show' => [['id'], ['_controller' => 'App\\Controller\\AttributeController::show'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/attribute']], [], [], []],
    'app_attribute_edit' => [['id'], ['_controller' => 'App\\Controller\\AttributeController::edit'], [], [['text', '/edit'], ['variable', '/', '[^/]++', 'id', true], ['text', '/attribute']], [], [], []],
    'app_attribute_delete' => [['id'], ['_controller' => 'App\\Controller\\AttributeController::delete'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/attribute']], [], [], []],
    'app_attribute_value_index' => [['id_attribute'], ['_controller' => 'App\\Controller\\AttributeValueController::index'], [], [['variable', '/', '[^/]++', 'id_attribute', true], ['text', '/attribute/value']], [], [], []],
    'app_attribute_value_new' => [['id_attribute'], ['_controller' => 'App\\Controller\\AttributeValueController::new'], [], [['variable', '/', '[^/]++', 'id_attribute', true], ['text', '/attribute/value/new']], [], [], []],
    'app_attribute_value_show' => [['id'], ['_controller' => 'App\\Controller\\AttributeValueController::show'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/attribute/value']], [], [], []],
    'app_attribute_value_edit' => [['id'], ['_controller' => 'App\\Controller\\AttributeValueController::edit'], [], [['text', '/edit'], ['variable', '/', '[^/]++', 'id', true], ['text', '/attribute/value']], [], [], []],
    'app_attribute_value_delete' => [['id', 'id_attribute'], ['_controller' => 'App\\Controller\\AttributeValueController::delete'], [], [['variable', '/', '[^/]++', 'id_attribute', true], ['variable', '/', '[^/]++', 'id', true], ['text', '/attribute/value']], [], [], []],
    'app_avatar_index' => [[], ['_controller' => 'App\\Controller\\AvatarController::index'], [], [['text', '/avatar/']], [], [], []],
    'app_avatar_new' => [[], ['_controller' => 'App\\Controller\\AvatarController::new'], [], [['text', '/avatar/new']], [], [], []],
    'app_avatar_show' => [['id'], ['_controller' => 'App\\Controller\\AvatarController::show'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/avatar']], [], [], []],
    'app_avatar_edit' => [['id'], ['_controller' => 'App\\Controller\\AvatarController::edit'], [], [['text', '/edit'], ['variable', '/', '[^/]++', 'id', true], ['text', '/avatar']], [], [], []],
    'app_avatar_delete' => [['id'], ['_controller' => 'App\\Controller\\AvatarController::delete'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/avatar']], [], [], []],
    'app_avatar_saveavatar' => [[], ['_controller' => 'App\\Controller\\AvatarController::saveAvatar'], [], [['text', '/avatar/api/avatar']], [], [], []],
    'app_avatar_getavatar' => [[], ['_controller' => 'App\\Controller\\AvatarController::getAvatar'], [], [['text', '/avatar/api/avatar']], [], [], []],
    'app_carrier_index' => [[], ['_controller' => 'App\\Controller\\CarrierController::index'], [], [['text', '/admin/carrier/']], [], [], []],
    'app_carrier_new' => [[], ['_controller' => 'App\\Controller\\CarrierController::new'], [], [['text', '/admin/carrier/new']], [], [], []],
    'app_carrier_show' => [['id'], ['_controller' => 'App\\Controller\\CarrierController::show'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/admin/carrier']], [], [], []],
    'app_carrier_edit' => [['id'], ['_controller' => 'App\\Controller\\CarrierController::edit'], [], [['text', '/edit'], ['variable', '/', '[^/]++', 'id', true], ['text', '/admin/carrier']], [], [], []],
    'toggle_carrier' => [['id'], ['_controller' => 'App\\Controller\\CarrierController::toggleTaxState'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/admin/carrier/toggle']], [], [], []],
    'app_carrier_delete' => [['id'], ['_controller' => 'App\\Controller\\CarrierController::delete'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/admin/carrier']], [], [], []],
    'app_carrier_price_index' => [['id'], ['_controller' => 'App\\Controller\\CarrierPriceController::index'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/carrier/price/index']], [], [], []],
    'app_carrier_price_new' => [['id_carrier'], ['_controller' => 'App\\Controller\\CarrierPriceController::new'], [], [['variable', '/', '[^/]++', 'id_carrier', true], ['text', '/carrier/price/new']], [], [], []],
    'app_carrier_price_show' => [['id'], ['_controller' => 'App\\Controller\\CarrierPriceController::show'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/carrier/price']], [], [], []],
    'app_carrier_price_edit' => [['id'], ['_controller' => 'App\\Controller\\CarrierPriceController::edit'], [], [['text', '/edit'], ['variable', '/', '[^/]++', 'id', true], ['text', '/carrier/price']], [], [], []],
    'app_carrier_price_delete' => [['id'], ['_controller' => 'App\\Controller\\CarrierPriceController::delete'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/carrier/price']], [], [], []],
    'app_categorie_index' => [[], ['_controller' => 'App\\Controller\\CategorieController::index'], [], [['text', '/admin/categorie']], [], [], []],
    'get_categories' => [[], ['_controller' => 'App\\Controller\\CategorieController::getCategories'], [], [['text', '/api/categories']], [], [], []],
    'app_categorie_new' => [[], ['_controller' => 'App\\Controller\\CategorieController::new'], [], [['text', '/admin/categorie/new']], [], [], []],
    'app_categorie_show' => [['id'], ['_controller' => 'App\\Controller\\CategorieController::show'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/admin/categorie']], [], [], []],
    'app_categorie_edit' => [['id'], ['_controller' => 'App\\Controller\\CategorieController::edit'], [], [['text', '/edit'], ['variable', '/', '[^/]++', 'id', true], ['text', '/admin/categorie']], [], [], []],
    'app_categorie_delete' => [['id'], ['_controller' => 'App\\Controller\\CategorieController::delete'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/admin/categorie']], [], [], []],
    'app_client_auth' => [[], ['_controller' => 'App\\Controller\\ClientAuthController::index'], [], [['text', '/client/auth']], [], [], []],
    'api_csrf_token' => [[], ['_controller' => 'App\\Controller\\ClientAuthController::getToken'], [], [['text', '/api/csrf-token']], [], [], []],
    'app_register_from_register' => [[], ['_controller' => 'App\\Controller\\ClientAuthController::registerFromFront'], [], [['text', '/register']], [], [], []],
    'api_csrf_cnx_token' => [[], ['_controller' => 'App\\Controller\\ClientAuthController::getCsrfToken'], [], [['text', '/connexion/api/csrf-token']], [], [], []],
    'app_connexionn' => [[], ['_controller' => 'App\\Controller\\ClientAuthController::loginFront2'], [], [['text', '/connexion2']], [], [], []],
    'check_avatar' => [[], ['_controller' => 'App\\Controller\\ClientAuthController::checkUserAvatar'], [], [['text', '/avatar/api/check-avatar']], [], [], []],
    'save_avatar' => [[], ['_controller' => 'App\\Controller\\ClientAuthController::saveAvatar'], [], [['text', '/avatar/api/save-avatar']], [], [], []],
    'admin_clients_list' => [[], ['_controller' => 'App\\Controller\\ClientController::list'], [], [['text', '/admin/clients/']], [], [], []],
    'admin_client_toggle' => [['id'], ['_controller' => 'App\\Controller\\ClientController::toggleStatus'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/admin/clients/toggle']], [], [], []],
    'admin_client_orders' => [['id'], ['_controller' => 'App\\Controller\\ClientController::viewOrders'], [], [['text', '/orders'], ['variable', '/', '[^/]++', 'id', true], ['text', '/admin/clients']], [], [], []],
    'app_image_upload' => [[], ['_controller' => 'App\\Controller\\ImageUploadController::index'], [], [['text', '/image/upload']], [], [], []],
    'app_image_upload_product' => [[], ['_controller' => 'App\\Controller\\ImageUploadController::uploadForProduct'], [], [['text', '/product/image/upload']], [], [], []],
    'upload_image' => [[], ['_controller' => 'App\\Controller\\ImageUploadController::uploadImage'], [], [['text', '/upload_image']], [], [], []],
    'file_upload' => [[], ['_controller' => 'App\\Controller\\ImageUploadController::upload'], [], [['text', '/file_upload']], [], [], []],
    'image_delete' => [['id'], ['_controller' => 'App\\Controller\\ImageUploadController::deleteImage'], [], [['text', '/delete'], ['variable', '/', '[^/]++', 'id', true], ['text', '/image']], [], [], []],
    'app_product_index' => [[], ['_controller' => 'App\\Controller\\ProductController::index'], [], [['text', '/admin/product/']], [], [], []],
    'app_category_products' => [['id'], ['_controller' => 'App\\Controller\\ProductController::listProductsByCategory'], [], [['text', '/products'], ['variable', '/', '[^/]++', 'id', true], ['text', '/admin/product/categorie']], [], [], []],
    'app_provider_products' => [['id'], ['_controller' => 'App\\Controller\\ProductController::listProductsByProvider'], [], [['text', '/products'], ['variable', '/', '[^/]++', 'id', true], ['text', '/admin/product/provider']], [], [], []],
    'app_product_new' => [[], ['_controller' => 'App\\Controller\\ProductController::new'], [], [['text', '/admin/product/new']], [], [], []],
    'app_product_show' => [['id'], ['_controller' => 'App\\Controller\\ProductController::show'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/admin/product']], [], [], []],
    'app_product_edit' => [['id'], ['_controller' => 'App\\Controller\\ProductController::edit'], [], [['text', '/edit'], ['variable', '/', '[^/]++', 'id', true], ['text', '/admin/product']], [], [], []],
    'product_update_category' => [['id'], ['_controller' => 'App\\Controller\\ProductController::updateCategory'], [], [['text', '/update_category'], ['variable', '/', '[^/]++', 'id', true], ['text', '/admin/product']], [], [], []],
    'product_update_attributs' => [['id'], ['_controller' => 'App\\Controller\\ProductController::updateAttributs'], [], [['text', '/update_attributs'], ['variable', '/', '[^/]++', 'id', true], ['text', '/admin/product']], [], [], []],
    'toggle_product' => [['id'], ['_controller' => 'App\\Controller\\ProductController::toggleTaxState'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/admin/product/toggle']], [], [], []],
    'app_product_delete' => [['id'], ['_controller' => 'App\\Controller\\ProductController::delete'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/admin/product']], [], [], []],
    'app_provider_index' => [[], ['_controller' => 'App\\Controller\\ProviderController::index'], [], [['text', '/admin/provider/']], [], [], []],
    'app_provider_new' => [[], ['_controller' => 'App\\Controller\\ProviderController::new'], [], [['text', '/admin/provider/new']], [], [], []],
    'app_provider_show' => [['id'], ['_controller' => 'App\\Controller\\ProviderController::show'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/admin/provider']], [], [], []],
    'app_provider_edit' => [['id'], ['_controller' => 'App\\Controller\\ProviderController::edit'], [], [['text', '/edit'], ['variable', '/', '[^/]++', 'id', true], ['text', '/admin/provider']], [], [], []],
    'app_provider_delete' => [['id'], ['_controller' => 'App\\Controller\\ProviderController::delete'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/admin/provider']], [], [], []],
    'app_register' => [[], ['_controller' => 'App\\Controller\\RegistrationController::register'], [], [['text', '/admin/register']], [], [], []],
    'app_verify_email' => [[], ['_controller' => 'App\\Controller\\RegistrationController::verifyUserEmail'], [], [['text', '/verify/email']], [], [], []],
    'app_login' => [[], ['_controller' => 'App\\Controller\\SecurityController::login'], [], [['text', '/login']], [], [], []],
    'app_logout' => [[], ['_controller' => 'App\\Controller\\SecurityController::logout'], [], [['text', '/logout']], [], [], []],
    'app_tax_rules_index' => [[], ['_controller' => 'App\\Controller\\TaxRulesController::index'], [], [['text', '/tax/rules/']], [], [], []],
    'app_tax_rules_new' => [[], ['_controller' => 'App\\Controller\\TaxRulesController::new'], [], [['text', '/tax/rules/new']], [], [], []],
    'app_tax_rules_show' => [['id'], ['_controller' => 'App\\Controller\\TaxRulesController::show'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/tax/rules']], [], [], []],
    'app_tax_rules_edit' => [['id'], ['_controller' => 'App\\Controller\\TaxRulesController::edit'], [], [['text', '/edit'], ['variable', '/', '[^/]++', 'id', true], ['text', '/tax/rules']], [], [], []],
    'toggle_tax' => [['id'], ['_controller' => 'App\\Controller\\TaxRulesController::toggleTaxState'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/tax/rules/toggle']], [], [], []],
    'app_tax_rules_delete' => [['id'], ['_controller' => 'App\\Controller\\TaxRulesController::delete'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/tax/rules']], [], [], []],
    'app_user' => [[], ['_controller' => 'App\\Controller\\UserController::index'], [], [['text', '/admin/user/']], [], [], []],
    'user_edit' => [['id'], ['_controller' => 'App\\Controller\\UserController::edit'], [], [['text', '/edit'], ['variable', '/', '[^/]++', 'id', true], ['text', '/admin/user']], [], [], []],
    'user_delete' => [['id'], ['_controller' => 'App\\Controller\\UserController::delete'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/admin/user/delete']], [], [], []],
    'user_profile' => [[], ['_controller' => 'App\\Controller\\UserController::profile'], [], [['text', '/admin/user/mon-profile']], [], [], []],
    'user_profile_image' => [[], ['_controller' => 'App\\Controller\\UserController::editProfile'], [], [['text', '/admin/user/edit-profile-image']], [], [], []],
    'error500' => [[], ['_controller' => 'App\\Controller\\ErrorController::error500'], [], [['text', '/error500']], [], [], []],
    'error404' => [[], ['_controller' => 'App\\Controller\\ErrorController::error404'], [], [['text', '/error404']], [], [], []],
    'error_generic' => [[], ['_controller' => 'App\\Controller\\ErrorController::errorGeneric'], [], [['text', '/error']], [], [], []],
];
