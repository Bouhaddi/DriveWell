<?php

namespace Bouhaddi\DriveWell;

class DriveWell
{
    protected $folders = ["Models", "Controllers", "Services", "Repositories", "Routes"];
    public function generateDomainSkeleton(string $domain)
    {
        $this->createDomainDirectory($domain);

        $this->createDomainArchitecture($domain);
    }

    protected function createDomainDirectory(string $domain)
    {
        $domain = ucfirst($domain);
        $domainDirectory = base_path("app/Domain/$domain");
        if(!file_exists($domainDirectory)){
            mkdir($domainDirectory, 0755, true);
        }
    }

    private function createDomainArchitecture(string $domain)
    {
        foreach($this->folders as $folder){
            $folderPath = base_path("app/Domain/$domain/$folder");
            if(!file_exists($folderPath)){
                mkdir($folderPath, 0755, true);
            }
        }

        $this->createDomainFiles($domain);
    }

    private function createDomainFiles(string $domain)
    {

    }


}
