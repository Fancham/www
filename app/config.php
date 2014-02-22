<?php

Atomik::set(array(

    'plugins' => array(
		'Logger' => array('register_default' => true,
    					  'filename' => 'log.txt'
    					),
        'DebugBar' => array(
            // if you don't include jquery yourself as it is done in the
            // skeleton, comment out this line (the debugbar will include jquery)
            'include_vendors' => 'css'
        ),
        'Errors' => array(
            'catch_errors' => true
        ),
        'Session',
        'Flash'
    ),
	
	// WARNING: change this to false when in production
    'atomik.debug' => true,
	
	'atomik.class_autoload' => true,
	
	// Permet de définir des routages utiliser ensuite avec url().
    // offre également la possibilité de créer des "alias"
    // voir doc en ligne pour plus d'info
    'app.routes' => array(
        'mysite/hello' => array(
        'action' => 'hello'
        ),
        'mysite/hello2' => array(
        '@name' => 'hello3',
        'action' => 'hello'
        )
    ),

    // le Layout utilisé par defaut
    'app.layout' => '_Layout_Ihm_Fancham_Publique',
    // l'action appelé par defaut
    'app.default_action' => 'Accueil_Publique',
    // Active l'url rewriting (les urls généré avec la méthode url() seront correctement formatées)
    // voir doc en ligne pour plus d'info
    'atomik.url_rewriting' => true
    
))
;
