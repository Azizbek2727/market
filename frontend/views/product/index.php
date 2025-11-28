<?php
/* @var $this \yii\web\View */
/* @var $products \dvizh\shop\models\Product[] */
/* @var $categories \dvizh\shop\models\Category[] */

use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = 'Catalogue';
?>

<!-- Page content -->
<main class="content-wrapper">

    <!-- Breadcrumb -->
    <nav class="container pt-3 my-3 my-md-4" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Catalog</li>
        </ol>
    </nav>


    <!-- Page title -->
    <h1 class="h3 container mb-4">Shop catalog</h1>


    <!-- Selected filters + Sorting -->
    <section class="container mb-4">
        <div class="row">
            <div class="col-lg-9">
            </div>
            <div class="col-lg-3 mt-3 mt-lg-0">
                <div class="d-flex align-items-center justify-content-lg-end text-nowrap">
                    <label class="form-label fw-semibold mb-0 me-2">Sort by:</label>
                    <div style="width: 190px">
                        <select class="form-select border-0 rounded-0 px-1" data-select='{
                  "removeItemButton": false,
                  "classNames": {
                    "containerInner": ["form-select", "border-0", "rounded-0", "px-1"]
                  }
                }'>
                            <option value="Relevance">Relevance</option>
                            <option value="Popularity">Popularity</option>
                            <option value="Price: Low to High">Price: Low to High</option>
                            <option value="Price: High to Low">Price: High to Low</option>
                            <option value="Newest Arrivals">Newest Arrivals</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <hr class="d-lg-none my-3">
    </section>


    <!-- Products grid + Sidebar with filters -->
    <section class="container pb-5 mb-sm-2 mb-md-3 mb-lg-4 mb-xl-5">
        <div class="row">

            <!-- Filter sidebar that turns into offcanvas on screens < 992px wide (lg breakpoint) -->
            <aside class="col-lg-3">
                <div class="offcanvas-lg offcanvas-start" id="filterSidebar">
                    <div class="offcanvas-header py-3">
                        <h5 class="offcanvas-title">Filter and sort</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#filterSidebar" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body flex-column pt-2 py-lg-0">
                        <!-- Categories -->
                        <div class="w-100 border rounded p-3 p-xl-4 mb-3 mb-xl-4">
                            <h4 class="h6 mb-2">Categories</h4>
                            <ul class="list-unstyled d-block m-0">
                                <?php foreach ($categories as $category):  ?>
                                <li class="nav d-block pt-2 mt-1">
                                    <a class="nav-link animate-underline fw-normal p-0" href="<?= Url::to(['/product/index', 'category' => $category['id']]) ?>">
                                        <span class="animate-target text-truncate me-3"><?= $category['name'] ?></span>
                                    </a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </aside>


            <!-- Product grid -->
            <div class="col-lg-9">
                <?=
                 ListView::widget([
                    'dataProvider' => $products,
                    'itemView' => '_product_item',
                    'layout' => '{items}{pager}',
                    'options' => ['class' => 'product-list'],
                    'itemOptions' => ['class' => 'col'], // matches your template
                     'options' => ['class' => 'row row-cols-2 row-cols-md-3 g-4 pb-3 mb-3'],
                    'pager' => [
                        'options' => ['class' => 'pagination justify-content-center mt-4'],
                    ]
                 ]);
                ?>

                <!-- Pagination -->
                <nav class="border-top mt-4 pt-3" aria-label="Catalog pagination">
                    <ul class="pagination pagination-lg pt-2 pt-md-3">
                        <li class="page-item disabled me-auto">
                            <a class="page-link d-flex align-items-center h-100 fs-lg px-2" href="#!" aria-label="Previous page">
                                <i class="ci-chevron-left mx-1"></i>
                            </a>
                        </li>
                        <li class="page-item active" aria-current="page">
                  <span class="page-link">
                    1
                    <span class="visually-hidden">(current)</span>
                  </span>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#!">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#!">3</a>
                        </li>
                        <li class="page-item">
                            <span class="page-link pe-none">...</span>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#!">16</a>
                        </li>
                        <li class="page-item ms-auto">
                            <a class="page-link d-flex align-items-center h-100 fs-lg px-2" href="#!" aria-label="Next page">
                                <i class="ci-chevron-right mx-1"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
</main>
