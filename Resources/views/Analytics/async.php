<script type="text/javascript">
var _gaq = _gaq || [];
<?php foreach ($view['google_analytics']->getTrackers() as $tracker) : ?>
_gaq.push(function() {
  var <?php echo $tracker['name'] ?> = _gaq._createAsyncTracker('<?php echo $tracker['accountId'] ?> ','<?php echo $tracker['name'] ?>');
});

<?php if (!empty($tracker['domain'])) : ?>
   _gaq.push(['<?php echo $tracker['name'] ?>._setDomainName', '<?php echo $tracker['domain'] ?>']);
   _gaq.push(['<?php echo $tracker['name'] ?>._setAllowLinker', true]);
   _gaq.push(['<?php echo $tracker['name'] ?>._setAllowHash', false]);
<?php endif; ?>

<?php if( $view['google_analytics']->hasCustomVars()) : ?>
<?php foreach ($view['google_analytics']->getCustomVars() as $customVar) : ?>
  _gaq.push(['<?php echo $tracker['name'] ?>._setCustomVar', <?php echo $customVar['index'] ?>, '<?php echo $customVar['name'] ?>', '<?php echo $customVar['value'] ?>', <?php echo $customVar['optScope'] ?>]);
<?php endforeach; ?>
<?php endif; ?>

<?php if( $view['google_analytics']->hasPageViewQueue()) : ?>
  <?php foreach ($view['google_analytics']->getPageViewQueue() as $pageView) : ?>
    _gaq.push(['<?php echo $tracker['name'] ?>._trackPageview', '<?php echo $pageView ?>']);
  <?php endforeach; ?>
<?php endif; ?>

<?php if ($view['google_analytics']->hasCustomPageView()) : ?>
  _gaq.push(['<?php echo $tracker['name'] ?>._trackPageview', '<?php echo $view['google_analytics']->getCustomPageView() ?>']);
<?php else : ?>
  _gaq.push(['<?php echo $tracker['name'] ?>._trackPageview', '<?php echo $view['google_analytics']->getRequestUri() ?>']);
<?php endif; ?>

<?php endforeach; ?>

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
</script>
