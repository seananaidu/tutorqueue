<?php

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-04-30 at 23:05:12.
 */
class HelpRequestModelTest extends PHPUnit_Framework_TestCase {

    /**
     * @var HelpRequestModel
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new HelpRequestModel;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }



    /**
     * @covers HelpRequestModel::getAllWait
     * @todo   Implement testGetAllWait().
     */
    public function testGetAllWait() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers HelpRequestModel::getAllProgress
     * @todo   Implement testGetAllProgress().
     */
    public function testGetAllProgress() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers HelpRequestModel::getAllOld
     * @todo   Implement testGetAllOld().
     */
    public function testGetAllOld() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers HelpRequestModel::createHelpRequest
     * @todo   Implement testCreateHelpRequest().
     */
    public function testCreateHelpRequest() {
        $testTblNo = 5;
        $testSubj = "SuperMath";
        $testSubSubj = "Intro to SuperMath 176";
        $testTutorReq = "The CompuMaster";
        
        HelpRequestModel::createHelpRequest($testTblNo, $testSubj, $testSubSubj, $testTutorReq);
        
    }

     /**
     * @covers HelpRequestModel::getAll
     * @todo   Implement testGetAll().
     */
    public function testGetAll() {
        // Remove the following lines when you implement this test.

        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }
    
    
    /**
     * @covers HelpRequestModel::updateEntry
     * @todo   Implement testUpdateEntry().
     */
    public function testUpdateEntry() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers HelpRequestModel::removeEntry
     * @todo   Implement testRemoveEntry().
     */
    public function testRemoveEntry() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers HelpRequestModel::updateNote
     * @todo   Implement testUpdateNote().
     */
    public function testUpdateNote() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers HelpRequestModel::deleteNote
     * @todo   Implement testDeleteNote().
     */
    public function testDeleteNote() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

}
