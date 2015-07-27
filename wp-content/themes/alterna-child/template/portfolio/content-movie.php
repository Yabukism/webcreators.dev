<?php
/**
 * Portfolio Item Content Movie
 *
 * @since alterna 7.0
 */
?>
<div class="alterna-title">
  <h3 class="no-border"><?php _e('映画情報' , 'alterna'); ?></h3>
  <div class="line"></div>
</div>


<dl class="dl-horizontal">
  <?php if(post_custom('wpcf-directed')): ?>
    <dt>監督</dt>
    <dd><?php echo post_custom('wpcf-directed'); ?></dd>
  <?php endif; ?>

  <?php if(post_custom('wpcf-release')): ?>
    <dt>公開日</dt>
    <dd><?php echo post_custom('wpcf-release'); ?></dd>
  <?php endif; ?>

  <?php if(post_custom('wpcf-p_country')): ?>
    <dt>製作国</dt>
    <dd><?php echo post_custom('wpcf-p_country'); ?></dd>
  <?php endif; ?>

  <?php if(post_custom('wpcf-s_country')): ?>
    <dt>舞台国</dt>
    <dd><?php echo post_custom('wpcf-s_country'); ?></dd>
  <?php endif; ?>

  <?php if(post_custom('wpcf-model')): ?>
    <dt>モデル</dt>
    <dd><?php echo types_render_field('wpcf-models'); ?></dd>
  <?php endif; ?>

  <?php if(post_custom('wpcf-winning')): ?>
    <dt>受賞</dt>
    <dd><?php echo post_custom('wpcf-winning'); ?></dd>
  <?php endif; ?>
  <?php if(post_custom('wpcf-note')): ?>
    <dt>備考</dt>
    <dd><?php echo post_custom('wpcf-note'); ?></dd>
  <?php endif; ?>
</dl>
