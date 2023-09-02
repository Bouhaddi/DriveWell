<?php

namespace Bouhaddi\DriveWell;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DriveWell
{
    protected array $folders = ["Models", "Controllers", "Services", "Repositories", "Routes"];

    /**
     * Generate the domain and
     * create files if an argument we found an argument
     *
     * @param string $domain
     * @param array $options
     * @return void
     */
    public function generateDomainSkeleton(string $domain, array $options): void
    {
        $this->createDomain($domain);

        foreach ($options as $folder => $className) {
            if ($className) {
                $this->createFiles($domain, $folder, $className);
            }
        }
    }

    /**
     * Create the domain folders trees
     *
     * @param string $domain
     * @return void
     */
    protected function createDomain(string $domain): void
    {
        $domain = ucfirst($domain);
        $domainDirectory = base_path("app/Domain/$domain");

        if (!file_exists($domainDirectory)) {
            mkdir($domainDirectory, 0755, true);

            foreach ($this->folders as $folder) {
                mkdir("$domainDirectory/$folder", 0755, true);
            }
        }
    }

    /**
     * Create files based on passed arguments and use the stubs skeletons
     * @param string $domain
     * @param string $folder
     * @param string $className
     * @return void
     */
    protected function createFiles(string $domain, string $folder, string $className): void
    {
        $domain = Str::ucfirst($domain);
        $folder = Str::ucfirst($folder);
        $className = Str::ucfirst($className);
        $namespace = "App\Domain\\$domain\\" . Str::plural($folder);
        $filePath = "$namespace/$className.php";

        if (File::exists($filePath)) {
            return; // File already exists, no need to create it again
        }

        $fileSkeleton = file_get_contents(__DIR__ . "/Stubs/$folder.stub"); // Replace with the correct path to your stubs directory

        if ($fileSkeleton !== false) {
            $fileContent = str_replace(
                ["{{ Namespace }}", "{{ ClassName }}"],
                [$namespace, $className],
                $fileSkeleton
            );

            File::put($filePath, $fileContent);
        }
    }
}
