<?php


namespace Blogger\BlogBundle\Routing\Generator;

use Symfony\Component\Routing\Generator\UrlGenerator;

/**
 * UrlGenerator generates URL based on a set of routes.
 *
 * @api
 */
class BloggerUrlGenerator extends UrlGenerator
{
    protected function doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $absolute)
    {
        return parent::doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $absolute);
    }


}
