<?php
/**
 * Template Name: Thank You Template
 */
get_header();

// Detect language for Polylang
$lang = function_exists('pll_current_language') ? pll_current_language() : 'en';

if ($lang === 'el') {
	$heading    = 'Ευχαριστούμε!';
	$message    = 'Το μήνυμά σας υποβλήθηκε με επιτυχία. Θα επικοινωνήσουμε μαζί σας σύντομα.';
	$btn_home   = 'Πίσω στην Αρχική';
} else {
	$heading    = 'Thank You!';
	$message    = 'Your message has been submitted successfully. We will get back to you soon.';
	$btn_home   = 'Back to Home';
}

$home_url = esc_url(home_url('/'));
?>

<style>
	.thankyou-hero {
		margin-top: 123px;
		padding: 100px 0 120px;
		text-align: center;
	}

	.thankyou-hero .container {
		max-width: 700px;
		margin: 0 auto;
		padding: 0 30px;
	}

	.thankyou-checkmark {
		width: 90px;
		height: 90px;
		border-radius: 50%;
		background: linear-gradient(135deg, #2ecc71, #27ae60);
		display: flex;
		align-items: center;
		justify-content: center;
		margin: 0 auto 35px;
		animation: thankyouPop 0.5s cubic-bezier(0.26, 0.53, 0.74, 1.48) both;
		box-shadow: 0 8px 30px rgba(46, 204, 113, 0.35);
	}

	.thankyou-checkmark svg {
		width: 44px;
		height: 44px;
		stroke: #fff;
		stroke-width: 3;
		fill: none;
		stroke-dasharray: 60;
		stroke-dashoffset: 60;
		animation: thankyouDraw 0.6s 0.4s ease forwards;
	}

	@keyframes thankyouPop {
		0% { transform: scale(0); opacity: 0; }
		100% { transform: scale(1); opacity: 1; }
	}

	@keyframes thankyouDraw {
		to { stroke-dashoffset: 0; }
	}

	.thankyou-hero h1 {
		font-size: clamp(36px, 5vw, 56px);
		font-weight: 700;
		color: var(--color-base, #1a1a1a);
		margin: 0 0 18px;
		line-height: 1.1;
	}

	.thankyou-hero .thankyou-message {
		font-size: clamp(16px, 1.8vw, 19px);
		line-height: 1.7;
		color: #555;
		margin: 0 auto 40px;
		max-width: 520px;
	}

	.thankyou-btn {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		padding: 16px 36px;
		border-radius: 10px;
		font-size: 16px;
		font-weight: 600;
		text-decoration: none;
		background: var(--color-base, #1a1a1a);
		color: #fff;
		border: 2px solid transparent;
		transition: all 0.3s ease;
	}

	.thankyou-btn:hover {
		background: transparent;
		border-color: var(--color-base, #1a1a1a);
		color: var(--color-base, #1a1a1a);
	}

	@media (max-width: 768px) {
		.thankyou-hero {
			margin-top: 100px;
			padding: 60px 20px 80px;
		}
	}
</style>

<section class="thankyou-hero">
	<div class="container">
		<div class="thankyou-checkmark">
			<svg viewBox="0 0 24 24">
				<polyline points="4 12 10 18 20 6"></polyline>
			</svg>
		</div>
		<h1><?php echo esc_html($heading); ?></h1>
		<p class="thankyou-message"><?php echo esc_html($message); ?></p>
		<a href="<?php echo $home_url; ?>" class="thankyou-btn"><?php echo esc_html($btn_home); ?></a>
	</div>
</section>

<?php get_footer(); ?>