<?php

namespace Bouhaddi\DriveWell\Middlewares;

use Closure;
use ReflectionClass;

class ArchitectureEnforcementMiddleware
{
    public function handle($request, Closure $next)
    {
        // Get the caller class name
        $callerClassName = $this->getCallerClassName();

        if ($this->isInvalidCall($callerClassName)) {
            throw new \Exception('Invalid architecture: Models should only be called by repositories or classes extending Model.');
        }

        return $next($request);
    }

    private function getCallerClassName()
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 2);

        if (isset($trace[1]['object'])) {
            return get_class($trace[1]['object']);
        }

        return '';
    }

    private function isInvalidCall(string $callerClassName)
    {
        // Check if it's not a repository and doesn't extend Model
        return !strpos($callerClassName, '\\Repositories\\') !== false && !is_subclass_of($callerClassName, 'Illuminate\Database\Eloquent\Model');
    }
}
