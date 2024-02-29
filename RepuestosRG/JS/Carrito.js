$(document).ready(function(){
    $.ajax({
        type: "post",
        url: "Controllers/ReadingCart.php",
        dataType: "json",
        success: function(response) {
                LlenarCart(response);
        }
    });
    
    //Preview editable de la orden
    $.ajax({
        type: "post",
        url: "Controllers/ReadingCart.php",
        dataType: "json",
        success: function(response) {
           LlenarTable(response);
        }
    });

    //Vista selección tabla del carrito
    function LlenarTable(response){
        $("#tableCart tbody").text("");
        var TOTAL = 0; // Declarar TOTAL 
        response.forEach(element=>{
            var price = parseFloat(element['Price']);
            var subTotal = element['cant'] * price;
            TOTAL += subTotal; // Acumular subtotales en el TOTAL
            $("#tableCart tbody").append(`
            <tr>
            <td><img src="uploads/${element['Files']}" class="img-size-50"</td>
            <td>${element["Name"]}</td> 
            <td>
                ${element["cant"]}
                <Button type="button" class="btn btn-xs btn-dark mas"
                data-id="${element['id']}"
                data-type="mas">+</Button>
                <Button type="button" class="btn btn-xs btn-danger menos"
                data-id="${element['id']}"
                data-type="menos">-</Button>
            </td> 
            <td>₡${element["Price"]}</td> 
            <td>₡${subTotal}</td> 
            <td><i class="fa fa-trash text-danger DeleteProduct" data-id="${element['id']}" ></i></td>
            </tr>
            `);  
        });
        $("#totalHidden").val(TOTAL.toFixed(2));
        $("#Total").html(`₡${TOTAL.toFixed(2)}`);
    }
    $(document).on("click", ".mas, .menos", function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var type = $(this).data('type');
        $.ajax({
            type: "post",
            url: "Controllers/UpdateCantProducts.php",
            data: {"id":id, "type":type},
            dataType: "json",
            success: function(response) {
                LlenarTable(response);
                LlenarCart(response);
            }
        });
    });

    //Vista selección tabla del carrito
    function LlenarTable(response){
        $("#tableCart tbody").text("");
        var TOTAL = 0; // Declarar TOTAL 
        response.forEach(element=>{
            var price = parseFloat(element['Price']);
            var subTotal = element['cant'] * price;
            TOTAL += subTotal; // Acumular subtotales en el TOTAL
            $("#tableCart tbody").append(`
            <tr>
            <td><img src="uploads/${element['Files']}" class="img-size-50"</td>
            <td>${element["Name"]}</td> 
            <td>
                ${element["cant"]}
                <Button type="button" class="btn btn-xs btn-dark mas"
                data-id="${element['id']}"
                data-type="mas">+</Button>
                <Button type="button" class="btn btn-xs btn-danger menos"
                data-id="${element['id']}"
                data-type="menos">-</Button>
            </td> 
            <td>₡${element["Price"]}</td> 
            <td>₡${subTotal}</td> 
            <td><i class="fa fa-trash text-danger DeleteProduct" data-id="${element['id']}" ></i></td>
            </tr>
            `);  
        });
        $("#totalHidden").val(TOTAL.toFixed(2));
        $("#Total").html(`₡${TOTAL.toFixed(2)}`);
    }

      //Preview del detalle de la orden
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
        var cantidad = ""; // Arreglo que guardara las cantidades
        response.forEach(element => {
            var price = parseFloat(element['Price']);
            var subTotal = element['cant'] * price;
            TOTAL += subTotal; // Acumular subtotales en el TOTAL
            names += element["Name"] + ","; // Agregar el nombre del producto a la cadena
            cantidad += element["cant"] + ";"; // Agregar la cantidad al arreglo

            $("#tableCartOrder tbody").append(`
            <tr>
            <td><img src="uploads/${element['Files']}" class="img-size-50"</td>
            <td>${element["Name"]}</td> 
            <td>${element["cant"]}</td> 
            <td>₡${element["Price"]}</td> 
            <td>₡${subTotal}</td>
            </tr>
            `);
        });
        
        // Eliminar la última coma de las cadenas
        cantidad = cantidad.slice(0, -1);
        names = names.slice(0, -1);
        prices = prices.slice(0, -1);
        
        // Asignar las cadenas a los campos ocultos
        $("#CantidadHidden").val(cantidad);
        $("#NameProductHidden").val(names);
        
        $("#Total").html(`₡${TOTAL.toFixed(2)}`);
    }

 //Construir carrito
 function LlenarCart(response){
    var cantidad = Object.keys(response).length;
    $("#badgeCart").text(cantidad);
    $("#CartList").text("");
    response.forEach(element=>{
        $("#CartList").append(`<a href="DetailProduct.php" class="dropdown-item">
        <!-- Cart Start -->
        <div class="media">
          <img src="uploads/${element['Files']}" class="img-size-50 mr-3 img-circle">
          <div class="media-body">
            <h3 class="dropdown-item-title">
                ${element['Name']}
              <span class="float-right text-sm text-danger"><i class="fas fa-eye"></i></span>
            </h3>
            <p class="text-sm">₡ ${element['Price']}</p>
            <p class="text-sm">Cantidad: ${element['cant']}</p>
          </div>
        </div>
      </a>
      </a>
      <div class="dropdown-divider"></div>
      `);
    });
    $("#CartList").append(`
    <a href="ViewCart.php" class="btn btn-outline-danger m-2 dropdown-footer">
    <i class="fa fa-eye mr-2"></i>Ver Carrito
    </a>
    `);
}
//Agregar productos al carrito
    $(".addToCart").click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var name = $(this).data('name');
        var price = $(this).data('price');
        var files = $(this).data('files');
        var stock = $(this).data('stock'); // Obtener la existencia del producto
        var cant = $("#Cant_Product").val();
           // Verificar si la cantidad solicitada es mayor que la existencia disponible
            if (parseInt(cant) > parseInt(stock)) {
                $("#stockAlert").show(1000); // Mostrar la alerta
                return; // Salir de la función sin agregar el producto al carrito
            } else {
                $("#stockAlert").hide(); // Ocultar la alerta si estaba mostrándose
            }
        $.ajax({
            type: "post",
            url: "Controllers/AddCart.php",
            data: {id: id, Name: name, Price: price, Files: files,  cant: cant},
            dataType: "json",
            success: function(response) {
                LlenarCart(response);
                $("#badgeCart").hide(500).show(500).hide(500).show(500);
                $("#iconCart").click();
            }
        });
    });
    
    //Eliminar un producto
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
});