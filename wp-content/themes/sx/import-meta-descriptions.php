<?php
/**
 * Bulk Import Full Yoast SEO Data
 * - Focus Keywords
 * - SEO Titles
 * - Meta Descriptions
 * - Open Graph Data
 *
 * Usage:
 * 1. Log into WordPress as admin
 * 2. Go to: https://flameritefires.com/wp-content/themes/sx/import-meta-descriptions.php
 * 3. Review the output
 * 4. DELETE THIS FILE after use (security)
 */

// Load WordPress
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');

// Security check - only allow logged in admins
if (!current_user_can('manage_options')) {
    die('Access denied. Please log in as admin first.');
}

// Full SEO data for all pages
$seo_data = array(
    // ============ MAIN PAGES ============
    '/contact-us/' => array(
        'keyword' => 'contact flamerite fires',
        'title' => 'Contact Us | Flamerite Fires UK | Get In Touch',
        'description' => "Get in touch with Flamerite Fires. Contact our UK team for enquiries about electric fires, media walls, and fireplace suites. We're here to help.",
        'og_title' => 'Contact Flamerite Fires UK',
        'og_description' => "Have questions about our electric fires? Contact the Flamerite team today. We're here to help with enquiries, stockists, and support.",
    ),
    '/cookie-policy/' => array(
        'keyword' => 'flamerite cookie policy',
        'title' => 'Cookie Policy | Flamerite Fires',
        'description' => "Learn how Flamerite Fires uses cookies on our website. Read our cookie policy for details on data collection and your privacy choices.",
        'og_title' => 'Cookie Policy | Flamerite Fires',
        'og_description' => "Learn how Flamerite Fires uses cookies on our website.",
    ),
    '/download-a-brochure/' => array(
        'keyword' => 'flamerite fires brochure download',
        'title' => 'Download Brochure | Flamerite Electric Fires Catalogue',
        'description' => "Download the official Flamerite Fires brochure. Browse our complete range of electric fires, media walls, and fireplace suites in stunning detail.",
        'og_title' => 'Download Our Electric Fires Brochure',
        'og_description' => "Get the official Flamerite Fires brochure. Browse our complete range of premium electric fires, media walls, and fireplace suites.",
    ),
    '/e-fx-built-in-fires/' => array(
        'keyword' => 'built in electric fires UK',
        'title' => 'E-FX Built-In Electric Fires | Flamerite Fires UK',
        'description' => "Discover Flamerite E-FX built-in electric fires. Ultra-realistic flame effects with customisable settings. Perfect for modern interiors across the UK.",
        'og_title' => 'E-FX Built-In Electric Fires',
        'og_description' => "Discover our range of E-FX built-in electric fires. Ultra-realistic flames, customisable settings, and stunning designs for modern homes.",
    ),
    '/e-fx-fireplace-suites/' => array(
        'keyword' => 'electric fireplace suites UK',
        'title' => 'E-FX Electric Fireplace Suites | Complete Fire Packages | Flamerite',
        'description' => "Explore Flamerite E-FX fireplace suites. Complete electric fire packages combining stunning mantels with advanced flame technology. Free UK delivery.",
        'og_title' => 'E-FX Electric Fireplace Suites',
        'og_description' => "Complete electric fireplace suites with stunning mantels and advanced E-FX flame technology. Ready to install packages from Flamerite Fires.",
    ),
    '/e-ridium-holographic-fires/' => array(
        'keyword' => 'holographic electric fire',
        'title' => 'E-Ridium Holographic Electric Fires | 3D Flame Technology | Flamerite',
        'description' => "Experience Flamerite E-Ridium holographic electric fires. Revolutionary 3D flame technology for the most realistic fire effect. Made in the UK.",
        'og_title' => 'E-Ridium Holographic Electric Fires',
        'og_description' => "Revolutionary holographic electric fires with 3D flame technology. The most realistic electric fire effect available. Made in the UK.",
    ),
    '/hearth-inset-fires/' => array(
        'keyword' => 'inset electric fires UK',
        'title' => 'Hearth & Inset Electric Fires | Traditional Style | Flamerite',
        'description' => "Browse Flamerite hearth and inset electric fires. Traditional styling meets modern technology. Easy installation into existing fireplaces.",
        'og_title' => 'Hearth & Inset Electric Fires',
        'og_description' => "Traditional hearth and inset electric fires from Flamerite. Easy installation into existing fireplaces with modern flame technology.",
    ),
    '/our-videos/' => array(
        'keyword' => 'flamerite fires videos',
        'title' => 'Videos | See Our Electric Fires In Action | Flamerite',
        'description' => "Watch Flamerite Fires in action. Video demonstrations of our electric fires, flame effects, and installation guides. See the quality for yourself.",
        'og_title' => 'Watch Flamerite Fires In Action',
        'og_description' => "Video demonstrations of our premium electric fires. See the realistic flame effects and quality craftsmanship for yourself.",
    ),
    '/privacy-policy/' => array(
        'keyword' => 'flamerite privacy policy',
        'title' => 'Privacy Policy | Flamerite Fires',
        'description' => "Read the Flamerite Fires privacy policy. Understand how we collect, use, and protect your personal data when you visit our website.",
        'og_title' => 'Privacy Policy | Flamerite Fires',
        'og_description' => "Read the Flamerite Fires privacy policy.",
    ),
    '/product-documents/' => array(
        'keyword' => 'flamerite product manuals',
        'title' => 'Product Documents & Manuals | Flamerite Fires',
        'description' => "Access Flamerite Fires product documents. Download specifications, installation guides, and user manuals for all our electric fire ranges.",
        'og_title' => 'Product Documents & Manuals',
        'og_description' => "Download specifications, installation guides, and user manuals for all Flamerite electric fire ranges.",
    ),
    '/support/' => array(
        'keyword' => 'flamerite fires support',
        'title' => 'Customer Support | Help & FAQs | Flamerite Fires',
        'description' => "Get support for your Flamerite electric fire. Access troubleshooting guides, FAQs, and contact our UK customer service team for assistance.",
        'og_title' => 'Flamerite Fires Customer Support',
        'og_description' => "Need help with your Flamerite fire? Access troubleshooting guides, FAQs, and contact our UK customer service team.",
    ),
    '/warranty/' => array(
        'keyword' => 'flamerite fires warranty',
        'title' => 'Warranty Registration & Coverage | Flamerite Fires',
        'description' => "Learn about Flamerite Fires warranty coverage. Register your electric fire and discover our extended warranty options for peace of mind.",
        'og_title' => 'Warranty Registration | Flamerite Fires',
        'og_description' => "Register your Flamerite electric fire warranty. Learn about coverage options and extended warranty for peace of mind.",
    ),
    '/where-to-buy/' => array(
        'keyword' => 'flamerite fires stockists',
        'title' => 'Where To Buy | Find Flamerite Stockists Near You',
        'description' => "Find your nearest Flamerite Fires stockist. Locate authorised UK retailers and showrooms to see our electric fires and media walls in person.",
        'og_title' => 'Find Flamerite Fires Stockists',
        'og_description' => "Locate authorised Flamerite retailers and showrooms near you. See our electric fires and media walls in person.",
    ),

    // ============ PRODUCTS ============
    '/products/alto/' => array(
        'keyword' => 'Alto 16 electric fire',
        'title' => 'Alto 16 Electric Fire | Compact Design | Flamerite Fires',
        'description' => "Discover the Flamerite Alto 16 electric fire. Compact design with stunning flame effects. Ideal for smaller rooms. Find your nearest UK stockist.",
        'og_title' => 'Alto 16 Electric Fire | Flamerite',
        'og_description' => "The Alto 16 - compact electric fire with stunning flame effects. Perfect for smaller rooms and bedrooms.",
    ),
    '/products/arcadia/' => array(
        'keyword' => 'Arcadia electric fireplace suite',
        'title' => 'Arcadia Electric Fireplace Suite | Elegant Design | Flamerite',
        'description' => "Explore the Flamerite Arcadia electric fireplace suite. Elegant design with realistic flames and customisable settings. Premium UK craftsmanship.",
        'og_title' => 'Arcadia Electric Fireplace Suite',
        'og_description' => "The Arcadia - elegant electric fireplace suite with realistic flames. Premium UK craftsmanship from Flamerite Fires.",
    ),
    '/products/capella/' => array(
        'keyword' => 'Capella electric fire',
        'title' => 'Capella Electric Fire | Contemporary Style | Flamerite Fires',
        'description' => "Discover the Flamerite Capella electric fire. Contemporary styling with advanced flame technology. Create the perfect ambiance in any room.",
        'og_title' => 'Capella Electric Fire | Flamerite',
        'og_description' => "The Capella - contemporary electric fire with advanced flame technology. Create the perfect ambiance.",
    ),
    '/products/cera/' => array(
        'keyword' => 'Cera 16 electric fire',
        'title' => 'Cera 16 Electric Fire | Modern Ceramic Design | Flamerite',
        'description' => "Explore the Flamerite Cera 16 electric fire. Modern ceramic design with realistic flame effects. Energy efficient heating for UK homes.",
        'og_title' => 'Cera 16 Electric Fire | Flamerite',
        'og_description' => "The Cera 16 - modern ceramic electric fire with realistic flames. Energy efficient heating for UK homes.",
    ),
    '/products/e-fx-1000/' => array(
        'keyword' => 'E-FX 1000 built in fire',
        'title' => 'E-FX 1000 Built-In Electric Fire | 1000mm | Flamerite',
        'description' => "Discover the Flamerite E-FX 1000 built-in electric fire. 1000mm width with ultra-realistic flames. Perfect for media walls and custom installations.",
        'og_title' => 'E-FX 1000 Built-In Fire | 1000mm',
        'og_description' => "The E-FX 1000 - 1000mm built-in electric fire with ultra-realistic flames. Perfect for media walls.",
    ),
    '/products/e-fx-1300/' => array(
        'keyword' => 'E-FX 1300 built in fire',
        'title' => 'E-FX 1300 Built-In Electric Fire | 1300mm | Flamerite',
        'description' => "Explore the Flamerite E-FX 1300 electric fire. 1300mm built-in fire with stunning flame effects. Ideal for feature walls and larger rooms.",
        'og_title' => 'E-FX 1300 Built-In Fire | 1300mm',
        'og_description' => "The E-FX 1300 - 1300mm built-in fire with stunning flame effects. Ideal for feature walls.",
    ),
    '/products/e-fx-1500/' => array(
        'keyword' => 'E-FX 1500 built in fire',
        'title' => 'E-FX 1500 Built-In Electric Fire | 1500mm | Flamerite',
        'description' => "Discover the Flamerite E-FX 1500 built-in fire. 1500mm of stunning flame display. Create a dramatic centrepiece in your living space.",
        'og_title' => 'E-FX 1500 Built-In Fire | 1500mm',
        'og_description' => "The E-FX 1500 - 1500mm of stunning flame display. Create a dramatic centrepiece in your home.",
    ),
    '/products/e-fx-1800/' => array(
        'keyword' => 'E-FX 1800 built in fire',
        'title' => 'E-FX 1800 Built-In Electric Fire | 1800mm | Flamerite',
        'description' => "Experience the Flamerite E-FX 1800 electric fire. Our largest built-in model at 1800mm. Statement piece for grand interiors and media walls.",
        'og_title' => 'E-FX 1800 Built-In Fire | 1800mm',
        'og_description' => "The E-FX 1800 - our largest built-in fire at 1800mm. Statement piece for grand interiors.",
    ),
    '/products/e-ridium-1300/' => array(
        'keyword' => 'E-Ridium 1300 holographic fire',
        'title' => 'E-Ridium 1300 Holographic Fire | 3D Flames | Flamerite',
        'description' => "Discover the Flamerite E-Ridium 1300 holographic fire. Revolutionary 3D flame technology in a 1300mm width. The future of electric fires.",
        'og_title' => 'E-Ridium 1300 Holographic Fire',
        'og_description' => "The E-Ridium 1300 - revolutionary 3D holographic flames in 1300mm width. The future of electric fires.",
    ),
    '/products/e-ridium-1500/' => array(
        'keyword' => 'E-Ridium 1500 holographic fire',
        'title' => 'E-Ridium 1500 Holographic Fire | 3D Flames | Flamerite',
        'description' => "Explore the Flamerite E-Ridium 1500 holographic electric fire. 1500mm of mesmerising 3D flames. Unmatched realism for modern homes.",
        'og_title' => 'E-Ridium 1500 Holographic Fire',
        'og_description' => "The E-Ridium 1500 - 1500mm of mesmerising 3D holographic flames. Unmatched realism.",
    ),
    '/products/e-ridium-1800/' => array(
        'keyword' => 'E-Ridium 1800 holographic fire',
        'title' => 'E-Ridium 1800 Holographic Fire | Flagship 3D | Flamerite',
        'description' => "Experience the Flamerite E-Ridium 1800. Our flagship 1800mm holographic fire with groundbreaking 3D flame technology. Ultimate luxury.",
        'og_title' => 'E-Ridium 1800 Flagship Holographic Fire',
        'og_description' => "The E-Ridium 1800 - our flagship holographic fire with groundbreaking 3D technology. Ultimate luxury.",
    ),
    '/products/elara-1000/' => array(
        'keyword' => 'Elara 1000 fireplace suite',
        'title' => 'Elara 1000 Electric Fireplace Suite | 1000mm | Flamerite',
        'description' => "Discover the Flamerite Elara 1000 electric fireplace suite. Elegant 1000mm design combining style and warmth. Complete package ready to install.",
        'og_title' => 'Elara 1000 Fireplace Suite',
        'og_description' => "The Elara 1000 - elegant 1000mm fireplace suite. Complete package combining style and warmth.",
    ),
    '/products/elara-1300/' => array(
        'keyword' => 'Elara 1300 fireplace suite',
        'title' => 'Elara 1300 Electric Fireplace Suite | 1300mm | Flamerite',
        'description' => "Explore the Flamerite Elara 1300 fireplace suite. Premium 1300mm electric fire with stunning surround. Transform your living room today.",
        'og_title' => 'Elara 1300 Fireplace Suite',
        'og_description' => "The Elara 1300 - premium 1300mm fireplace suite. Transform your living room today.",
    ),
    '/products/europa/' => array(
        'keyword' => 'Europa electric fireplace',
        'title' => 'Europa Electric Fireplace Suite | Classic European | Flamerite',
        'description' => "Discover the Flamerite Europa electric fireplace suite. Classic European styling with modern flame technology. Timeless elegance for any home.",
        'og_title' => 'Europa Electric Fireplace Suite',
        'og_description' => "The Europa - classic European styling meets modern flame technology. Timeless elegance.",
    ),
    '/products/hollis-media-wall/' => array(
        'keyword' => 'media wall electric fire',
        'title' => 'Hollis Media Wall | Integrated Electric Fire | Flamerite',
        'description' => "Explore the Flamerite Hollis Media Wall. Complete media wall solution with integrated electric fire. Modern living room centrepiece.",
        'og_title' => 'Hollis Media Wall Fire',
        'og_description' => "The Hollis Media Wall - complete solution with integrated electric fire. Modern living room centrepiece.",
    ),
    '/products/lando-22/' => array(
        'keyword' => 'Lando 22 electric fire',
        'title' => 'Lando 22 Electric Fire | 22 Inch Display | Flamerite',
        'description' => "Discover the Flamerite Lando 22 electric fire. 22-inch display with realistic flame effects. Compact luxury for bedrooms and smaller spaces.",
        'og_title' => 'Lando 22 Electric Fire',
        'og_description' => "The Lando 22 - 22-inch electric fire with realistic flames. Compact luxury for any room.",
    ),
    '/products/payton-1000/' => array(
        'keyword' => 'Payton 1000 fireplace suite',
        'title' => 'Payton 1000 Electric Fireplace Suite | Contemporary | Flamerite',
        'description' => "Explore the Flamerite Payton 1000 fireplace suite. Contemporary 1000mm design with stunning flame display. Premium UK electric fire.",
        'og_title' => 'Payton 1000 Fireplace Suite',
        'og_description' => "The Payton 1000 - contemporary 1000mm fireplace suite. Premium design with stunning flames.",
    ),
    '/products/payton-1300/' => array(
        'keyword' => 'Payton 1300 fireplace suite',
        'title' => 'Payton 1300 Electric Fireplace Suite | 1300mm | Flamerite',
        'description' => "Discover the Flamerite Payton 1300 electric fireplace. Impressive 1300mm suite with advanced flame technology. Statement piece for any room.",
        'og_title' => 'Payton 1300 Fireplace Suite',
        'og_description' => "The Payton 1300 - impressive 1300mm fireplace suite. Statement piece with advanced flames.",
    ),
    '/products/reid/' => array(
        'keyword' => 'Reid 22 electric fire',
        'title' => 'Reid 22 Electric Fire | Sleek 22 Inch Design | Flamerite',
        'description' => "Explore the Flamerite Reid 22 electric fire. Sleek 22-inch design with customisable flames. Perfect balance of style and performance.",
        'og_title' => 'Reid 22 Electric Fire',
        'og_description' => "The Reid 22 - sleek 22-inch electric fire. Perfect balance of style and performance.",
    ),
    '/products/sl1000/' => array(
        'keyword' => 'SL1000 slim line fire',
        'title' => 'SL1000 Slim-Line Electric Fire | 1000mm | Flamerite',
        'description' => "Discover the Flamerite SL1000 electric fire. Slim-line 1000mm design for modern installations. Versatile and energy efficient.",
        'og_title' => 'SL1000 Slim-Line Electric Fire',
        'og_description' => "The SL1000 - slim-line 1000mm electric fire. Versatile and energy efficient.",
    ),
    '/products/sl600/' => array(
        'keyword' => 'SL600 slim line fire',
        'title' => 'SL600 Slim-Line Electric Fire | Compact 600mm | Flamerite',
        'description' => "Explore the Flamerite SL600 slim-line electric fire. Compact 600mm width ideal for tight spaces. Big impact, small footprint.",
        'og_title' => 'SL600 Compact Slim-Line Fire',
        'og_description' => "The SL600 - compact 600mm slim-line fire. Big impact, small footprint.",
    ),
    '/products/sl750s/' => array(
        'keyword' => 'SL750S electric fire',
        'title' => 'SL750S Slim-Line Electric Fire | 750mm | Flamerite',
        'description' => "Discover the Flamerite SL750S electric fire. 750mm slim-line design with stunning flame effects. Perfect for contemporary interiors.",
        'og_title' => 'SL750S Slim-Line Electric Fire',
        'og_description' => "The SL750S - 750mm slim-line fire with stunning flames. Perfect for contemporary spaces.",
    ),
    '/products/sl750t/' => array(
        'keyword' => 'SL750T three sided fire',
        'title' => 'SL750T Three-Sided Electric Fire | Corner | Flamerite',
        'description' => "Explore the Flamerite SL750T electric fire. 750mm three-sided design for corner installations. Innovative heating solution.",
        'og_title' => 'SL750T Three-Sided Electric Fire',
        'og_description' => "The SL750T - 750mm three-sided fire for corner installations. Innovative design.",
    ),
    '/products/stanford-2/' => array(
        'keyword' => 'Stanford electric fireplace',
        'title' => 'Stanford Electric Fireplace Suite | Traditional | Flamerite',
        'description' => "Discover the Flamerite Stanford electric fireplace suite. Traditional styling with modern technology. Classic elegance for UK homes.",
        'og_title' => 'Stanford Electric Fireplace Suite',
        'og_description' => "The Stanford - traditional fireplace suite with modern technology. Classic elegance.",
    ),
    '/products/stanford/' => array(
        'keyword' => 'Highland electric fireplace',
        'title' => 'Highland Electric Fireplace | Rustic Charm | Flamerite',
        'description' => "Explore the Flamerite Highland electric fireplace. Rustic charm meets advanced flame technology. Bring warmth to any traditional interior.",
        'og_title' => 'Highland Electric Fireplace',
        'og_description' => "The Highland - rustic charm meets modern flame technology. Warmth for traditional interiors.",
    ),
    '/products/tama/' => array(
        'keyword' => 'Tama 16 electric fire',
        'title' => 'Tama 16 Electric Fire | Compact 16 Inch | Flamerite',
        'description' => "Discover the Flamerite Tama 16 electric fire. Compact 16-inch design with powerful flame effects. Ideal for bedrooms and small living spaces.",
        'og_title' => 'Tama 16 Electric Fire',
        'og_description' => "The Tama 16 - compact 16-inch fire with powerful flames. Ideal for bedrooms.",
    ),
    '/products/vento/' => array(
        'keyword' => 'Vento 22 electric fire',
        'title' => 'Vento 22 Electric Fire | Customisable Flames | Flamerite',
        'description' => "Explore the Flamerite Vento 22 electric fire. Stylish 22-inch model with customisable flame colours. Modern design meets efficiency.",
        'og_title' => 'Vento 22 Electric Fire',
        'og_description' => "The Vento 22 - stylish 22-inch fire with customisable flame colours.",
    ),
    '/products/willow/' => array(
        'keyword' => 'Willow electric fireplace',
        'title' => 'Willow Electric Fireplace Suite | Graceful Design | Flamerite',
        'description' => "Discover the Flamerite Willow electric fireplace suite. Graceful curves and stunning flames. Add natural beauty to your living space.",
        'og_title' => 'Willow Electric Fireplace Suite',
        'og_description' => "The Willow - graceful curves and stunning flames. Natural beauty for your home.",
    ),
);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Flamerite Yoast SEO Import</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 900px; margin: 40px auto; padding: 20px; }
        h1 { color: #1e3a5f; }
        .success { color: green; padding: 5px 0; }
        .error { color: red; padding: 5px 0; }
        .warning { color: orange; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #1e3a5f; color: white; }
        .delete-warning { background: #ffe0e0; padding: 20px; border: 2px solid red; margin: 20px 0; }
    </style>
</head>
<body>

<h1>Flamerite Yoast SEO Bulk Import</h1>
<p>Importing SEO data for <?php echo count($seo_data); ?> pages...</p>

<table>
    <tr>
        <th>Page</th>
        <th>Status</th>
        <th>Details</th>
    </tr>
<?php

$updated = 0;
$errors = 0;

foreach ($seo_data as $slug => $data) {
    // Find the post/page by URL
    $post_id = url_to_postid(home_url($slug));

    if ($post_id) {
        // Update all Yoast fields
        update_post_meta($post_id, '_yoast_wpseo_focuskw', $data['keyword']);
        update_post_meta($post_id, '_yoast_wpseo_title', $data['title']);
        update_post_meta($post_id, '_yoast_wpseo_metadesc', $data['description']);
        update_post_meta($post_id, '_yoast_wpseo_opengraph-title', $data['og_title']);
        update_post_meta($post_id, '_yoast_wpseo_opengraph-description', $data['og_description']);
        update_post_meta($post_id, '_yoast_wpseo_twitter-title', $data['og_title']);
        update_post_meta($post_id, '_yoast_wpseo_twitter-description', $data['og_description']);

        echo "<tr class='success'>";
        echo "<td>{$slug}</td>";
        echo "<td>✓ Updated</td>";
        echo "<td>Keyword: <strong>{$data['keyword']}</strong></td>";
        echo "</tr>";
        $updated++;
    } else {
        echo "<tr class='error'>";
        echo "<td>{$slug}</td>";
        echo "<td>✗ Not Found</td>";
        echo "<td>Page not found in database</td>";
        echo "</tr>";
        $errors++;
    }
}

?>
</table>

<h2>Import Complete!</h2>
<p><strong>Updated:</strong> <?php echo $updated; ?> pages</p>
<p><strong>Errors:</strong> <?php echo $errors; ?> pages</p>

<h3>What was imported for each page:</h3>
<ul>
    <li><strong>Focus Keyword</strong> - Primary SEO keyword</li>
    <li><strong>SEO Title</strong> - Optimized page title for search results</li>
    <li><strong>Meta Description</strong> - 150-160 char description for Google</li>
    <li><strong>Open Graph Title</strong> - Facebook/LinkedIn share title</li>
    <li><strong>Open Graph Description</strong> - Social media share description</li>
    <li><strong>Twitter Title & Description</strong> - Twitter card data</li>
</ul>

<div class="delete-warning">
    <h3>⚠️ SECURITY WARNING</h3>
    <p><strong>DELETE THIS FILE IMMEDIATELY!</strong></p>
    <p>File location: <code>/wp-content/themes/sx/import-meta-descriptions.php</code></p>
    <p>This file allows database modifications and must be removed after use.</p>
</div>

</body>
</html>
