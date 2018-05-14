<?php
    echo <<<_END

    <div id="wrapper-home" class="container d-flex justify-content-center align-content-center align-content-middle">
        <form class="form-user-upload" enctype="multipart/form-data" action="home/upload" method="POST" >
            <div class="form-group">
                <!-- MAX_FILE_SIZE must precede the file input field -->
                <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                <label for="inputFile">Think your file is infected?</label>
                <input type="file" name="inputFile" class="form-control-file" id="inputFileHome" aria-describedby="fileHelp">
                <small id="fileHelp" class="form-text text-muted">**Malware detect does not guarantee a 100% detection rate**</small>

            </div>

        </form>
    </div> <!-- /container -->
    <div class="container">$errorMessage</div>


</label>

_END

?>
