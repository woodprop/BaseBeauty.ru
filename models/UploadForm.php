<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    public $imageJson;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) { //ToDO Подтяжка ID
            $this->imageFile->saveAs('img/uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        }
            return false;
    }
}