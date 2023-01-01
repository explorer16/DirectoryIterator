<?php

namespace Classs;

class MyIterator implements \Iterator
{
    private $rows;
    private $position;
    public function __construct($filename)
    {
        $path='tables/'.$filename;
        if(!file_exists($path)){
            echo $path."\n";
            die('error 404');
        }
        $rows=file_get_contents($path);
        //$rows=mb_convert_encoding($rows, 'UTF-8',mb_detect_encoding($rows,['cp1251','UTF-8']));
        $rows=explode("\n",$rows);
        foreach ($rows as $value){
            $value=str_getcsv($value);
            $value=$value[0];
            $this->rows[]=explode(';',$value);
        }

    }
    public function rewind()
    {
        $this->position=1;
    }
    public function valid():bool
    {
        return isset($this->rows[$this->position]);
    }
    public function key()
    {
        return $this->position;
    }
    public function current()
    {
        return $this->rows[$this->position];
    }
    public function next()
    {
        ++$this->position;
    }



}