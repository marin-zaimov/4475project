$(function() {

  $('#runAlgorithms').click(runAlgorithms);
});

function runAlgorithms(e) {
   e.preventDefault();
   var projectId = $('#projectId').val();

  $.post('runAlgorithms', {projectId: projectId}, function(result) {
      result = $.parseJSON(result);
    
      if (result.status == true) {
        Message.flash('Algorithms run successfully.', true);
        setTimeout(function() {
          window.location.href = window.location.href;
        },1000);
      }
      else {
        Message.flash('There was an error running the algorithms.', result.status, result.messages);
      }
    }).error(function(request, error, status) {
      Message.alertResult('There was an error running the algorithms.', false);
    });
}