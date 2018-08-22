<?php

/**
 * Tx_Asdis_Content_Scraper_Html_OpenGraphImage tests.
 */
class Tx_Asdis_Content_Scraper_Html_OpenGraphImageTest extends Tx_Asdis_Tests_AbstractTestcase {

	/**
	 * @var Tx_Asdis_Content_Scraper_Html_OpenGraphImage
	 */
	private $scraper;

	/**
	 * (non-PHPdoc)
	 */
	protected function setUp() {
		$this->scraper = new Tx_Asdis_Content_Scraper_Html_OpenGraphImage();
	}

	/**
	 * @test
	 */
	public function scrape() {
		$content      = '<meta property="og:image" content="uploads/images/foo.gif" />';
		$assetFactory = $this->getMock('Tx_Asdis_Domain_Model_Asset_Factory');
		$assetFactory->expects($this->once())->method('createAssetsFromPaths')->with(array('uploads/images/foo.gif'));
		$attributeExtractor = $this->getMock('Tx_Asdis_Content_Scraper_Extractor_XmlTagAttribute');
		$attributeExtractor->expects($this->once())->method('getAttributeFromTag')->with('meta', 'content', $content, array('property' => 'og:image'))->will($this->returnValue(array('paths' => array('uploads/images/foo.gif'), 'masks' => array('"'))));
		$this->scraper->injectAssetFactory($assetFactory);
		$this->scraper->injectXmlTagAttributeExtractor($attributeExtractor);
		$this->scraper->scrape($content);
	}
}

