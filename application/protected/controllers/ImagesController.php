<?php

class ImagesController extends Controller
{
  public function actionDownload()
  {
    $imageId = $_GET['imageId'];
    $image = Image::model()->findByPk($imageId);

    $file_extension = strtolower(substr(strrchr($image->filename,"."),1));

    switch( $file_extension ) {
      case "gif": $ctype = "image/gif"; break;
      case "png": $ctype = "image/png"; break;
      case "jpeg":
      case "jpg": $ctype = "image/jpg"; break;
      default: $ctype = 'image/jpg'; break;
    }

    header('Content-Type: image/'.$ctype);
    $url = Yii::app()->params['projectsRoot'] . $image->projectId .'/'. $image->filename;

    echo readfile($url);
    return;
  }

  public function actionDownloadOutput()
  {
    $projectId = $_GET['projectId'];
    $algorithmId = $_GET['algorithmId'];
    $output = Image2Algorithm::model()->findByAttributes(array(
      'projectId'=>$projectId, 'algorithmId'=> $algorithmId
    ));

    //get filename for output
   /* $projectsDir = Yii::app()->params['projectsRoot'];
    $tempPath = $tempDir.$tempFilename;
    $destinationDir = $projectsDir .'/'.$projectId. '/';
    */
    $file_extension = strtolower(substr(strrchr($image->filename,"."),1));

    switch( $file_extension ) {
      case "gif": $ctype = "image/gif"; break;
      case "png": $ctype = "image/png"; break;
      case "jpeg":
      case "jpg": $ctype = "image/jpg"; break;
      default: $ctype = 'image/jpg'; break;
    }

    header('Content-Type: image/'.$ctype);
    $url = Yii::app()->params['projectsRoot'] . $image->projectId .'/'. $image->filename;

    echo readfile($url);
    return;
  }

}