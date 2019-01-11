
<div class="panel panel-users"><div class="panel-users"><h3>Publikované příspěvky</h3></div>


<div class="row">
			
    <?php if(isset($this->publicArticle) &&  count($this->publicArticle) > 0){
              foreach($this->publicArticle as $key => $value){ ?>
                    <div class="box-myarticles text-justify">
                        <div class="title">
                            <div>
                                <span style="float:left; color:#333; font-weight:800;  font-size: 25px;" ><?php echo $value['title'];?> </span>
                            </div> 
                            <br><br>
                            <div class='info_myarticles'>Napsáno:  <?php echo $value['date'] ?></div>
                            <div class='info_myarticles'>Autor:  <?php echo $value['author'] ?></div> 
                            <?php if($value['path_to_file'] != 'nothing' ){ ?>
                                <div class='info_myarticles'>Stáhnout přiložený soubor:  <a style="font-size: 20; color:red;" class="glyphicon glyphicon-open-file" href="<?php echo $value['path_to_file'] ?>"></a></div>
                           <?php }?>
                            <hr style="border-top: 1px solid black; background: transparent;">
                            
                        </div>
                        
                        <div class="text text_myrticles" >
                            <span><?php echo $value['text'] ?></span>
                        </div>

                    </div>
   <?php           }
        } else echo  "<div class='panel-heading'> <h5>Žádné příspěvky</h5></div>";
    ?>
    

</div>

</div>
    
    