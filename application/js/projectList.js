
var spinnerVar;
var uploadNewLink, newUploadedLabel, removeNewUploaded;

$(function() {

  $('#newProject').click(newProject);
  $('.project_row').click(viewProject);  
});

function newProject() {
  $.post('create', {}, function(result) {
    
    Message.popup(result);
    initCreatePage();

  });
}

function initCreatePage() {
  initAjaxUpload($('#uploadNewFile'));
  var newFileField = $('#uploadLinkField');
    
  uploadNewLink = newFileField.find('#uploadNewFile');
  newUploadedLabel = newFileField.find('#uploadedFileLabel');
  removeNewUploaded = newFileField.find('#removeUploadedFile');

  $('#projectForm').on('click', '#saveProject', onSaveProjectClick);
}


function initAjaxUpload(link) {

  new AjaxUpload($(link), {
    action: 'imagesUpload',
    name: 'imagesUpload',
    onSubmit: function(file, ext) {
      spinnerVar = UIHelper.smallSpinner({left: 30});
      $(link).parent().find('.for-upload-spinner').append(spinnerVar.el);
    },
    onComplete: function(file, response) {

      spinnerVar.stop();
      delete spinnerVar;

      response = $.parseJSON(response);

      if (response.status == true) {
        addUploadedFileReference(response.data);
      }
      else {
        Message.flash('Something went wrong during the upload.', false, response.messages);
      } 
    }
  });
}

function addUploadedFileReference(data) {

  uploadNewLink.hide();
  newUploadedLabel.text(data.name);
  newUploadedLabel.attr('rel', data.tmpName);
  removeNewUploaded.show();
  $('#imageInput').val(data.tmpName);
  $('#audioForm').on('click', '#removeUploadedFile', onRemoveUploadedFileClick);

}

function onRemoveUploadedFileClick() {

  uploadNewLink.show();
  newUploadedLabel.text('');
  newUploadedLabel.attr('rel', '');
  removeNewUploaded.hide();
  $('#imageInput').val('');

}
function onSaveProjectClick(e) {
  e.preventDefault();
  var data = $('#projectForm').serialize();

  $.post('save', data, function(result) {
      result = $.parseJSON(result);
    
      if (result.status == true) {
        Message.flash('Project saved successfully.', true);
        Message.popupClose();
      }
      else {
        Message.flash('There was an error saving the project.', result.status, result.messages);
      }
    }).error(function(request, error, status) {
      Message.alertResult('There was an error saving the project.', false);
    });
}

function viewProject() {
  var projectId = $(this).attr('id');
  window.location.href = $('#baseUrl').val() + '/index.php/projects/view?projectId=' + projectId;
  
}