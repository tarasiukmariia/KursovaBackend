<?php
$this->Title = 'Пошук';
$searchQuery = \core\Core::get()->controllerObject->post->searchQuery;

$array = [];
$array [] = \models\Accessories::searchProductsByBrand($searchQuery);

?>
<style>
    .card a {
        display: block;
        text-decoration: none;
        color: inherit;
    }

    .card a:hover {
        text-decoration: none;
    }
    .card > p {
        margin: 10px;
        text-align: right;
    }
    .col-md-4{
        padding: 10px;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class class="col-md-8">
            <h2 class="text-center mb-4">Результати пошуку :</h2>
            <div class="content">
                <div class="row">
                    <?php foreach ($array as $table) {
                        foreach ($table as $arr) {?>
                        <div class="col-md-4">
                            <a style="text-decoration: none; color: inherit;" href="/guitars/view/<?= $arr['id'] ?>">
                                <div class="card mb-4 h-100">
                                    <?php if ($arr['count'] > 0) : ?>
                                    <?php else : ?>
                                        <p style="color: #e12b2b">♥ Немає в наявності</p>
                                    <?php endif; ?>
                                    <img src="data:image/jpg;base64,<?= \core\Model::getImage($arr) ?>"
                                         class="card-img-top"
                                         alt="">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $arr['brand'] . ' ' . $arr['model'] ?></h5>
                                        <p class="card-text"><?= $arr['price'] . ' грн' ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php }} ?>
                </div>
            </div>
        </div>
    </div>
</div>