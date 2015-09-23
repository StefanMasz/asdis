<?php

/**
 * @package Tx_Asdis
 * @subpackage Typo3_Hook
 * @author Timo Fuchs <timo.fuchs@aoe.com>
 */
class Tx_Asdis_Typo3_Hook_ContentPostProcAll extends Tx_Asdis_Typo3_Hook_AbstractHook {

	/**
	 * @param array $params
	 * @param \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController $pObj
	 * @return void
	 */
	public function process(&$params, \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController $pObj = NULL) {
		if($this->getConfigurationProvider()->isDefaultHookHandlingDisabled()) {
			return;
		}
		if (NULL === $pObj) {
			if (isset($params['pObj']) && ($params['pObj'] instanceof \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController)) {
				$pObj = $params['pObj'];
			} else {
				$pObj = $GLOBALS['TSFE'];
			}
		}
		try {
			$this->setPageObject($pObj);
			$this->scrapeAndReplace();
		} catch(Exception $e) {
			$this->getLogger()->logException(__METHOD__, $e);
		}
	}

	/**
	 * Call main process hook function only if there are no INTincScripts to include.
	 * This function is called as contentPostProc-all hook.
	 *
	 * @param array $params
	 * @param \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController $pObj
	 * @return void
	 */
	public function processCache(&$params, \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController $pObj = NULL) {
		if ($GLOBALS['TSFE']->isINTincScript()) {
			return;
		}
		$this->process($params, $pObj);
	}

	/**
	 * Call main process hook function only if there are INTincScripts to include.
	 * This function is called as contentPostProc-output hook.
	 * @param array $params
	 * @param \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController $pObj
	 * @return void
	 */
	public function processNoCache(&$params, \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController $pObj = NULL) {
		if (!$GLOBALS['TSFE']->isINTincScript()) {
			return;
		}
		$this->process($params, $pObj);
	}

}