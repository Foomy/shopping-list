<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	/**
	 * Bootstrap autoloader for application resources
	 *
	 * @return Zend_Application_Module_Autoloader
	 */
	protected function _initAutoload()
	{
		$config = $this->getOption('autoloader');
		$autoloader = new Zend_Loader_Autoloader_Resource($config);

		return $autoloader;
	}

	/**
	 * Initialises the view.
	 *
	 * @return Zend_View $view   The View Object.
	 */
	protected function _initView()
	{
		$view = new Zend_View();

		$appOptions = (object)$this->getOption('app');
		$view->appOptions = $appOptions;

		$view->skin = 'default';
		$view->skin = 'mobile';

		$view->doctype('HTML5');
		$view->headTitle($appOptions->title);

		$view->headMeta()->setCharset('utf-8');

		$view->headScript()->appendFile('/js/jquery-1.9.1.min.js', 'text/javascript');


		$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
		$viewRenderer->setView($view);

		return $view;
	}
}