


    
<!--<div id="loginMenu">
    <form action="index.php?page=login/loginUser " method="POST">
        <label>Uživatelské jméno: </label><input type="text" name="login"/><br>
        <label>Heslo: </label><input type="password" name="password" /><br>
        <label></label><input type="submit" value="Přihlásit"/>
    </form>
    
    <div><?//php Login_Model::verifyLog() ?></div>
</div>  -->



<div class="starter-template">
        <div class="col-xs-16 col-sm-4"></div>
        <div class="col-xs-16 col-sm-4">
               <form action="index.php?page=login/loginUser " method="POST">
                   <div align="center"><h1>Přihlášení</h1></div>
              <div class="form-group">
                <label for="log">Uživatelské jméno:</label>
                <input type="login" name="login" class="form-control" id="log">
              </div>
              <div class="form-group">
                <label for="pwd">Heslo:</label>
                <input type="password"  name="password" class="form-control" id="pwd">
              </div>
              <div class="form-group form-check">
                <label class="form-check-label" style="color:red;">
                   <?php Login_Model::verifyLog() ?>
                </label>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
        <div class="col-xs-16 col-sm-4"></div>
        <div class="col-xs-16 col-sm-4"></div>
</div>

