<?php

/**
 * Méthode pour inclure le fichier de la classe $className.
 * @param $fqn
 * @throws Exception
 */
function autoload($fqn)
{
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $fqn);
    $file = LIB_BASEFILE . '/' . $path . '.php';
    if (!file_exists($file)) {
        throw new \Exception("Le fichier " . $file . " n'existe pas.");
    }
    include $file;
}
