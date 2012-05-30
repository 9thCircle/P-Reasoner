<html>
<head>
<title>RAP Test</title>
</head>
<body>
<h1>Test a File</h1>
<form action="test_file.php" method="get">
	<p>
		URL di un File: 
		<input type="text" name="file" size="100" maxlength="255" value="xml/" required="required" autofocus="autofocus" autocomplete="on" />
	</p>
	<p>
		Scegli una Sintassi: 
		<select name="syntax">
			<option value="">Automatico</option>
			<option value="RDF">RDF</option>
			<option value="N3">Notation3</option>
			<option value="GRDDL">GRDDL</option>
			<option value="RSS">RSS</option>
			<option value="RDF">RDF</option>
			<option value="RDF">RDF</option>
		</select>
	</p>
	<p>
		Scegli un Ragionatore: 
		<select name="reasoner">
			<option value="InfModelF">InfModelF</option>
			<option value="InfModelB">InfModelB</option>
		</select>
	</p>
	<p>
		<input type="submit" value="PARSE" />
	</p>
	<p>
		<strong>Note:</strong>
	</p>
	<ul>
		<li>
			I due Ragionatori conoscono le stesse regole (che sono definite fuori da essi).
			L'unica differenza dovrebbe essere nelle prestazioni.
			A seconda del Ragionatore scelto potresti vedere le Triple in ordine diverso, ma il numero
			delle Triple non dovrebbe cambiare.
		</li>
		<li>
			GRDDL &egrave; per i file XHTML.<br/>
			Se non scegli una sintassi cerca di capirla dall'estensione del file,
			e se non la capisce usa RDF.<br/>
			Le regole semantiche che conosce verranno applicate a prescindere dalla sintassi.
		</li>
	</ul>
</form>
<?php

if (empty($_GET['file']) === FALSE) {
	require_once 'inc.php';
	
	$syntax = empty($_GET['syntax']) === TRUE ? $_GET['syntax'] : NULL;
	
	$infModel = $_GET['reasoner'] === 'InfModelF' ?
		ModelFactory::getInfModelF('onto://InfModelF/') : 
		ModelFactory::getInfModelB('onto://InfModelB/');
	
	$infModel->startProfile();
	$infModel->load($_GET['file'], $syntax);
	
	require_once 'end.php';
}

?>
</body>
</html>