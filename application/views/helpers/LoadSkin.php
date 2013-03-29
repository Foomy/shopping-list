<?php

require_once 'Zend/View/Helper/Abstract.php';

/**
 * Loads the CSS skin for the website.
 *
 * @author		Sascha Schneider <foomy.code@arcor.de>
 *
 * @category	helper
 * @package		Zend_View_Helper_LoadSkin
 */
class Zend_View_Helper_LoadSkin extends Zend_View_Helper_Abstract
{
	public function loadSkin($skin)
	{
		// Load the skin config file
		$skinData = new Zend_Config_Xml('./skins/' . $skin . '/skin.xml');

		if ($skinData->stylesheets->stylesheet instanceof Zend_Config) {
			$stylesheets = $skinData->stylesheets->stylesheet->toArray();
		}
		else {
			// If there is only one stylesheet in the xml-file it will be returned as string.
			$stylesheets = array($skinData->stylesheets->stylesheet);
		}

		// Append each stylesheet
		if (is_array($stylesheets)) {
			foreach ($stylesheets as $stylesheet) {
				$this->view->headLink()->appendStylesheet('/skins/' . $skin . '/css/' . $stylesheet) . PHP_EOL;
			}
		}
	}
}
