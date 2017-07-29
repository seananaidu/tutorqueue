<?php

class StudentModelTest extends PHPUnit_Framework_TestCase {

    /**
     * @var StudentModel
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        // these ensure that the database has some data to make sure
        // the methods aren't being called on an empty data set
        $this->object = new StudentModel;
        $database = DatabaseFactory::getFactory()->getConnection();
        $query = $database->prepare("INSERT INTO qscTutorList.tblAllTutors (uuid, name, tutcode) VALUES (2000000, 'testperson', 9999999)");
        $query->execute();

        $database = DatabaseFactory::getFactory()->getConnection();
        $query = $database->prepare("INSERT INTO qscSubjects.tblTutorSubjects (id, name) VALUES (2000000, 'TestField (TEST)')");
        $query->execute();


        }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        $database = DatabaseFactory::getFactory()->getConnection();
        $query = $database->prepare("DELETE FROM qscTutorList.tblAllTutors WHERE uuid = 2000000 AND name = 'testperson' AND tutcode = 9999999");
        $query->execute();

        $database = DatabaseFactory::getFactory()->getConnection();
        $query = $database->prepare("DELETE FROM qscSubjects.tblTutorSubjects WHERE id = 2000000 AND name = 'TestField (TEST)'");
        $query->execute();

    }

    /**
     * @covers StudentModel::getSubjects
     */
    public function testGetSubjects() {
        $methodCall = StudentModel::getSubjects();
        $database = DatabaseFactory::getFactory()->getConnection();
        $query = $database->query("SELECT * FROM qscSubjects.tblTutorSubjects");
        $testCall = $query->fetchAll();

        $this->assertEquals($methodCall, $testCall, "\$canonicalize = true", $delta = 0.0, $maxDepth = 10, $canonicalize = true);

    }

    /**
     * @covers StudentModel::getSubSubjects
     * @todo   Implement testGetSubSubjects().
     */
    public function testGetSubSubjects() {
        $identityNumber = 2000000;

        $methodCall = StudentModel::getSubSubjects($identityNumber);
        $database = DatabaseFactory::getFactory()->getConnection();
        $query = $database->query("SELECT * FROM qscSubjects.tblTutorSubSubjects WHERE id =".$identityNumber);
        $testCall = $query->fetchAll();

        $this->assertEquals($methodCall, $testCall, "\$canonicalize = true", $delta = 0.0, $maxDepth = 10, $canonicalize = true);
    }

    /**
     * @covers StudentModel::getSubSubjectsAll
     * @todo   Implement testGetSubSubjectsAll().
     */
    public function testGetSubSubjectsAll() {

        $methodCall = StudentModel::getSubSubjectsAll();
        $database = DatabaseFactory::getFactory()->getConnection();
        $query = $database->query("SELECT * FROM qscSubjects.tblTutorSubSubjects");
        $testCall = $query->fetchAll();

        $this->assertEquals($methodCall, $testCall, "\$canonicalize = true", $delta = 0.0, $maxDepth = 10, $canonicalize = true);
    }

    /**
     * @covers StudentModel::getTutors
     * @todo   Implement testGetTutors().
     */
    public function testGetTutors() {
        $methodCall = StudentModel::getTutors();
        $database = DatabaseFactory::getFactory()->getConnection();
        $query = $database->query("SELECT * FROM qscTutorList.tblAllTutors");
        $testCall = $query->fetchAll();

        $this->assertEquals($methodCall, $testCall, "\$canonicalize = true", $delta = 0.0, $maxDepth = 10, $canonicalize = true);
    }

}