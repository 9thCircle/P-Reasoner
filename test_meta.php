<!doctype html>
<html>
<head>
<title>Test MetaInfo</title>
</head>
<body>
<h1>Meta Info</h1>
<p>Methods which show info in this page are written by santec.
</p>
<h2>Base-Rules Table</h2>
<p>Only Base Rules are shown here. Predicate-based rules cannot be listed.<br/>
Rules which are disabled are not listed.<br/>
The rules are applied in this order.
</p>
<?php

require_once 'inc.php';

// use InfModelF
$infModel = ModelFactory::getInfModelF('onto://InfModelF/', TRUE);

echo $infModel->rulesTable();


?>
</body>
</html>