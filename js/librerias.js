consultarPHP=function(url,datos,tipo){
    var retorno;
    $.ajax({
        async       : false,
        type        : "POST",
        url         : url,
        dataType    : tipo,
        data        : datos,
        success     : function(data){
            retorno = data;
        }
    });

    return retorno;
};

cargando=function(selector){
    $(selector).css('background',"url('../../images/loading.gif') no-repeat center center");
};

noCargando=function(selector){
    $(selector).css('background',"");
};
