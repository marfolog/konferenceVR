<?php 
class Article_Model extends Model {
    

    public function __construct(){ 
        parent::__construct();
        Session::init();
    }
    
    
   function moveFile(){
            $target_dir = "../uploads/";
            $target_file = $target_dir.basename($_FILES['fileToUpload']["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            Session::addSession(SS_FILE, 'nothing');
            if (file_exists($target_file) == false){
                //add date
                $target_file = substr($target_file, 0, -4);
                $target_file .= "_".date("is").".pdf";
                //-----------------------
                if($imageFileType != "pdf") {
                    Session::addSession(SS_FILE, 'not_correct_format');
                    $uploadOk = 0;
                    return false;
                }
                
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        Session::addSession(SS_FILE, $target_file);
                        return true;
                    } else {
                        Session::addSession(SS_FILE, 'error_upload');
                        return false;
                }
           }
           return true;
    }
    
    
    
    public function preprocessingArticle(){ 
         if ($_SERVER["REQUEST_METHOD"] == "POST") {
                  $authorOutput = CurrentUser::getNameCurrentUser();
                  $dateOutput =  date("j. n. Y");
                  
                  Session::addSession(SS_TITLE, $_POST['inputTitle']);
                  Session::addSession(SS_ABSTRACT, $_POST['abstract']);
                  
                  
                  if(!isset($_POST['inputTitle']) || $_POST['inputTitle'] == ""){
                      //ERR
                      Session::addSession(SS_TITLE, null);
                      Session::addSession(SS_ARTICLE_LOG,'titleIsEmpty');
                      Session::addSession(SS_TRIED_ARTICLE,'true');
                  } else if(!isset($_POST['abstract']) || $_POST['abstract'] == "") {
                      //ERR
                      Session::addSession(SS_ABSTRACT, null);
                      Session::addSession(SS_ARTICLE_LOG,'abstractIsEmpty');
                      Session::addSession(SS_TRIED_ARTICLE,'true');
                  } else {
                      //Sent
                      Session::addSession(SS_ABSTRACT, null);
                      Session::addSession(SS_TITLE, null);
                      Session::addSession(SS_TRIED_ARTICLE,'true');
                      
                    
                      if(Article_Model::moveFile()){
                          //save
                           $dirToFile = Session::readSession(SS_FILE);
                           echo "save: ".$dirToFile;
                          
                           $inputTitle = $_POST['inputTitle'];
                           $output =  $_POST['abstract']; 
                           if(Model::saveArticleToDB(date("Y-m-d H.i.s"), $authorOutput, $inputTitle, $output, $dirToFile)){
                               Session::addSession(SS_ARTICLE_LOG,'articleReady'); 
                           } else {
                               Session::addSession(SS_ARTICLE_LOG,'not_save'); 
                           }
                      } else {
                           Session::addSession(SS_ARTICLE_LOG,'articleNotReady'); 
                      }
                  }    
                }     
              
    }
    

    
    
    public function getArticle($id){
       $query = "SELECT id, date, author, title, text, path_to_file, status FROM ".DB_ARTICLES_TABLE." WHERE `id` = '".$id."'";
        $out = $this->executeQuery($query);
        //sql injectin??
        if($out != null || !isset($out)){
            $articles = $out->fetchAll();
             if(!isset($articles) || count($articles) == 0){
                 return null;
             } else {
                 return $articles[0];
            }
        }
    }

    
}
?>