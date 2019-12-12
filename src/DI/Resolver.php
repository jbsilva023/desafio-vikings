<?php

namespace JbSilva\DI;

class Resolver
{
    private $dependencies;

    public function method($method, array $dependencies = [])
    {
        $this->dependencies = $dependencies;

        $info = new \ReflectionFunction($method);
        $parameters = $info->getParameters();
        $parameters = $this->resolveParameters($parameters);

        return call_user_func_array($info->getClosure(), $parameters);
    }

    private function resolveParameters($parameters)
    {
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $dependency = $parameter->getClass();

            if ($dependency) {
                $dependencies[] = $this->class($dependency->name, $this->dependencies);
            } else {
                $dependencies[] = $this->getDependencies($parameter);
            }
        }

        return $dependencies;
    }

    public function class($class, array $dependencies = [])
    {
        $this->dependencies = $dependencies;

        $class = new \ReflectionClass($class);

        if (!$class->isInstantiable()) {
            throw new \Exception("{$class} não é instaciável.");
        }

        $constructor = $class->getConstructor();

        if (!$constructor) {
            return new $class->name;
        }

        $parameters = $constructor->getParameters();
        $parameters = $this->resolveParameters($parameters);

        return $class->newInstanceArgs($parameters);
    }

    private function getDependencies($parameter)
    {
        if (isset($this->dependencies[$parameter->name])) {
            return $this->dependencies[$parameter->name];
        }

        if ($parameter->isDefaultValueAvailable()) {
            return $parameter->getDefaultValue();
        }

        throw new \Exception("{$parameter->name} não recebeu um valor válido.");
    }
}
