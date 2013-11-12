<hr class="grid_16" />
<footer>
<div id="footer" class="grid_16">
	<p>
		&copy; <?php echo date('Y'); ?>. <?php bloginfo('name'); ?> | <a target="blank" href="https://github.com/lgrcyanny" title="Cyanny GitHub">GitHub</a> | <a target="blank" href="http://www.cyanny.com/feed" title="Cyanny Live RSS">RSS Feed</a>
	</p>
</div>
</footer>

<?php wp_footer(); ?>

</div>
<script type="text/javascript">
  // Cyanny fix the bug for read more link
  $j = jQuery.noConflict();
  $j(document).ready(function() {
      var brchildren = $j("div.entry a[title='Read more...']").siblings(':nth-last-child(2)').children();
      for (var i = brchildren.length - 1; i >= 5; i--) {
        brchildren[i].remove();
      }
  });
</script>

</body>
</html>