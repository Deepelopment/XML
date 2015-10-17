<?php
/**
 * PHP Deepelopment Framework.
 *
 * @package Deepelopment/Debeetle
 * @license Unlicense http://unlicense.org/
 */

namespace Deepelopment\XML;

use RuntimeException;

/**
 * Abstract class used to parse XML configure files.
 *
 * @package Deepelopment/XML
 * @author  deepeloper ({@see https://github.com/deepeloper})
 */
abstract class Parser
{
    /**
     * XML element class name, cab be overriden in child classes
     *
     * @var string
     */
    protected $elementClassName = 'Deepelopment\\XML\\Element';

    /**
     * XML element
     *
     * @var SimpleXMLElement
     */
    protected $element;

    /**
     * @param  string $path  XML file path
     * @throws RuntimeException  If XML file contain errors
     */
    public function __construct($path)
    {
        libxml_use_internal_errors(TRUE);

        $this->element = simplexml_load_file((string)$path, $this->elementClassName);
        if (!$this->element) {
            $errors = array();
            foreach (libxml_get_errors() as $error) {
                $errors[] = trim($error->message);
            }
            throw new RuntimeException(implode('; ', $errors));
        }

        $docRoot = $this->getDocumentRoot();
        if ($docRoot !== $this->element->getName()){
            throw new RuntimeException(
                'Invalid document root, "' . $this->element->getName() .
                '" found instead of "' . $docRoot . '"'
            );
        }
    }

    /**
     * Parses document.
     *
     * @return mixed
     */
    public abstract function parse();

    /**
     * Returns document root tag name.
     *
     * @return string
     */
    protected abstract function getDocumentRoot();
}
