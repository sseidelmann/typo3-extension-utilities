<?php
/**
 * Class VersionParser
 * @package Seidelmann\Typo3ExtensionUtilities\ExtensionManager
 */

namespace Seidelmann\Typo3ExtensionUtilities\ExtensionManager;

/**
 * Class VersionParser
 * @package Seidelmann\Typo3ExtensionUtilities\ExtensionManager
 */
class VersionParser
{
    /**
     * Saves the package
     * @var array
     */
    private $package;

    /**
     * Default constructor.
     * @param array $package
     */
    public function __construct(array $package)
    {
        $this->package = $package;
    }

    /**
     * Returns the state configuration.
     * @return array
     */
    public function getState()
    {
        $version = $this->getVersion();

        if ($version == 'dev-master' || strpos($version, 'b') !== false) {
            return 'beta';
        } else if ($version == 'dev-develop' || strpos($version, 'a') !== false) {
            return 'alpha';
        } else {
            return 'stable';
        }
    }

    /**
     * Returns the current version.
     * @return string
     */
    public function getVersion()
    {
        return $this->package['version'];
    }


}