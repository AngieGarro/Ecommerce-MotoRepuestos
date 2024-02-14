//Funcion acciones
$("#insertForm").on("submit", function(e) {
    $("#btnInsert").attr("disabled", "disabled");
    e.preventDefault();
        if (response.statusCode == 200) {
          $("#CreateProduct").offcanvas("hide");
          $("#btnInsert").removeAttr("disabled");
          $("#insertForm")[0].reset();
          $("#successToast").toast("show");
          $("#successMsg").html(response.message);
          fetchData();
        } else if(response.statusCode == 500) {
          $("#CreateProduct").offcanvas("hide");
          $("#btnInsert").removeAttr("disabled");
          $("#insertForm")[0].reset();
          $("#errorToast").toast("show");
          $("#errorMsg").html(response.message);
        } else if(response.statusCode == 400) {
          $("#btnInsert").removeAttr("disabled");
          $("#errorToast").toast("show");
          $("#errorMsg").html(response.message);
        }
      });

 