//nhung trinh soan thao vao text area trong createpost

CKEDITOR.replace( 'sapoPost',{
	height : 120
} );
CKEDITOR.replace( 'contentPost' ,{
	height: 500
});
//select multiple tag
$(function() {
	$('#tags').multipleSelect({
		isOpen : true
	})
})
