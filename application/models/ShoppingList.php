<?php

class Model_ShoppingList
{
	private $items = array();

	public function __construct()
	{
		$this->load();
	}

	public function getItems()
	{
		return $this->items;
	}

	public function getItemCount()
	{
		return count($this->items);
	}

	public function addItem($item)
	{
		$this->items[] = $item;
	}

	public function addItems(array $items)
	{
		foreach ($items as $item) {
			$this->addItem($item);
		}
	}

	public function removeItem($itemIdx)
	{
		$items = $this->items;
	 	unset($items[$itemIdx]);
		$this->items = array_values($items);
	}

	public function load()
	{
		$file = DOCUMENT_ROOT . '/data/list.csv';
		if (false !== ($fh = fopen($file, 'r'))) {
			$this->items = fgetcsv($fh, 0, ',');
		}
		fclose($fh);
	}

	public function write()
	{
		if (! empty($this->items)) {
			$file = DOCUMENT_ROOT . '/data/list.csv';
			if (false !== ($fh = fopen($file, 'w+'))) {
				fputcsv($fh, $this->items);
				fclose($fh);
			}
		}
	}
}