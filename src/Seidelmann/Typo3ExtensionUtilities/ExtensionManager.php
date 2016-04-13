<?php
/**
 * Class ExtensionManagerConfiguration
 * @package Seidelmann\Typo3ExtensionUtilities
 */

namespace Seidelmann\Typo3ExtensionUtilities;

use Seidelmann\Typo3ExtensionUtilities\ExtensionManager\AuthorParser;
use Seidelmann\Typo3ExtensionUtilities\ExtensionManager\AutoloadParser;
use Seidelmann\Typo3ExtensionUtilities\ExtensionManager\ConstraintsParser;
use Seidelmann\Typo3ExtensionUtilities\ExtensionManager\VersionParser;

/**
 * Class ExtensionManagerConfiguration
 * @package Seidelmann\Typo3ExtensionUtilities
 */
class ExtensionManager
{
    /**
     * Returns the complete configuration.
     * @param string $packageName the package name.
     * @return array|bool
     */
    public function getConfiguration($packageName)
    {
        $packages = $this->getInstalledPackages();

        if (isset($packages[$packageName])) {
            return $packages[$packageName];
        }

        return false;
    }

    /**
     * Returns the parsed installed packages.
     * @return array
     */
    private function getInstalledPackages()
    {
        if ($content = $this->getComposerLock()) {

            $installedPackages = array();

            foreach ($content['packages'] as $package) {

                // only parse the cms extensions
                if ($package['type'] == 'typo3-cms-extension') {

                    $constraintsParser = new ConstraintsParser($package);
                    $autoloadParser    = new AutoloadParser($package);
                    $versionParser     = new VersionParser($package);
                    $authorParser      = new AuthorParser($package);

                    $ext                     = array();
                    $ext['title']            = $package['name'];
                    $ext['description']      = $package['description'];
                    $ext['category']         = 'extension';
                    $ext['constraints']      = $constraintsParser->getConstraints();
                    $ext['autoload']         = $autoloadParser->getAutoload();
                    $ext['version']          = $versionParser->getVersion();
                    $ext['state']            = $versionParser->getState();
                    $ext['uploadfolder']     = 0;
                    $ext['createDirs']       = '';
                    $ext['clearCacheOnLoad'] = 1;
                    $ext['author']           = $authorParser->getAuthorNames();
                    $ext['author_email']     = $authorParser->getAuthorEmails();

                    $installedPackages[$package['name']] = $ext;
                }
            }
            return $installedPackages;
        }

        return array();
    }

    /**
     * Returns the composer lock content as array.
     * @return bool|array
     */
    private function getComposerLock()
    {
        echo $this->getProjectRootPath() . 'composer.lock';
        if (file_exists($lockFile = ($this->getProjectRootPath() . 'composer.lock'))) {
            $jsonContent = file_get_contents($lockFile);
            return json_decode($jsonContent, true);
        }

        return false;
    }

    /**
     * Returns the project root path.
     * @return string
     */
    private function getProjectRootPath()
    {
        return realpath(dirname(__FILE__) . '/../../../../../../') . DIRECTORY_SEPARATOR;
    }
}