<style>

</style>

<button class="btn btn-primary" id="newProject">New Project</button>
<div class="row-fluid">
  <div class="span3">
    Name
  </div>
  <div class="span3">
    Date
  </div>
  <div class="span3">
    Description
  </div>
  <div class="span3">
    # Images
  </div>
</div>


<? foreach ($projects as $p): ?>
  <div class="row-fluid">
    <div class="span3">
      <? echo $p->name; ?>
    </div>
    <div class="span3">
      <? echo $p->date; ?>
    </div>
    <div class="span3">
      <? echo $p->description; ?>
    </div>
    <div class="span3">
      <? echo count($p->images); ?>
    </div>
  </div>
<? endforeach; ?>



<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/projectList.js"></script>