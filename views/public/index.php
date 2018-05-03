<?php
    echo <<<_END

    <div class="container d-flex justify-content-center align-content-center">
        <form enctype="multipart/form-data" action="index.php" method="POST" >
            <div class="form-group">
                <!-- MAX_FILE_SIZE must precede the file input field -->
                <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                <label for="exampleInputFile">Select File</label>
                <input type="file" name="fileupload" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
                <small id="fileHelp" class="form-text text-muted">Select a .txt file to be parsed.</small>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div> <!-- /container -->


</label>

_END

?>