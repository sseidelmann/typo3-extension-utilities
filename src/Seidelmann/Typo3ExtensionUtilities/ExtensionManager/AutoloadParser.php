<?php
/**
 * Class AutoloadParser
 * @package Seidelmann\Typo3ExtensionUtilities\ExtensionManager
 */

namespace Seidelmann\Typo3ExtensionUtilities\ExtensionManager;

/**
 * Class AutoloadParser
 * @package Seidelmann\Typo3ExtensionUtilities\ExtensionManager
 */
class AutoloadParser
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
     * Returns the autoload configuration.
     * @return array
     */
    public function getAutoload()
    {
        $autoload = array();

        foreach (array('psr-0', 'psr-4') as $autoloadSchema) {
            if (isset($this->package['autoload'][$autoloadSchema])) {
                foreach ($this->package['autoload'][$autoloadSchema] as $namespace => $class) {
                    $autoload[$autoloadSchema][str_replace('\\', '\\\\', $namespace)] = $class;
                }
            }
        }

        return $autoload;
    }
}