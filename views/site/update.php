<?php
/** @var string $error_message Повідомлення про помилку */
$this->Title = 'Редагування товару';
if (empty($model))
    $model = [];
?>
<style>
    .image-column {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .form-column {
        padding-left: 20px;
    }
</style>
<form method="post" action="" enctype="multipart/form-data">
    <?php
    if (!empty($error_message)) : ?>
        <div class="alert alert-danger" role="alert">
            <?= $error_message ?>
        </div>
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 image-column">
                <div class="card mb-3" style="width: 100%;">
                    <img src="data:image/jpg;base64,<?= \core\Model::getImage($model) ?>" class="card-img-top" alt="">
                </div>
            </div>
            <div class="col-md-8 form-column">
                <div class="mb-3">
                    <label for="InputCategory" class="form-label">Підкатегорія</label>
                    <input value="<?= $model['category']?>" name="category" type="text" class="form-control" id="InputCategory"  disabled>
                </div>
                <div class="mb-3">
                    <label for="InputBrand" class="form-label">Бренд</label>
                    <input value="<?= $model['brand']?>" name="brand" type="text" class="form-control" id="InputBrand">
                </div>
                <div class="mb-3">
                    <label for="InputModel" class="form-label">Модель</label>
                    <input value="<?= $model['model']?>" name="model" type="text" class="form-control" id="InputModel">
                </div>
                <div class="mb-3">
                    <label for="InputCountry" class="form-label">Країна виробника</label>
                    <input value="<?= $model['country']?>" name="country" type="text" class="form-control" id="InputCountry">
                </div>
                <div class="mb-3">
                    <label for="InputCount" class="form-label">Кількість</label>
                    <input value="<?= $model['count']?>" name="count" type="number" step="1" class="form-control" id="InputCount">
                </div>
                <div class="mb-3">
                    <label for="InputPrice" class="form-label">Ціна</label>
                    <input value="<?= $model['price']?>" name="price" type="number" step="0.01" class="form-control" id="InputPrice">
                </div>
                <div class="mb-3">
                    <label for="InputDescription" class="form-label">Опис</label>
                    <textarea id="text" name="description" class="form-control" rows="6" required><?= $model['description'] ?></textarea>
                </div>
                <input type="hidden" name="productId" value="<?= $model['id']?>">
                <div class="mb-3">
                    <label for="file" class="form-label">Завантажити файл:</label>
                    <input id="file" type="file" class="form-control" name="image">
                </div>
                <button type="submit" name="action" value="save" class="btn btn-primary">Зберегти</button>
                <button type="submit" name="action" value="delete" class="btn btn-danger">Видалити</button>
            </div>
        </div>
    </div>
</form>