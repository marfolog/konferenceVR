


    


<div class="panel panel-users">
  <!-- Default panel contents -->
    <div class="panel-heading"> <h3>Správa uživatelů</h3></div>
 <?php if(isset($this->userList) &&  $this->userList > 0){ ?>
    <!-- Table -->
     <table class="table table-users">
       <thead class="table-header">
        <tr>
            <th class='customers-td' rowspan="1" colspan="1" >
                #
            </th>
            <th class='customers-td' rowspan="1" colspan="1">
                Uživatelské jméno
            </th>
            <th class='customers-td'rowspan="1" colspan="2">
                Role (status)
            </th>
            <th class='customers-td' rowspan="1" colspan="2" >
                Blokace
            </th>
        </tr>
 
    </thead>
       
       <?php  
            foreach($this->userList as $key => $value){
                echo "<tr>";
                echo "<td class='customers-td'>".$value['id']."</td>";
                echo "<td class='customers-td' td'>".$value['login'];
                if($value['login'] == Session::readSession(SS_USER)['login']){
                    echo "<span style='color:red; font-weight:200;'> (Já)</span>";
                }
                echo "</td>";
                echo "<td id='statusTd' class='customers-td'>";
                
                if($value['status'] == 'admin'){
                    echo "<span style='color:red; font-weight:200;'>Administrátor</span>";
                } else if($value['status'] == 'recenzent'){
                    echo "Recenzent";
                } else {
                    echo "Autor";
                }
                echo "</td>";
                echo "<td class='customers-td' ><form method='post' name='form_status' action='index.php?page=users/changeStatus/".$value['id']."'>
                          <select name='selectStatus' id='selectRule' class='form-control select_in_table'>";
                
                echo $this->getRuleForSelect($value['status']);
                
                echo "</select><input class='form-control select_in_table' type='submit' value='Změnit'></form></td>";  
                echo "<td class='customers-td'>" ;
                    if($value['block'] == 'true'){echo "Ano";} else {echo "Ne";}
                echo  "</td>";
                echo "<td class='customers-td edit-a'><a href='index.php?page=users/blockUser/".$value['id']."' class='edit-a'>Upravit</a></td>";
                echo "<td class='customers-td edit-a'><a href='index.php?page=users/deleteUsers/".$value['id']."'/ class='edit-a'>Odstranit</a></td>";
                echo "</tr>";
            }
         } else {
             echo "<div class='panel-heading'> <h5>Web nemá žádné uživatele</h5></div>";
         }
        ?>
    </table>
</div>
 



   
    
    