<?php

/**
 * Tx_Asdis_Content_Scraper_Html_Favicon tests.
 */
class Tx_Asdis_Content_Scraper_Html_FaviconTest extends Tx_Asdis_Tests_AbstractTestcase {

	/**
	 * @var Tx_Asdis_Content_Scraper_Html_Favicon
	 */
	private $scraper;

	/**
	 * (non-PHPdoc)
	 */
	protected function setUp() {
		$this->scraper = new Tx_Asdis_Content_Scraper_Html_Favicon();
	}

	/**
	 * @test
	 */
	public function scrape() {
		$content      = '<link href="typo3temp/favicon.ico" rel="icon" />';
		$assetFactory = $this->getMock('Tx_Asdis_Domain_Model_Asset_Factory');
		$assetFactory->expects($this->exactly(3))->method('createAssetsFromPaths')->with(array('typo3temp/favicon.ico'))->will($this->returnValue(new Tx_Asdis_Domain_Model_Asset_Collection()));
		$attributeExtractor = $this->getMock('Tx_Asdis_Content_Scraper_Extractor_XmlTagAttribute');
		$attributeExtractor->expects($this->exactly(3))->method('getAttributeFromTag')->will($this->returnValue(array('paths' => array('typo3temp/favicon.ico'), 'masks' => array('"'))));
		$this->scraper->injectAssetFactory($assetFactory);
		$this->scraper->injectXmlTagAttributeExtractor($attributeExtractor);
		$this->scraper->scrape($content);
	}
}

