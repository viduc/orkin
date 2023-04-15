<?php
declare(strict_types=1);
/**
 * ORKIN - Quality Tools for PHP
 *
 * Tristan Fleury <http://viduc.github.com/>
 *
 * Licence: GPL v3 https://opensource.org/licenses/gpl-3.0.html
 */

namespace Viduc\Orkin\Configuration;

use Symfony\Component\Serializer\Serializer;
use Viduc\Orkin\Constantes\Constantes;
use Viduc\Orkin\Factory\ConfigurationFactory;
use Viduc\Orkin\Factory\ToolsFactory;
use Viduc\Orkin\Models\ConfigurationModel;

class Configuration
{
    public ConfigurationModel $configurationModel;

    public function __construct(
        private ConfigurationFactory $factory,
        private Serializer $serializer,
        private ToolsFactory $toolsFactory
    ) {
        $this->configurationModel = $factory->create();
    }

    public function isNewConfiguration(): bool
    {
        return $this->configurationModel->newConfiguration;
    }

    public function getQualityPath(): string
    {
        return $this->configurationModel->qualityPath;
    }

    public function getPhingFolder(): string
    {
        return $this->configurationModel->phingFolder;
    }

    public function getPhingFile(): string
    {
        return $this->configurationModel->phingFile;
    }

    public function persist(): void
    {
        file_put_contents(
            Constantes::getProjectDir().$this->factory->configFile,
            $this->serializer->serialize($this->configurationModel, 'yaml')
        );
    }

    public function configureProperties(): void
    {
        $propertiesFile = Constantes::getProjectDir().$this->getQualityPath()
            .DIRECTORY_SEPARATOR. Constantes::FOLDER_PHING.DIRECTORY_SEPARATOR
            .Constantes::BUILD_PROPERTIES;
        $buildProperties = parse_ini_file($propertiesFile);
        $buildProperties["quality.folder"] = $this->getQualityPath();
        $buildProperties["src"] = $this->configurationModel->srcFolder;
        $buildProperties["reports.folder"] = $this->configurationModel->reportsFolder;

        foreach (Constantes::LIST_TOOLS as $tool) {
            $buildProperties = $this->toolsFactory->create(
                ['tool' => $tool]
            )->setPropertiesConfiguration(
                $buildProperties,
                $this->configurationModel->{$tool.'Model'}
            );
        }

        $this->writeIniFile($buildProperties,$propertiesFile);
    }

    private function writeIniFile(array $config, string $file): void
    {
        $fileContent = '';
        if (!empty($config)) {
            foreach($config as $i=>$v){
                if(is_array($v)){
                    foreach($v as $t=>$m){
                        $fileContent .= "$i[$t] = ".(is_numeric($m) ? $m : '"'.$m.'"').PHP_EOL;
                    }
                }
                else $fileContent .= "$i = ".(is_numeric($v) ? $v : '"'.$v.'"').PHP_EOL;
            }
        }

        file_put_contents($file, $fileContent, LOCK_EX);
    }
}