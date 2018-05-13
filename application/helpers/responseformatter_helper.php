<?php
    function formatResponse($data,$error=[]) {
        if ($data === true)
            return ['status'=>true,'data'=>[]];
        if ($data)
            return ['status'=>true,'data'=>$data];
        else
            return ['status'=>false,'error'=>$error];
    }

    function formatDBErrorResponse($dbError) {
        return ['status'=>false,'error'=>$dbError];
    }
    
    function validateRequired($data,$requiredArray) {
        $invalidElements = [];
		foreach ($requiredArray as $requiredElement) {
			if (@$data[$requiredElement]) {
				if ($data[$requiredElement] == "") {
					array_push($invalidElements, $requiredElement);
				}
            } else {
                array_push($invalidElements, $requiredElement);
			}
        }
        if ($invalidElements) {
            return ['status'=>false,'error'=>$invalidElements];
        } else {
            return ['status'=>true,'error'=>''];
        }
	}