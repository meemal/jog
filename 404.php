<?php
get_header(); ?>

<section class="min-h-screen flex flex-col items-center justify-center text-center bg-gray-100 px-6">
    <h1 class="text-6xl font-bold text-red-700">404</h1>
    <h2 class="text-2xl font-semibold text-gray-700 mt-4">Oops! Page Not Found</h2>
    <p class="text-gray-600 mt-2">The page you are looking for might have been removed or is temporarily unavailable.</p>
    
    <a href="<?php echo esc_url(home_url('/')); ?>" class="mt-6 px-6 py-3 bg-red-700 text-white rounded-lg hover:bg-red-800 transition">
        Go to Homepage
    </a>
</section>

<?php get_footer(); ?>
