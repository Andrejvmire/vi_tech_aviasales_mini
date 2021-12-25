<?php

namespace App\Form;

use App\DTO\TicketBookingDTO;
use App\Entity\Flight;
use App\Entity\Passenger;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketBookingForm extends AbstractType
{
    private const LABEL_ATTR = [
        "class" => "form_label"
    ];

    private const TEXT_TYPE_ATTR = [
        "class" => "form-control",
    ];

    private const ENTITY_TYPE_ATTR = [
        "class" => "form-select"
    ];

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("flight_id", EntityType::class, [
                "class" => Flight::class,
                "label" => "Рейс",
                "attr" => self::ENTITY_TYPE_ATTR,
                "query_builder" => function (EntityRepository $er) {
                    return $er->createQueryBuilder('f')
                        ->andWhere('f.status <> 0');
                }
            ])
            ->add("passenger_id", EntityType::class, [
                "class" => Passenger::class,
                "label" => "",
                "attr" => self::ENTITY_TYPE_ATTR,
            ])
            ->add("date", DateType::class, [
                "widget" => "single_text",
                "label" => "Дата",
                "attr" => self::TEXT_TYPE_ATTR
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
            "data_class" => TicketBookingDTO::class
        ]);
    }
}