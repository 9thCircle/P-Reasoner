<?php

require_once '../inc.php';
require_once RAP_DIR         . '/api/rdfapi.php';
require_once SIMPLETEST_DIR  . '/autorun.php';


class RDFResourceTest extends UnitTestCase
{
	private $URI = 'test1';
	private $res1;
	
	public function setUp()
	{
		$this->res1 = new RDFResource($this->URI);
	}
	
	public function tearDown()
	{
		$this->res1 = NULL;
	}
	
	public function testGetURI()
	{
		$this->assertTrue($this->res1->getURI() === $this->URI);
	}
	
	public function testGetLabel()
	{
		$this->assertTrue($this->res1->getLabel() === $this->URI);
	}
	
	public function testToString()
	{
		$this->assertTrue((string)$this->res1 === 'RDFResource("test1")');
		$this->assertTrue((string)$this->res1 === $this->res1->toString());
	}
	
	public function testGetNamespace()
	{
		$res = new RDFResource('http://www.w3.org/2000/01/rdf-schema#subClassOf');
		$this->assertTrue($res->getNamespace() === 'http://www.w3.org/2000/01/rdf-schema#');
	}
	
	public function testGetLocalName()
	{
		$res = new RDFResource('http://www.w3.org/2000/01/rdf-schema#subClassOf');
		$this->assertTrue($res->getLocalName() === 'subClassOf');
	}
	
	public function testEquals()
	{
		$res2     = new RDFResource('test2');
		$res1bis  = new RDFResource($this->URI);
		$this->assertTrue($this->res1->equals(NULL) === FALSE);
		$this->assertTrue($this->res1->equals($res2) === FALSE);
		$this->assertTrue($this->res1->equals($this->res1) === TRUE);
		$this->assertTrue($this->res1->equals($res1bis) === TRUE);
	}
}

?>