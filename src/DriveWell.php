<?php

namespace Bouhaddi\DriveWell;

use Bouhaddi\DriveWell\Engine\Contracts\FileGenerator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DriveWell
{
    protected $folders = ["Models", "Controllers", "Services", "Repositories", "Routes"];

    public function generateDomainSkeleton(string $domain, $options): void
    {
        $this->createDomain($domain);

        foreach ($options as $folder => $className) {
            if ($className) {
                $this->createFiles($domain, $folder, $className);
            }
        }
    }

    protected function createDomain(string $domain): void
    {
        $domain = ucfirst($domain);
        $domainDirectory = base_path("app/Domain/$domain");
        if (!file_exists($domainDirectory)) {
            mkdir($domainDirectory, 0755, true);
            foreach ($this->folders as $folder){
                mkdir($domainDirectory."/".$folder, 0755, true);
            }
        }
    }

    protected function createFiles(string $domain, string $folder, string $className): void
    {
        $domain = Str::ucfirst($domain);
        $folder = Str::ucfirst($folder);
        $className = Str::ucfirst($className);
        $namespace = "app\Domain\\$domain\\". Str::plural($folder);
        $filePath =  "$namespace./$className.php";

        if (File::exists($filePath)) {
            return; // File already exists, no need to create it again
        }


        $fileSkeleton = file_get_contents(__DIR__."/Stubs/$folder.stub"); // Replace with the correct path to your stubs directory

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
