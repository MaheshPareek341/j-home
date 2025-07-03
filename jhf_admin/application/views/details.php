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
		<div class="container">
			<div class="e-con-inner" style="padding-top:5%">
			    <div class="row"><h2 style="text-align:center; color:white; width:100%"><a href="#"><?=$song_data[0]->song_name?></a></h2></div>
			    
			        <?php 
			        //echo "<pre>"; print_r($song_data); exit;
			       
			        list($videoUrl,$videoId) = explode('?v=',$song_data[0]->youtube_url);
				    //$videoImg = 'https://img.youtube.com/vi/'.$videoId.'/mqdefault.jpg';
			        ?>
		                <div class="row">
		                    <!--<h3 style="color:white; width:100%; margin:0px; padding:15px"><?=$song_data[0]->song_name?></h3>-->
		               <iframe width="100%" height="600" src="https://www.youtube.com/embed/<?=$videoId?>?autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
	</div>
			           
				
			        <!--<div class="col-md-3">-->
			            
			        <!--</div>-->
			    </div>
               
			</div>
		</div>
	
	</div>
	<!--LWSOPTIMIZE_HERE_START_FOOTER-->
	<?php include "common/frontend/footer.php" ?>