<?php
/**
 * gredu_labs
 * 
 * @link https://github.com/eellak/gredu_labs for the canonical source repository
 * @copyright Copyright (c) 2008-2015 Greek Free/Open Source Software Society (https://gfoss.ellak.gr/)
 * @license GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0-standalone.html
 */

return [
    'acl' => [
        'default_role' => 'guest',
        'roles'        => [
            'guest'  => [],
            'user'   => [],
            'school' => ['user'],
            'admin'  => ['user'],
        ],
        'resoures' => [],
        'guards'   => [
            'resources' => [],
            'callables' => [],
            'routes'    => [
                ['/', ['guest', 'user'], ['get']],
                ['/about', ['guest', 'user'], ['get']],
                ['/school', ['school'], ['get']],
                ['/school/labs', ['school'], ['get', 'post']],
                ['/school/staff', ['school'], ['get', 'post', 'delete']],
                ['/school/assets', ['school'], ['get', 'post', 'delete']],
                ['/school/labs/attachment', ['school'], ['get', 'delete']],
                ['/application-form', ['school'], ['get', 'post'], 'GrEduLabs\ApplicationForm\Acl\Assertion\CanSubmit'],
                ['/application-form/submit-success', ['school'], ['get']],
            ],
        ],
    ],
];
