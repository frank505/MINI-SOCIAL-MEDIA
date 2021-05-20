
export const postData = async(formData ,added_url,method) =>{
    let requestOptions =  {
        headers:{
            'X-CSRF-Token': $('meta[name=_token]').attr('content'),
        },
        method: method,
        body: formData
    }


    return await fetch(added_url, requestOptions).then(
        response=>{
            console.log(response)
            return  response.json();
        }
    )
}


export const deleteData = async(addedUrl) =>
{
    let requestOptions =  {
        headers:{
            'X-CSRF-Token': $('meta[name=_token]').attr('content'),
        },
        method: 'DELETE',
    }

    return await fetch(addedUrl, requestOptions).then(
        response=>{
            console.log(response)
            return  response.json();
        }
    )
}


export const getData = async(added_url) =>{

    let requestOptions = {
        headers:{
            'X-CSRF-Token': $('meta[name=_token]').attr('content'),
        },
        method: 'GET',
    }

    return await fetch(added_url, requestOptions).then(
        response=>response.json());
}









