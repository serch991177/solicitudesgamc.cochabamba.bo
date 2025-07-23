<!-- <footer>
   <div id="footer">
      <a target="_blank" href="http://www.cochabamba.bo">
         <img style="width: 8%" src="<?= base_url('public/images/logo_p.png'); ?>" alt="">
      </a>
   </div>
</footer> -->
</div>

<script src="<?= base_url('node_modules/what-input/dist/what-input.js') ?>"></script>


<script>
   $(document).foundation();
   $('.title-bar').on('sticky.zf.stuckto:top', function() {
      $(this).addClass('shrink');
   }).on('sticky.zf.unstuckfrom:top', function() {
      $(this).removeClass('shrink');
   });
</script>

<script>
   $('#responsiveTabsDemo').responsiveTabs({
      startCollapsed: 'accordion'
   });
</script>

</body>

</html>