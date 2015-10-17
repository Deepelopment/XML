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
     * Pre package install script.
     *
     * @param  Event $event
     * @return void
     * @throws ErrorException
     */
    public static function prePackageInstall(Event $event)
    {
        self::checkRequirements($event);
    }

    /**
     * Pre package update script.
     *
     * @param  Event $event
     * @return void
     */
    public static function prePackageUpdate(Event $event)
    {
        self::checkRequirements($event);
    }

    /**
     * Post package install script.
     *
     * Checks required library.
     *
     * @param  Event $event
     * @return void
     */
    public static function postPackageInstall(Event $event)
    {
        self::checkRequirements($event);
    }

    /**
     * Post package update script.
     *
     * Checks required library.
     *
     * @param  Event $event
     * @return void
     */
    public static function postPackageUpdate(Event $event)
    {
        self::checkRequirements($event);
    }

    /**
     * Checks required library.
     *
     * @param  Event $event
     * @return void
     * @throws ErrorException
     */
    protected static function checkRequirements(Event $event)
    {
        echo "checkRequirements\n";###
        if (!function_exists('libxml_use_internal_errors123')) {
            throw new ErrorException('"libxml" extension required!');
        }
    }
}
