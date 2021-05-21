/**
 * adding a new pricing data
 */
import {
    genericErrorResponse,
    httpResponseCreateOrUpdateData,
    imgCheckWidthHeight,
    reloadSamepage,
    SwalAlert
} from "./HelperService";
import {deleteData, postData} from "./HttpService";


$(document).on("click","#btn-submit-user-create",function (e){
    let elem = e.target;
    let password = document.querySelector('#password');
    let confirm = document.querySelector('#password_confirmation');
    let email = document.querySelector('#email');
    let username = document.querySelector('#username');
    let name = document.querySelector('#name');
    if(password.value!==confirm.value)
    {
        return SwalAlert('Error','Password and confirm do not match','error');
    }

    let data = new FormData();
    data.append('password',password.value);
    data.append('password_confirmation',confirm.value);
    data.append('username',username.value);
    data.append('email',email.value);
    data.append('name',name.value);
    const displayErr = document.querySelector(".display_err");
    elem.disabled=true;

    postData(data,'/admin','POST').then((data)=>
        {
            elem.disabled=false;
            httpResponseCreateOrUpdateData(data,displayErr);
        },
        error=>{
            console.log(error);
            genericErrorResponse();
        }
    )

});



$(document).on('click','.delete-user',function(e)
{
    let elem = e.target;
    const displayErr = document.querySelector(".display_err");
    elem.disabled=true;
    deleteData('/admin/'+elem.getAttribute('data-delete-id')).then((data)=>
        {
            elem.disabled=false;
            let ResBool = httpResponseCreateOrUpdateData(data,displayErr);
            if(ResBool == true)
            {
                reloadSamepage(100);
            }

        },
        error=>{
            console.log(error);
            genericErrorResponse();
        }
    )

})




$(document).on("click","#btn-submit-user-edit",function (e){

    let elem = e.target;

    let name = document.querySelector('#name');
    let fileUpload = document.querySelector('#img-profile');
    let bio = document.querySelector('#bio-edit');
    let contentEditId = document.querySelector("#content-edit-id");

    let data = new FormData();
    data.append('name',name.value);
    fileUpload.value!=='' ? data.append('file',fileUpload.files[0]) : '';
    data.append('bio',bio.value);
    const displayErr = document.querySelector(".display_err");
    elem.disabled=true;
    postData(data,'/admin/'+contentEditId.value+'/?_method=PATCH','POST').then((data)=>
        {
            elem.disabled=false;
            httpResponseCreateOrUpdateData(data,displayErr);
        },
        error=>{
            console.log(error);
            genericErrorResponse();
        }
    )

});
