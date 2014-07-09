<div>
      <input style="width:100%"
	     type="text" 
    	     id="fcc-stow-sermon-audio-file" 
	     name="fcc-stow-sermon-audio-file" />

<!--// <?php echo @get_post_meta($post->ID, 'fcc-stow-sermon-audio-file'); ?>" /> -->
      <input type="button"
	     id="fcc-stow-sermon-audio-file-button" 
	     name="fcc-stow-sermon-audio-file-button" 
	     value="Check Link" />
</div>
<script type="text/javascript">

/*
 * Attaches the image uploader to the input field
 */

jQuery(document).ready(function($){

    $('#fcc-stow-sermon-audio-file-button').click(function(){
    	var url = $("#fcc-stow-sermon-audio-file").val();
    	window.open( url );
      });

});

</script>
