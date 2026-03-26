<?php

namespace App\DataFixtures;

use App\Entity\CaseGalleryImage;
use App\Entity\Faq;
use App\Entity\Package;
use App\Entity\RenovationCase;
use App\Entity\SiteContact;
use App\Entity\Testimonial;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->loadCases($manager);
        $this->loadTestimonials($manager);
        $this->loadPackages($manager);
        $this->loadFaqs($manager);
        $this->loadContacts($manager);
        $manager->flush();
    }

    private function loadCases(ObjectManager $manager): void
    {
        $casesData = [
            [
                'slug' => 'novostroyka-65',
                'title' => 'Новостройка, 65 м²',
                'area' => '65 м²',
                'type' => 'Новостройка',
                'pkg' => 'Белый · Комфорт',
                'days' => 84,
                'year' => 2025,
                'summary' => 'Двухкомнатная квартира с открытой кухней-гостиной. Заказчица хотела скандинавскую атмосферу с тёплым полом в ванной и лаконичной белой кухней. Уложились в 84 дня — на 6 дней раньше срока.',
                'challenges' => [
                    'Кривые стены в новостройке: расхождение углов до 4 см — выравнивали с нуля',
                    'Совместили зону кухни и гостиной без потери функциональности',
                    'Провели тёплый пол в ванной с выводом на отдельный терморегулятор',
                    'Разместили 18 дополнительных розеток по авторской схеме заказчицы',
                ],
                'before' => 'before-01.jpg',
                'after' => 'after-01.jpg',
                'gallery' => ['gallery-01.jpg', 'gallery-02.jpg', 'gallery-03.jpg'],
                'sortOrder' => 1,
            ],
            [
                'slug' => 'vtorichka-48',
                'title' => 'Вторичка, 48 м²',
                'area' => '48 м²',
                'type' => 'Вторичка',
                'pkg' => 'Серый · Комфорт+',
                'days' => 76,
                'year' => 2025,
                'summary' => 'Хрущёвка 1967 года — полный демонтаж с перепланировкой. Объединили кухню с гостиной, увеличили санузел. Заказчик хотел тёмную лаконичную отделку с дизайнерскими деталями.',
                'challenges' => [
                    'Полный снос нежилых перегородок с согласованием перепланировки',
                    'Замена всей инженерии: трубы, проводка, вентиляция',
                    'Нестандартная тёмная плитка форматом 120×60 — ювелирная укладка',
                    'Скрытые карнизы с подсветкой под натяжным потолком',
                    'Заменили все окна и откосы в рамках проекта',
                ],
                'before' => 'before-02.jpg',
                'after' => 'after-02.jpg',
                'gallery' => ['gallery-02.jpg', 'gallery-03.jpg', 'gallery-04.jpg'],
                'sortOrder' => 2,
            ],
            [
                'slug' => 'studiya-32',
                'title' => 'Студия, 32 м²',
                'area' => '32 м²',
                'type' => 'Студия',
                'pkg' => 'Белый · Эконом',
                'days' => 58,
                'year' => 2024,
                'summary' => 'Студия для сдачи в аренду. Задача: практично, надёжно, в бюджет. Уложились в 58 дней, арендаторы нашлись через 3 дня после сдачи.',
                'challenges' => [
                    'Очень ограниченный бюджет — оптимизировали состав работ без потери качества',
                    'Компактная планировка: нашли место для зонирования спальни и кухни',
                    'Все материалы закупили за 5 дней, не выбившись из сметы',
                ],
                'before' => 'before-03.jpg',
                'after' => 'after-03.jpg',
                'gallery' => ['gallery-01.jpg', 'gallery-04.jpg'],
                'sortOrder' => 3,
            ],
            [
                'slug' => 'novostroyka-82',
                'title' => 'Новостройка, 82 м²',
                'area' => '82 м²',
                'type' => 'Новостройка',
                'pkg' => 'Серый · Комфорт+',
                'days' => 91,
                'year' => 2025,
                'summary' => 'Трёхкомнатная квартира в ЖК комфорт-класса. Заказчики выбрали серый пакет с индивидуальными дизайнерскими решениями: фактурные стены, освещение по сценариям, скрытые ниши.',
                'challenges' => [
                    'Согласование нестандартных материалов с застройщиком',
                    'Сложная многоуровневая система освещения с 4 сценариями',
                    'Объёмная лепнина в прихожей — ручная работа',
                    'Укладка паркета ёлочкой в зале с трёхметровыми потолками',
                ],
                'before' => 'before-04.jpg',
                'after' => 'after-04.jpg',
                'gallery' => ['gallery-01.jpg', 'gallery-02.jpg', 'gallery-03.jpg', 'gallery-04.jpg'],
                'sortOrder' => 4,
            ],
            [
                'slug' => 'vtorichka-60',
                'title' => 'Вторичка, 60 м²',
                'area' => '60 м²',
                'type' => 'Вторичка',
                'pkg' => 'Белый · Комфорт',
                'days' => 78,
                'year' => 2024,
                'summary' => 'Трёхкомнатная квартира в панельном доме — полный капитальный ремонт. Снесли ненесущие перегородки, расширили кухню, установили новые стеклопакеты.',
                'challenges' => [
                    'Протечки от соседей сверху — гидроизоляция ванной с усиленным слоем',
                    'Выравнивание полов с перепадом до 7 см в разных комнатах',
                    'Замена 5 окон в жилых комнатах в рамках проекта',
                ],
                'before' => 'before-01.jpg',
                'after' => 'after-03.jpg',
                'gallery' => ['gallery-02.jpg', 'gallery-04.jpg', 'gallery-01.jpg'],
                'sortOrder' => 5,
            ],
            [
                'slug' => 'studiya-40',
                'title' => 'Студия, 40 м²',
                'area' => '40 м²',
                'type' => 'Студия',
                'pkg' => 'White Box',
                'days' => 45,
                'year' => 2024,
                'summary' => 'Студия в новом ЖК — White Box под чистовую отделку. Заказчик сам занимается дизайном, нужна была качественная черновая база. Сдали за 45 дней с опережением на 3 дня.',
                'challenges' => [
                    'Строгий допуск застройщика к работам — всё оформляли официально',
                    'Идеально ровные стены под покраску: допуск по вертикали 1 мм на 2 м',
                    'Разводка электрики по авторскому плану заказчика с 22 точками',
                ],
                'before' => 'before-02.jpg',
                'after' => 'after-01.jpg',
                'gallery' => ['gallery-03.jpg', 'gallery-01.jpg'],
                'sortOrder' => 6,
            ],
            [
                'slug' => 'novostroyka-55',
                'title' => 'Новостройка, 55 м²',
                'area' => '55 м²',
                'type' => 'Новостройка',
                'pkg' => 'Белый · Эконом',
                'days' => 70,
                'year' => 2024,
                'summary' => 'Однокомнатная квартира для молодой семьи. Минималистичный стиль, светлые тона, максимум функциональности при небольшом бюджете.',
                'challenges' => [
                    'Оптимизация бюджета без потери качества отделки',
                    'Грамотное зонирование небольшого пространства',
                    'Монтаж встроенной мебели в нишах',
                ],
                'before' => 'before-03.jpg',
                'after' => 'after-02.jpg',
                'gallery' => ['gallery-01.jpg', 'gallery-02.jpg', 'gallery-04.jpg'],
                'sortOrder' => 7,
            ],
            [
                'slug' => 'vtorichka-75',
                'title' => 'Вторичка, 75 м²',
                'area' => '75 м²',
                'type' => 'Вторичка',
                'pkg' => 'Серый · Комфорт',
                'days' => 95,
                'year' => 2025,
                'summary' => 'Четырёхкомнатная квартира 1980-х годов. Полная замена инженерных систем, перепланировка двух комнат, авторская отделка с элементами лофта.',
                'challenges' => [
                    'Полная замена электропроводки и водопровода',
                    'Демонтаж и перенос ненесущих стен',
                    'Авторская кладка кирпича в гостиной',
                    'Реставрация паркета 1980-х годов в двух комнатах',
                ],
                'before' => 'before-04.jpg',
                'after' => 'after-03.jpg',
                'gallery' => ['gallery-01.jpg', 'gallery-03.jpg', 'gallery-04.jpg'],
                'sortOrder' => 8,
            ],
        ];

        foreach ($casesData as $data) {
            $case = new RenovationCase();
            $case->setSlug($data['slug']);
            $case->setTitle($data['title']);
            $case->setArea($data['area']);
            $case->setType($data['type']);
            $case->setPkg($data['pkg']);
            $case->setDays($data['days']);
            $case->setYear($data['year']);
            $case->setSummary($data['summary']);
            $case->setChallenges($data['challenges']);
            $case->setImgBeforeName($data['before']);
            $case->setImgAfterName($data['after']);
            $case->setSortOrder($data['sortOrder']);
            $manager->persist($case);

            foreach ($data['gallery'] as $i => $imgName) {
                $gallery = new CaseGalleryImage();
                $gallery->setRenovationCase($case);
                $gallery->setImageName($imgName);
                $gallery->setSortOrder($i + 1);
                $manager->persist($gallery);
            }
        }
    }

    private function loadTestimonials(ObjectManager $manager): void
    {
        $items = [
            ['name' => 'Алёна К.', 'obj' => 'Новостройка, 72 м²', 'pkg' => 'Белый · Комфорт', 'stars' => 5, 'quote' => 'Боялась, что ремонт растянется на год. Сдали за 87 дней. Всё сделали сами — я только выбирала цвета. Рекомендую без оговорок.'],
            ['name' => 'Дмитрий П.', 'obj' => 'Вторичка, 55 м²', 'pkg' => 'Серый · Комфорт+', 'stars' => 5, 'quote' => 'Делали полный снос с перепланировкой. Цена из договора не изменилась ни на рубль. Смета была чёткой ещё до подписания.'],
            ['name' => 'Марина и Сергей', 'obj' => 'Студия, 36 м²', 'pkg' => 'Белый · Эконом', 'stars' => 5, 'quote' => 'Брали для сдачи в аренду. Практично, без лишнего, уложились в бюджет. Арендаторы нашлись за 3 дня после заселения.'],
            ['name' => 'Олег В.', 'obj' => 'Вторичка, 90 м²', 'pkg' => 'Серый · Премиум', 'stars' => 5, 'quote' => 'Сложный объект — старый фонд, кривые стены, труднодоступные места. Команда справилась. Качество отделки выше ожиданий.'],
            ['name' => 'Наталья Р.', 'obj' => 'Новостройка, 48 м²', 'pkg' => 'White Box', 'stars' => 5, 'quote' => 'White Box сделали идеально ровно. Потом сами красили — ни одного нарекания к черновой базе. Спасибо за профессионализм.'],
            ['name' => 'Артём и Юля', 'obj' => 'Новостройка, 65 м²', 'pkg' => 'Белый · Комфорт', 'stars' => 5, 'quote' => 'Въехали точно в срок. Прораб на связи 24/7, все вопросы решались быстро. Чистота на объекте — отдельный плюс.'],
        ];

        foreach ($items as $i => $data) {
            $testimonial = new Testimonial();
            $testimonial->setName($data['name']);
            $testimonial->setObj($data['obj']);
            $testimonial->setPkg($data['pkg']);
            $testimonial->setStars($data['stars']);
            $testimonial->setQuote($data['quote']);
            $testimonial->setSortOrder($i + 1);
            $manager->persist($testimonial);
        }
    }

    private function loadPackages(ObjectManager $manager): void
    {
        $items = [
            [
                'slug' => 'white-box',
                'name' => 'White Box',
                'sub' => 'Черновая отделка',
                'description' => 'Идеально для тех, кто хочет сделать финишную отделку по собственному дизайн-проекту.',
                'forWho' => ['Планируете нанять дизайнера интерьера', 'Хотите сами выбрать все финишные материалы', 'Покупаете новостройку и ждёте ключей'],
                'includes' => ['Выравнивание стен — штукатурка/шпатлёвка', 'Стяжка пола', 'Черновая разводка электрики', 'Разводка водоснабжения и канализации', 'Монтаж радиаторов', 'Установка дверей', 'Монтаж оконных откосов'],
                'levels' => null,
                'price' => 'от 8 000 ₽/м²',
                'featured' => false,
                'image' => 'package-whitebox.jpg',
                'sortOrder' => 1,
            ],
            [
                'slug' => 'belyy',
                'name' => 'Белый',
                'sub' => 'Готово для жизни',
                'description' => 'Полный ремонт «под ключ». Заезжаете и живёте — нейтральная чистая отделка под любую мебель.',
                'forWho' => ['Хотите въехать сразу после ремонта', 'Не хотите вникать в детали материалов', 'Ищете качество без излишеств'],
                'includes' => ['Всё из White Box', 'Финишная штукатурка и покраска стен', 'Укладка напольного покрытия', 'Плитка в санузлах', 'Установка сантехники', 'Натяжные потолки', 'Чистовая электрика', 'Финальный клининг'],
                'levels' => ['Эконом', 'Комфорт', 'Комфорт+'],
                'price' => 'от 16 000 ₽/м²',
                'featured' => true,
                'image' => 'package-belyy.jpg',
                'sortOrder' => 2,
            ],
            [
                'slug' => 'seryy',
                'name' => 'Серый',
                'sub' => 'С характером',
                'description' => 'Дизайнерская отделка с индивидуальным подходом. Нестандартные материалы, авторские решения.',
                'forWho' => ['Важна атмосфера и индивидуальность', 'Готовы выбирать материалы вместе с нами', 'Хотите результат с характером'],
                'includes' => ['Всё из Белого · Комфорт', 'Дизайн-сопровождение', 'Нестандартные материалы', 'Авторские решения по свету', 'Индивидуальный подбор плитки', 'Перегородки, ниши, арки', 'Скрытые карнизы и световые линии'],
                'levels' => ['Комфорт', 'Комфорт+'],
                'price' => 'от 24 000 ₽/м²',
                'featured' => false,
                'image' => 'package-seryy.jpg',
                'sortOrder' => 3,
            ],
        ];

        foreach ($items as $data) {
            $pkg = new Package();
            $pkg->setSlug($data['slug']);
            $pkg->setName($data['name']);
            $pkg->setSub($data['sub']);
            $pkg->setDescription($data['description']);
            $pkg->setForWho($data['forWho']);
            $pkg->setIncludes($data['includes']);
            $pkg->setLevels($data['levels']);
            $pkg->setPrice($data['price']);
            $pkg->setFeatured($data['featured']);
            $pkg->setImageName($data['image']);
            $pkg->setSortOrder($data['sortOrder']);
            $manager->persist($pkg);
        }
    }

    private function loadFaqs(ObjectManager $manager): void
    {
        $items = [
            ['q' => 'Почему у вас фиксированная цена? Ремонт обычно дорожает в процессе.', 'a' => 'Мы делаем детальную смету до подписания договора. Если в процессе выясняются скрытые работы — обсуждаем и фиксируем отдельно, но не задним числом.'],
            ['q' => 'Можно ли использовать свои материалы?', 'a' => 'Нет. Мы работаем только с проверенными поставщиками и закупаем материалы сами. Это часть нашей ответственности за результат.'],
            ['q' => '90 дней — это реально? Что если не успеете?', 'a' => 'Срок фиксируется в договоре. Если возникают задержки по нашей вине — это отдельный разговор с компенсацией.'],
            ['q' => 'Как я буду следить за ходом ремонта?', 'a' => 'Еженедельные фото-отчёты в удобный мессенджер. У вас есть менеджер на связи.'],
            ['q' => 'Что такое рассрочка? Это кредит?', 'a' => 'Нет, не банковский кредит. Мы разбиваем оплату на несколько частей, привязанных к этапам работ.'],
            ['q' => 'Работаете только в Москве?', 'a' => 'Москва и Московская область. На удалённые объекты выезжаем — уточните при заявке.'],
            ['q' => 'Как быстро вы ответите на заявку?', 'a' => 'В рабочее время — в течение 30 минут. Вечером или в выходной — утром следующего рабочего дня.'],
            ['q' => 'Есть ли гарантия на работы?', 'a' => 'Да. Гарантия на все виды работ — 12 месяцев. Если что-то проявится — приедем и устраним.'],
        ];

        foreach ($items as $i => $data) {
            $faq = new Faq();
            $faq->setQuestion($data['q']);
            $faq->setAnswer($data['a']);
            $faq->setSortOrder($i + 1);
            $manager->persist($faq);
        }
    }

    private function loadContacts(ObjectManager $manager): void
    {
        $contact = new SiteContact();
        $contact->setPhone('+7 (999) 123-45-67');
        $contact->setWhatsapp('+79991234567');
        $contact->setTelegram('@remodpro');
        $contact->setAddress('ул. Примерная, 1 — по договорённости');
        $contact->setCity('Москва и Московская область');
        $contact->setHoursWeekday('9:00–20:00');
        $contact->setHoursSaturday('10:00–18:00');
        $contact->setHoursSunday('по договорённости');
        $manager->persist($contact);
    }
}
