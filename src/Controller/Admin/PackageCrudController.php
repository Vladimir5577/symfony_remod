<?php

namespace App\Controller\Admin;

use App\Entity\Package;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PackageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Package::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Пакет')
            ->setEntityLabelInPlural('Пакеты отделки')
            ->setDefaultSort(['sortOrder' => 'ASC']);
    }

    public function configureFields(string $pageName): iterable
    {
        yield FormField::addTab('Основное');
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('slug', 'Slug')->setHelp('white-box | belyy | seryy');
        yield TextField::new('name', 'Название');
        yield TextField::new('sub', 'Подзаголовок')->setHelp('Пример: Черновая отделка');
        yield TextField::new('price', 'Цена')->setHelp('Пример: от 8 000 ₽/м²');
        yield BooleanField::new('featured', 'Выделенный (центральный)');
        yield IntegerField::new('sortOrder', 'Порядок');
        yield TextareaField::new('description', 'Описание')->setNumOfRows(3);
        yield ArrayField::new('forWho', 'Для кого');
        yield ArrayField::new('includes', 'Что входит');
        yield ArrayField::new('levels', 'Уровни')->setHelp('Оставьте пустым для White Box');

        yield FormField::addTab('Фото');
        yield Field::new('imageFile', 'Изображение пакета')
            ->setFormType(VichImageType::class)
            ->onlyOnForms();
        yield TextField::new('imageName', 'Файл')->hideOnForm();
    }
}
