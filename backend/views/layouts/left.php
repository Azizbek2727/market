<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'encodeLabels' => false,
                'items' => [
                    [
                        'label' => Yii::t('admin', 'Заказы') . \dvizh\order\widgets\CountByStatusInformer::widget([
                                'renderEmpty' => true,
                                'iTagCssClass' => '',
                                'aTag' => false
                            ]) ,
                        //'icon' => 'fa fa-suitcase',
                        'visible' => Yii::$app->user->can('superadmin'),
                        'url' => ['/order/order/index']
                    ],
                    ['label' => 'Магазин', 'options' => ['class' => 'header']],
                    [
                        'label' => Yii::t('admin', 'Магазин'),
                        'icon' => 'shopping-bag',
                        'url' => '#',
                        'visible' => Yii::$app->user->can('superadmin'),
                        'items' => [
                            ['label' => Yii::t('admin', 'Товары'), 'url' => ['/shop/product']],
                            ['label' => Yii::t('admin', 'Категории'), 'url' => ['/shop/category']],
                            ['label' => Yii::t('admin', 'Производители'), 'url' => ['/shop/producer']],
                            ['label' => Yii::t('admin', 'Фильтры'), 'url' => ['/filter/filter']],
                        ],
                    ],
                    [
                        'label' => Yii::t('admin', 'Маркетинг'),
                        'icon' => 'area-chart',
                        'url' => '#',
                        'visible' => Yii::$app->user->can('superadmin'),
                        'items' => [
                            ['label' => Yii::t('admin', 'Промокоды'), 'url' => ['/promocode/promo-code/index']],
                            ['label' => Yii::t('admin', 'Сертификаты'), 'url' => ['/certificate/certificate/index']],
                        ],
                    ],
                    [
                        'label' => Yii::t('admin', 'Сайт'),
                        'icon' => 'sitemap',
                        'url' => '#',
                        'visible' => Yii::$app->user->can('superadmin'),
                        'items' => [
                            ['label' => Yii::t('admin', 'Пользователи'), 'url' => ['/user/admin/index']],
                            ['label' => Yii::t('admin', 'Слайдер'), 'url' => ['/slider/index']],
                            ['label' => Yii::t('admin', 'Новости'), 'url' => ['/news/index']],
                            ['label' => Yii::t('admin', 'Страницы'), 'url' => ['/page/index']],
                            ['label' => Yii::t('admin', 'Переводы'), 'url' => ['/translation/index']],
                        ],
                    ],
                    [
                        'label' => Yii::t('admin', 'Настройки'),
                        'icon' => 'cogs',
                        'url' => '#',
                        'visible' => Yii::$app->user->can('superadmin'),
                        'items' => [
                            ['label' => Yii::t('admin', 'Поля контента'), 'url' => ['/field/field/index']],
                            ['label' => Yii::t('admin', 'Поля заказа'), 'url' => ['/order/field/index']],
                            ['label' => Yii::t('admin', 'Типы цен'), 'url' => ['/shop/price-type']],
                            ['label' => Yii::t('admin', 'Типы доставки'), 'url' => ['/order/shipping-type/index']],
                            ['label' => Yii::t('admin', 'Типы оплаты'), 'url' => ['/order/payment-type/index']],
                            ['label' => Yii::t('admin', 'Настройки сайта'), 'url' => ['/settings/default/index']],
                        ]
                    ],

                ],
            ]
        ) ?>

    </section>

</aside>
