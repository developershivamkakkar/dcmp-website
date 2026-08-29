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
    'name'          => 'DCMI',
    'full_name'     => 'DCM International School',
    'tagline'       => 'Where Traditions Blend With Modern Outlook',
    'url'           => env('APP_URL'),

    // -- Assets (relative to public/) -----------------------------------------
    'logo'          => 'storage/assets/dcmi-main-logo.png',
    'logo_icon'     => 'storage/assets/dcmp-logo.png',
    'favicon'       => 'storage/assets/dcmp-logo.png',
    'og_image'      => 'storage/assets/dcmp-logo.png',

    // -- Contact ---------------------------------------------------------------
    'address' => [
        'line1'       => 'DCM International School',
        'line2'       => 'Shaheed Udham Singh Marg',
        'city'        => 'Ferozepur City',
        'state'       => 'Punjab',
        'country'     => 'India',
        'postal_code' => '152001',
        'full'        => 'DCM International School, Shaheed Udham Singh Marg',
    ],

    'phone'            => '01632-229797',
    'email_admissions' => 'dcmodelinternational2003@gmail.com',
    'email_info'       => 'dcmodelinternational2003@gmail.com',
    'whatsapp'         => '+9115992917',

    // -- Social Media ----------------------------------------------------------
    'social' => [
        'facebook'  => '',
        'instagram' => '',
        'twitter'   => '',
        'youtube'   => '',
    ],

    // -- Google Maps -----------------------------------------------------------
    'maps_embed' => 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6842.8326584652905!2d74.632806!3d30.958862!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3919e99bbb28a869%3A0x2ffb52a0eb584964!2sD.C.M%20International%20School!5e0!3m2!1sen!2sus!4v1787380339491!5m2!1sen!2sus',

    // -- Analytics (environment-specific � set in .env) ------------------------
    'google_analytics'   => env('GOOGLE_ANALYTICS_ID',   ''),
    'google_tag_manager' => env('GOOGLE_TAG_MANAGER_ID', ''),

    // -- Brand colours ---------------------------------------------------------
    'color_primary'   => '#010080',
    'color_secondary' => '#D9DADA',
    'color_accent'    => '#BFA2CA',

    // -- SEO: Site-wide defaults -----------------------------------------------
    'meta_description' => 'DCM International School in Ferozepur – A leading CBSE school offering innovative education with advanced labs, technology integration, and holistic development for students.',

    'meta_keywords' => 'DCM International School, DCMI Ferozepur, Best School in Ferozepur, CBSE School, Top Schools Ferozepur, School with Labs, Innovative School, Experiential Learning',

    // -- SEO: Per-Page Configuration -------------------------------------------
    // Route name => [title, description, keywords, og_type, robots]
    // Fallback to site defaults if not specified here.
    'pages' => [
        'home.get' => [
            'title'       => 'DCM International School (DCMI) – Leading CBSE School in Ferozepur',
            'description' => 'DCM International School is a premier CBSE school in Ferozepur offering cutting-edge education with advanced technology, innovation labs, sports, and holistic development.',
            'keywords'    => 'DCM International School Ferozepur, DCMI, Best CBSE School, Top School in Ferozepur, Smart School, Technology Integrated School',
            'og_type'     => 'website',
            'robots'      => 'index, follow',
        ],
        'contact' => [
            'title'       => 'Contact DCM International School – Ferozepur',
            'description' => 'Contact DCM International School in Ferozepur. Address: Shaheed Udham Singh Marg, Ferozepur City, Punjab. Phone: 01632-229797 | Email: dcmodelinternational2003@gmail.com',
            'keywords'    => 'Contact DCMI, DCM International School Address, School Location Ferozepur, Admission Enquiry',
            'og_type'     => 'website',
            'robots'      => 'index, follow',
        ],
        'blogs.get' => [
            'title'       => 'DCMI Blog – Educational Insights & Updates',
            'description' => 'Read the latest articles, educational insights, and updates from DCM International School on learning innovation, student achievements, and school news.',
            'keywords'    => 'DCMI Blog, School Articles, Educational Updates, School News, Learning Resources',
            'og_type'     => 'website',
            'robots'      => 'index, follow',
        ],
        'events.get' => [
            'title'       => 'School Events – DCM International School',
            'description' => 'Explore events, activities, and celebrations at DCM International School – sports days, cultural programs, academic festivals, and student-led initiatives.',
            'keywords'    => 'DCMI Events, School Activities, School Celebrations, Student Events Ferozepur',
            'og_type'     => 'website',
            'robots'      => 'index, follow',
        ],
        'gallery-school-events.get' => [
            'title'       => 'School Events Gallery – DCM International School',
            'description' => 'Browse photo gallery from DCMI school events, sports meets, cultural programs, annual day celebrations, and student activities.',
            'keywords'    => 'DCMI Gallery, School Events Photos, School Celebrations, Student Photos',
            'og_type'     => 'website',
            'robots'      => 'index, follow',
        ],
        'gallery-infrastructure.get' => [
            'title'       => 'Campus & Infrastructure – DCM International School',
            'description' => 'Explore DCMI\'s world-class facilities: smart classrooms, science labs, computer labs, sports grounds, auditorium, and modern learning spaces.',
            'keywords'    => 'DCMI Campus, School Infrastructure, Labs, Sports Facilities, School Campus Photos',
            'og_type'     => 'website',
            'robots'      => 'index, follow',
        ],
        'gallery-activities.get' => [
            'title'       => 'Student Activities Gallery – DCMI',
            'description' => 'See DCMI students engaged in learning activities – arts, science experiments, sports, cultural programs, and co-curricular activities.',
            'keywords'    => 'DCMI Activities, Student Activities, Co-curricular Programs, Student Engagement',
            'og_type'     => 'website',
            'robots'      => 'index, follow',
        ],
        'gallery-news-clippings.get' => [
            'title'       => 'News & Media Coverage – DCM International School',
            'description' => 'DCMI in the news – media coverage, press releases, achievements, and recognition from leading publications and educational platforms.',
            'keywords'    => 'DCMI News, School Media Coverage, Press Features, School Achievements',
            'og_type'     => 'website',
            'robots'      => 'index, follow',
        ],
        'downloads-list.get' => [
            'title'       => 'Downloads – Forms & Documents | DCMI',
            'description' => 'Download important forms, admission circulars, fee schedules, academic calendars, and school documents from DCM International School.',
            'keywords'    => 'DCMI Downloads, School Forms, Admission Forms, Fee Schedule, School Documents',
            'og_type'     => 'website',
            'robots'      => 'index, follow',
        ],
        'resource-list' => [
            'title'       => 'Learning Resources – DCM International School',
            'description' => 'Access curated learning resources, study materials, reference guides, and educational tools provided by DCMI for students and parents.',
            'keywords'    => 'DCMI Resources, Study Materials, Learning Guides, Educational Resources',
            'og_type'     => 'website',
            'robots'      => 'index, follow',
        ],
        'admissions.landing.get' => [
            'title'       => 'Admissions – DCM International School',
            'description' => 'Admissions Open at DCMI for the current academic year. Join our innovative school in Ferozepur offering quality CBSE education with modern facilities.',
            'keywords'    => 'DCMI Admissions, School Admission Ferozepur, Apply Online, Admission Process',
            'og_type'     => 'website',
            'robots'      => 'index, follow',
        ],
        'job-form.get' => [
            'title'       => 'Careers – Join DCM International School',
            'description' => 'Explore career opportunities at DCMI. We welcome passionate educators, administrators, and support staff to join our team in Ferozepur.',
            'keywords'    => 'DCMI Careers, Teaching Jobs, School Jobs Ferozepur, Recruitment',
            'og_type'     => 'website',
            'robots'      => 'index, follow',
        ],
        'mandatory-disclosure.get' => [
            'title'       => 'Mandatory Disclosure – DCM International School',
            'description' => 'Mandatory disclosure information as per regulatory requirements for DCM International School, Ferozepur.',
            'keywords'    => 'DCMI Disclosure, School Compliance, School Information',
            'og_type'     => 'website',
            'robots'      => 'index, follow',
        ],
    ],

];
