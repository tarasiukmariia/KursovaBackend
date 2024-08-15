<?php
/** @var string $error_message Повідомлення про помилку */
$this->Title = 'Додавання товару';
?>
<form method="post" action="" enctype="multipart/form-data">
    <?php
    if (!empty($error_message)) : ?>
        <div class="alert alert-danger" role="alert">
            <?= $error_message ?>
        </div>
    <?php endif; ?>
    <div>
        <div class="mb-3">
            <label for="InputCategory" class="form-label">Категорія</label>
            <select name="table" class="form-select" id="InputCategory">
                <option selected value="Accessories">Аксесуари</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="InputSubCategory" class="form-label">Підкатегорія</label>
            <select name="category" class="form-select" id="InputSubCategory">
                <option selected value=""></option>
            </select>
        </div>
        <div class="mb-3">
            <label for="InputBrand" class="form-label">Бренд</label>
            <input name="brand" type="text" class="form-control" id="InputBrand">
        </div>
        <div class="mb-3">
            <label for="InputModel" class="form-label">Модель</label>
            <input name="model" type="text" class="form-control" id="InputModel">
        </div>
        <div class="mb-3">
            <label for="InputCountry" class="form-label">Країна виробника</label>
            <input name="country" type="text" class="form-control"
                   id="InputCountry">
        </div>
        <div class="mb-3">
            <label for="InputCount" class="form-label">Кількість</label>
            <input name="count" type="number" step="1" class="form-control"
                   id="InputCount">
        </div>
        <div class="mb-3">
            <label for="InputPrice" class="form-label">Ціна</label>
            <input name="price" type="number" step="0.01" class="form-control"
                   id="InputPrice">
        </div>
        <div class="mb-3">
            <label for="InputDescription" class="form-label">Опис</label>
            <textarea id="InputDescription" name="description" class="form-control" rows="6" ></textarea>
        </div>
        <div class="mb-3">
            <label for="file" class="form-label">Завантажити файл:</label>
            <input id="file"  type="file" class="form-control"
                   name="image" required>
        </div>
        <button type="submit" class="btn btn-primary">Додати</button>
    </div>
</form>
<script>
    const subCategories = {
        Accessories: <?= json_encode(\models\Accessories::findCategory()) ?>,
    };

    document.getElementById('InputCategory').addEventListener('change', function () {
        const selectedCategory = this.value;
        const subCategorySelect = document.getElementById('InputSubCategory');
        subCategorySelect.innerHTML = '<option selected value=""></option>';
        const subCategoriesArray = Object.values(subCategories[selectedCategory]);
        subCategoriesArray.forEach(function (subCategory) {
            const option = document.createElement('option');
            option.value = subCategory;
            option.textContent = subCategory;
            subCategorySelect.appendChild(option);
        });
    });
    document.getElementById('InputCategory').dispatchEvent(new Event('change'));
</script>
