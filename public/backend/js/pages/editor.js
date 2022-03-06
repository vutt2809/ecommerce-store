//[editor Javascript]

//Project:	Sunny Admin - Responsive Admin Template
//Primary use:   Used only for the wysihtml5 Editor 


//Add text editor
$(function () {
    "use strict";
    CKEDITOR.replace('editor1')
    $('.textarea').wysihtml5();		
});

$(function () {
  "use strict";
  CKEDITOR.replace('editor2')
  $('.textarea').wysihtml5();		
});

