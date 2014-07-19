<?php 
  $audio_file=get_post_meta($post->ID, 'fcc-stow-sermon-audio-file', true); ?>
<div id="fcc-stow-sermon-selected-audio-file-container">
  <div>Selected Audio File:</div>
  <?php if ( !empty($audio_file) ) : ?>
  <input class="fcc-stow-sermon-selected-audio-file" 
         name="fcc-stow-sermon-selected-audio-file" 
         id="fcc-stow-sermon-selected-audio-file"
         value=<?php echo basename($audio_file["file"]); ?> 
         type="text"  
         readonly="readonly" />
  <input class="fcc-stow-sermon-remove-audio-file" 
         name="fcc-stow-sermon-remove-audio-file" 
         id="fcc-stow-sermon-remove-audio-file"
         value="remove"
         type="checkbox">
    Remove Audio File?
  </input>
  <?php endif ?>
    <div>Upload <?php echo isset($audio_file) ? "New" : "" ?> Sermon Audio File</div>
  <input style="width:100%"
	 type="file" 
    	 id="fcc-stow-sermon-upload-audio-file" 
	 name="fcc-stow-sermon-upload-audio-file"
    	 class="fcc-stow-sermon-upload-audio-file" 
	 accept=".mp3,.mp4,.mpg,.mpeg" />
</div>
  
