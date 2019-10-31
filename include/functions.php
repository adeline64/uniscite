<?php

/**
 * Fonction servant au debug de l'application
 * @param string $text le texte a afficher
 * @param boolean $force force l'affichage ssi true
 */
function debug ($text,$force=false) {
    if (defined('_DEBUG_') || $force) {
        if (is_array($text) || is_object($text)) {
            echo '<pre>'.print_r($text,true).'</pre>'.PHP_EOL;
        } else {
            echo '<br/>'.$text.PHP_EOL;
        }
    }
}