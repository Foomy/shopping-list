<?php

class IndexController extends Zend_Controller_Action
{
	private $model = null;

	public function indexAction()
	{
		$this->view->items = $this->model()->getItems();
		$this->view->itemCount = $this->model()->getItemCount();
	}

	public function saveAction()
	{
		if (! $this->isAjax()) {
			$this->redirect('/');
		}

		$param = $this->_getParam('newEntries');
		if (empty($param)) {
			$this->_helper->json(array(
				'error' => true,
				'message' => 'No entries to save given.',
				'itemCount' => $this->model()->getItemCount()
			));
		}

		$filter = new Zend_Filter_StringTrim();

		$newEntries = explode(',', $param);
		foreach ($newEntries as $newEntry) {
			$filteredEntry = $filter->filter($newEntry);
			$this->model()->addItem($newEntry);
		}
		$this->model()->write();

		$this->_helper->json(array(
			'error' => false,
			'message' => 'Entries saved.',
			'itemCount' => $this->model()->getItemCount()
		));
	}

	/**
	 * Checks, if the request is a ajax request.
	 *
	 * @return	bool
	 */
	protected function isAjax()
	{
		return $this->getRequest()->isXmlHttpRequest();
	}

	/**
	 * Lazy initialization of the model class.
	 *
	 * @param	ShoppingList $model
	 * @return	Model_ShoppingList|null|ShoppingList
	 */
	protected function model(ShoppingList $model = null)
	{
		if (null === $this->model) {
			if (null === $model) {
				$model = new Model_ShoppingList();
			}

			$this->model = $model;
		}

		return $this->model;
	}
}

