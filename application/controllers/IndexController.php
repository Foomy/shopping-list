<?php

class IndexController extends Zend_Controller_Action
{
    public function init()
    {
    }

    public function indexAction()
    {
    }

	public function saveAction()
	{
		$this->_helper->json(array(
			'error' => false,
			'message' => ''
		));
	}
}

