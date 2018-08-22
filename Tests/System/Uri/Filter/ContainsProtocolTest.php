<?php

/**
 * Tx_Asdis_System_Uri_Filter_ContainsProtocol test case.
 */
class Tx_Asdis_System_Uri_Filter_ContainsProtocolTest extends Tx_Asdis_Tests_AbstractTestcase {

	/**
	 * @var Tx_Asdis_System_Uri_Filter_ContainsProtocol
	 */
	private $filter;

	/**
	 * (non-PHPdoc)
	 */
	protected function setUp() {
		$this->filter = new Tx_Asdis_System_Uri_Filter_ContainsProtocol();

	}

	/**
	 * @test
	 */
	public function filter() {
		$paths         = array(
			'http://typo3temp/pics/foo.gif',
			'https://typo3temp/pics/foo.gif',
			'###HTTP_S###typo3temp/pics/foo.gif',
			'typo3temp/pics/foo.jpg'
		);
		$filteredPaths = $this->filter->filter($paths);
		$this->assertInternalType('array', $filteredPaths);
		$this->assertEquals(1, sizeof($filteredPaths));
		$this->assertEquals($paths[3], $filteredPaths[0]);
	}
}

