

export const textInputLimiter = (contentId,counter,thisObject) =>
{
    const valueLength = thisObject.val().length;
    if(valueLength==0)
    {
        $(contentId).text("Characters left: " + (counter - thisObject.val().length));
    }else
    {
        $(contentId).text("Characters left: " + (counter - thisObject.val().length));
    }

}




export const reloadSamepage = (timeout)=>
{
    setTimeout(() => {
        location.reload();
    }, timeout);
}


export const hex2rgb = (hex, opacity)=> {
    var h=hex.replace('#', '');
    h =  h.match(new RegExp('(.{'+h.length/3+'})', 'g'));

    for(var i=0; i<h.length; i++)
        h[i] = parseInt(h[i].length==1? h[i]+h[i]:h[i], 16);

    if (typeof opacity != 'undefined')  h.push(opacity);

    return 'rgba('+h.join(',')+')';
}


export const errorMessage = (dataObject) =>{
    let str='';

    for(var objects in dataObject){
        if(typeof dataObject[objects][0] == 'string'){
            str+='<div class="alert alert-danger add-padding">'+' ' + dataObject[objects][0]+'</div>';
        }else{
            str+= '<div class="alert alert-danger add-padding">'+ ' ' + (dataObject[objects][0]+'</div>');
        }
    }

    return str;
}


export const displayErrorMessages = (errorResponse,displayErr) =>
{
    const lengthErrObject = Object.keys(errorResponse).length;
    if(lengthErrObject > 0)
    {
        const err = errorMessage(errorResponse);
        displayErr.innerHTML = err;
    }
}


export const httpResponseCreateOrUpdateData = (data,displayErr) =>
{
    if(data.success==false && data.hasOwnProperty("error"))
    {
        let errorMessage = data.error;
        displayErrorMessages(errorMessage,displayErr);
        return false;

    }else if(data.success==false && !data.hasOwnProperty('error'))
    {
        if(data.message=='Unauthenticated')
        {
            window.location = "/login";

        }else
            {
                swal(data.message);
                return false;
            }
        swal(data.message);
    }
    else if(data.success==true)
    {

        swal(data.message);
        return true;
        // reloadSamepage(1000);

    }
    $(".large-spinner").hide();
    swal(data.message);
}


export const genericErrorResponse = () =>
{
    $(".large-spinner").hide();
    swal("there seems to be a problem please refresh your browser");
}


export const deleteSuccessResponse = (data,timeIntervalPageRefresh) =>
{
    if(data.success==true)
    {
        $(".large-spinner").hide();
        swal(data.message);
        reloadSamepage(timeIntervalPageRefresh);
    }
    swal(data.message);
}




export const SwalAlert = (title,text,icon) =>
{
    return  swal({
        title: title,
        text: text,
        icon: icon,
        button: true
    })

}

export const imgCheckWidthHeight = async(file,imgSrc,prevSrc) =>
{
        let img = new Image();
        let returnValue = false;
        let width = 0;

        img.src = window.URL.createObjectURL(file.files[0]);
        img.onload = () => {
            if(img.width < 100 || img.height < 100){

               file.value="";
               imgSrc.src="";
               imgSrc.src= prevSrc;

                return SwalAlert('invalid file',
                    'this image width or height is less than 100 only images with with and height above 100 are allowed',
                    'error');

            }


        }



}


