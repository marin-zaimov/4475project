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
    $projectData = $_POST['Project'];
    $imagesData = $_POST['images'];
    $response = new AjaxResponse();

    try {
      $transaction = Yii::app()->db->beginTransaction();

      $projectData['date'] = date('Y-m-d H:i:s', time());
      $project = Project::createFromArray($projectData);
      Project::store($project);

      $this->createProjectImages($project->id, $imagesData);

      $transaction->commit();
      $response->setStatus(true, 'Saved successfully.');
    }
    catch (ValidationException $vex) {
      $response->setStatus(false, $vex->getErrors());
      $transaction->rollback();
    }
    catch (Exception $ex) {
      $response->setStatus(false, 'Save was unsuccessfull. '.$ex->getMessage());
      $transaction->rollback();
    }
    echo $response->asJson();
    
  }

  private function createProjectImages($projectId, $tempFilename)
  {
    $tempDir = Yii::app()->params['projectsTempRoot'];
    $projectsDir = Yii::app()->params['projectsRoot'];
    $tempPath = $tempDir.$tempFilename;
    $destinationDir = $projectsDir .'/'.$projectId. '/';

    if (!is_dir($destinationDir)) {
      $this->createAllDirsInPath($destinationDir);
    }

    $zip = new ZipArchive;
    if ($zip->open($tempPath) === true) {
      $zip->extractTo($destinationDir);
      $zip->close();

      $allFiles = scandir($destinationDir);
      if (!empty($allFiles)) {
        $order = 0;
        foreach ($allFiles as $filename) {
          if (!empty($filename) && $filename != '.' && $filename != '..') {
            $imageData = array(
              'projectId' => $projectId,
              'order' => $order,
              'filename' => $filename,
              'cover' => ($order == 0) ? 'Y' : 'N',

            );
            $image = Image::createFromArray($imageData);
            Image::store($image);
            $order++;
          }
        }
      }
      return true;
    } else {
      throw new Exception('extracting files from zip failed.');
    }
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
    $projectsUploadDir = Yii::app()->params['projectsTempRoot'];
    
    if (!is_dir($projectsUploadDir)) {
      $this->createAllDirsInPath($projectsUploadDir);
    }
    if (!is_writable($projectsUploadDir)) {
      $response->setStatus(false, 'Temporary upload directory is not writable.');
    }
    else {

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

  public function actionView()
  {
    $projectId = $_GET['projectId'];
    $project = Project::model()->findByPk($projectId);

    $algorithms = Algorithm::model()->findAll();
    $this->render('view', array('project' => $project, 'algorithms' => $algorithms));

  }

  public function actionRunAlgorithms()
  {
    $response = new AjaxResponse();
    $projectId = $_POST['projectId'];
    $project = Project::model()->findByPk($projectId);

    //$algorithms = Algorthim::mode()->findAll();

    $projectDir = Yii::app()->params['projectsRoot'].'/'.$projectId .'/';
    $algorithmDir = $projectDir . 'algorithms/';
    $algorithmHere = Yii::app()->params['algorithmsRoot'].'MainClass.class';

    // $allImages = scandir($projectDir);
    // $commands = array();
    // for ($i=0; $i<=5; $i++) {
    //   $c = 'java '.$algorithmHere .' nocam 0 '.$allImages[0].
    // }*/


    $command = 'java /data/4475/algorithms/MainClass.class nocam 0 /data/4475/algorithms/test/000.jpg';
    $command .= ' /data/4475/algorithms/test/000.jpg';
    $command .= ' /data/4475/algorithms/test/001.jpg';
    $command .= ' /data/4475/algorithms/test/002.jpg';
    $command .= ' /data/4475/algorithms/test/003.jpg';
    $command .= ' /data/4475/algorithms/test/004.jpg';
    $command .= ' /data/4475/algorithms/test/005.jpg';
    $command .= ' /data/4475/algorithms/test/006.jpg';
    $command .= ' /data/4475/algorithms/test/007.jpg';
    $command .= ' /data/4475/algorithms/test/008.jpg';
    $command .= ' /data/4475/algorithms/test/009.jpg';
    $command .= ' /data/4475/algorithms/test/010.jpg';
    $command .= ' /data/4475/algorithms/test/011.jpg';
    $command .= ' /data/4475/algorithms/test/012.jpg';
    $command .= ' /data/4475/algorithms/test/013.jpg';
    $command .= ' /data/4475/algorithms/test/014.jpg';

    //run algorthims here:
    //$output = shell_exec('ssh-add /home/marin/.ssh/marin.pem');
    $output = shell_exec($command);
    var_dump($command);
    die;

    if (true) {
      $response->setStatus(true, 'Algorithms run successfully');
    }
    else { 
      $response->setStatus(false, 'Moving uploaded file failed.');
    }
    echo $response->asJson();
  }

}
