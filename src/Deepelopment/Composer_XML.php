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
class Composer_XML
{
    /**
     * Post install script.
     *
     * @param  Event $event
     * @return void
     */
    public static function postInstall(Event $event)
    {
        self::checkRequirements($event);
    }

    /**
     * Pre update script.
     *
     * @param  Event $event
     * @return void
     */
    public static function preUpdate(Event $event)
    {
        self::checkRequirements($event);
    }

    /**
     * Checks required "libxml" PHP-extension.
     *
     * @param  Event $event
     * @return void
     * @throws ErrorException
     */
    protected static function checkRequirements(Event $event)
    {
        if (!function_exists('libxml_use_internal_errors')) {
            throw new ErrorException(
                '"deepelopment/xml" package requres "libxml" PHP-extension!'
            );
        }
    }
}
