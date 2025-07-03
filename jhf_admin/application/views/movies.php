<style>
    .success-msg {
          color: #270;
          background-color: #DFF2BF;
          padding:6px;
        }
        .thumb {
          position: absolute;
          /*top: 50%; left: 50%;*/
          bottom:0px; left:15%;
          transform: translate(-50%,-50%);
          width: 50px;
          height: 50px;
}
</style>
<?php include "common/frontend/header.php" ?>
	<div data-elementor-type="wp-page" data-elementor-id="17024" class="elementor elementor-17024"
		data-elementor-post-type="page">
		<div class="elementor-element elementor-element-7c3221c4 e-flex e-con-boxed e-con e-parent" data-id="7c3221c4"
			data-element_type="container">
			<div class="e-con-inner" style="padding-top:5%">
			    <div class="row"><h2 style="text-align:center; color:white; width:100%"><a href="#">Movies & Documentaries</a></h2></div>
			    
			        <?php 
			        //echo "<pre>"; print_r($movie_data); exit;
			        foreach ($movie_data as $moviedata) {  ?>
			            <?php if(count($moviedata['movie'])>0){ ?>
			                <div class="row">
			                    <h3 style="color:white; width:100%; margin:0px; padding:15px"><?=$moviedata['name']?></h3>
			                    <?php foreach ($moviedata['movie'] as $moviesdata) {
			                    list($videoUrl,$videoId) = explode('?v=',$moviesdata->youtube_url);
									$videoImg = 'https://img.youtube.com/vi/'.$videoId.'/mqdefault.jpg';
			                    ?>
            						<div class="col-md-3" style="float: left; margin-bottom:20px">
            							<!--<iframe width="359px" height="200px" src="<?=$moviesdata->youtube_url;?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen style="border-radius:15px"></iframe>-->
            						<img src="<?php echo $videoImg;?>">
            						<a href="<?=base_url()?>movie/<?=$moviesdata->song_url?>"><img src="<?=base_url()?>assets/play.png" class="thumb"></a>
            						</div>
    					        <?php } ?>
    				        </div>
			            <?php } ?>
					<?php } ?>
			        <!--<div class="col-md-3">-->
			            
			        <!--</div>-->
			    </div>
               
			</div>
		</div>
	
	</div>
	<!--LWSOPTIMIZE_HERE_START_FOOTER-->
	<?php include "common/frontend/footer.php" ?>