<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
get_header();

// Start the loop.
while ( have_posts() ) : the_post();

$S = get_post_meta(get_the_ID(), 's', true);
    $SS = get_post_meta(get_the_ID(), 'ss', true);
    $SD = get_post_meta(get_the_ID(), 'sd', true);
      $SSS = get_post_meta(get_the_ID(), 'sss', true);
      $SSD = get_post_meta(get_the_ID(), 'ssd', true);
      $SDS = get_post_meta(get_the_ID(), 'sds', true);
      $SDD = get_post_meta(get_the_ID(), 'sdd', true);
        $SSSS = get_post_meta(get_the_ID(), 'ssss', true);
        $SSSD = get_post_meta(get_the_ID(), 'sssd', true);
        $SSDS = get_post_meta(get_the_ID(), 'ssds', true);
        $SSDD = get_post_meta(get_the_ID(), 'ssdd', true);
        $SDSS = get_post_meta(get_the_ID(), 'sdss', true);
        $SDSD = get_post_meta(get_the_ID(), 'sdsd', true);
        $SDDS = get_post_meta(get_the_ID(), 'sdds', true);
        $SDDD = get_post_meta(get_the_ID(), 'sddd', true);

$D = get_post_meta(get_the_ID(), 'd', true);
  $DS = get_post_meta(get_the_ID(), 'ds', true);
  $DD = get_post_meta(get_the_ID(), 'dd', true);
    $DSS = get_post_meta(get_the_ID(), 'dss', true);
    $DSD = get_post_meta(get_the_ID(), 'dsd', true);
    $DDS = get_post_meta(get_the_ID(), 'dds', true);
    $DDD = get_post_meta(get_the_ID(), 'ddd', true);
      $DSSS = get_post_meta(get_the_ID(), 'dsss', true);
      $DSSD = get_post_meta(get_the_ID(), 'dssd', true);
      $DSDS = get_post_meta(get_the_ID(), 'dsds', true);
      $DSDD = get_post_meta(get_the_ID(), 'dsdd', true);
      $DDSS = get_post_meta(get_the_ID(), 'ddss', true);
      $DDSD = get_post_meta(get_the_ID(), 'ddsd', true);
      $DDDS = get_post_meta(get_the_ID(), 'ddds', true);
      $DDDD = get_post_meta(get_the_ID(), 'dddd', true);

echo horse_image_slider(get_the_ID());
?>
<div class="product-name">
  <div class="row full-row name">
    <div class="medium-12 profile centered columns">
        <div class="wrapper">
          <h3><?php echo the_title();?></h3>
          <p>(<?php echo $S ?> X <?php echo $D ?>)</p>
        </div>
    </div>
  </div>
</div>
<div class="main-content">
  <div class="row">
    <div class="medium-10 medium-push-1 columns">
      <div class="horse-bio">
        <?php //print_r( get_post_meta( get_the_ID() ) )?>
        <h2>
          <?php 
            $color_id = unserialize(get_post_meta( get_the_ID() )['_data_horse_color'][0])[0];
            $breed_id = unserialize(get_post_meta( get_the_ID() )['_data_horse_breed'][0])[0];
            $gender_id = unserialize(get_post_meta( get_the_ID() )['_data_horse_gender'][0])[0];
            $color_name = get_term($color_id, 'horse-color')->name;
            $breed_name = get_term($breed_id, 'horse-breed')->name;
            $gender_name = get_term($gender_id, 'horse-gender')->name;

            echo get_post_meta( get_the_ID() )['_data_horse_year_foaled'][0]." ".$color_name." ".$breed_name." ".$gender_name;
          ?>
        </h2>
        <?php the_content() ?>
      </div>
    </div>
  </div>
</div>
<div class="area-video">
    <div class="owl-init owl-carousel video row full-row">
      <?php echo  get_post_meta( get_the_ID(), '_data_horse_video', true ); ?>
  </div>
