
var spinnerVar;
var uploadNewLink, newUploadedLabel, removeNewUploaded;

$(function() {

  $('#newProject').click(newProject);
  
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
  $('#audioForm').on('click', '#removeUploadedFile', onRemoveUploadedFileClick);

}

function onRemoveUploadedFileClick() {

  uploadNewLink.show();
  newUploadedLabel.text('');
  newUploadedLabel.attr('rel', '');
  removeNewUploaded.hide();

}
function onSaveProjectClick() {
  alert('haha');
}