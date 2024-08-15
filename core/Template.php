<?php

namespace core;

class Template
{
    protected $templateFilePath;
    protected $paramsArray;
    public Controller $controller;
    public function __set($name, $value){
        Core::get()->template->setParam($name,$value);
    }

    public function __construct($templateFilePath){
        $this->templateFilePath = $templateFilePath;
        $this->paramsArray = [];
    }
    public function setTemplateFilePath($path){
        $this->templateFilePath = $path;
    }
    public function setParam($paramName, $paramValue){
        $this->paramsArray[$paramName] = $paramValue;
    }
    public function setParams($params){
     foreach ($params as $key => $value)
         $this->setParam($key,$value);
    }
    public function getHTML(){
        ob_start();
        $this->controller = Core::get()->controllerObject;
        extract($this->paramsArray);
        include($this->templateFilePath);
        $str = ob_get_contents();
        ob_end_clean();
        return $str;
    }
    public function display(){
        echo $this->getHTML();
    }
}