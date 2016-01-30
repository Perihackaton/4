<aside class="main-sidebar">

    <section class="sidebar">


        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Меню', 'options' => ['class' => 'header']],
                    [
                        'label' => 'Управление объектами',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Объекты', 'icon' => 'fa fa-file-code-o', 'url' => ['/object/default/index'],],
                            ['label' => 'Категории', 'icon' => 'fa fa-dashboard', 'url' => ['/object/category/index'],],
                            ['label' => 'Доступность объектов', 'icon' => 'fa fa-file-code-o', 'url' => ['/object/access-type/index'],],
                        ],
                    ],
                    ['label' => 'Страницы', 'icon' => 'fa fa-dashboard', 'url' => ['/page']],
                    ['label' => 'Пользователи', 'icon' => 'fa fa-dashboard', 'url' => ['/user']],
                ],
            ]
        ) ?>

    </section>

</aside>
