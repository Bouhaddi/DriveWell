<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ArchitectureEnforcementMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Get all domain folders dynamically
        $domainFolders = $this->getDomainFolders();

        // Check controllers in each domain for model usage
        foreach ($domainFolders as $domainFolder) {
            $this->checkControllersInDomainForModelUsage($domainFolder);
        }

        return $response;
    }

    private function getDomainFolders()
    {
        // Directory where domain folders are located
        $domainsDirectory = app_path('Domain');

        // Scan for subdirectories (domain folders)
        $domainFolders = [];
        if (File::isDirectory($domainsDirectory)) {
            $domainFolders = File::directories($domainsDirectory);
        }

        return $domainFolders;
    }

    private function checkControllersInDomainForModelUsage($domainFolder)
    {
        // Get the domain folder name
        $domainFolderName = basename($domainFolder);

        // Define the namespace for controllers in this domain
        $controllerNamespace = "App\\Domain\\$domainFolderName\\Controllers";

        // Scan for controller files in the domain folder
        $controllerFiles = File::glob("$domainFolder/Controllers/*.php");

        // Check each controller for model usage
        foreach ($controllerFiles as $controllerFile) {
            $this->checkControllerForModelUsage($controllerFile, $controllerNamespace);
        }
    }

    private function checkControllerForModelUsage($controllerFile, $controllerNamespace)
    {
        $controllerCode = file_get_contents($controllerFile);

        // Extract all 'use' statements from the controller code
        preg_match_all('/^use\s+(.*?);$\\s*/m', $controllerCode, $matches);

        // Check if any of the 'use' statements reference classes within a 'Models' namespace
        foreach ($matches[1] as $useStatement) {
            if (strpos($useStatement, 'Models\\') !== false) {
                dd("Controller in namespace $controllerNamespace uses a class within a 'Models' namespace. Accessing models is not allowed.");
            }
        }
    }
}
