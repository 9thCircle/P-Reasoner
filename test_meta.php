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
<p>Only Base Rules are shown here. Dynamic Rules cannot be listed.<br/>
Rules which are disabled are not listed.<br/>
The rules are applied in this order.
</p>
<?php

require_once 'inc.php';

// use InfModelF
$infModel = ModelFactory::getInfModelF('onto://InfModelF/', TRUE);

echo $infModel->rulesTable();

?>
<h2>Supported Inferences Table</h2>
<p>This table shows the Inferences which are supported and enabled.<br/>
Each of these rules generates Dynamic Rules at runtime.<br/>
Dynamic Rules are applied after Base Rules.
</p>
<?php

echo $infModel->inferencesTable();

?>
</body>
</html>