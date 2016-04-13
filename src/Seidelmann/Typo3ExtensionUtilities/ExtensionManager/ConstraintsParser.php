<?php
/**
 * Class ConstraintsParser
 * @package Seidelmann\Typo3ExtensionUtilities\ExtensionManager
 */

namespace Seidelmann\Typo3ExtensionUtilities\ExtensionManager;

/**
 * Class ConstraintsParser
 * @package Seidelmann\Typo3ExtensionUtilities\ExtensionManager
 */
class ConstraintsParser
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
     * Returns the constraints configuration.
     * @return array
     */
    public function getConstraints()
    {
        $constraints = array();

        if ($requires = $this->getRequirements()) {
            $constraints['depends'] = $requires;
        }

        return $constraints;
    }

    /**
     * Parses the requirements.
     * @return array|bool
     */
    private function getRequirements()
    {
        if ($requirements = $this->package['require']) {
            return $requirements;
        }

        return false;
    }
}