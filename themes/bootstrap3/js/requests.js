function confirmCancelRequest(link, action) {
  $('#cancelConfirm').val(1);
  $('#submitType').attr('name', action);
  $(link).parents('form').trigger("submit");
}

$(function setupRequests() {
  $('#confirm_cancel_selected_yes').on("click", function cancelSelectedRequests(e) {
    e.preventDefault();
    confirmCancelRequest(this, 'cancelSelected');
  });
  $('#confirm_cancel_all_yes').on("click", function cancelAllRequests(e) {
    e.preventDefault();
    confirmCancelRequest(this, 'cancelAll');
  });
  $('.confirm_cancel_no').on("click", function doNotCancelRequest(e) {
    e.preventDefault();
  });
  $('#update_selected').on("click", function updateSelected() {
    // Change submitType to indicate that this is not a cancel request:
    $('#submitType').attr('name', 'updateSelected');
  });

  var checkCheckboxes = function CheckCheckboxes() {
    var checkedCheckedout = $('form[name="updateForm"] .result .checkbox input[type=checkbox]:checked');
    var checkedRenewals = $('form[name="renewals"] .result .checkbox input[type=checkbox]:checked');
    if (checkedCheckedout.length > 0) {
      $('#update_selected').removeAttr('disabled');
      $('#cancelSelected').removeAttr('disabled');
    } else {
      $('#update_selected').attr('disabled', 'disabled');
      $('#cancelSelected').attr('disabled', 'disabled');
    }
    if (checkedRenewals.length > 0) {
      $('#renewSelected').removeAttr('disabled');
    } else {
      $('#renewSelected').attr('disabled', 'disabled');
    }
  };
  $('form[name="updateForm"] .result .checkbox input[type=checkbox]').on('change', checkCheckboxes);
  $('form[name="renewals"] .result .checkbox input[type=checkbox]').on('change', checkCheckboxes);
  $('#update_selected').removeClass('hidden');
  checkCheckboxes();
});
