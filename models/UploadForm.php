<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    public $imageJson; //ToDo Надо ли Json???
    public $modelId;
    public $section; //Имя раздела сайта
    public $imgDir = 'img/uploads/';

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload() //ToDo
    {
        if ($this->validate()) { //ToDO Проверка существования папки??
            $fullPath = $this->imgDir . $this->section . $this->modelId;
            mkdir($fullPath);
            $filePath = $fullPath . '/' . Yii::$app->getSecurity()->generateRandomString(12) . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs($filePath);
            return true;
        }
            return false;
    }
}