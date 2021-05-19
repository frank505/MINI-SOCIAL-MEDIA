/**
 * adding a new pricing data
 */
import {genericErrorResponse, httpResponseCreateOrUpdateData, imgCheckWidthHeight, SwalAlert} from "./HelperService";
import {getBase64, isImage} from "./FileService";
import {postData} from "./HttpService";

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

    let fileUpload = document.querySelector('#img-profile');
    let data = new FormData();
    data.append('file',fileUpload.files[0]);
    const displayErr = document.querySelector(".display_err");
    e.target.setAttribute('disabled',true);
    postData(data,'/edit-profile-picture?_method=PATCH','POST').then((data)=>
    {
        e.target.setAttribute('disabled',false);
        httpResponseCreateOrUpdateData(data,displayErr);
    },
        error=>{
            console.log(error);
            genericErrorResponse();
        }
        )

});
