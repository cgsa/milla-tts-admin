<?php
class ClassUploadFile
{
    public $filename;
    
    public $uploadFile;
    
    private $folder;
    
    
    
    public function __construct(&$model, $fileName, $nameFolder = "img")
    {
        $this->uploadFile = CUploadedFile::getInstance($model,$fileName);
        $this->setPathFolder($nameFolder);
        if(!empty($this->uploadFile))
        {            
            $this->setFileName();
        }
        else
        {
            $this->setFileName($model->logo);
        }
        
    }
    
    
    public function saveFile( $opt = 1, $fileOld = null )
    {
        switch ($opt)
        {
            case 0:
                $this->deleteFile($fileOld);
            case 1:
                if(!empty($this->uploadFile))
                {
                    $this->uploadFile->saveAs($this->folder.'/'.$this->filename);
                }                
            break;
        }
        
    }     
    
    
    public function setFileName($file = null)
    {
        $this->filename = ($file != null)? $file : "{$this->getCodeFile()}-{$this->uploadFile}";
        return $this;
    }
    
    
    public function getCodeFile()
    {
        return rand(0,999999);
    }
    
    public function setPathFolder($nameFolder)
    {
        $this->folder = Yii::app()->basePath .'/../upload/'.$nameFolder;
        
        return $this;
    }
    
    public function getPathFoleder()
    {
        return $this->folder;
    }
    
    
    public function deleteFile($filename = null)
    {
        $file = ($filename != null)? $filename : $this->filename;
        $folderFile = $this->folder.'/'.$file;
        if(file_exists($folderFile))
        {
            unlink($folderFile);
        }
    }
}