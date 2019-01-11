


    


<div class="panel panel-users">
  <!-- Default panel contents -->
    <div class="panel-heading"> <h3>Hodnocení příspěvků</h3></div>
 <?php if(isset($this->articlesForRating) &&  count($this->articlesForRating) > 0){ ?>
    <!-- Table -->
 <table class="table table-users">
       <?php  
            $count_active_rating = 0;
            foreach($this->articlesForRating as $key => $value){
                $article = ArticlesForRating_Model::getArticleFromArticlesTableDB_ID($value['id_article']);
                /*Pokud příspěvek nebyl zamítnut a nebo publikován tak ho můžeme ohodnotit*/
                if($article[0]['status'] == 0){
                    $count_active_rating = $count_active_rating + 1;
                    echo "<tr>";
                    echo "<form method='post' action='index.php?page=articlesForRating/rating/".$value['id']."' name='form_rating'>";
                    echo "<td class='customers-td' style='vertical-align: inherit;'><div style='color:yellow; font-weight:800;'>Název:</div> ".$article[0]['title']."</td>";
                    if($article[0]['path_to_file'] != 'nothing'){
                            echo "<td class='customers-td' style='vertical-align: inherit;' > <a href=";
                            echo $article[0]['path_to_file'];
                            echo ">Stažení příspěvku</a></td>";   
                    } else {
                        echo "<td class='customers-td' style='vertical-align: inherit;'>Bez přílohy</td>";  
                    }
                    echo "<td class='customers-td' style='vertical-align: inherit;'><div style='color:yellow; font-weight:800;'>Autor:</div> ".$article[0]['author']." </td>";
                    echo "<td class='customers-td'>Téma: ";
                       echo ArticlesForRating_Model::getOptionsForRating(1);
                    echo "</td>";
                    echo "<td class='customers-td'style='vertical-align: inherit;'>Zpracování: ";
                        echo ArticlesForRating_Model::getOptionsForRating(2);
                    echo "</td>";
                    echo "<td class='customers-td' style='vertical-align: inherit; '>Jazyk: ";
                        echo ArticlesForRating_Model::getOptionsForRating(3);
                    echo "</td>";
                    echo "<td class='customers-td' style='vertical-align: inherit; '>Doporučení: ";
                        echo ArticlesForRating_Model::getOptionsForRating(4);
                    echo "</td>";
                    echo "<td class='customers-td' style='vertical-align: inherit;'>";
                            echo "<button class='btn btn-default' type='submit' >Ohodnotit</button>";
                            echo ArticlesForRating::verifyLog($value['id']);
                    echo "</td>";
                    echo "</form>";
                    echo "</tr>";
                }    
                
            }
    
            if($count_active_rating == 0){
                echo "<div class='panel-heading'> <h5>Nemáte žádné příspěvky k posouzení</h5></div>";
            }
         } else {
             echo "<div class='panel-heading'> <h5>Nemáte žádné příspěvky k posouzení</h5></div>";
         }
        ?>
    </table>
</div>
 



   
    
    