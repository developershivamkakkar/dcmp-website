<?php

/**
 * Site configuration � single source of truth for this deployment.
 *
 * To deploy for a different school:
 *  1. Copy the project.
 *  2. Edit the values below.
 *  3. Replace brand assets under /public/storage/assets/.
 *  4. Done.
 */

return [

    // -- Identity -------------------------------------------------------------
    'name'          => 'DCMP',
    'full_name'     => 'DCM Presidency School',
    'tagline'       => 'Where Excellence Begins...',
    'url'           => env('APP_URL'),

    // -- Assets (relative to public/) -----------------------------------------
    'logo'          => 'storage/assets/dcmp-main-logo.png',
    'logo_icon'     => 'storage/assets/dcmp-logo.png',
    'favicon'       => 'storage/assets/dcmp-logo.png',
    'og_image'      => 'storage/assets/dcmp-logo.png',

    // -- Contact ---------------------------------------------------------------
    'address' => [
        'line1'       => 'DCM Presidency School',
        'line2'       => 'Opp. Gol Market, Urban Estate Phase III, Chandigarh Road. Jamalpur Colony',
        'city'        => 'Ludhiana',
        'state'       => 'Punjab',
        'country'     => 'India',
        'postal_code' => '152001',
        'full'        => 'DCM Presidency School: Opp. Gol Market, Urban Estate Phase III, Chandigarh Road. Jamalpur Colony.',
    ],

    'phone'            => '01632-248099',
    'email_admissions' => 'dbsfzr@gmail.com',
    'email_info'       => 'info@dassandbrownschool.com',
    'whatsapp'         => '9115992918',

    // -- Social Media ----------------------------------------------------------
    'social' => [
        'facebook'  => 'https://www.facebook.com/dbelschd',
        'instagram' => 'https://www.instagram.com/dbelschd',
        'linkedin'  => 'https://www.linkedin.com/company/dbelschd',
        'twitter'   => 'https://x.com/dbelschd',
        'youtube'   => 'https://www.youtube.com/@dbelschd',
    ],

    // -- Admissions / Documents ------------------------------------------------
    'admissions_url'   => 'https://admissions.dassandbrownschool.com/',
    'brochure_url'     => '/brochures/dbels-brochure.pdf',
    'enquiry_url'      => '',
    'registration_url' => 'https://admissions.dassandbrownschool.com/',

    // -- Google Maps -----------------------------------------------------------
    'maps_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1210.4745652705626!2d75.90765945963382!3d30.89395894235455!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391a9d29a88d1dd1%3A0xc959a12ce3851130!2sD.C.M.%20Presidency%20School!5e0!3m2!1sen!2sin!4v1786516906646!5m2!1sen!2sin',

    // -- Analytics (environment-specific � set in .env) ------------------------
    'google_analytics'   => env('GOOGLE_ANALYTICS_ID',   ''),
    'google_tag_manager' => env('GOOGLE_TAG_MANAGER_ID', ''),

    // -- Brand colours ---------------------------------------------------------
    'color_primary'   => '#052A56',
    'color_secondary' => '#00A859',
    'color_accent'    => '#F0C76B',

    // -- SEO -------------------------------------------------------------------
    'meta_description' => 'Dass & Brown Experiential Learning School (D-Bels) is an innovative educational institution '
        . 'in Panchkula, Tricity Chandigarh � offering Finnish, entrepreneurship, legacy, and '
        . 'international pathways including Cambridge AS/A Level, IB Diploma, and ICSE.',

    'meta_keywords' => 'Best School in Chandigarh, Best School in Panchkula, D-BELS, Dass and Brown School, '
        . 'Top Schools Panchkula, ICSE School Chandigarh, Cambridge School Panchkula, '
        . 'International School Panchkula, Experiential Learning School',

];
