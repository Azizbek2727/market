<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'encodeLabels' => false,
                'items' => [
                    [
                        'label' => Yii::t('app', 'Заказы') . \dvizh\order\widgets\CountByStatusInformer::widget([
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
                        'label' => Yii::t('app', 'Магазин'),
                        'icon' => 'shopping-bag',
                        'url' => '#',
                        'visible' => Yii::$app->user->can('superadmin'),
                        'items' => [
                            ['label' => Yii::t('app', 'Товары'), 'url' => ['/shop/product']],
                            ['label' => Yii::t('app', 'Категории'), 'url' => ['/shop/category']],
                            ['label' => Yii::t('app', 'Производители'), 'url' => ['/shop/producer']],
                            ['label' => Yii::t('app', 'Фильтры'), 'url' => ['/filter/filter']],
                        ],
                    ],
                    [
                        'label' => Yii::t('app', 'Маркетинг'),
                        'icon' => 'area-chart',
                        'url' => '#',
                        'visible' => Yii::$app->user->can('superadmin'),
                        'items' => [
                            ['label' => Yii::t('app', 'Промокоды'), 'url' => ['/promocode/promo-code/index']],
                            ['label' => Yii::t('app', 'Сертификаты'), 'url' => ['/certificate/certificate/index']],
                        ],
                    ],
                    [
                        'label' => Yii::t('app', 'Сайт'),
                        'icon' => 'sitemap',
                        'url' => '#',
                        'visible' => Yii::$app->user->can('superadmin'),
                        'items' => [
                            ['label' => Yii::t('app', 'Пользователи'), 'url' => ['/user/admin/index']],
                            ['label' => Yii::t('app', 'Слайдер'), 'url' => ['/slider/index']],
                            ['label' => Yii::t('app', 'Новости'), 'url' => ['/news/index']],
                            ['label' => Yii::t('app', 'Страницы'), 'url' => ['/page/index']],
                            ['label' => Yii::t('app', 'Переводы'), 'url' => ['/translation/index']],
                        ],
                    ],
                    [
                        'label' => Yii::t('app', 'Настройки'),
                        'icon' => 'cogs',
                        'url' => '#',
                        'visible' => Yii::$app->user->can('superadmin'),
                        'items' => [
                            ['label' => Yii::t('app', 'Поля контента'), 'url' => ['/field/field/index']],
                            ['label' => Yii::t('app', 'Поля заказа'), 'url' => ['/order/field/index']],
                            ['label' => Yii::t('app', 'Типы цен'), 'url' => ['/shop/price-type']],
                            ['label' => Yii::t('app', 'Типы доставки'), 'url' => ['/order/shipping-type/index']],
                            ['label' => Yii::t('app', 'Типы оплаты'), 'url' => ['/order/payment-type/index']],
                            ['label' => Yii::t('app', 'Настройки сайта'), 'url' => ['/settings/default/index']],
                        ]
                    ],

                ],
            ]
        ) ?>

    </section>

</aside>
