<?php
/** @var array $accessoriesarray */
$this->Title = 'NERFIS';
if (empty($accessoriesarray))
    $accessoriesarray = [];
?>
<style>
    .carousel-item {
        width: 100%;
        height: 500px;
    }

    .row {
        padding-top: 20px;
    }

    .col-md-4 {
        padding: 10px;
    }

    .card > p {
        margin: 10px;
        text-align: right;
    }
</style>
<img src="/images/image1.jfif" class="rounded" style="width: 425px; height: 550px">
<img src="/images/image2.jfif" class="rounded" style="width: 425px; height: 550px">
<img src="/images/image3.jfif" class="rounded" style="width: 425px; height: 550px">

<div class="content">
    <div class="row">
        <h2>АКСЕСУАРИ</h2>
        <?php foreach ($accessoriesarray as $accessories) { ?>
            <div class="col-md-4">
                <a style="text-decoration: none; color: inherit;" href="/guitars/view/<?= $accessories['id'] ?>">
                    <div class="card mb-4 h-100">
                        <?php if ($accessories['count'] > 0) : ?>
                        <?php else : ?>
                            <p style="color: #e12b2b">♥ Немає в наявності</p>
                        <?php endif; ?>
                        <img src="data:image/jpg;base64,<?= \core\Model::getImage($accessories) ?>" class="card-img-top"
                             alt="">
                        <div class="card-body">
                            <h5 class="card-title"><?= $accessories['brand'] . ' ' . $accessories['model'] ?></h5>
                            <p class="card-text"><?= $accessories['price'] . ' грн' ?></p>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</div>
