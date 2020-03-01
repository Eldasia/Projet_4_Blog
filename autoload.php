<?php

function autoload($classname)
{
  if (file_exists($file = $classname . '.php'))
  {
    echo $file;
    require $file;
  }
}

spl_autoload_register('autoload');