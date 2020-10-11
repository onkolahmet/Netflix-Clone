<?php
$hideNav = true ;
require_once("includes/header.php");

if(!isset($_GET["id"])) {
    ErrorMessage::show("No ID passed into page.");
 }


 $video = new Video($con, $_GET["id"]);
 $video->incrementViews();


 $seasonEpisode = $video->getSeasonAndEpisode();
 $subHeading = $video->isMovie() ? "": "<h4>$seasonEpisode</h4>"; 
 
 $upNextVideo =  VideoProvider::getUpNext($con, $video);
?>

<div class="watchContainer">

     <div class="videoControls watchNav">
            
            <button onClick="goBack()"><i class="fas fa-arrow-left"></i></button>
            <div>
            <h1><?php echo $video->getTitle(); ?></h1> 
            <?php echo $subHeading; ?>
            </div>
     </div>

     <div class="videoControls upNext" style="display:none;">
            <button onClick="restartVideo();"><i class="fas fa-redo"></i></button>
            
            <div class="upNextContainer">
                <h2>Up next:</h2>
                <h3><?php echo $upNextVideo->getTitle(); ?></h3>
                <h3><?php echo $upNextVideo->getSeasonAndEpisode(); ?></h3>
                <button class="playNext" onClick="watchVideo(<?php echo $upNextVideo->getId(); ?>)"><i class="fas fa-play"></i> Play</button>
            </div>

     </div>   

    <video controls autoplay onended="showUpNext()">
        <source src='<?php echo $video->getFilePath(); ?>' type="video/mp4">
</div>

<script>
    initVideo("<?php echo $video->getId(); ?>",  "<?php echo $userLoggedIn; ?>");
</script>