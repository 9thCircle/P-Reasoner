<?php

$duration = (float)microtime(TRUE) - $start;

// output dataset

echo '<hr/><h3>writeAsHtmlTable</h3>';
@$infModel->writeAsHtmlTable();

echo '<hr/><h3>writeAsHtml</h3>';
@$infModel->writeAsHtml();

echo '<hr/><h3>writeRdfToString</h3>';
@$infModel->writeRdfToString();

echo '<hr/><h3>toStringIncludingTriples</h3>';
@$infModel->toStringIncludingTriples();

echo '<hr/><h3>Profile</h3>';
echo $infModel->getProfile()->getHTMLTable();

echo '<hr/><h3>Elapsed Time</h3>';
echo '<p>' . $duration . '</p>';

// no fatal errors
echo '<p>&gt;&gt; END OF FILE</p>';

?>