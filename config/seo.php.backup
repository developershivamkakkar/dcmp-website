<?php

/**
 * Centralized SEO configuration.
 *
 * Keys are Laravel route names.  Add or edit an entry here to control the
 * title, meta description, keywords, Open Graph data, robots directive, and
 * canonical URL for any static front-end page — no Blade file changes needed.
 *
 * For dynamic pages (blog/event detail, gallery album, etc.) the controller
 * or Blade view can still call $seo->set(...) or use @section() overrides;
 * those always take the highest precedence.
 *
 * Fallback chain:
 *   page config  →  site defaults (config/site.php)
 */

return [

    // ─────────────────────────────────────────────────────────────────────────
    // Homepage
    // ─────────────────────────────────────────────────────────────────────────
    'home.get' => [
        'title'       => 'D-BELS — Best School in Panchkula & Tricity Chandigarh',
        'description' => 'Dass & Brown Experiential Learning School (D-Bels) is Panchkula\'s most innovative school — offering Finnish, Entrepreneurship, Legacy, and International pathways including Cambridge AS/A Level, IB Diploma, and ICSE.',
        'keywords'    => 'Best School in Chandigarh, Best School in Panchkula, D-BELS, Dass and Brown School, Top Schools Panchkula, ICSE School Chandigarh, Cambridge School Panchkula, International School Panchkula, Experiential Learning School',
        'og_type'     => 'website',
        'og_image'    => null, // uses site default
        'robots'      => 'index, follow',
    ],

    // ─────────────────────────────────────────────────────────────────────────
    // Contact
    // ─────────────────────────────────────────────────────────────────────────
    'contact' => [
        'title'       => 'Contact Us — D-BELS | Panchkula, Tricity Chandigarh',
        'description' => 'Get in touch with D-BELS (Dass & Brown Experiential Learning School). Visit us at HS-1, Sector 6 MDC, Panchkula. Email: info@dassandbrownschool.com | Call: +91 8872585000',
        'keywords'    => 'Contact D-BELS, D-BELS address, Dass Brown School Panchkula contact, school admission enquiry Chandigarh',
        'og_type'     => 'website',
        'robots'      => 'index, follow',
    ],

    // ─────────────────────────────────────────────────────────────────────────
    // Blogs listing
    // ─────────────────────────────────────────────────────────────────────────
    'blogs.get' => [
        'title'       => 'Blogs — D-BELS | Insights on Education & Learning',
        'description' => 'Read the latest articles, thoughts, and insights from D-BELS on experiential learning, education innovation, school life, and more.',
        'keywords'    => 'D-BELS Blog, School Blog Panchkula, Experiential Learning Articles, Education Blog India, Dass Brown School News',
        'og_type'     => 'website',
        'robots'      => 'index, follow',
    ],

    // ─────────────────────────────────────────────────────────────────────────
    // Events listing
    // ─────────────────────────────────────────────────────────────────────────
    'events.get' => [
        'title'       => 'School Events — D-BELS | Activities & Celebrations',
        'description' => 'Explore the vibrant events, activities, and celebrations at D-BELS. From sports days to cultural fests, we nurture holistic development.',
        'keywords'    => 'D-BELS School Events, School Activities Panchkula, School Celebrations Chandigarh, Student Events Dass Brown',
        'og_type'     => 'website',
        'robots'      => 'index, follow',
    ],

    // ─────────────────────────────────────────────────────────────────────────
    // Gallery pages
    // ─────────────────────────────────────────────────────────────────────────
    'gallery-school-events.get' => [
        'title'       => 'School Events Gallery — D-BELS',
        'description' => 'Browse photos from D-BELS school events, sports meets, cultural programs, and student-led activities.',
        'keywords'    => 'D-BELS Gallery, School Events Photos Panchkula, Dass Brown School Gallery',
        'og_type'     => 'website',
        'robots'      => 'index, follow',
    ],

    'gallery-infrastructure.get' => [
        'title'       => 'Infrastructure Gallery — D-BELS',
        'description' => 'Explore D-BELS\'s world-class infrastructure: smart classrooms, sports facilities, labs, and learning spaces built for tomorrow\'s leaders.',
        'keywords'    => 'D-BELS Infrastructure, School Campus Photos, Best School Facilities Panchkula',
        'og_type'     => 'website',
        'robots'      => 'index, follow',
    ],

    'gallery-activities.get' => [
        'title'       => 'Activities Gallery — D-BELS',
        'description' => 'See how D-BELS students learn through doing — arts, science, sports, entrepreneurship, and more captured in our activities gallery.',
        'keywords'    => 'D-BELS Activities Gallery, Student Activities Photos, School Activities Panchkula',
        'og_type'     => 'website',
        'robots'      => 'index, follow',
    ],

    'gallery-news-clippings.get' => [
        'title'       => 'News Clippings — D-BELS | Media Coverage',
        'description' => 'D-BELS in the news — media coverage, press features, and recognition highlights from leading publications.',
        'keywords'    => 'D-BELS News, Dass Brown School Media, School Press Coverage Panchkula',
        'og_type'     => 'website',
        'robots'      => 'index, follow',
    ],

    // ─────────────────────────────────────────────────────────────────────────
    // Downloads
    // ─────────────────────────────────────────────────────────────────────────
    'downloads-list.get' => [
        'title'       => 'Downloads — D-BELS | Forms & Documents',
        'description' => 'Download important forms, circulars, fee structures, and academic documents from D-BELS.',
        'keywords'    => 'D-BELS Downloads, School Forms Download, Dass Brown School Documents',
        'og_type'     => 'website',
        'robots'      => 'index, follow',
    ],

    // ─────────────────────────────────────────────────────────────────────────
    // Resources
    // ─────────────────────────────────────────────────────────────────────────
    'resource-list' => [
        'title'       => 'Resources — D-BELS | Learning Materials',
        'description' => 'Access curated learning resources, study materials, and educational tools provided by D-BELS for students and parents.',
        'keywords'    => 'D-BELS Resources, School Study Materials, Learning Resources Panchkula, Dass Brown Educational Resources',
        'og_type'     => 'website',
        'robots'      => 'index, follow',
    ],

    // ─────────────────────────────────────────────────────────────────────────
    // Admissions landing page
    // ─────────────────────────────────────────────────────────────────────────
    'admissions.landing.get' => [
        'title'       => 'Admissions Open — D-BELS | Apply Now for 2025–26',
        'description' => 'Admissions are open at D-BELS for the 2025–26 academic year. Join Panchkula\'s most innovative school offering Finnish, Cambridge, IB, and ICSE programmes.',
        'keywords'    => 'D-BELS Admissions, School Admission Panchkula, Admission Open Chandigarh, Best School Admission Tricity, Cambridge School Admission, IB School Admission Panchkula',
        'og_type'     => 'website',
        'robots'      => 'index, follow',
    ],

    // ─────────────────────────────────────────────────────────────────────────
    // Job / Career Enquiry
    // ─────────────────────────────────────────────────────────────────────────
    'job-form.get' => [
        'title'       => 'Careers at D-BELS | Join Our Team',
        'description' => 'Explore career opportunities at D-BELS — we are always looking for passionate educators and administrators to join our team in Panchkula.',
        'keywords'    => 'D-BELS Careers, Teaching Jobs Panchkula, School Jobs Chandigarh, Educator Vacancies Tricity',
        'og_type'     => 'website',
        'robots'      => 'index, follow',
    ],

    // ─────────────────────────────────────────────────────────────────────────
    // Mandatory Disclosure
    // ─────────────────────────────────────────────────────────────────────────
    'mandatory-disclosure.get' => [
        'title'       => 'Mandatory Disclosure — D-BELS',
        'description' => 'Mandatory disclosure as required by the regulatory authority for D-BELS (Dass & Brown Experiential Learning School), Panchkula.',
        'keywords'    => 'D-BELS Mandatory Disclosure, School Compliance Documents Panchkula',
        'og_type'     => 'website',
        'robots'      => 'index, follow',
    ],

];
