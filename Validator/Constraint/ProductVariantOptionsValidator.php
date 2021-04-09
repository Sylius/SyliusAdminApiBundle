<?php

declare(strict_types=1);

namespace Sylius\Bundle\AdminApiBundle\Validator\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Webmozart\Assert\Assert;

final class ProductVariantOptionsValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        /** @var ProductVariantOptions $constraint */
        Assert::isInstanceOf($constraint, ProductVariantOptions::class);

        if (!$this->context->getRoot()->has('optionValues')) {
            return;
        }

        if (count($value->getOptionValues()) === 0) {
            $this->context->addViolation($constraint->emptyMessage);
            return;
        }

        foreach ($value->getOptionValues() as $option) {
            if ($option === null) {
                $this->context->addViolation($constraint->nullMessage);
                return;
            }
        }
    }
}
