<?php 
class ArticlesForRating_Model extends Model {
    

    public function __construct(){ 
        parent::__construct();
        Session::init();
    }


    /*
        vráti příspěvky v hodnocení které ale uživatel ještě neposoudil tzv, total je 0
    */
    public function getArticlesForRating(){
        $id = CurrentUser::getIdCurrentUser();
        $review = $this->getReviewFromDB_ID_REVIEW($id);
        return $review;      
    }
    
    
    public static function getArticleFromArticlesTableDB_ID($id){
            $model = new Model();
            return $model->getArticleFromDB_ID($id);
    }
    
    
    public static function getOptionsForRating($group){
         return "<fieldset id='group_".$group."'>
                    <div class='form-check  form-check-inline' >
                        <span class='form-check'>
                            <label class='form-check-label for='inlineRadio1'>1</label>
                            <input class='form-check-input' type='radio' name='group_".$group."' id='inlineRadio1' value='1'> 
                        </span>
                        <span class='form-check'>
                            <input class='form-check-input' type='radio' name='group_".$group."' id='inlineRadio2' value='2'> 
                        </span>
                        <span class='form-check'>
                            <input class='form-check-input' type='radio' name='group_".$group."' id='inlineRadio3' value='3'> 
                        </span>
                        <span class='form-check'>
                            <input class='form-check-input' type='radio' name='group_".$group."' id='inlineRadio4' value='4'> 
                        </span>
                        <span class='form-check'>
                            <input class='form-check-input' type='radio' name='group_".$group."' id='inlineRadio5' value='5'> 
                             <label class='form-check-label for='inlineRadio1'>5</label>
                        </span>
                    </div>
             </fieldset>";
     
}
    
//--------------------------------------------------------------------------------------------------------------
//-----------------------------------------------DATABASE-------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------- 
    
    
  public function updateRatingArticle($id_rating, $op_1, $op_2, $op_3, $op_4){
        if(isset($id_rating) && isset($op_1) && isset($op_2) && isset($op_3) && isset($op_4)){
                 $total = $op_4 + $op_3 + $op_2 + $op_1;
                 $total = floatval($total/4);     
                 $query = "UPDATE ".DB_REVIEW_TABLE." SET `op_1` = '$op_1', `op_2` = '$op_2', `op_3` = '$op_3', `op_4` = '$op_4', `total` = '$total'   WHERE `id`='$id_rating'";
                 $this->executeQuery($query);
                return true; 
            } else {
                return false;
        } 
    }
    
    public function getReviewFromDB_ID_REVIEW ($id_reviewer){
           $query = "SELECT * FROM ".DB_REVIEW_TABLE." WHERE `id_reviewer` = '$id_reviewer' AND `total` = '0' ";
           $out = $this->executeQuery($query);
            //sql injectin??
            return $review = $out->fetchAll();
       }
    
    
}
    
?>