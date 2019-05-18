<!-- Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this record?
      </div>
      <div class="modal-footer">
          {!! Form::open([
              'method' => 'DELETE',
              'id' => 'frmConfirmDelete',
              'class' => 'form hidden'
          ]) !!}
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              {!! Form::submit( 'Delete', ['class' => 'btn btn-danger'] ) !!}
          {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>