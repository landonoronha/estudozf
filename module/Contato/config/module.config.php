<?php
return array(
    'router' => array(
        'routes' => array(
            'album' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/contato',
                    'defaults' => array(
                        'controller' => 'Contato\Controller\Home',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:action]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Contato\Controller\Home' => 'Contato\Controller\HomeController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);