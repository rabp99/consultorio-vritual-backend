<?php
/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

/*
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 */
/** @var \Cake\Routing\RouteBuilder $routes */
$routes->setRouteClass(DashedRoute::class);

$routes->scope('/api', function (RouteBuilder $builder) {
    $builder->setExtensions(['json']);
    $builder->resources('users', [
        'map' => [
            'enable' => [
                'action' => 'enable',
                'method' => 'POST'
            ],
            'disable' => [
                'action' => 'disable',
                'method' => 'POST'
            ],
            'change_password' => [
                'action' => 'changePassword',
                'method' => 'POST'
            ],
            'reset_password' => [
                'action' => 'reset_password',
                'method' => 'POST'
            ],
            'login' => [
                'action' => 'login',
                'method' => 'POST'
            ]
        ]
    ]);
    $builder->resources('appointments', [
        'map' => [
            'get_to_edit/:id' => [
                'action' => 'getToEdit',
                'method' => 'GET'
            ],
            'cancel/:id' => [
                'action' => 'cancel',
                'method' => 'DELETE'
            ],
            'undo_cancel/:id' => [
                'action' => 'undoCancel',
                'method' => 'PUT'
            ],
            'reschedule/:id' => [
                'action' => 'reschedule',
                'method' => 'PUT'
            ],
            'attend/:id' => [
                'action' => 'attend',
                'method' => 'PUT'
            ]
        ]
    ]);
    $builder->resources('consulting-rooms', [
        'map' => [
            'enable' => [
                'action' => 'enable',
                'method' => 'POST'
            ],
            'disable' => [
                'action' => 'disable',
                'method' => 'POST'
            ],
            'get_list' => [
                'action' => 'getList',
                'method' => 'GET'
            ],
        ]
    ]);
    $builder->resources('medicines', [
        'map' => [
            'enable' => [
                'action' => 'enable',
                'method' => 'POST'
            ],
            'disable' => [
                'action' => 'disable',
                'method' => 'POST'
            ],
            'get_list' => [
                'action' => 'getList',
                'method' => 'GET'
            ],
        ]
    ]);
    $builder->resources('diseases', [
        'map' => [
            'enable' => [
                'action' => 'enable',
                'method' => 'POST'
            ],
            'disable' => [
                'action' => 'disable',
                'method' => 'POST'
            ]
        ]
    ]);
    $builder->resources('employees', [
        'map' => [
            ':person_doc_type/:person_doc_num' => [
                'action' => 'view',
                'method' => 'GET'
            ],
            'update/:person_doc_type/:person_doc_num' => [
                'action' => 'edit',
                'method' => 'PUT'
            ],
            'enable' => [
                'action' => 'enable',
                'method' => 'POST'
            ],
            'disable' => [
                'action' => 'disable',
                'method' => 'POST'
            ]
        ]
    ]);
    $builder->resources('patients', [
        'map' => [
            ':person_doc_type/:person_doc_num' => [
                'action' => 'view',
                'method' => 'GET'
            ],
            'update/:person_doc_type/:person_doc_num' => [
                'action' => 'edit',
                'method' => 'PUT'
            ],
            'enable' => [
                'action' => 'enable',
                'method' => 'POST'
            ],
            'disable' => [
                'action' => 'disable',
                'method' => 'POST'
            ]
        ]
    ]);
    $builder->resources('places', [
        'map' => [
            'get_list' => [
                'action' => 'getList',
                'method' => 'GET'
            ],
            'enable' => [
                'action' => 'enable',
                'method' => 'POST'
            ],
            'disable' => [
                'action' => 'disable',
                'method' => 'POST'
            ]
        ]
    ]);
});