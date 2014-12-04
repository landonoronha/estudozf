<?php
return array(
    'router' => array(
        'routes' => array(
            'contato' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/home',
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
            ),                        # literal para action sobre home
        'sobre' => array(
            'type'      => 'Literal',
            'options'   => array(
                'route'    => '/sobre',
                'defaults' => array(
                    'controller' => 'Contato\Controller\Home',
                    'action'     => 'sobre',
                ),
            ),
          ),
            'contatos' => array(
             'type'      => 'Segment',
                 'options'   => array(
                 'route'    => '/contatos[/:action][/:id]',
                 'constraints' => array(
                    'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    'id'     => '[0-9]+',
        ),
        'defaults' => array(
            'controller' => 'Contato\Controller\Contatos',
            'action'     => 'index',
        ),
    ),
),
        ),
    ),
    # definir e gerenciar controllers
    'controllers' => array(
        'invokables' => array(
            'Contato\Controller\Home' => 'Contato\Controller\HomeController',
            'Contato\Controller\Contatos'    => 'Contato\Controller\ContatosController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);