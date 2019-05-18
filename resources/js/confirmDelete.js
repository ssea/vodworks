/**
 * Toggle Confirm Delete action
 */
const deleteBtn = $('.delete-btn');
if (deleteBtn.length) {
  $(deleteBtn).click((event) => {

    $('#frmConfirmDelete').attr('action', $(event.currentTarget).attr('href'));

    $('#delete-modal').modal();
  });
}
