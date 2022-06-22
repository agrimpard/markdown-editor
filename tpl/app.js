// JS all loaded
jQuery(window).on('load', function(){

	if( $('.markdown-source').length ) { // load only if source ok

		var cke_url = 'tpl/ckeditor5-34.1.0/build/ckeditor.js';
		$.getScript( cke_url, function() {

			// load cke
			ClassicEditor.create(
				document.querySelector( '.editor' ), { licenseKey: '', } 
			).then(
				editor => { window.editor = editor; }
			) .catch(
				error => { console.error( 'Oops, something went wrong!' ); }
			);

			// markdown / textarea update (setimeout -> can't find a way to do cke on loaded or on click button)
			function mkdn_copy(t) {
				setTimeout( function() {
					const editorData = editor.getData();
					$('.markdown-copy').val(editorData);
				}, t);
			}

			// markdown split / first load : cke > textarea
			mkdn_copy(1000);

			// markdown split / change : cke > textarea
			$('.app-markdown').on('keyup paste load', '.ck-editor__editable', function() {
				mkdn_copy(250);
			});
			$('.app-markdown').on('click', '.ck-button', function() {
				mkdn_copy(250);
			});

			// markdown split / change : textarea > cke
			$('.app-markdown').on('keyup paste', '.markdown-copy', function() {
				var data_copy = $('.markdown-copy').val();
				const editorData = editor.setData(data_copy);
			});

			// markdown form submit > update readme.md
			$('.app-markdown').on('click', '.markdown-form-bt button', function() {
				$('.markdown-form-bt').remove();
				$('form.markdown-form').submit();
			});

		});

	}
    
});