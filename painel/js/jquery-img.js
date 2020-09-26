function previewImagem(){
    var imagem = document.querySelector('input[name=logo]').files[0];
    var preview = document.querySelector('.img-logo');
    
    var reader = new FileReader();
    
    reader.onloadend = function () {
        preview.src = reader.result;
    }
    
    if(imagem){
        reader.readAsDataURL(imagem);
    }else{
        preview.src = "";
    }
}