<?php

namespace Database\Seeders;

use App\Models\NavigationItem;
use App\Models\Page;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        foreach ([
            ['label' => 'Home', 'url' => '/', 'sort_order' => 1],
            ['label' => 'About Us', 'url' => '/about', 'sort_order' => 2],
            ['label' => 'Services', 'url' => '/services', 'sort_order' => 3, 'menu_type' => 'mega'],
            ['label' => 'Products', 'url' => '/products', 'sort_order' => 4, 'menu_type' => 'mega'],
            ['label' => 'Contact Us', 'url' => '/contact', 'sort_order' => 5],
        ] as $item) {
            NavigationItem::updateOrCreate(['location' => 'header', 'label' => $item['label']], $item + ['is_visible' => true, 'open_in_new_tab' => false]);
        }
        NavigationItem::where('location', 'header')->where('label', 'Privacy Policy')->update(['location' => 'footer']);
        NavigationItem::updateOrCreate(['location' => 'footer', 'label' => 'Privacy Policy'], ['url' => '/privacy-policy', 'menu_type' => 'link', 'sort_order' => 1, 'is_visible' => true, 'open_in_new_tab' => false]);

        $services = NavigationItem::where('location', 'header')->where('label', 'Services')->first();
        $products = NavigationItem::where('location', 'header')->where('label', 'Products')->first();
        $services->update(['promo_title' => 'Need a system plan?', 'promo_text' => 'Share your project requirements and get the right solution path before equipment selection.', 'promo_button_label' => 'Discuss Your Project', 'promo_button_url' => '/contact']);
        $products->update(['promo_title' => null, 'promo_text' => null, 'promo_button_label' => null, 'promo_button_url' => null]);
        foreach ([
            [$services, 'Refrigeration', '/services', 'Core Engineering', 'snowflake', 'Cold rooms, freezers and process cooling', 1],
            [$services, 'Air Conditioning', '/services', 'Core Engineering', 'fan', 'Commercial, VRF and industrial AC', 2],
            [$services, 'Heating', '/services', 'Building Systems', 'flame', 'Application-led heating support', 3],
            [$services, 'Ventilation', '/services', 'Building Systems', 'wind', 'Supply, exhaust and air movement', 4],
            [$services, 'Maintenance', '/services', 'Support', 'wrench', 'After-sales service and inspection', 6],
            [$products, 'Compressors', '/compressor', 'Refrigeration Equipment', 'settings-2', 'Reliable cooling capacity for demanding systems', 1],
            [$products, 'Condensers', '/condenser', 'Refrigeration Equipment', 'fan', 'Efficient heat rejection equipment', 2],
            [$products, 'Evaporators', '/evaporator', 'Refrigeration Equipment', 'snowflake', 'Unit coolers for cold rooms and process cooling', 3],
            [$products, 'Freezing Systems', '/freezing-systems', 'Freezing & Cooling', 'snowflake', 'Plate and spiral freezer equipment', 4],
            [$products, 'Chilled Water Systems', '/chilled-water-systems', 'Freezing & Cooling', 'droplets', 'Central process cooling and water systems', 5],
            [$products, 'Sandwich Panels', '/sandwich-panels', 'Insulation Systems', 'layers-3', 'PU, EPS, rock wool and glass wool options', 6],
        ] as [$parent, $label, $url, $group, $icon, $description, $sortOrder]) {
            NavigationItem::updateOrCreate(['parent_id' => $parent->id, 'label' => $label], ['url' => $url, 'location' => 'header', 'menu_type' => 'link', 'menu_group' => $group, 'icon' => $icon, 'description' => $description, 'sort_order' => $sortOrder, 'is_visible' => true, 'open_in_new_tab' => false]);
        }

        // Retire menu entries that are no longer part of the product structure.
        NavigationItem::whereIn('label', ['Cold Room Panels', 'Components & Brands'])
            ->update(['is_visible' => false]);
        NavigationItem::where('parent_id', $services->id)->where('label', 'RHVAC Components')
            ->update(['is_visible' => false]);

        foreach ([
            'site_name' => 'Thermo-Care Engineering Limited', 'phone' => '', 'email' => 'info@thermocarebd.com', 'address' => 'House 2/B, Road 08, Nikunja 02, Dhaka 1229',
            'logo_light' => 'site/logo-light.svg', 'logo_dark' => 'site/logo-dark.png', 'favicon' => 'site/favicon.png',
            'google_webmaster_verification' => '', 'meta_description' => 'Industrial refrigeration, HVAC and cooling engineering services in Bangladesh.',
            'facebook_url' => '', 'linkedin_url' => '', 'youtube_url' => '',
            'mail_host' => 'smtp.hostinger.com', 'mail_port' => '465', 'mail_username' => 'info@thermocarebd.com',
            'home_hero_title' => 'Engineered cooling systems for critical operations.', 'home_hero_description' => 'Thermo-Care designs, supplies, installs and maintains refrigeration, HVAC and RHVAC component services for industrial and commercial facilities across Bangladesh.',
        ] as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value, 'group' => 'general']);
        }

        Page::updateOrCreate(['slug' => 'privacy-policy'], [
            'title' => 'Privacy Policy',
            'meta_description' => 'Thermo-Care privacy policy.',
            'content' => '<h2>Privacy Policy</h2><p>We use enquiry details only to respond to your request and provide our services. We do not sell personal information.</p><h3>Contact us</h3><p>Contact our team if you have questions about your information.</p>',
            'is_published' => true,
        ]);

        foreach ([
            ['slug' => 'compressor', 'title' => 'Compressors', 'template' => 'compressor'],
            ['slug' => 'condenser', 'title' => 'Condensers', 'template' => 'condenser'],
            ['slug' => 'evaporator', 'title' => 'Evaporators', 'template' => 'evaporator'],
            ['slug' => 'freezing-systems', 'title' => 'Freezing Systems', 'template' => 'freezing-systems'],
            ['slug' => 'chilled-water-systems', 'title' => 'Chilled Water Systems', 'template' => 'chilled-water-systems'],
            ['slug' => 'sandwich-panels', 'title' => 'Sandwich Panels', 'template' => 'sandwich-panels'],
        ] as $productPage) {
            Page::updateOrCreate(['slug' => $productPage['slug']], $productPage + ['meta_description' => $productPage['title'].' from Thermo-Care.', 'content' => '', 'is_published' => true]);
        }
    }
}
