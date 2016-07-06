<?php defined('PHPREDIS_TESTRUN') or die("Use TestRedis.php to run tests!\n");

require_once(dirname($_SERVER['PHP_SELF'])."/TestSuite.php");

class Redis_Session extends TestSuite
{
    public function setUp() {
    	return;
    }

    public function testDynomite() {
    	$this->assertEquals("dynomite", session_module_name());
    }

    public function testSave() {
    	$session_id = session_id();
    	$myobj = new StdClass();
    	$myobj->foo = 'bar';
    	//save
    	$_SESSION['foo'] = 'bar';
    	$_SESSION['array'] = json_encode(['foo'=>'bar']);
    	$_SESSION['myobj'] = json_encode($myobj);
    	return true;
    }

    public function testGet() {
    	$session_id = session_id();
    	//get
    	$array = json_decode($_SESSION['array'],true);
    	$myobj = json_decode($_SESSION['myobj']);
    	$this->assertEquals($_SESSION['foo'],'bar');
    	$this->assertEquals($array['foo'],'bar');
    	$this->assertEquals($myobj->foo,'bar');
    }

    public function testDestroy() {
    	$this->assertTrue(session_destroy());
    }
}
?>