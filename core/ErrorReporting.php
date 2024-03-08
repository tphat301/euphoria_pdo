<?php

function errorReporting($errno, $errstr, $errfile, $errline)
{
  echo "<strong>Error:</strong> $errno<br>";
  echo "<strong>Error string:</strong> $errstr<br>";
  echo "<strong>Error at file:</strong> $errfile <br>";
  echo "<strong>Error at line:</strong> $errline <br>";
}
