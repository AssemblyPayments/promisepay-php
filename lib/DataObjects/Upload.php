<?php
namespace PromisePay\DataObjects;

/**
 * Class Upload
 * @package PromisePay\DataObjects
 */
class Upload extends Object
{
    /**
     * @var
     */
    private $_totalLines;
    /**
     * @var
     */
    private $_processedLines;
    /**
     * @var
     */
    private $_updateLines;
    /**
     * @var
     */
    private $_errorLines;
    /**
     * @var
     */
    private $_progress;

    public function __construct($jsonData = array())
    {
        if(count($jsonData))
        {
            $this->$_totalLines = array_key_exists('total_lines', $jsonData) ? $jsonData['total_lines'] : '';
            $this->$_processedLines = array_key_exists('processed_lines', $jsonData) ? $jsonData['processed_lines'] : '';
            $this->$_updateLines = array_key_exists('update_lines', $jsonData) ? $jsonData['update_lines'] : '';
            $this->$_errorLines = array_key_exists('error_lines', $jsonData) ? $jsonData['error_lines'] : '';
            $this->$_progress = array_key_exists('progress', $jsonData) ? $jsonData['progress'] : '';
        }
        parent::__construct($jsonData);
    }
    /**
     * @return mixed
     */
    public function getErrorLines()
    {
        return $this->_errorLines;
    }

    /**
     * @param mixed $errorLines
     */
    public function setErrorLines($errorLines)
    {
        $this->_errorLines = $errorLines;
    }

    /**
     * @return mixed
     */
    public function getProcessedLines()
    {
        return $this->_processedLines;
    }

    /**
     * @param mixed $processedLines
     */
    public function setProcessedLines($processedLines)
    {
        $this->_processedLines = $processedLines;
    }

    /**
     * @return mixed
     */
    public function getProgress()
    {
        return $this->_progress;
    }

    /**
     * @param mixed $progress
     */
    public function setProgress($progress)
    {
        $this->_progress = $progress;
    }

    /**
     * @return mixed
     */
    public function getTotalLines()
    {
        return $this->_totalLines;
    }

    /**
     * @param mixed $totalLines
     */
    public function setTotalLines($totalLines)
    {
        $this->_totalLines = $totalLines;
    }

    /**
     * @return mixed
     */
    public function getUpdateLines()
    {
        return $this->_updateLines;
    }

    /**
     * @param mixed $updateLines
     */
    public function setUpdateLines($updateLines)
    {
        $this->_updateLines = $updateLines;
    }

}