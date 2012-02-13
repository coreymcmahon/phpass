<?php
/**
 * PHP Password Library
 *
 * @package PHPass
 * @category Cryptography
 * @author Ryan Chouinard <rchouinard at gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html MIT License
 * @link https://github.com/rchouinard/phpass PHPass project at GitHub.
 */

namespace Phpass;

/**
 * PHP Password Library
 *
 * @package PHPass
 * @category Cryptography
 * @author Ryan Chouinard <rchouinard at gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html MIT License
 * @link https://github.com/rchouinard/phpass PHPass project at GitHub.
 */
class Loader
{

    /**
     * Load a library class.
     *
     * Performs checks to make sure only local library classes are loaded, and
     * the class file exists within the library path.
     *
     * @param string $class
     *   The fully qualified class name to load.
     * @return void
     */
    static public function load($class)
    {
        if (substr($class, 0, 6) !== 'Phpass') {
            return;
        }

        $libraryRoot = realpath(__DIR__ . '/../');
        $file = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
        $file = realpath($libraryRoot . DIRECTORY_SEPARATOR . $file);
        if (substr($file, 0, strlen($libraryRoot)) == $libraryRoot) {
            if (is_readable($file)) {
                include $file;
            }
        }
    }

    /**
     * Register an autoloader for the library.
     *
     * @return boolean
     *   True on success, false on failure.
     */
    static public function registerAutoloader()
    {
        return spl_autoload_register(array (self, 'load'));
    }

}