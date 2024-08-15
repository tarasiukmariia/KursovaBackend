<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Accessories;
use models\Cartitems;
use models\Users;

class AccessoriesController extends Controller
{
    public function actionIndex(): array
    {
        return $this->render();
    }
    public function actionBody(): array
    {
        $accessories = new Accessories();
        $countries = $accessories->findCountries('Аксесуари для тіла');
        $brands = $accessories->findBrands('Аксесуари для тіла');
        $assocArray = [];
        $assocArray ['category'] = 'Аксесуари для тіла';
        if ($this->isPost) {
            $brand = $this->post->brand;
            if (!empty($brand) && $brand != 'Усі') {
                $assocArray ['brand'] = $this->post->brand;
            }
            $country = $this->post->country;
            if (!empty($country) && $country != 'Усі') {
                $assocArray ['country'] = $this->post->country;
            }
        }
        $accessoriesarray = $accessories->findByCondition($assocArray);
        $this->template->setParams(['accessoriesarray' => $accessoriesarray, 'brands' => $brands, 'countries' => $countries]);
        return $this->render();
    }
    public function actionFace(): array
    {
        $accessories = new Accessories();
        $countries = $accessories->findCountries('Аксесуари для обличчя');
        $brands = $accessories->findBrands('Аксесуари для обличчя');
        $assocArray = [];
        $assocArray ['category'] = 'Аксесуари для обличчя';
        if ($this->isPost) {
            $brand = $this->post->brand;
            if (!empty($brand) && $brand != 'Усі') {
                $assocArray ['brand'] = $this->post->brand;
            }
            $country = $this->post->country;
            if (!empty($country) && $country != 'Усі') {
                $assocArray ['country'] = $this->post->country;
            }
        }
        $accessoriesarray = $accessories->findByCondition($assocArray);
        $this->template->setParams(['accessoriesarray' => $accessoriesarray, 'brands' => $brands, 'countries' => $countries]);
        return $this->render();
    }
    public function actionHair(): array
    {
        $accessories = new Accessories();
        $countries = $accessories->findCountries('Аксесуари для волосся');
        $brands = $accessories->findBrands('Аксесуари для волосся');
        $assocArray = [];
        $assocArray ['category'] = 'Аксесуари для волосся';
        if ($this->isPost) {
            $brand = $this->post->brand;
            if (!empty($brand) && $brand != 'Усі') {
                $assocArray ['brand'] = $this->post->brand;
            }
            $country = $this->post->country;
            if (!empty($country) && $country != 'Усі') {
                $assocArray ['country'] = $this->post->country;
            }
        }
        $accessoriesarray = $accessories->findByCondition($assocArray);
        $this->template->setParams(['accessoriesarray' => $accessoriesarray, 'brands' => $brands, 'countries' => $countries]);
        return $this->render();
    }
    public function actionHouse(): array
    {
        $accessories = new Accessories();
        $countries = $accessories->findCountries('Аксесуари для дому');
        $brands = $accessories->findBrands('Аксесуари для дому');
        $assocArray = [];
        $assocArray ['category'] = 'Аксесуари для дому';
        if ($this->isPost) {
            $brand = $this->post->brand;
            if (!empty($brand) && $brand != 'Усі') {
                $assocArray ['brand'] = $this->post->brand;
            }
            $country = $this->post->country;
            if (!empty($country) && $country != 'Усі') {
                $assocArray ['country'] = $this->post->country;
            }
        }
        $accessoriesarray = $accessories->findByCondition($assocArray);
        $this->template->setParams(['accessoriesarray' => $accessoriesarray, 'brands' => $brands, 'countries' => $countries]);
        return $this->render();
    }
    public function actionMakeup(): array
    {
        $accessories = new Accessories();
        $countries = $accessories->findCountries('Аксесуари для макіяжу');
        $brands = $accessories->findBrands('Аксесуари для макіяжу');
        $assocArray = [];
        $assocArray ['category'] = 'Аксесуари для макіяжу';
        if ($this->isPost) {
            $brand = $this->post->brand;
            if (!empty($brand) && $brand != 'Усі') {
                $assocArray ['brand'] = $this->post->brand;
            }
            $country = $this->post->country;
            if (!empty($country) && $country != 'Усі') {
                $assocArray ['country'] = $this->post->country;
            }
        }
        $accessoriesarray = $accessories->findByCondition($assocArray);
        $this->template->setParams(['accessoriesarray' => $accessoriesarray, 'brands' => $brands, 'countries' => $countries]);
        return $this->render();
    }
    public function actionUpdate($params)
    {
        if ($this->isPost) {
            if ($this->post->action === 'save') {
                if (strlen($this->post->brand) === 0)
                    $this->addErrorMessage('Бренд не вказано!');
                if (strlen($this->post->model) === 0)
                    $this->addErrorMessage('Модель не вказано!');
                if (strlen($this->post->count) === 0)
                    $this->addErrorMessage('Кількість не вказано!');
                if (strlen($this->post->price) === 0)
                    $this->addErrorMessage('Ціну не вказано!');
                if (strlen($this->post->description) === 0)
                    $this->addErrorMessage('Немає опису!');
                $image = null;
                if (!is_null($this->files->image) && $this->files->image['error'] === UPLOAD_ERR_OK) {
                    $image = $this->files->image;
                }
                if (!$this->isErrorMessageExists()) {
                    Accessories::saveProduct($this->post->productId, 'Accessories', $this->post->category,
                        $this->post->brand, $this->post->model, $this->post->country, $this->post->count,
                        $this->post->price, $this->post->description, $image);
                    return $this->redirect('/site/updatesuccess');
                }
            } else if ($this->post->action === 'delete') {
                Accessories::deleteById($this->post->productId);
                return $this->redirect('/site/deletesuccess');
            }
        }
        $guitar = Accessories::findById($params[0]);
        $this->template->setParam('model', $guitar);
        return $this->render('views/site/update.php');
    }

    public function actionView($params): array
    {
        $guitar = Accessories::findById($params[0]);
        $this->template->setParam('model', $guitar);
        if ($this->isPost) {
            if ($this->post->action === 'update') {
                return $this->redirect('/accessories/update/' . $this->post->productId);
            }
            if (Users::IsUserLogged()) {
                if ($this->post->action === 'addtocart')
                    Cartitems::addToCart(Core::get()->session->get('user')['id'], $this->post->productId, 'accessories', $this->post->price);
            }
        }
        return $this->render('views/layouts/view.php');
    }
    public function actionTeeth(): array
    {
        $accessories = new Accessories();
        $countries = $accessories->findCountries('Зубні щітки');
        $brands = $accessories->findBrands('Зубні щітки');
        $assocArray = [];
        $assocArray ['category'] = 'Зубні щітки';
        if ($this->isPost) {
            $brand = $this->post->brand;
            if (!empty($brand) && $brand != 'Усі') {
                $assocArray ['brand'] = $this->post->brand;
            }
            $country = $this->post->country;
            if (!empty($country) && $country != 'Усі') {
                $assocArray ['country'] = $this->post->country;
            }
        }
        $accessoriesarray = $accessories->findByCondition($assocArray);
        $this->template->setParams(['accessoriesarray' => $accessoriesarray, 'brands' => $brands, 'countries' => $countries]);
        return $this->render();
    }
}