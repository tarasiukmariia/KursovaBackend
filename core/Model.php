<?php

namespace core;

use models\Guitars;

class Model
{
    protected $fieldsArray;
    protected static $primaryKey = 'id';
    protected static $tableName = '';

    public function __construct()
    {
        $this->fieldsArray = [];
    }

    public function __set($name, $value)
    {
        $this->fieldsArray[$name] = $value;
    }

    public function __get($name)
    {
        return $this->fieldsArray[$name];
    }

    public static function deleteById($id)
    {
        Core::get()->db->delete(static::$tableName, [static::$primaryKey => $id]);
    }

    public static function deleteByCondition($conditionAssocArray)
    {
        Core::get()->db->delete(static::$tableName, $conditionAssocArray);
    }

    public static function findById($id)
    {
        $arr = Core::get()->db->select(static::$tableName, '*', [static::$primaryKey => $id]);
        if (count($arr) > 0)
            return $arr[0];
        else
            return null;
    }

    public static function createObjById($id)
    {
        $array = static::findById($id);
        $obj = new static();
        foreach ($array as $key => $value) {
            $obj->$key = $value;
        }
        return $obj;
    }

    public static function findByCondition($conditionAssocArray)
    {
        $arr = Core::get()->db->select(static::$tableName, '*', $conditionAssocArray);
        if (count($arr) > 0)
            return $arr;
        else
            return null;
    }

    public static function findCategory()
    {
        $tableName = '\\models\\' . ucfirst(static::$tableName);
        $table = new $tableName();
        $array = $table->findByCondition(null);
        $categories = [];
        foreach ($array as $arr) {
            $categories [] = $arr['category'];
        }
        $categories = array_unique($categories);
        return $categories;
    }

    public static function findCountries($category): array
    {
        $tableName = '\\models\\' . ucfirst(static::$tableName);
        $table = new $tableName();
        $array = $table->findByCondition(['category' => $category]);
        $countries = [];
        foreach ($array as $arr) {
            $countries [] = $arr['country'];
        }
        $countries = array_unique($countries);
        return $countries;
    }

    public static function findBrands($category): array
    {
        $tableName = '\\models\\' . ucfirst(static::$tableName);
        $table = new $tableName();
        $array = $table->findByCondition(['category' => $category]);
        $brands = [];
        foreach ($array as $arr) {
            $brands [] = $arr['brand'];
        }
        $brands = array_unique($brands);
        return $brands;
    }

    public static function getImage($model)
    {
        $image = $model['image'];
        if (!empty($image))
            return base64_encode($image);
        else
            return null;
    }

    public static function getImageContent($image)
    {
        if ($image['error'] !== UPLOAD_ERR_OK) {
            throw new \Exception('File upload error.');
        }

        if (!self::checkFile($image)) {
            throw new \Exception('Invalid file type.');
        }

        $fileContent = file_get_contents($image['tmp_name']);

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $image['tmp_name']);
        finfo_close($finfo);

        $type = self::determineTypeFromMimeType($mimeType);
        if ($type === null) {
            throw new \Exception('Unsupported file type.');
        }
        return $fileContent;
    }

    private static function checkFile($file)
    {
        $allowedMimeTypes = ['image/jpeg', 'image/png','image/jpg'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
        return in_array($mimeType, $allowedMimeTypes);
    }

    private static function determineTypeFromMimeType($mimeType)
    {
        $mimeTypeMap = [
            'image/jpeg' => 'jpeg',
            'image/png' => 'png',
            'image/jpg' => 'jpg'
        ];

        return $mimeTypeMap[$mimeType] ?? null;
    }

    public static function saveProduct($id = null, $tableName, $category = null, $brand, $model, $country = null, $count, $price, $description, $image = null)
    {
        $isUpdate = false;
        $tablename = '\\models\\' . $tableName;
        if ($id != null) {
            $table = $tablename::createObjById($id);
            $isUpdate = true;
        } else {
            $table = new  $tablename();
        }
        if ($category != null) {
            $table->category = $category;
        }
        $table->brand = $brand;
        $table->model = $model;
        $table->country = $country;
        $table->count = $count;
        $table->price = $price;
        $table->description = $description;
        if ($image != null) {
            $table->image = Model::getImageContent($image);
        }
        if($isUpdate){
            $table->saveUpdate();
        }
        else{
            $table->saveInsert();
        }
    }
    public static function searchProductsByBrand($brand)
    {
        $db = Core::get()->db;
        $sql = "SELECT * FROM ".static::$tableName." WHERE brand LIKE :brand";
        $sth = $db->pdo->prepare($sql);
        $sth->bindValue(':brand', '%' . $brand . '%', \PDO::PARAM_STR);
        $sth->execute();
        return $sth->fetchAll();
    }
    public static function countDecrease($id)
    {
        $tableName = '\\models\\' . ucfirst(static::$tableName);
        $model = $tableName::createObjById($id);
        $model->count -= 1;
        $model->saveUpdate();
    }
    public function saveInsert()
    {
        Core::get()->db->insert(static::$tableName, $this->fieldsArray);
    }
    public function saveUpdate()
    {
        Core::get()->db->update(static::$tableName, $this->fieldsArray,
            [
                static::$primaryKey => $this->{static::$primaryKey}
            ]);
    }
}