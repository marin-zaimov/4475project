<style>

</style>

<h3 class="page-header">Add a new Project</h3>

<form class="form-horizontal" id="projectForm">
  <div class="control-group">
    <label class="control-label" for="name">Name</label>
    <div class="controls">
      <input type="text" id="name" name="Project[name]" placeholder="Name"/>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="description">Description</label>
    <div class="controls">
      <textarea rows="3" id="description" name="Project[description]" placeholder="Description"/>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="uploadedBy">Uploaded By</label>
    <div class="controls">
      <input type="text" id="uploadedBy" name="Project[uploadedBy]" placeholder="Uploaded By"/>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="images">Zip File of Images</label>
    <div class="controls">
      <div id="uploadLinkField" >
        <a href="#" class="btn" id="uploadNewFile">Upload File</a>
        <label id="uploadedFileLabel" rel=""></label>
        <input type="hidden" value="" name="images" id="imageInput" />
        <div class="for-upload-spinner"></div>
        <i id="removeUploadedFile" class="icon-remove" style="cursor:pointer; display:none;"></i>
      </div>
    </div>
  </div>
  <button class="btn btn-primary" id="saveProject">Save</button>
</form>