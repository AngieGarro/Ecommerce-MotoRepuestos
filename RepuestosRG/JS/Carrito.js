$(document).ready(function(){
    $.ajax({
        type: "post",
        url: "Controllers/ReadingCart.php",
        dataType: "json",
        success: function(response) {
           LlenarCart(response);
        }
    });
    $.ajax({
        type: "post",
        url: "Controllers/ReadingCart.php",
        dataType: "json",
        success: function(response) {
           LlenarTable(response);
        }
    });
    function LlenarTable(response){
        $("#tableCart tbody").text("");
        var TOTAL = 0;
        response.forEach(element=>{
            var price = parseFloat(element['Price']);
            TOTAL += price;
            $("#tableCart tbody").append(`
            <tr>
            <td><img src="uploads/${element['Files']}" class="img-size-50"</td>
            <td>${element["Name"]}</td> 
            <td>₡${element["Price"]}</td> 
            <td><i class="fa fa-trash text-danger DeleteProduct" data-id="${element['id']}" ></i></td>
            </tr>
            `);  
        });
        $("#totalHidden").val(TOTAL.toFixed(2));
        $("#Total").html(`₡${TOTAL.toFixed(2)}`);
    }
    //Para Comprobante
    $.ajax({
        type: "post",
        url: "Controllers/ReadingCart.php",
        dataType: "json",
        success: function(response) {
           LlenarTableOrder(response);
        }
    });
    function LlenarTableOrder(response){
        var TOTAL = 0;
        var names = ""; // Cadena para almacenar los nombres de los productos
        var prices = ""; // Cadena para almacenar los precios de los productos
        
        response.forEach(element => {
            var price = parseFloat(element['Price']);
            TOTAL += price;
            names += element["Name"] + ","; // Agregar el nombre del producto a la cadena
            
            $("#tableCartOrder tbody").append(`
            <tr>
                <td>${element["Name"]}</td> 
                <td>₡${element["Price"]}</td> 
            </tr>
            `);
        });
        
        // Eliminar la última coma de las cadenas
        names = names.slice(0, -1);
        prices = prices.slice(0, -1);
        
        // Asignar las cadenas a los campos ocultos
        $("#NameProductHidden").val(names);
        
        $("#Total").html(`₡${TOTAL.toFixed(2)}`);
    }

    //Agregar productos al carrito
    $(".addToCart").click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var name = $(this).data('name');
        var price = $(this).data('price');
        var files = $(this).data('files');

        $.ajax({
            type: "post",
            url: "Controllers/Carrito.php",
            data: {id: id, Name: name, Price: price, Files: files},
            dataType: "json",
            success: function(response) {
               LlenarCart(response);
               $("#badgeCart").hide(500).show(500).hide(500).show(500);
               $("#iconCart").click();
            }
        });
    });

    function LlenarCart(response){
        var cantidad =Object.keys(response).length;  //cantidad de productos en el carrito                     
        $("#badgeCart").text(cantidad);
        $("#CartList").text("");
        response.forEach(element=>{
            $("#CartList").append(`<a href="index.php" class="dropdown-item">
            <!-- Cart Start -->
            <div class="media">
              <img src="uploads/${element['Files']}" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                    ${element['Name']}
                  <span class="float-right text-sm text-danger"><i class="fas fa-eye"></i></span>
                </h3>
                <p class="text-sm">₡ ${element['Price']}</p>
              </div>
            </div>
          </a>
          </a>
          <div class="dropdown-divider"></div>
          `);
        });
        $("#CartList").append(`<button class="btn btn-outline-dark ml-5 m-2 dropdown-footer" id="DeleteCart"><i class="fa fa-trash mr-2"></i>Borrar Productos</button>
        <a href="ViewCart.php" class="btn btn-outline-danger m-2 dropdown-footer">
        <i class="fa fa-eye mr-2"></i>Ver Carrito
        </a>
        `);
    }
    $(document).on("click", ".DeleteProduct", function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            type: "post",
            url: "Controllers/DeleteProduct.php",
            data: {"id": id},
            dataType: "json",
            success: function(response) {
                LlenarCart(response);
                LlenarTable(response);
            }
        });
    });
    $(document).on("click","#DeleteCart",function(e){
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "Controllers/DeleteCart.php",
            dataType: "json",
            success: function(response) {
                LlenarCart(response);
            }
        });

    });
});