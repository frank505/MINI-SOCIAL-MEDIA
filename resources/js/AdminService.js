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
import {getBase64, isImage} from "./FileService";
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
