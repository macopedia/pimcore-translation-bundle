<?php
/**
 * @author Piotr Rugała <piotr@isedo.pl>
 * @copyright Copyright (c) 2021 Divante Ltd. (https://divante.co)
 */

declare(strict_types=1);

namespace DivanteTranslationBundle;

use Pimcore\Extension\Bundle\AbstractPimcoreBundle;
use Pimcore\Extension\Bundle\PimcoreBundleAdminClassicInterface;
use Pimcore\Extension\Bundle\Traits\BundleAdminClassicTrait;

final class DivanteTranslationBundle extends AbstractPimcoreBundle implements PimcoreBundleAdminClassicInterface
{
    use BundleAdminClassicTrait;

    public function getJsPaths(): array
    {
        return [
            '/bundles/divantetranslation/js/pimcore/startup.js',
            '/bundles/divantetranslation/js/pimcore/object/tags/input.js',
            '/bundles/divantetranslation/js/pimcore/object/tags/wysiwyg.js',
            '/bundles/divantetranslation/js/pimcore/object/tags/textarea.js',
            '/bundles/divantetranslation/js/pimcore/object/elementservice.js',
        ];
    }
}
