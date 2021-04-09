<?php

declare(strict_types=1);

namespace Sylius\Bundle\AdminApiBundle\Validator\Constraint;

use Symfony\Component\Validator\Constraint;

final class ProductVariantOptions extends Constraint
{
    /** @var string */
    public $nullMessage = 'sylius_admin_api.option_values.not_null';

    /** @var string */
    public $emptyMessage = 'sylius_admin_api.option_values.not_empty';

    public function validatedBy(): string
    {
        return 'sylius_admin_api.validator.product_variant_options';
    }

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }
}
