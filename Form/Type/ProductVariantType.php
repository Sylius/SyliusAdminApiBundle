<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Sylius\Bundle\AdminApiBundle\Form\Type;

use Sylius\Bundle\ProductBundle\Form\Type\ProductVariantType as BaseProductVariantType;
use Sylius\Component\Core\Model\ProductVariantInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

final class ProductVariantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addEventListener(FormEvents::PRE_SUBMIT, static function (FormEvent $event): void {
            $data = $event->getData();
            $form = $event->getForm();

            if (!array_key_exists('onHand', $data)) {
                $form->remove('onHand');
            }

            if (array_key_exists('optionValues', $data)) {
                $form->add('optionValuesData', CollectionType::class,
                    [
                        'constraints' => [new NotBlank(['groups' => 'sylius']), new NotNull(['groups' => 'sylius'])],
                        'mapped' => false
                    ]);

                $form->get('optionValuesData')->setData($data['optionValues']);
            } else {
                $form->remove('optionValues');
            }
        });

        $builder->addEventListener(FormEvents::SUBMIT, static function (FormEvent $event): void {
            /** @var ProductVariantInterface $productVariant */
            $productVariant = $event->getData();

            /** @psalm-suppress NullArgument */
            $productVariant->getOptionValues()->removeElement(null);
        });
    }

    public function getParent(): string
    {
        return BaseProductVariantType::class;
    }
}
