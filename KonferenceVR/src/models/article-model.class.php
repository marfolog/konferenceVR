<?php 
class Article_Model extends Model {
    

    public function __construct(){ 
        parent::__construct();
        Session::init();
    }
    
    
   function moveFile($id){
            $target_dir = "../uploads/";
            $target_file = $target_dir.basename($_FILES['fileToUpload']["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            Session::addSession(SS_FILE, 'non_exist');
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
       
            /*V editačním modu chceme i soubor ponehcat protto vrátimu true že je vše ok*/
            if($id == null){
                return false;
            } else {
                Session::addSession(SS_FILE, 'nothing');
                return true;
            }

    }
    
    
    
    public function preprocessingArticle($id){ 
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
                    
                      if(Article_Model::moveFile($id)){
                          //save
                           $dirToFile = Session::readSession(SS_FILE);
                           $inputTitle = $_POST['inputTitle'];
                           $output =  $_POST['abstract']; 
                           if($id == null){
                               if($this->saveArticleToDB(date("Y-m-d H.i.s"), $authorOutput, $inputTitle, $output, $dirToFile)){
                                   Session::addSession(SS_ARTICLE_LOG,'articleReady'); 
                               } else {
                                   Session::addSession(SS_ARTICLE_LOG,'not_save'); 
                               }
                           } else {
                              if($this->editArticleInDB($id, date("Y-m-d H.i.s"), $inputTitle, $output, $dirToFile)){
                                   Session::addSession(SS_ARTICLE_LOG,'articleReady'); 
                               } else {
                                   Session::addSession(SS_ARTICLE_LOG,'not_save'); 
                               }
                          }
                      } else {
                           Session::addSession(SS_TITLE, $_POST['inputTitle']);
                           Session::addSession(SS_ABSTRACT, $_POST['abstract']);
                           Session::addSession(SS_ARTICLE_LOG,'articleNotReady'); 
                          
                      }
                  }    
                }     
              
    }
    
//--------------------------------------------------------------------------------------------------------------
//-----------------------------------------------DATABASE-------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------- 
    
    
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
    
        /*add article*/
    public function saveArticleToDB($date, $author, $title, $text, $path_to_file){
        if(isset($date) && isset($author) && isset($title) && isset($text) && isset($path_to_file)){
            
                $query = "INSERT INTO ".DB_ARTICLES_TABLE." (date, author, title, text, path_to_file) VALUES (?,?,?,?,?);";
                $out = $this->db->prepare($query);
            
                $date = htmlspecialchars($date);
                $author = htmlspecialchars($author);
                $title = htmlspecialchars($title);
                $text = htmlspecialchars($text);
                $path_to_file = htmlspecialchars($path_to_file);
            
                $out->execute(array($date, $author, $title, $text, $path_to_file));
                return true; 
            } else {
                return false;
        } 
    }
    
    
    public function editArticleInDB($id, $date, $inputTitle, $text, $dirToFile){
            if(isset($id) && isset($date) && isset($inputTitle) && isset($text) && isset($dirToFile)){
                if($dirToFile == "nothing") {
                    $query = "UPDATE ".DB_ARTICLES_TABLE." SET status=:status, date=:date, title=:title, text=:text WHERE id =:id ";
                    $out = $this->db->prepare($query);
            
                    $date = htmlspecialchars($date);
                    $inputTitle = htmlspecialchars($inputTitle);
                    $text = htmlspecialchars($text);
            
                    $out->execute(array(":status" => 0, ":date" => $date,":title" => $inputTitle, ":text" =>$text, ":id" => $id));
                    
                } else {
                    $query = "UPDATE ".DB_ARTICLES_TABLE." SET status =:status, date=:date, title=:title, text=:text, path_to_file=:path WHERE id=:id";
                    
                    $out = $this->db->prepare($query);
            
                    $date = htmlspecialchars($date);
                    $inputTitle = htmlspecialchars($inputTitle);
                    $text = htmlspecialchars($text);
                    $dirToFile = htmlspecialchars($dirToFile);
            
                    $out->execute(array(":status" => 0, ":date" => $date, ":title" => $inputTitle, ":text" =>$text, ":path" =>$dirToFile, ":id" => $id));
                }   

                return true; 
            } else {
                echo "vracim nepovedlo se!";
                    return false;
            }
        }

    
}
?>