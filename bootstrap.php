<?php 
$f3 = \Base::instance();
$global_app_name = $f3->get('APP_NAME');

switch ($global_app_name) 
{
    case "admin":
        // register event listener
        \Dsc\System::instance()->getDispatcher()->addListener(\Redirect\Listener::instance());

        // register all the routes        
        \Dsc\System::instance()->get('router')->mount( new \Redirect\Routes );
        
        // append this app's UI folder to the path
        // new way
        \Dsc\System::instance()->get('theme')->registerViewPath( __dir__ . '/src/Redirect/Admin/Views/', 'Redirect/Admin/Views' );
        // old way
        $ui = $f3->get('UI');
        $ui .= ";" . $f3->get('PATH_ROOT') . "vendor/dioscouri/f3-redirect/src/Redirect/Admin/Views/";
        $f3->set('UI', $ui);
        
        // TODO set some app-specific settings, if desired
                
        break;
    case "site":        
		$f3->set('ONERROR',
            function($f3) {
               
               if($f3->get('ERROR.code') == '404')  {
//                $redirect = (new \Redirect\Factory($PARAMS[0]))->redirect();

               }
               
            }
        );
        // TODO set some app-specific settings, if desired
        break;
}
?>