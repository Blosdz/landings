var cancel_btn;
var alert_wrapper;
var show_progress_bar; 
var input; 
var file_input_label; 
var list_alert_wrapper = [];
var data = '{"alert_wrapper":[]}';
var hide_file;
var loading_btn;
var can_upload_file = "yes";

$( document ).ready(function() {

    $("#hide_dni").val($("#hide_dni").val().substring($("#hide_dni").val().lastIndexOf('/') + 1)) ;
    $("#hide_dni_r").val($("#hide_dni_r").val().substring($("#hide_dni_r").val().lastIndexOf('/') + 1)) ;
    $("#hide_profile_picture").val($("#hide_profile_picture").val().substring($("#hide_profile_picture").val().lastIndexOf('/') + 1)) ;

});

$(document).on("click", "#alert_wrapper_dni", function(event){

    var alert_wrapper = document.getElementById("alert_wrapper_dni");
    alert_wrapper.innerHTML = ``;
});
$(document).on("click", "#alert_wrapper_dni_r", function(event){

    var alert_wrapper = document.getElementById("alert_wrapper_dni_r");
    alert_wrapper.innerHTML = ``;
});
$(document).on("click", "#alert_wrapper_profile_picture", function(event){

    var alert_wrapper = document.getElementById("alert_wrapper_profile_picture");
    alert_wrapper.innerHTML = ``;
});


function check_progress_bar(e){

    input_w = document.getElementById(e.target.id);
    input_parentNode_w = document.getElementById(input_w.parentNode.id);
    input_grandpa_w = document.getElementById(input_parentNode_w.parentNode.id);
    var alert_wrapper_w = document.getElementById(input_grandpa_w.children[2].id);

    if(can_upload_file == "yes"){
         //ok you can upload files
    }else{
        e.preventDefault();
        alert_wrapper_w.classList.remove("d-none");
        show_alert(`hay un archivo en cola`, "primary",alert_wrapper_w);
    }
    
}
function show_alert(message, alert,alert_wrapper) {

    alert_wrapper.innerHTML = `
    <div id="alert" class="alert-${alert} alert-dismissible fade show" >
       <div class="row">
            <div class="col-10 mt-2">
                <span >${message}</span>
            </div>
            <div class="col-2">
                 <button  id =${alert_wrapper.id} type="button" class="close" data-dismiss="alert" aria-label="Close" code = ${alert_wrapper.id}>
                     <span aria-hidden="true">&times;</span>
                 </button>                
            </div>
       </div>
    </div>
    `
}

function upload(alert_wrapper,show_progress_bar) {

    var data = new FormData();
    var request = new XMLHttpRequest();
    request.responseType = "json";

    alert_wrapper.innerHTML = "";
    input.disabled = true;
    alert_wrapper.classList.remove("d-none");
    show_progress_bar.classList.remove("d-none");

    var file = input.files[0];
    var filename = file.name;
    var filesize = file.size;
    document.cookie = `filesize=${filesize}`;
    data.append(input.id, file);

    request.upload.addEventListener("progress", function (e) {
        var loaded = e.loaded;
        var total = e.total
        var percent_complete = (loaded / total) * 100;
        loading_btn.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Cargando...
                        ${Math.floor(percent_complete)}%`;
    })

    request.addEventListener("load", function (e) {

        if (request.status == 200) {
            hide_file.value = request.response.file_name;
            show_alert(`${request.response.message}`, "success",alert_wrapper);
        }
        else {
            show_alert(`Error al cargar el archivo`+request.status, "danger",alert_wrapper);
        }
            reset();
    });

    request.addEventListener("error", function (e) {
        reset();
        show_alert(`Error al cargar el archivo`, "warning",alert_wrapper);
    });

    request.addEventListener("abort", function (e) {
        reset();
        show_alert(`Carga cancelado`, "primary",alert_wrapper);
    });

  

    request.open('post', window.location.origin+"/"+"upload-file");

    const XSRF_TOKEN = getCookie('XSRF-TOKEN');

    request.setRequestHeader('x-csrf-token',$('#csrftoken').val());
    request.send(data);

    cancel_btn.addEventListener("click", function () {
        request.abort();
        reset();
        show_alert(`Carga cancelado`, "primary",alert_wrapper);

    })

    function getCookie(name) {
        let cookieValue = null;
        if (document.cookie && document.cookie !== '') {
            const cookies = document.cookie.split(';');
            for (let i = 0; i < cookies.length; i++) {
                const cookie = cookies[i].trim();
                if (cookie.substring(0, name.length + 1) === (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }

    

}

function input_filename(e) {

    input = document.getElementById(e.target.id);
    input_parentNode = document.getElementById(input.parentNode.id);
    input_grandpa = document.getElementById(input_parentNode.parentNode.id);

    file_input_label_s = document.getElementById(input_grandpa.children[0].id);
    file_input_label = document.getElementById(file_input_label_s.children[0].id);
    file_input_label.innerText = input.files[0].name;

    hide_file = document.getElementById(file_input_label_s.children[2].id);


    show_progress_bar = document.getElementById(input_grandpa.children[1].id);
    loading_btn = document.getElementById(show_progress_bar.children[0].id);


    alert_wrapper = document.getElementById(input_grandpa.children[2].id);
    cancel_btn = document.getElementById(show_progress_bar.children[1].id)

    can_upload_file = "no"; //a file begins to upload and with which no more processes will be allowed

    upload(alert_wrapper,show_progress_bar);
}


function reset() {
    input.value = null;
    input.disabled = false;
    show_progress_bar.classList.add("d-none");
    file_input_label.innerText = "Select file";
    can_upload_file = "yes";
}


$(".save5").click(function() {

    var dni = document.getElementById("dni");
    var dni_r = document.getElementById("dni_r");
    var profile_picture = document.getElementById("profile_picture");

    dni.removeAttribute("required");
    dni_r.removeAttribute("required");
    profile_picture.removeAttribute("required");

    dni.setAttribute(((document.getElementById("hide_dni").value == "") ? "required" : "tofill" ), "");
    dni_r.setAttribute(((document.getElementById("hide_dni_r").value == "") ? "required" : "tofill" ), "");
    profile_picture.setAttribute(((document.getElementById("hide_profile_picture").value == "") ? "required" : "tofill" ), "");

    if(can_upload_file != "yes"){

        input.disable = true;
        input.setCustomValidity("este campo aún no ha sido completado");
        window.scrollTo(0, input.offsetTop);
        input.focus();

        return false;
    }
    return true;
});