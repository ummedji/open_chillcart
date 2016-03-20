<?php
/**
 * Updown Component
 *
 * PHP version 5
 *
 * @category Helper
 */

App::uses('Component', 'Controller');

class UpdownComponent extends Component
{

    var $components = array('Session');

    function downloadFile($filename, $refName, $path)
    {
        $originalName = $filename;
        $filename = $path . "" . $refName;
        if ($originalName == '')
            $originalName = $filename;
        $file_extension = strtolower(substr(strrchr($filename, "."), 1));
        switch ($file_extension) {
            case "pdf":
                $ctype = "application/pdf";
                break;
            case "xls":
                $ctype = "application/xls";
                break;
            case "zip":
                $ctype = "application/zip";
                break;
            case "doc":
                $ctype = "application/msword";
                break;
            case "docx":
                $ctype = "application/msword";
                break;
            case "xls":
                $ctype = "application/vnd.ms-excel";
                break;
            case "ppt":
                $ctype = "application/vnd.ms-powerpoint";
                break;
            case "gif":
                $ctype = "image/gif";
                break;
            case "png":
                $ctype = "image/png";
                break;
            case "jpe":
            case "jpeg":
            case "jpg":
                $ctype = "image/jpg";
                break;
            default:
                $ctype = "application/force-download";
        }
        if (file_exists($filename)) {
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private", false);
            header("Content-Type: $ctype");
            header("Content-Disposition: attachment; filename=\"" . basename($originalName) . "\";");
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: " . @filesize($filename));
            set_time_limit(0);
            @readfile("$filename") or die("File not found.");
            die;
        } else
            $this->Session->setFlash('File Not Found');
    }

    public function FileOnly($getFileData = array(), $uploadDir)
    {
        //echo "<pre>";
        //print_r($getFileData);
        if (!empty($getFileData)) {
            $getFileName = $getFileData['filename'];
            $fileSource = base64_encode($getFileData['filedata']);
            if (file_exists($uploadDir . $getFileName))
                $getFileName = $this->renameOriginal($getFileName, $uploadDir);

            move_uploaded_file($fileSource, $uploadDir . $getFileName);
            $getExt = $this->seperateFnameAndExt($getFileName);
        }
    }

    public function renameOriginal($fileName, $path)
    {
        //$randNum = rand(1, 9999);
        $microTime = microtime();
        $timeStamp = strstr(microtime(), " ");
        $timeStamp = str_replace(" ", "", $timeStamp);
        $randNum = str_replace('0.', '', substr($microTime, 0, strpos($microTime, ' ')));

        $aFnameDetail = $this->seperateFnameAndExt($fileName);
        $fileRenamed = $this->concat($randNum, $aFnameDetail);

        if (!file_exists($path . DS . $fileRenamed))
            return $fileRenamed;
        $this->renameOriginal($fileName, $path);
    }

    public function seperateFnameAndExt($fName)
    {
        $extention = substr($fName, strrpos($fName, '.'));
        $extLenght = strlen($extention);
        $fnameWithOutExt = substr($fName, 0, -$extLenght);
        return array('fNameWOExt' => $fnameWithOutExt, 'ext' => strtolower($extention));
    }

    public function concat($fileName, $aFnameData)
    {
        return trim($fileName . $aFnameData['ext']);
    }

    public function uploadWithOrgName($fDetail, $path)
    {
        if ($fDetail['name'] != '' && $fDetail['size'] != 0) {
            $fName = $fDetail['name'];
            $fSize = $fDetail['size'];
            $tmpName = $fDetail['tmp_name'];
            if (file_exists($path . $fName))
                $fName = $this->renameOriginal($fName, $path);
            move_uploaded_file($tmpName, $path . $fName);
            $getExt = $this->seperateFnameAndExt($fName);
            $data['refName'] = $fName;
            $data['fName'] = $fName;
            $data['orgName'] = $fDetail['name'];
            $data['fSize'] = $fSize;
            $data['fExt'] = $getExt['ext'];
            return $data;
        } else
            $this->Session->setFlash('Error Uploading');
    }

    /* Get filename and ext */

    public function uploadFile($fDetail, $path)
    {
        $getTimeStamp = "";
        if ($fDetail['name'] != '') {
            $fName = $fDetail['name'];
            $fSize = $fDetail['size'];
            $tmpName = $fDetail['tmp_name'];
            $getTimeStamp = $this->getTimeStampNumber();
            $aFnameDetail = $this->seperateFnameAndExt($fName);

            $refName = $this->concat($getTimeStamp, $aFnameDetail);
            move_uploaded_file($tmpName, $path . DS . $refName);

            $data['refName'] = $refName;
            $data['fName'] = $fName;
            $data['fSize'] = $fSize;
            $data['fExt'] = $aFnameDetail['ext'];
            return $data;
        } else {
            $this->Session->setFlash('Error Uploading');
        }
    }

    public function getTimeStampNumber()
    {
        return $timeStamp = rand() . mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'));
    }

    public function extention($fName)
    {
        return substr($fName, strrpos($fName, '.'));
    }

    function findexts($imageUrl)
    {
        if (!$imageUrl)
            return;
        $what = getimagesize($imageUrl);
        switch ($what['mime']) {
            case 'image/png' :
                return 'png';
                break;
            case 'image/jpeg':
                return 'jpeg';
                break;
            case 'image/gif' :
                return 'gif';
                break;
            default:
                return false;
                break;
        }
    }

    function csvToExcel($csvName, $sourcePath = null, $destPath = null)
    {
        if (!$sourcePath)
            $sourcePath = WWW_ROOT . DS . "files" . DS . "documents" . DS;
        if (!$destPath)
            $destPath = $sourcePath;

        App::import('Vendor', 'PHPExcel', array('file' => 'excel' . DS . 'PHPExcel' . DS . 'IOFactory.php'));

        $objReader = PHPExcel_IOFactory::createReader('CSV')->setDelimiter(';')
            ->setEnclosure('"')
            ->setLineEnding("\r\n")
            ->setSheetIndex(0);
        $srcFile = $sourcePath . $csvName;
        $objPHPExcelFromCSV = $objReader->load($srcFile);
        $objWriter2007 = PHPExcel_IOFactory::createWriter($objPHPExcelFromCSV, 'Excel2007');
        $dfName = $this->getTimeStampNumber();
        $desFile = $destPath . $dfName . ".xlsx";
        $objWriter2007->save($desFile);
        return $dfName . ".xlsx";
    }

    function readExcel($fileName = null, $path = null)
    {
        if (!$fileName)
            return array();
        if (!$path)
            $path = WWW_ROOT . DS . "files" . DS . "documents" . DS;

        App::import('Vendor', 'PHPExcel', array('file' => 'excel' . DS . 'PHPExcel' . DS . 'IOFactory.php'));
        $inputFileName = $path . $fileName;
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
        return $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
    }
}