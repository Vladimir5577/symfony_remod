<?php

namespace App\Controller\Admin;

use App\Entity\Testimonial;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class TestimonialCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Testimonial::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Отзыв')
            ->setEntityLabelInPlural('Отзывы')
            ->setDefaultSort(['sortOrder' => 'ASC']);
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('name', 'Имя');
        yield TextField::new('obj', 'Объект')->setHelp('Пример: Новостройка, 72 м²');
        yield TextField::new('pkg', 'Пакет');
        yield IntegerField::new('stars', 'Звёзды')->setHelp('1–5');
        yield TextareaField::new('quote', 'Отзыв')->setNumOfRows(4);
        yield IntegerField::new('sortOrder', 'Порядок');
        yield BooleanField::new('active', 'Активен');
    }
}
