<?php
/**
 * Class AuthorParser
 * @package Seidelmann\Typo3ExtensionUtilities\ExtensionManager
 */

namespace Seidelmann\Typo3ExtensionUtilities\ExtensionManager;

/**
 * Class AuthorParser
 * @package Seidelmann\Typo3ExtensionUtilities\ExtensionManager
 */
class AuthorParser
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
     * Returns the authors.
     * @return array
     */
    private function getAuthors()
    {
        return isset($this->package['authors']) ? $this->package['authors'] : array();
    }

    /**
     * Returns the constraints configuration.
     * @return array
     */
    public function getAuthorNames()
    {
        $names = array();
        foreach ($this->getAuthors() as $author) {
            $names[] = $author['name'];
        }

        return implode(', ', $names);
    }

    /**
     * Returns the constraints configuration.
     * @return array
     */
    public function getAuthorEmails()
    {
        $names = array();
        foreach ($this->getAuthors() as $author) {
            $names[] = $author['email'];
        }

        return implode(', ', $names);
    }
}