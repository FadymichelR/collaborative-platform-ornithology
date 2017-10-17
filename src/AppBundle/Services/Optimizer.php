<?php

use AppBundle\Entity\Observation;

namespace AppBundle\Services;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Tinypng\Bundle\EventListener;

class Optimizer
{
    public function optimize($observation)
    {
        $dir = '%kernel.project_dir%/web/uploads/images/';
		$image = $observation->getImage()->getImage();
		\Tinify\setKey("YN-tD6vaVHxYTx8XcfBLKFrlzXwwxgLi");
		$source = \Tinify\fromFile($dir.$image);
		$source->toFile($dir."/optimized/".$image);
		// $source->store(array(http://assets.fhuszti.tech/nao/observations/observations-bg-mobile.jpg
		// 	"service" => "s3",
		// 	"aws_access_key_id" => "AKIAIRMWF4FAADUDYH6Q",
		// 	"aws_secret_access_key" => "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",
		// 	"region" => "us-west-1",
		// 	"path" => "fhuszti.com/nao/optimized/".$image
		// ));
		unlink('%kernel.project_dir%/web/uploads/images/'.$image ) ; 
    }
}
