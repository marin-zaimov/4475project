<style>
  .image_info img {
    height: 150px;
    border: 1px solid #EEE;
    margin-left: auto;
    margin-right: auto;
  }
  .project_row {
    padding-top: 10px;
    padding-bottom: 10px;
    border-top: 1px solid #EEE;
  }
  .projects_container :hover {
    cursor:pointer;
    background-color: #EEE;
  }
</style>

<button class="btn btn-primary pull-right" id="newProject">New Project</button>

<h3 class="form-header">Projects List</h3>


<div class="projects_container">

<? foreach ($projects as $p): ?>
  <div class="row-fluid project_row" id="<? echo $p->id; ?>">
    <div class="span4 image_info">
      <img style="margin: auto;"
        src="<? echo Yii::app()->request->baseUrl; ?>/index.php/images/download?imageId=<? echo $p->coverImages[0]->id; ?>"
        alt="<? echo $p->coverImages[0]->filename; ?>">
    </div>
    <div class="span4">
      <b>Name: </b>&nbsp<? echo $p->name; ?>
      <br/>
      <br/>
      <b>Date: </b>&nbsp<? echo date('m-d-Y', strtotime($p->date)); ?>
    </div>
    <div class="span4">
      <b># images: </b>&nbsp <? echo count($p->images); ?>
      <br/>
      <br/>

      <b>Description: </b>&nbsp<? echo $p->description; ?>
    </div>
  </div>
<? endforeach; ?>

</div>



<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/projectList.js"></script>