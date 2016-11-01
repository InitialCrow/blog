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
		},
		updateComment : function(){
			var $btn = $('.update-comment');
			var $form = $('.commentForm');
			var $originForm = $form.attr('action');
			var $commentForm = $('.comment-form');
	
			var input = "<textarea class='form-control' rows='3' name='comment' id='comment' required></textarea><button class=' submit-btn btn btn-success'>submit</button>";
			
		

			$btn.on('click', function(evt){
				evt.preventDefault()
				updateMode = true;
				$comment_val = $(this).parent().find('.comment_val').text();
				$comment_id = $(this).parent().find('.comment_val').attr('data-id');
				
				var input = "<button class='cancel btn btn-danger'>cancel</button><textarea class='form-control' rows='3' name='comment' id='comment' required>"+$comment_val+"</textarea><button class=' submit-btn btn btn-success'>update</button><input type='hidden' value="+$comment_id+" name='comment_id'>";
		
				$commentForm.empty().append(input);
				$form.attr('action','/comment_update');

				$('.cancel').on('click',function(evt){
					evt.preventDefault();
					$(this).remove();
					$('#comment').text('');
					$('#comment').attr('placeholder','write a comment...');

					$('.submit-btn').text('submit');
					$form.attr('action',$originForm);

				})
			});
			
		}
	}
	ctx.app = app;
	var self = app;
})(window, jQuery)
