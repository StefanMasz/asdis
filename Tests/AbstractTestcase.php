<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 AOE GmbH <dev@aoe.com>
 *  All rights reserved
 *
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * @package    asdis
 * @subpackage Tests
 */
abstract class Tx_Asdis_Tests_AbstractTestcase extends Tx_Phpunit_TestCase {
    protected $objectManagerMock;

    /**
     * setup
     */
    protected function setUp()
    {
        $this->objectManagerMock = $this->getMockBuilder('TYPO3\\CMS\\Extbase\\Object\\ObjectManager')->getMock();

        parent::setUp(); // TODO: Change the autogenerated stub
    }
}