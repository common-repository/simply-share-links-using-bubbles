function generateName(){
    var d = new Date().getTime();
    var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
        var r = (d + Math.random()*16)%16 | 0;
        d = Math.floor(d/16);
        return (c=='x' ? r : (r&0x3|0x8)).toString(16);
    });
    return uuid;
};
function isValid(url){
    var RegExp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;

    if(RegExp.test(url)){
        return true;
    }else{
        return false;
    }
} 
jQuery(document).ready(function($){


    $('#add_url').click(function () { 
            var name = generateName();
            var cssclass = 'urls-input';
            var value = $('#url_to_add').val();
            if(isValid(value)){
                var html = '';
                html +=   '<div  style="margin-top:20px;">';
                html +=  '<input type="text" name="' + name + '" class="' + cssclass + '" value="' + value + '" id="' + name + '" spellcheck="true" autocomplete="off" style="padding: 3px 8px;font-size: 1.7em;line-height: 100%;background-color: rgb(255, 255, 255);width: 93%;height: 35px;margin-bottom:20px;"/>';
                html += '<button >delete</button>';
                html +=  '</div>';
                $('#post').prepend(html);
            }
        });
  $('.delete').click(function () { 
      this.remove();
  });

});
         


