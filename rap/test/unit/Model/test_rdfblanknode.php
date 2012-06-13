<?php

require_once '../inc.php';
require_once RAP_DIR         . '/api/rdfapi.php';
require_once SIMPLETEST_DIR  . '/autorun.php';


class RDFBlankNodeTest extends UnitTestCase
{	 	
	private $URI = 'BlankNode1';
	private $bn;
	
	public function setUp()
	{
		$this->bn = new RDFResource($this->URI);
	}
	
	public function tearDown()
	{
		$this->bn = NULL;
	}
	
	private function generateBNode(){
		$node = new RDFBlankNode('http://www.example.org','localname');
		return $node;
	}
	
	// test
	
	public function testGetID()
	{
		$bnode=$this->generateBNode();
		$this->assertEqual($bnode->getId(),'http://www.example.orglocalname');
	}
	
	// this does not make sense with BlankNodes, but is inherited
	public function testGetURI()
	{
		$this->assertTrue($this->bn->getURI() === $this->URI);
	}
	
	public function testGetLabel()
	{
		$bnode = $this->generateBNode();
		$this->assertEqual($bnode->getLabel(),'http://www.example.orglocalname');
	}
	
	public function testToString()
	{
		$bnode = $this->generateBNode();
		$this->assertEqual($bnode->toString(), 'RDFBlankNode("http://www.example.orglocalname")');
		$this->assertTrue($bnode->toString() === "$bnode");
	}
	
	// this does not make sense with BlankNodes, but is inherited
	public function testGetNamespace()
	{
		$res = new RDFResource('http://www.w3.org/2000/01/rdf-schema#subClassOf');
		$this->assertTrue($res->getNamespace() === 'http://www.w3.org/2000/01/rdf-schema#');
	}
	
	// this does not make sense with BlankNodes, but is inherited
	public function testGetLocalName()
	{
		$res = new RDFResource('http://www.w3.org/2000/01/rdf-schema#subClassOf');
		$this->assertTrue($res->getLocalName() === 'subClassOf');
	}
	
	public function testEquals()
	{
		$bnode1 = $this->generateBNode();
		$bnode2 = $this->generateBNode();
		$this->assertTrue($bnode1->equals($bnode2));
	}
	
	public function testNotEquals(){
		$bnode1 = $this->generateBNode();
		$bnode2 = new RDFBlankNode('http://www.example.orglocalname',  'localname2');
		$bnode3 = new RDFBlankNode('http://www.example.orglocalname1', 'localname');
		$this->assertFalse($bnode1->equals($bnode2));
		$this->assertFalse($bnode1->equals($bnode3));
		$this->assertFalse($bnode1->equals(NULL));
	}
}
 	
?>