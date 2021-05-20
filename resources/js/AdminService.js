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
    deleteData('/admin/x    '+elem.getAttribute('data-delete-id')).then((data)=>
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
    let password = document.querySelector('#password');
    let confirm = document.querySelector('#password_confirmation');
    let name = document.querySelector('#name');

    if(password.value!==confirm.value)
    {
        return SwalAlert('Error','Password and confirm do not match','error');
    }

    let data = new FormData();
    data.append('password',password.value);
    data.append('password_confirmation',confirm.value);
    data.append('name',name.value);
    const displayErr = document.querySelector(".display_err");
    elem.disabled=true;

    postData(data,'/admin?_method=PATCH','POST').then((data)=>
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
