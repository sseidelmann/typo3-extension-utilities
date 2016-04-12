<?php
/**
 * Created by PhpStorm.
 * User: sebastianseidelmann
 * Date: 12.04.16
 * Time: 16:35
 */

namespace Seidelmann\Typo3ExtensionUtilities;

/**
 * Class ExtensionManagerConfiguration
 * @package Seidelmann\Typo3ExtensionUtilities
 */
class ExtensionManager
{
    public function getConfiguration()
    {
        $this->getComposerLockContent();
    }

    private function getComposerLockContent()
    {
        $path = realpath(dirname(__FILE__) . '/../../../');
    }
}