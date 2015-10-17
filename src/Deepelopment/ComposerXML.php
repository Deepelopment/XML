<?php
/**
 * PHP Deepelopment Framework.
 *
 * @package Deepelopment/Debeetle
 * @license Unlicense http://unlicense.org/
 */

namespace Deepelopment;

use ErrorException;
use Composer\Script\Event;

/**
 * Composer event handlers.
 *
 * @package Deepelopment
 */
class ComposerXML
{
    /**
     * Check required library.
     *
     * @param  Event $oEvent
     * @return void
     * @throws ErrorException
     */
    public static function prePackageInstall(Event $oEvent)
    {
        if (!function_exists('libxml_use_internal_errors')) {
            throw new ErrorException('"libxml" extension required!');
        }
    }
}
