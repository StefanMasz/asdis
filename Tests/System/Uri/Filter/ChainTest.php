<?php

/**
 * Tx_Asdis_System_Uri_Filter_Chain test case.
 */
class Tx_Asdis_System_Uri_Filter_ChainTest extends Tx_Asdis_Tests_AbstractTestcase {

	/**
	 * @var Tx_Asdis_System_Uri_Filter_Chain
	 */
	private $chain;

	/**
	 * (non-PHPdoc)
	 */
	protected function setUp() {
		$this->chain = new Tx_Asdis_System_Uri_Filter_Chain();
	}

	/**
	 * @test
	 */
	public function filter() {
		$filter1 = $this->getMock('Tx_Asdis_System_Uri_Filter_ContainsProtocol');
		$filter2 = $this->getMock('Tx_Asdis_System_Uri_Filter_WildcardProtocol');
		$filter1->expects($this->once())->method('filter')->will($this->returnValue(array('/foo')));
		$filter2->expects($this->once())->method('filter');
		$this->chain->append($filter1);
		$this->chain->append($filter2);
		$this->chain->filter(array('/foo'));
	}
}

