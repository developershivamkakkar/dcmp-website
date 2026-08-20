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
    'tagline'       => 'DIGITALLY NETWORKED SMART SCHOOL WITH CUTTING EDGE TECHNOLOGY',
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

    'phone'            => '0161- 2675999',
    'email_admissions' => 'dcmpresidency@gmail.com',
    'email_info'       => 'dcmpresidency@gmail.com',
    'whatsapp'         => '+918437001273',

    // -- Social Media ----------------------------------------------------------
    'social' => [
        'facebook'  => 'https://www.facebook.com/DCMPresidencySchool/',
        'instagram' => 'https://www.instagram.com/dcmpresidencyschool/',
        'twitter'   => 'https://twitter.com/DCMPresidency',
        'youtube'   => 'https://www.youtube.com/@DCMPresidencySchool',
    ],

    // -- Google Maps -----------------------------------------------------------
    'maps_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1210.4745652705626!2d75.90765945963382!3d30.89395894235455!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391a9d29a88d1dd1%3A0xc959a12ce3851130!2sD.C.M.%20Presidency%20School!5e0!3m2!1sen!2sin!4v1786516906646!5m2!1sen!2sin',

    // -- Analytics (environment-specific � set in .env) ------------------------
    'google_analytics'   => env('GOOGLE_ANALYTICS_ID',   ''),
    'google_tag_manager' => env('GOOGLE_TAG_MANAGER_ID', ''),

    // -- Brand colours ---------------------------------------------------------
    'color_primary'   => '#052A56',
    'color_secondary' => '#00A859',
    'color_accent'    => '#F0C76B',

    // -- SEO: Site-wide defaults -----------------------------------------------
    'meta_description' => 'DCM Presidency School (DCMP) in Ludhiana – A leading CBSE school offering innovative education with advanced labs, technology integration, and holistic development for students.',

    'meta_keywords' => 'DCM Presidency School, DCMP Ludhiana, Best School in Ludhiana, CBSE School, Top Schools Ludhiana, School with Labs, Innovative School, Experiential Learning',

    // -- SEO: Per-Page Configuration -------------------------------------------
    // Route name => [title, description, keywords, og_type, robots]
    // Fallback to site defaults if not specified here.
    'pages' => [
        'home.get' => [
            'title'       => 'DCM Presidency School (DCMP) – Leading CBSE School in Ludhiana',
            'description' => 'DCM Presidency School is a premier CBSE school in Ludhiana offering cutting-edge education with advanced technology, innovation labs, sports, and holistic development.',
            'keywords'    => 'DCM Presidency School Ludhiana, DCMP, Best CBSE School, Top School in Ludhiana, Smart School, Technology Integrated School',
            'og_type'     => 'website',
            'robots'      => 'index, follow',
        ],
        'contact' => [
            'title'       => 'Contact DCM Presidency School – Ludhiana',
            'description' => 'Contact DCM Presidency School in Ludhiana. Address: Opp. Gol Market, Urban Estate Phase III, Chandigarh Road, Jamalpur Colony. Phone: 01632-248099 | Email: info@dassandbrownschool.com',
            'keywords'    => 'Contact DCMP, DCM School Address, School Location Ludhiana, Admission Enquiry',
            'og_type'     => 'website',
            'robots'      => 'index, follow',
        ],
        'blogs.get' => [
            'title'       => 'DCMP Blog – Educational Insights & Updates',
            'description' => 'Read the latest articles, educational insights, and updates from DCM Presidency School on learning innovation, student achievements, and school news.',
            'keywords'    => 'DCMP Blog, School Articles, Educational Updates, School News, Learning Resources',
            'og_type'     => 'website',
            'robots'      => 'index, follow',
        ],
        'events.get' => [
            'title'       => 'School Events – DCM Presidency School',
            'description' => 'Explore events, activities, and celebrations at DCM Presidency School – sports days, cultural programs, academic festivals, and student-led initiatives.',
            'keywords'    => 'DCMP Events, School Activities, School Celebrations, Student Events Ludhiana',
            'og_type'     => 'website',
            'robots'      => 'index, follow',
        ],
        'gallery-school-events.get' => [
            'title'       => 'School Events Gallery – DCM Presidency School',
            'description' => 'Browse photo gallery from DCMP school events, sports meets, cultural programs, annual day celebrations, and student activities.',
            'keywords'    => 'DCMP Gallery, School Events Photos, School Celebrations, Student Photos',
            'og_type'     => 'website',
            'robots'      => 'index, follow',
        ],
        'gallery-infrastructure.get' => [
            'title'       => 'Campus & Infrastructure – DCM Presidency School',
            'description' => 'Explore DCMP\'s world-class facilities: smart classrooms, science labs, computer labs, sports grounds, auditorium, and modern learning spaces.',
            'keywords'    => 'DCMP Campus, School Infrastructure, Labs, Sports Facilities, School Campus Photos',
            'og_type'     => 'website',
            'robots'      => 'index, follow',
        ],
        'gallery-activities.get' => [
            'title'       => 'Student Activities Gallery – DCMP',
            'description' => 'See DCMP students engaged in learning activities – arts, science experiments, sports, cultural programs, and co-curricular activities.',
            'keywords'    => 'DCMP Activities, Student Activities, Co-curricular Programs, Student Engagement',
            'og_type'     => 'website',
            'robots'      => 'index, follow',
        ],
        'gallery-news-clippings.get' => [
            'title'       => 'News & Media Coverage – DCM Presidency School',
            'description' => 'DCMP in the news – media coverage, press releases, achievements, and recognition from leading publications and educational platforms.',
            'keywords'    => 'DCMP News, School Media Coverage, Press Features, School Achievements',
            'og_type'     => 'website',
            'robots'      => 'index, follow',
        ],
        'downloads-list.get' => [
            'title'       => 'Downloads – Forms & Documents | DCMP',
            'description' => 'Download important forms, admission circulars, fee schedules, academic calendars, and school documents from DCM Presidency School.',
            'keywords'    => 'DCMP Downloads, School Forms, Admission Forms, Fee Schedule, School Documents',
            'og_type'     => 'website',
            'robots'      => 'index, follow',
        ],
        'resource-list' => [
            'title'       => 'Learning Resources – DCM Presidency School',
            'description' => 'Access curated learning resources, study materials, reference guides, and educational tools provided by DCMP for students and parents.',
            'keywords'    => 'DCMP Resources, Study Materials, Learning Guides, Educational Resources',
            'og_type'     => 'website',
            'robots'      => 'index, follow',
        ],
        'admissions.landing.get' => [
            'title'       => 'Admissions – DCM Presidency School',
            'description' => 'Admissions Open at DCMP for the current academic year. Join our innovative school in Ludhiana offering quality CBSE education with modern facilities.',
            'keywords'    => 'DCMP Admissions, School Admission Ludhiana, Apply Online, Admission Process',
            'og_type'     => 'website',
            'robots'      => 'index, follow',
        ],
        'job-form.get' => [
            'title'       => 'Careers – Join DCM Presidency School',
            'description' => 'Explore career opportunities at DCMP. We welcome passionate educators, administrators, and support staff to join our team in Ludhiana.',
            'keywords'    => 'DCMP Careers, Teaching Jobs, School Jobs Ludhiana, Recruitment',
            'og_type'     => 'website',
            'robots'      => 'index, follow',
        ],
        'mandatory-disclosure.get' => [
            'title'       => 'Mandatory Disclosure – DCM Presidency School',
            'description' => 'Mandatory disclosure information as per regulatory requirements for DCM Presidency School, Ludhiana.',
            'keywords'    => 'DCMP Disclosure, School Compliance, School Information',
            'og_type'     => 'website',
            'robots'      => 'index, follow',
        ],
    ],

];
