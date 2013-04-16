<?php

class ProjectsController extends Controller
{
  public function actionList()
  {
    $projects = Project::model()->findAll();

    $this->render('list', array('projects'=>$projects));
  }

  public function actionCreate()
  {

    $this->renderPartial('create', array());
  }

  public function actionSave()
  {
    $projectData = $_POST['project'];
    $imagesData = $_POST['images'];
    
  }

  public function actionImagesUpload()
  {
    $response = new AjaxResponse();
    $uploadedFile = FileHelper::getUploadedFile('imagesUpload');
    
    if ($uploadedFile->extension != '.zip')
    {
      $response->setStatus(false, 'File must be a zip.');
      echo $response->asJson();
      return;
    }
    /*if ($uploadedFile->size > 4194304) //4 MB
    {
      $response->setStatus(false, 'File must be smaller than 4 MB.');
      echo $response->asJson();
      return;
    }*/
    
    // @refactor: remove Yii reference here
    $projectsUploadDir = Yii::app()->params['projectsRoot'];
    
    if (!is_dir($projectsUploadDir)) {
      $this->createAllDirsInPath($projectsUploadDir);
    }
    if (!is_writable($projectsUploadDir)) {
      $response->setStatus(false, 'Temporary upload directory is not writable.');
    }
    else {
      var_dump($uploadedFile->temporaryPath);
      var_dump($projectsUploadDir . $uploadedFile->temporaryName);
      die;
      $fileMoved = move_uploaded_file($uploadedFile->temporaryPath, $projectsUploadDir . $uploadedFile->temporaryName);
      if ($fileMoved) {
        $response->setStatus(true, 'File uploaded successfully.');
        
        $responseData = array(
          'tmpName' => $uploadedFile->temporaryName,
          'name' => $uploadedFile->name
        );
        $response->setData($responseData);
      }
      else { 
        $response->setStatus(false, 'Moving uploaded file failed.');
      }
    }
    
    echo $response->asJson();
    return;
  }

  private function createAllDirsInPath($folderpath)
  {
    $foldernames = explode('/', $folderpath);
    $path = '/';
    foreach ($foldernames as $f) {
      if (strlen($f) > 0) {
        $path .= $f.'/';
        if (!is_dir($path)) {
          mkdir($path, 0775);
        }
      }
    }
  }

}
