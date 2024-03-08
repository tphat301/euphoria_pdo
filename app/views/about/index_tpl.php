<?= $share->main('app/views/partials/breadcrumb.php'); ?>
<h2 class="wp-content title-detail-news text-center uppercase mt-4 text-3xl">
  <?= $about['title'] ?>
</h2>
<div class="wp-content mt-3 mb-3">
  <?= htmlspecialchars_decode($about['content']) ?>
</div>

<?php if (!Functions::isGoogleSpeed()) { ?>
  <div class="wp-content mt-3 mb-3">
    <div class="share p-2 rounded-md bg-gray-200">
      <strong>Chia sẻ:</strong>
      <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
        <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
        <a class="a2a_button_facebook"></a>
        <a class="a2a_button_email"></a>
        <a class="a2a_button_telegram"></a>
        <a class="a2a_button_twitter"></a>
        <a class="a2a_button_skype"></a>
        <a class="a2a_button_linkedin"></a>
      </div>
      <script async src="https://static.addtoany.com/menu/page.js"></script>
    </div>
  </div>
<?php } ?>