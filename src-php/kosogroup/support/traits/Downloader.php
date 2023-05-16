<?php
namespace kosogroup\support\traits;

use Exception;
use php\io\IOException;
use php\lib\fs;
use php\net\URL;

trait Downloader
{
    protected abstract function __downloaderCallback(string $link, string $filePath, string $fileName, int $fileSize) : callable;

    private function _download(string $link, string $filePath, string $fileName, bool $isRetry = false)
    {
        $url = new URL($link);
        $urlConnection = $url->openConnection();

        $fileSize = $urlConnection->contentLength;

        try
        {
            $filePath = $this->_resolveDir($filePath);
            
            fs::copy(
                $url->openStream(), 
                ($filePath . '/' . $fileName), 
                $this->__downloaderCallback($link, $filePath, $fileName, $fileSize)
            );
        }
        catch(IOException $exception)
        {
            if($isRetry) $this->_download($link, $fileName, $fileName, $isRetry);
        }
    }

    private function _resolveDir($dir)
    {
        if(!fs::exists($dir)) fs::makeDir($dir);
        return fs::abs($dir);
    }



    
}