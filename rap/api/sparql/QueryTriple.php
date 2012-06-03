<?php
// ---------------------------------------------
// Class: QueryTriple
// ---------------------------------------------
require_once RDFAPI_INCLUDE_DIR . 'sparql/SparqlVariable.php';

/**
* Represents a query triple with subject, predicate and object.
*
* @author   Tobias Gauss <tobias.gauss@web.de>
* @version	$Id$
* @license http://www.gnu.org/licenses/lgpl.html LGPL
*
* @package sparql
*/
class QueryTriple extends RDFObject
{

    /**
    * The QueryTriples Subject.
    * Can be a RDFBlankNode or RDFResource, string in
    * case of a variable
    * @var RDFNode/string
    */
    protected $subject;

    /**
    * The QueryTriples Predicate.
    * Normally only a RDFResource, string in
    * case of a variable
    * @var RDFNode/string
    */
    protected $predicate;

    /**
    * The QueryTriples Object.
    * Can be RDFBlankNode, RDFResource or RDFLiteral, string in
    * case of a variable
    * @var RDFNode/string
    */
    protected $object;



    /**
    * Constructor
    *
    * @param RDFNode $sub  Subject
    * @param RDFNode $pred Predicate
    * @param RDFNode $ob   Object
    */
    public function QueryTriple($sub,$pred,$ob)
    {
        $this->subject   = $sub;
        $this->predicate = $pred;
        $this->object    = $ob;
    }

    /**
    * Returns the Triples Subject.
    *
    * @return RDFNode
    */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
    * Returns the Triples Predicate.
    *
    * @return RDFNode
    */
    public function getPredicate()
    {
        return $this->predicate;
    }

    /**
    * Returns the Triples Object.
    *
    * @return RDFNode
    */
    public function getObject()
    {
        return $this->object;
    }



    /**
    *   Returns an array of all variables in this triple.
    *
    *   @return array   Array of variable names
    */
    public function getVariables()
    {
        $arVars = array();

        foreach (array('subject', 'predicate', 'object') as $strVar) {
            if (SparqlVariable::isVariable($this->$strVar)) {
                $arVars[] = $this->$strVar;
            }
        }

        return $arVars;
    }//public function getVariables()



    public function __clone()
    {
        foreach (array('subject', 'predicate', 'object') as $strVar) {
            if (is_object($this->$strVar)) {
                $this->$strVar = clone $this->$strVar;
            }
        }
    }//public function __clone()

}//class QueryTriple extends RDFObject

// end class: QueryTriple.php
?>