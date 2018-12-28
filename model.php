<?php
require_once('database.php');
class CrudOperation extends Database{
   public function insert($table, $data){
      $sql = "";
      $sql .= "INSERT INTO ".$table." (".implode(", ", array_keys($data)).") VALUES ('".implode("', '", array_values($data))."')";
      $query = mysqli_query($this->con, $sql);
      if ($query) {
      $message =        '<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Well done!</strong> Record saved successfuly </a>.
</div>';
      echo json_encode($message);
      }
   }

   public function select_all($table){
     $sql = "";
     $sql = "SELECT * FROM ".$table;
     $array = array();
     $query = mysqli_query($this->con, $sql);
     while($row = mysqli_fetch_assoc($query)):
      $array[]= $row;
     endwhile;
     return $array;
   }

   public function select_one($table,$where){
    $sql = "";
    $condition="";
    $array = [];
    foreach ($where as $key => $value) {
       $condition .= $key.="='".$value."'";
    }
    $sql .="SELECT * FROM ".$table." WHERE ".$condition;
    $query = mysqli_query($this->con, $sql);
    while ($row = mysqli_fetch_assoc($query)) {
       $array[] = $row;
    }
    return $array;
   }

   public function update($table, $data, $where){
      $sql="";
      $condition="";
      foreach ($data as $key => $value) {
         $sql .= $key.="='".$value."', ";
      }
        $sql = substr($sql, 0,-2);
      foreach ($where as $key => $value) {
          $condition .= $key.="='".$value."'";
        }  
       $sql = "UPDATE ".$table." SET ".$sql." WHERE ".$condition;
       $query = mysqli_query($this->con, $sql);
       if ($query) {
        $message =        '<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Well done!</strong> Record Updated successfuly </a>.
</div>';
       echo json_encode($message);
       }
   }  


   public function delete($table, $where){
    $sql="";
    $condition="";

    foreach ($where as $key => $value) {
          $condition .= $key.="='".$value."'";
    }  
    $sql = "DELETE FROM ".$table." WHERE ".$condition;
    $query = mysqli_query($this->con, $sql);
    if ($query) {
      $message =        '<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Well done!</strong> Record Deleted successfuly </a>.
</div>';
       echo json_encode($message);
    }
   }

}
$obj = new CrudOperation;




if (isset($_POST['saveform'])) {
  $data=[];
  $data = $_POST;
  unset($data['saveform']);
  $obj->insert('user_tbl', $data);
}


if (isset($_POST['dataFetch'])) {
 if($data = $obj->select_all('user_tbl')){
    $html = "";
    $html .= '<thead>';
    $html .= '<th>SL</th>';
    $html .= '<th>Username</th>';
    $html .= '<th>Password</th>';
    $html .= '<th>Action</th>';
    $html .= '</thead>';
    $count = 1;
     foreach ($data as $row) {
       $html .= '<tr>';
       $html .= '<td>'.$count++.'</td>';
       $html .= '<td>'.$row['username'].'</td>';
       $html .= '<td>'.$row['password'].'</td>';
       $html .= '<td> <a href="" user-data="'.$row['user_id'].'" id="edit" class="btn btn-primary btn-xs">Edit</a> &nbsp;
   <a href="" user-data="'.$row['user_id'].'" id="delete" class="btn btn-danger btn-xs">Delete</a>
</td>';
       $html .= '</tr>';
     }
    echo json_encode($html); 
 }
}


if (isset($_POST['edit'])) {
  $where = ['user_id'=>$_POST['user_id']];
  if($data = $obj->select_one('user_tbl', $where)){
    foreach ($data as $row) {
    $html="";
    $html .= '<form action="controller.php" method="post" id="updateForm">';
    $html .= '<div class="row">';
    $html .= '<div class="col-md-12">';
    $html .= '<input type="hidden" value="'.$row['user_id'].'" name="user_id">';
    $html .= '<input type="hidden" value="update" name="update">';
    $html .= '<div class="form-group">';
    $html .= '<input type="text" name="username" value="'.$row['username'].'" placeholder="Username" id="" class="form-control">';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="col-md-12">';
    $html .= '<div class="form-group">';
    $html .= '<input type="password" name="password" value="'.$row['password'].'" placeholder="Password" id="" class="form-control">';
    $html .= '</div></div>';
    $html .= '<div class="col-md-12"> <a href="" id="cancel" class="btn btn-default pull-left">Cancel</a>';
    $html .= '<input type="submit" value="Update" name="update"  id="" class="btn btn-success pull-right">';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</form>';
    }
        echo json_encode($html);
  }
}


if (isset($_POST['update'])) {
  // print_r($_POST);
  $data = [];
  $data = $_POST;
  $where = ['user_id'=>$data['user_id']];
  unset($data['update']);
  unset($data['user_id']);
  $obj->update('user_tbl', $data, $where);
}

if (isset($_POST['delete'])) {
  $where = ['user_id'=>$_POST['user_id']];
  $obj->delete('user_tbl', $where);
  // echo json_encode($where);
}