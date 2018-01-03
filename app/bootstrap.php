<?php
  // Load Config
require_once 'config/config.php';

  // Autoload Core Libraries ClassName and file name should and must be identical.
spl_autoload_register(function ($className) {
  require_once 'libraries/' . $className . '.php';
});

