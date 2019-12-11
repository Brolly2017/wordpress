<style>
#myModal .modal-dialog{
  max-width: 625px;
}
.modal-content {
  font-family: "helvetica";
}
.modal-header,
.modal-footer {
  position: relative;
  background: #ddd8d3;
}
.modal-header .close {
  position: absolute;
  right: 10px;
  font-size: 20px;
  padding: 8px !important;
  background: #000;
  color: #fff;
  top: 17px;
  margin-left: 0 !important;
}
.close:hover {
  color: #dbd5d5 !important;
}
.full-info {
  color: #e30d0d;
}
.modal-title {
  margin-bottom: 0;
  line-height: 2;
  color: #1e1b1b;
  font-size: 18px;
  font-weight: bolder;
  margin-top: 9px;
  /* margin-left: 0; */
}
.modal-image img {
  width: 185px;
  height: 278px;
  border: none;
}
.modal-image,
.modal-details {
  display:inline-block;
  position: relative;
}
.modal-body {
  background: #ddd;
}
.modal-details {
  position: absolute;
  left: 227px;
  top: 8px;
}

.movie-title {
  font-size: 16px;
}
.overview-title,
.popularity-title,
.vote-average-title,
.vote-count-title,
.status-title,
.language-title {
  display: inline;

}
.overview-container,
.popularity-container,
.vote-average-container,
.vote-count-container,
.status-container,
.language-container {
  display: inline;
  font-size: 12px;
  color: #2d2a2a;
}
</style>
<?php 
/* Template Name: Show page */
get_header();
 if (is_user_logged_in()) : ?>
  <div class="container">
    <div class="container table-responsive">
      <table  class="table table-striped table-bordered table-hover  table-condensed">
      <caption>Movie table</caption>
        <thead>
          <tr>
            <th>Movie Title</th>
            <th>Description</th>
          </tr>
       </thead>
       <tbody>
    <?php
      $today = date('Y-m-d');
      $args = array(
        'posts_per_page' => 100,
        'post_type' => 'movie',
        'orderby' => 'publish_date',
        'order' => 'ASC',
        'date_query' => array(
          array(
            'after' => $today,
            'inclusive' => true,
            )
          ),
        'post_status' => 'published',
        );
        $result = get_posts($args);
        ?>
        <?php foreach ($result as $movie): ?>
          <tr>
            <?php $movie_post_meta = get_post_meta($movie->ID); ?>
        
            <td class="movie-title"><?php echo $movie->post_title; ?></td>
            <td class="movie-description"><?php echo $movie->post_content;?>
              <input type="hidden" class="movie-id" value="<?php echo $movie_post_meta['api_movie_id'][0];?>">
              <span class="full-info" data-toggle="modal" data-target="#myModal" >Full info</span>
            </td>
          </tr>
        <?php endforeach;?>
    </tbody>
    <?php the_posts_pagination(); ?>
      </table>
    </div>
<?php else: ?>
  <h3 class="text-center bg-danger">
    <?php echo 'You must be logged in to see the content of this page '; ?> 
  </h3>
</div>
<?php endif; ?>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="modal-image">
              <img  alt="poster image">
            </div>
            <div class="modal-details">
              <div class="modal-overview">
                <h3 class="overview-title">Overview :</h3>
                <span class="overview-container"></span>
              </div>
              <div class="modal-popularity">
                <h3 class="popularity-title">Popularity :</h3>
                <span class="popularity-container"></span>
              </div>
              <div class="modal-vote_average">
                <h3 class="vote-average-title">Vote average : </h3>
                <span class="vote-average-container"></span> 
              </div>
              <div class="modal-vote_count">
                <h3 class="vote-count-title">Vote count : </h3>
                <span class="vote-count-container"></span> 
              </div>
              <div class="modal-status">
                <h3 class="status-title">Status : </h3>
                <span class="status-container"></span> 
              </div>
              <div class="modal-language">
                <h3 class="language-title">Language : </h3>
                <span class="language-container"></span> 
              </div>
            </div>
          
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<?php get_footer(); ?>

<script>
jQuery('.full-info').click(function(){
  var elem = jQuery(this).prev().val();
  var url = 'https://api.themoviedb.org/3/movie/' + elem + '?api_key=d62f11ea5037948898652e8deb073c44&append_to_response=credits,images,videos,release_dates';
    jQuery.getJSON( url, function( data ) {
      jQuery( ".modal-title" ).html(data.original_title);
      jQuery('.modal-image img').attr('src','https://image.tmdb.org/t/p/w185'+ data.poster_path);
      jQuery('.overview-container').html(data.overview);
      jQuery('.popularity-container').html(data.popularity);
      jQuery('.vote-average-container').html(data.vote_average);
      jQuery('.vote-count-container').html(data.vote_count);
      jQuery('.status-container').html(data.status);
      jQuery('.language-container').html(data.original_language);
    });
});
</script>