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

    public function __construct()
    {
        parent::__construct();
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