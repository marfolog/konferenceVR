<?php

//____________________FOR LOGGIN________________________
define('SS_USER', 'User'); //object user
define('SS_LOGIN_STATUS', 'LoginStatus'); // user_logged (prihlasen), uncorrect_user (zadane spatne heslo, jmeno), not_filled_form (nevyplnen), logout (odhlasen), block                                                      //(true/false)
define('SS_STATUS_USER', 'StatusUser'); //admin, reccenzent, autor
define('SS_TRIED_LOGGIN','TriedLogg'); //true/false
//___________________________________________________________
//_______________________FOR REGISTER________________________

define('SS_REGISTER_STATUS', 'RegisterStatus');//user_registered, same_login,  not_filled_form, password_not_same
define('SS_TRIED_REGISTER', 'TriedReg'); //true,false


//___________________________________________________________
//---------------------------FOR ARTICLE---------------------
define('SS_ARTICLE_LOG', 'ArticleLog'); //titleIsEmpty, abstractIsEmpty, articleSent
define('SS_TRIED_ARTICLE', 'TriedArt'); //true,false
define('SS_TITLE', 'title_article'); //prostě titulek
define('SS_ABSTRACT', 'title_abstract'); //prostě titulek

?>