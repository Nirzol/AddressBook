<?php

namespace AddressBook;

use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Validator\AbstractValidator;

class Module implements ConfigProviderInterface, BootstrapListenerInterface //AutoloaderProviderInterface,
{

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

//    public function getAutoloaderConfig()
//    {
//        return array(
//            'Zend\Loader\StandardAutoloader' => array(
//                'namespaces' => array(
//                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
//                ),
//            ),
//        );
//    }

    public function onBootstrap(EventInterface $e)
    {
        $sm = $e->getApplication()->getServiceManager();
        $translator = $sm->get('MvcTranslator');
        AbstractValidator::setDefaultTranslator($translator);
    }

}
