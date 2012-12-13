<?php
return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/[:year/:month]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                        'year'       => date('Y'),
                        'month'      => date('m')
                    ),
                ),
            ),
            'matchresult' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/matchresult/:year/:month/:player1/:player2',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'matchresult',
                    ),
                ),
            ),
	    'player' => array(
		'type' => 'Segment',
		'options' => array(
		    'route' => '/player',
		    'defaults' => array(
			'controller' => 'Application\Controller\Player',
		    ),
		),
		'child_routes' => array(
		    'add' => array(
			'type'    => 'Segment',
			'options' => array(
			    'route'    => '/add',
			    'defaults' => array(
				'action' => 'add'
			    ),
			),
		    )
		)
	    )
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'Application\Controller\Index' => function(Zend\Mvc\Controller\ControllerManager $cm) {
                $sm = $cm->getServiceLocator();
                $controller = new \Application\Controller\IndexController(
                    $sm->get("doctrine.entitymanager.orm_default")
                );
                $startDate = new \DateTime();
                $startDate->setDate(2012, 12, 01);
                $startDate->setTime(0, 0, 0);
                $controller->setStartDate($startDate);
                return $controller;
	        },
	    'Application\Controller\Player' => function(Zend\Mvc\Controller\ControllerManager $cm) {
		$sm = $cm->getServiceLocator();
		return new \Application\Controller\PlayerController(
		    $sm->get("doctrine.entitymanager.orm_default")
		);
            }
        )
    ),
    'doctrine' => array(
        'driver' => array(
            'Application_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Application/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Application\Entity' => 'Application_driver'
                )
            )
        )
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
            'paginationcontrol'       => __DIR__ . '/../view/pagination_control.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'view_helpers' => array(
       'invokables' => array(
          'match' => 'Application\ViewHelper\Match',
       ),
    ),
);