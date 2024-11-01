
jQuery(document).ready(function($){

 
    $('#bubble_number_of_seconds').attr('disabled',!$('#bubble_show_only_seconds').attr('checked') ); 
 
    $('#bubble_show_only_seconds').click(function () { 
            $('#bubble_number_of_seconds').attr('disabled',!$(this).attr('checked') ); 
        });
    $('#bubble_title').on('input',function(){
        $("#dynamic-title").html($(this).val());
    });
    $('#bubble_short_description').on('input',function(){
        $("#dynamic-short-description").html($(this).val());
    });
    $('#bubble_short_description2').on('input',function(){
        $("#dynamic-short-description2").html($(this).val());
    });  
        $('#bubble_type').click(function () { 
            if($(this).attr('checked') ){
                $('#dynamic-title').hide(); 
                $('#dynamic-short-description').hide(); 
                $('#dynamic-short-description2').hide(); 
                $('#dyanmic-bubble-image').hide();
                $('#ball').removeClass();
                $('#ball').addClass('ball');                
            }else{
                $('#dynamic-title').show(); 
                $('#dynamic-short-description').show(); 
                $('#dynamic-short-description2').show(); 
                $('#dyanmic-bubble-image').show();                
                $('#ball').removeClass();
                $('#ball').addClass('test');
                $('#ball').addClass('ball1');
            }
        });
        if($('#bubble_type').attr('checked')){
                $('#dynamic-title').hide(); 
                $('#dynamic-short-description').hide(); 
                $('#dynamic-short-description2').hide(); 
                $('#dyanmic-bubble-image').hide();
                $('#ball').removeClass();
                $('#ball').addClass('ball');                
                
            }else{
                $('#dynamic-title').show(); 
                $('#dynamic-short-description').show(); 
                $('#dynamic-short-description2').show(); 
                $('#dyanmic-bubble-image').show();                
                $('#ball').removeClass();
                $('#ball').addClass('test');
                $('#ball').addClass('ball1');
            }
});
         

