<?php
class Files {
    public $dir;
    public $files;
    public $files_names;
    public $size;
    public $file_Number;
    
    function __construct()
    {
        $this->dir = "./data/files/";
        $this->files = $this->scanDirectory($this->dir);
        $this->files_names = array();
        foreach ($this->files as $v) {
            array_push($this->files_names, substr($v, strlen($this->dir)+1));
        }
        $this->size = $this->getSize();
        $this->file_Number = count($this->files);
        //TODO : Config Entity
    }

    function getSize()
    {
        $size = 0;
        foreach ($this->files as $k => $f) {
            $size += filesize($f);
        }
        return $size;
    }
    function getUpdateAdded()
    {
        if(file_exists('content.json'))
            $json = json_decode(file_get_contents('content.json'), true);
        else
            $json = array('downloads' => array());
        $f = array();
        foreach($json['downloads'] as $v)
        {
            array_push($f, $v['path']);
        }
        return array_diff($this->files_names, $f);
    }
    function getUpdateRemoved()
    {
        if(file_exists('content.json'))
            $json = json_decode(file_get_contents('content.json'), true);
        else
            $json = array('downloads' => array());
        $f = array();
        foreach($json['downloads'] as $v)
        {
            if(!in_array($v['path'], $this->files_names))
                array_push($f, $v['path']);
        }
        return $f;
    }
    function getUpdateEdited()
    {
        if(file_exists('content.json'))
            $json = json_decode(file_get_contents('content.json'), true);
        else
            $json = array('downloads' => array());
        $f = array();
        foreach($json['downloads'] as $v)
        {
            if(file_exists($this->dir.$v['path']))
            {
                if(sha1_file($this->dir.$v['path']) != $v['sha1'])
                    array_push($f, $v['path']);
            }
        }
        return $f;
    }
    function getProperSize()
    {
        return round($this->size/1024/1024,2);
    }
    function scanDirectory($d, $files = array())
    {
        foreach (array_diff(scandir($d), array('.', '..')) as $value) {
            $f = $d."/".$value;
            if(is_dir($f))
            {
                $temp = $this->scanDirectory($f);
                foreach ($temp as $tempValue) {
                    array_push($files, $tempValue);
                }
            }
            else
            {
                array_push($files, $f);
            }
        }
        return $files;
    }
    function parseContent()
    {
        $FILE_DIR = $this->dir;
        $dir = scandir($FILE_DIR);
        $files = array();
    
        $config = json_decode(file_get_contents('protected/config.json'), true);

        $files = $this->files;
        $download = array();
        $totalSize = 0;
        $totalFiles = 0;
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]".substr($_SERVER['REQUEST_URI'], 0, -11);
        foreach ($files as $k => $v) {
            $totalSize += filesize($v);
            $totalFiles++;
            $temp = array(
                'path' => substr($v, strlen($this->dir)+1),
                'sha1' => sha1_file($v),
                'size' => filesize($v),
                'url' => str_replace(' ', "%20", $actual_link.substr($v, 1)),
                'name' => basename($v)
            );
            array_push($download, $temp);
        }
        $modpack = array(
            'name' => $config['server']['name'],
            'totalSize' => $totalSize,
            'totalFiles' => $totalFiles
        );
        $conf = array(
            'modpack' => $modpack,
            'downloads' => $download
        );
        
        file_put_contents('content.json', json_encode($conf, JSON_PRETTY_PRINT));
    }

}