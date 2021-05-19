export const getBase64 = (file,callback) => {
    const reader = new FileReader();
    reader.addEventListener('load',()=>callback(reader.result));
    reader.readAsDataURL(file);
}

/**
 * get file extension
 */
export const getExtension = (filename)=> {
    var parts = filename.split('.');
    return parts[parts.length - 1];
}
/**
 * check if this file is an image
 */

export const isImage = (filename)=>{
    var ext = getExtension(filename);
    switch (ext.toLowerCase()) {
        case 'jpg':
        case 'gif':
        case 'bmp':
        case 'png':
        case 'jpeg':
            //etc
            return true;
    }
    return false;
}
/**
 * check if this file is a video
 */
export const  isVideo = (filename) =>{
    var ext = getExtension(filename);
    switch (ext.toLowerCase()) {
        case 'm4v':
        case 'avi':
        case 'mpg':
        case 'mp4':
            // etc
            return true;
    }
    return false;
}