</div>
<?php echo list_progeny(get_the_ID()); ?>
<div id="pedigree" class="table-details">
  <div class="row">
    <h2 class="subsection">Pedigree</h2>
  </div>
  <div class="row">
    <div class="medium-12 columns">
      <div class="row eq-parent sire">
        <div class="medium-3 small-3 columns">
          <table class="eq-child top-border grey">
            <tr>
              <td class="ped-s ped-bordered"><span class="ped-pill"><?php echo $S;?></span></td>
            </tr>
          </table>
        </div>
        <div class="medium-3 small-3 columns">
          <table class="eq-child top-border grey">
            <tr>
              <td class="ped-s ped-bordered"><span class="ped-pill"><?php echo $SS;?></span></td>
            </tr>
            <tr>
              <td class="ped-d ped-bordered"><span class="ped-pill"><?php echo $SD;?></span></td>
            </tr>
          </table>
        </div>
        <div class="medium-3 small-3 columns">
          <table class="eq-child top-border grey">
            <tr>
              <td class="ped-s ped-bordered"><span class="ped-pill"><?php echo $SSS;?></span></td>
            </tr>
            <tr>
              <td class="ped-d ped-bordered"><span class="ped-pill"><?php echo $SSD;?></span></td>
            </tr>
            <tr>
              <td class="ped-s ped-bordered"><span class="ped-pill"><?php echo $SDS;?></span></td>
            </tr>
            <tr>
              <td class="ped-d ped-bordered"><span class="ped-pill"><?php echo $SDD;?></span></td>
            </tr>
            </table>
        </div>
        <div class="medium-3 small-3 columns">
          <table class="eq-child top-border grey">
            <tr>
              <td class="ped-s ped-bordered"><span class="ped-pill"><?php echo $SSSS;?></span></td>
            </tr>
            <tr>
              <td class="ped-d ped-bordered"><span class="ped-pill"><?php echo $SSSD;?></span></td>
            </tr>
            <tr>
              <td class="ped-s ped-bordered"><span class="ped-pill"><?php echo $SSDS;?></span></td>
            </tr>
            <tr>
              <td class="ped-d ped-bordered"><span class="ped-pill"><?php echo $SSDD;?></span></td>
            </tr>
            <tr>
              <td class="ped-s ped-bordered"><span class="ped-pill"><?php echo $SDSS;?></span></td>
            </tr>
            <tr>
              <td class="ped-d ped-bordered"><span class="ped-pill"><?php echo $SDSD;?></span></td>
            </tr>
            <tr>
              <td class="ped-s ped-bordered"><span class="ped-pill"><?php echo $SDDS;?></span></td>
            </tr>
            <tr>
              <td class="ped-d ped-bordered"><span class="ped-pill"><?php echo $SDDD;?></span></td>
            </tr>
            </table>
        </div>
      </div>
      <div class="row eq-parent dam">
        <div class="medium-3 small-3 columns">
          <table class="eq-child top-border grey">
            <tr>
              <td class="ped-d"><span class="ped-pill"><?php echo $D;?></span></td>
            </tr>
          </table>
        </div>
        <div class="medium-3 small-3 columns">
          <table class="eq-child top-border grey">
            <tr>
              <td class="ped-s ped-bordered"><span class="ped-pill"><?php echo $DS;?></span></td>
            </tr>
            <tr>
              <td class="ped-d"><span class="ped-pill"><?php echo $DD;?></span></td>
            </tr>
          </table>
        </div>
        <div class="medium-3 small-3 columns">
          <table class="eq-child top-border grey">
            <tr>
              <td class="ped-s ped-bordered"><span class="ped-pill"><?php echo $DSS;?></span></td>
            </tr>
            <tr>
              <td class="ped-d ped-bordered"><span class="ped-pill"><?php echo $DSD;?></span></td>
            </tr>
            <tr>
              <td class="ped-s ped-bordered"><span class="ped-pill"><?php echo $DDS;?></span></td>
            </tr>
            <tr>
              <td class="ped-d"><span class="ped-pill"><?php echo $DDD;?></span></td>
            </tr>
            </table>
        </div>
        <div class="medium-3 small-3 columns">
          <table class="eq-child top-border grey">
            <tr>
              <td class="ped-s ped-bordered"><span class="ped-pill"><?php echo $DSSS;?></span></td>
            </tr>
            <tr>
              <td class="ped-d ped-bordered"><span class="ped-pill"><?php echo $DSSD;?></span></td>
            </tr>
            <tr>
              <td class="ped-s ped-bordered"><span class="ped-pill"><?php echo $DSDS;?></span></td>
            </tr>
            <tr>
              <td class="ped-d ped-bordered"><span class="ped-pill"><?php echo $DSDD;?></span></td>
            </tr>
            <tr>
              <td class="ped-s ped-bordered"><span class="ped-pill"><?php echo $DDSS;?></span></td>
            </tr>
            <tr>
              <td class="ped-d ped-bordered"><span class="ped-pill"><?php echo $DDSD;?></span></td>
            </tr>
            <tr>
              <td class="ped-s ped-bordered"><span class="ped-pill"><?php echo $DDDS;?></span></td>
            </tr>
            <tr>
              <td class="ped-d"><span class="ped-pill"><?php echo $DDDD;?></span></td>
            </tr>
            </table>
        </div>
      </div>
      <?php echo do_shortcode('[social_icons]'); ?>
    </div>
  </div>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>
