<?php
if (!defined('BLUDIT')) {
	exit(0);
}

$whatsappNumber = '';
$instagramUrl = '';
$facebookUrl = '';
$whatsappMessage = 'Merhaba, randevu oluşturmak istiyorum.';
$whatsappDigits = preg_replace('/\D+/', '', $whatsappNumber);
$whatsappUrl = 'https://wa.me/' . $whatsappDigits . '?text=' . rawurlencode($whatsappMessage);
$escape = static function ($value) {
	return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
};
$campaignCategories = array('kampanya', 'kampanyalar', 'campaign', 'campaigns');
$blogCategories = array('blog', 'yazilar', 'yazılar');
$isCampaign = static function ($listedPage) use ($campaignCategories) {
	return in_array(mb_strtolower((string) $listedPage->category()), $campaignCategories, true);
};
$isBlog = static function ($listedPage) use ($blogCategories) {
	return in_array(mb_strtolower((string) $listedPage->category()), $blogCategories, true);
};
$renderCards = static function ($pages, $matches, $emptyMessage) use ($escape) {
	$count = 0;
	foreach ($pages as $listedPage) {
		if (!$matches($listedPage)) {
			continue;
		}
		$count++;
		if ($count > 3) {
			break;
		}
		?>
		<article class="content-card">
			<a class="content-card__link" href="<?php echo $escape($listedPage->permalink()); ?>">
				<h3><?php echo $escape($listedPage->title()); ?></h3>
			</a>
			<p><?php echo $escape($listedPage->description()); ?></p>
			<a class="text-link" href="<?php echo $escape($listedPage->permalink()); ?>">Devamını oku <span aria-hidden="true">→</span></a>
		</article>
		<?php
	}
	if ($count === 0) {
		echo '<p class="empty-message">' . $escape($emptyMessage) . '</p>';
	}
};
?>
<!doctype html>
<html lang="tr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php Theme::metaTags('title'); ?>
	<?php echo Theme::css('css/style.css'); ?>
	<?php Theme::plugins('siteHead'); ?>
</head>
<body>
	<?php Theme::plugins('siteBodyBegin'); ?>
	<header class="site-header">
		<div class="container header-inner">
			<a class="brand" href="<?php echo $escape($site->url()); ?>">
				<span class="brand__mark" aria-hidden="true">G</span>
				<span><?php echo $escape($site->title()); ?></span>
			</a>
			<nav class="main-nav" aria-label="Ana menü">
				<a href="<?php echo $escape($site->url()); ?>">Ana sayfa</a>
				<a href="<?php echo $escape($site->url()); ?>#kampanyalar">Kampanyalar</a>
				<a href="<?php echo $escape($site->url()); ?>#blog">Blog</a>
				<a href="<?php echo $escape($site->url()); ?>#iletisim">İletişim</a>
			</nav>
			<a class="button button--small" href="<?php echo $escape($whatsappUrl); ?>" target="_blank" rel="noopener noreferrer">WhatsApp’tan randevu</a>
		</div>
	</header>

	<main>
		<?php if ($WHERE_AM_I === 'home') : ?>
			<section class="hero">
				<div class="container hero__inner">
					<div class="hero__copy">
						<p class="eyebrow">Kendinize ayırdığınız en güzel zaman</p>
						<h1>Güzelliğiniz, <span>özenli dokunuşlarla</span> ortaya çıksın.</h1>
						<p class="hero__description"><?php echo $escape($site->slogan()); ?></p>
						<a class="button" href="<?php echo $escape($whatsappUrl); ?>" target="_blank" rel="noopener noreferrer">WhatsApp’tan randevu oluştur <span aria-hidden="true">↗</span></a>
					</div>
					<div class="hero__art" aria-hidden="true">
						<div class="hero__circle"><span>Güzel<br>hisset.</span></div>
						<div class="hero__sparkle">✳</div>
					</div>
				</div>
			</section>
			<section class="intro container">
				<p class="eyebrow">Güzellik ve bakım</p>
				<h2>Size iyi hissettiren küçük bir mola.</h2>
				<p>Saç bakımından güzellik uygulamalarına, kendinizi özel hissetmeniz için buradayız.</p>
			</section>
			<section class="content-section container" id="kampanyalar">
				<div class="section-heading">
					<div><p class="eyebrow">Size özel fırsatlar</p><h2>Kampanyalar</h2></div>
					<span class="section-heading__icon" aria-hidden="true">✳</span>
				</div>
				<div class="card-grid">
					<?php $renderCards($content, $isCampaign, 'Yeni kampanyalarımız çok yakında burada.'); ?>
				</div>
			</section>
			<section class="content-section content-section--tinted" id="blog">
				<div class="container">
					<div class="section-heading">
						<div><p class="eyebrow">Bakım notları</p><h2>Blog</h2></div>
						<span class="section-heading__icon" aria-hidden="true">✿</span>
					</div>
					<div class="card-grid">
						<?php $renderCards($content, $isBlog, 'Güzellik ve bakım yazılarımız çok yakında burada.'); ?>
					</div>
				</div>
			</section>
		<?php elseif ($WHERE_AM_I === 'page') : ?>
			<section class="page-heading">
				<div class="container">
					<p class="eyebrow">Güzellik ve bakım</p>
					<h1><?php echo $escape($page->title()); ?></h1>
				</div>
			</section>
			<article class="container page-content">
				<?php echo $page->content(); ?>
			</article>
		<?php else : ?>
			<section class="page-heading">
				<div class="container">
					<p class="eyebrow">Güzellik ve bakım</p>
					<h1><?php echo $escape($site->title()); ?></h1>
				</div>
			</section>
			<section class="container listing">
				<?php foreach ($content as $listedPage) : ?>
					<article class="content-card">
						<a class="content-card__link" href="<?php echo $escape($listedPage->permalink()); ?>">
							<h2><?php echo $escape($listedPage->title()); ?></h2>
						</a>
						<p><?php echo $escape($listedPage->description()); ?></p>
						<a class="text-link" href="<?php echo $escape($listedPage->permalink()); ?>">Devamını oku <span aria-hidden="true">→</span></a>
					</article>
				<?php endforeach; ?>
			</section>
		<?php endif; ?>
		<section class="contact-section" id="iletisim">
			<div class="container contact-section__inner">
				<div><p class="eyebrow">Kendinize bir iyilik yapın</p><h2>Bir sonraki randevunuz için bize yazın.</h2></div>
				<a class="button button--light" href="<?php echo $escape($whatsappUrl); ?>" target="_blank" rel="noopener noreferrer">WhatsApp’tan randevu oluştur <span aria-hidden="true">↗</span></a>
			</div>
		</section>
	</main>

	<footer class="site-footer">
		<div class="container footer-inner">
			<p>© <?php echo date('Y'); ?> <?php echo $escape($site->title()); ?></p>
			<div class="social-links">
				<?php if ($instagramUrl !== '') : ?><a href="<?php echo $escape($instagramUrl); ?>" target="_blank" rel="noopener noreferrer">Instagram</a><?php endif; ?>
				<?php if ($facebookUrl !== '') : ?><a href="<?php echo $escape($facebookUrl); ?>" target="_blank" rel="noopener noreferrer">Facebook</a><?php endif; ?>
				<a href="<?php echo $escape($whatsappUrl); ?>" target="_blank" rel="noopener noreferrer">WhatsApp</a>
			</div>
		</div>
	</footer>
	<?php Theme::plugins('siteBodyEnd'); ?>
</body>
</html>
