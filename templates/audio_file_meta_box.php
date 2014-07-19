<div id="fcc-stow-sermon-selected-audio-file-container">
<?php 
$input_tag_html="Upload Sermon Audio File
      <input style=\"width:100%\"
	     type=\"file\" 
    	     id=\"fcc-stow-sermon-audio-file\" 
	     name=\"fcc-stow-sermon-audio-file\"
	     value=\"\" />";
$audio_file=get_post_meta($post->ID, 'fcc-stow-sermon-audio-file', true);
if ( isset($audio_file) ) : ?>
  Sermon Audio File
  <div><?php echo basename($audio_file["file"]) ?></div>
  <button id="fcc-stow-sermon-pick-new-file-button">Pick a new file</button>
<?php else : echo $input_tag_html ?>
<?php endif ?>
</div>
<script type="text/javascript">
jQuery(document).ready(function($){

    $('#fcc-stow-sermon-pick-new-file-button').click(function(){
    
       window.open( url );
      });

});
</script>
