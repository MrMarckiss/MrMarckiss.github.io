document.getElementById("btnSave").onclick =(evt)=>{
    //evt.preventDefault()//evita recargar el form
    document.getElementById("form").classList.add('was-validated')

    Swal.fire({
       
        icon: "success",
        title: "Datos guardados correctamente",
        showConfirmButton: false,
        timer: 1500
      });
}
