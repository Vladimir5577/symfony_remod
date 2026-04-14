<?php

namespace App\Controller\Admin;

use App\Entity\SiteContact;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class SiteContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SiteContact::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Контакты')
            ->setEntityLabelInPlural('Контакты компании');
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('phone', 'Телефон');
        yield TextField::new('whatsapp', 'Max')->setHelp('Ссылка max.ru (полный URL, @ник или путь u/…)');
        yield TextField::new('telegram', 'Telegram')->setHelp('Ссылка или @username');
        yield TextField::new('address', 'Адрес');
        yield TextField::new('city', 'Город');
        yield TextField::new('hoursWeekday', 'Пн–Пт')->setHelp('Пример: 9:00–20:00');
        yield TextField::new('hoursSaturday', 'Сб');
        yield TextField::new('hoursSunday', 'Вс');
    }
}
