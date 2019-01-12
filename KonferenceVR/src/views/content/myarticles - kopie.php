
<div class="panel panel-users"><div class="panel-users"><h3>Moje příspěvky</h3></div>


<div class="row">
			
    <?php if(isset($this->myArticles) &&  count($this->myArticles) > 0){
              foreach($this->myArticles as $key => $value){ ?>
                    <div class="box-myarticles text-justify">
                        <div class="title">
                            <div>
                                <span style="float:left; color:#333; font-weight:800;  font-size: 25px;" ><?php echo $value['title']; ?> </span>
                                <span style="float:right;"><a style="color:blue;" href="index.php?page=3/edit/<?php echo $value['id'];?>">Editovat</a>    <a style="color:yellow;" href="index.php?page=6/deleteArticle/<?php echo $value['id'];?>" >Smazat</a></span>
                            </div> 
                            <br><br>
                            <div style=" color:white;  font-size: 15px;" >
                                    <?php if($value['status'] == '0'){
                                            echo "(Recenzní řízení)";
                                        } else if ($value['status'] == '1'){
                                            echo "(Publikováno)";
                                        } else {
                                             echo "(Nepřijmuto)";
                                        } ?> 
                            </div>
                            <div class='info_myarticles'>Datum:  <?php echo $value['date'] ?></div>
                            <div class='info_myarticles'>Autor:  <?php echo $value['author'] ?></div> 
                            <?php if($value['path_to_file'] != 'nothing' ){ ?>
                                <div class='info_myarticles'>Stáhnout přiložený soubor:  <a style="font-size: 20; color:red;" class="glyphicon glyphicon-open-file" href="<?php echo $value['path_to_file'] ?>"></a></div>
                           <?php }?>
                            <hr style="border-top: 1px solid black; background: transparent;">
                            
                        </div>
                        
                        <div class="box-myarticles" >
                            <p><?php echo $value['text'] ?></p>
                        </div>

                    </div>
   <?php           }
        } else echo  "<h3>Nemám žádné příspěvky</h3>";
    ?>
    

</div>

</div>
    
    