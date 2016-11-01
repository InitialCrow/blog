(function(ctx, $){
	var app = {
		init:function(){
			this.alert_msg();
			
		},
		alert_msg : function(){
			$(".close").on('click',function(){
				$(".alert").alert();
			});
		},
		show_editor : function(){
			var editor = CKEDITOR.replace( 'editor',{
				removePlugins: 'sourcearea, save',

			} );
			editor.on( 'required', function( evt ) {
			    alert( 'Article content is required.' );
			    evt.cancel();
			} );
		}
	}
	ctx.app = app;
	var self = app;
})(window, jQuery)
