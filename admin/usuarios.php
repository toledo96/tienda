
<?php
    include_once 'db_ecommerce.php';
    if(isset($_REQUEST['idBorrar'])){
         $id = $_REQUEST['idBorrar'];
         $sql = "DELETE  FROM usuarios WHERE id_user = :id";
         $query = $db->prepare($sql);
         $query->bindValue(':id', $id);
         $result = $query->execute();
        if($result){

?>

<div class="alert alert-warning float-right" role="alert">
        Usuario borrado con exito
</div>


<?php
        }
    }else{
?>

<!-- <div class="alert alert-warning float-right" role="alert">
        Error al borrar <?php echo $db->errorInfo(); ?>
</div> -->

<?php
    }
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Usuarios</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Acciones
                      <a href="panel.php?modulo=crearUsuario"><i class="fa fa-plus"></i></a>
                    </th>
                  </tr>
                </thead>
                <tbody>
                    <?php

                        $sql = "SELECT id_user,name,username,email FROM usuarios";
                        $query = $db->prepare($sql);
                        $query->execute();
                        while($result = $query->fetch(PDO::FETCH_OBJ)){
                    ?>
                      <tr>
                        <td><?php echo $result->id_user?></td>
                        <td><?php echo $result->name?></td>
                        <td><?php echo $result->username?></td>
                        <td><?php echo $result->email?></td>
                        <td>
                          <a href="panel.php?modulo=editarUsuario&id=<?php echo $result->id_user;?>" style="margin-right:10px"><i class="fas fa-edit"></i></a>                         

                          <a href="panel.php?modulo=usuarios&idBorrar=<?php echo  $result->id_user;?>" class="text-danger borrar"><i class="fas fa-trash"></i></a>
                        </td>
                      </tr>
                      <?php
                        }
                      ?>


                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->


        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>