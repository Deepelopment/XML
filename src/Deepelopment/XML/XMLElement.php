<?php
/**
 * PHP Deepelopment Framework.
 *
 * @package Deepelopment/Debeetle
 * @license Unlicense http://unlicense.org/
 */

 namespace Deepelopment\XML;

 use RuntimeException;
 use SimpleXMLElement;

/**
 * XML element.
 *
 * @package Deepelopment/XML
 * @author  deepeloper ({@see https://github.com/deepeloper})
 */
class Element extends SimpleXMLElement
{
    /**
     * Returns element by path.
     *
     * @param  string $path     Path
     * @param  mixed  $default  Default value in case of element absence
     * @param  string $type
     *                Cast result to the specified type, see {@link
     *                http://ru2.php.net/manual/en/function.settype.php
     *                settype()}
     * @return mixed
     * @throws RuntimeException
     */
    public function getByPath($path, $default = NULL, $type = '')
    {
        $partsOfPath = explode('/', $path);
        $element = $this;
        do {
            $iterate = FALSE;
            foreach ($element->children() as $child) {
                if ($child->getName() === $partsOfPath[0]) {
                    array_shift($partsOfPath);
                    if (sizeof($partsOfPath)) {
                        $element = $child;
                        $iterate = TRUE;
                        break;
                    } else {
                        if ($type !== '') {
                            settype($child, $type);
                        }
                        return $child;
                    }
                }
            }
        } while ($iterate);
        if (is_null($default)) {
            throw new RuntimeException("Missing section '{$path}'");
        }

        return $default;
    }

    /**
     * Returns attribute value.
     *
     * @param  string $name       Attribute name
     * @param  mixed  $default    Default value
     * @param  string $type
     *                Cast result to the specified type, see {@link
     *                http://ru2.php.net/manual/en/function.settype.php
     *                settype()}
     * @param  string $namespace  An optional namespace
     * @param  bool   $isPrefix
     *                {@link
     *                http://php.net/manual/en/simplexmlelement.attributes.php}
     * @return mixed
     */
    public function getAttribute(
        $name,
        $default = NULL,
        $type = '',
        $namespace = '',
        $isPrefix = FALSE
    )
    {
        $attributes = $this->attributes($namespace, $isPrefix);
        $result = isset($attributes[$name]) ? $attributes[$name] : $default;
        if ($type !== '') {
            settype($result, 'string');
            settype($result, $type);
        }

        return $result;
    }

    /**
     * Returns attributes.
     *
     * @param  string $namespace  An optional namespace for the retrieved attributes
     * @param  bool   $isPrefix
     *                {@link
     *                http://php.net/manual/en/simplexmlelement.attributes.php}
     * @return array
     */
    public function getAttributes($namespace = '', $isPrefix = FALSE)
    {
        $attributes = array();
        foreach ($this->attributes($namespace, $isPrefix) as $name => $value) {
            $attributes[$name] = (string)$value;
        }

        return $attributes;
    }

    /**
     * Converts array containig objects to array.
     *
     * @param mixed &$array
     */
    public function toArray(&$array)
    {
        foreach (array_keys($array) as $key) {
            if (is_object($array[$key])) {
                $array[$key] = (array)$array[$key];
            }
            if (is_array($array[$key])) {
                $this->toArray($array[$key]);
            }
        }
    }
}
