<aside class="main-sidebar">

    <section class="sidebar">


        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Меню', 'options' => ['class' => 'header']],
                    ['label' => 'Страницы', 'icon' => 'fa fa-dashboard', 'url' => ['/page']],
                    ['label' => 'Отчеты', 'icon' => 'fa fa-dashboard', 'url' => ['/reports/default/view-reports/']],
                    ['label' => 'Отчеты2', 'icon' => 'fa fa-dashboard', 'url' => ['/reports/default/view-reports-on-money/']],
                    ['label' => 'Пользователи', 'icon' => 'fa fa-dashboard', 'url' => ['/user/default/']],
                    ['label' => 'Управление лицевым счетом', 'icon' => 'fa fa-dashboard', 'url' => ['/user/personal-acc/']],
                    ['label' => 'История оплаты', 'icon' => 'fa fa-dashboard', 'url' => ['/user/payment-data/']],

                ],
            ]
        ) ?>

    </section>

</aside>
