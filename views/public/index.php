<?php
    echo <<<_END

    <div id="wrapper-home" class="container d-flex justify-content-center align-content-center align-content-middle">
        <form class="form-user-upload" enctype="multipart/form-data" action="home/upload" method="POST" >
            <div class="form-group">
                <!-- MAX_FILE_SIZE must precede the file input field -->
                <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                <label for="exampleInputFile">Think your file is infected?</label>
                <input type="file" name="fileupload" class="form-control-file" id="user-file-upload" aria-describedby="fileHelp">
                <small id="fileHelp" class="form-text text-muted">**Malware detect does not guarantee a 100% detection rate**</small>
            </div>
            <button type="submit" class="btn btn-primary pull-right">Submit</button>
        </form>
    </div> <!-- /container -->


</label>

_END

?>
