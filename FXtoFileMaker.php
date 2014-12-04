<?php


/**
 * Creates an array of data from a FileMaker Result object that mimics the FX result array structure.
 *
 * This function assumes that the FileMaker PHP Library has already been required or `use`d.
 *
 * @param \FileMaker\Result FileMaker PHP API Result object
 *
 * @return array Records in FX result structure form
 */
function createMockFXRecordArray($fileMakerResultObject){

    if(FileMaker::isError($fileMakerResultObject)){
        // throw new Exception("The result set is a FileMaker Error Object");
        return null;
    }

    $fields  = $fileMakerResultObject->getFields();
    $records = [];
    foreach($fileMakerResultObject->getRecords() as $record){
        
        $id             = $record->getRecordId();
        $modificationId = $record->getModificationId();
        
        foreach($fields as $field){
            $recordData[$field] = htmlspecialchars_decode($record->getField($field));
        }

        $records["$id.$modificationId"] = $recordData;
    }

    return $records;
}
