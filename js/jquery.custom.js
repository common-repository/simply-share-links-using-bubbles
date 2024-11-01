
function BubbleColor(color,a){
    this.color = color;
    this.rgbColor = '';
    this.rgbArr = {};
    this.a = a;
    
}
BubbleColor.prototype.getColor = function()
{
    return "rgba("+parseInt(this.rgbArr[1], 16)+","+parseInt(this.rgbArr[2], 16)+","+parseInt(this.rgbArr[3], 16)+"," + this.a +")" ;
}
BubbleColor.prototype.init = function()
{
    var patt = /^#([\da-fA-F]{2})([\da-fA-F]{2})([\da-fA-F]{2})$/;
    this.rgbArr = patt.exec(this.color);  
    this.rgbColor = this.getColor();
}

function BubbleBackground(cs1,cs2,ce2){
    this.newDesign = "   display: inline-block;  width: 100%;  height: 100%;  margin: 0;  border-radius: 50%;  position: relative;  background: -webkit-gradient(radial, 50% 55%, 0, 50% 55%, 100, color-stop(0%, c_s_1), color-stop(40%, c_s_1), color-stop(60%, c_s_2), color-stop(100%, c_e_2));  background: -webkit-radial-gradient(50% 55%, circle cover, c_s_1, c_s_1 40%, c_s_2 60%, c_e_2);  background: -moz-radial-gradient(50% 55%, circle cover, c_s_1, c_s_1 40%, c_s_2 60%, c_e_2);  background: -o-radial-gradient(50% 55%, circle cover, c_s_1, c_s_1 40%, c_s_2 60%, c_e_2);  background: radial-gradient(50% 55%, circle cover, c_s_1, c_s_1 40%, c_s_2 60%, c_e_2);  -webkit-animation: bubble-anim 2s ease-out infinite;  -moz-animation: bubble-anim 2s ease-out infinite;  -o-animation: bubble-anim 2s ease-out infinite;  -ms-animation: bubble-anim 2s ease-out infinite;  animation: bubble-anim 2s ease-out infinite;";
    this.cs1 = new BubbleColor(cs1,'0.9') ;
    //this.cs11 = new BubbleColor(cs11,'0.9') ;
    this.cs2 = new BubbleColor(cs2,'0.8');
    this.ce2 = new BubbleColor(ce2,'0.4');
    this.cs1.init();
    this.cs2.init();
    this.ce2.init();
    //this.cs11.init();
}
BubbleBackground.prototype.getDesign = function()
{
    this.newDesign = this.newDesign.replace(/c_s_1/g, this.cs1.rgbColor);
    this.newDesign = this.newDesign.replace(/c_s_2/g, this.cs2.rgbColor);
    this.newDesign = this.newDesign.replace(/c_e_2/g, this.ce2.rgbColor);
    //this.newDesign = this.newDesign.replace(/c_s_11/g, this.cs11.rgbColor);
    return this.newDesign;
}
function guid() {
  function s4() {
    return Math.floor((1 + Math.random()) * 0x10000)
      .toString(16)
      .substring(1);
  }
  return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
    s4() + '-' + s4() + s4() + s4();
}
jQuery(document).ready(function($){
var opciones = {
    // Podemos declarar un color por defecto aquí
    // o en el atributo del input data-default-color
    defaultColor: false,
    // llamada que se lanzará cuando el input tenga un color válido
    change: function(event, ui){ 
        setTimeout(function(){
            $('#ball').removeClass('ball');
            var style = new BubbleBackground($('#bubble_cs_1').val(),
            $('#bubble_cs_2').val(),$('#bubble_ce_2').val());
            var uuid = 'a' + guid();
            console.log(uuid);
            $("<style type='text/css'>  ."+ uuid +"{ " +style.getDesign() + "}  </style>").appendTo("head");

           $('#ball').addClass(uuid);
            //$('#ball').attr('style',style.getDesign());            
        },200);
    },
    clear: function() {},
    hide: true,
    palettes: true
};
    $('.colorpicker').wpColorPicker(opciones);
    $('.colors-prefiled').click(function(){
       var name = ($(this).attr('id'));    
        $('#bubble_cs_1').val($('#' + name + '-color-1').val());
        $('#bubble_cs_2').val($('#' + name + '-color-2').val());
        $('#bubble_ce_2').val($('#' + name + '-color-3').val());
        $('.colorpicker').change();
    });

});
         
