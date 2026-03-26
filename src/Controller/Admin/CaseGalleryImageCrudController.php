<?php

namespace App\Controller\Admin;

use App\Entity\CaseGalleryImage;
use App\Entity\RenovationCase;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CaseGalleryImageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CaseGalleryImage::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Фото галереи')
            ->setEntityLabelInPlural('Галерея кейсов')
            ->setDefaultSort(['renovationCase' => 'ASC', 'sortOrder' => 'ASC']);
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield AssociationField::new('renovationCase', 'Кейс');
        yield Field::new('imageFile', 'Фото')
            ->setFormType(VichImageType::class)
            ->onlyOnForms();
        yield TextField::new('imageName', 'Файл')->hideOnForm();
        yield IntegerField::new('sortOrder', 'Порядок');
    }
}
