
    

<div class="row">
    <div class="center">
        <div class="col-xs-16 col-sm-4"></div>
        <div class="col-xs-16 col-sm-4">
               <form action="index.php?page=register/registerUser" method="POST">
                <div align="center"><h1>Registrace</h1></div>
              <div class="form-group">
                <label for="log">Uživatelské jméno:</label>
                <input type="login" name="login" class="form-control" id="log">
              </div>
              <div class="form-group">
                <label for="a">Heslo:</label>
                <input type="password" class="form-control" name="pass1" id="a"  oninput="out.value=(a.value==b.value)?'Hesla jsou stejná':'Hesla jsou různá';">
              </div>
             <div class="form-group">
                <label for="b">Heslo ještě jednou:</label>
                <input type="password" class="form-control" name="pass2" id="b"  oninput="out.value=(a.value==b.value)?'Hesla jsou stejná':'Hesla jsou různá';">
            </div>
            <div class="form-group">
                <output id="output" style=" font-weight: bold; color:blue;" name="out" for=" a b"><?php echo Register_Model::verifyLog()?></output>
            </div>
              <button type="submit" class="btn btn-primary">Registrovat</button>
        </form>
        </div>
        <div class="col-xs-16 col-sm-4"></div>
        <div class="col-xs-16 col-sm-4"></div>
    </div>
</div>