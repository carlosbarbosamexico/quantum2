<?php

require_once ("../quantum/quantum.php");

$quantum = new Quantum();
$quantum->setConfig('development');
$quantum->boot();

?>