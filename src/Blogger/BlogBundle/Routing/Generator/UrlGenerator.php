<?php


namespace Blogger\BlogBundle\Routing\Generator;

use Symfony\Component\Routing\Generator\UrlGenerator as BaseUrlGenerator;

use Doctrine\Common\Util\Inflector;

/**
 * UrlGenerator generates URL based on a set of routes.
 *
 * @api
 */
class UrlGenerator extends BaseUrlGenerator
{
    protected function doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $absolute)
    {
        $originalParameters = $parameters;
        if (isset($parameters['object']) && is_object($parameters['object'])) {
            $object = $parameters['object'];
            $parameters = array_replace($this->context->getParameters(), $parameters);
            $tparams = array_replace($defaults, $parameters);
            $requiredParameters = array_diff_key(array_flip($variables), $tparams);

            $parameters = $this->getParametersFromObject(array_flip($requiredParameters), $object);
            $originalParameters = array_merge($originalParameters, $parameters);
        }


        return parent::doGenerate($variables, $defaults, $requirements, $tokens, $originalParameters, $name, $absolute);
    }

    protected function getParametersFromObject($keys, $object)
    {
        $parameters = array();
        foreach ($keys as $key) {
            $method = 'get' . Inflector::classify($key);
            if (method_exists($object, $method)) {
                $parameters[$key] = $object->$method();
            }
        }

        return $parameters;
    }

}
