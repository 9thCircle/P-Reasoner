<?php

require_once '../inc.php';
require_once RAP_DIR         . '/api/rdfapi.php';
require_once SIMPLETEST_DIR  . '/autorun.php';


class RDFLiteralTest extends UnitTestCase
{
	private $label1  = 'literal1';
	private $n1      = NULL;
	
	private $label2  = 'literal2';
	private $lang2   = 'it';
	private $n2      = NULL;
	
	private $label3  = 'literal3';
	private $lang3   = 'it';
	private $type3   = 'http://www.w3.org/2000/01/rdf-schema#integer';
	private $n3      = NULL;
	
	public function setUp()
	{
		$this->n1 = new RDFLiteral($this->label1);
		$this->n2 = new RDFLiteral($this->label2, $this->lang2);
		$this->n3 = new RDFLiteral($this->label3, $this->lang3, $this->type3);
	}
	public function tearDown()
	{
		$this->n1 = NULL;
		$this->n2 = NULL;
		$this->n3 = NULL;
	}
	
	
	
	public function testGetLabel()
	{
		$this->assertTrue($this->n1->getLabel() === $this->label1);
	}
	
	public function testGetLanguage()
	{
		$this->assertTrue($this->n1->getLanguage()  === NULL);
		$this->assertTrue($this->n2->getLanguage()  === $this->lang2);
	}
	
	public function testSetLanguage()
	{
		$this->n1->setLanguage('en');
		$this->assertTrue($this->n1->getLanguage()  === 'en');
	}
	
	public function testGetDatatype()
	{
		$this->assertTrue($this->n1->getDatatype()  === NULL);
		$this->assertTrue($this->n3->getDatatype()  === $this->type3);
	}
	
	public function testSetDatatype()
	{
		$type = 'http://www.w3.org/2000/01/rdf-schema#string';
		$this->n1->setDatatype($type);
		$this->assertTrue($this->n1->getDatatype()  === $type);
	}
	
	public function testEquals()
	{
		$literal1=new RDFLiteral('test');
		$literal2=new RDFLiteral('test');
		$this->assertTrue($literal1->equals($literal2));
		$literal2->setLanguage('DE');
		$this->assertFalse($literal1->equals($literal2));
		$literal1->setLanguage('FR');
		$this->assertFalse($literal1->equals($literal2));
		$literal1->setLanguage('DE');
		$this->assertTrue($literal1->equals($literal2));
		$literal1->setDatatype("http://www.w3.org/TR/xmlschema-2/integer");
		$this->assertFalse($literal1->equals($literal2));
		$literal2->setDatatype("http://www.w3.org/TR/xmlschema-2/integer1");
		$this->assertFalse($literal1->equals($literal2));
		$literal2->setDatatype("http://www.w3.org/TR/xmlschema-2/integer");
		$this->assertTrue($literal1->equals($literal2));
	}
}

?>