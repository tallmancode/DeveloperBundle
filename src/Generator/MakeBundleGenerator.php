<?php

namespace TallmanCode\DeveloperBundle\Generator;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\KernelInterface;

class MakeBundleGenerator
{
    private Filesystem $filesystem;
    private string $projectDir;
    private KernelInterface $kernel;

    public function __construct(Filesystem $filesystem, KernelInterface $kernel)
    {
        $this->filesystem = $filesystem;
        $this->projectDir = $kernel->getProjectDir();
        $this->kernel = $kernel;
    }

    public function generateNameSpace(string $vendor, string $bundleName)
    {
        return $vendor.'\\'.$bundleName;
    }

    public function generateComposer($params, $template = 'Composer.tpl.php')
    {
        $templatePath = $this->getTemplate($template);
        $content = $this->parseTemplate($templatePath, $params['composer']);
        $this->filesystem->dumpFile($this->projectDir.'\lib\\'.$params['bundleNameInput'].'\composer.json', $content);
    }

    public function generateExtension($params, $template = 'BundleExtension.tpl.php')
    {
        $templatePath = $this->getTemplate($template);
        $content = $this->parseTemplate($templatePath, $params);
        $this->filesystem->dumpFile($this->projectDir.'\lib\\'.$params['bundleNameInput'].'\src\DependencyInjection\\'.$params['bundleExtensionName'].'.php', $content);
    }

    public function generateBundleClass($params, $template = 'BundleClass.tpl.php')
    {
        $templatePath = $this->getTemplate($template);
        $content = $this->parseTemplate($templatePath, $params);
        $this->filesystem->dumpFile($this->projectDir.'\lib\\'.$params['bundleNameInput'].'\src\\'.$params['bundleClassName'].'.php', $content);
    }

    public function generateServiceClass($params, $template = 'ServiceClass.tpl.php')
    {
        $templatePath = $this->getTemplate($template);
        $content = $this->parseTemplate($templatePath, $params);
        $this->filesystem->dumpFile($this->projectDir.'\lib\\'.$params['bundleNameInput'].'\src\\'.$params['serviceClassName'].'.php', $content);
    }

    public function generateServices($params, $template = 'ServiceXml.tpl.php')
    {
        $templatePath = $this->getTemplate($template);
        $content = $this->parseTemplate($templatePath, $params);
        $this->filesystem->dumpFile($this->projectDir.'\lib\\'.$params['bundleNameInput'].'\src\Resources\config\services.xml', $content);
    }

    private function getTemplate($templateName)
    {
        return $this->kernel->locateResource('@TallmanCodeDeveloperBundle').'/Resources/skeleton/'.$templateName;
    }

    private function parseTemplate(string $templatePath, array $parameters): string
    {
        ob_start();
        extract($parameters, EXTR_SKIP);
        include $templatePath;

        return ob_get_clean();
    }
}