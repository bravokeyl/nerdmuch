jQuery(document).ready(function($) {

$('#commentform').validate({
 
onfocusout: function(element) {
  this.element(element);
},
 
rules: {
  author: {
    required: true,
    minlength: 2
  },
 
  email: {
    required: true,
    email: true
  },
 
  comment: {
    required: true,
    minlength: 1
  }
},
 
messages: {
  author: "Please enter in your name.",
  email: "Please enter a valid email address.",
  comment: "Message box can't be empty!"
},
 
errorElement: "div",
errorPlacement: function(error, element) {
  element.after(error);
}
 
});



})