<?php
// declara aqui la function date_default_timezone_set('America/Caracas')

$horaE	= new DateTime('midnight');
$horaE->format("h:i:s");
$horaE->modify("+9 hour,+00 minute");
$horaS	= new DateTime('midnight');
$horaS->format("h:i:s");
$horaS->modify("+9 hour,+10 minute");

var_dump( $horaS->format("h:i:s"),date( "h:i:s", time() ) );

?>
