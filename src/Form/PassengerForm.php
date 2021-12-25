<?php

namespace App\Form;

use App\DTO\PassengerDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PassengerForm extends AbstractType
{
    private const LABEL_ATTR = [
        "class" => "form_label"
    ];

    private const TEXT_TYPE_ATTR = [
        "class" => "form-control",
    ];

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add("last_name", TextType::class, [
                "label" => "Фамилия",
                "label_attr" => self::LABEL_ATTR,
                "attr" => self::TEXT_TYPE_ATTR,
            ])
            ->add("first_name", TextType::class, [
                "label" => "Имя",
                "label_attr" => self::LABEL_ATTR,
                "attr" => self::TEXT_TYPE_ATTR,
            ])
            ->add("middle_name", TextType::class, [
                "label" => "Отчество",
                "label_attr" => self::LABEL_ATTR,
                "attr" => self::TEXT_TYPE_ATTR,
                "required" => false,
            ])
            ->add("passport_series", TextType::class, [
                "label" => "Серия",
                "label_attr" => self::LABEL_ATTR,
                "attr" => array_merge(
                    self::TEXT_TYPE_ATTR, [
                    "minlength" => 4,
                    "maxlength" => 4
                ]),
            ])
            ->add("passport_number", TextType::class, [
                "label" => "Номер",
                "label_attr" => self::LABEL_ATTR,
                "attr" => array_merge(
                    self::TEXT_TYPE_ATTR, [
                    "minlength" => 6,
                    "maxlength" => 6
                ]),
            ])
            ->add("submit", SubmitType::class, [
                "attr" => [
                    "class" => "btn btn-primary col-3"
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => PassengerDTO::class,
        ]);
    }
}