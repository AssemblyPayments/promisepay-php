<?php
namespace PromisePay;

use PromisePay\DataObjects\Upload;
use PromisePay\Exception;
use PromisePay\Log;
use Prophecy\Argument;

class UploadRepository extends ApiAbstract
{
    public function getListOfUploads($limit = 20, $offset = 0)
    {
        $this->paramsListCorrect($limit,$offset);
        $response = $this->RestClient('get', 'uploads?limit=' . $limit . '&offset=' . $offset, '', '');
        $allUploads = array();
        $jsonData = json_decode($response->raw_body, true)['uploads'];
        foreach($jsonData as $oneUpload )
        {
            $upload = new Upload($oneUpload);
            array_push($allUploads,  $upload );
        }
        return $allUploads;
    }

    public function getUploadById($id)
    {
        $this->checkIdNotNull($id);

        $response = $this->RestClient('get', 'uploads/' . $id);
        $jsonData = json_decode($response->raw_body, true)['uploads'];
        $upload = new Upload($jsonData);
        return $upload;

    }

    public function createUpload($csvData)
    {
        if($csvData == null || $csvData = ''){
            throw new Exception\Argument('csvData is empty');
        }
        $response  = $this->RestClient('post','/uploads/import/',$csvData);
        $jsonData = json_decode($response->raw_body, true);
        if (array_key_exists("uploads", $jsonData))
        {
            $jsonData = $jsonData['uploads'];
            $upload = new Upload($jsonData);
            return $upload;
        }
        else
        {
            return null;
        }
    }

    public function getStatus($uploadId)
    {
        $this->checkIdNotNull($uploadId);
        $response = $this->RestClient('get', '/uploads/'.$uploadId.'/import');

        $jsonData = json_decode($response->raw_body, true);
        if (array_key_exists("uploads", $jsonData))
        {
            $jsonData = $jsonData["uploads"];
            $uploadStatus = new Upload($jsonData);
            return $uploadStatus;
        }
        return null;
    }

    public function startImport($uploadId)
    {
        $this->checkIdNotNull($uploadId);

        $response = $this->RestClient('patch', 'uploads/'.$uploadId.'/import');

        $jsonData = json_decode($response->raw_body, true);
        if (array_key_exists("uploads", $jsonData))
        {
            $jsonData = $jsonData["uploads"];
            $uploadStatus = new Upload($jsonData);
            return $uploadStatus;
        }
    return null;
    }
}