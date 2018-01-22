<html>
    <form action="submit.php" method="POST" enctype="multipart/form-data">
        <div class="col-xs-12" style="margin-bottom: 15px">
            <label>Keywords</label>
            <input type="text" name="keywords" id="keywords" placeholder="Write the keywords splitted by ','" style="width: 200px;" required>
        </div>
        <div class="col-xs-12" style="margin-bottom: 15px">
            <input type="file" name="file" id="file" required>
        </div>

        <button type="submit">Submit</button>
    </form>
</html>