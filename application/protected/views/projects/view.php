<style>
  .image_info {
    border: 1px solid #AAA;
    padding: 10px;
  }
  .image_info img{
    border: 1px solid #EEE;
  }
</style>

<div class="view_container">
  <h3 class="form-header">Project Info</h3>

  <form class="project_info form-horizontal">
    <input type="hidden" name="Project[id]">
    <div class="row-fluid">
      <div class="span6">
        <div class="control-group">
          <label class="control-label" for="nameField">Name</label>
          <div class="controls">
            <input type="text" id="nameField" value="<? echo $project->name; ?>" name="Project[name]" placeholder="Name">
          </div>
        </div>
      </div>
      <div class="span6">
        <div class="control-group">
          <label class="control-label" for="descField">Description</label>
          <div class="controls">
            <input type="text" id="descField" value="<? echo $project->description; ?>" name="Project[decription]" placeholder="Description">
          </div>
        </div>
      </div>
    </div>

  </form>

  <hr/>
  <h3 class="form-header">Algorithms</h3>

  <div class="algorithm_info row-fluid">
    <? $images = $project->images; ?>
    <div class="span3">
      <? for ($i = 0; $i < count($images); $i+=3): ?>
      <div class="image_info">
        <img style="margin: auto;"
            src="<? echo Yii::app()->request->baseUrl; ?>/index.php/images/download?imageId=<? echo $images[$i]->id; ?>" alt="<? echo $images[$i]->filename; ?>">        
      </div>  
      <? endfor; ?>
    </div>
    <div class="span3">
      <? for ($i = 1; $i < count($images); $i+=3): ?>
      <div class="image_info">
        <img style="margin: auto;"
            src="<? echo Yii::app()->request->baseUrl; ?>/index.php/images/download?imageId=<? echo $images[$i]->id; ?>" alt="<? echo $images[$i]->filename; ?>">        
      </div>  
      <? endfor; ?>
    </div>
    <div class="span3">
      <? for ($i = 2; $i < count($images); $i+=3): ?>
      <div class="image_info">
        <img style="margin: auto;"
            src="<? echo Yii::app()->request->baseUrl; ?>/index.php/images/download?imageId=<? echo $images[$i]->id; ?>" alt="<? echo $images[$i]->filename; ?>">        
      </div>  
      <? endfor; ?>
    </div>
    <div class="span3">
      <? for ($i = 3; $i < count($images); $i+=3): ?>
      <div class="image_info">
        <img style="margin: auto;"
            src="<? echo Yii::app()->request->baseUrl; ?>/index.php/images/download?imageId=<? echo $images[$i]->id; ?>" alt="<? echo $images[$i]->filename; ?>">        
      </div>  
      <? endfor; ?>
    </div>
    
    
  </div>

  <hr/>
  <h3 class="form-header">Images</h3>
  <div class="images_info">

  </div>
</div>