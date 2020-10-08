      <?php
        function money_format($value)
        {
            return '$' . number_format($value, 2);
        }
        ?>
      <?php
        $id = $_REQUEST['id'];
        $sql = "SELECT  id_product,name,price,exist,description FROM productos WHERE id_product = :id";
        $queryProductos = $db->prepare($sql);
        $queryProductos->bindValue(':id', $id);
        $queryProductos->execute();
        $rowProducto = $queryProductos->fetch(PDO::FETCH_OBJ);
        ?>
      <!-- Default box -->
      <div class="card card-solid">
          <div class="card-body">
              <div class="row">
                  <div class="col-12 col-sm-6">
                      <h3 class="d-inline-block d-sm-none"><?php echo $rowProducto->name; ?></h3>
                      <?php

                        $sqlImagenes = "SELECT f.web_path FROM productos AS p 
                        INNER JOIN productos_files AS pf ON pf.product_id=p.id_product
                        INNER JOIN files AS f ON f.id=pf.file_id
                        WHERE p.id_product = :id";
                        // $queryImagenes = $db->prepare($sqlImagenes);
                        // $queryImagenes->bindValue(':id', $id);
                        // $queryImagenes->execute();
                        $resPrimerImagen = $db->prepare($sqlImagenes);
                        $resPrimerImagen->bindValue(':id', $id);
                        $resPrimerImagen->execute();
                        $rowPrimerImagen = $resPrimerImagen->fetch(PDO::FETCH_OBJ);
                        ?>
                      <div class="col-12">
                          <img  id="grande" src="<?php echo $rowPrimerImagen->web_path; ?>" class="product-image" alt="Product Image">
                      </div>
                        <div class="col-12 product-image-thumbs">
                      <?php
                        // $rowImage = $queryImagenes->fetch(PDO::FETCH_OBJ);
                        $queryImagenes = $db->prepare($sqlImagenes);
                        $queryImagenes->bindValue(':id', $id);
                        $queryImagenes->execute();
                        while ($rowImage = $queryImagenes->fetch(PDO::FETCH_OBJ)){
                        ?>


                          <div class="product-image-thumb"><img onclick="cambiarImagen(this)" src="<?php echo $rowImage->web_path; ?>" alt="Product Image"></div>
                          <!-- <div class="product-image-thumb"><img src="admin/dist/img/prod-2.jpg" alt="Product Image"></div>
                          <div class="product-image-thumb"><img src="admin/dist/img/prod-3.jpg" alt="Product Image"></div>
                          <div class="product-image-thumb"><img src="admin/dist/img/prod-4.jpg" alt="Product Image"></div>
                          <div class="product-image-thumb"><img src="admin/dist/img/prod-5.jpg" alt="Product Image"></div> -->

                      <?php
                        }
                      ?>
                        </div>
                  </div>
                  <div class="col-12 col-sm-6">
                      <h3 class="my-3"><?php echo $rowProducto->name; ?></h3>
                      <p><?php echo $rowProducto->description; ?></p>

                      <hr>
                      <h4><?php echo $rowProducto->exist; ?> en existencia</h4>
                      <!-- <h4>Available Colors</h4>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-default text-center active">
                                <input type="radio" name="color_option" id="color_option1" autocomplete="off" checked="">
                                Green
                                <br>
                                <i class="fas fa-circle fa-2x text-green"></i>
                            </label>
                            <label class="btn btn-default text-center">
                                <input type="radio" name="color_option" id="color_option2" autocomplete="off">
                                Blue
                                <br>
                                <i class="fas fa-circle fa-2x text-blue"></i>
                            </label>
                            <label class="btn btn-default text-center">
                                <input type="radio" name="color_option" id="color_option3" autocomplete="off">
                                Purple
                                <br>
                                <i class="fas fa-circle fa-2x text-purple"></i>
                            </label>
                            <label class="btn btn-default text-center">
                                <input type="radio" name="color_option" id="color_option4" autocomplete="off">
                                Red
                                <br>
                                <i class="fas fa-circle fa-2x text-red"></i>
                            </label>
                            <label class="btn btn-default text-center">
                                <input type="radio" name="color_option" id="color_option5" autocomplete="off">
                                Orange
                                <br>
                                <i class="fas fa-circle fa-2x text-orange"></i>
                            </label>
                        </div> -->

                      <h4 class="mt-3">Seleccione la cantidad de producto que desea</h4>
                      <h6 class="mt-3">dependiendo el producto pueden ser kilos o piezas</h6>
                      <div class="mt-4">
                          <input type="number" class="form-control" id="cantidadProducto" value="1">
                      </div>
                      

                      <div class="bg-gray py-2 px-3 mt-4">
                          <h2 class="mb-0">
                              <?php echo money_format($rowProducto->price); ?>
                          </h2>
                          <h4 class="mt-0">
                              <small>Con impuesto: <?php echo money_format($rowProducto->price); ?> </small>
                          </h4>
                      </div>

                      <div class="mt-4">
                          <button class="btn btn-primary btn-lg btn-flat" id="agregarCarrito" 
                          data-id=" <?php echo $_REQUEST['id']?>"
                          data-nombre="<?php echo $rowProducto->name; ?>" 
                          data-web_path="<?php echo $rowPrimerImagen->web_path; ?>"
                          data-precio="<?php echo $rowPrimerImagen->precio; ?>"> 
                          
                              <i class="fas fa-cart-plus fa-lg mr-2"></i>
                              Add to Cart
                          </button>
                      </div>



                  </div>
              </div>

          </div>
          <!-- /.card-body -->
      </div>

      