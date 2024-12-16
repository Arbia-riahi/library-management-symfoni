<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Category;
use App\Entity\Library;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('bookId', TextType::class, [
                'label' => 'Book ID'
            ])
            ->add('title', TextType::class)
            ->add('author', TextType::class)
            ->add('isbn', TextType::class, [
                'label' => 'ISBN'
            ])
            ->add('format', TextType::class)
            ->add('price', NumberType::class, [
                'scale' => 2
            ])
            ->add('library', EntityType::class, [
                'class' => Library::class,
                'choice_label' => 'location',
                'placeholder' => 'Select a library'
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'categoryName',
                'placeholder' => 'Select a category',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
