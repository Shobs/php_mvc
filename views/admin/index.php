<?php
/**
 * Admin page view
 */

echo <<<END
<div class='container'>
  <div id='tabulator-table'></div>
</div>
END;


echo <<<END
<div class="modal" id="addModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="admin/add" method="post" enctype="multipart/form-data" onsubmit="return validate(this, , '#errorMessage'" novalidate>
        <div class="modal-header">
          <h5 class="modal-title">Add a malware</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <label for="inputName" class="sr-only">Name</label>
          <input type="text" name="inputName" id="inputName" class="form-control" placeholder="Name" required autofocus>
          <br/>
          <!-- MAX_FILE_SIZE must precede the file input field -->
          <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
          <label for="inputFile" class="sr-only">Select File</label>
          <input type="file" name="inputFile" class="form-control-file" id="inputFile" aria-describedby="fileHelp">
          <br/>
          <label for="inputComment" class="sr-only">Comment</label>
          <textarea name="inputComment" id="inputComment" class="form-control" placeholder="Comment" rows="5" cols="10"></textarea>
          <p id="errorMessage">$errorMessage</p>
        </div>
        <div class="modal-footer">
          <button id="deleteConfirm" type="submit" class="btn btn-primary">Add</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
END;

echo <<<END
<div class="modal" id="deleteModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="admin/delete" method="post" enctype="multipart/form-data">
      <input type="hidden" name="malwareID" value="">
        <div class="modal-header">
          <h5 class="modal-title">Delete entry?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this definition?</p>
        </div>
        <div class="modal-footer">
          <button id="deleteConfirm" type="submit" class="btn btn-primary">Delete</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
END;

// passing json encoded malware data
echo '<script>';
echo "var dataMalware = $malwares";
echo '</script>';




?>