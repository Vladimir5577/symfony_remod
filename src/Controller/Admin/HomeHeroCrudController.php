<?php

namespace App\Controller\Admin;

use App\Entity\HomeHero;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class HomeHeroCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return HomeHero::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Hero (Главная)')
            ->setEntityLabelInPlural('Hero (Главная)');
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield Field::new('imgBeforeFile', 'Фото “До”')
            ->setFormType(VichImageType::class)
            ->onlyOnForms();
        yield ImageField::new('imgBeforeName', 'Превью “До”')
            ->setBasePath('/uploads/cases/before')
            ->hideOnForm();

        yield Field::new('imgAfterFile', 'Фото “После”')
            ->setFormType(VichImageType::class)
            ->onlyOnForms();
        yield ImageField::new('imgAfterName', 'Превью “После”')
            ->setBasePath('/uploads/cases/after')
            ->hideOnForm();
    }
}

