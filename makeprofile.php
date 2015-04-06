<head>
    <script LANGUAGE="JavaScript"> 
    </script>
</head>
<body>
    <form name="myform" action="imageupload.php" method="post" style="width:600px;" onsubmit="" enctype="multipart/form-data">
       <b>userid*: </b>&nbsp&nbsp&nbsp<input name="userid" type="text" style="width:440;" ><br><br>
       <b>gender: </b>&nbsp&nbsp&nbsp<select name="gender" type="text" emptyOption=true>
        <option value="male" selected=true>MALE</option>
        <option value="female" >FEMALE</option> </select><br><br>
       <b>addresss: </b>&nbsp<input name="address" type="text" style="width:440;" ><br><br>
       <b>phone: </b>&nbsp&nbsp&nbsp&nbsp&nbsp<input name="phone" type="text" style="width:440;" ><br><br>
       <b>email: </b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input name="email" type="text" style="width:440;" ><br><br>
       <b>autograph:</b><br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<textarea name="autograph" rows=10 cols=60 > input autograph here</textarea><br>
        <b>Select image to upload:</b><input type="file" name="image" id="image">
        <input type="reset" value="clear">
        <input type="submit" value="submit">
    </form>
</body>