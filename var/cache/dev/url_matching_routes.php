<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/' => [[['_route' => 'app_home', '_controller' => 'App\\Controller\\Admin\\DashboardController::redirection'], null, null, null, false, false, null]],
        '/admin' => [[['_route' => 'admin', '_controller' => 'App\\Controller\\Admin\\DashboardController::index'], null, null, null, false, false, null]],
        '/attribute' => [[['_route' => 'app_attribute_index', '_controller' => 'App\\Controller\\AttributeController::index'], null, ['GET' => 0, 'POST' => 1], null, true, false, null]],
        '/attribute/new' => [[['_route' => 'app_attribute_new', '_controller' => 'App\\Controller\\AttributeController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/avatar' => [[['_route' => 'app_avatar_index', '_controller' => 'App\\Controller\\AvatarController::index'], null, ['GET' => 0], null, true, false, null]],
        '/avatar/new' => [[['_route' => 'app_avatar_new', '_controller' => 'App\\Controller\\AvatarController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/admin/carrier' => [[['_route' => 'app_carrier_index', '_controller' => 'App\\Controller\\CarrierController::index'], null, ['GET' => 0], null, true, false, null]],
        '/admin/carrier/new' => [[['_route' => 'app_carrier_new', '_controller' => 'App\\Controller\\CarrierController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/admin/categorie' => [[['_route' => 'app_categorie_index', '_controller' => 'App\\Controller\\CategorieController::index'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/api/categories' => [[['_route' => 'get_categories', '_controller' => 'App\\Controller\\CategorieController::getCategories'], null, ['GET' => 0], null, false, false, null]],
        '/admin/categorie/new' => [[['_route' => 'app_categorie_new', '_controller' => 'App\\Controller\\CategorieController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/client/auth' => [[['_route' => 'app_client_auth', '_controller' => 'App\\Controller\\ClientAuthController::index'], null, null, null, false, false, null]],
        '/api/csrf-token' => [[['_route' => 'api_csrf_token', '_controller' => 'App\\Controller\\ClientAuthController::getToken'], null, ['GET' => 0], null, false, false, null]],
        '/register' => [[['_route' => 'app_register_from_register', '_controller' => 'App\\Controller\\ClientAuthController::registerFromFront'], null, ['POST' => 0], null, false, false, null]],
        '/connexion/api/csrf-token' => [[['_route' => 'api_csrf_cnx_token', '_controller' => 'App\\Controller\\ClientAuthController::getCsrfToken'], null, ['GET' => 0], null, false, false, null]],
        '/connexion2' => [[['_route' => 'app_connexionn', '_controller' => 'App\\Controller\\ClientAuthController::loginFront2'], null, ['POST' => 0, 'GET' => 1], null, false, false, null]],
        '/avatar/api/check-avatar' => [[['_route' => 'check_avatar', '_controller' => 'App\\Controller\\ClientAuthController::checkUserAvatar'], null, ['GET' => 0], null, false, false, null]],
        '/avatar/api/save-avatar' => [[['_route' => 'save_avatar', '_controller' => 'App\\Controller\\ClientAuthController::saveAvatar'], null, ['POST' => 0], null, false, false, null]],
        '/image/upload' => [[['_route' => 'app_image_upload', '_controller' => 'App\\Controller\\ImageUploadController::index'], null, null, null, false, false, null]],
        '/product/image/upload' => [[['_route' => 'app_image_upload_product', '_controller' => 'App\\Controller\\ImageUploadController::uploadForProduct'], null, null, null, false, false, null]],
        '/upload_image' => [[['_route' => 'upload_image', '_controller' => 'App\\Controller\\ImageUploadController::uploadImage'], null, ['POST' => 0], null, false, false, null]],
        '/file_upload' => [[['_route' => 'file_upload', '_controller' => 'App\\Controller\\ImageUploadController::upload'], null, ['POST' => 0], null, false, false, null]],
        '/admin/product' => [[['_route' => 'app_product_index', '_controller' => 'App\\Controller\\ProductController::index'], null, ['GET' => 0, 'POST' => 1], null, true, false, null]],
        '/admin/product/new' => [[['_route' => 'app_product_new', '_controller' => 'App\\Controller\\ProductController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/admin/provider' => [[['_route' => 'app_provider_index', '_controller' => 'App\\Controller\\ProviderController::index'], null, ['GET' => 0, 'POST' => 1], null, true, false, null]],
        '/admin/provider/new' => [[['_route' => 'app_provider_new', '_controller' => 'App\\Controller\\ProviderController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/admin/register' => [[['_route' => 'app_register', '_controller' => 'App\\Controller\\RegistrationController::register'], null, null, null, false, false, null]],
        '/verify/email' => [[['_route' => 'app_verify_email', '_controller' => 'App\\Controller\\RegistrationController::verifyUserEmail'], null, null, null, false, false, null]],
        '/login' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\SecurityController::login'], null, null, null, false, false, null]],
        '/logout' => [[['_route' => 'app_logout', '_controller' => 'App\\Controller\\SecurityController::logout'], null, null, null, false, false, null]],
        '/tax/rules' => [[['_route' => 'app_tax_rules_index', '_controller' => 'App\\Controller\\TaxRulesController::index'], null, ['GET' => 0], null, true, false, null]],
        '/tax/rules/new' => [[['_route' => 'app_tax_rules_new', '_controller' => 'App\\Controller\\TaxRulesController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/admin/user' => [[['_route' => 'app_user', '_controller' => 'App\\Controller\\UserController::index'], null, null, null, true, false, null]],
        '/admin/user/mon-profile' => [[['_route' => 'user_profile', '_controller' => 'App\\Controller\\UserController::profile'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/error500' => [[['_route' => 'error500', '_controller' => 'App\\Controller\\ErrorController::error500'], null, null, null, false, false, null]],
        '/error404' => [[['_route' => 'error404', '_controller' => 'App\\Controller\\ErrorController::error404'], null, null, null, false, false, null]],
        '/error' => [[['_route' => 'error_generic', '_controller' => 'App\\Controller\\ErrorController::errorGeneric'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/([^/]++)(?'
                        .'|/(?'
                            .'|search/results(*:102)'
                            .'|router(*:116)'
                            .'|exception(?'
                                .'|(*:136)'
                                .'|\\.css(*:149)'
                            .')'
                        .')'
                        .'|(*:159)'
                    .')'
                .')'
                .'|/a(?'
                    .'|ttribute/(?'
                        .'|([^/]++)(?'
                            .'|(*:197)'
                            .'|/edit(*:210)'
                            .'|(*:218)'
                        .')'
                        .'|value/(?'
                            .'|([^/]++)(*:244)'
                            .'|new/([^/]++)(*:264)'
                            .'|([^/]++)(?'
                                .'|(*:283)'
                                .'|/(?'
                                    .'|edit(*:299)'
                                    .'|([^/]++)(*:315)'
                                .')'
                            .')'
                        .')'
                    .')'
                    .'|vatar/([^/]++)(?'
                        .'|(*:344)'
                        .'|/edit(*:357)'
                        .'|(*:365)'
                    .')'
                    .'|dmin/(?'
                        .'|ca(?'
                            .'|rrier/(?'
                                .'|([^/]++)(?'
                                    .'|(*:407)'
                                    .'|/edit(*:420)'
                                .')'
                                .'|toggle/([^/]++)(*:444)'
                                .'|([^/]++)(*:460)'
                            .')'
                            .'|tegorie/([^/]++)(?'
                                .'|(*:488)'
                                .'|/edit(*:501)'
                                .'|(*:509)'
                            .')'
                        .')'
                        .'|pro(?'
                            .'|duct/(?'
                                .'|categorie/([^/]++)/products(*:560)'
                                .'|provider/([^/]++)/products(*:594)'
                                .'|([^/]++)(?'
                                    .'|(*:613)'
                                    .'|/(?'
                                        .'|edit(*:629)'
                                        .'|update_(?'
                                            .'|category(*:655)'
                                            .'|attributs(*:672)'
                                        .')'
                                    .')'
                                .')'
                                .'|toggle/([^/]++)(*:698)'
                                .'|([^/]++)(*:714)'
                            .')'
                            .'|vider/([^/]++)(?'
                                .'|(*:740)'
                                .'|/edit(*:753)'
                                .'|(*:761)'
                            .')'
                        .')'
                        .'|user/(?'
                            .'|([^/]++)/edit(*:792)'
                            .'|delete/([^/]++)(*:815)'
                        .')'
                    .')'
                .')'
                .'|/carrier/price/(?'
                    .'|index/([^/]++)(*:858)'
                    .'|new/([^/]++)(*:878)'
                    .'|([^/]++)(?'
                        .'|(*:897)'
                        .'|/edit(*:910)'
                        .'|(*:918)'
                    .')'
                .')'
                .'|/image/([^/]++)/delete(*:950)'
                .'|/tax/rules/(?'
                    .'|([^/]++)(?'
                        .'|(*:983)'
                        .'|/edit(*:996)'
                    .')'
                    .'|toggle/([^/]++)(*:1020)'
                    .'|([^/]++)(*:1037)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        102 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        116 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        136 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        149 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        159 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        197 => [[['_route' => 'app_attribute_show', '_controller' => 'App\\Controller\\AttributeController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        210 => [[['_route' => 'app_attribute_edit', '_controller' => 'App\\Controller\\AttributeController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        218 => [[['_route' => 'app_attribute_delete', '_controller' => 'App\\Controller\\AttributeController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        244 => [[['_route' => 'app_attribute_value_index', '_controller' => 'App\\Controller\\AttributeValueController::index'], ['id_attribute'], ['GET' => 0], null, false, true, null]],
        264 => [[['_route' => 'app_attribute_value_new', '_controller' => 'App\\Controller\\AttributeValueController::new'], ['id_attribute'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        283 => [[['_route' => 'app_attribute_value_show', '_controller' => 'App\\Controller\\AttributeValueController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        299 => [[['_route' => 'app_attribute_value_edit', '_controller' => 'App\\Controller\\AttributeValueController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        315 => [[['_route' => 'app_attribute_value_delete', '_controller' => 'App\\Controller\\AttributeValueController::delete'], ['id', 'id_attribute'], ['POST' => 0], null, false, true, null]],
        344 => [[['_route' => 'app_avatar_show', '_controller' => 'App\\Controller\\AvatarController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        357 => [[['_route' => 'app_avatar_edit', '_controller' => 'App\\Controller\\AvatarController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        365 => [[['_route' => 'app_avatar_delete', '_controller' => 'App\\Controller\\AvatarController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        407 => [[['_route' => 'app_carrier_show', '_controller' => 'App\\Controller\\CarrierController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        420 => [[['_route' => 'app_carrier_edit', '_controller' => 'App\\Controller\\CarrierController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        444 => [[['_route' => 'toggle_carrier', '_controller' => 'App\\Controller\\CarrierController::toggleTaxState'], ['id'], ['POST' => 0], null, false, true, null]],
        460 => [[['_route' => 'app_carrier_delete', '_controller' => 'App\\Controller\\CarrierController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        488 => [[['_route' => 'app_categorie_show', '_controller' => 'App\\Controller\\CategorieController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        501 => [[['_route' => 'app_categorie_edit', '_controller' => 'App\\Controller\\CategorieController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        509 => [[['_route' => 'app_categorie_delete', '_controller' => 'App\\Controller\\CategorieController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        560 => [[['_route' => 'app_category_products', '_controller' => 'App\\Controller\\ProductController::listProductsByCategory'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        594 => [[['_route' => 'app_provider_products', '_controller' => 'App\\Controller\\ProductController::listProductsByProvider'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        613 => [[['_route' => 'app_product_show', '_controller' => 'App\\Controller\\ProductController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        629 => [[['_route' => 'app_product_edit', '_controller' => 'App\\Controller\\ProductController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        655 => [[['_route' => 'product_update_category', '_controller' => 'App\\Controller\\ProductController::updateCategory'], ['id'], ['POST' => 0], null, false, false, null]],
        672 => [[['_route' => 'product_update_attributs', '_controller' => 'App\\Controller\\ProductController::updateAttributs'], ['id'], ['POST' => 0], null, false, false, null]],
        698 => [[['_route' => 'toggle_product', '_controller' => 'App\\Controller\\ProductController::toggleTaxState'], ['id'], ['POST' => 0], null, false, true, null]],
        714 => [[['_route' => 'app_product_delete', '_controller' => 'App\\Controller\\ProductController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        740 => [[['_route' => 'app_provider_show', '_controller' => 'App\\Controller\\ProviderController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        753 => [[['_route' => 'app_provider_edit', '_controller' => 'App\\Controller\\ProviderController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        761 => [[['_route' => 'app_provider_delete', '_controller' => 'App\\Controller\\ProviderController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        792 => [[['_route' => 'user_edit', '_controller' => 'App\\Controller\\UserController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        815 => [[['_route' => 'user_delete', '_controller' => 'App\\Controller\\UserController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        858 => [[['_route' => 'app_carrier_price_index', '_controller' => 'App\\Controller\\CarrierPriceController::index'], ['id'], ['GET' => 0], null, false, true, null]],
        878 => [[['_route' => 'app_carrier_price_new', '_controller' => 'App\\Controller\\CarrierPriceController::new'], ['id_carrier'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        897 => [[['_route' => 'app_carrier_price_show', '_controller' => 'App\\Controller\\CarrierPriceController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        910 => [[['_route' => 'app_carrier_price_edit', '_controller' => 'App\\Controller\\CarrierPriceController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        918 => [[['_route' => 'app_carrier_price_delete', '_controller' => 'App\\Controller\\CarrierPriceController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        950 => [[['_route' => 'image_delete', '_controller' => 'App\\Controller\\ImageUploadController::deleteImage'], ['id'], ['POST' => 0], null, false, false, null]],
        983 => [[['_route' => 'app_tax_rules_show', '_controller' => 'App\\Controller\\TaxRulesController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        996 => [[['_route' => 'app_tax_rules_edit', '_controller' => 'App\\Controller\\TaxRulesController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        1020 => [[['_route' => 'toggle_tax', '_controller' => 'App\\Controller\\TaxRulesController::toggleTaxState'], ['id'], ['POST' => 0], null, false, true, null]],
        1037 => [
            [['_route' => 'app_tax_rules_delete', '_controller' => 'App\\Controller\\TaxRulesController::delete'], ['id'], ['POST' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
