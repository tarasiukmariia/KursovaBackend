<?php
if (empty($model))
    $model = [];
$this->Title = $model['brand'] . ' ' . $model['model'];
?>
<style>
    .product-container {
        display: flex;
        flex-direction: column;
        margin-bottom: 20px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        width: 80%;
        height: 90%;
        overflow: hidden;

    }

    .product-header {
        display: flex;
        padding: 20px;
        padding-bottom: 0px;
        background-color: #fff;
    }

    .product-image {
        flex: 0 0 150px;
        width: 100%;
        height: 450px;
        object-fit: cover;
        margin-right: 20px;
    }

    .product-details-container {
        padding-top: 30px;
        margin-left: 20%;
        text-align: right;
        font-family: ;
        font-size: 18px;
    }

    .product-name {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .product-price {
        font-size: 20px;
        color: #28a745;
        margin-bottom: 10px;
    }

    .add-to-cart-btn {
        margin-top: 20px;
        align-self: flex-start;
        background-color: white;
    }

    .product-description {
        padding: 20px;
        font-size: 18px;
        padding-top: 0px;
        background-color: #fff;
    }
</style>
<div class="content">
    <div class="product-container mx-auto">
        <div class="product-header">
            <img src="data:image/jpg;base64,<?= \core\Model::getImage($model) ?>" class="product-image" alt="">
            <div class="product-details-container">
                <div class="product-name"><?= $model['brand'] . ' ' . $model['model'] ?></div>
                <div class="product-price"><?= $model['price'] . ' грн' ?></div>
                <div class="product-details">Бренд: <?= $model['brand'] ?></div>
                <div class="product-details">Модель: <?= $model['model'] ?></div>
                <div class="product-details">Категорія: <?= $model['category'] ?></div>
                <?php if (!empty($model['country'])) : ?>
                    <div class="product-details">Країна виробник: <?= $model['country'] ?></div>
                <?php endif; ?>
                <form action="" method="post">
                    <input type="hidden" name="productId" value="<?= $model['id'] ?>">
                    <input type="hidden" name="category" value="<?= $model['category'] ?>">
                    <input type="hidden" name="price" value="<?= $model['price'] ?>">
                    <?php if (\models\Users::IsUserLogged() && $model['count'] > 0) : ?>
                    <button name="action" value="addtocart" type="submit"
                            class="btn btn-outline-dark add-to-cart-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-cart4" viewBox="0 0 16 16">
                            <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"></path>
                        </svg>
                        Додати до кошика
                    </button>
                    <?php endif; ?>
                </form>
            <?php if (\models\Users::IsUserLogged() )
                    if(\models\Users::IsUserAdmin()) : ?>
                <form action="" method="post">
                    <input type="hidden" name="productId" value="<?= $model['id'] ?>">
                    <button name="action" value="update" type="submit"
                            class="btn btn-outline-dark add-to-cart-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
                            <path fill-rule="evenodd"
                                  d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"></path>
                        </svg>
                        Редагувати
                    </button>
                </form>
            <?php endif; ?>
            </div>
        </div>
        <div class="product-description">
            <h5>Опис:<br></h5>
            <?= $model['description'] ?>
        </div>
    </div>
</div>

