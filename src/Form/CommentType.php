<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class CommentType
 *
 * @author Trésor-ILUNGA <hello@tresor-ilunga.tech>
 */
class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', TextareaType::class, [
               'label' => 'Poster un nouveau commentaire',
                'constraints' => [new NotBlank()]
            ]);
    }
}