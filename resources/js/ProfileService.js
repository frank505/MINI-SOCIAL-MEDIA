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

$(document).on("change","#img-profile",function (e){

    const fileUpload = document.querySelector('#img-profile');
    const imgSrc = document.querySelector('.img-content');
    const previousSrc = imgSrc.src;


   if(isImage(fileUpload.files[0].name)===false)
   {
       imgSrc.src = previousSrc;
       return SwalAlert('invalid file','this is not part of the recommended images jpg, png and jpeg','error');
   }

   imgCheckWidthHeight(fileUpload,imgSrc,previousSrc);

   getBase64(fileUpload.files[0],(base64String)=>
   {
      imgSrc.src = base64String;
   });


});



$(document).on("click","#btn-submit-profile",function (e){

    let elem = e.target;
    let fileUpload = document.querySelector('#img-profile');
    let data = new FormData();
    data.append('file',fileUpload.files[0]);
    const displayErr = document.querySelector(".display_err");
    elem.disabled=true;
    postData(data,'/panel/profile/edit-profile-picture?_method=PATCH','POST').then((data)=>
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


$(document).on("click","#btn-submit-bio-data",function (e){
   let elem = e.target;
    let bioData = document.querySelector('#bio-data-text-area');
    let data = new FormData();
    data.append('message',bioData.value);
    const displayErr = document.querySelector(".display_err");
    elem.disabled=true;
    postData(data,'/panel/profile/edit-bio-message?_method=PATCH','POST').then((data)=>
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



$(document).on("click","#btn-submit-change-password",function (e){
    let elem = e.target;
    let password = document.querySelector('#password');
    let confirm = document.querySelector('#password_confirmation');
    if(password.value!==confirm.value)
    {
       return SwalAlert('Error','Password and confirm do not match','error');
    }

    let data = new FormData();
    data.append('password',password.value);
    data.append('password_confirmation',confirm.value);
    const displayErr = document.querySelector(".display_err");
    elem.disabled=true;
    postData(data,'/panel/profile/change-password-action?_method=PATCH','POST').then((data)=>
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

  $(document).on("change",".form-check-input",function (e){
      $(".form-check-input").prop('checked',false);
      $(".form-check-input").removeClass('elem_checked');
     $(this).prop('checked',true);
     e.target.classList.add('elem_checked');
  });

$(document).on("click","#btn-submit-profile-status",function (e){
    let elem = e.target;
    let data = new FormData();
    let elemChecked = document.querySelector('.elem_checked');
    data.append('profile_status',elemChecked.value);
    const displayErr = document.querySelector(".display_err");
    elem.disabled=true;
    postData(data,'/panel/profile/profile-status-action?_method=PATCH','POST').then((data)=>
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



$(document).on("click","#follow-user",function (e){

    let elem = e.target;
    let data = new FormData();
    data.append('userid',elem.getAttribute('data-user'));
    const displayErr = document.querySelector(".display_err");
    elem.disabled=true;
    postData(data,'/follow-user','POST').then((data)=>
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

});



$(document).on("click","#unfollow-user",function (e){

    let elem = e.target;
    const displayErr = document.querySelector(".display_err");
    elem.disabled=true;
   deleteData('/unfollow-user/'+elem.getAttribute('data-user')).then((data)=>
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

});


