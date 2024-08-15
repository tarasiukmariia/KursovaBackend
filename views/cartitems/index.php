<?php
$this->Title = 'Кошик';
if (empty($cart)) {
    $this->Title = 'Кошик пустий';
    $cart = [];
}
$modelArray = [];
$totalPrice = array_reduce($cart, function ($sum, $item) {
    return $sum + $item['price'];
}, 0);
?>
<style>
    .delete-icon {
        cursor: pointer;
        font-size: 20px;
        margin-left: 10px;
    }

    .price-column {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
</style>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <?php if (!empty($cart)) : ?>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Назва товару</th>
                        <th>Категорія</th>
                        <th>Ціна (грн)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($cart as $item) :
                        $tableName = '\\models\\' . ucfirst($item['product_type']);
                        $model = $tableName::findById($item['product_id']);
                        $modelArray [] = $item['product_type'].'#'.$model['id'];
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($model['brand'] . " " . $model['model']) ?></td>
                            <td><?= htmlspecialchars($model['category']) ?></td>
                            <td class="price-column"><?= number_format($item['price'], 2) ?>
                                <form method="post" action="">
                                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                    <button name="action" value="delete" type="submit"
                                            class="delete-icon btn btn-outline-danger">
                                        <span>&times;</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="text-right">
                    <h4>Загальна ціна: <?= number_format($totalPrice, 2) ?> грн</h4>
                </div>
                <div class="text-right mt-3">
                    <form method="post" action="">
                        <input type="hidden" name="user_id" value="<?= $cart[0]['user_id'] ?>">
                        <input type="hidden" name="modelArray" value="<?=implode('&',$modelArray)?>">
                        <button name="action" value="buy" class="btn btn-success" onclick="buyItems()">Купити</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<script>
    function buyItems() {
        alert('Покупка успішна!');
    }
</script>
