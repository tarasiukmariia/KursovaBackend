<?php
/** @var array $accessoriesarray */
/** @var array $brands */
/** @var array $countries */
$this->Title = 'Аксесуари для обличчя';
if (empty($accessoriesarray))
    $accessoriesarray = [];
?>
<link href="/css/viewsstyle.css" rel="stylesheet"/>
<div class="sidebar">
    <h5 class="text-center">Фільтри</h5>
    <form method="post" action="">
        <div class="mb-3 w-75">
            <label for="brand" class="form-label">Бренд</label>
            <select name="brand" class="form-select" id="brand">
                <option selected>Усі</option>
                <?php foreach ($brands as $brand) { ?>
                    <option value="<?= $brand ?>"><?= $brand ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3 w-75">
            <label for="category" class="form-label">Країна виробника</label>
            <select name="country" class="form-select" id="category">
                <option selected>Усі</option>
                <?php foreach ($countries as $country) { ?>
                    <option value="<?= $country ?>"><?= $country ?></option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-50 " style="background-color: #3e292e">Застосувати</button>
    </form>
</div>
<div class="content">
    <div class="row">
        <?php foreach ($accessoriesarray as $accessories) { ?>
            <div class="col-md-4">
                <a style="text-decoration: none; color: inherit;" href="/accessories/view/<?= $accessories['id'] ?>">
                    <div class="card mb-4 h-100">
                        <?php if ($accessories['count'] > 0) : ?>
                        <?php else : ?>
                            <p style="color: #e12b2b"> Немає в наявності</p>
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