


    


<div class="panel panel-users">
  <!-- Default panel contents -->
    <div class="panel-heading"> <h3>Správa příspěvků</h3></div>
 <?php if(isset($this->articles) &&  $this->articles > 0){ ?>
    <!-- Table -->
     <table class="table table-users">
       <thead class="table-header">
        <tr>
            <th class='customers-td' style="text-align:center;  vertical-align: inherit;" rowspan="2" >
                #
            </th>
            <th class='customers-td' style="text-align:center;  vertical-align: inherit; " rowspan="2">
                Název
            </th>
            <th class='customers-td' style="text-align:center;  vertical-align: inherit; "rowspan="2">
                Autor
            </th>
            <th class='customers-td' style="text-align:center;  vertical-align: inherit; "colspan="7" >
                Recenze
            </th>
            <th class='customers-td' style="text-align:center;  vertical-align: inherit;"rowspan="2" colspan="1">
                Rozhodnutí
            </th>
             
            
        </tr>
        <tr> 
            <th class='customers-td' colspan="2" >Recenzent</th>
            <th class='customers-td' >téma.</th>
            <th class='customers-td' >zprac.</th>
            <th class='customers-td' >jaz.</th>
            <th class='customers-td' >dop.</th>
            <th class='customers-td'>celk.</th>
        </tr>
    </thead>
       
       <?php  
            foreach($this->articles as $key => $value){ ?>
                <form action="index.php?page=8/addReviewer/<?php echo $value['id']; ?>" method="post" id="form_review" enctype="multipart/form-data" >
                    <tr>
                        <td class='customers-td' style="vertical-align: inherit;" rowspan=3> <?php echo $value['id'] ?></td>
                        <td class='customers-td' style="vertical-align: inherit;" rowspan=3> <?php echo $value['title'] ?></td>
                        <td class='customers-td' style="vertical-align: inherit;" rowspan=3> <?php echo $value['author'] ?></td>
                        <td class='customers-td' >
                                <select name='select_reviwer_1' id='select_reviwer_1' class='form-control select_in_table'>
                                  <?php echo ServiceArticles_Model::getAllRecenzentForSlect($value['id'], 0); ?>
                                </select> 
                        </td>
                        <?php if(ServiceArticles_Model::inReview($value['id']) == false) { ?>
                        <td class='customers-td edit-a' style="vertical-align: inherit;" rowspan=3 >
                                <button style="background-color: Transparent; border: none;" type="submit">
                                    Přiřadit k recenzi 
                                </button>
                            <?php  } else { 
                                        echo "<td class='customers-td' style='vertical-align: inherit;' rowspan=3 >";
                                        echo "<div style='color:yellow'>Přiřazeno k recenzi</div>";
                                    } ?>
                            
                            <?php  ServiceArticles::verifyLog($value['id'])?>
                            
                        </td>
                        <?php switch(ServiceArticles_Model::haveArticleReview($value['id'], 0)){ 
                            case "yet_havent" : echo "<td class='customers-td' colspan='5' style='vertical-align:inherit;' >Ještě nebylo posouzeno</td>";
                                  break;
                              case "have": ?>
                                        <td class='customers-td' style="vertical-align: inherit;" ><?php echo ServiceArticles_Model::getPointArticleReview($value['id'], 0, 1) ?></td>
                                        <td class='customers-td' style="vertical-align: inherit;" ><?php echo ServiceArticles_Model::getPointArticleReview($value['id'], 0, 2) ?></td>
                                        <td class='customers-td' style="vertical-align: inherit;"><?php echo ServiceArticles_Model::getPointArticleReview($value['id'], 0, 3) ?> </td>
                                        <td class='customers-td' style="vertical-align: inherit;"><?php echo ServiceArticles_Model::getPointArticleReview($value['id'], 0, 4) ?></td>
                                        <td class='customers-td' style="color:#2eff2b; font-weight:800; vertical-align: inherit;" ><?php echo ServiceArticles_Model::getPointArticleReview($value['id'], 0, 5) ?></td> 
                              <?php break; 
                            case "havent_reviewer": echo "<td class='customers-td' colspan='5' style='vertical-align: inherit;' >Nebude posuzovat</td>";
                                  break;
                                }?>
                          

                        <td class='customers-td edit-a' style="vertical-align: inherit;" rowspan=3 >
                            <a href="index.php?page=8/publicArticle/<?php echo $value['id']; ?>" class='edit-a' style="color:yellow;">Publikovat</a>
                            <br>
                            <a href="index.php?page=8/declineArticle/<?php echo $value['id']; ?>" class='edit-a'style="color:red;" >Zamítnout</a>
                        </td>
                        
                    </tr>
                    <tr>
                        <td class='customers-td' >
                            <select name='select_reviwer_2' id='select_reviwer_2' class='form-control select_in_table'>
                                  <?php echo ServiceArticles_Model::getAllRecenzentForSlect($value['id'], 1); ?>
                            </select> 
                        </td>
                        
                         <?php switch(ServiceArticles_Model::haveArticleReview($value['id'], 1)){ 
                            case "yet_havent" : echo "<td class='customers-td' colspan='5' style='vertical-align: inherit;' >Ještě nebylo posouzeno</td>";
                                  break;
                              case "have": ?>
                                        <td class='customers-td' style="vertical-align: inherit;" ><?php echo ServiceArticles_Model::getPointArticleReview($value['id'], 1, 1) ?></td>
                                        <td class='customers-td' style="vertical-align: inherit;" ><?php echo ServiceArticles_Model::getPointArticleReview($value['id'], 1, 2) ?></td>
                                        <td class='customers-td' style="vertical-align: inherit;" ><?php echo ServiceArticles_Model::getPointArticleReview($value['id'], 1, 3) ?> </td>
                                        <td class='customers-td' style="vertical-align: inherit;" ><?php echo ServiceArticles_Model::getPointArticleReview($value['id'], 1, 4) ?></td>
                                        <td class='customers-td' style="color:#2eff2b; font-weight:800; vertical-align: inherit;" ><?php echo ServiceArticles_Model::getPointArticleReview($value['id'], 1, 5) ?></td> 
                              <?php break; 
                            case "havent_reviewer": echo "<td class='customers-td' colspan='5' style='vertical-align: inherit;'>Nebude posuzovat</td>";
                                  break;
                                }?>
                    </tr>
                    <tr>
                        <td class='customers-td' >
                            <select name='select_reviwer_3' id='select_reviwer_3' class='form-control select_in_table'>
                                  <?php echo ServiceArticles_Model::getAllRecenzentForSlect($value['id'], 2); ?>
                            </select> 
                        </td>
                         <?php switch(ServiceArticles_Model::haveArticleReview($value['id'], 2)){ 
                            case "yet_havent" : echo "<td class='customers-td' colspan='5' style='vertical-align: inherit;'>Ještě nebylo posouzeno</td>";
                                  break;
                              case "have": ?>
                                        <td class='customers-td' style="vertical-align: inherit;" ><?php echo ServiceArticles_Model::getPointArticleReview($value['id'], 2, 1) ?></td>
                                        <td class='customers-td' style="vertical-align: inherit;" ><?php echo ServiceArticles_Model::getPointArticleReview($value['id'], 2, 2) ?></td>
                                        <td class='customers-td' style="vertical-align: inherit;" ><?php echo ServiceArticles_Model::getPointArticleReview($value['id'], 2, 3) ?> </td>
                                        <td class='customers-td' style="vertical-align: inherit;" ><?php echo ServiceArticles_Model::getPointArticleReview($value['id'], 2, 4) ?></td>
                                        <td class='customers-td' style="color:#2eff2b; font-weight:800; vertical-align: inherit;" ><?php echo ServiceArticles_Model::getPointArticleReview($value['id'], 2, 5) ?></td> 
                              <?php break; 
                            case "havent_reviewer": echo "<td class='customers-td' colspan='5' style='vertical-align: inherit;' >Nebude posuzovat</td>";
                                  break;
                                }?>
                    </tr>
               </form>
           <?php }
         } else {
             echo "<div class='panel-heading'> <h5>Žádné příspěvky</h5></div>";
         }
        ?>
    </table>
</div>
 



   
    
    