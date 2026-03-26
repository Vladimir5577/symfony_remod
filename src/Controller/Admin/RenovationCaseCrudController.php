<?php

namespace App\Controller\Admin;

use App\Entity\RenovationCase;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class RenovationCaseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RenovationCase::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Кейс')
            ->setEntityLabelInPlural('Кейсы')
            ->setDefaultSort(['sortOrder' => 'ASC', 'id' => 'DESC']);
    }

    public function configureFields(string $pageName): iterable
    {
        yield FormField::addTab('Основное');
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('slug', 'Slug (URL)')
            ->setHelp('Латиница, дефисы. Пример: novostroyka-65');
        yield TextField::new('title', 'Заголовок');
        yield TextField::new('area', 'Площадь')->setHelp('Пример: 65 м²');
        yield ChoiceField::new('type', 'Тип объекта')
            ->setChoices(['Новостройка' => 'Новостройка', 'Вторичка' => 'Вторичка', 'Студия' => 'Студия']);
        yield TextField::new('pkg', 'Пакет')->setHelp('Пример: Белый · Комфорт');
        yield IntegerField::new('days', 'Дней');
        yield IntegerField::new('year', 'Год');
        yield IntegerField::new('sortOrder', 'Порядок сортировки');
        yield TextareaField::new('summary', 'Описание')->setNumOfRows(4);
        yield ArrayField::new('challenges', 'Сложности и решения')
            ->setHelp('Каждый пункт — отдельная строка');

        yield FormField::addTab('Фото До / После');
        yield Field::new('imgBeforeFile', 'Фото ДО')
            ->setFormType(VichImageType::class)
            ->onlyOnForms();
        yield TextField::new('imgBeforeName', 'Файл ДО')->hideOnForm();
        yield Field::new('imgAfterFile', 'Фото ПОСЛЕ')
            ->setFormType(VichImageType::class)
            ->onlyOnForms();
        yield TextField::new('imgAfterName', 'Файл ПОСЛЕ')->hideOnForm();
    }
}
