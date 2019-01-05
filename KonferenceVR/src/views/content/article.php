            

<?php if(Session::readSession(SS_TYPE_ARTICLE_WEB) =='add') {?>


    <div class="panel panel-users">

    <div class="panel-heading"> <h3>Přidání příspěvku</h3></div> 
    <form class="form-horizontal" action="index.php?page=article/preprocessingArticle"  enctype="multipart/form-data" method="post"  id="article_form">
    <div class="form-group">
      <label class="col-md-4 control-label">Autor:</label>  
      <div class="col-md-4 inputGroupContainer">
      <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <output name="authorOutput"  form="article_form" style="background:#addcea;" class="form-control"  type="text"> <?php
              echo CurrentUser::getNameCurrentUser();
              ?></output>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label">Datum:</label>  
      <div class="col-md-4 inputGroupContainer">
      <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-hourglass"></i></span>
          <output  name="dateOutput" form="article_form" style="background:#addcea;" class="form-control"  type="text">
              <?php
                echo $today = date("j. n. Y");   
              ?></output>
        </div>
      </div>
    </div>


    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label">Titulek příspěvku:</label>  
       <div class="col-md-4 inputGroupContainer">
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-eye-open"></i></span>
            <input name="inputTitle" placeholder="Vlož titulek příspěvku" class="form-control" type="text" value="<?php
                                                                                                                  if(Session::readSession(SS_ARTICLE_LOG) != 'articleSent'){
                                                                                                                      if(Session::readSession(SS_TITLE) != null) {
                                                                                                                          echo Session::readSession(SS_TITLE);
                                                                                                                      }
                                                                                                                  }
                                                                                                                  ?>">
        </div>
      </div>
    </div>

    <!-- Text area -->

    <div class="form-group">
       <label class="col-md-4 control-label">Abstract:</label>
        <div class="col-md-4 inputGroupContainer">
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
            <textarea class="form-control" style="height:250px" name="abstract" placeholder="Vlož abstract"><?php
                                                                                                                  if(Session::readSession(SS_ARTICLE_LOG) != 'articleSent'){
                                                                                                                      if(Session::readSession(SS_ABSTRACT) != null) {
                                                                                                                          echo Session::readSession(SS_ABSTRACT);
                                                                                                                      }
                                                                                                                  }
                                                                                                                  ?></textarea>
      </div>
      </div>
    </div>


    <div class="form-group">
        <label class="col-md-4 control-label">Připojený soubor:</label>
        <div class="col-md-4 inputGroupContainer input-group input-file">
            <span class="input-group-addon"><i class="glyphicon glyphicon-cloud-upload"></i></span>	
            <span class="input-group-btn">
                <input class="btn btn-choose btn-own" id="fileToUpload" name="fileToUpload" type="file">
            </span>


        </div>
    </div

    <!----------------verify---------------------> 
     <div class="form-group">
            <label class="col-md-4 control-label"></label>
            <label class="col-md-4 form-check-label">
                       <?php Article::verifyLog()?>
            </label>
    </div>
    <!-- Button -->
    <div class="form-group">
      <label class="col-md-4 control-label"></label>
      <div class="col-md-4">
        <button type="submit" class="btn btn-own" >Přidat k posouzení <span class="glyphicon glyphicon-upload"></span></button>
      </div>
    </div>

    </form>
    </div>

<?php } else if (Session::readSession(SS_TYPE_ARTICLE_WEB) == 'edit') {
    

     $editArticle = Session::readSession(SS_EDIT_ARTICLE);
     if($editArticle != null &&  count($editArticle) > 0){ ?> 
        

        <div class="panel panel-users">

        <div class="panel-heading"> <h3>Edit příspěvku</h3></div> 
        <form class="form-horizontal" action="index.php?page=article/preprocessingArticle"  enctype="multipart/form-data" method="post"  id="article_form">
        <div class="form-group">
          <label class="col-md-4 control-label">Autor:</label>  
          <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <output name="authorOutput"  form="article_form" style="background:#addcea;" class="form-control"  type="text"> <?php
                  echo CurrentUser::getNameCurrentUser();
                  ?></output>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">Datum:</label>  
          <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-hourglass"></i></span>
              <output  name="dateOutput" form="article_form" style="background:#addcea;" class="form-control"  type="text">
                  <?php
                    echo $today = date("j. n. Y");   
                  ?></output>
            </div>
          </div>
        </div>


        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label">Titulek příspěvku:</label>  
           <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-eye-open"></i></span>
                <input name="inputTitle" placeholder="Vlož titulek příspěvku" class="form-control" type="text" value="<?php
                                                                                                                      if(Session::readSession(SS_ARTICLE_LOG) != 'articleSent'){
                                                                                                                          if(Session::readSession(SS_TITLE) != null) {
                                                                                                                              echo Session::readSession(SS_TITLE);
                                                                                                                          } else {
                                                                                                                              echo $editArticle['title'];
                                                                                                                          }
                                                                                                                      }
                                                                                                                      ?>">
            </div>
          </div>
        </div>

        <!-- Text area -->

        <div class="form-group">
           <label class="col-md-4 control-label">Abstract:</label>
            <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                <textarea class="form-control" style="height:250px" name="abstract" placeholder="Vlož abstract"><?php
                                                                                                                      if(Session::readSession(SS_ARTICLE_LOG) != 'articleSent'){
                                                                                                                          if(Session::readSession(SS_ABSTRACT) != null) {
                                                                                                                              echo Session::readSession(SS_ABSTRACT);
                                                                                                                          }else {
                                                                                                                              echo $editArticle['text'];
                                                                                                                          }
                                                                                                                      }
                                                                                                                      ?></textarea>
          </div>
          </div>
        </div>


        <div class="form-group">
            <label class="col-md-4 control-label" style="color:yellow;">Připojit nový soubor:</label>
            <div class="col-md-4 inputGroupContainer input-group input-file">
                <span class="input-group-addon"><i class="glyphicon glyphicon-cloud-upload"></i></span>	
                <span class="input-group-btn">
                    <input class="btn btn-choose btn-own" id="fileToUpload" name="fileToUpload" type="file">
                </span>


            </div>
        </div

        <!----------------verify---------------------> 
         <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <label class="col-md-4 form-check-label">
                           <?php Article::verifyLog()?>
                </label>
        </div>
        <!-- Button -->
        <div class="form-group">
          <label class="col-md-4 control-label"></label>
          <div class="col-md-4">
            <button type="submit" class="btn btn-own" >Editovat (Přidat k posouzení) <span class="glyphicon glyphicon-upload"></span></button>
          </div>
        </div>

        </form>
        </div>











 <?php    } else {
         echo "Neotevřeli ste stránku správně";
     }
     } ?>