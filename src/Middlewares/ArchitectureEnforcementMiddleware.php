<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ArchitectureEnforcementMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Check if the controller uses a class within a 'Models' namespace
        $this->checkControllerForModelUsage($request);

        return $response;
    }

    private function checkControllerForModelUsage(Request $request)
    {
        $action = $request->route()->getAction();

        if ($this->controllerUsesModelOrDerivedClass($action)) {
            dd('Controller uses a class within a "Models" namespace. Accessing models is not allowed.');
        }
    }

    private function controllerUsesModelOrDerivedClass(array $action)
    {
        $controller = class_basename($action['controller']);
        [$controllerName] = explode('@', $controller);

        // Get the controller class name
        $controllerClass = "App\\Http\\Controllers\\$controllerName";

        // Load the controller class file
        $controllerFileName = app_path("Http/Controllers/$controllerName.php");

        if (!file_exists($controllerFileName)) {
            return false;
        }

        $controllerCode = file_get_contents($controllerFileName);

        // Extract all 'use' statements from the controller code
        preg_match_all('/^use\s+(.*?);$\\s*/m', $controllerCode, $matches);

        // Check if any of the 'use' statements reference classes within a 'Models' namespace
        foreach ($matches[1] as $useStatement) {
            if (strpos($useStatement, 'Models\\') !== false) {
                return true;
            }
        }

        return false;
    }
}
