<?php
class ClassImportadoraCSV 
{
    private $linesDoc = null;
    
    private $docName;
    
    private $imageFileName;
    
    private $fileImport;
    
    public $procesados = 0;
    
    
    
    
    public function __construct( $upload )
    {
        if($upload !== null)
        {
            $this->docName = $upload;
            $this->processDataLoaded();
            $this->deleteDoc();
        }        
    }
    
    private function processDataLoaded()
    {
        try 
        {
            $this->setFileImport();
            
            $this->saveDoc();
            
            $this->setLinesDoc($this->getDataFile());
            
        } 
        catch (Exception $e) 
        {
            return $e->getMessage();
        }
        
    }
    
    
    public function setFileImport($path = null)
    {
        if($path == null)
        {
            $path = Yii::app()->basePath .'/../upload/doc/'. $this->docName;
        }
        
        $this->fileImport = $path;
        
        return $this;
    }
    
    
    public function getDataFile()
    {
        return file_get_contents($this->fileImport);
    }
    
    
    public function setLinesDoc( $dataFile )
    {
        $this->linesDoc = explode(PHP_EOL, $dataFile);
    }
    
    
    public function getLinesDoc()
    {
        return $this->linesDoc;
    }
    
    
    public function getFileImport()
    {
        return $this->fileImport;
    }
    
    
    public function lineToArray($line, $delimiter = ";")
    {
        return str_getcsv($line,$delimiter);
    }
    
    
    private function saveDoc()
    {
        $this->docName->saveAs($this->getFileImport());
    }
    
    
    public function deleteDoc()
    {
        if(file_exists($this->fileImport))
        {
            unlink($this->fileImport);
        }
    }
    
}