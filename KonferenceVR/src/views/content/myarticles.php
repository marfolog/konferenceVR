

<div class="panel panel-users"><div class="panel-users"><h3>Moje příspěvky</h3></div>


<div class="row">
			
    <?php if(isset($this->myArticles) &&  $this->myArticles > 0){
              foreach($this->myArticles as $key => $value){ ?>
                    <div class="box-myarticles text-justify">
                        <div class="title">
                            <div>
                                <span style="float:left; color:#333; font-weight:800;  font-size: 25px;" ><?php echo $value['title']; echo " (id:".$value['id'].")"; ?> </span>
                                <span style="float:right;"><a style="color:blue;" href="index.php?page=myarticles/editArticle/<?php echo $value['id'];?>">Editovat</a>    <a style="color:yellow;" href="index.php?page=myarticles/deleteArticle/<?php echo $value['id'];?>" >Smazat</a></span>
                            </div> 
                            <br><br>
                            <div style=" color:white;  font-size: 15px;" >
                                    <?php if($value['status'] == '0'){
                                            echo "(V recenzním řízení)";
                                        } else if ($value['status'] == '1'){
                                            echo "(Publikováno + bodů: )";
                                        } else {
                                             echo "(Nepřijmuto + bodů: )";
                                        } ?> 
                            </div>
                            <div class='info_myarticles'>Datum:  <?php echo $value['date'] ?></div>
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
        } else echo  "<h3>Nemám žádné příspěvky</h3>";
    ?>
    

</div>